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

<!-- Comments Form -->
<h3 class="uk-h4 uk-margin-medium-top"><?php echo JText::_('K2_LEAVE_A_COMMENT') ?></h3>

<?php if ($this->params->get('commentsFormNotes')) : ?>
    <p class="uk-text-meta">
        <?php if ($this->params->get('commentsFormNotesText')) : ?>
            <?php echo nl2br($this->params->get('commentsFormNotesText')); ?>
        <?php else : ?>
            <?php echo JText::_('K2_COMMENT_FORM_NOTES') ?>
        <?php endif; ?>
    </p>
<?php endif; ?>

<form action="<?php echo JURI::root(true); ?>/index.php" method="post" id="comment-form" class="form-validate">
    <label class="formComment uk-form-label" for="commentText"><?php echo JText::_('K2_MESSAGE'); ?> *</label>
    <textarea rows="5" cols="10" class="uk-textarea" onblur="if(this.value=='') this.value='<?php echo JText::_(''); ?>';" onfocus="if(this.value=='<?php echo JText::_('K2_ENTER_YOUR_MESSAGE_HERE'); ?>') this.value='';" name="commentText" id="commentText"><?php echo JText::_(''); ?></textarea>

    <label class="formName uk-form-label" for="userName"><?php echo JText::_('K2_NAME'); ?> *</label>
    <input class="uk-input" type="text" name="userName" id="userName" value="<?php echo JText::_(''); ?>" onblur="if(this.value=='') this.value='<?php echo JText::_(''); ?>';" onfocus="if(this.value=='<?php echo JText::_('K2_ENTER_YOUR_NAME'); ?>') this.value='';" />

    <label class="formEmail uk-form-label" for="commentEmail"><?php echo JText::_('K2_EMAIL'); ?> *</label>
    <input class="uk-input" type="text" name="commentEmail" id="commentEmail" value="<?php echo JText::_(''); ?>" onblur="if(this.value=='') this.value='<?php echo JText::_(''); ?>';" onfocus="if(this.value=='<?php echo JText::_('K2_ENTER_YOUR_EMAIL_ADDRESS'); ?>') this.value='';" />

    <label class="formUrl uk-form-label" for="commentURL"><?php echo JText::_('K2_WEBSITE_URL'); ?></label>
    <input class="uk-input" type="text" name="commentURL" id="commentURL" value="<?php echo JText::_(''); ?>" onblur="if(this.value=='') this.value='<?php echo JText::_(''); ?>';" onfocus="if(this.value=='<?php echo JText::_('K2_ENTER_YOUR_SITE_URL'); ?>') this.value='';" />

    <?php if ($this->params->get('recaptcha') && ($this->user->guest || $this->params->get('recaptchaForRegistered', 1))) : ?>
        <?php if (!$this->params->get('recaptchaV2')) : ?>
            <label class="formRecaptcha uk-form-label"><?php echo JText::_('K2_ENTER_THE_TWO_WORDS_YOU_SEE_BELOW'); ?></label>
        <?php endif; ?>
        <div id="recaptcha" class="<?php echo $this->recaptchaClass; ?>"></div>
    <?php endif; ?>

    <input type="submit" class="uk-button uk-button-primary uk-margin" value="<?php echo JText::_('K2_SUBMIT_COMMENT'); ?>" />

    <span id="formLog"></span>

    <input type="hidden" name="option" value="com_k2" />
    <input type="hidden" name="view" value="item" />
    <input type="hidden" name="task" value="comment" />
    <input type="hidden" name="itemID" value="<?php echo JRequest::getInt('id'); ?>" />
    <?php echo JHTML::_('form.token'); ?>
</form>