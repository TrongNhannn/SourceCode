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

<!-- K2 user register form -->
<?php if (isset($this->message)) $this->display('message'); ?>
<div class="tm-form-registration uk-flex uk-flex-center uk-flex-middle">
    <form action="<?php echo version_compare(JVERSION, '3.0', 'ge') ? JRoute::_('index.php?option=com_users&task=registration.register') : JURI::root(true) . '/index.php'; ?>" enctype="multipart/form-data" method="post" id="josForm" name="josForm" class="uk-form-horizontal uk-width-xlarge uk-background-muted uk-padding">
        <?php if ($this->params->def('show_page_title', 1)) : ?>
            <h2 class="componentheading<?php echo $this->escape($this->params->get('pageclass_sfx')); ?>">
                <?php echo $this->escape($this->params->get('page_title')); ?>
            </h2>
        <?php endif; ?>


        <div id="tm-k2Container" class="tm-k2AccountPage ">

            <h3 class="uk-heading-bullet uk-h3">
                <?php echo JText::_('K2_ACCOUNT_DETAILS'); ?>
            </h3>

            <div class="uk-margin">
                <label id="namemsg" class="uk-form-label" for="name"><?php echo JText::_('K2_NAME'); ?><span class="star">&nbsp;*</span></label>
                <div class="uk-form-controls">
                    <input type="text" name="<?php echo $this->nameFieldName; ?>" id="name" size="40" value="<?php echo $this->escape($this->user->get('name')); ?>" class="uk-input required" maxlength="50" />
                </div>
            </div>

            <div class="uk-margin">
                <label id="emailmsg" class="uk-form-label" for="email"><?php echo JText::_('K2_EMAIL'); ?><span class="star">&nbsp;*</span></label>
                <div class="uk-form-controls">
                    <input type="text" id="username" name="<?php echo $this->usernameFieldName; ?>" size="40" value="<?php echo $this->escape($this->user->get('username')); ?>" class="uk-input required validate-username" maxlength="25" />
                </div>
            </div>

            <div class="uk-margin">
                <label id="usernamemsg" class="uk-form-label" for="username"><?php echo JText::_('K2_USER_NAME'); ?><span class="star">&nbsp;*</span></label>
                <div class="uk-form-controls">
                    <input type="text" id="email" name="<?php echo $this->emailFieldName; ?>" size="40" value="<?php echo $this->escape($this->user->get('email')); ?>" class="uk-input required validate-email" maxlength="100" />
                </div>
            </div>

            <?php if (version_compare(JVERSION, '1.6', 'ge')) : ?>
                <div class="uk-margin">
                    <label id="email2msg" class="uk-form-label" for="email2"><?php echo JText::_('K2_CONFIRM_EMAIL'); ?><span class="star">&nbsp;*</span></label>
                    <div class="uk-form-controls">
                        <input type="text" id="email2" name="jform[email2]" size="40" value="" class="uk-input required validate-email" maxlength="100" />
                    </div>
                </div>
            <?php endif; ?>

            <div class="uk-margin">
                <label id="pwmsg" class="uk-form-label" for="password"><?php echo JText::_('K2_PASSWORD'); ?><span class="star">&nbsp;*</span></label>
                <div class="uk-form-controls">
                    <input class="uk-input required validate-password" type="password" id="password" name="<?php echo $this->passwordFieldName; ?>" size="40" value="" />
                </div>
            </div>

            <div class="uk-margin">
                <label id="pw2msg" class="uk-form-label" for="password2"><?php echo JText::_('K2_VERIFY_PASSWORD'); ?><span class="star">&nbsp;*</span></label>
                <div class="uk-form-controls">
                    <input class="uk-input required validate-passverify" type="password" id="password2" name="<?php echo $this->passwordVerifyFieldName; ?>" size="40" value="" />
                </div>
            </div>

            <h3 class="uk-heading-bullet uk-h3">
                <?php echo JText::_('K2_PERSONAL_DETAILS'); ?>
            </h3>

            <div class="uk-margin">
                <label id="gendermsg" class="uk-form-label" for="gender"><?php echo JText::_('K2_GENDER'); ?></label>
                <div class="uk-form-controls">
                    <?php echo $this->lists['gender']; ?>
                </div>
            </div>

            <div class="uk-margin">
                <label id="descriptionmsg" class="uk-form-label" for="description"><?php echo JText::_('K2_DESCRIPTION'); ?></label>
                <div class="uk-form-controls">
                    <?php echo $this->editor; ?>
                </div>
            </div>

            <div class="uk-margin">
                <label id="imagemsg" class="uk-form-label" for="image"><?php echo JText::_('K2_USER_IMAGE_AVATAR'); ?></label>

                <div class="uk-form-controls">
                    <input type="file" id="image" name="image" accept="image/*" />
                    <?php if ($this->K2User->image) : ?>
                        <img class="k2AdminImage" src="<?php echo JURI::root() . 'media/k2/users/' . $this->K2User->image; ?>" alt="<?php echo $this->user->name; ?>" />
                        <input type="uk-checkbox" name="del_image" id="del_image" />
                        <label class="uk-form-label" for="del_image"><?php echo JText::_('K2_CHECK_THIS_BOX_TO_DELETE_CURRENT_IMAGE_OR_JUST_UPLOAD_A_NEW_IMAGE_TO_REPLACE_THE_EXISTING_ONE'); ?></label>
                    <?php endif; ?>
                </div>
            </div>


            <div class="uk-margin">
                <label id="urlmsg" class="uk-form-label" for="url"><?php echo JText::_('K2_URL'); ?></label>
                <div class="uk-form-controls">
                    <input type="text" class="uk-input" size="50" value="<?php echo $this->K2User->url; ?>" name="url" id="url" />
                </div>
            </div>

            <?php if (count(array_filter($this->K2Plugins))) : ?>
                <!-- K2 Plugin attached fields -->
                <?php echo JText::_('K2_ADDITIONAL_DETAILS'); ?>
                <?php foreach ($this->K2Plugins as $K2Plugin) : ?>
                    <?php if (!is_null($K2Plugin)) : ?>
                        <?php echo $K2Plugin->fields; ?>
                    <?php endif; ?>
                <?php endforeach; ?>
            <?php endif; ?>

            <!-- Joomla 3.x JForm implementation -->
            <?php if (isset($this->form)) : ?>
                <div class="uk-margin">
                    <?php foreach ($this->form->getFieldsets() as $fieldset) : // Iterate through the form fieldsets and display each one.
                    ?>
                        <?php if ($fieldset->name != 'default') : ?>
                            <?php $fields = $this->form->getFieldset($fieldset->name); ?>
                            <?php if (isset($fields) && count($fields)) : ?>
                                <?php if (isset($fieldset->label)) : // If the fieldset has a label set, display it as the legend.
                                ?>
                                    <h3 class="uk-heading-bullet uk-h3">
                                        <?php echo JText::_($fieldset->label); ?>
                                    </h3>

                                <?php endif; ?>
                                <?php foreach ($fields as $field) : // Iterate through the fields in the set and display them.
                                ?>
                                    <?php if ($field->hidden) : // If the field is hidden, just display the input.
                                    ?>
                                        <?php echo $field->input; ?>
                                    <?php else : ?>
                                        <span class="uk-form-label"> <?php echo $field->label; ?>
                                            <?php if (!$field->required && $field->type != 'Spacer') : ?>
                                                <?php echo JText::_('COM_USERS_OPTIONAL'); ?>
                                            <?php endif; ?>
                                        </span>
                                        <div class="uk-form-controls">
                                            <?php echo $field->input; ?>
                                        </div>

                                    <?php endif; ?>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>

            <?php if ($this->K2Params->get('recaptchaOnRegistration') && $this->K2Params->get('recaptcha_public_key')) : ?>
                <?php if (!$this->K2Params->get('recaptchaV2')) : ?>
                    <label class="formRecaptcha uk-form-label"><?php echo JText::_('K2_ENTER_THE_TWO_WORDS_YOU_SEE_BELOW'); ?></label>
                <?php endif; ?>
                <div id="recaptcha" class="<?php echo $this->recaptchaClass; ?>"></div>
            <?php endif; ?>

            <div class="k2AccountPageNotice uk-margin"><?php echo JText::_('K2_REGISTER_REQUIRED'); ?></div>
            <div class="k2AccountPageUpdate">
                <button class="uk-button uk-button-primary validate" type="submit">
                    <?php echo JText::_('K2_REGISTER'); ?>
                </button>
            </div>

        </div>
        <input type="hidden" name="option" value="<?php echo $this->optionValue; ?>" />
        <input type="hidden" name="task" value="<?php echo $this->taskValue; ?>" />
        <input type="hidden" name="id" value="0" />
        <input type="hidden" name="gid" value="0" />
        <input type="hidden" name="K2UserForm" value="1" />
        <?php echo JHTML::_('form.token'); ?>
    </form>
</div>