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
<?php if($params->get('moduleclass_sfx')): ?>
<div id="k2ModuleBox<?php echo $module->id; ?>" class="k2LoginBlock<?php if ($params->get('moduleclass_sfx')) echo ' '.$params->get('moduleclass_sfx'); ?>">
<?php else: ?>
<div id="k2ModuleBox<?php echo $module->id; ?>" class="k2ModuleBox uk-card uk-card-default uk-card-body">     
<?php endif; ?>    

    <form action="<?php echo JRoute::_('index.php', true, $params->get('usesecure')); ?>" method="post" name="login" id="form-login">
        <?php if ($params->get('pretext')): ?>
        <p class="preText"><?php echo $params->get('pretext'); ?></p>
        <?php endif; ?>

        <fieldset class="uk-fieldset">
            <div class="uk-margin">
                <input id="modlgn_username" type="text" name="username" class="uk-input" size="18" placeholder="<?php echo JText::_('K2_USERNAME') ?>" />
            </div>
            <div class="uk-margin">
                <input id="modlgn_passwd" type="password" name="<?php echo $passwordFieldName; ?>" class="uk-input" size="18" placeholder="<?php echo JText::_('K2_PASSWORD') ?>" />
            </div>

            <?php if (JPluginHelper::isEnabled('system', 'remember')): ?>
            <label class="uk-form-label" for="modlgn_remember">
            <input id="modlgn_remember" type="checkbox" name="remember" class="uk-checkbox" value="yes" />
            <?php echo JText::_('K2_REMEMBER_ME') ?>
            </label>
            <?php endif; ?>
            <div class="uk-margin-small">
            <input type="submit" name="Submit" class="uk-button uk-button-primary" value="<?php echo JText::_('K2_LOGIN') ?>" />
            </div>
        </fieldset>

        <ul class="uk-list uk-margin-remove-bottom">
            <li><a href="<?php echo $resetLink; ?>"><?php echo JText::_('K2_FORGOT_YOUR_PASSWORD'); ?></a></li>
            <li><a href="<?php echo $remindLink ?>"><?php echo JText::_('K2_FORGOT_YOUR_USERNAME'); ?></a></li>
            <?php if ($usersConfig->get('allowUserRegistration')): ?>
            <li><a href="<?php echo $registrationLink; ?>"><?php echo JText::_('K2_CREATE_AN_ACCOUNT'); ?></a></li>
            <?php endif; ?>
        </ul>

        <?php if ($params->get('posttext')): ?>
        <p class="postText"><?php echo $params->get('posttext'); ?></p>
        <?php endif; ?>

        <input type="hidden" name="option" value="<?php echo $option; ?>" />
        <input type="hidden" name="task" value="<?php echo $task; ?>" />
        <input type="hidden" name="return" value="<?php echo $return; ?>" />
        <?php echo JHTML::_('form.token'); ?>
    </form>
</div>
