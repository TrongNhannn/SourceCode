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

// Get user stuff (do not change)
$user = JFactory::getUser();

?>

<!-- Start K2 User Layout -->
<div id="k2Container" class="userView<?php if ($this->params->get('pageclass_sfx')) echo ' ' . $this->params->get('pageclass_sfx'); ?>">
    <?php if ($this->params->get('show_page_title') && $this->params->get('page_title') != $this->user->name) : ?>
        <!-- Page title -->
        <div class="componentheading<?php echo $this->params->get('pageclass_sfx') ?>">
            <?php echo $this->escape($this->params->get('page_title')); ?>
        </div>
    <?php endif; ?>

    <?php if ($this->params->get('userImage') || $this->params->get('userName') || $this->params->get('userDescription') || $this->params->get('userURL') || $this->params->get('userEmail')) : ?>
        <div class="uk-card uk-card-default uk-card-body uk-card-small uk-margin">

            <?php if ($this->params->get('userFeedIcon', 1)) : ?>
                <!-- RSS feed icon -->
                <div class="uk-card-badge uk-position-top-right">
                    <a href="<?php echo $this->feed; ?>" title="<?php echo JText::_('K2_SUBSCRIBE_TO_THIS_RSS_FEED'); ?>">
                        <span class="fas fa-rss-square" aria-hidden="true"></span>
                    </a>
                </div>
            <?php endif; ?>

            <div class="el-item uk-panel uk-margin-remove-first-child">

                <div class="uk-child-width-expand uk-grid" uk-grid>

                    <?php if ($this->params->get('userImage') && !empty($this->user->avatar)) : ?>
                        <div class="uk-width-1-4">
                            <img class="el-image" src="<?php echo $this->user->avatar; ?>" alt="<?php echo htmlspecialchars($this->user->name, ENT_QUOTES, 'UTF-8'); ?>" style="width:<?php echo $this->params->get('userImageWidth'); ?>px; height:auto;" />
                        </div>
                    <?php endif; ?>

                    <div class="uk-margin-remove-first-child">

                        <?php if ($this->params->get('userName')) : ?>
                            <h3 class="el-title uk-h4 uk-margin-remove-bottom"><?php echo $this->user->name; ?></h3>
                        <?php endif; ?>

                        <?php if ($this->params->get('userDescription') && isset($this->user->profile->description) && trim($this->user->profile->description) != '') : ?>
                            <div class="el-meta uk-text-meta uk-margin-top"><?php echo $this->user->profile->description; ?></div>
                        <?php endif; ?>

                        <?php if (($this->params->get('userURL') && isset($this->user->profile->url) && $this->user->profile->url) || $this->params->get('userEmail')) : ?>
                            <div class="uk-margin-top">
                                <?php if ($this->params->get('userURL') && isset($this->user->profile->url) && $this->user->profile->url) : ?>
                                    <span class="userURL">
                                        <?php echo JText::_('K2_WEBSITE_URL'); ?>: <a href="<?php echo $this->user->profile->url; ?>" target="_blank" rel="me"><?php echo $this->user->profile->url; ?></a>
                                    </span>
                                <?php endif; ?>

                                <?php if ($this->params->get('userEmail')) : ?>
                                    <span class="userEmail">
                                        <?php echo JText::_('K2_EMAIL'); ?>: <?php echo JHTML::_('Email.cloak', $this->user->email); ?>
                                    </span>
                                <?php endif; ?>
                            </div>
                        <?php endif; ?>

                        <?php if (isset($this->addLink) && JRequest::getInt('id') == $user->id) : ?>
                            <!-- Item add link -->
                            <a class="uk-button uk-button-primary uk-button-small uk-margin-top" data-k2-modal="edit" href="<?php echo $this->addLink; ?>">
                                <?php echo JText::_('K2_POST_A_NEW_ITEM'); ?>
                            </a>
                        <?php endif; ?>

                        <?php echo $this->user->event->K2UserDisplay; ?>

                    </div>
                </div>

            </div>

        </div>
    <?php endif; ?>

    <?php if (isset($this->items) && count($this->items)) : ?>
        <!-- Item list -->
        <div class="uk-grid" uk-grid>
            <?php foreach ($this->items as $item) : ?>
                <!-- Start K2 Item Layout -->
                <div class="<?php if (!$item->published || ($item->publish_up != $this->nullDate && $item->publish_up > $this->now) || ($item->publish_down != $this->nullDate && $item->publish_down < $this->now)) echo 'userItemViewUnpublished'; ?><?php echo ($item->featured) ? 'tm-userItemIsFeatured' : ''; ?>">
                    <!-- Plugins: BeforeDisplay -->
                    <?php echo $item->event->BeforeDisplay; ?>

                    <!-- K2 Plugins: K2BeforeDisplay -->
                    <?php echo $item->event->K2BeforeDisplay; ?>

                    <?php if ($this->params->get('userItemTitle')) : ?>
                        <!-- Item title -->
                        <h3 class="el-title uk-margin-remove-bottom">
                            <?php if ($this->params->get('userItemTitleLinked') && $item->published) : ?>
                                <a href="<?php echo $item->link; ?>">
                                    <?php echo $item->title; ?>
                                </a>
                            <?php else : ?>
                                <?php echo $item->title; ?>
                            <?php endif; ?>

                            <?php if ($item->featured) : ?>
                                <!-- Featured flag -->
                                <span class="uk-label uk-label-warning"><?php echo JText::_('K2_FEATURED'); ?></span>
                            <?php endif; ?>

                            <?php if (!$item->published || ($item->publish_up != $this->nullDate && $item->publish_up > $this->now) || ($item->publish_down != $this->nullDate && $item->publish_down < $this->now)) : ?>
                                <span class="uk-label uk-label-danger"><?php echo JText::_('K2_UNPUBLISHED'); ?></span>
                            <?php endif; ?>
                        </h3>
                    <?php endif; ?>

                    <?php if ($this->params->get('userItemDateCreated') || $this->params->get('userItemCategory')) : ?>
                        <p class="uk-article-meta uk-margin-top">
                            <?php if ($this->params->get('userItemDateCreated')) : ?>
                                <?php echo JText::_('K2_WRITTEN_ON'); ?>
                                <!-- Date created -->
                                <?php echo JHTML::_('date', $item->created, JText::_('K2_DATE_FORMAT_LC2')); ?>
                            <?php endif; ?>

                            <?php if ($this->params->get('userItemCategory')) : ?>
                                <!-- Item category name -->
                                <span><?php echo JText::_('K2_PUBLISHED_IN'); ?></span>
                                <a href="<?php echo $item->category->link; ?>"><?php echo $item->category->name; ?></a>
                            <?php endif; ?>

                        </p>

                    <?php endif; ?>

                    <!-- Plugins: AfterDisplayTitle -->
                    <?php echo $item->event->AfterDisplayTitle; ?>

                    <!-- K2 Plugins: K2AfterDisplayTitle -->
                    <?php echo $item->event->K2AfterDisplayTitle; ?>

                    <div class="uk-margin-top">
                        <!-- Plugins: BeforeDisplayContent -->
                        <?php echo $item->event->BeforeDisplayContent; ?>

                        <!-- K2 Plugins: K2BeforeDisplayContent -->
                        <?php echo $item->event->K2BeforeDisplayContent; ?>

                        <?php if ($this->params->get('userItemImage') && !empty($item->imageGeneric)) : ?>
                            <!-- Item Image -->
                            <div class="uk-margin-top">
                                <a href="<?php echo $item->link; ?>" title="<?php if (!empty($item->image_caption)) echo K2HelperUtilities::cleanHtml($item->image_caption);
                                                                            else echo K2HelperUtilities::cleanHtml($item->title); ?>">
                                    <img class="el-image" src="<?php echo $item->imageGeneric; ?>" alt="<?php if (!empty($item->image_caption)) echo K2HelperUtilities::cleanHtml($item->image_caption);
                                                                                                        else echo K2HelperUtilities::cleanHtml($item->title); ?>" style="width:<?php echo $this->params->get('itemImageGeneric'); ?>px; height:auto;" />
                                </a>
                            </div>
                        <?php endif; ?>

                        <?php if ($this->params->get('userItemIntroText')) : ?>
                            <!-- Item introtext -->
                            <div class="el-content uk-panel uk-margin-top">
                                <?php echo $item->introtext; ?>
                            </div>
                        <?php endif; ?>

                        <!-- Plugins: AfterDisplayContent -->
                        <?php echo $item->event->AfterDisplayContent; ?>

                        <!-- K2 Plugins: K2AfterDisplayContent -->
                        <?php echo $item->event->K2AfterDisplayContent; ?>

                    </div>

                    <?php if ($this->params->get('userItemTags') && isset($item->tags) && count($item->tags) > 0) : ?>
                        <!-- Item tags -->
                        <ul class="uk-subnav uk-margin-top">
                            <li><span uk-tooltip="title: <?php echo JText::_('K2_TAGGED_UNDER'); ?>"><i class="fas fa-tags" aria-hidden="true"></i></span></li>
                            <?php foreach ($item->tags as $tag) : ?>
                                <li><a href="<?php echo $tag->link; ?>"><?php echo $tag->name; ?></a></li>
                            <?php endforeach; ?>
                        </ul>
                    <?php endif; ?>

                    <?php if ($this->params->get('userItemReadMore') || isset($item->editLink) || ($this->params->get('userItemCommentsAnchor') && (($this->params->get('comments') == '2' && !$this->user->guest) || ($this->params->get('comments') == '1')))) : ?>

                        <div class="uk-grid-small uk-grid-divider uk-flex-middle uk-margin-top" uk-grid>

                            <?php if ($this->params->get('userItemReadMore')) : ?>
                                <!-- Item "read more..." link -->
                                <div>
                                    <a class="uk-button uk-button-primary" href="<?php echo $item->link; ?>">
                                        <?php echo JText::_('K2_READ_MORE'); ?>
                                    </a>
                                </div>
                            <?php endif; ?>

                            <?php if ($this->params->get('userItemCommentsAnchor') && (($this->params->get('comments') == '2' && !$this->user->guest) || ($this->params->get('comments') == '1'))) : ?>
                                <!-- Anchor link to comments below -->
                                <div>
                                    <?php if (!empty($item->event->K2CommentsCounter)) : ?>
                                        <!-- K2 Plugins: K2CommentsCounter -->
                                        <?php echo $item->event->K2CommentsCounter; ?>
                                    <?php else : ?>
                                        <?php if ($item->numOfComments > 0) : ?>
                                            <a class="uk-button uk-button-text" href="<?php echo $item->link; ?>#itemCommentsAnchor">
                                                <?php echo $item->numOfComments; ?> <?php echo ($item->numOfComments > 1) ? JText::_('K2_COMMENTS') : JText::_('K2_COMMENT'); ?>
                                            </a>
                                        <?php else : ?>
                                            <a class="uk-button uk-button-text" href="<?php echo $item->link; ?>#itemCommentsAnchor">
                                                <?php echo JText::_('K2_BE_THE_FIRST_TO_COMMENT'); ?>
                                            </a>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                </div>
                            <?php endif; ?>

                            <?php if (isset($item->editLink)) : ?>
                                <!-- Item edit link -->
                                <div>
                                    <a data-k2-modal="edit" href="<?php echo $item->editLink; ?>">
                                        <i class="fas fa-pencil-alt"></i> <?php echo JText::_('K2_EDIT_ITEM'); ?>
                                    </a>
                                </div>
                            <?php endif; ?>

                        </div>

                    <?php endif; ?>

                    <!-- Plugins: AfterDisplay -->
                    <?php echo $item->event->AfterDisplay; ?>

                    <!-- K2 Plugins: K2AfterDisplay -->
                    <?php echo $item->event->K2AfterDisplay; ?>

                </div>
                <!-- End K2 Item Layout -->

            <?php endforeach; ?>
        </div>

        <!-- Pagination -->
        <?php if ($this->pagination->getPagesLinks()) : ?>
            <div class="uk-text-center uk-margin-large">
                <div class="k2PaginationLinks">
                    <?php echo $this->pagination->getPagesLinks(); ?>
                </div>
                <div class="k2PaginationCounter">
                    <?php echo $this->pagination->getPagesCounter(); ?>
                </div>
            </div>
        <?php endif; ?>
    <?php endif; ?>
</div>
<!-- End K2 User Layout -->