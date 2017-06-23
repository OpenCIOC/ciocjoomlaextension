<?php
/**
 * @package     com_ciocrsd
 *
 * @copyright   Copyright (C) 2016 - 2017 KCL Software Solutions Inc
 * @license     Apache 2.0
 */

defined('_JEXEC') or die;

use Joomla\Http\HttpFactory;

/**
 * CiocRsd view class.
 * 
 */
class CiocRsdViewResults extends JViewLegacy
{
	/**
	 * Execute and display a template script.
	 *
	 * @param   string  $tpl  The name of the template file to parse; automatically searches through the template paths.
	 *
	 * @return  mixed  A string if successful, otherwise an Error object.
	 *
	 */
	public function display($tpl = null)
	{
		$app    = JFactory::getApplication();
		$menu   = $app->getMenu()->getActive();
		$params = $app->getParams();
		$this->itemid = $Itemid = $menu->id;
		if (is_object($menu)) {
			$this->pageclass_sfx = $menu->params->get('pageclass_sfx');
		}
		// Because the application sets a default page title, we need to get it
		// right from the menu item itself
		$title = $params->get('page_title', '');

		if (empty($title))
		{
			$title = $app->get('sitename');
		}
		elseif ($app->get('sitename_pagetitles', 0) == 1)
		{
			$title = JText::sprintf('JPAGETITLE', $app->get('sitename'), $title);
		}
		elseif ($app->get('sitename_pagetitles', 0) == 2)
		{
			$title = JText::sprintf('JPAGETITLE', $title, $app->get('sitename'));
		}

		$this->document->setTitle($title);

		if ($params->get('menu-meta_description'))
		{
			$this->document->setDescription($params->get('menu-meta_description'));
		}

		if ($params->get('menu-meta_keywords'))
		{
			$this->document->setMetadata('keywords', $params->get('menu-meta_keywords'));
		}

		if ($params->get('robots'))
		{
			$this->document->setMetadata('robots', $params->get('robots'));
		}

		$ciocrsd = new CiocRsdHelper($params, $Itemid);

		$this->params        = &$params;
		$this->ciocrsd       = &$ciocrsd;

		return parent::display($tpl);
	}
}
