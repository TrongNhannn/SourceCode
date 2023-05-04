<?php
/**
 * @package Helix Ultimate Framework
 * @author JoomShaper https://www.joomshaper.com
 * @copyright Copyright (c) 2010 - 2018 JoomShaper
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or Later
*/

defined ('JPATH_BASE') or die();

use Joomla\Registry\Registry;
use Joomla\CMS\Factory;
use Joomla\CMS\Router\Route;

JLoader::register('TagsHelperRoute', JPATH_BASE . '/components/com_tags/helpers/route.php');

$authorised = Factory::getUser()->getAuthorisedViewLevels();

?>

<?php if (!empty($displayData)) : ?>
	<?php foreach ($displayData as $i => $tag) : ?>
		<?php if (in_array($tag->access, $authorised)) : ?>
            <?php $seperator = $i++ < count($displayData) - 1 ? ',' : '' ?>
			<?php $tagParams = new Registry($tag->params) ?>
			<?php $link_class = $tagParams->get('tag_link_class', 'label label-info'); ?>
			<a href="<?php echo Route::_(TagsHelperRoute::getTagRoute($tag->tag_id . ':' . $tag->alias)); ?>" class="<?= $link_class ?>" property="keywords">
			<?= $this->escape($tag->title) ?>
			</a>
			<?php echo $seperator; ?>
		<?php endif ?>
	<?php endforeach ?>
<?php endif ?>

