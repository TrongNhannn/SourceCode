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
    <div id="k2ModuleBox<?php echo $module->id; ?>" class="tm-k2-tags<?php if ($params->get('moduleclass_sfx')) echo ' ' . $params->get('moduleclass_sfx'); ?>">
  <?php else : ?>
    <div id="k2ModuleBox<?php echo $module->id; ?>" class="k2ModuleBox uk-card uk-card-default uk-card-body uk-margin">
<?php endif; ?>

<ul class="uk-subnav uk-margin-top">
    <li><span aria-expanded="false"><i class="fas fa-tags" aria-hidden="true"></i></span></li>  
    <?php foreach ($tags as $tag): ?>
    <?php if(!empty($tag->tag)): ?>
    <li><a href="<?php echo $tag->link; ?>" uk-tooltip="<?php echo $tag->count.' '.JText::_('K2_ITEMS_TAGGED_WITH').' '.K2HelperUtilities::cleanHtml($tag->tag); ?>">
        <?php echo $tag->tag; ?>
    </a></li>
    <?php endif; ?>
    <?php endforeach; ?>
    </ul>
</div>
