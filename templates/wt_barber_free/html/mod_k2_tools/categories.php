<?php
/**
 * @version    2.10.x
 * @package    K2
 * @author     JoomlaWorks https://www.joomlaworks.net
 * @copyright  Copyright (c) 2006 - 2019 JoomlaWorks Ltd. All rights reserved.
 * @license    GNU/GPL license: https://www.gnu.org/copyleft/gpl.html
 */

// no direct access
defined('_JEXEC') or die;

?>

<?php if ($params->get('moduleclass_sfx')) : ?>
    <div id="k2ModuleBox<?php echo $module->id; ?>" class="k2CategoriesListBlock<?php if ($params->get('moduleclass_sfx')) echo ' ' . $params->get('moduleclass_sfx'); ?>">
  <?php else : ?>
    <div id="k2ModuleBox<?php echo $module->id; ?>" class="k2ModuleBox uk-card uk-card-default uk-card-body uk-margin">
<?php endif; ?>
<?php echo $output; ?>
</div>