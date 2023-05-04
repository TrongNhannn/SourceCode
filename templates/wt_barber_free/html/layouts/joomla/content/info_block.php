<?php
/**
 * @package Helix Ultimate Framework
 * @author JoomShaper https://www.joomshaper.com
 * @copyright Copyright (c) 2010 - 2018 JoomShaper
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or Later
*/

defined ('JPATH_BASE') or die();

use Joomla\CMS\Language\Text;

$intro = (isset($displayData['intro']) && $displayData['intro']) ? $displayData['intro'] : false;
$displayData['articleView'] = ($intro) ? 'intro' : 'details';

$blockPosition = $displayData['params']->get('info_block_position', 0);

$tmpl_params = JFactory::getApplication()->getTemplate(true)->params;

?>

	<?php if ($displayData['position'] === 'below' && ($blockPosition == 1 || $blockPosition == 2)
			|| $displayData['position'] === 'above' && ($blockPosition == 0)
			) : ?>
				
		<?php if ($displayData['params']->get('show_author') && !empty($displayData['item']->author )) : ?>
			<li>
			<?php echo $this->sublayout('author', $displayData); ?>
			</li>
		<?php endif; ?>


		<?php if ($displayData['params']->get('show_parent_category') && !empty($displayData['item']->parent_slug) && $intro == false) : ?>
			<li>
			<?php echo $this->sublayout('parent_category', $displayData); ?>
			</li>
		<?php endif; ?>


		<?php if ($displayData['params']->get('show_category')) : ?>
			<li>
			<?php echo $this->sublayout('category', $displayData); ?>
			</li>
		<?php endif; ?>


		<?php if ($displayData['params']->get('show_associations') && $intro == false) : ?>
			<li>
			<?php echo $this->sublayout('associations', $displayData); ?>
			</li>
		<?php endif; ?>


		<?php if ($displayData['params']->get('show_publish_date')) : ?>
			<li>
			<?php echo $this->sublayout('publish_date', $displayData); ?>
			</li>
		<?php endif; ?>

		<?php if ($intro) : ?>
			<?php echo JLayoutHelper::render('joomla.content.blog.comments.count', $displayData); ?>
		<?php endif; ?>

	<?php endif; ?>

	<?php if ($displayData['position'] === 'above' && ($blockPosition == 0)
			|| $displayData['position'] === 'below' && ($blockPosition == 1 || $blockPosition == 2)
			) : ?>

		<?php if ($displayData['params']->get('show_create_date') && $intro == false) : ?>
			<li><?php echo $this->sublayout('create_date', $displayData); ?></li>
		<?php endif; ?>


		<?php if ($displayData['params']->get('show_modify_date') && $intro == false) : ?>
			<li><?php echo $this->sublayout('modify_date', $displayData); ?></li>
		<?php endif; ?>


		<?php if ($displayData['params']->get('show_hits') && $intro == false) : ?>
			<li><?php echo $this->sublayout('hits', $displayData); ?></li>
		<?php endif; ?>

	<?php endif; ?>
