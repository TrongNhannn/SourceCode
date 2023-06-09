<?php
/**
 * @package Helix Ultimate Framework
 * @author JoomShaper https://www.joomshaper.com
 * @copyright Copyright (c) 2010 - 2018 JoomShaper
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or Later
*/

defined ('JPATH_BASE') or die();

use Joomla\CMS\Factory;
use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Router\Route;
use Joomla\CMS\Language\Text;

// Create a shortcut for params.
$params  = $displayData->params;
$canEdit = $displayData->params->get('access-edit');

$tmpl_params = JFactory::getApplication()->getTemplate(true)->params;

$content_center = $tmpl_params->get('blog_center_content');

$title_style = $tmpl_params->get('leading_blog_list_title', 'h2');
$title_style_cls = $title_style == 'none' ? ' uk-article-title' : ' uk-'.$title_style ;

$title_margin = $tmpl_params->get('leading_blog_list_title_margin', 'default');
$title_margin_cls = $title_margin == 'default' ? 'uk-margin-top' : 'uk-margin-'.$title_margin.'-top' ;
$title_margin_cls .= $content_center ? ' uk-text-center' : '';

$link_style = $tmpl_params->get('blog_list_title_link', 'heading');
$link_style_cls = $link_style != 'default' ? 'uk-link-'.$link_style : 'uk-link';

HTMLHelper::addIncludePath(JPATH_COMPONENT.'/helpers/html');

?>

<?php if ($displayData->state == 0 || $params->get('show_title') || ($params->get('show_author') && !empty($displayData->author ))) : ?>
		<?php if ($params->get('show_title')) : ?>
			<h2 property="headline" class="<?php echo $title_margin_cls; ?> uk-margin-remove-bottom<?php echo $title_style_cls; ?>">
				<?php if ($params->get('link_titles') && ($params->get('access-view') || $params->get('show_noauth', '0') == '1')) : ?>
					<a class="<?php echo $link_style_cls; ?>" href="<?php echo Route::_(ContentHelperRoute::getArticleRoute($displayData->slug, $displayData->catid, $displayData->language)); ?>">
						<?php echo $this->escape($displayData->title); ?>
					</a>
				<?php else : ?>
					<?php echo $this->escape($displayData->title); ?>
				<?php endif; ?>
			</h2>
		<?php endif; ?>

		<?php if ($displayData->state == 0) : ?>
			<span class="badge badge-warning"><?php echo Text::_('JUNPUBLISHED'); ?></span>
		<?php endif; ?>

		<?php if (strtotime($displayData->publish_up) > strtotime(Factory::getDate())) : ?>
			<span class="badge badge-warning"><?php echo Text::_('JNOTPUBLISHEDYET'); ?></span>
		<?php endif; ?>

		<?php if ($displayData->publish_down != Factory::getDbo()->getNullDate()
			&& (strtotime($displayData->publish_down) < strtotime(Factory::getDate()))
		) : ?>
			<span class="badge badge-warning"><?php echo Text::_('JEXPIRED'); ?></span>
		<?php endif; ?>
<?php endif; ?>
