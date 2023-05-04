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

<div id="k2-slideshow<?php echo $module->id; ?>" class="tm-k2content-slideshow<?php if ($params->get('moduleclass_sfx')) echo ' ' . $params->get('moduleclass_sfx'); ?>">

    <?php if ($params->get('feed')) : ?>
        <div class="uk-card-badge uk-position-top-right">
            <a href="<?php echo JRoute::_('index.php?option=com_k2&view=itemlist&format=feed&moduleID=' . $module->id); ?>" title="<?php echo JText::_('K2_SUBSCRIBE_TO_THIS_RSS_FEED'); ?>">
                <span class="fas fa-rss-square" aria-hidden="true"></span>
            </a>
        </div>
    <?php endif; ?>

    <?php if ($params->get('itemPreText')) : ?>
        <p class="modulePretext"><?php echo $params->get('itemPreText'); ?></p>
    <?php endif; ?>

    <?php if (isset($items) && count($items)) : ?>
        <div uk-slideshow="ratio: false; animation: pull; velocity: 1.5; min-height: 500; max-height: 800" class="uk-margin" uk-parallax="y: 0,-50; media: @m;">
            <div class="uk-position-relative">
                <ul class="uk-slideshow-items">
                    <?php foreach ($items as $key => $item) :  ?>

                        <li class="el-item" tabindex="-1">
                            <div class="uk-position-cover" uk-slideshow-parallax="scale: 1,1.2,1.2">

                                <?php if ($params->get('itemImage') && !empty($item->image)) : ?>
                                    <img class="el-image uk-cover" src="<?php echo $item->image; ?>" alt="<?php echo K2HelperUtilities::cleanHtml($item->title); ?>" uk-img="target: !.uk-slideshow-items" uk-cover />
                                <?php endif; ?>
                            </div>

                            <div class="uk-position-cover" uk-slideshow-parallax="opacity: 0.5,0,0; backgroundColor: #000,#000" style="background-color: rgb(0, 0, 0); opacity: 0;"></div>

                            <div class="uk-position-small uk-position-center-left uk-flex uk-flex-center uk-flex-middle uk-padding">

                                <div class="el-overlay uk-overlay uk-overlay-primary uk-padding uk-width-xlarge uk-margin-remove-first-child">

                                    <!-- Plugins: BeforeDisplay -->
                                    <?php echo $item->event->BeforeDisplay; ?>

                                    <!-- K2 Plugins: K2BeforeDisplay -->
                                    <?php echo $item->event->K2BeforeDisplay; ?>


                                    <?php if ($params->get('itemCategory') || $params->get('itemDateCreated')) : ?>
                                        <div class="el-meta uk-text-muted uk-margin-top uk-margin-remove-bottom">
                                            <?php echo JText::_('K2_WRITTEN_ON'); ?> <?php echo JHTML::_('date', $item->created, JText::_('K2_DATE_FORMAT_LC2')); ?>
                                            <?php echo JText::_('K2_IN'); ?> <a class="moduleItemCategory" href="<?php echo $item->categoryLink; ?>"><?php echo $item->categoryname; ?></a>
                                        </div>
                                    <?php endif; ?>

                                    <?php if ($params->get('itemTitle')) : ?>
                                        <h1 class="el-title uk-h2 uk-margin-remove-top uk-margin-remove-bottom">
                                            <a class="uk-link-reset" href="<?php echo $item->link; ?>"><?php echo $item->title; ?></a>
                                        </h1>
                                    <?php endif; ?>


                                    <?php if ($params->get('itemAuthor') || $params->get('itemAuthorAvatar')) : ?>
                                        <div class="uk-margin">
                                            <?php echo K2HelperUtilities::writtenBy($item->authorGender); ?>

                                            <?php if ($params->get('itemAuthorAvatar')) : ?>
                                                <a class="k2Avatar moduleItemAuthorAvatar" rel="author" href="<?php echo $item->authorLink; ?>">
                                                    <img src="<?php echo $item->authorAvatar; ?>" alt="<?php echo K2HelperUtilities::cleanHtml($item->author); ?>" style="width:<?php echo $avatarWidth; ?>px;height:auto;" />
                                                </a>
                                            <?php endif; ?>

                                            <?php if (isset($item->authorLink)) : ?>
                                                <a rel="author" title="<?php echo K2HelperUtilities::cleanHtml($item->author); ?>" href="<?php echo $item->authorLink; ?>">
                                                    <?php echo $item->author; ?>
                                                </a>
                                            <?php else : ?>
                                                <?php echo $item->author; ?>
                                            <?php endif; ?>

                                            <?php if ($params->get('userDescription')) : ?>
                                                <?php echo $item->authorDescription; ?>
                                            <?php endif; ?>
                                        </div>
                                    <?php endif; ?>

                                    <!-- Plugins: AfterDisplayTitle -->
                                    <?php echo $item->event->AfterDisplayTitle; ?>

                                    <!-- K2 Plugins: K2AfterDisplayTitle -->
                                    <?php echo $item->event->K2AfterDisplayTitle; ?>

                                    <!-- Plugins: BeforeDisplayContent -->
                                    <?php echo $item->event->BeforeDisplayContent; ?>

                                    <!-- K2 Plugins: K2BeforeDisplayContent -->
                                    <?php echo $item->event->K2BeforeDisplayContent; ?>

                                    <?php if ($params->get('itemExtraFields') && isset($item->extra_fields) && count($item->extra_fields)) : ?>
                                        <div class="moduleItemExtraFields">
                                            <b><?php echo JText::_('K2_ADDITIONAL_INFO'); ?></b>
                                            <ul>
                                                <?php foreach ($item->extra_fields as $key => $extraField) : ?>
                                                    <?php if ($extraField->value != '') : ?>
                                                        <li class="<?php echo ($key % 2) ? "odd" : "even"; ?> type<?php echo ucfirst($extraField->type); ?> group<?php echo $extraField->group; ?> alias<?php echo ucfirst($extraField->alias); ?>">
                                                            <?php if ($extraField->type == 'header') : ?>
                                                                <h4 class="moduleItemExtraFieldsHeader"><?php echo $extraField->name; ?></h4>
                                                            <?php else : ?>
                                                                <span class="moduleItemExtraFieldsLabel"><?php echo $extraField->name; ?></span>
                                                                <span class="moduleItemExtraFieldsValue"><?php echo $extraField->value; ?></span>
                                                            <?php endif; ?>
                                                            <div class="clr"></div>
                                                        </li>
                                                    <?php endif; ?>
                                                <?php endforeach; ?>
                                            </ul>
                                        </div>
                                    <?php endif; ?>

                                    <?php if ($params->get('itemVideo') && !empty($item->video)) : ?>
                                        <div class="moduleItemVideo">
                                            <?php echo $item->video; ?>
                                            <span class="moduleItemVideoCaption"><?php echo $item->video_caption; ?></span>
                                            <span class="moduleItemVideoCredits"><?php echo $item->video_credits; ?></span>
                                        </div>
                                    <?php endif; ?>

                                    <!-- Plugins: AfterDisplayContent -->
                                    <?php echo $item->event->AfterDisplayContent; ?>

                                    <!-- K2 Plugins: K2AfterDisplayContent -->
                                    <?php echo $item->event->K2AfterDisplayContent; ?>

                                    <?php if ($params->get('itemIntroText')) : ?>
                                        <div class="el-content uk-margin-small-top">
                                            <?php echo $item->introtext; ?>
                                        </div>
                                    <?php endif; ?>


                                    <?php if ($params->get('itemHits')) : ?>
                                        <div class="uk-margin-small-top">
                                            <?php echo JText::_('K2_READ'); ?> <?php echo $item->hits; ?> <?php echo JText::_('K2_TIMES'); ?>
                                        </div>
                                    <?php endif; ?>

                                    <?php if ($params->get('itemAttachments') && isset($item->attachments) && count($item->attachments)) : ?>
                                        <div class="moduleAttachments">
                                            <?php foreach ($item->attachments as $attachment) : ?>
                                                <a title="<?php echo K2HelperUtilities::cleanHtml($attachment->titleAttribute); ?>" href="<?php echo $attachment->link; ?>">
                                                    <?php echo $attachment->title; ?>
                                                </a>
                                            <?php endforeach; ?>
                                        </div>
                                    <?php endif; ?>

                                    <div class="uk-grid-small uk-flex uk-flex-middle uk-grid-divider uk-margin-small-top" uk-grid>

                                        <?php if ($params->get('itemReadMore') && $item->fulltext) : ?>
                                            <div>
                                                <a class="uk-button uk-button-primary" href="<?php echo $item->link; ?>">
                                                    <?php echo JText::_('K2_READ_MORE'); ?>
                                                </a>
                                            </div>
                                        <?php endif; ?>

                                        <?php if ($params->get('itemCommentsCounter') && $componentParams->get('comments')) : ?>
                                            <?php if (!empty($item->event->K2CommentsCounter)) : ?>
                                                <!-- K2 Plugins: K2CommentsCounter -->
                                                <?php echo $item->event->K2CommentsCounter; ?>
                                            <?php else : ?>
                                                <?php if ($item->numOfComments > 0) : ?>
                                                    <div><a class="uk-button uk-button-text" href="<?php echo $item->link . '#itemCommentsAnchor'; ?>">
                                                            <?php echo $item->numOfComments; ?> <?php if ($item->numOfComments > 1) echo JText::_('K2_COMMENTS');
                                                                                                else echo JText::_('K2_COMMENT'); ?>
                                                        </a></div>
                                                <?php else : ?>
                                                    <div><a class="uk-button uk-button-text" href="<?php echo $item->link . '#itemCommentsAnchor'; ?>">
                                                            <?php echo JText::_('K2_BE_THE_FIRST_TO_COMMENT'); ?>
                                                        </a></div>
                                                <?php endif; ?>
                                            <?php endif; ?>
                                        <?php endif; ?>

                                    </div>

                                    <?php if ($params->get('itemTags') && isset($item->tags) && count($item->tags) > 0) : ?>
                                        <div class="moduleItemTags">
                                            <ul class="uk-subnav uk-margin-top">
                                                <li><span uk-tooltip="title: <?php echo JText::_('K2_TAGGED_UNDER'); ?>"><i class="fas fa-tags" aria-hidden="true"></i></span></li>
                                                <?php foreach ($item->tags as $tag) : ?>
                                                    <li><a href="<?php echo $tag->link; ?>"><?php echo $tag->name; ?></a></li>
                                                <?php endforeach; ?>
                                            </ul>
                                        </div>
                                    <?php endif; ?>

                                    <!-- Plugins: AfterDisplay -->
                                    <?php echo $item->event->AfterDisplay; ?>

                                    <!-- K2 Plugins: K2AfterDisplay -->
                                    <?php echo $item->event->K2AfterDisplay; ?>

                                </div>
                            </div>

                        </li>

                    <?php endforeach; ?>
                </ul>
                <div class="uk-visible@m uk-slidenav-container uk-position-bottom-right">
                    <a class="el-slidenav" href="#" uk-slidenav-previous uk-slideshow-item="previous"></a>
                    <a class="el-slidenav" href="#" uk-slidenav-next uk-slideshow-item="next"></a>
                </div>

                <div class="uk-position-bottom-center uk-position-medium uk-light">
                    <ul class="el-nav uk-thumbnav uk-flex-nowrap uk-flex-center" uk-margin>

                        <?php foreach ($items as $key => $item) :  ?>

                            <li uk-slideshow-item="<?php echo $key; ?>">
                                <a href="#">
                                    <?php if ($params->get('itemImage') && !empty($item->image)) : ?>
                                        <img class="el-image" src="<?php echo $item->imageXSmall; ?>" alt="<?php echo K2HelperUtilities::cleanHtml($item->title); ?>" uk-img="target: !.uk-slideshow-items" uk-img />
                                    <?php endif; ?>
                                </a>
                            </li>
                        <?php endforeach; ?>
                    </ul>

                </div>
            </div>
        </div>
    <?php endif; ?>

    <?php if ($params->get('itemCustomLink')) : ?>
        <a class="moduleCustomLink" href="<?php echo $itemCustomLinkURL; ?>" title="<?php echo K2HelperUtilities::cleanHtml($itemCustomLinkTitle); ?>">
            <?php echo $itemCustomLinkTitle; ?>
        </a>
    <?php endif; ?>

</div>