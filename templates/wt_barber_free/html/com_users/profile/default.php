<?php

/**
 * @package     Joomla.Site
 * @subpackage  com_users
 *
 * @copyright   Copyright (C) 2005 - 2018 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

?>
<div class="profile<?php echo $this->pageclass_sfx; ?>">
	<?php if ($this->params->get('show_page_heading')) : ?>
		<div class="page-header">
			<h1 class="el-title uk-h3 uk-margin-small-top uk-margin-remove-bottom">
				<?php echo $this->escape($this->params->get('page_heading')); ?>
			</h1>
		</div>
	<?php endif; ?>
	<?php if (JFactory::getUser()->id == $this->data->id) : ?>
		<div class="uk-button-group uk-float-right">

			<a class="uk-button uk-button-primary" href="<?php echo JRoute::_('index.php?option=com_users&task=profile.edit&user_id=' . (int) $this->data->id); ?>">
				<i class="fas fa-user-edit" aria-hidden="true"></i> <?php echo JText::_('COM_USERS_EDIT_PROFILE'); ?>
			</a>

		</div>
	<?php endif; ?>
	<?php echo $this->loadTemplate('core'); ?>
	<?php echo $this->loadTemplate('params'); ?>
	<?php echo $this->loadTemplate('custom'); ?>
</div>