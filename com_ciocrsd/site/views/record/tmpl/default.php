<?php
/**
 * @package     com_ciocrsd
 *
 * @copyright   Copyright (C) 2016 - 2017 KCL Software Solutions Inc
 * @license     Apache 2.0
 */

defined('_JEXEC') or die;
//JHtml::_('script', 'com_ciocrsd/mapping.min.js', array('version' => 'auto', 'relative' => true));
?>
<div class="contentpane<?php echo $this->pageclass_sfx; ?>">
<?php echo ($this->ciocrsd->display_record()); ?>
</div>
