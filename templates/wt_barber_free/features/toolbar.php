<?php
/**
 * @package Helix_Ultimate_Framework
 * @author JoomShaper <support@joomshaper.com>
 * @copyright Copyright (c) 2010 - 2020 JoomShaper
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or Later
 */

defined('_JEXEC') or die();

/**
 * Helix Ultimate contact information.
 *
 * @since	1.0.0
 */
class HelixUltimateFeatureToolbar
{
	/**
	 * Template parameters
	 *
	 * @var		object	$params		The parameters object
	 * @since	1.0.0
	 */
	private $params;

	/**
	 * Constructor function
	 *
	 * @param	object	$params		The template parameters
	 *
	 * @since	1.0.0
	 */
	public function __construct($params)
	{
		$this->params = $params;
		$this->position = 'toolbar';
	}
	
	/**
	 * Render the contact features
	 *
	 * @return	string
	 * @since	1.0.0
	 */
	public function renderFeature()
	{
		$doc = \JFactory::getDocument();

		$header_outside = $this->params->get('boxed_layout') && $this->params->get('boxed_header_outside');

		$mobile_breakpoint_options = $this->params->get('mobile_breakpoint_options', 'm');
		$toolbar_color_mode = $this->params->get('toolbar_color_mode');
		$social_pos = $this->params->get('social_pos');
		$contact_pos = $this->params->get('contact_pos');

		// Toolbar.
		$toolbar_wrap[] = '';

		$toolbar_transparent_init = $this->params->get('toolbar_transparent') && $this->params->get('transparent_header');

		$toolbar_wrap[] = 'tm-toolbar';

		$toolbar_wrap[] = $header_outside && $toolbar_transparent_init ? 'tm-toolbar-transparent' : 'tm-toolbar-default';
		$toolbar_wrap[] = $header_outside && $toolbar_transparent_init ? 'uk-' . $this->params->get( 'transparent_header' ) : '';

		$toolbar_wrap[] = $toolbar_color_mode ? 'uk-' . $toolbar_color_mode : '';
		$toolbar_wrap[] = 'uk-visible@'.$mobile_breakpoint_options;

		$toolbar_container = $this->params->get('toolbar_maxwidth', 'default');
		$toolbar_container_cls[] = 'uk-flex uk-flex-middle';

		$toolbar_center = $this->params->get('toolbar_center', '0');
		
		include_once 'contact.php';
		include_once 'social.php';

		/**
		 * Helper classes for-
		 * social icons, contact info, search.
		 */

		$contact = new HelixUltimateFeatureContact( $this->params );
		$social  = new HelixUltimateFeatureSocial( $this->params );

		// Toolbar Width Container

		if ($header_outside) {
			$toolbar_container_cls[] = $toolbar_container === 'expand' ? 'uk-container uk-container-expand' : 'container tm-page-width';
		} else {
			$toolbar_container_cls[] = $toolbar_container != 'default' ? 'uk-container uk-container-' . $toolbar_container : 'container';
		}

		$toolbar_container_cls[] = $this->params->get('toolbar_center') ? 'uk-flex-center' : '';

		$toolbar_wrap   = implode( ' ', array_filter( $toolbar_wrap ) );
		$toolbar_container_cls   = implode( ' ', array_filter( $toolbar_container_cls ) );

		$output = '';

		if ($doc->countModules('toolbar-left') || $doc->countModules('toolbar-right') || $social_pos === 'toolbar-left' || $social_pos === 'toolbar-right' || $contact_pos === 'toolbar-left' || $contact_pos === 'toolbar-right') {
			$output .= '<div class="' . $toolbar_wrap . '">';
			$output .= '<div class="' . $toolbar_container_cls . '">';
		
			if ($toolbar_center) {
		
			$output .= '<div>';
			$output .= '<div class="uk-grid-medium uk-child-width-auto uk-flex-middle" uk-grid="margin: uk-margin-small-top">';
		
			if ($doc->countModules('toolbar-left') || $social_pos === 'toolbar-left' || $contact_pos === 'toolbar-left') {
		
				if ($contact_pos === 'toolbar-left') {
					$output .= '<div>';
						$output .= $contact->renderFeature();
					$output .= '</div>';
				}
		
				if ($social_pos === 'toolbar-left') {
					$output .= '<div>';
						$output .= $social->renderFeature();
					$output .= '</div>';
				}
		
				$output .= '<jdoc:include type="modules" name="toolbar-left" style="toolbar_stack" />';
			}
		
			if ($doc->countModules('toolbar-right') || $social_pos === 'toolbar-right' || $contact_pos === 'toolbar-right') {
		
				$output .= '<jdoc:include type="modules" name="toolbar-right" style="toolbar_stack" />';
		
				if ($contact_pos === 'toolbar-right') {
					$output .= '<div>';
						$output .= $contact->renderFeature();
					$output .= '</div>';
				}
		
				if ($social_pos === 'toolbar-right') {
					$output .= '<div>';
						$output .= $social->renderFeature();
					$output .= '</div>';
				}
			}
			$output .= '</div>';
			$output .= '</div>';
			} else {
		
			if ($doc->countModules('toolbar-left') || $social_pos === 'toolbar-left' || $contact_pos === 'toolbar-left') {
		
				$output .= '<div class="toolbar-left">';
				$output .= '<div class="uk-grid-medium uk-child-width-auto uk-flex-middle" uk-grid="margin: uk-margin-small-top">';
		
				if ($contact_pos === 'toolbar-left') {
					$output .= '<div>';
						$output .= $contact->renderFeature();
					$output .= '</div>';
				}
		
				if ($social_pos === 'toolbar-left') {
					$output .= '<div>';
						$output .= $social->renderFeature();
					$output .= '</div>';
				}
		
				$output .= '<jdoc:include type="modules" name="toolbar-left" style="toolbar_stack" />';
		
				$output .= '</div>';
				$output .= '</div>';
			}
		
			if ($doc->countModules('toolbar-right') || $social_pos === 'toolbar-right' || $contact_pos === 'toolbar-right') {
		
				$output .= '<div class="toolbar-right uk-margin-auto-left">';
				$output .= '<div class="uk-grid-medium uk-child-width-auto uk-flex-middle" uk-grid="margin: uk-margin-small-top">';
		
				$output .= '<jdoc:include type="modules" name="toolbar-right" style="toolbar_stack" />';
		
				if ($contact_pos === 'toolbar-right') {
					$output .= '<div>';
						$output .= $contact->renderFeature();
					$output .= '</div>';
				}
		
				if ($social_pos === 'toolbar-right') {
					$output .= '<div>';
						$output .= $social->renderFeature();
					$output .= '</div>';
				}
		
				$output .= '</div>';
				$output .= '</div>';
			}

			}
		
			$output .= '</div>';
			$output .= '</div>';
			
		}

		return $output;
    }
}
