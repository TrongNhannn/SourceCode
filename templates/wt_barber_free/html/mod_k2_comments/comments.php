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
    <div id="k2ModuleBox<?php echo $module->id; ?>" class="k2LatestCommentsBlock<?php if ($params->get('moduleclass_sfx')) echo ' ' . $params->get('moduleclass_sfx'); ?>">
    <?php else : ?>
        <div id="k2ModuleBox<?php echo $module->id; ?>" class="k2ModuleBox uk-card uk-card-default uk-card-body uk-margin">
        <?php endif; ?>

        <?php if ($params->get('feed')) : ?>
            <div class="uk-card-badge uk-position-top-right">
                <a href="<?php echo JRoute::_('index.php?option=com_k2&view=itemlist&format=feed&moduleID=' . $module->id); ?>" title="<?php echo JText::_('K2_SUBSCRIBE_TO_THIS_RSS_FEED'); ?>">
                    <span class="fas fa-rss-square" aria-hidden="true"></span>
                </a>
            </div>
        <?php endif; ?>

        <?php if (count($comments)) : ?>
            <div class="uk-child-width-1-1 uk-grid-small uk-grid-divider uk-grid-match uk-grid uk-grid-stack" uk-grid>
                <?php foreach ($comments as $key => $comment) :    ?>
                    <div>
                        <div class="el-item uk-panel uk-margin-remove-first-child">

                            <div class="uk-child-width-expand uk-grid-small uk-grid" uk-grid>

                                <?php if ($comment->userImage) : ?>
                                    <div class="uk-width-1-4 uk-first-column">

                                        <a class="uk-link-reset" href="<?php echo $comment->link; ?>" title="<?php echo K2HelperUtilities::cleanHtml($comment->commentText); ?>">
                                            <img class="el-image" src="<?php echo $comment->userImage; ?>" alt="<?php echo JFilterOutput::cleanText($comment->userName); ?>" />
                                        </a>

                                    </div>
                                <?php endif; ?>

                                <div class="uk-margin-remove-first-child">

                                    <?php if ($params->get('itemTitle')) : ?>
                                        <h3 class="el-title uk-h4 uk-margin-top uk-margin-remove-bottom"> <a href="<?php echo $comment->itemLink; ?>"><?php echo $comment->title; ?></a></h3>
                                    <?php endif; ?>

                                    <?php if ($params->get('commenterName') || $params->get('commentDate') || $params->get('itemCategory')) : ?>
                                        <div class="el-meta uk-text-meta uk-margin-small-top">

                                            <?php if ($params->get('commenterName')) : ?>
                                                <?php echo JText::_('K2_WRITTEN_BY'); ?>
                                                <?php if (isset($comment->userLink)) : ?>
                                                    <a class="uk-link-reset" rel="author" href="<?php echo $comment->userLink; ?>"><?php echo $comment->userName; ?></a>
                                                <?php elseif ($comment->commentURL) : ?>
                                                    <a class="uk-link-reset" target="_blank" rel="nofollow" href="<?php echo $comment->commentURL; ?>"><?php echo $comment->userName; ?></a>
                                                <?php else : ?>
                                                    <?php echo $comment->userName; ?>
                                                <?php endif; ?>
                                            <?php endif; ?>

                                            <?php if ($params->get('commentDateFormat') == 'relative') : ?>
                                                <?php echo $comment->commentDate; ?>
                                            <?php else : ?>
                                                <?php echo JText::_('K2_ON'); ?> <?php echo JHTML::_('date', $comment->commentDate, JText::_('K2_DATE_FORMAT_LC2')); ?>
                                            <?php endif; ?>

                                            <?php if ($params->get('itemCategory')) : ?>
                                                <span class="lcItemCategory"><?php echo JText::_('K2_PUBLISHED_IN'); ?> <a href="<?php echo $comment->catLink; ?>"><?php echo $comment->categoryname; ?></a></span>
                                            <?php endif; ?>

                                        </div>
                                    <?php endif; ?>

                                    <?php if ($params->get('commentLink')) : ?>
                                        <div class="uk-margin-small-top">
                                            <a class="uk-link-reset" href="<?php echo $comment->link; ?>"><span class="lcComment"><?php echo $comment->commentText; ?></span></a>
                                        </div>
                                    <?php else : ?>
                                        <div class="uk-margin-small-top">
                                            <span class="lcComment"><?php echo $comment->commentText; ?></span>
                                        </div>
                                    <?php endif; ?>

                                </div>

                            </div>

                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

    </div>