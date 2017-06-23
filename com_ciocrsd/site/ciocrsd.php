<?php
/**
 * @package     com_ciocrsd
 *
 * @copyright   Copyright (C) 2016 - 2017 KCL Software Solutions Inc
 * @license     Apache 2.0
 */

defined('_JEXEC') or die('Restricted access');
//
// Require helper file
require_once(JPATH_COMPONENT . '/helpers/ciocrsd.php');
 
$controller = JControllerLegacy::getInstance('CiocRsd');
$input = JFactory::getApplication()->input;
$controller->execute($input->getCmd('task'));
$controller->redirect();
