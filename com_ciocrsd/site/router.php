<?php
/**
 * @package     com_ciocrsd
 *
 * @copyright   Copyright (C) 2016 - 2017 KCL Software Solutions Inc
 * @license     Apache 2.0
 */

defined('_JEXEC') or die;

/**
 * Routing class from 
 *
 */

jimport('joomla.log.log');

class CiocRsdRouter extends JComponentRouterBase
{
	/**
	 * Build the route for the component
	 *
	 * @param   array  &$query  An array of URL arguments
	 *
	 * @return  array  The URL arguments to use to assemble the subsequent URL.
	 *
	 */
	public function build(&$query)
	{
		$segments = array();
		if (isset($query['view']))
		{
			if ($query['view'] !== 'ciocrsd') {
				$segments[] = $query['view'];
				if ($query['view'] === 'record') {
					array_push($segments, $query['num']);
					unset($query['num']);
				}
			}
			unset($query['view']);
		}

		return $segments;
	}

	/**
	 * Parse the segments of a URL.
	 *
	 * @param   array  &$segments  The segments of the URL to parse.
	 *
	 * @return  array  The URL attributes to be used by the application.
	 *
	 */
	public function parse(&$segments)
	{
		$app = JFactory::getApplication();
		$menu = $app->getMenu();
		$item = $menu->getActive();
		// Count segments
		$count = count($segments);
		$vars = array();
		if ($count > 0) {
			switch ($segments[0]) {
				case 'results':
					$vars['view'] = 'results';
					break;
				case 'record':
					$vars['view'] = 'record';
					$vars['num'] = $segments[1];
					break;
				case 'browse':
					$vars['view'] = 'browse';
					break;

			}
		}

		if (!array_key_exists('view', $vars)) {
			# search
			$vars['view'] = 'ciocrsd';
		}
		return $vars;
	}
}
