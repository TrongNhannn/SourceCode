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
    <div id="k2ModuleBox<?php echo $module->id; ?>" class="k2TopCommentersBlock<?php if ($params->get('moduleclass_sfx')) echo ' ' . $params->get('moduleclass_sfx'); ?>">
    <?php else : ?>
        <div id="k2ModuleBox<?php echo $module->id; ?>" class="k2ModuleBox uk-card uk-card-default uk-card-body uk-margin">
        <?php endif; ?>

        <?php if (count($commenters)) : ?>
            <div class="uk-child-width-1-1 uk-grid-small uk-grid-divider uk-grid-match uk-grid uk-grid-stack" uk-grid>
                <?php foreach ($commenters as $key => $commenter) : ?>
                    <div>

                        <div class="el-item uk-panel uk-margin-remove-first-child">

                            <div class="uk-child-width-expand uk-grid" uk-grid>

                                <?php if ($commenter->userImage) : ?>
                                    <div class="uk-width-1-4">
                                        <a class="uk-link-reset" rel="author" href="<?php echo $commenter->link; ?>">
                                            <img class="el-image" src="<?php echo $commenter->userImage; ?>" alt="<?php echo JFilterOutput::cleanText($commenter->userName); ?>" />
                                        </a>
                                    </div>
                                <?php endif; ?>

                                <div class="uk-margin-remove-first-child">

                                    <?php if ($params->get('commenterLink')) : ?>
                                        <a class="tcLink" rel="author" href="<?php echo $commenter->link; ?>">
                                        <?php endif; ?>
                                        <span class="tcUsername"><?php echo $commenter->userName; ?></span>

                                        <?php if ($params->get('commenterCommentsCounter')) : ?>
                                            <span class="tcCommentsCounter">(<?php echo $commenter->counter; ?>)</span>
                                        <?php endif; ?>
                                        <?php if ($params->get('commenterLink')) : ?>
                                        </a>
                                    <?php endif; ?>

                                    <?php if ($params->get('commenterLatestComment')) : ?>
                                        <a class="uk-link-reset" href="<?php echo $commenter->latestCommentLink; ?>">
                                            <?php echo $commenter->latestCommentText; ?>
                                        </a>
                                        <span class="tcLatestCommentDate"><?php echo JText::_('K2_POSTED_ON'); ?> <?php echo JHTML::_('date', $commenter->latestCommentDate, JText::_('K2_DATE_FORMAT_LC2')); ?></span>
                                    <?php endif; ?>

                                    <div class="el-meta uk-text-meta uk-margin-small-top"><span class="tcLatestCommentDate"><?php echo JText::_('K2_POSTED_ON'); ?> <?php echo JHTML::_('date', $commenter->latestCommentDate, JText::_('K2_DATE_FORMAT_LC2')); ?></span></div>

                                </div>
                            </div>

                        </div>

                        <div>
                        <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                    </div>