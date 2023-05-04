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

<!-- Start K2 Category Layout -->
<div id="k2Container" class="itemListView<?php if ($this->params->get('pageclass_sfx')) echo ' ' . $this->params->get('pageclass_sfx'); ?>">
    <?php if ($this->params->get('show_page_title')) : ?>
        <!-- Page title -->
        <div class="componentheading<?php echo $this->params->get('pageclass_sfx') ?>">
            <?php echo $this->escape($this->params->get('page_title')); ?>
        </div>
    <?php endif; ?>

    <?php if (isset($this->category) || ($this->params->get('subCategories') && isset($this->subCategories) && count($this->subCategories))) : ?>
        <!-- Blocks for current category and subcategories -->
        <div class="itemListCategoriesBlock">

            <?php if (isset($this->category) && ($this->params->get('catImage') || $this->params->get('catTitle') || $this->params->get('catDescription') || $this->category->event->K2CategoryDisplay)) : ?>
                <!-- Category block -->
                <div class="uk-card uk-card-default uk-card-body uk-margin">

                    <?php if ($this->params->get('catFeedIcon')) : ?>
                        <!-- RSS feed icon -->
                        <div class="uk-card-badge uk-position-top-right">
                            <a href="<?php echo $this->feed; ?>" title="<?php echo JText::_('K2_SUBSCRIBE_TO_THIS_RSS_FEED'); ?>">
                                <span class="fas fa-rss-square" aria-hidden="true"></span>
                            </a>
                        </div>
                    <?php endif; ?>

                    <div class="uk-child-width-expand uk-flex uk-flex-middle" uk-grid>

                        <div class="uk-width-1-4">
                            <?php if ($this->params->get('catImage') && $this->category->image) : ?>
                                <!-- Category image -->
                                <img alt="<?php echo K2HelperUtilities::cleanHtml($this->category->name); ?>" src="<?php echo $this->category->image; ?>" style="width:<?php echo $this->params->get('catImageWidth'); ?>px; height:auto;" />
                            <?php endif; ?>
                        </div>
                        <div class="uk-margin-remove-first-child">

                            <?php if ($this->params->get('catTitle')) : ?>
                                <!-- Category title -->
                                <h3 class="el-title uk-h4 uk-margin-remove-bottom"><?php echo $this->category->name; ?><?php if ($this->params->get('catTitleItemCounter')) echo ' (' . $this->pagination->total . ')'; ?></h2>
                                <?php endif; ?>

                                <?php if ($this->params->get('catDescription')) : ?>
                                    <!-- Category description -->
                                    <div class="el-content uk-text-meta uk-margin-top"><?php echo $this->category->description; ?></div>
                                <?php endif; ?>

                                <?php if (isset($this->addLink)) : ?>
                                    <!-- Item add link -->
                                    <div class="uk-margin-top">
                                        <a class="uk-button uk-button-primary uk-button-small" data-k2-modal="edit" href="<?php echo $this->addLink; ?>">
                                            <?php echo JText::_('K2_ADD_A_NEW_ITEM_IN_THIS_CATEGORY'); ?>
                                        </a>
                                    </div>
                                <?php endif; ?>

                                <!-- K2 Plugins: K2CategoryDisplay -->
                                <?php echo $this->category->event->K2CategoryDisplay; ?>
                        </div>
                    </div>

                </div>
            <?php endif; ?>

            <?php if ($this->params->get('subCategories') && isset($this->subCategories) && count($this->subCategories)) : ?>
                <!-- Subcategories -->
                <h3><?php echo JText::_('K2_CHILDREN_CATEGORIES'); ?></h3>
                <div class="uk-child-width-expand@s uk-text-center uk-grid-match uk-margin" uk-grid>

                    <?php foreach ($this->subCategories as $key => $subCategory) : ?>
                        <?php
                        // Define a CSS class for the last container on each row
                        if ((($key + 1) % ($this->params->get('subCatColumns')) == 0))
                            $lastContainer = ' subCategoryContainerLast';
                        else
                            $lastContainer = '';
                        ?>
                        
                        <div class="<?php echo $lastContainer; ?>" <?php echo (count($this->subCategories) == 1) ? '' : ' style="width:' . number_format(100 / $this->params->get('subCatColumns'), 1) . '%;"'; ?>>
                            <div class="uk-card uk-card-default uk-card-body">
                                <?php if ($this->params->get('subCatImage') && $subCategory->image) : ?>
                                    <!-- Subcategory image -->
                                    <a class="subCategoryImage" href="<?php echo $subCategory->link; ?>">
                                        <img alt="<?php echo K2HelperUtilities::cleanHtml($subCategory->name); ?>" src="<?php echo $subCategory->image; ?>" style="width:<?php echo $this->params->get('catImageWidth'); ?>px; height:auto;" />
                                    </a>
                                <?php endif; ?>

                                <?php if ($this->params->get('subCatTitle')) : ?>
                                    <!-- Subcategory title -->
                                    <h3 class="el-title uk-margin-remove-bottom">
                                        <a href="<?php echo $subCategory->link; ?>">
                                            <?php echo $subCategory->name; ?><?php if ($this->params->get('subCatTitleItemCounter')) echo ' (' . $subCategory->numOfItems . ')'; ?>
                                        </a>
                                    </h3>
                                <?php endif; ?>

                                <?php if ($this->params->get('subCatDescription')) : ?>
                                    <!-- Subcategory description -->
                                    <div><?php echo $subCategory->description; ?></div>
                                <?php endif; ?>

                                <!-- Subcategory more... -->
                                <a class="uk-button uk-button-text uk-margin-top" href="<?php echo $subCategory->link; ?>">
                                    <?php echo JText::_('K2_VIEW_ITEMS'); ?>
                                </a>

                                <div class="clr"></div>
                            </div>
                        </div>

                    <?php endforeach; ?>

                </div>
            <?php endif; ?>
        </div>
    <?php endif; ?>

    <?php if ((isset($this->leading) || isset($this->primary) || isset($this->secondary) || isset($this->links)) && (count($this->leading) || count($this->primary) || count($this->secondary) || count($this->links))) : ?>
        <!-- Item list -->
        <div class="itemList">
            <?php if (isset($this->leading) && count($this->leading)) : ?>
                <!-- Leading items -->
                <div id="itemListLeading" class="uk-child-width-1-<?php echo (count($this->leading) == 1) ? '1' : $this->params->get('num_leading_columns'); ?>@m uk-child-width-1-2@s" uk-grid>
                    <?php foreach ($this->leading as $key => $item) : ?>
                        <div class="tm-itemContainer">
                            <?php
                            // Load category_item.php by default
                            $this->item = $item;
                            echo $this->loadTemplate('item');
                            ?>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>

            <?php if (isset($this->primary) && count($this->primary)) : ?>
                <!-- Primary items -->
                <div id="itemListPrimary" class="uk-child-width-1-<?php echo (count($this->primary) == 1) ? '1' : $this->params->get('num_primary_columns'); ?>@m uk-child-width-1-2@s" uk-grid>
                    <?php foreach ($this->primary as $key => $item) : ?>
                        <div class="tm-itemContainer">
                            <?php
                            // Load category_item.php by default
                            $this->item = $item;
                            echo $this->loadTemplate('item');
                            ?>
                        </div>
                    <?php endforeach; ?>

                </div>
            <?php endif; ?>

            <?php if (isset($this->secondary) && count($this->secondary)) : ?>
                <!-- Secondary items -->
                <div id="itemListSecondary" class="uk-child-width-1-<?php echo (count($this->secondary) == 1) ? '1' : $this->params->get('num_secondary_columns'); ?>@m uk-child-width-1-2@s" uk-grid>
                    <?php foreach ($this->secondary as $key => $item) : ?>
                        <div class="tm-itemContainer">
                            <?php
                            // Load category_item.php by default
                            $this->item = $item;
                            echo $this->loadTemplate('item');
                            ?>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>

            <?php if (isset($this->links) && count($this->links)) : ?>
                <!-- Link items -->
                <div id="tm-itemListLinks">
                    <h3 class="el-title uk-margin-medium-top"><?php echo JText::_('K2_MORE'); ?></h3>
                    <div id="itemContainer" class="uk-child-width-1-<?php echo (count($this->links) == 1) ? '1' : $this->params->get('num_links_columns'); ?>@m uk-child-width-1-2@s" uk-grid>
                        <?php foreach ($this->links as $key => $item) : ?>
                            <div id="itemContainer">
                                <?php
                                // Load category_item.php by default
                                $this->item = $item;
                                echo $this->loadTemplate('item');
                                ?>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            <?php endif; ?>
        </div>

        <!-- Pagination -->
        <?php if ($this->pagination->getPagesLinks()) : ?>
            <div class="uk-text-center uk-margin-large">
                <?php if ($this->params->get('catPagination', 1)) : ?>
                    <div class="k2PaginationLinks">
                        <?php echo $this->pagination->getPagesLinks(); ?>
                    </div>
                <?php endif; ?>
                <?php if ($this->params->get('catPaginationResults', 1)) : ?>
                    <div class="k2PaginationCounter">
                        <?php echo $this->pagination->getPagesCounter(); ?>
                    </div>
                <?php endif; ?>
            </div>
        <?php endif; ?>
    <?php endif; ?>
</div>
<!-- End K2 Category Layout -->