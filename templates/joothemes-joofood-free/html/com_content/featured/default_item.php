<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_content
 *
 * @copyright   Copyright (C) 2005 - 2017 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

// Create a shortcut for params.
$params  = &$this->item->params;
$images  = json_decode($this->item->images);
$canEdit = $this->item->params->get('access-edit');
$info    = $this->item->params->get('info_block_position', 0);

// Check if associations are implemented. If they are, define the parameter.
$assocParam = (JLanguageAssociations::isEnabled() && $params->get('show_associations'));

?>

<?php if ($this->item->state == 0 || strtotime($this->item->publish_up) > strtotime(JFactory::getDate())
	|| ((strtotime($this->item->publish_down) < strtotime(JFactory::getDate())) && $this->item->publish_down != JFactory::getDbo()->getNullDate())) : ?>
	<div class="system-unpublished">
<?php endif; ?>

<div class="leading-blog-item">
<?php if (isset($images->image_intro) && !empty($images->image_intro)) : ?>
	<?php echo JLayoutHelper::render('joomla.content.intro_image', $this->item); ?>
<?php endif; ?>
<div class="leading-blog-absolute"
<?php // Todo Not that elegant would be nice to group the params ?>
<?php $useDefList = ($params->get('show_modify_date') || $params->get('show_publish_date') || $params->get('show_create_date')
	|| $params->get('show_hits') || $params->get('show_category') || $params->get('show_parent_category') || $params->get('show_author') || $assocParam); ?>

<?php if ($useDefList && ($info == 0 || $info == 2)) : ?>
	<?php echo JLayoutHelper::render('joomla.content.info_block', array('item' => $this->item, 'params' => $params, 'position' => 'above')); ?>
	<?php if ($info == 0 && $params->get('show_tags', 1) && !empty($this->item->tags->itemTags)) : ?>
		<?php echo JLayoutHelper::render('joomla.content.tags', $this->item->tags->itemTags); ?>
	<?php endif; ?>
<?php endif; ?>


<?php if ($params->get('show_title')) : ?>
	<h2 class="item-title" itemprop="headline">
	<?php if ($params->get('link_titles') && $params->get('access-view')) : ?>
		<a href="<?php echo JRoute::_(ContentHelperRoute::getArticleRoute($this->item->slug, $this->item->catid, $this->item->language)); ?>" itemprop="url">
			<?php echo $this->escape($this->item->title); ?>
		</a>
	<?php else : ?>
		<?php echo $this->escape($this->item->title); ?>
	<?php endif; ?>
	</h2>
<?php endif; ?>
</div>
</div>
<div class="blog-padding">

<?php if ($this->item->state == 0) : ?>
	<span class="label label-warning"><?php echo JText::_('JUNPUBLISHED'); ?></span>
<?php endif; ?>
<?php if (strtotime($this->item->publish_up) > strtotime(JFactory::getDate())) : ?>
	<span class="label label-warning"><?php echo JText::_('JNOTPUBLISHEDYET'); ?></span>
<?php endif; ?>
<?php if ((strtotime($this->item->publish_down) < strtotime(JFactory::getDate())) && $this->item->publish_down != JFactory::getDbo()->getNullDate()) : ?>
	<span class="label label-warning"><?php echo JText::_('JEXPIRED'); ?></span>
<?php endif; ?>


<div class="clr"></div>




<?php if (!$params->get('show_intro')) : ?>
	<?php // Content is generated by content plugin event "onContentAfterTitle" ?>
	<?php echo $this->item->event->afterDisplayTitle; ?>
<?php endif; ?>
<?php // Content is generated by content plugin event "onContentBeforeDisplay" ?>
<?php echo $this->item->event->beforeDisplayContent; ?>




	<?php echo $this->item->introtext; ?>




<?php if ($useDefList && ($info == 1 || $info == 2)) : ?>
	<?php echo JLayoutHelper::render('joomla.content.info_block', array('item' => $this->item, 'params' => $params, 'position' => 'below')); ?>
	<?php if ($params->get('show_tags', 1) && !empty($this->item->tags->itemTags)) : ?>
		<?php echo JLayoutHelper::render('joomla.content.tags', $this->item->tags->itemTags); ?>
	<?php endif; ?>
<?php endif; ?>



<?php if ($this->item->state == 0 || strtotime($this->item->publish_up) > strtotime(JFactory::getDate())
	|| ((strtotime($this->item->publish_down) < strtotime(JFactory::getDate())) && $this->item->publish_down != $this->db->getNullDate() )) : ?>
	</div>
<?php endif; ?>
</div>
<?php // Content is generated by content plugin event "onContentAfterDisplay" ?>

<?php echo $this->item->event->afterDisplayContent; ?>