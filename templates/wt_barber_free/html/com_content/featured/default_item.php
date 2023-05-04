<?php
/**
 * @package Helix Ultimate Framework
 * @author JoomShaper https://www.joomshaper.com
 * @copyright Copyright (c) 2010 - 2018 JoomShaper
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or Later
*/

defined ('_JEXEC') or die();

// Create a shortcut for params.
$params  = &$this->item->params;
$images  = json_decode($this->item->images);
$canEdit = $this->item->params->get('access-edit');
$info    = $this->item->params->get('info_block_position', 0);
$tmpl_params = JFactory::getApplication()->getTemplate(true)->params;

$content_center = $tmpl_params->get('blog_center_content');

$content_margin = $tmpl_params->get('leading_blog_list_content_margin', 'default');
$content_margin_cls = $content_margin == 'default' ? 'uk-margin-top' : 'uk-margin-'.$content_margin.'-top' ;
$content_margin_cls .= $content_center ? ' uk-text-center' : '';

$meta_margin = $tmpl_params->get('leading_blog_list_meta_margin', 'default');
$meta_margin_cls = $meta_margin == 'default' ? 'uk-margin-top' : 'uk-margin-'.$meta_margin.'-top' ;
$meta_margin_cls .= $content_center ? ' uk-flex-center' : '';

$title_style = $tmpl_params->get('leading_blog_list_title', 'h2');
$title_style_cls = $title_style == 'none' ? ' uk-article-title' : ' uk-'.$title_style;

$title_margin = $tmpl_params->get('leading_blog_list_title_margin', 'default');
$title_margin_cls = $title_margin == 'default' ? 'uk-margin-top' : 'uk-margin-'.$title_margin.'-top' ;
$title_margin_cls .= $content_center ? ' uk-flex-center' : '';

$content_length = $tmpl_params->get('content_length');
$image_margin = $tmpl_params->get('image_margin', 'default');
$image_margin_cls = $image_margin == 'default' ? ' uk-margin-top' : ' uk-margin-'.$image_margin.'-top';
$blog_tag_cls = $content_center ? ' class="uk-text-center"' : '';

// Check if associations are implemented. If they are, define the parameter.
$assocParam = (JLanguageAssociations::isEnabled() && $params->get('show_associations'));
?>

<?php if ($this->item->state == 0 || strtotime($this->item->publish_up) > strtotime(JFactory::getDate())
	|| ((strtotime($this->item->publish_down) < strtotime(JFactory::getDate())) && $this->item->publish_down != JFactory::getDbo()->getNullDate())) : ?>
	<div class="system-unpublished">
<?php endif; ?>

<?php if (isset($images->image_intro) && !empty($images->image_intro) && $params->get('float_intro') == 'none') : ?>
	<div class="uk-text-center">
	<?php echo JLayoutHelper::render('joomla.content.intro_image', $this->item); ?>
	</div>
<?php endif; ?>

<?php // Todo Not that elegant would be nice to group the params ?>
<?php $useDefList = ($params->get('show_modify_date') || $params->get('show_publish_date') || $params->get('show_create_date')
	|| $params->get('show_hits') || $params->get('show_category') || $params->get('show_parent_category') || $params->get('show_author') || $assocParam); ?>

<?php if ($useDefList && $info == 0) : ?>
	<?php // Todo: for Joomla4 joomla.content.info_block.block can be changed to joomla.content.info_block ?>
	<ul class="<?php echo $meta_margin_cls; ?> uk-margin-remove-bottom uk-subnav">
	<?php echo JLayoutHelper::render('joomla.content.info_block.block', array('item' => $this->item, 'params' => $params, 'position' => 'above')); ?>
	</ul>
<?php endif; ?>

<?php if ($params->get('show_title')) : ?>
	<h2 property="headline" class="<?php echo $title_margin_cls; ?> uk-margin-remove-bottom<?php echo $title_style_cls; ?>">
	<?php if ($params->get('link_titles') && $params->get('access-view')) : ?>
		<a href="<?php echo JRoute::_(ContentHelperRoute::getArticleRoute($this->item->slug, $this->item->catid, $this->item->language)); ?>" itemprop="url">
			<?php echo $this->escape($this->item->title); ?>
		</a>
	<?php else : ?>
		<?php echo $this->escape($this->item->title); ?>
	<?php endif; ?>
	</h2>
