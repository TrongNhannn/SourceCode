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

<?php if (JRequest::getInt('print') == 1) : ?>
    <!-- Print button at the top of the print page only -->
    <a class="itemPrintThisPage" rel="nofollow" href="#" onclick="window.print();return false;">
        <span><?php echo JText::_('K2_PRINT_THIS_PAGE'); ?></span>
    </a>
<?php endif; ?>

<!-- Start K2 Item Layout -->
<span id="startOfPageId<?php echo JRequest::getInt('id'); ?>"></span>

<div id="k2Container" class="itemView<?php echo ($this->item->featured) ? ' tm-itemIsFeatured' : ''; ?><?php if ($this->item->params->get('pageclass_sfx')) echo ' ' . $this->item->params->get('pageclass_sfx'); ?>">
    <!-- Plugins: BeforeDisplay -->
    <?php echo $this->item->event->BeforeDisplay; ?>

    <!-- K2 Plugins: K2BeforeDisplay -->
    <?php echo $this->item->event->K2BeforeDisplay; ?>

    <div class="el-itemHeader">

        <?php if ($this->item->params->get('itemTitle')) : ?>
            <!-- Item title -->
            <h2 class="el-title uk-margin-remove-bottom">

                <?php echo $this->item->title; ?>

                <?php if ($this->item->params->get('itemFeaturedNotice') && $this->item->featured) : ?>
                    <!-- Featured flag -->
                    <span class="uk-label uk-label-warning"><?php echo JText::_('K2_FEATURED'); ?></span>
                <?php endif; ?>
            </h2>
        <?php endif; ?>

        <p class="uk-margin-remove-bottom uk-article-meta uk-margin-top">

            <?php if ($this->item->params->get('itemAuthor')) : ?>
                <!-- Item Author -->

                <?php echo K2HelperUtilities::writtenBy($this->item->author->profile->gender); ?>
                <?php if (empty($this->item->created_by_alias)) : ?>
                    <a class="uk-link-reset" rel="author" href="<?php echo $this->item->author->link; ?>"><?php echo $this->item->author->name; ?></a>
                <?php else : ?>
                    <?php echo $this->item->author->name; ?>
                <?php endif; ?>

            <?php endif; ?>

            <?php if ($this->item->params->get('itemDateCreated')) : ?>

                <?php if ($this->item->params->get('itemAuthor')) : ?>
                    <?php echo JText::_('K2_TPL_WRITTEN_ON'); ?>
                <?php else : ?>
                    <?php echo JText::_('K2_WRITTEN_ON'); ?>
                <?php endif; ?>
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

    <?php if (
        $this->item->params->get('itemRating') ||
        $this->item->params->get('itemFontResizer') ||
        $this->item->params->get('itemPrintButton') ||
        $this->item->params->get('itemEmailButton') ||
        $this->item->params->get('itemSocialButton') ||
        ($this->item->params->get('itemVideoAnchor') && !empty($this->item->video)) ||
        ($this->item->params->get('itemImageGalleryAnchor') && !empty($this->item->gallery)) ||
        ($this->item->params->get('itemCommentsAnchor') && $this->item->params->get('itemComments') && $this->item->params->get('comments'))
    ) : ?>

        <div class="uk-margin-small-top uk-flex-middle uk-grid-small" uk-grid>


            <?php if ($this->item->params->get('itemRating')) : ?>
                <!-- Item Rating -->
                <div>
                    <div class="uk-text-meta">
                        <span><?php echo JText::_('K2_RATE_THIS_ITEM'); ?></span>
                        <div class="itemRatingForm">
                            <ul class="itemRatingList">
                                <li class="itemCurrentRating" id="itemCurrentRating<?php echo $this->item->id; ?>" style="width:<?php echo $this->item->votingPercentage; ?>%;"></li>
                                <li><a href="#" data-id="<?php echo $this->item->id; ?>" title="<?php echo JText::_('K2_1_STAR_OUT_OF_5'); ?>" class="one-star">1</a></li>
                                <li><a href="#" data-id="<?php echo $this->item->id; ?>" title="<?php echo JText::_('K2_2_STARS_OUT_OF_5'); ?>" class="two-stars">2</a></li>
                                <li><a href="#" data-id="<?php echo $this->item->id; ?>" title="<?php echo JText::_('K2_3_STARS_OUT_OF_5'); ?>" class="three-stars">3</a></li>
                                <li><a href="#" data-id="<?php echo $this->item->id; ?>" title="<?php echo JText::_('K2_4_STARS_OUT_OF_5'); ?>" class="four-stars">4</a></li>
                                <li><a href="#" data-id="<?php echo $this->item->id; ?>" title="<?php echo JText::_('K2_5_STARS_OUT_OF_5'); ?>" class="five-stars">5</a></li>
                            </ul>
                            <div id="itemRatingLog<?php echo $this->item->id; ?>" class="itemRatingLog"><?php echo $this->item->numOfvotes; ?></div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>

            <?php if (
                $this->item->params->get('itemFontResizer') ||
                $this->item->params->get('itemPrintButton') ||
                $this->item->params->get('itemEmailButton') ||
                $this->item->params->get('itemSocialButton') ||
                ($this->item->params->get('itemVideoAnchor') && !empty($this->item->video)) ||
                ($this->item->params->get('itemImageGalleryAnchor') && !empty($this->item->gallery)) ||
                ($this->item->params->get('itemCommentsAnchor') && $this->item->params->get('itemComments') && $this->item->params->get('comments'))
            ) : ?>

                <?php if ($this->item->params->get('itemRating')) : ?>
                    <div class="uk-margin-auto-left@s">
                    <?php else : ?>
                        <div>
                        <?php endif ?>

                        <div class="uk-grid-small uk-child-width-auto uk-flex-middle uk-grid-stack" uk-grid="margin: uk-margin-top">
                            <?php if ($this->item->params->get('itemFontResizer')) : ?>
                                <!-- Font Resizer -->
                                <div>
                                    <a href="#" id="fontDecrease" class="uk-icon-button" uk-tooltip="title: <?php echo JText::_('K2_DECREASE_FONT_SIZE'); ?>">
                                        <i class="fas fa-search-minus"></i>
                                    </a>
                                </div>

                                <div>
                                    <a href="#" id="fontIncrease" class="uk-icon-button" uk-tooltip="title: <?php echo JText::_('K2_INCREASE_FONT_SIZE'); ?>">
                                        <i class="fas fa-search-plus"></i>
                                    </a>
                                </div>
                            <?php endif; ?>

                            <?php if ($this->item->params->get('itemPrintButton') && !JRequest::getInt('print')) : ?>
                                <!-- Print Button -->
                                <div>
                                    <a class="itemPrintLink uk-icon-button" rel="nofollow" href="<?php echo $this->item->printLink; ?>" onclick="window.open(this.href,'printWindow','width=900,height=600,location=no,menubar=no,resizable=yes,scrollbars=yes'); return false;" uk-tooltip="title: <?php echo JText::_('K2_PRINT'); ?>">
                                        <i class="fas fa-print"></i>
                                    </a>
                                </div>
                            <?php endif; ?>

                            <?php if ($this->item->params->get('itemEmailButton') && !JRequest::getInt('print')) : ?>
                                <!-- Email Button -->
                                <div>
                                    <a class="itemEmailLink uk-icon-button" rel="nofollow" href="<?php echo $this->item->emailLink; ?>" onclick="window.open(this.href,'emailWindow','width=400,height=350,location=no,menubar=no,resizable=no,scrollbars=no'); return false;" uk-tooltip="title: <?php echo JText::_('K2_EMAIL'); ?>">
                                        <i class="far fa-envelope"></i>
                                    </a>
                                </div>
                            <?php endif; ?>

                            <?php if ($this->item->params->get('itemSocialButton') && !is_null($this->item->params->get('socialButtonCode', NULL))) : ?>
                                <!-- Item Social Button -->
                                <div>
                                    <?php echo $this->item->params->get('socialButtonCode'); ?>
                                </div>
                            <?php endif; ?>

                            <?php if ($this->item->params->get('itemVideoAnchor') && !empty($this->item->video)) : ?>
                                <!-- Anchor link to item video below - if it exists -->
                                <div>
                                    <a class="itemVideoLink k2Anchor uk-icon-button" href="<?php echo $this->item->link; ?>#itemVideoAnchor" uk-tooltip="title: <?php echo JText::_('K2_MEDIA'); ?>"><i class="fas fa-photo-video"></i></a>
                                </div>
                            <?php endif; ?>

                            <?php if ($this->item->params->get('itemImageGalleryAnchor') && !empty($this->item->gallery)) : ?>
                                <!-- Anchor link to item image gallery below - if it exists -->
                                <div>
                                    <a class="itemImageGalleryLink k2Anchor uk-icon-button" href="<?php echo $this->item->link; ?>#itemImageGalleryAnchor" uk-tooltip="title: <?php echo JText::_('K2_IMAGE_GALLERY'); ?>"><i class="far fa-images"></i></a>
                                </div>
                            <?php endif; ?>

                            <?php if ($this->item->params->get('itemCommentsAnchor') && $this->item->params->get('itemComments') && (($this->item->params->get('comments') == '2' && !$this->user->guest) || ($this->item->params->get('comments') == '1'))) : ?>
                                <!-- Anchor link to comments below - if enabled -->
                                <div>
                                    <?php if (!empty($this->item->event->K2CommentsCounter)) : ?>
                                        <!-- K2 Plugins: K2CommentsCounter -->
                                        <?php echo $this->item->event->K2CommentsCounter; ?>
                                    <?php else : ?>
                                        <?php if ($this->item->numOfComments > 0) : ?>
                                            <a class="k2Anchor uk-icon-button" href="<?php echo $this->item->link; ?>#itemCommentsAnchor" uk-tooltip="title: <?php echo $this->item->numOfComments; ?></span> <?php echo ($this->item->numOfComments > 1) ? JText::_('K2_COMMENTS') : JText::_('K2_COMMENT'); ?>">
                                                <i class="far fa-comments"></i><span>
                                            </a>
                                        <?php else : ?>
                                            <a class="k2Anchor uk-icon-button" href="<?php echo $this->item->link; ?>#itemCommentsAnchor" uk-tooltip="title: <?php echo JText::_('K2_BE_THE_FIRST_TO_COMMENT'); ?>"><i class="far fa-comments"></i></a>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                </div>
                            <?php endif; ?>
                        </div>
                        </div>
                    <?php endif; ?>

                    </div>


                <?php endif; ?>


                <div class="itemBody">
                    <!-- Plugins: BeforeDisplayContent -->
                    <?php echo $this->item->event->BeforeDisplayContent; ?>

                    <!-- K2 Plugins: K2BeforeDisplayContent -->
                    <?php echo $this->item->event->K2BeforeDisplayContent; ?>

                    <?php if ($this->item->params->get('itemImage') && !empty($this->item->image)) : ?>
                        <!-- Item Image -->
                        <div class="uk-margin-top" uk-lightbox="animation: slide">

                            <a href="<?php echo $this->item->imageXLarge; ?>" title="<?php echo JText::_('K2_CLICK_TO_PREVIEW_IMAGE'); ?>" data-caption="<?php if (!empty($this->item->image_caption)) echo K2HelperUtilities::cleanHtml($this->item->image_caption);
                                                                                                                                                            else echo K2HelperUtilities::cleanHtml($this->item->title); ?>">

                                <img src="<?php echo $this->item->image; ?>" alt="<?php if (!empty($this->item->image_caption)) echo K2HelperUtilities::cleanHtml($this->item->image_caption);
                                                                                    else echo K2HelperUtilities::cleanHtml($this->item->title); ?>" style="width:<?php echo $this->item->imageWidth; ?>px; height:auto;" />
                            </a>

                            <?php if ($this->item->params->get('itemImageMainCaption') && !empty($this->item->image_caption)) : ?>
                                <!-- Image caption -->
                                <span class="itemImageCaption"><?php echo $this->item->image_caption; ?></span>
                            <?php endif; ?>

                            <?php if ($this->item->params->get('itemImageMainCredits') && !empty($this->item->image_credits)) : ?>
                                <!-- Image credits -->
                                <span class="itemImageCredits"><?php echo $this->item->image_credits; ?></span>
                            <?php endif; ?>

                        </div>
                    <?php endif; ?>

                    <?php if (!empty($this->item->fulltext)) : ?>

                        <?php if ($this->item->params->get('itemIntroText')) : ?>
                            <!-- Item introtext -->
                            <div class="uk-text-lead uk-margin">
                                <?php echo $this->item->introtext; ?>
                            </div>
                        <?php endif; ?>

                        <?php if ($this->item->params->get('itemFullText')) : ?>
                            <!-- Item fulltext -->
                            <div class="el-content uk-margin-top">
                                <?php echo $this->item->fulltext; ?>
                            </div>
                        <?php endif; ?>

                    <?php else : ?>

                        <!-- Item text -->
                        <div class="el-content uk-margin-top">
                            <?php echo $this->item->introtext; ?>
                        </div>

                    <?php endif; ?>

                    <div class="clr"></div>

                    <?php if ($this->item->params->get('itemExtraFields') && isset($this->item->extra_fields) && count($this->item->extra_fields)) : ?>
                        <!-- Item extra fields -->
                        <div class="itemExtraFields">
                            <h3><?php echo JText::_('K2_ADDITIONAL_INFO'); ?></h3>
                            <ul>
                                <?php foreach ($this->item->extra_fields as $key => $extraField) : ?>
                                    <?php if ($extraField->value != '') : ?>
                                        <li class="<?php echo ($key % 2) ? "odd" : "even"; ?> type<?php echo ucfirst($extraField->type); ?> group<?php echo $extraField->group; ?> alias<?php echo ucfirst($extraField->alias); ?>">
                                            <?php if ($extraField->type == 'header') : ?>
                                                <h4 class="itemExtraFieldsHeader"><?php echo $extraField->name; ?></h4>
                                            <?php else : ?>
                                                <span class="itemExtraFieldsLabel"><?php echo $extraField->name; ?>:</span>
                                                <span class="itemExtraFieldsValue"><?php echo $extraField->value; ?></span>
                                            <?php endif; ?>
                                        </li>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </ul>
                            <div class="clr"></div>
                        </div>
                    <?php endif; ?>

                    <?php if ($this->item->params->get('itemHits') || ($this->item->params->get('itemDateModified') && intval($this->item->modified) != 0)) : ?>
                        <div class="uk-margin-top uk-flex-middle" uk-grid>

                            <?php if ($this->item->params->get('itemHits')) : ?>
                                <!-- Item Hits -->
                                <div class="itemHits uk-text-meta">
                                    <?php echo JText::_('K2_READ'); ?> <span class="uk-text-secondary uk-text-bold"><?php echo $this->item->hits; ?></span> <?php echo JText::_('K2_TIMES'); ?>
                                </div>
                            <?php endif; ?>


                            <?php if ($this->item->params->get('itemDateModified') && intval($this->item->modified) != 0) : ?>
                                <!-- Item date modified -->
                                <div class="uk-margin-auto-left@s">
                                    <span class="uk-text-meta uk-text-warning uk-text-italic">
                                        <?php echo JText::_('K2_LAST_MODIFIED_ON'); ?> <?php echo JHTML::_('date', $this->item->modified, JText::_('K2_DATE_FORMAT_LC2')); ?>
                                    </span>
                                </div>
                            <?php endif; ?>


                        </div>
                    <?php endif; ?>


                    <?php if (isset($this->item->editLink)) : ?>
                        <!-- Item edit link -->
                        <div class="uk-margin-top">
                            <a class="uk-button uk-button-secondary uk-button-small" data-k2-modal="edit" href="<?php echo $this->item->editLink; ?>"><i class="fas fa-pencil-alt"></i> <?php echo JText::_('K2_EDIT_ITEM'); ?></a>
                        </div>
                    <?php endif; ?>


                    <!-- Plugins: AfterDisplayContent -->
                    <?php echo $this->item->event->AfterDisplayContent; ?>

                    <!-- K2 Plugins: K2AfterDisplayContent -->
                    <?php echo $this->item->event->K2AfterDisplayContent; ?>

                    <div class="clr"></div>
                </div>


                <?php if (
                    $this->item->params->get('itemTwitterButton') ||
                    $this->item->params->get('itemFacebookButton') ||
                    $this->item->params->get('itemLinkedInButton')
                ) : ?>
                    <!-- Social sharing -->
                    <div class="itemSocialSharing uk-margin-top">
                        <?php if ($this->item->params->get('itemTwitterButton')) : ?>
                            <!-- Twitter Button -->
                            <div class="itemTwitterButton">
                                <a href="https://twitter.com/share" class="twitter-share-button" data-url="<?php echo $this->item->sharinglink; ?>" data-via="<?php if ($this->item->params->get('twitterUsername')) echo $this->item->params->get('twitterUsername'); ?>" data-related="<?php if ($this->item->params->get('twitterUsername')) echo $this->item->params->get('twitterUsername'); ?>" data-lang="<?php echo $this->item->langTagForTW; ?>" data-dnt="true" data-show-count="true">Tweet</a>
                                <script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
                            </div>
                        <?php endif; ?>

                        <?php if ($this->item->params->get('itemFacebookButton')) : ?>
                            <!-- Facebook Button -->
                            <div class="itemFacebookButton">
                                <div id="fb-root"></div>
                                <script async defer crossorigin="anonymous" src="https://connect.facebook.net/<?php echo $this->item->langTagForFB; ?>/sdk.js#xfbml=1&version=v3.3"></script>
                                <div class="fb-like" data-href="<?php echo $this->item->sharinglink; ?>" data-width="160" data-layout="button_count" data-action="like" data-size="small" data-show-faces="false" data-share="true"></div>
                            </div>
                        <?php endif; ?>

                        <?php if ($this->item->params->get('itemLinkedInButton')) : ?>
                            <!-- LinkedIn Button -->
                            <div class="itemLinkedInButton">
                                <script src="https://platform.linkedin.com/in.js" type="text/javascript">
                                    lang: <?php echo $this->item->langTagForLI; ?>
                                </script>
                                <script type="IN/Share" data-url="<?php echo $this->item->sharinglink; ?>"></script>
                            </div>
                        <?php endif; ?>

                    </div>
                <?php endif; ?>

                <?php if (
                    $this->item->params->get('itemCategory') ||
                    $this->item->params->get('itemTags') ||
                    $this->item->params->get('itemAttachments')
                ) : ?>
                    <div class="itemLinks">

                        <?php if ($this->item->params->get('itemTags') && isset($this->item->tags) && count($this->item->tags)) : ?>
                            <!-- Item tags -->
                            <div class="itemTagsBlock">
                                <ul class="uk-subnav uk-margin-top">
                                    <li><span uk-tooltip="title: <?php echo JText::_('K2_TAGGED_UNDER'); ?>"><i class="fas fa-tags" aria-hidden="true"></i></span></li>
                                    <?php foreach ($this->item->tags as $tag) : ?>
                                        <li><a href="<?php echo $tag->link; ?>"><?php echo $tag->name; ?></a></li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                        <?php endif; ?>

                        <?php if ($this->item->params->get('itemAttachments') && isset($this->item->attachments) && count($this->item->attachments)) : ?>
                            <!-- Item attachments -->
                            <div class="uk-alert">
                                <p class="el-title uk-h4 uk-margin-remove-bottom"><?php echo JText::_('K2_DOWNLOAD_ATTACHMENTS'); ?></p>
                                <ul class="uk-list">
                                    <?php foreach ($this->item->attachments as $attachment) : ?>
                                        <li>
                                            <a title="<?php echo ($attachment->titleAttribute) ? K2HelperUtilities::cleanHtml($attachment->titleAttribute) : K2HelperUtilities::cleanHtml($attachment->filename); ?>" href="<?php echo $attachment->link; ?>">
                                                <i class="fas fa-file-download"></i> <?php echo ($attachment->title) ? $attachment->title : $attachment->filename; ?>
                                            </a>
                                            <?php if ($this->item->params->get('itemAttachmentsCounter')) : ?>
                                                <span class="uk-text-danger">(<?php echo $attachment->hits; ?> <?php echo ($attachment->hits == 1) ? JText::_('K2_DOWNLOAD') : JText::_('K2_DOWNLOADS'); ?>)</span>
                                            <?php endif; ?>
                                        </li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                        <?php endif; ?>

                    </div>
                <?php endif; ?>

                <?php if ($this->item->params->get('itemNavigation') && !JRequest::getCmd('print') && (isset($this->item->nextLink) || isset($this->item->previousLink))) : ?>
                    <!-- Item navigation -->
                    <ul class="uk-pagination">
                        <?php if (isset($this->item->previousLink)) : ?>
                            <li><a class="previous-post" href="<?php echo $this->item->previousLink; ?>"><span uk-pagination-previous></span> <?php echo $this->item->previousTitle; ?></a></li>
                        <?php endif; ?>

                        <?php if (isset($this->item->nextLink)) : ?>
                            <li class="uk-margin-auto-left@s"><a class="next-post" href="<?php echo $this->item->nextLink; ?>"><?php echo $this->item->nextTitle; ?> <span uk-pagination-next></span></a></li>
                        <?php endif; ?>
                    </ul>
                <?php endif; ?>


                <?php if ($this->item->params->get('itemAuthorBlock') && empty($this->item->created_by_alias)) : ?>
                    <!-- Author Block -->
                    <hr class="uk-margin-medium-top">
                    <div class="itemAuthorDetails uk-margin">

                        <div class="uk-grid-medium uk-grid" uk-grid>
                            <div class="uk-width-auto@m">
                                <?php if ($this->item->params->get('itemAuthorImage') && !empty($this->item->author->avatar)) : ?>
                                    <img class="itemAuthorAvatar" src="<?php echo $this->item->author->avatar; ?>" alt="<?php echo K2HelperUtilities::cleanHtml($this->item->author->name); ?>" />
                                <?php endif; ?>

                            </div>
                            <div class="uk-width-expand@m">
                                <h4 class="el-title uk-h5 uk-margin-remove-bottom">
                                    <?php if ($this->item->params->get('itemAuthorURL') && !empty($this->item->author->profile->url)) : ?>
                                        <a rel="author" href="<?php echo $this->item->author->profile->url; ?>"><?php echo $this->item->author->name; ?></a>
                                    <?php else : ?>
                                        <a rel="author" href="<?php echo $this->item->author->link; ?>"><?php echo $this->item->author->name; ?></a>
                                    <?php endif; ?>
                                    <?php if ($this->item->params->get('itemAuthorEmail')) : ?>
                                        <span class="itemAuthorEmail">| <?php echo JHTML::_('Email.cloak', $this->item->author->email); ?></span>
                                    <?php endif; ?>
                                </h4>

                                <?php if ($this->item->params->get('itemAuthorDescription') && !empty($this->item->author->profile->description)) : ?>
                                    <div class="uk-panel"><?php echo $this->item->author->profile->description; ?></div>
                                <?php endif; ?>
                                <div class="uk-margin-small-top">
                                    <a class="author-link" href="<?php echo $this->item->author->link; ?>" rel="author"><?php echo JText::_('HU_K2_VIEW_ARCHIVE'); ?> <span aria-hidden="true">→</span> </a>
                                </div>
                            </div>
                        </div>
                        <!-- K2 Plugins: K2UserDisplay -->
                        <?php echo $this->item->event->K2UserDisplay; ?>

                    </div>

                    <hr>
                <?php endif; ?>

                <?php
                /*
    A note regarding 'Latest items from author'...
    The $item object in the foreach loop carries most item data, so if you wish to show the image of these items just echo $item->image.
    Do a var_dump($item) to see what's included with $item.
    */
                ?>
                <?php if ($this->item->params->get('itemAuthorLatest') && empty($this->item->created_by_alias) && isset($this->authorLatestItems)) : ?>
                    <!-- Latest items from author -->
                    <div class="itemAuthorLatest">
                        <h3 class="uk-h4 uk-margin-medium-top"><?php echo JText::_('K2_LATEST_FROM'); ?> <?php echo $this->item->author->name; ?></h3>
                        <ul class="uk-list">
                            <?php foreach ($this->authorLatestItems as $key => $item) : ?>
                                <li class="<?php echo ($key % 2) ? "odd" : "even"; ?>">
                                    <a href="<?php echo $item->link ?>"><?php echo $item->title; ?></a>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                <?php endif; ?>

                <?php
                /*
    A note regarding 'Related items by tag'...
    If you add:
    - the CSS rule 'overflow-x:scroll;' in the element div.itemRelated {…} in the k2.css
    - the class 'k2Scroller' to the ul element below
    - the classes 'k2ScrollerElement' and 'k2EqualHeights' to the li element inside the foreach loop below
    - the style attribute 'style="width:<?php echo $item->imageWidth; ?>px;"' to the li element inside the foreach loop below
    ...then your Related Items will be transformed into a vertical-scrolling block, inside which, all items have the same height (equal column heights). This can be very useful if you want to show your related articles or products with title/author/category/image etc., which would take a significant amount of space in the classic list-style display.
    */
                ?>
                <?php if ($this->item->params->get('itemRelated') && isset($this->relatedItems)) : ?>
                    <!-- Related items by tag -->
                    <div class="itemRelated">
                        <h3 class="uk-h4 uk-margin-medium-top"><?php echo JText::_("K2_RELATED_ITEMS_BY_TAG"); ?></h3>
                        <ul class="uk-list">
                            <?php foreach ($this->relatedItems as $key => $item) : ?>
                                <li class="<?php echo ($key % 2) ? "odd" : "even"; ?>">
                                    <?php if ($this->item->params->get('itemRelatedTitle', 1)) : ?>
                                        <a class="itemRelTitle" href="<?php echo $item->link ?>"><?php echo $item->title; ?></a>
                                    <?php endif; ?>

                                    <?php if ($this->item->params->get('itemRelatedCategory')) : ?>
                                        <div class="itemRelCat"><?php echo JText::_("K2_IN"); ?> <a href="<?php echo $item->category->link ?>"><?php echo $item->category->name; ?></a></div>
                                    <?php endif; ?>

                                    <?php if ($this->item->params->get('itemRelatedAuthor')) : ?>
                                        <div class="itemRelAuthor"><?php echo JText::_("K2_BY"); ?> <a rel="author" href="<?php echo $item->author->link; ?>"><?php echo $item->author->name; ?></a></div>
                                    <?php endif; ?>

                                    <?php if($this->item->params->get('itemRelatedImageSize') && !empty($item->image)): ?>
                                        <img style="width:<?php echo $item->imageWidth; ?>px;height:auto;" class="itemRelImg" src="<?php echo $item->image; ?>" alt="<?php echo K2HelperUtilities::cleanHtml($item->title); ?>" />
                                    <?php endif; ?>

                                    <?php if ($this->item->params->get('itemRelatedIntrotext')) : ?>
                                        <div class="itemRelIntrotext"><?php echo $item->introtext; ?></div>
                                    <?php endif; ?>

                                    <?php if ($this->item->params->get('itemRelatedFulltext')) : ?>
                                        <div class="itemRelFulltext"><?php echo $item->fulltext; ?></div>
                                    <?php endif; ?>

                                    <?php if ($this->item->params->get('itemRelatedMedia')) : ?>
                                        <?php if ($item->videoType == 'embedded') : ?>
                                            <div class="itemRelMediaEmbedded"><?php echo $item->video; ?></div>
                                        <?php else : ?>
                                            <div class="itemRelMedia"><?php echo $item->video; ?></div>
                                        <?php endif; ?>
                                    <?php endif; ?>

                                    <?php if ($this->item->params->get('itemRelatedImageGallery')) : ?>
                                        <div class="itemRelImageGallery"><?php echo $item->gallery; ?></div>
                                    <?php endif; ?>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                <?php endif; ?>

                <?php if ($this->item->params->get('itemVideo') && !empty($this->item->video)) : ?>
                    <!-- Item video -->
                    <a name="itemVideoAnchor" id="itemVideoAnchor"></a>
                    <div class="uk-panel">
                        <h3 class="uk-h4 uk-margin-top"><?php echo JText::_('K2_MEDIA'); ?></h3>

                        <?php if ($this->item->videoType == 'embedded') : ?>
                            <div class="itemVideoEmbedded">
                                <?php echo $this->item->video; ?>
                            </div>
                        <?php else : ?>
                            <span class="itemVideo"><?php echo $this->item->video; ?></span>
                        <?php endif; ?>

                        <?php if ($this->item->params->get('itemVideoCaption') && !empty($this->item->video_caption)) : ?>
                            <span class="itemVideoCaption"><?php echo $this->item->video_caption; ?></span>
                        <?php endif; ?>

                        <?php if ($this->item->params->get('itemVideoCredits') && !empty($this->item->video_credits)) : ?>
                            <span class="itemVideoCredits"><?php echo $this->item->video_credits; ?></span>
                        <?php endif; ?>

                    </div>
                <?php endif; ?>

                <?php if ($this->item->params->get('itemImageGallery') && !empty($this->item->gallery)) : ?>
                    <!-- Item image gallery -->
                    <a name="itemImageGalleryAnchor" id="itemImageGalleryAnchor"></a>
                    <div class="itemImageGallery">
                        <h3><?php echo JText::_('K2_IMAGE_GALLERY'); ?></h3>
                        <?php echo $this->item->gallery; ?>
                    </div>
                <?php endif; ?>

                <!-- Plugins: AfterDisplay -->
                <?php echo $this->item->event->AfterDisplay; ?>

                <!-- K2 Plugins: K2AfterDisplay -->
                <?php echo $this->item->event->K2AfterDisplay; ?>

                <?php if (
                    $this->item->params->get('itemComments') &&
                    (($this->item->params->get('comments') == '2' && !$this->user->guest) || ($this->item->params->get('comments') == '1'))
                ) : ?>
                    <!-- K2 Plugins: K2CommentsBlock -->
                    <?php echo $this->item->event->K2CommentsBlock; ?>
                <?php endif; ?>

                <?php if (
                    $this->item->params->get('itemComments') &&
                    ($this->item->params->get('comments') == '1' || ($this->item->params->get('comments') == '2')) && empty($this->item->event->K2CommentsBlock)
                ) : ?>
                    <!-- Item comments -->
                    <a name="itemCommentsAnchor" id="itemCommentsAnchor"></a>
                    <div class="tm-itemComments">
                        <?php if ($this->item->params->get('commentsFormPosition') == 'above' && $this->item->params->get('itemComments') && !JRequest::getInt('print') && ($this->item->params->get('comments') == '1' || ($this->item->params->get('comments') == '2' && K2HelperPermissions::canAddComment($this->item->catid)))) : ?>
                            <!-- Item comments form -->
                            <div class="itemCommentsForm">
                                <?php echo $this->loadTemplate('comments_form'); ?>
                            </div>
                        <?php endif; ?>

                        <?php if ($this->item->numOfComments > 0 && $this->item->params->get('itemComments') && ($this->item->params->get('comments') == '1' || ($this->item->params->get('comments') == '2'))) : ?>
                            <!-- Item user comments -->
                            <h3 class="uk-h4 uk-margin-medium-top">
                                <span><?php echo $this->item->numOfComments; ?></span> <?php echo ($this->item->numOfComments > 1) ? JText::_('K2_COMMENTS') : JText::_('K2_COMMENT'); ?>
                            </h3>

                            <ul class="uk-comment-list">
                                <?php foreach ($this->item->comments as $key => $comment) : ?>

                                    <li class="<?php echo ($key % 2) ? "odd" : "even";
                                                echo (!$this->item->created_by_alias && $comment->userID == $this->item->created_by) ? " uk-comment-primary" : "";
                                                echo ($comment->published) ? '' : ' unpublishedComment'; ?>">
                                        <article class="uk-comment">
                                            <header class="uk-comment-header uk-grid-medium uk-flex-middle uk-grid" uk-grid>
                                                <?php if ($comment->userImage) : ?>
                                                    <div class="uk-width-auto uk-first-column">
                                                        <img class="uk-comment-avatar uk-border-circle" src="<?php echo $comment->userImage; ?>" alt="<?php echo JFilterOutput::cleanText($comment->userName); ?>" width="<?php echo $this->item->params->get('commenterImgWidth'); ?>" />
                                                    </div>
                                                <?php endif; ?>

                                                <div class="uk-width-expand">
                                                    <h4 class="uk-comment-title uk-margin-remove">

                                                        <?php if (!empty($comment->userLink)) : ?>
                                                            <a class="uk-link-reset" href="<?php echo JFilterOutput::cleanText($comment->userLink); ?>" title="<?php echo JFilterOutput::cleanText($comment->userName); ?>" target="_blank" rel="nofollow"><?php echo $comment->userName; ?></a>
                                                        <?php else : ?>
                                                            <?php echo $comment->userName; ?>
                                                        <?php endif; ?>
                                                    </h4>
                                                    <ul class="uk-comment-meta uk-subnav uk-subnav-divider uk-margin-remove-top">
                                                        <li><?php echo JHTML::_('date', $comment->commentDate, JText::_('K2_DATE_FORMAT_LC2')); ?></li>
                                                        <li>
                                                            <a href="<?php echo $this->item->link; ?>#comment<?php echo $comment->id; ?>" name="comment<?php echo $comment->id; ?>" id="comment<?php echo $comment->id; ?>" uk-scroll>
                                                                <?php echo JText::_('K2_COMMENT_LINK'); ?>
                                                            </a></li>
                                                    </ul>
                                                </div>
                                            </header>
                                            <div class="uk-comment-body">
                                                <?php echo $comment->commentText; ?>
                                            </div>

                                            <?php if (
                                                $this->inlineCommentsModeration ||
                                                ($comment->published && ($this->params->get('commentsReporting') == '1' || ($this->params->get('commentsReporting') == '2' && !$this->user->guest)))
                                            ) : ?>
                                                <ul class="uk-margin-top uk-subnav">
                                                    <?php if ($this->inlineCommentsModeration) : ?>
                                                        <?php if (!$comment->published) : ?>
                                                            <li><a class="commentApproveLink" href="<?php echo JRoute::_('index.php?option=com_k2&view=comments&task=publish&commentID=' . $comment->id . '&format=raw') ?>"><?php echo JText::_('K2_APPROVE') ?></a></li>
                                                        <?php endif; ?>

                                                        <li><a class="commentRemoveLink" href="<?php echo JRoute::_('index.php?option=com_k2&view=comments&task=remove&commentID=' . $comment->id . '&format=raw') ?>"><?php echo JText::_('K2_REMOVE') ?></a></li>
                                                    <?php endif; ?>

                                                    <?php if ($comment->published && ($this->params->get('commentsReporting') == '1' || ($this->params->get('commentsReporting') == '2' && !$this->user->guest))) : ?>
                                                        <li><a data-k2-modal="iframe" href="<?php echo JRoute::_('index.php?option=com_k2&view=comments&task=report&commentID=' . $comment->id) ?>"><?php echo JText::_('K2_REPORT') ?></a></li>
                                                    <?php endif; ?>

                                                    <?php if ($comment->reportUserLink) : ?>
                                                        <li><a class="k2ReportUserButton" href="<?php echo $comment->reportUserLink; ?>"><?php echo JText::_('K2_FLAG_AS_SPAMMER'); ?></a></li>
                                                    <?php endif; ?>
                                                </ul>
                                            <?php endif; ?>

                                        </article>
                                    </li>
                                <?php endforeach; ?>
                            </ul>

                            <!-- Comments Pagination -->
                            <div class="itemCommentsPagination">
                                <?php echo $this->pagination->getPagesLinks(); ?>
                                <div class="clr"></div>
                            </div>
                        <?php endif; ?>

                        <?php if (
                            $this->item->params->get('commentsFormPosition') == 'below' &&
                            $this->item->params->get('itemComments') &&
                            !JRequest::getInt('print') &&
                            ($this->item->params->get('comments') == '1' || ($this->item->params->get('comments') == '2' && K2HelperPermissions::canAddComment($this->item->catid)))
                        ) : ?>
                            <!-- Item comments form -->
                            <div class="itemCommentsForm">
                                <?php echo $this->loadTemplate('comments_form'); ?>
                            </div>
                        <?php endif; ?>

                        <?php $user = JFactory::getUser();
                        if ($this->item->params->get('comments') == '2' && $user->guest) : ?>
                            <div class="itemCommentsLoginFirst"><?php echo JText::_('K2_LOGIN_TO_POST_COMMENTS'); ?></div>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>

                <?php if (!JRequest::getCmd('print')) : ?>
                    <div class="itemBackToTop">
                        <a class="k2Anchor" href="<?php echo $this->item->link; ?>#startOfPageId<?php echo JRequest::getInt('id'); ?>">
                            <?php echo JText::_('K2_BACK_TO_TOP'); ?> <i class="fas fa-chevron-up"></i>
                        </a>
                    </div>
                <?php endif; ?>

                <div class="clr"></div>
        </div>
        <!-- End K2 Item Layout -->