<?php
/**
 * @package Helix Ultimate Framework
 * @author JoomShaper https://www.joomshaper.com
 * @copyright Copyright (c) 2010 - 2018 JoomShaper
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or Later
*/

defined ('_JEXEC') or die();
$tmpl_params = JFactory::getApplication()->getTemplate(true)->params;

$mobile_menu_style = $tmpl_params->get('mobile_menu_options', '');
$header_menu_style = $tmpl_params->get('header_menu_options', '');

$mobile_center_horizontally = $tmpl_params->get('mobile_center_horizontally', '');
$accordion = $module->position == 'offcanvas' && $tmpl_params->get('mobile_accordion');
$multi_subnavs = $tmpl_params->get('mobile_multi_subnavs');

$multi_subnavs_cls = ($accordion && $multi_subnavs) ? 'multiple: true' : '';

if($module->position == 'menu' || $module->position == 'navbar') {
	$menu_style_cls = empty($header_menu_style) ? ' uk-nav-default' : ' uk-nav-primary';
} elseif($module->position == 'offcanvas') {
	$menu_style_cls = empty($mobile_menu_style) ? ' uk-nav-default' : ' uk-nav-primary';
} else {
	$menu_style_cls = ' uk-nav-default';
}

$id = '';

if ($tagId = $params->get('tag_id', ''))
{
	$id = ' id="' . $tagId . '"';
}

// The menu class is deprecated. Use nav instead
?>

<?php if ($accordion) : ?>
<ul class="uk-nav uk-nav-parent-icon<?php echo $menu_style_cls; echo $class_sfx; ?>"<?php echo $id; ?> uk-nav="<?php echo $multi_subnavs_cls; ?>">
<?php else : ?>
<ul class="uk-nav<?php echo $menu_style_cls; echo $class_sfx; ?>"<?php echo $id; ?>>
<?php endif; ?>


<?php foreach ($list as $i => &$item)
{
	$class = 'item-' . $item->id;

	if ($item->id == $default_id)
	{
		$class .= ' default';
	}

	if ($item->id == $active_id || ($item->type === 'alias' && $item->params->get('aliasoptions') == $active_id))
	{
		$class .= ' current';
	}

	if (in_array($item->id, $path))
	{
		$class .= ' uk-active';
	}
	elseif ($item->type === 'alias')
	{
		$aliasToId = $item->params->get('aliasoptions');

		if (count($path) > 0 && $aliasToId == $path[count($path) - 1])
		{
			$class .= ' uk-active';
		}
		elseif (in_array($aliasToId, $path))
		{
			$class .= ' alias-parent-active';
		}
	}

	if ($item->type === 'separator')
	{
		$class .= ' uk-nav-divider';
	}

	if ($item->deeper)
	{
		$class .= ' menu-deeper';
	}

	if ($item->parent)
	{
		$class .= ' uk-parent';
	}

	echo '<li class="' . $class . '">';

	switch ($item->type) :
		case 'separator':
		case 'component':
		case 'heading':
		case 'url':
			require JModuleHelper::getLayoutPath('mod_menu', 'default_' . $item->type);
			break;

		default:
			require JModuleHelper::getLayoutPath('mod_menu', 'default_url');
			break;
	endswitch;

	// The next item is deeper.
	if ($item->deeper)
	{
		echo '<ul class="uk-nav-sub">';
	}
	// The next item is shallower.
	elseif ($item->shallower)
	{
		echo '</li>';
		echo str_repeat('</ul></li>', $item->level_diff);
	}
	// The next item is on the same level.
	else
	{
		echo '</li>';
	}
}
?></ul>
