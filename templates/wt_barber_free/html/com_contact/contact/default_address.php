<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_contact
 *
 * @copyright   Copyright (C) 2005 - 2020 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

/**
 * Marker_class: Class based on the selection of text, none, or icons
 * jicon-text, jicon-none, jicon-icon
 */
?>
<ul class="contact-address uk-list" itemprop="address" itemscope itemtype="https://schema.org/PostalAddress">
	<?php if (($this->params->get('address_check') > 0) &&
		($this->contact->address || $this->contact->suburb  || $this->contact->state || $this->contact->country || $this->contact->postcode)) : ?>
		<?php if ($this->contact->address && $this->params->get('show_street_address')) : ?>
			<li>
				<span class="contact-street" itemprop="streetAddress">
				<span class="uk-margin-small-right uk-icon-button"><i class="fas fa-map-marker-alt"></i></span>
				<?php echo nl2br($this->contact->address); ?>
				</span>
			</li>
		<?php endif; ?>

		<?php if ($this->contact->suburb && $this->params->get('show_suburb')) : ?>
			<li>
				<span class="contact-suburb" itemprop="addressLocality">
				<span class="uk-margin-small-right uk-icon-button"><i class="fas fa-map-marked-alt"></i></span>
					<?php echo $this->contact->suburb; ?>
				</span>
			</li>
		<?php endif; ?>
		<?php if ($this->contact->state && $this->params->get('show_state')) : ?>
			<li>
				<span class="contact-state" itemprop="addressRegion">
				<span class="uk-margin-small-right uk-icon-button"><i class="fas fa-location-arrow"></i></span>
					<?php echo $this->contact->state; ?>
				</span>
			</li>
		<?php endif; ?>
		<?php if ($this->contact->postcode && $this->params->get('show_postcode')) : ?>
			<li>
				<span class="contact-postcode" itemprop="postalCode">
				<span class="uk-margin-small-right uk-icon-button"><i class="fas fa-magic"></i></span>
					<?php echo $this->contact->postcode; ?>
				</span>
			</li>
		<?php endif; ?>
		<?php if ($this->contact->country && $this->params->get('show_country')) : ?>
		<li>
			<span class="contact-country" itemprop="addressCountry">
			<span class="uk-margin-small-right uk-icon-button"><i class="fas fa-globe"></i></span>
				<?php echo $this->contact->country; ?>
			</span>
		</li>
		<?php endif; ?>
	<?php endif; ?>

<?php if ($this->contact->email_to && $this->params->get('show_email')) : ?>
	<li>
		<span class="contact-emailto">
		<span class="uk-margin-small-right uk-icon-button"><i class="far fa-envelope"></i></span>
			<?php echo $this->contact->email_to; ?>
		</span>
	</li>
<?php endif; ?>

<?php if ($this->contact->telephone && $this->params->get('show_telephone')) : ?>
	<li>
		<span class="contact-telephone" itemprop="telephone">
		<span class="uk-margin-small-right uk-icon-button"><i class="fas fa-phone-alt"></i></span>
			<?php echo $this->contact->telephone; ?>
		</span>
	</li>
<?php endif; ?>
<?php if ($this->contact->fax && $this->params->get('show_fax')) : ?>
	<li>
		<span class="contact-fax" itemprop="faxNumber">
		<span class="uk-margin-small-right uk-icon-button"><i class="fas fa-fax"></i></span>
		<?php echo $this->contact->fax; ?>
		</span>
	</li>
<?php endif; ?>
<?php if ($this->contact->mobile && $this->params->get('show_mobile')) : ?>
	<li>
		<span class="contact-mobile" itemprop="telephone">
		<span class="uk-margin-small-right uk-icon-button"><i class="fas fa-mobile-alt"></i></span>
			<?php echo $this->contact->mobile; ?>
		</span>
	</li>
<?php endif; ?>
<?php if ($this->contact->webpage && $this->params->get('show_webpage')) : ?>
	<li>
		<span class="contact-webpage">
		<span class="uk-margin-small-right uk-icon-button"><i class="fas fa-external-link-alt"></i></span>
			<a href="<?php echo $this->contact->webpage; ?>" target="_blank" rel="noopener noreferrer" itemprop="url">
			<?php echo JStringPunycode::urlToUTF8($this->contact->webpage); ?></a>
		</span>
	</li>
<?php endif; ?>
</ul>
