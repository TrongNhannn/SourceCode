<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_contact
 *
 * @copyright   Copyright (C) 2005 - 2020 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

$tparams = $this->item->params;
?>

<div class="contact<?php echo $this->pageclass_sfx; ?>" itemscope itemtype="https://schema.org/Person">
	<?php if ($tparams->get('show_page_heading')) : ?>
		<h1>
			<?php echo $this->escape($tparams->get('page_heading')); ?>
		</h1>
	<?php endif; ?>

	<?php if ($this->contact->name && $tparams->get('show_name')) : ?>
		<div class="page-header">
			<h2>
				<?php if ($this->item->published == 0) : ?>
					<span class="label label-warning"><?php echo JText::_('JUNPUBLISHED'); ?></span>
				<?php endif; ?>
				<span class="contact-name" itemprop="name"><?php echo $this->contact->name; ?></span>
			</h2>
		</div>
	<?php endif; ?>

	<?php $presentation_style = $tparams->get('presentation_style'); ?>
	<?php $accordionStarted = false; ?>
	<?php $tabSetStarted = false; ?>

	<?php if ($presentation_style === 'sliders') : ?>
	<?php echo $this->item->event->afterDisplayTitle; ?>

	<?php echo $this->item->event->beforeDisplayContent; ?>

	<ul uk-accordion>
		<?php if ($this->params->get('show_info', 1)) : ?>
		<li class="uk-open">
		<a class="uk-accordion-title" href="#"><?php echo JText::_('COM_CONTACT_DETAILS');?></a>	

		<div class="uk-accordion-content">
			<?php if ($this->contact->image && $tparams->get('show_image')) : ?>
				<div class="thumbnail pull-right">
				<?php echo JHtml::_('image', $this->contact->image, $this->contact->name, array('itemprop' => 'image')); ?>
				</div>
			<?php endif; ?>

			<?php if ($this->contact->con_position && $tparams->get('show_position')) : ?>
				<dl class="contact-position dl-horizontal">
				<dt><?php echo JText::_('COM_CONTACT_POSITION'); ?>:</dt>
				<dd itemprop="jobTitle">
					<?php echo $this->contact->con_position; ?>
				</dd>
				</dl>
			<?php endif; ?>

			<?php echo $this->loadTemplate('address'); ?>

			<?php if ($tparams->get('allow_vcard')) : ?>
			<div class="uk-margin">
				<?php echo JText::_('COM_CONTACT_DOWNLOAD_INFORMATION_AS'); ?>
				<a class="uk-link-reset" href="<?php echo JRoute::_('index.php?option=com_contact&amp;view=contact&amp;id=' . $this->contact->id . '&amp;format=vcf'); ?>">
				<?php echo JText::_('COM_CONTACT_VCARD'); ?></a>
			</div>
			<?php endif; ?>

			<?php if ($tparams->get('show_tags', 1) && !empty($this->item->tags->itemTags)) : ?>
				<?php $this->item->tagLayout = new JLayoutFile('joomla.content.tags'); ?>
				<?php echo $this->item->tagLayout->render($this->item->tags->itemTags); ?>
			<?php endif; ?>
		</div>

		</li>

		<?php endif; ?> 

		<?php if ($tparams->get('show_email_form') && ($this->contact->email_to || $this->contact->user_id)) : ?>
		<li>
			<a class="uk-accordion-title" href="#"><?php echo JText::_('COM_CONTACT_EMAIL_FORM');?></a>
			<div class="uk-accordion-content">
			<div class="card-body clearfix">
				<?php echo $this->loadTemplate('form'); ?>
			</div>
			</div>
		</li>
		<?php endif; ?> 

		<?php if ($tparams->get('show_links')) : ?>
			<?php echo $this->loadTemplate('links'); ?>
		<?php endif; ?>

		<?php if ($tparams->get('show_articles') && $this->contact->user_id && $this->contact->articles) : ?>	
		<li>
		<a class="uk-accordion-title" href="#"><?php echo JText::_('JGLOBAL_ARTICLES');?></a>
		<div class="uk-accordion-content">
			<?php echo $this->loadTemplate('articles'); ?>
		</div>
		</li>
		<?php endif; ?> 

		<?php if ($tparams->get('show_profile') && $this->contact->user_id && JPluginHelper::isEnabled('user', 'profile')) : ?>
		<li>
		<div class="card-header">
		<a class="uk-accordion-title" href="#"><?php echo JText::_('COM_CONTACT_PROFILE');?></a>
		<div class="uk-accordion-content">
			<?php echo $this->loadTemplate('profile'); ?>
		</div>
		</li>
		<?php endif; ?> 

		<?php if ($tparams->get('show_user_custom_fields') && $this->contactUser) : ?>
		<?php echo $this->loadTemplate('user_custom_fields'); ?>
		<?php endif; ?>

		<?php if ($this->contact->misc && $tparams->get('show_misc')) : ?>
		<li>
		<a class="uk-accordion-title" href="#"><?php echo JText::_('COM_CONTACT_OTHER_INFORMATION');?></a>
		<div class="uk-accordion-content">
			<?php echo $this->contact->misc; ?>
		</div>
		</li>
		<?php endif; ?>  

		</ul>
	<?php endif; ?>

	<?php if ($presentation_style === 'tabs') : ?>	
	<ul uk-tab>
	<?php if ($this->params->get('show_info', 1)) : ?>
		<li><a href="#"><?php echo JText::_('COM_CONTACT_DETAILS');?></a></li>
	<?php endif; ?>
	<?php if ($tparams->get('show_email_form') && ($this->contact->email_to || $this->contact->user_id)) : ?>
		<li><a href="#"><?php echo JText::_('COM_CONTACT_EMAIL_FORM');?></a></li>
	<?php endif; ?>
	<?php if ($tparams->get('show_articles') && $this->contact->user_id && $this->contact->articles) : ?>
		<li><a href="#"><?php echo JText::_('JGLOBAL_ARTICLES');?></a></li>
	<?php endif; ?>
	<?php if ($tparams->get('show_links')) : ?>
		<li><a href="#"><?php echo JText::_('COM_CONTACT_LINKS');?></a></li>
	<?php endif; ?>
	<?php if ($tparams->get('show_profile') && $this->contact->user_id && JPluginHelper::isEnabled('user', 'profile')) : ?>
		<li><a href="#"><?php echo JText::_('COM_CONTACT_PROFILE');?></a></li>
	<?php endif; ?>
	<?php if ($this->contact->misc && $tparams->get('show_misc')) : ?>
		<li><a href="#"><?php echo JText::_('COM_CONTACT_OTHER_INFORMATION');?></a></li>
	<?php endif; ?>
	</ul>

	<ul class="uk-switcher uk-margin">
	<?php if ($this->params->get('show_info', 1)) : ?>
		<li>
			<?php if ($this->contact->image && $tparams->get('show_image')) : ?>
				<div class="thumbnail">
					<?php echo JHtml::_('image', $this->contact->image, htmlspecialchars($this->contact->name,  ENT_QUOTES, 'UTF-8'), array('itemprop' => 'image')); ?>
				</div>
			<?php endif; ?>

			<?php if ($this->contact->con_position && $tparams->get('show_position')) : ?>
				<dl class="contact-position dl-horizontal">
				<dt><?php echo JText::_('COM_CONTACT_POSITION'); ?>:</dt>
				<dd itemprop="jobTitle">
					<?php echo $this->contact->con_position; ?>
				</dd>
				</dl>
			<?php endif; ?>

			<?php echo $this->loadTemplate('address'); ?>

			<?php if ($tparams->get('allow_vcard')) : ?>
				<div class="uk-margin">
				<?php echo JText::_('COM_CONTACT_DOWNLOAD_INFORMATION_AS'); ?>
				<a class="uk-link-reset" href="<?php echo JRoute::_('index.php?option=com_contact&amp;view=contact&amp;id=' . $this->contact->id . '&amp;format=vcf'); ?>">
				<?php echo JText::_('COM_CONTACT_VCARD'); ?></a>
				</div>
			<?php endif; ?>

			<?php if ($tparams->get('show_tags', 1) && !empty($this->item->tags->itemTags)) : ?>
				<?php $this->item->tagLayout = new JLayoutFile('joomla.content.tags'); ?>
				<?php echo $this->item->tagLayout->render($this->item->tags->itemTags); ?>
			<?php endif; ?>				
		</li>
	<?php endif; ?>
	<?php if ($tparams->get('show_email_form') && ($this->contact->email_to || $this->contact->user_id)) : ?>
		<li>
			<?php echo $this->loadTemplate('form'); ?>
		</li>
	<?php endif; ?>
	<?php if ($tparams->get('show_links')) : ?>
		<?php echo $this->loadTemplate('links'); ?>
	<?php endif; ?>		
	<?php if ($tparams->get('show_articles') && $this->contact->user_id && $this->contact->articles) : ?>
		<li>
			<?php echo $this->loadTemplate('articles'); ?>
		</li>
	<?php endif; ?>
	<?php if ($tparams->get('show_profile') && $this->contact->user_id && JPluginHelper::isEnabled('user', 'profile')) : ?>
		<li><?php echo $this->loadTemplate('profile'); ?></li>
	<?php endif; ?>
	<?php if ($this->contact->misc && $tparams->get('show_misc')) : ?>
		<li>
		<div class="contact-miscinfo">
		<?php echo $this->contact->misc; ?>
		</div>
		</li>
	<?php endif; ?>
	</ul>

	<?php endif; ?>

	<?php if ($presentation_style === 'plain') : ?>	
	<div class="<?php echo $this->params->get('presentation_style') ?>-style">
		<div class="contact-inner">

		<?php if ($this->params->get('show_info', 1) || $tparams->get('show_links')) : ?>
		<?php echo $this->item->event->beforeDisplayContent; ?>
		<?php if ($tparams->get('show_user_custom_fields') && $this->contactUser) : ?>
			<?php echo $this->loadTemplate('user_custom_fields'); ?>
		<?php endif; ?>
		<?php endif; ?>

		<?php $show_contact_category = $tparams->get('show_contact_category'); ?>
		<?php $show_info_check = $this->params->get('show_info', 1) && (($this->contact->image && $tparams->get('show_image')) || ($this->contact->con_position && $tparams->get('show_position')) || (($this->params->get('address_check') > 0) &&
		($this->contact->address || $this->contact->suburb  || $this->contact->state || $this->contact->country || $this->contact->postcode)) || ($tparams->get('allow_vcard')) ); ?>
		
		<?php if ($tparams->get('show_contact_category') != 'hide' || ($tparams->get('show_contact_list') && count($this->contacts) > 1) || ($tparams->get('show_tags', 1) && !empty($this->item->tags->itemTags)) || $show_info_check || ($tparams->get('show_links')) || ($tparams->get('show_articles') && $this->contact->user_id && $this->contact->articles) || ($tparams->get('show_profile') && $this->contact->user_id && JPluginHelper::isEnabled('user', 'profile')) || ($this->contact->misc && $tparams->get('show_misc')) ) : ?>
			
			<div class="uk-child-width-expand" uk-grid>
				<div class="uk-width-1-3@m">
					
					<?php if ($this->contact->image && $tparams->get('show_image')) : ?>
						<div class="uk-card uk-card-default">
						<div class="thumbnail uk-card-media-top">
							<?php echo JHtml::_('image', $this->contact->image, htmlspecialchars($this->contact->name,  ENT_QUOTES, 'UTF-8'), array('itemprop' => 'image')); ?>
						</div>
						<div class="uk-card-body uk-margin-remove-first-child">
					<?php endif; ?>

					<?php if ($this->contact->misc && $tparams->get('show_misc')) : ?>
						<div class="contact-miscinfo">
							<?php echo $this->contact->misc; ?>
						</div>
					<?php endif ;?>

					<?php if ($this->params->get('show_info', 1) || $tparams->get('show_links')) : ?>
					<div class="contact-info">
						<?php if ($this->params->get('show_info', 1)) :?>
							<?php if ($this->contact->con_position && $tparams->get('show_position')) : ?>
							<dl class="contact-position dl-horizontal">
								<dt><?php echo JText::_('COM_CONTACT_POSITION'); ?>:</dt>
								<dd itemprop="jobTitle">
								<?php echo $this->contact->con_position; ?>
								</dd>
							</dl>
							<?php endif; ?>

							<?php if (($this->params->get('address_check') > 0) && ($this->contact->address || $this->contact->suburb  || $this->contact->state || $this->contact->country || $this->contact->postcode)) : ?>
							<?php echo $this->loadTemplate('address'); ?>
							<?php endif; ?>
							
							<?php if ($tparams->get('allow_vcard')) : ?>
							<div class="uk-margin">
							<span><?php echo JText::_('COM_CONTACT_DOWNLOAD_INFORMATION_AS'); ?></span>
							<a class="uk-link-reset" href="<?php echo JRoute::_('index.php?option=com_contact&amp;view=contact&amp;id=' . $this->contact->id . '&amp;format=vcf'); ?>">
							<?php echo JText::_('COM_CONTACT_VCARD'); ?></a>
							</div>
							<?php endif; ?>

						<?php endif; ?>
					</div>

					<?php if ($tparams->get('show_tags', 1) && !empty($this->item->tags->itemTags)) : ?>
						<?php $this->item->tagLayout = new JLayoutFile('joomla.content.tags'); ?>
						<?php echo $this->item->tagLayout->render($this->item->tags->itemTags); ?>
					<?php endif; ?>

					<?php if ($tparams->get('show_links')) : ?>
						<?php echo $this->loadTemplate('links'); ?>
					<?php endif; ?>

					<?php endif; ?>

					<?php echo $this->item->event->afterDisplayTitle; ?>

					<?php if ($tparams->get('show_profile') && $this->contact->user_id && JPluginHelper::isEnabled('user', 'profile')) : ?>	
						<?php echo '<h3>'. JText::_('COM_CONTACT_PROFILE').'</h3>'; ?>
						<?php echo $this->loadTemplate('profile'); ?>
					<?php endif; ?>

					<?php $show_contact_category = $tparams->get('show_contact_category'); ?>

					<?php if ($show_contact_category === 'show_no_link') : ?>
						<h3>
							<span class="contact-category"><?php echo $this->contact->category_title; ?></span>
						</h3>
					<?php elseif ($show_contact_category === 'show_with_link') : ?>
						<?php $contactLink = ContactHelperRoute::getCategoryRoute($this->contact->catid); ?>
						<h3>
							<span class="contact-category"><a href="<?php echo $contactLink; ?>">
								<?php echo $this->escape($this->contact->category_title); ?></a>
							</span>
						</h3>
					<?php endif; ?>

					<?php if ($tparams->get('show_contact_list') && count($this->contacts) > 1) : ?>
						<form action="#" method="get" name="selectForm" id="selectForm">
							<label for="select_contact"><?php echo JText::_('COM_CONTACT_SELECT_CONTACT'); ?></label>
							<?php echo JHtml::_('select.genericlist', $this->contacts, 'select_contact', 'class="inputbox" onchange="document.location.href = this.value"', 'link', 'name', $this->contact->link); ?>
						</form>
					<?php endif; ?>

					<?php if ($tparams->get('show_articles') && $this->contact->user_id && $this->contact->articles) : ?>
						<?php echo '<h2>' . JText::_('JGLOBAL_ARTICLES') . '</h2>'; ?>
						<?php echo $this->loadTemplate('articles'); ?>
					<?php endif; ?>

					<?php if ($this->contact->image && $tparams->get('show_image')) : ?>
					</div>
					</div>
					<?php endif; ?>
				</div>

				<div class="uk-margin-remove-first-child">

				<?php endif; ?>

				<?php if ($tparams->get('show_email_form') && ($this->contact->email_to || $this->contact->user_id)) : ?>
					<div class="contact-form">
						<div class="contact-title">
							<?php echo '<h3>' . JText::_('COM_CONTACT_EMAIL_FORM') . '</h3>'; ?>
						</div>
						<div class="contact-body">
							<?php echo $this->loadTemplate('form'); ?>
						</div>
				</div>
				<?php endif ;?>
					
		<?php if ($tparams->get('show_contact_category') != 'hide' || ($tparams->get('show_contact_list') && count($this->contacts) > 1) || ($tparams->get('show_tags', 1) && !empty($this->item->tags->itemTags)) || $show_info_check || ($tparams->get('show_links')) || ($tparams->get('show_articles') && $this->contact->user_id && $this->contact->articles) || ($tparams->get('show_profile') && $this->contact->user_id && JPluginHelper::isEnabled('user', 'profile')) || ($this->contact->misc && $tparams->get('show_misc')) ) : ?>
				</div>
			</div>
		<?php endif; ?>

		</div>
	
	</div>
	<?php endif;?>

	<?php if ($presentation_style != 'plain') : ?>
	<?php if ($tparams->get('show_contact_list') && count($this->contacts) > 1) : ?>
		<form action="#" method="get" name="selectForm" id="selectForm">
			<label for="select_contact"><?php echo JText::_('COM_CONTACT_SELECT_CONTACT'); ?></label>
			<?php echo JHtml::_('select.genericlist', $this->contacts, 'select_contact', 'class="inputbox" onchange="document.location.href = this.value"', 'link', 'name', $this->contact->link); ?>
		</form>
	<?php endif; ?>
	<?php endif; ?>

	<?php echo $this->item->event->afterDisplayContent; ?>
</div>