<?php endif; ?>

<?php if ($this->item->state == 0) : ?>
	<span class="uk-label uk-label-warning"><?php echo JText::_('JUNPUBLISHED'); ?></span>
<?php endif; ?>
<?php if (strtotime($this->item->publish_up) > strtotime(JFactory::getDate())) : ?>
	<span class="uk-label uk-label-warning"><?php echo JText::_('JNOTPUBLISHEDYET'); ?></span>
<?php endif; ?>
<?php if ((strtotime($this->item->publish_down) < strtotime(JFactory::getDate())) && $this->item->publish_down != JFactory::getDbo()->getNullDate()) : ?>
	<span class="uk-label uk-label-warning"><?php echo JText::_('JEXPIRED'); ?></span>
<?php endif; ?>

<?php // Content is generated by content plugin event "onContentAfterTitle" ?>
<?php echo $this->item->event->afterDisplayTitle; ?>

<?php if ($useDefList && $info != 0) : ?>
	<?php // Todo: for Joomla4 joomla.content.info_block.block can be changed to joomla.content.info_block ?>
	<ul class="<?php echo $meta_margin_cls; ?> uk-margin-remove-bottom uk-subnav">
	<?php echo JLayoutHelper::render('joomla.content.info_block.block', array('item' => $this->item, 'params' => $params, 'position' => 'below')); ?>
	</ul>
<?php endif; ?>
	
<?php if (isset($images->image_intro) && !empty($images->image_intro) && $params->get('float_intro') != 'none') : ?>
	<div class="uk-text-center<?php echo $image_margin_cls; ?>">
	<?php echo JLayoutHelper::render('joomla.content.intro_image', $this->item); ?>
	</div>
<?php endif; ?>

<?php // Content is generated by content plugin event "onContentBeforeDisplay" ?>
<?php echo $this->item->event->beforeDisplayContent; ?>

	<div class="<?php echo $content_margin_cls; ?>" property="text">
		<?php if (is_numeric($content_length) && $content_length >= 0) : ?>
			<?php echo substr(strip_tags($this->item->introtext), 0, $content_length) . '...'; ?>
		<?php else : ?>
			<?php echo $this->item->introtext; ?>
		<?php endif ?> 
	</div>

	<?php if ($info == 0 && $params->get('show_tags', 1) && !empty($this->item->tags->itemTags)) : ?>
		<p<?php echo $blog_tag_cls; ?>><span class="uk-text-small uk-text-muted uk-margin-small-right"><i class="fas fa-tags"></i></span><?php echo JLayoutHelper::render('joomla.content.tags', $this->item->tags->itemTags); ?></p>
	<?php endif; ?>

<?php if ($params->get('show_readmore') && $this->item->readmore) :
	if ($params->get('access-view')) :
		$link = JRoute::_(ContentHelperRoute::getArticleRoute($this->item->slug, $this->item->catid, $this->item->language));
	else :
		$menu = JFactory::getApplication()->getMenu();
		$active = $menu->getActive();
		$itemId = $active->id;
		$link = new JUri(JRoute::_('index.php?option=com_users&view=login&Itemid=' . $itemId, false));
		$link->setVar('return', base64_encode(ContentHelperRoute::getArticleRoute($this->item->slug, $this->item->catid, $this->item->language)));
	endif; ?>

	<?php echo JLayoutHelper::render('joomla.content.readmore', array('item' => $this->item, 'params' => $params, 'link' => $link)); ?>

<?php endif; ?>

<?php if ($this->item->state == 0 || strtotime($this->item->publish_up) > strtotime(JFactory::getDate())
	|| ((strtotime($this->item->publish_down) < strtotime(JFactory::getDate())) && $this->item->publish_down != $this->db->getNullDate() )) : ?>
	</div>
<?php endif; ?>

<?php if ($canEdit || $params->get('show_print_icon') || $params->get('show_email_icon')) : ?>
	<?php echo JLayoutHelper::render('joomla.content.icons', array('params' => $params, 'item' => $this->item, 'print' => false)); ?>
<?php endif; ?>

<?php // Content is generated by content plugin event "onContentAfterDisplay" ?>
<?php echo $this->item->event->afterDisplayContent; ?>
