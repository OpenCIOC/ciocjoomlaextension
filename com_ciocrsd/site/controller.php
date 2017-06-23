<?php
/**
 * @package     com_ciocrsd
 *
 * @copyright   Copyright (C) 2016 - 2017 KCL Software Solutions Inc
 * @license     Apache 2.0
 */

defined('_JEXEC') or die;

/**
 * Content Component Controller
 *
 */
class CiocRsdController extends JControllerLegacy
{
	/**
	 * Method to display a view.
	 *
	 * @param   boolean  $cachable   If true, the view output will be cached
	 * @param   array    $urlparams  An array of safe URL parameters and their variable types, for valid values see {@link JFilterInput::clean()}.
	 *
	 * @return  JControllerLegacy  This object to support chaining.
	 *
	 * @since   0.0.1
	 */
	public function display($cachable = false, $urlparams = array())
	{
		$cachable = false;

		// Set the default view name and format from the Request.
		$vName = $this->input->get('view', 'ciocrsd');
		$this->input->set('view', $vName);

		return parent::display($cachable, array('Itemid' => 'INT'));
	}
}
