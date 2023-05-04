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

<!-- Start K2 Item Layout -->
<div class="latestItemView">
    <!-- Plugins: BeforeDisplay -->
    <?php echo $this->item->event->BeforeDisplay; ?>

    <!-- K2 Plugins: K2BeforeDisplay -->
    <?php echo $this->item->event->K2BeforeDisplay; ?>

    <div class="latestItemHeader">
        <?php if ($this->item->params->get('latestItemTitle')) : ?>
            <!-- Item title -->
            <h3 class="el-title uk-margin-remove-bottom">
                <?php if ($this->item->params->get('latestItemTitleLinked')) : ?>
                    <a href="<?php echo $this->item->link; ?>">
                        <?php echo $this->item->title; ?>
                    </a>
                <?php else : ?>
                    <?php echo $this->item->title; ?>
                <?php endif; ?>
            </h3>
        <?php endif; ?>

        <p class="uk-margin-remove-bottom uk-article-meta uk-margin-top">

            <?php if ($this->item->params->get('latestItemDateCreated')) : ?>
                <?php echo JText::_('K2_WRITTEN_ON'); ?>
                <!-- Date created -->
                <?php echo JHTML::_('date', $this->item->created, JText::_('K2_DATE_FORMAT_LC2')); ?>
            <?php endif; ?>


            <?php if ($this->item->params->get('itemCategory')) : ?>
                <!-- Item category -->
                <?php echo JText::_('K2_PUBLISHED_IN'); ?>
                <a href="<?php echo $this->item->category->link; ?>"><?php echo $this->item->category->name; ?></a>
            <?php endif; ?>

        </p>

    </div>



    <!-- Plugins: AfterDisplayTitle -->
    <?php echo $this->item->event->AfterDisplayTitle; ?>

    <!-- K2 Plugins: K2AfterDisplayTitle -->
    <?php echo $this->item->event->K2AfterDisplayTitle; ?>

    <div class="tm-latestItemBody">
        <!-- Plugins: BeforeDisplayContent -->
        <?php echo $this->item->event->BeforeDisplayContent; ?>

        <!-- K2 Plugins: K2BeforeDisplayContent -->
        <?php echo $this->item->event->K2BeforeDisplayContent; ?>

        <?php if ($this->item->params->get('latestItemImage') && !empty($this->item->image)) : ?>
            <!-- Item Image -->
            <div class="uk-margin-top">
                <a href="<?php echo $this->item->link; ?>" title="<?php if (!empty($this->item->image_caption)) echo K2HelperUtilities::cleanHtml($this->item->image_caption);
                                                                    else echo K2HelperUtilities::cleanHtml($this->item->title); ?>">
                    <img src="<?php echo $this->item->image; ?>" alt="<?php if (!empty($this->item->image_caption)) echo K2HelperUtilities::cleanHtml($this->item->image_caption);
                                                                        else echo K2HelperUtilities::cleanHtml($this->item->title); ?>" style="width:<?php echo $this->item->imageWidth; ?>px;height:auto;" />
                </a>
            </div>
        <?php endif; ?>

        <?php if ($this->item->params->get('latestItemIntroText')) : ?>
            <!-- Item introtext -->
            <div class="uk-margin-top">
                <?php echo $this->item->introtext; ?>
            </div>
        <?php endif; ?>

        <!-- Plugins: AfterDisplayContent -->
        <?php echo $this->item->event->AfterDisplayContent; ?>

        <!-- K2 Plugins: K2AfterDisplayContent -->
        <?php echo $this->item->event->K2AfterDisplayContent; ?>

    </div>

    <?php if ($this->item->params->get('latestItemTags')) : ?>
        <?php if ($this->item->params->get('latestItemTags') && isset($this->item->tags) && count($this->item->tags)) : ?>
            <!-- Item tags -->
            <ul class="uk-subnav">
                <li><span uk-tooltip="title: <?php echo JText::_('K2_TAGGED_UNDER'); ?>"><i class="fas fa-tags" aria-hidden="true"></i></span></li>
                <?php foreach ($this->item->tags as $tag) : ?>
                    <li><a href="<?php echo $tag->link; ?>"><?php echo $tag->name; ?></a></li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>
    <?php endif; ?>


    <?php if ($this->params->get('latestItemVideo') && !empty($this->item->video)) : ?>
        <!-- Item video -->
        <div class="latestItemVideoBlock">
            <h3><?php echo JText::_('K2_RELATED_VIDEO'); ?></h3>
            <span class="latestItemVideo<?php if ($this->item->videoType == 'embedded') : ?> embedded<?php endif; ?>"><?php echo $this->item->video; ?></span>
        </div>
    <?php endif; ?>

    <?php if ($this->item->params->get('latestItemReadMore') || ($this->item->params->get('latestItemCommentsAnchor') && (($this->item->params->get('comments') == '2' && !$this->user->guest) || ($this->item->params->get('comments') == '1')))) : ?>

        <div class="uk-grid-small uk-grid-divider uk-flex-middle uk-margin-top" uk-grid>

            <?php if ($this->item->params->get('latestItemReadMore')) : ?>
                <div>
                    <a class="uk-button uk-button-primary" href="<?php echo $this->item->link; ?>">
                        <?php echo JText::_('K2_READ_MORE'); ?>
                    </a>
                </div>
            <?php endif; ?>

            <?php if ($this->item->params->get('latestItemCommentsAnchor') && (($this->item->params->get('comments') == '2' && !$this->user->guest) || ($this->item->params->get('comments') == '1'))) : ?>
                <!-- Anchor link to comments below -->
                <div>
                    <?php if (!empty($this->item->event->K2CommentsCounter)) : ?>
                        <!-- K2 Plugins: K2CommentsCounter -->
                        <?php echo $this->item->event->K2CommentsCounter; ?>
                    <?php else : ?>
                        <?php if ($this->item->numOfComments > 0) : ?>
                            <a class="uk-button uk-button-text" href="<?php echo $this->item->link; ?>#itemCommentsAnchor">
                                <?php echo $this->item->numOfComments; ?> <?php echo ($this->item->numOfComments > 1) ? JText::_('K2_COMMENTS') : JText::_('K2_COMMENT'); ?>
                            </a>
                        <?php else : ?>
                            <a class="uk-button uk-button-text" href="<?php echo $this->item->link; ?>#itemCommentsAnchor">
                                <?php echo JText::_('K2_BE_THE_FIRST_TO_COMMENT'); ?>
                            </a>
                        <?php endif; ?>
                    <?php endif; ?>
                </div>
            <?php endif; ?>

        </div>
    <?php endif; ?>

    <!-- Plugins: AfterDisplay -->
    <?php echo $this->item->event->AfterDisplay; ?>

    <!-- K2 Plugins: K2AfterDisplay -->
    <?php echo $this->item->event->K2AfterDisplay; ?>

</div>
<!-- End K2 Item Layout -->