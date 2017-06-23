<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_ciocrsd
 *
 * @copyright   Copyright (C) 2016 - 2017 KCL Software Solutions Inc
 * @license     Apache 2.0
 */
 
// No direct access to this file
defined('_JEXEC') or die('Restricted access');
 
// Get an instance of the controller prefixed by HelloWorld
$controller = JControllerLegacy::getInstance('CiocRsd');
 
// Perform the Request task
$controller->execute(JFactory::getApplication()->input->get('task'));
 
// Redirect if set by the controller
$controller->redirect();
