<?php
/**
 * @package Extra Add-ons SP Page Builder
 * @author WarpTheme https://warptheme.com
 * @copyright Copyright (c) 2015 - 2021 WarpTheme
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or later
 */

//no direct accees
defined('_JEXEC') or die('restricted aceess');

SpAddonsConfig::addonConfig(
	array(
		'type' => 'repeatable',
		'addon_name' => 'uislideshow',
		'category' => 'WarpTheme',
		'title' => JText::_('UI Slideshow'),
		'desc' => JText::_('Create a responsive slideshow with images and videos.'),
		'icon'=>JURI::root() . 'plugins/sppagebuilder/extra/addons/uislideshow/assets/images/icon.png',
		'attr' => array(
			'general' => array(
				'admin_label' => array(
					'type' => 'text',
					'title' => JText::_('COM_SPPAGEBUILDER_ADDON_ADMIN_LABEL'),
					'desc' => JText::_('COM_SPPAGEBUILDER_ADDON_ADMIN_LABEL_DESC'),
					'std' => ''
				),
				'title_addon' => array(
					'type' => 'text',
					'title' => JText::_('Title'),
					'desc' => JText::_('COM_SPPAGEBUILDER_ADDON_TITLE_DESC'),
					'std' =>  ''
				),
				'title_heading_style' => array(
					'type' => 'select',
					'title' => JText::_('Style'),
					'desc' => JText::_('Heading styles differ in font-size but may also come with a predefined color, size and font'),
					'values' => array(
						'' => JText::_('None'),
						'heading-2xlarge' => JText::_('2XLarge'),
						'heading-xlarge' => JText::_('XLarge'),
						'heading-large' => JText::_('Large'),
						'heading-medium' => JText::_('Medium'),
						'heading-small' => JText::_('Small'),
						'h1' => JText::_('H1'),
						'h2' => JText::_('H2'),
						'h3' => JText::_('H3'),
						'h4' => JText::_('H4'),
						'h5' => JText::_('H5'),
						'h6' => JText::_('H6'),
					),
					'std' => 'h3',
					'depends' => array(array('title_addon', '!=', '')),
				),
				'title_heading_margin' => array(
					'type' => 'select',
					'title' => JText::_('Title Margin'),
					'desc' => JText::_('Set the vertical margin for title.'),
					'values' => array(
						'' => JText::_('Keep existing'),
						'uk-margin-small' => JText::_('Small'),
						'uk-margin' => JText::_('Default'),
						'uk-margin-medium' => JText::_('Medium'),
						'uk-margin-large' => JText::_('Large'),
						'uk-margin-xlarge' => JText::_('X-Large'),
						'uk-margin-remove-vertical' => JText::_('None'),
					),
					'std' => 'uk-margin',
					'depends' => array(array('title_addon', '!=', '')),
				),
				'title_heading_decoration' => array(
					'type' => 'select',
					'title' => JText::_('Decoration'),
					'desc' => JText::_('Decorate the heading with a divider, bullet or a line that is vertically centered to the heading'),
					'values' => array(
						'' => JText::_('None'),
						'uk-heading-divider' => JText::_('Divider'),
						'uk-heading-bullet' => JText::_('Bullet'),
						'uk-heading-line' => JText::_('Line'),
					),
					'std' => '',
					'depends' => array(array('title_addon', '!=', '')),
				),
				'title_heading_color' => array(
					'type' => 'select',
					'title' => JText::_('Color'),
					'desc' => JText::_('Select the text color. If the Background option is selected, styles that don\'t apply a background image use the primary color instead.'),
					'values' => array(
						'' => JText::_('None'),
						'text-muted' => JText::_('Muted'),
						'text-emphasis' => JText::_('Emphasis'),
						'text-primary' => JText::_('Primary'),
						'text-secondary' => JText::_('Secondary'),
						'text-success' => JText::_('Success'),
						'text-warning' => JText::_('Warning'),
						'text-danger' => JText::_('Danger'),
						'text-background' => JText::_('Background'),
					),
					'std' => '',
					'depends' => array(array('title_addon', '!=', '')),
				),
				'title_heading_selector' => array(
					'type' => 'select',
					'title' => JText::_('HTML Element'),
					'desc' => JText::_('Choose one of the HTML elements to fit your semantic structure.'),
					'values' => array(
						'h1' => JText::_('h1'),
						'h2' => JText::_('h2'),
						'h3' => JText::_('h3'),
						'h4' => JText::_('h4'),
						'h5' => JText::_('h5'),
						'h6' => JText::_('h6'),
						'div' => JText::_('div'),
					),
					'std' => 'h3',
					'depends' => array(array('title_addon', '!=', '')),
				),
				// Repeatable Items
				'ui_slideshow_items' => array(
					'title' => JText::_('Items'),
					'attr' => array(
						'media_item' => array(
							'type' => 'media',
							'title' => JText::_('Image'),
							'placeholder' => 'http://www.example.com/my-photo.jpg',
						),
						'video_item' => array(
							'type' => 'media',
							'format' => 'video',
							'hide_preview' => true,
							'title' => JText::_('Video File'),
							'placeholder' => 'http://www.example.com/my-video.mp4',
							'depends' => array(array('media_item', '!=', '')),
						),
						'image_panel' => array(
							'type' => 'checkbox',
							'title' => JText::_('Blend Mode Settings'),
							'values' => array(
								1 => JText::_('JYES'),
								0 => JText::_('JNO'),
							),
							'std' => 0,
						),
						'media_background'=>array(
							'type'=>'color',
							'title'=>JText::_('Background Color'),
							'desc'=>JText::_('Use the background color in combination with blend modes.'),
							'depends'=>array(
								array('image_panel', '=', 1)
							),
						),
						'media_blend_mode' => array(
							'type' => 'select',
							'title' => JText::_('Blend modes'),
							'desc' => JText::_('Determine how the image will blend with the background color.'),
							'values' => array(
								'' => JText::_('None'),
								'multiply' => JText::_('Multiply'),
								'screen' => JText::_('Screen'),
								'overlay' => JText::_('Overlay'),
								'darken' => JText::_('Darken'),
								'lighten' => JText::_('Lighten'),
								'color-dodge' => JText::_('Color Dodge'),
								'color-burn' => JText::_('Color Burn'),
								'hard-light' => JText::_('Hard Light'),
								'soft-light' => JText::_('Soft Light'),
								'difference' => JText::_('Difference'),
								'exclusion' => JText::_('Exclusion'),
								'hue' => JText::_('Hue'),
								'color' => JText::_('Color'),
								'luminosity' => JText::_('Luminosity'),
							),
							'std' => '',
							'depends'=>array(
								array('image_panel', '=', 1),
								array('media_background', '!=', '')
							),
						),
						'media_overlay'=>array(
							'type'=>'color',
							'title'=>JText::_('Overlay Color'),
							'desc'=>JText::_('Set an additional transparent overlay to soften the image.'),
							'depends'=>array(
								array('image_panel', '=', 1)
							),
						),
						'image_alt' => array(
							'type' => 'text',
							'title' => JText::_('Image ALT'),
							'placeholder' => 'Image Alt',
						),
						'title' => array(
							'type' => 'text',
							'title' => JText::_('Title'),
							'std' => 'Item',
						),
						'meta' => array(
							'type' => 'text',
							'title' => JText::_('Meta'),
						),
						'content' => array(
							'type' => 'editor',
							'title' => JText::_('Content'),
							'std' => '',
						),
						'title_link' => array(
							'type' => 'media',
							'format' => 'attachment',
							'title' => JText::_('COM_SPPAGEBUILDER_GLOBAL_LINK'),
							'placeholder' => 'http://www.example.com',
							'std' => '',
							'hide_preview' => true,
						),
						'button_title' => array(
							'type' => 'text',
							'title' => JText::_('Link Text'),
							'placeholder' => 'Read more',
							'depends' => array(
								array('title_link', '!=', ''),
							),
						),
						'text_item_color' => array(
							'type' => 'select',
							'title' => JText::_('Text Color'),
							'desc' => JText::_('Set light or dark color mode for text, butons and controls'),
							'values' => array(
								'' => JText::_('None'),
								'light' => JText::_('Light'),
								'dark' => JText::_('Dark'),
							),
							'std' => '',
						),
						'navigation_image_item' => array(
							'type' => 'media',
							'title' => JText::_('Navigation Thumbnail'),
							'desc' => JText::_('This option is only used if the thumbnail navigation is set.'),
							'placeholder' => 'http://www.example.com/my-photo.jpg',
						),
					),
				),
				'separator_slideshow_options' => array(
					'type' => 'separator',
					'title' => JText::_('SlideShow'),
				),
				'height' => array(
					'type' => 'select',
					'title' => JText::_('Height'),
					'desc' => JText::_('The slideshow always takes up fullwidth, and  the height will adapt automatically based on the defined ratio. Alternatively, the height can adapt to the height of the viewport.<br/> Note: Make sure, no height is set in the section settings when using one of the viewport options.'),
					'values' => array(
						'' => JText::_('Auto'),
						'full' => JText::_('Viewport'),
						'percent' => JText::_('Viewport (Minus 20%)'),
						'section' => JText::_('Viewport (Minus the following section)'),
					),
					'std' => '',
				),
				'ratio' => array(
					'type' => 'text',
					'title' => JText::_('Ratio'),
					'desc' => JText::_('Set a ratio. It\'s recommended to use the same ratio of the background image. Just use its width and height, like 1600:900'),
					'std' => '',
					'placeholder' => '16:9',
					'depends' => array(
						array('height', '=', ''),
					),
				),
				'min_height' => array(
					'type' => 'slider',
					'title' => JText::_('Min Height'),
					'min' => 200,
					'max' => 800,
					'desc' => JText::_('Use an optional minimum height to prevent the slideshow from becoming smaller than its content on small devices.'),
					'std' => 300,
				),
				'max_height' => array(
					'type' => 'slider',
					'title' => JText::_('Max Height'),
					'min' => 500,
					'max' => 1600,
					'desc' => JText::_('Set the maximum height'),
					'depends' => array(
						array('height', '=', ''),
					),
				),
				'item_color' => array(
					'type' => 'select',
					'title' => JText::_('Text Color'),
					'desc' => JText::_('Set light or dark color mode for text, butons and controls'),
					'values' => array(
						'' => JText::_('None'),
						'light' => JText::_('Light'),
						'dark' => JText::_('Dark'),
					),
					'std' => '',
				),
				'box_shadow' => array(
					'type' => 'select',
					'title' => JText::_('Box Shadow'),
					'desc' => JText::_('Select the slideshow\'s box shadow size.'),
					'values' => array(
						'' => JText::_('None'),
						'small' => JText::_('Small'),
						'medium' => JText::_('Medium'),
						'large' => JText::_('Large'),
						'xlarge' => JText::_('X-Large'),
					),
					'std' => '',
				),
				'separator_animations_options' => array(
					'type' => 'separator',
					'title' => JText::_('Animation'),
				),
				'slideshow_transition' => array(
					'type' => 'select',
					'title' => JText::_('Transition'),
					'desc' => JText::_('Select the transition between two slides'),
					'values' => array(
						'' => JText::_('Slide'),
						'pull' => JText::_('Pull'),
						'push' => JText::_('Push'),
						'fade' => JText::_('Fade'),
						'scale' => JText::_('Scale'),
					),
					'std' => '',
				),
				'velocity' => array(
					'type' => 'slider',
					'title' => JText::_('Velocity'),
					'desc' => JText::_('Set the velocity in pixels per milliseconds.'),
					'min' => 20,
					'max' => 300,
				),
				'autoplay' => array(
					'type' => 'checkbox',
					'title' => JText::_('Autoplay'),
					'values' => array(
						1 => JText::_('JYES'),
						0 => JText::_('JNO'),
					),
					'std' => 0,
				),
				'pause' => array(
					'type' => 'checkbox',
					'title' => JText::_('Pause autoplay on hover'),
					'values' => array(
						1 => JText::_('JYES'),
						0 => JText::_('JNO'),
					),
					'std' => 1,
					'depends' => array(
						array('autoplay', '=', 1),
					)
				),
				'autoplay_interval' => array(
					'type' => 'slider',
					'title' => JText::_('Interval'),
					'desc' => JText::_('Set the autoplay interval in seconds.'),
					'placeholder'=>'7',
					'min' => 5,
					'max' => 15,
					'depends' => array(
						array('autoplay', '=', 1),
					)
				),
				'kenburns_transition' => array(
					'type' => 'select',
					'title' => JText::_('Ken Burns Effect'),
					'desc' => JText::_('Select the transformation origin for the Ken Burns animation'),
					'values' => array(
						'' => JText::_('None'),
						'top-left' => JText::_('Top Left'),
						'top-center' => JText::_('Top Center'),
						'top-right' => JText::_('Top Right'),
						'center-left' => JText::_('Center Left'),
						'center-center' => JText::_('Center Center'),
						'center-right' => JText::_('Center Right'),
						'bottom-left' => JText::_('Bottom Left'),
						'bottom-center' => JText::_('Bottom Center'),
						'bottom-right' => JText::_('Bottom Right'),
					),
					'std' => '',
				),
				'kenburns_duration' => array(
					'type' => 'slider',
					'title' => JText::_('Duration'),
					'min' => 10,
					'max' => 30,
					'placeholder' =>'15' ,
					'desc' => JText::_('Set the duration for the Ken Burns effect in seconds.'),
					'depends' => array(
						array('kenburns_transition', '!=', ''),
					),
				),
				'separator_navigation_options' => array(
					'type' => 'separator',
					'title' => JText::_('Navigation'),
				),
				'navigation' => array(
					'type' => 'select',
					'title' => JText::_('Display'),
					'desc' => JText::_('Select the navigation type.'),
					'values' => array(
						'' => JText::_('None'),
						'dotnav' => JText::_('Dotnav'),
						'thumbnav' => JText::_('Thumbnav'),
					),
					'std' => 'dotnav',
				),
				'navigation_below' => array(
					'type' => 'checkbox',
					'title' => JText::_('Show below slideshow'),
					'values' => array(
						1 => JText::_('JYES'),
						0 => JText::_('JNO'),
					),
					'std' => 0,
					'depends' => array(
						array('navigation', '!=', ''),
					),
				),
				'navigation_vertical' => array(
					'type' => 'checkbox',
					'title' => JText::_('Vertical navigation'),
					'values' => array(
						1 => JText::_('JYES'),
						0 => JText::_('JNO'),
					),
					'std' => 0,
					'depends' => array(
						array('navigation_below', '!=', 1),
						array('navigation', '!=', ''),
					),
				),
				'navigation_below_position' => array(
					'type' => 'select',
					'title' => JText::_('Position'),
					'desc' => JText::_('Select the position of the navigation.'),
					'values' => array(
						'left' => JText::_('Left'),
						'center' => JText::_('Center'),
						'right' => JText::_('Right'),
					),
					'std' => 'center',
					'depends' => array(
						array('navigation_below', '=', 1),
						array('navigation', '!=', ''),
					),
				),
				'navigation_position' => array(
					'type' => 'select',
					'title' => JText::_('Position'),
					'desc' => JText::_('Select the position of the navigation.'),
					'values' => array(
						'top-left' => JText::_('Top Left'),
						'top-right' => JText::_('Top Right'),
						'center-left' => JText::_('Center Left'),
						'center-right' => JText::_('Center Right'),
						'bottom-left' => JText::_('Bottom Left'),
						'bottom-center' => JText::_('Bottom Center'),
						'bottom-right' => JText::_('Bottom Right'),
					),
					'std' => 'bottom-center',
					'depends' => array(
						array('navigation_below', '!=', 1),
						array('navigation', '!=', ''),
					),
				),
				'navigation_below_margin' => array(
					'type' => 'select',
					'title' => JText::_('Margin'),
					'values' => array(
						'small-top' => JText::_('Small'),
						'top' => JText::_('Default'),
						'medium-top' => JText::_('Medium'),
					),
					'std' => 'top',
					'depends' => array(
						array('navigation_below', '=', 1),
						array('navigation', '!=', ''),
					),
				),
				'navigation_margin' => array(
					'type' => 'select',
					'title' => JText::_('Margin'),
					'values' => array(
						'' => JText::_('None'),
						'small' => JText::_('Small'),
						'medium' => JText::_('Medium'),
						'large' => JText::_('Large'),
					),
					'std' => 'medium',
					'depends' => array(
						array('navigation_below', '!=', 1),
						array('navigation', '!=', ''),
					),
				),
				'navigation_breakpoint' => array(
					'type' => 'select',
					'title' => JText::_('Breakpoint'),
					'desc' => JText::_('Display the navigation only on this device width and larger'),
					'values' => array(
						'' => JText::_('Always'),
						's' => JText::_('Small (Phone Landscape)'),
						'm' => JText::_('Medium (Tablet Landscape)'),
						'l' => JText::_('Large (Desktop)'),
						'xl' => JText::_('X-Large (Large Screens)'),
					),
					'std' => 's',
					'depends' => array(
						array('navigation', '!=', ''),
					),
				),
				'navigation_color' => array(
					'type' => 'select',
					'title' => JText::_('Color'),
					'desc' => JText::_('Set light or dark color if the navigation is below the slideshow.'),
					'values' => array(
						'light' => JText::_('Light'),
						'' => JText::_('None'),
						'dark' => JText::_('Dark'),
					),
					'std' => '',
					'depends' => array(
						array('navigation_below', '=', 1),
						array('navigation', '!=', ''),
					),
				),
				'thumbnav_wrap' => array(
					'type' => 'checkbox',
					'title' => JText::_('Thumbnav Wrap'),
					'desc' => JText::_('Don\'t wrap into multiple lines. Define whether thumbnails wrap into multiple lines or not if the container is too small.'),
					'values' => array(
						1 => JText::_('JYES'),
						0 => JText::_('JNO'),
					),
					'std' => 0,
					'depends' => array(
						array('navigation', '=', 'thumbnav'),
					),
				),
				'thumbnail_width' => array(
					'type' => 'slider',
					'title' => JText::_('Thumbnail Width'),
					'min' => 0,
					'max' => 400,
					'desc' => JText::_('Settings just one value preserves the original proportions. The image will be resized and croped automatically, and where possible, high resolution images will be auto-generated.'),
					'std' => 100,
					'depends' => array(
						array('navigation', '=', 'thumbnav'),
					),
				),

				'thumbnail_height' => array(
					'type' => 'slider',
					'title' => JText::_('Thumbnail Height'),
					'min' => 0,
					'max' => 400,
					'desc' => JText::_('Settings just one value preserves the original proportions. The image will be resized and croped automatically, and where possible, high resolution images will be auto-generated.'),
					'std' => 75,
					'depends' => array(
						array('navigation', '=', 'thumbnav'),
					),
				),
				'image_svg_inline' => array(
					'type' => 'checkbox',
					'title' => JText::_('Make SVG stylable with CSS'),
					'desc' => JText::_('Inject SVG images into the page markup, so that they can easily be styled with CSS.'),
					'std' => 0,
					'depends' => array(
						array('navigation', '=', 'thumbnav'),
					),
				),
				'image_svg_color' => array(
					'type' => 'select',
					'title' => JText::_('SVG Color'),
					'desc' => JText::_('Select the SVG color. It will only apply to supported elements defined in the SVG.'),
					'values' => array(
						'' => JText::_('None'),
						'muted' => JText::_('Muted'),
						'emphasis' => JText::_('Emphasis'),
						'primary' => JText::_('Primary'),
						'secondary' => JText::_('Secondary'),
						'success' => JText::_('Success'),
						'warning' => JText::_('Warning'),
						'danger' => JText::_('Danger'),
					),
					'std' => '',
					'depends' => array(
						array('navigation', '=', 'thumbnav'),
						array('image_svg_inline', '=', 1)
					),
				),
				'separator_slidenav_options' => array(
					'type' => 'separator',
					'title' => JText::_('SlideNav'),
				),
				'slidenav_position' => array(
					'type' => 'select',
					'title' => JText::_('Position'),
					'desc' => JText::_('Select the position of the slidenav.'),
					'values' => array(
						'' => JText::_('None'),
						'default' => JText::_('Default'),
						'outside' => JText::_('Outside'),
						'top-left' => JText::_('Top Left'),
						'top-right' => JText::_('Top Right'),
						'center-left' => JText::_('Center Left'),
						'center-right' => JText::_('Center Right'),
						'bottom-left' => JText::_('Bottom Left'),
						'bottom-center' => JText::_('Bottom Center'),
						'bottom-right' => JText::_('Bottom Right'),
					),
					'std' => 'default',
				),
				'slidenav_on_hover' => array(
					'type' => 'checkbox',
					'title' => JText::_('Show on hover only'),
					'values' => array(
						1 => JText::_('JYES'),
						0 => JText::_('JNO'),
					),
					'std' => 0,
					'depends' => array(array('slidenav_position', '!=', '')),
				),
				'larger_style' => array(
					'type' => 'checkbox',
					'title' => JText::_('Larger style'),
					'desc' => JText::_('To increase the size of the slidenav icons'),
					'values' => array(
						'0' => JText::_('JYES'),
						'1' => JText::_('JNO'),
					),
					'std' => '0',
					'depends' => array(array('slidenav_position', '!=', '')),
				),
				'slidenav_margin' => array(
					'type' => 'select',
					'title' => JText::_('Margin'),
					'desc' => JText::_('Apply a margin between the slidnav and the slideshow container.'),
					'values' => array(
						'' => JText::_('None'),
						'small' => JText::_('Small'),
						'medium' => JText::_('Medium'),
						'large' => JText::_('Large'),
					),
					'std' => 'medium',
					'depends' => array(array('slidenav_position', '!=', '')),
				),
				'slidenav_breakpoint' => array(
					'type' => 'select',
					'title' => JText::_('Breakpoint'),
					'desc' => JText::_('Display the slidenav on this device width and larger.'),
					'values' => array(
						'' => JText::_('Always'),
						's' => JText::_('Small (Phone Landscape)'),
						'm' => JText::_('Medium (Tablet Landscape)'),
						'l' => JText::_('Large (Desktop)'),
						'xl' => JText::_('X-Large (Large Screens)'),
					),
					'std' => 's',
					'depends' => array(array('slidenav_position', '!=', '')),
				),

				'slidenav_outside_breakpoint' => array(
					'type' => 'select',
					'title' => JText::_('Outside Breakpoint'),
					'desc' => JText::_('Display the slidenav only outside on this device width and larger. Otherwise it will be displayed inside'),
					'values' => array(
						's' => JText::_('Small (Phone Landscape)'),
						'm' => JText::_('Medium (Tablet Landscape)'),
						'l' => JText::_('Large (Desktop)'),
						'xl' => JText::_('X-Large (Large Screens)'),
					),
					'std' => 'xl',
					'depends' => array(
						array('slidenav_position', '!=', ''),
						array('slidenav_position', '!=', 'default')
					),
				),
				'slidenav_outside_color' => array(
					'type' => 'select',
					'title' => JText::_('Outside Color'),
					'desc' => JText::_('Set light or dark color if the slidenav is outside of the slider'),
					'values' => array(
						'' => JText::_('None'),
						'light' => JText::_('Light'),
						'dark' => JText::_('Dark'),
					),
					'std' => '',
					'depends' => array(
						array('slidenav_position', '!=', ''),
						array('slidenav_position', '!=', 'default')
					),
				),

				'separator_overlay_style_options' => array(
					'type' => 'separator',
					'title' => JText::_('Overlay'),
				),
				'overlay_container' => array(
					'type' => 'select',
					'title' => JText::_('Container Width'),
					'desc' => JText::_('Set the maximum content width. Note: The section may already have a maximum width, which you cannot exceed.'),
					'values' => array(
						'' => JText::_('None'),
						'default' => JText::_('Default'),
						'small' => JText::_('Small'),
						'large' => JText::_('Large'),
						'xlarge' => JText::_('XLarge'),
						'expand' => JText::_('Expand'),
					),
					'std' => '',
				),
				'overlay_container_padding' => array(
					'type' => 'select',
					'title' => JText::_('Container Padding'),
					'desc' => JText::_('Set the vertical container padding to position the overlay.'),
					'values' => array(
						'' => JText::_('Default'),
						'xsmall' => JText::_('X-Small'),
						'small' => JText::_('Small'),
						'large' => JText::_('Large'),
						'xlarge' => JText::_('X-Large'),
					),
					'std' => '',
					'depends' => array(
						array('overlay_container', '!=', '')
					),
				),
				'overlay_margin' => array(
					'type' => 'select',
					'title' => JText::_('Margin'),
					'desc' => JText::_('Set the margin between the overlay and the slideshow container.'),
					'values' => array(
						'' => JText::_('Default'),
						'small' => JText::_('Small'),
						'large' => JText::_('Large'),
						'none' => JText::_('None'),
					),
					'std' => '',
					'depends' => array(
						array('overlay_container', '!=', 'default'),
						array('overlay_container', '!=', 'small'),
						array('overlay_container', '!=', 'large'),
						array('overlay_container', '!=', 'xlarge'),
						array('overlay_container', '!=', 'expand')
					),
				),
				'overlay_positions' => array(
					'type' => 'select',
					'title' => JText::_('Positions'),
					'desc' => JText::_('Select the content position.'),
					'values' => array(
						'top' => JText::_('Top'),
						'bottom' => JText::_('Bottom'),
						'left' => JText::_('Left'),
						'right' => JText::_('Right'),
						'top-left' => JText::_('Top Left'),
						'top-center' => JText::_('Top Center'),
						'top-right' => JText::_('Top Right'),
						'center-left' => JText::_('Center Left'),
						'center' => JText::_('Center Center'),
						'center-right' => JText::_('Center Right'),
						'bottom-left' => JText::_('Bottom Left'),
						'bottom-center' => JText::_('Bottom Center'),
						'bottom-right' => JText::_('Bottom Right'),
					),
					'std' => 'center-left',
				),
				'overlay_styles' => array(
					'type' => 'select',
					'title' => JText::_('Style'),
					'desc' => JText::_('Select a style for the overlay.'),
					'values' => array(
						'' => JText::_('None'),
						'overlay-default' => JText::_('Overlay Default'),
						'overlay-primary' => JText::_('Overlay Primary'),
						'tile-default' => JText::_('Tile Default'),
						'tile-muted' => JText::_('Tile Muted'),
						'tile-primary' => JText::_('Tile Primary'),
						'tile-secondary' => JText::_('Tile Secondary'),
						'overlay-custom' => JText::_('Custom'),
					),
					'std' => '',
				),
				'overlay_background' => array(
					'type' => 'color',
					'title' => JText::_('Background Color'),
					'std' => '#ffd49b',
					'depends' => array(
						array('overlay_styles', '=', 'overlay-custom'),
					),
				),
				'overlay_padding' => array(
					'type' => 'select',
					'title' => JText::_('Padding'),
					'desc' => JText::_('Set the padding between the overlay and its content.'),
					'values' => array(
						'' => JText::_('Default'),
						'small' => JText::_('Small'),
						'large' => JText::_('Large'),
					),
					'std' => '',
					'depends' => array(array('overlay_styles', '!=', '')),
				),
				'overlay_width' => array(
					'type' => 'select',
					'title' => JText::_('Width'),
					'desc' => JText::_('Set a fixed width.'),
					'values' => array(
						'' => JText::_('None'),
						'small' => JText::_('Small'),
						'medium' => JText::_('Medium'),
						'large' => JText::_('Large'),
						'xlarge' => JText::_('X-Large'),
						'2xlarge' => JText::_('2X-Large'),
					),
					'std' => '',
					'depends' => array(
						array('overlay_positions', '!=', 'top'),
						array('overlay_positions', '!=', 'bottom')
					),
				),

				'overlay_transition' => array(
					'type' => 'select',
					'title' => JText::_('Animation'),
					'desc' => JText::_('Choose between a parallax depending on the scroll position or an animation, which is applied once the slide is active.'),
					'values' => array(
						'' => JText::_('Parallax'),
						'fade' => JText::_('Fade'),
						'scale-up' => JText::_('Scale Up'),
						'scale-down' => JText::_('Scale Down'),
						'slide-top-small' => JText::_('Slide Top Small'),
						'slide-bottom-small' => JText::_('Slide Bottom Small'),
						'slide-left-small' => JText::_('Slide Left Small'),
						'slide-right-small' => JText::_('Slide Right Small'),
						'slide-top-medium' => JText::_('Slide Top Medium'),
						'slide-bottom-medium' => JText::_('Slide Bottom Medium'),
						'slide-left-medium' => JText::_('Slide Left Medium'),
						'slide-right-medium' => JText::_('Slide Right Medium'),
						'slide-top' => JText::_('Slide Top 100%'),
						'slide-bottom' => JText::_('Slide Bottom 100%'),
						'slide-left' => JText::_('Slide Left 100%'),
						'slide-right' => JText::_('Slide Right 100%'),
					),
					'std' => '',
				),

				'overlay_horizontal_start' => array(
					'type' => 'slider',
					'title' => JText::_('Horizontal Start'),
					'min' => -600,
					'max' => 600,
					'desc' => JText::_('Animate the horizontal position (translateX) in pixels.'),
					'depends' => array(array('overlay_transition', '=', '')),
				),
				'overlay_horizontal_end' => array(
					'type' => 'slider',
					'title' => JText::_('Horizontal End'),
					'min' => -600,
					'max' => 600,
					'desc' => JText::_('Animate the horizontal position (translateX) in pixels.'),
					'depends' => array(array('overlay_transition', '=', '')),
				),
				'overlay_vertical_start' => array(
					'type' => 'slider',
					'title' => JText::_('Vertical Start'),
					'min' => -600,
					'max' => 600,
					'desc' => JText::_('Animate the vertical position (translateY) in pixels.'),
					'depends' => array(array('overlay_transition', '=', '')),
				),
				'overlay_vertical_end' => array(
					'type' => 'slider',
					'title' => JText::_('Vertical End'),
					'min' => -600,
					'max' => 600,
					'desc' => JText::_('Animate the vertical position (translateY) in pixels.'),
					'depends' => array(array('overlay_transition', '=', '')),
				),
				'overlay_scale_start' => array(
					'type' => 'slider',
					'title' => JText::_('Scale Start'),
					'min' => 30,
					'max' => 400,
					'depends' => array(array('overlay_transition', '=', '')),
				),
				'overlay_scale_end' => array(
					'type' => 'slider',
					'title' => JText::_('Scale End'),
					'min' => 30,
					'max' => 400,
					'depends' => array(array('overlay_transition', '=', '')),
				),
				'overlay_rotate_start' => array(
					'type' => 'slider',
					'title' => JText::_('Rotate Start'),
					'min' => 0,
					'max' => 360,
					'desc' => JText::_('Animate the rotation clockwise in degrees.'),
					'depends' => array(array('overlay_transition', '=', '')),
				),
				'overlay_rotate_end' => array(
					'type' => 'slider',
					'title' => JText::_('Rotate End'),
					'min' => 0,
					'max' => 360,
					'desc' => JText::_('Animate the rotation clockwise in degrees.'),
					'depends' => array(array('overlay_transition', '=', '')),
				),
				'overlay_opacity_start' => array(
					'type' => 'slider',
					'title' => JText::_('Opacity Start'),
					'min' => 0,
					'max' => 100,
					'desc' => JText::_('Animate the opacity. 100 means 100% opacity, and 0 means 0% opacity.'),
					'depends' => array(array('overlay_transition', '=', '')),
				),
				'overlay_opacity_end' => array(
					'type' => 'slider',
					'title' => JText::_('Opacity End'),
					'min' => 0,
					'max' => 100,
					'desc' => JText::_('Animate the opacity. 100 means 100% opacity, and 0 means 0% opacity.'),
					'depends' => array(array('overlay_transition', '=', '')),
				),
				'separator_title_style_options' => array(
					'type' => 'separator',
					'title' => JText::_('Title'),
				),
				'heading_style' => array(
					'type' => 'select',
					'title' => JText::_('Style'),
					'desc' => JText::_('Heading styles differ in font-size but may also come with a predefined color, size and font'),
					'values' => array(
						'' => JText::_('None'),
						'heading-2xlarge' => JText::_('2XLarge'),
						'heading-xlarge' => JText::_('XLarge'),
						'heading-large' => JText::_('Large'),
						'heading-medium' => JText::_('Medium'),
						'heading-small' => JText::_('Small'),
						'h1' => JText::_('H1'),
						'h2' => JText::_('H2'),
						'h3' => JText::_('H3'),
						'h4' => JText::_('H4'),
						'h5' => JText::_('H5'),
						'h6' => JText::_('H6'),
					),
					'std' => '',
				),
				'title_decoration' => array(
					'type' => 'select',
					'title' => JText::_('Decoration'),
					'desc' => JText::_('Decorate the title with a divider, bullet or a line that is vertically centered to the title'),
					'values' => array(
						'' => JText::_('None'),
						'uk-heading-divider' => JText::_('Divider'),
						'uk-heading-bullet' => JText::_('Bullet'),
						'uk-heading-line' => JText::_('Line'),
					),
					'std' => '',
				),
				'title_font_family'=>array(
					'type'=>'fonts',
					'title'=>JText::_('Font Family'),
					'selector'=> array(
						'type'=>'font',
						'font'=>'{{ VALUE }}',
						'css'=>'.ui-title { font-family: {{ VALUE }}; }',
					)
				),
				'font_weight' => array(
					'type' => 'select',
					'title' => JText::_('Font weight'),
					'desc' => JText::_('Add one of the following classes to modify the font weight of your text.'),
					'values' => array(
					  '' => JText::_('Default'),
					  'light' => JText::_('Light'),
					  'normal' => JText::_('Normal'),
					  'bold' => JText::_('Bold'),
					  'lighter' => JText::_('Lighter'),
					  'bolder' => JText::_('Bolder'),
					),
				),
				'title_color' => array(
					'type' => 'select',
					'title' => JText::_('Predefined Color'),
					'desc' => JText::_('Select the predefined title text color.'),
					'values' => array(
						'' => JText::_('None'),
						'muted' => JText::_('Muted'),
						'emphasis' => JText::_('Emphasis'),
						'primary' => JText::_('Primary'),
						'secondary' => JText::_('Secondary'),
						'success' => JText::_('Success'),
						'warning' => JText::_('Warning'),
						'danger' => JText::_('Danger'),
					),
					'std' => '',
				),
				'custom_title_color'=>array(
					'type'=>'color',
					'title'=>JText::_('Custom Color'),
					'depends' => array(
						array('title_color', '=', '')
					),
				),
				'title_text_transform' => array(
					'type' => 'select',
					'title' => JText::_('Transform'),
					'desc' => JText::_('The following options will transform text into uppercased, capitalized or lowercased characters.'),
					'values' => array(
						'' => JText::_('Inherit'),
						'uppercase' => JText::_('Uppercase'),
						'capitalize' => JText::_('Capitalize'),
						'lowercase' => JText::_('Lowercase'),
					),
					'std' => '',
				),
				'heading_selector' => array(
					'type' => 'select',
					'title' => JText::_('HTML Element'),
					'desc' => JText::_('Choose one of the HTML elements to fit your semantic structure.'),
					'values' => array(
						'h1' => JText::_('h1'),
						'h2' => JText::_('h2'),
						'h3' => JText::_('h3'),
						'h4' => JText::_('h4'),
						'h5' => JText::_('h5'),
						'h6' => JText::_('h6'),
						'div' => JText::_('div'),
					),
					'std' => 'h3',
				),
				'title_margin_top' => array(
					'type' => 'select',
					'title' => JText::_('Margin Top'),
					'desc' => JText::_('Set the top margin.'),
					'values' => array(
						'' => JText::_('Default'),
						'small' => JText::_('Small'),
						'medium' => JText::_('Medium'),
						'large' => JText::_('Large'),
						'xlarge' => JText::_('X-Large'),
						'remove' => JText::_('None'),
					),
					'std' => '',
				),
				'use_title_parallax' => array(
					'type' => 'checkbox',
					'title' => JText::_('Parallax Settings'),
					'desc' => JText::_('Add a parallax effect.'),
					'values' => array(
						1 => JText::_('JYES'),
						0 => JText::_('JNO'),
					),
					'std' => 0,
					'depends' => array(array('overlay_transition', '=', '')),
				),
				'title_horizontal_start' => array(
					'type' => 'slider',
					'title' => JText::_('Horizontal Start'),
					'min' => -600,
					'max' => 600,
					'depends' => array(
						array('use_title_parallax', '=', 1),
						array('overlay_transition', '=', '')
					),
				),
				'title_horizontal_end' => array(
					'type' => 'slider',
					'title' => JText::_('Horizontal End'),
					'min' => -600,
					'max' => 600,
					'depends' => array(
						array('use_title_parallax', '=', 1),
						array('overlay_transition', '=', '')
					),
				),
				'title_vertical_start' => array(
					'type' => 'slider',
					'title' => JText::_('Vertical Start'),
					'min' => -600,
					'max' => 600,
					'depends' => array(
						array('use_title_parallax', '=', 1),
						array('overlay_transition', '=', '')
					),
				),
				'title_vertical_end' => array(
					'type' => 'slider',
					'title' => JText::_('Vertical End'),
					'min' => -600,
					'max' => 600,
					'depends' => array(
						array('use_title_parallax', '=', 1),
						array('overlay_transition', '=', '')
					),
				),
				'title_scale_start' => array(
					'type' => 'slider',
					'title' => JText::_('Scale Start'),
					'min' => 30,
					'max' => 400,
					'depends' => array(
						array('use_title_parallax', '=', 1),
						array('overlay_transition', '=', '')
					),
				),
				'title_scale_end' => array(
					'type' => 'slider',
					'title' => JText::_('Scale End'),
					'min' => 30,
					'max' => 400,
					'depends' => array(
						array('use_title_parallax', '=', 1),
						array('overlay_transition', '=', '')
					),
				),
				'title_rotate_start' => array(
					'type' => 'slider',
					'title' => JText::_('Rotate Start'),
					'min' => 0,
					'max' => 360,
					'depends' => array(
						array('use_title_parallax', '=', 1),
						array('overlay_transition', '=', '')
					),
				),
				'title_rotate_end' => array(
					'type' => 'slider',
					'title' => JText::_('Rotate End'),
					'min' => 0,
					'max' => 360,
					'depends' => array(
						array('use_title_parallax', '=', 1),
						array('overlay_transition', '=', '')
					),
				),
				'title_opacity_start' => array(
					'type' => 'slider',
					'title' => JText::_('Opacity Start'),
					'min' => 0,
					'max' => 100,
					'depends' => array(
						array('use_title_parallax', '=', 1),
						array('overlay_transition', '=', '')
					),
				),
				'title_opacity_end' => array(
					'type' => 'slider',
					'title' => JText::_('Opacity End'),
					'min' => 0,
					'max' => 100,
					'depends' => array(
						array('use_title_parallax', '=', 1),
						array('overlay_transition', '=', '')
					),
				),
				'separator_meta_style_options' => array(
					'type' => 'separator',
					'title' => JText::_('Meta'),
				),
				'meta_font_family'=>array(
					'type'=>'fonts',
					'title'=>JText::_('Font Family'),
					'selector'=> array(
						'type'=>'font',
						'font'=>'{{ VALUE }}',
						'css'=>'.ui-meta { font-family: {{ VALUE }}; }',
					)
				),
				'meta_font_weight' => array(
					'type' => 'select',
					'title' => JText::_('Font weight'),
					'desc' => JText::_('Add one of the following classes to modify the font weight of your text.'),
					'values' => array(
					  '' => JText::_('Default'),
					  'light' => JText::_('Light'),
					  'normal' => JText::_('Normal'),
					  'bold' => JText::_('Bold'),
					  'lighter' => JText::_('Lighter'),
					  'bolder' => JText::_('Bolder'),
					),
				),
				'meta_style' => array(
					'type' => 'select',
					'title' => JText::_('Style'),
					'desc' => JText::_('Select a predefined meta text style, including color, size and font-family'),
					'values' => array(
						'' => JText::_('None'),
						'text-meta' => JText::_('Meta'),
						'heading-2xlarge' => JText::_('2XLarge'),
						'heading-xlarge' => JText::_('XLarge'),
						'heading-large' => JText::_('Large'),
						'heading-medium' => JText::_('Medium'),
						'heading-small' => JText::_('Small'),
						'h1' => JText::_('H1'),
						'h2' => JText::_('H2'),
						'h3' => JText::_('H3'),
						'h4' => JText::_('H4'),
						'h5' => JText::_('H5'),
						'h6' => JText::_('H6'),
					),
					'std' => '',
				),
				'meta_color' => array(
					'type' => 'select',
					'title' => JText::_('Predefined Color'),
					'desc' => JText::_('Select the predefined meta text color.'),
					'values' => array(
						'' => JText::_('None'),
						'muted' => JText::_('Muted'),
						'emphasis' => JText::_('Emphasis'),
						'primary' => JText::_('Primary'),
						'secondary' => JText::_('Secondary'),
						'success' => JText::_('Success'),
						'warning' => JText::_('Warning'),
						'danger' => JText::_('Danger'),
					),
					'std' => '',
				),
				'custom_meta_color'=>array(
					'type'=>'color',
					'title'=>JText::_('Custom Color'),
					'depends' => array(
						array('meta_color', '=', '')
					),
				),
				'meta_text_transform' => array(
					'type' => 'select',
					'title' => JText::_('Transform'),
					'desc' => JText::_('The following options will transform text into uppercased, capitalized or lowercased characters.'),
					'values' => array(
						'' => JText::_('Inherit'),
						'uppercase' => JText::_('Uppercase'),
						'capitalize' => JText::_('Capitalize'),
						'lowercase' => JText::_('Lowercase'),
					),
					'std' => '',
				),
				'meta_alignment' => array(
					'type' => 'select',
					'title' => JText::_('Alignment'),
					'desc' => JText::_('Align the meta text above or below the title.'),
					'values' => array(
						'top' => JText::_('Above Title'),
						'' => JText::_('Below Title'),
						'content' => JText::_('Below Content'),
					),
					'std' => '',
				),
				'meta_element' => array(
					'type' => 'select',
					'title' => JText::_('HTML Element'),
					'desc' => JText::_('Choose one of the HTML elements to fit your semantic structure.'),
					'values' => array(
						'h1' => JText::_('h1'),
						'h2' => JText::_('h2'),
						'h3' => JText::_('h3'),
						'h4' => JText::_('h4'),
						'h5' => JText::_('h5'),
						'h6' => JText::_('h6'),
						'div' => JText::_('div'),
					),
					'std' => 'div',
				),
				'meta_margin_top' => array(
					'type' => 'select',
					'title' => JText::_('Margin Top'),
					'desc' => JText::_('Set the top margin.'),
					'values' => array(
						'' => JText::_('Default'),
						'small' => JText::_('Small'),
						'medium' => JText::_('Medium'),
						'large' => JText::_('Large'),
						'xlarge' => JText::_('X-Large'),
						'remove' => JText::_('None'),
					),
					'std' => '',
				),
				'use_meta_parallax' => array(
					'type' => 'checkbox',
					'title' => JText::_('Parallax Settings'),
					'desc' => JText::_('Add a parallax effect.'),
					'values' => array(
						1 => JText::_('JYES'),
						0 => JText::_('JNO'),
					),
					'std' => 0,
					'depends' => array(array('overlay_transition', '=', '')),
				),
				'meta_horizontal_start' => array(
					'type' => 'slider',
					'title' => JText::_('Horizontal Start'),
					'min' => -600,
					'max' => 600,
					'depends' => array(
						array('use_meta_parallax', '=', 1),
						array('overlay_transition', '=', '')
					),
				),
				'meta_horizontal_end' => array(
					'type' => 'slider',
					'title' => JText::_('Horizontal End'),
					'min' => -600,
					'max' => 600,
					'depends' => array(
						array('use_meta_parallax', '=', 1),
						array('overlay_transition', '=', '')
					),
				),
				'meta_vertical_start' => array(
					'type' => 'slider',
					'title' => JText::_('Vertical Start'),
					'min' => -600,
					'max' => 600,
					'depends' => array(
						array('use_meta_parallax', '=', 1),
						array('overlay_transition', '=', '')
					),
				),
				'meta_vertical_end' => array(
					'type' => 'slider',
					'title' => JText::_('Vertical End'),
					'min' => -600,
					'max' => 600,
					'depends' => array(
						array('use_meta_parallax', '=', 1),
						array('overlay_transition', '=', '')
					),
				),
				'meta_scale_start' => array(
					'type' => 'slider',
					'title' => JText::_('Scale Start'),
					'min' => 30,
					'max' => 400,
					'depends' => array(
						array('use_meta_parallax', '=', 1),
						array('overlay_transition', '=', '')
					),
				),
				'meta_scale_end' => array(
					'type' => 'slider',
					'title' => JText::_('Scale End'),
					'min' => 30,
					'max' => 400,
					'depends' => array(
						array('use_meta_parallax', '=', 1),
						array('overlay_transition', '=', '')
					),
				),
				'meta_rotate_start' => array(
					'type' => 'slider',
					'title' => JText::_('Rotate Start'),
					'min' => 0,
					'max' => 360,
					'depends' => array(
						array('use_meta_parallax', '=', 1),
						array('overlay_transition', '=', '')
					),
				),
				'meta_rotate_end' => array(
					'type' => 'slider',
					'title' => JText::_('Rotate End'),
					'min' => 0,
					'max' => 360,
					'depends' => array(
						array('use_meta_parallax', '=', 1),
						array('overlay_transition', '=', '')
					),
				),
				'meta_opacity_start' => array(
					'type' => 'slider',
					'title' => JText::_('Opacity Start'),
					'min' => 0,
					'max' => 100,
					'depends' => array(
						array('use_meta_parallax', '=', 1),
						array('overlay_transition', '=', '')
					),
				),
				'meta_opacity_end' => array(
					'type' => 'slider',
					'title' => JText::_('Opacity End'),
					'min' => 0,
					'max' => 100,
					'depends' => array(
						array('use_meta_parallax', '=', 1),
						array('overlay_transition', '=', '')
					),
				),

				'separator_content_style_options' => array(
					'type' => 'separator',
					'title' => JText::_('Content'),
				),
				'content_font_family'=>array(
					'type'=>'fonts',
					'title'=>JText::_('Font Family'),
					'selector'=> array(
						'type'=>'font',
						'font'=>'{{ VALUE }}',
						'css'=>'.ui-content { font-family: {{ VALUE }}; }',
					)
				),
				'content_style' => array(
					'type' => 'select',
					'title' => JText::_('Style'),
					'desc' => JText::_('Select a predefined meta text style, including color, size and font-family'),
					'values' => array(
						'' => JText::_('None'),
						'text-lead' => JText::_('Lead'),
						'text-meta' => JText::_('Meta'),
					),
					'std' => '',
				),
				'content_color'=>array(
					'type'=>'color',
					'title'=>JText::_('Color'),
				),
				'content_text_transform' => array(
					'type' => 'select',
					'title' => JText::_('Transform'),
					'desc' => JText::_('The following options will transform text into uppercased, capitalized or lowercased characters.'),
					'values' => array(
						'' => JText::_('Inherit'),
						'uppercase' => JText::_('Uppercase'),
						'capitalize' => JText::_('Capitalize'),
						'lowercase' => JText::_('Lowercase'),
					),
					'std' => '',
				),
				'content_margin_top' => array(
					'type' => 'select',
					'title' => JText::_('Margin Top'),
					'desc' => JText::_('Set the top margin.'),
					'values' => array(
						'' => JText::_('Default'),
						'small' => JText::_('Small'),
						'medium' => JText::_('Medium'),
						'large' => JText::_('Large'),
						'xlarge' => JText::_('X-Large'),
						'remove' => JText::_('None'),
					),
					'std' => '',
				),
				'use_content_parallax' => array(
					'type' => 'checkbox',
					'title' => JText::_('Parallax Settings'),
					'desc' => JText::_('Add a parallax effect.'),
					'values' => array(
						1 => JText::_('JYES'),
						0 => JText::_('JNO'),
					),
					'std' => 0,
					'depends' => array(array('overlay_transition', '=', '')),
				),
				'content_horizontal_start' => array(
					'type' => 'slider',
					'title' => JText::_('Horizontal Start'),
					'min' => -600,
					'max' => 600,
					'depends' => array(
						array('use_content_parallax', '=', 1),
						array('overlay_transition', '=', '')
					),
				),
				'content_horizontal_end' => array(
					'type' => 'slider',
					'title' => JText::_('Horizontal End'),
					'min' => -600,
					'max' => 600,
					'depends' => array(
						array('use_content_parallax', '=', 1),
						array('overlay_transition', '=', '')
					),
				),
				'content_vertical_start' => array(
					'type' => 'slider',
					'title' => JText::_('Vertical Start'),
					'min' => -600,
					'max' => 600,
					'depends' => array(
						array('use_content_parallax', '=', 1),
						array('overlay_transition', '=', '')
					),
				),
				'content_vertical_end' => array(
					'type' => 'slider',
					'title' => JText::_('Vertical End'),
					'min' => -600,
					'max' => 600,
					'depends' => array(
						array('use_content_parallax', '=', 1),
						array('overlay_transition', '=', '')
					),
				),
				'content_scale_start' => array(
					'type' => 'slider',
					'title' => JText::_('Scale Start'),
					'min' => 30,
					'max' => 400,
					'depends' => array(
						array('use_content_parallax', '=', 1),
						array('overlay_transition', '=', '')
					),
				),
				'content_scale_end' => array(
					'type' => 'slider',
					'title' => JText::_('Scale End'),
					'min' => 30,
					'max' => 400,
					'depends' => array(
						array('use_content_parallax', '=', 1),
						array('overlay_transition', '=', '')
					),
				),
				'content_rotate_start' => array(
					'type' => 'slider',
					'title' => JText::_('Rotate Start'),
					'min' => 0,
					'max' => 360,
					'depends' => array(
						array('use_content_parallax', '=', 1),
						array('overlay_transition', '=', '')
					),
				),
				'content_rotate_end' => array(
					'type' => 'slider',
					'title' => JText::_('Rotate End'),
					'min' => 0,
					'max' => 360,
					'depends' => array(
						array('use_content_parallax', '=', 1),
						array('overlay_transition', '=', '')
					),
				),
				'content_opacity_start' => array(
					'type' => 'slider',
					'title' => JText::_('Opacity Start'),
					'min' => 0,
					'max' => 100,
					'depends' => array(
						array('use_content_parallax', '=', 1),
						array('overlay_transition', '=', '')
					),
				),
				'content_opacity_end' => array(
					'type' => 'slider',
					'title' => JText::_('Opacity End'),
					'min' => 0,
					'max' => 100,
					'depends' => array(
						array('use_content_parallax', '=', 1),
						array('overlay_transition', '=', '')
					),
				),
				'separator_button_style_options' => array(
					'type' => 'separator',
					'title' => JText::_('Link'),
				),
				'all_button_title' => array(
					'type' => 'text',
					'title' => JText::_('Text'),
					'std' => 'Read more',
				),
				'link_new_tab' => array(
					'type' => 'select',
					'title' => JText::_('COM_SPPAGEBUILDER_GLOBAL_LINK_NEWTAB'),
					'desc' => JText::_('COM_SPPAGEBUILDER_GLOBAL_LINK_NEWTAB_DESC'),
					'values' => array(
						'' => JText::_('COM_SPPAGEBUILDER_ADDON_GLOBAL_TARGET_SAME_WINDOW'),
						'_blank' => JText::_('COM_SPPAGEBUILDER_ADDON_GLOBAL_TARGET_NEW_WINDOW'),
					),
				),
				'link_button_style' => array(
					'type' => 'select',
					'title' => JText::_('Style'),
					'desc' => JText::_('Set the button style.'),
					'values' => array(
						'' => JText::_('Button Default'),
						'primary' => JText::_('Button Primary'),
						'secondary' => JText::_('Button Secondary'),
						'danger' => JText::_('Button Danger'),
						'text' => JText::_('Button Text'),
						'link' => JText::_('Link'),
						'link-muted' => JText::_('Link Muted'),
						'link-text' => JText::_('Link Text'),
						'custom' => JText::_('Custom'),
					),
					'std' => '',
				),
				'button_font_weight' => array(
					'type' => 'select',
					'title' => JText::_('Font weight'),
					'desc' => JText::_('Add one of the following classes to modify the font weight of your text.'),
					'values' => array(
					  '' => JText::_('Default'),
					  'light' => JText::_('Light'),
					  'normal' => JText::_('Normal'),
					  'bold' => JText::_('Bold'),
					  'lighter' => JText::_('Lighter'),
					  'bolder' => JText::_('Bolder'),
					),
				),
				'separator_button_custom_options' => array(
					'type' => 'separator',
					'title' => JText::_('Custom Button Style'),
					'depends' => array(
						array('link_button_style', '=', 'custom'),
					),
				),
				'button_font_family' => array(
					'type' => 'fonts',
					'title' => JText::_('Font Family'),
					'depends' => array(
						array('link_button_style', '=', 'custom'),
					),
					'selector' => array(
						'type' => 'font',
						'font' => '{{ VALUE }}',
						'css' => '.uk-button-custom { font-family: {{ VALUE }}; }',
					)
				),
				'button_background' => array(
					'type' => 'color',
					'title' => JText::_('Background Color'),
					'std' => '#1e87f0',
					'depends' => array(
						array('link_button_style', '=', 'custom'),
					),
				),
				'button_color'=>array(
					'type'=>'color',
					'title'=>JText::_('Button Color'),
					'depends' => array(
						array('link_button_style', '=', 'custom'),
					),
				),
				'button_background_hover' => array(
					'type' => 'color',
					'title' => JText::_('Hover Background Color'),
					'std' => '#0f7ae5',
					'depends' => array(
						array('link_button_style', '=', 'custom'),
					),
				),
				'button_hover_color'=>array(
					'type'=>'color',
					'title'=>JText::_('Hover Button Color'),
					'depends' => array(
						array('link_button_style', '=', 'custom'),
					),
				),

				'link_button_size' => array(
					'type' => 'select',
					'title' => JText::_('Button Size'),
					'values' => array(
						'' => JText::_('Default'),
						'uk-button-small' => JText::_('Small'),
						'uk-button-large' => JText::_('Large'),
					),
				),
				'button_text_transform' => array(
					'type' => 'select',
					'title' => JText::_('Transform'),
					'desc' => JText::_('The following options will transform text into uppercased, capitalized or lowercased characters.'),
					'values' => array(
						'' => JText::_('Inherit'),
						'uppercase' => JText::_('Uppercase'),
						'capitalize' => JText::_('Capitalize'),
						'lowercase' => JText::_('Lowercase'),
					),
					'std' => '',
				),
				'button_margin_top' => array(
					'type' => 'select',
					'title' => JText::_('Margin Top'),
					'desc' => JText::_('Set the top margin. Note that the margin will only apply if the content field immediately follows another content field.'),
					'values' => array(
						'' => JText::_('Default'),
						'small' => JText::_('Small'),
						'medium' => JText::_('Medium'),
						'large' => JText::_('Large'),
						'xlarge' => JText::_('X-Large'),
						'remove' => JText::_('None'),
					),
					'std' => '',
				),
				'use_button_parallax' => array(
					'type' => 'checkbox',
					'title' => JText::_('Parallax Settings'),
					'desc' => JText::_('Add a parallax effect.'),
					'values' => array(
						1 => JText::_('JYES'),
						0 => JText::_('JNO'),
					),
					'std' => 0,
					'depends' => array(array('overlay_transition', '=', '')),
				),
				'button_horizontal_start' => array(
					'type' => 'slider',
					'title' => JText::_('Horizontal Start'),
					'min' => -600,
					'max' => 600,
					'depends' => array(
						array('use_button_parallax', '=', 1),
						array('overlay_transition', '=', '')
					),
				),
				'button_horizontal_end' => array(
					'type' => 'slider',
					'title' => JText::_('Horizontal End'),
					'min' => -600,
					'max' => 600,
					'depends' => array(
						array('use_button_parallax', '=', 1),
						array('overlay_transition', '=', '')
					),
				),
				'button_vertical_start' => array(
					'type' => 'slider',
					'title' => JText::_('Vertical Start'),
					'min' => -600,
					'max' => 600,
					'depends' => array(
						array('use_button_parallax', '=', 1),
						array('overlay_transition', '=', '')
					),
				),
				'button_vertical_end' => array(
					'type' => 'slider',
					'title' => JText::_('Vertical End'),
					'min' => -600,
					'max' => 600,
					'depends' => array(
						array('use_button_parallax', '=', 1),
						array('overlay_transition', '=', '')
					),
				),
				'button_scale_start' => array(
					'type' => 'slider',
					'title' => JText::_('Scale Start'),
					'min' => 30,
					'max' => 400,
					'depends' => array(
						array('use_button_parallax', '=', 1),
						array('overlay_transition', '=', '')
					),
				),
				'button_scale_end' => array(
					'type' => 'slider',
					'title' => JText::_('Scale End'),
					'min' => 30,
					'max' => 400,
					'depends' => array(
						array('use_button_parallax', '=', 1),
						array('overlay_transition', '=', '')
					),
				),
				'button_rotate_start' => array(
					'type' => 'slider',
					'title' => JText::_('Rotate Start'),
					'min' => 0,
					'max' => 360,
					'depends' => array(
						array('use_button_parallax', '=', 1),
						array('overlay_transition', '=', '')
					),
				),
				'button_rotate_end' => array(
					'type' => 'slider',
					'title' => JText::_('Rotate End'),
					'min' => 0,
					'max' => 360,
					'depends' => array(
						array('use_button_parallax', '=', 1),
						array('overlay_transition', '=', '')
					),
				),
				'button_opacity_start' => array(
					'type' => 'slider',
					'title' => JText::_('Opacity Start'),
					'min' => 0,
					'max' => 100,
					'depends' => array(
						array('use_button_parallax', '=', 1),
						array('overlay_transition', '=', '')
					),
				),
				'button_opacity_end' => array(
					'type' => 'slider',
					'title' => JText::_('Opacity End'),
					'min' => 0,
					'max' => 100,
					'depends' => array(
						array('use_button_parallax', '=', 1),
						array('overlay_transition', '=', '')
					),
				),
				'separator_general_options' => array(
					'type' => 'separator',
					'title' => JText::_('General'),
				),
				'addon_margin' => array(
					'type' => 'select',
					'title' => JText::_('Margin'),
					'desc' => JText::_('Set the vertical margin. Note: The first element\'s top margin and the last element\'s bottom margin are always removed. Define those in the grid settings instead.'),
					'values' => array(
						'' => JText::_('Keep existing'),
						'small' => JText::_('Small'),
						'default' => JText::_('Default'),
						'medium' => JText::_('Medium'),
						'large' => JText::_('Large'),
						'xlarge' => JText::_('X-Large'),
						'remove-vertical' => JText::_('None'),
					),
					'std' => '',
				),
				'addon_max_width' => array(
					'type' => 'select',
					'title' => JText::_('Max Width'),
					'desc' => JText::_('Set the maximum content width.'),
					'values' => array(
						'' => JText::_('None'),
						'small' => JText::_('Small'),
						'medium' => JText::_('Medium'),
						'large' => JText::_('Large'),
						'xlarge' => JText::_('X-Large'),
						'2xlarge' => JText::_('2X-Large'),
					),
					'std' => '',
				),
				'addon_max_width_breakpoint' => array(
					'type' => 'select',
					'title' => JText::_('Max Width Breakpoint'),
					'desc' => JText::_('Define the device width from which the element\'s max-width will apply.'),
					'values' => array(
						'' => JText::_('Always'),
						's' => JText::_('Small (Phone Landscape)'),
						'm' => JText::_('Medium (Tablet Landscape)'),
						'l' => JText::_('Large (Desktop)'),
						'xl' => JText::_('X-Large (Large Screens)'),
					),
					'std' => '',
					'depends' => array(array('addon_max_width', '!=', '')),
				),
				'block_align'=>array(
					'type'=>'select',
					'title'=>JText::_('Block Alignment'),
					'desc'=>JText::_('Define the alignment in case the container exceeds the element\'s max-width.'),
					'values'=>array(
						''=>JText::_('Left'),
						'center'=>JText::_('Center'),
						'right'=>JText::_('Right'),
					),
					'std'=>'',
					'depends'=>array(array('addon_max_width', '!=', '')),
				),
				'block_align_breakpoint'=>array(
					'type'=>'select',
					'title'=>JText::_('Block Alignment Breakpoint'),
					'desc'=>JText::_('Define the device width from which the alignment will apply.'),
					'values'=>array(
						''=>JText::_('Always'),
						's'=>JText::_('Small (Phone Landscape)'),
						'm'=>JText::_('Medium (Tablet Landscape)'),
						'l'=>JText::_('Large (Desktop)'),
						'xl'=>JText::_('X-Large (Large Screens)'),
					),
					'std'=>'',
					'depends'=>array(array('addon_max_width', '!=', '')),
				),
				'block_align_fallback'=>array(
					'type'=>'select',
					'title'=>JText::_('Block Alignment Fallback'),
					'desc'=>JText::_('Define the alignment in case the container exceeds the element\'s max-width.'),
					'values'=>array(
						''=>JText::_('Left'),
						'center'=>JText::_('Center'),
						'right'=>JText::_('Right'),
					),
					'std'=>'',
					'depends'=>array(
						array('addon_max_width', '!=', ''),
						array('block_align_breakpoint', '!=', '')
					),
				),
				'alignment' => array(
					'type' => 'select',
					'title' => JText::_('Text Alignment'),
					'desc' => JText::_('Center, left and right alignment.'),
					'values' => array(
						'' => JText::_('Inherit'),
						'uk-text-left' => JText::_('Left'),
						'uk-text-center' => JText::_('Center'),
						'uk-text-right' => JText::_('Right'),
						'uk-text-justify' => JText::_('Justify'),
					),
					'std' => '',
				),
				'text_breakpoint' => array(
					'type' => 'select',
					'title' => JText::_('Text Breakpoint'),
					'desc' => JText::_('Display the text alignment only on this device width and larger'),
					'values' => array(
						'' => JText::_('Always'),
						's' => JText::_('Small (Phone Landscape)'),
						'm' => JText::_('Medium (Tablet Landscape)'),
						'l' => JText::_('Large (Desktop)'),
						'xl' => JText::_('X-Large (Large Screens)'),
					),
					'std' => '',
					'depends' => array(array('alignment', '!=', '')),
				),
				'text_alignment_fallback' => array(
					'type' => 'select',
					'title' => JText::_('Text Alignment Fallback'),
					'desc' => JText::_('Define an alignment fallback for device widths below the breakpoint'),
					'values' => array(
						'' => JText::_('Inherit'),
						'left' => JText::_('Left'),
						'center' => JText::_('Center'),
						'right' => JText::_('Right'),
						'justify' => JText::_('Justify'),
					),
					'std' => '',
					'depends' => array(
						array('text_breakpoint', '!=', ''),
						array('alignment', '!=', '')
					),
				),
				'animation' => array(
					'type' => 'select',
					'title' => JText::_('Animation'),
					'desc' => JText::_('A collection of smooth animations to use within your page.'),
					'values' => array(
						'' => JText::_('Inherit'),
						'fade' => JText::_('Fade'),
						'scale-up' => JText::_('Scale Up'),
						'scale-down' => JText::_('Scale Down'),
						'slide-top-small' => JText::_('Slide Top Small'),
						'slide-bottom-small' => JText::_('Slide Bottom Small'),
						'slide-left-small' => JText::_('Slide Left Small'),
						'slide-right-small' => JText::_('Slide Right Small'),
						'slide-top-medium' => JText::_('Slide Top Medium'),
						'slide-bottom-medium' => JText::_('Slide Bottom Medium'),
						'slide-left-medium' => JText::_('Slide Left Medium'),
						'slide-right-medium' => JText::_('Slide Right Medium'),
						'slide-top' => JText::_('Slide Top 100%'),
						'slide-bottom' => JText::_('Slide Bottom 100%'),
						'slide-left' => JText::_('Slide Left 100%'),
						'slide-right' => JText::_('Slide Right 100%'),
						'parallax' => JText::_('Parallax'),
					),
					'std' => '',
				),
				'animation_repeat' => array(
					'type' => 'checkbox',
					'title' => JText::_('Repeat Animation'),
					'desc' => JText::_('Applies the animation class every time the element is in view'),
					'std' => 0,
					'depends' => array(
						array('animation', '!=', ''),
						array('animation', '!=', 'parallax'),
					),
				),
				'separator_parallax_options' => array(
					'type' => 'separator',
					'title' => JText::_('Parallax Animation Settings'),
					'depends' => array(array('animation', '=', 'parallax')),
				),
				'horizontal_start' => array(
					'type' => 'slider',
					'title' => JText::_('Horizontal Start'),
					'min' => -600,
					'max' => 600,
					'desc' => JText::_('Animate the horizontal position (translateX) in pixels.'),
					'depends' => array(array('animation', '=', 'parallax')),
				),
				'horizontal_end' => array(
					'type' => 'slider',
					'title' => JText::_('Horizontal End'),
					'min' => -600,
					'max' => 600,
					'desc' => JText::_('Animate the horizontal position (translateX) in pixels.'),
					'depends' => array(array('animation', '=', 'parallax')),
				),
				'vertical_start' => array(
					'type' => 'slider',
					'title' => JText::_('Vertical Start'),
					'min' => -600,
					'max' => 600,
					'desc' => JText::_('Animate the vertical position (translateY) in pixels.'),
					'depends' => array(array('animation', '=', 'parallax')),
				),
				'vertical_end' => array(
					'type' => 'slider',
					'title' => JText::_('Vertical End'),
					'min' => -600,
					'max' => 600,
					'desc' => JText::_('Animate the vertical position (translateY) in pixels.'),
					'depends' => array(array('animation', '=', 'parallax')),
				),
				'scale_start' => array(
					'type' => 'slider',
					'title' => JText::_('Scale Start'),
					'min' => 50,
					'max' => 200,
					'desc' => JText::_('Animate the scaling. Min: 50, Max: 200 =>  100 means 100% scale, 200 means 200% scale, and 50 means 50% scale.'),
					'depends' => array(array('animation', '=', 'parallax')),
				),
				'scale_end' => array(
					'type' => 'slider',
					'title' => JText::_('Scale End'),
					'min' => 50,
					'max' => 200,
					'desc' => JText::_('Animate the scaling. Min: 50, Max: 200 =>  100 means 100% scale, 200 means 200% scale, and 50 means 50% scale.'),
					'depends' => array(array('animation', '=', 'parallax')),
				),
				'rotate_start' => array(
					'type' => 'slider',
					'title' => JText::_('Rotate Start'),
					'min' => 0,
					'max' => 360,
					'desc' => JText::_('Animate the rotation clockwise in degrees.'),
					'depends' => array(array('animation', '=', 'parallax')),
				),
				'rotate_end' => array(
					'type' => 'slider',
					'title' => JText::_('Rotate End'),
					'min' => 0,
					'max' => 360,
					'desc' => JText::_('Animate the rotation clockwise in degrees.'),
					'depends' => array(array('animation', '=', 'parallax')),
				),
				'opacity_start' => array(
					'type' => 'slider',
					'title' => JText::_('Opacity Start'),
					'min' => 0,
					'max' => 100,
					'desc' => JText::_('Animate the opacity. 100 means 100% opacity, and 0 means 0% opacity.'),
					'depends' => array(array('animation', '=', 'parallax')),
				),
				'opacity_end' => array(
					'type' => 'slider',
					'title' => JText::_('Opacity End'),
					'min' => 0,
					'max' => 100,
					'desc' => JText::_('Animate the opacity. 100 means 100% opacity, and 0 means 0% opacity.'),
					'depends' => array(array('animation', '=', 'parallax')),
				),
				'easing' => array(
					'type' => 'slider',
					'title' => JText::_('Easing'),
					'min' => -200,
					'max' => 200,
					'desc' => JText::_('Set the animation easing. A value below 100 is faster in the beginning and slower towards the end while a value above 100 behaves inversely.'),
					'depends' => array(array('animation', '=', 'parallax')),
				),
				'viewport' => array(
					'type' => 'slider',
					'title' => JText::_('Viewport'),
					'min' => 10,
					'max' => 100,
					'desc' => JText::_('Set the animation end point relative to viewport height, e.g. 50 for 50% of the viewport'),
					'depends' => array(array('animation', '=', 'parallax')),
				),
				'parallax_target' => array(
					'type' => 'checkbox',
					'title' => JText::_('Target'),
					'desc' => JText::_('Animate the element as long as the section is visible.'),
					'std' => 0,
					'depends' => array(array('animation', '=', 'parallax')),
				),
				'parallax_zindex' => array(
					'type' => 'checkbox',
					'title' => JText::_('Z Index'),
					'desc' => JText::_('Set a higher stacking order.'),
					'std' => 0,
					'depends' => array(array('animation', '=', 'parallax')),
				),
				'breakpoint' => array(
					'type' => 'select',
					'title' => JText::_('Breakpoint'),
					'desc' => JText::_('Display the parallax effect only on this device width and larger. It is useful to disable the parallax animation on small viewports.'),
					'values' => array(
						'' => JText::_('Always'),
						's' => JText::_('Small (Phone)'),
						'm' => JText::_('Medium (Tablet)'),
						'l' => JText::_('Large (Desktop)'),
						'xl' => JText::_('X-Large (Large Screens)'),
					),
					'std' => '',
					'depends' => array(array('animation', '=', 'parallax')),
				),
				'visibility' => array(
					'type' => 'select',
					'title' => JText::_('Visibility'),
					'desc' => JText::_('Display the element only on this device width and larger.'),
					'values' => array(
						'' => JText::_('Always'),
						'uk-visible@s' => JText::_('Small (Phone Landscape)'),
						'uk-visible@m' => JText::_('Medium (Tablet Landscape)'),
						'uk-visible@l' => JText::_('Large (Desktop)'),
						'uk-visible@xl' => JText::_('X-Large (Large Screens)'),
						'uk-hidden@s' => JText::_('Hidden Small (Phone Landscape)'),
						'uk-hidden@m' => JText::_('Hidden Medium (Tablet Landscape)'),
						'uk-hidden@l' => JText::_('Hidden Large (Desktop)'),
						'uk-hidden@xl' => JText::_('Hidden X-Large (Large Screens)'),
					),
					'std' => '',
				),
				'class' => array(
					'type' => 'text',
					'title' => JText::_('COM_SPPAGEBUILDER_ADDON_CLASS'),
					'desc' => JText::_('COM_SPPAGEBUILDER_ADDON_CLASS_DESC'),
					'std' => '',
				),
			),
		),
	)
);