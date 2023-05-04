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

<!-- Start K2 Latest Layout -->
<div id="k2Container" class="latestView<?php if ($this->params->get('pageclass_sfx')) echo ' ' . $this->params->get('pageclass_sfx'); ?>">
    <?php if ($this->params->get('show_page_title')) : ?>
        <!-- Page title -->
        <div class="componentheading<?php echo $this->params->get('pageclass_sfx') ?>">
            <?php echo $this->escape($this->params->get('page_title')); ?>
        </div>
    <?php endif; ?>



    <?php foreach ($this->blocks as $key => $block) : ?>

        <div id="latestItemsContainer">

            <?php if ($this->source == 'categories') : $category = $block; ?>

                <?php if ($this->params->get('categoryFeed') || $this->params->get('categoryImage') || $this->params->get('categoryTitle') || $this->params->get('categoryDescription')) : ?>
                    <!-- Start K2 Category block -->
                    <div class="latestItemsCategory">
                        <?php if ($this->params->get('categoryFeed')) : ?>
                            <!-- RSS feed icon -->
                            <div class="uk-card-badge uk-position-top-right">
                                <a href="<?php echo $category->feed; ?>" title="<?php echo JText::_('K2_SUBSCRIBE_TO_THIS_RSS_FEED'); ?>">
                                    <span class="fas fa-rss-square" aria-hidden="true"></span>
                                </a>
                            </div>
                        <?php endif; ?>

                        <?php if ($this->params->get('categoryImage') && !empty($category->image)) : ?>
                            <div class="latestItemsCategoryImage">
                                <img src="<?php echo $category->image; ?>" alt="<?php echo K2HelperUtilities::cleanHtml($category->name); ?>" style="width:<?php echo $this->params->get('catImageWidth'); ?>px;height:auto;" />
                            </div>
                        <?php endif; ?>

                        <?php if ($this->params->get('categoryTitle')) : ?>
                            <h2><a href="<?php echo $category->link; ?>"><?php echo $category->name; ?></a></h2>
                        <?php endif; ?>

                        <?php if ($this->params->get('categoryDescription') && isset($category->description)) : ?>
                            <p><?php echo $category->description; ?></p>
                        <?php endif; ?>

                        <div class="clr"></div>

                        <!-- K2 Plugins: K2CategoryDisplay -->
                        <?php echo $category->event->K2CategoryDisplay; ?>
                        <div class="clr"></div>
                    </div>
                    <!-- End K2 Category block -->
                <?php endif; ?>

            <?php else : $user = $block; ?>

                <?php if ($this->params->get('userFeed') || $this->params->get('userImage') || $this->params->get('userName') || $this->params->get('userDescription') || $this->params->get('userURL') || $this->params->get('userEmail')) : ?>
                    <!-- Start K2 User block -->
                    <div class="uk-card uk-card-default uk-card-body uk-card-small uk-margin">

                        <?php if ($this->params->get('userFeed')) : ?>
                            <!-- RSS feed icon -->
                            <div class="uk-card-badge uk-position-top-right">
                                <a href="<?php echo $user->feed; ?>" title="<?php echo JText::_('K2_SUBSCRIBE_TO_THIS_RSS_FEED'); ?>">
                                    <span class="fas fa-rss-square" aria-hidden="true"></span>
                                </a>
                            </div>
                        <?php endif; ?>

                        <div class="el-item uk-panel uk-margin-remove-first-child">

                            <div class="uk-child-width-expand" uk-grid>
                                <?php if ($this->params->get('userImage') && !empty($user->avatar)) : ?>
                                    <div class="uk-width-1-4">
                                        <img src="<?php echo $user->avatar; ?>" alt="<?php echo $user->name; ?>" style="width:<?php echo $this->params->get('userImageWidth'); ?>px;height:auto;" />
                                    </div>
                                <?php endif; ?>

                                <div class="uk-margin-remove-first-child">

                                    <?php if ($this->params->get('userName')) : ?>
                                        <h3 class="el-title uk-h4 uk-margin-remove-bottom"><a rel="author" href="<?php echo $user->link; ?>"><?php echo $user->name; ?></a></h3>
                                    <?php endif; ?>
                                    <?php if ($this->params->get('userDescription') && isset($user->profile->description)) : ?>
                                        <div class="el-meta uk-text-meta uk-margin-top"><?php echo $user->profile->description; ?></div>
                                    <?php endif; ?>

                                    <?php if ($this->params->get('userURL') || $this->params->get('userEmail')) : ?>
                                        <div class="uk-margin-top">
                                            <?php if ($this->params->get('userURL') && isset($user->profile->url)) : ?>
                                                <span class="latestItemsUserURL">
                                                    <?php echo JText::_('K2_WEBSITE_URL'); ?>: <a rel="me" href="<?php echo $user->profile->url; ?>" target="_blank"><?php echo $user->profile->url; ?></a>
                                                </span>
                                            <?php endif; ?>

                                            <?php if ($this->params->get('userEmail')) : ?>
                                                <span class="latestItemsUserEmail">
                                                    <?php echo JText::_('K2_EMAIL'); ?>: <?php echo JHTML::_('Email.cloak', $user->email); ?>
                                                </span>
                                            <?php endif; ?>
                                        </div>
                                    <?php endif; ?>

                                    <?php echo $user->event->K2UserDisplay; ?>


                                </div>
                            </div>

                        </div>


                    </div>
                    <!-- End K2 User block -->
                <?php endif; ?>

            <?php endif; ?>

            <!-- Start Items list -->

            <?php if ($this->params->get('latestItemsDisplayEffect') == "first") : ?>

                <?php foreach ($block->items as $itemCounter => $item) : K2HelperUtilities::setDefaultImage($item, 'latest', $this->params); ?>
                    <?php if ($itemCounter == 0) : ?>
                        <?php $this->item = $item;
                        echo $this->loadTemplate('item'); ?>
                    <?php else : ?>
                        <h2 class="latestItemTitleList">
                            <?php if ($item->params->get('latestItemTitleLinked')) : ?>
                                <a href="<?php echo $item->link; ?>"><?php echo $item->title; ?></a>
                            <?php else : ?>
                                <?php echo $item->title; ?>
                            <?php endif; ?>
                        </h2>
                    <?php endif; ?>
                <?php endforeach; ?>

            <?php else : ?>
                <div id="latestItemsContainer" class="uk-child-width-1-<?php echo $this->params->get('latestItemsCols', 1); ?>@m uk-child-width-1-2@s" uk-grid>
                    <?php foreach ($block->items as $item) : K2HelperUtilities::setDefaultImage($item, 'latest', $this->params); ?>

                        <?php $this->item = $item;
                        echo $this->loadTemplate('item'); ?>

                    <?php endforeach; ?>
                </div>
            <?php endif; ?>

            <!-- End Item list -->
        </div>
    <?php endforeach; ?>
</div>
<!-- End K2 Latest Layout -->