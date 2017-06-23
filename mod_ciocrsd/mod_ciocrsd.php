<?php
/**
 * CIOC RSD! Module Entry Point
 * 
 * @copyright   Copyright (C) 2016 - 2017 KCL Software Solutions Inc
 * @license     Apache 2.0
 */

use Joomla\Registry\Registry;
 
// No direct access
defined('_JEXEC') or die;
// Include the syndicate functions only once
require_once(JPATH_BASE . '/components/com_ciocrsd/helpers/ciocrsd.php');
jimport('joomla.application.component.helper');

$lang = JFactory::getLanguage();
$extension = 'com_ciocrsd';
$base_dir = JPATH_SITE;
$language_tag = 'en-GB';
$reload = true;
$lang->load($extension, $base_dir, $language_tag, $reload);

$app = JFactory::getApplication();
$menuitem   = $app->getMenu()->getItem($params->get('targetmenuitem'));
$componentParams = JComponentHelper::getParams('com_ciocrsd');
$allparams = (new Registry)->merge($componentParams)->merge($menuitem->params)->merge($params);

$ciocrsd = new CiocRsdHelper($allparams, $params->get('targetmenuitem'));

require JModuleHelper::getLayoutPath('mod_ciocrsd');
