<?php

/**
 * @package Helix Ultimate Framework
 * @author JoomShaper https://www.joomshaper.com
 * @copyright Copyright (c) 2010 - 2018 JoomShaper
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or Later
 */

defined('_JEXEC') or die();

$doc = JFactory::getDocument();
$app = JFactory::getApplication();

$helix_path = JPATH_PLUGINS . '/system/helixultimate/core/helixultimate.php';
if (file_exists($helix_path)) {
    require_once($helix_path);
    $theme = new helixUltimate;
} else {
    die('Install and activate <a target="_blank" href="https://www.joomshaper.com/helix">Helix Ultimate Framework</a>.');
}

// If comingsoon is enabled and logged in user doens't have permission to login in the offline then redirect to comingsoon page
if ( $this->params->get('comingsoon') && !\JFactory::getUser()->authorise('core.login.offline') )
{
  header("Location: " . $this->baseUrl . "?tmpl=comingsoon");
}

$custom_style = $this->params->get('custom_style');
$preset = $this->params->get('preset');
$offcanvs_position = $this->params->get('offcanvas_position', 'right');
if ($custom_style || !$preset) {
    $scssVars = array(
        'preset' => 'default',
        'text_color' => $this->params->get('text_color'),
        'bg_color' => $this->params->get('bg_color'),
        'link_color' => $this->params->get('link_color'),
        'link_hover_color' => $this->params->get('link_hover_color'),
        'header_top_bg_color' => $this->params->get('header_top_bg_color'), 
        'header_bg_color' => $this->params->get('header_bg_color'), 
        'header_bottom_bg_color' => $this->params->get('header_bottom_bg_color'), 
        'logo_text_color' => $this->params->get('logo_text_color'),
        'header_bg_mobile_color' => $this->params->get('header_bg_mobile_color'), 
        'logo_text_mobile_color' => $this->params->get('logo_text_mobile_color'),
        'toggle_mobile_color' => $this->params->get('toggle_mobile_color'),
        'toggle_mobile_hover_color' => $this->params->get('toggle_mobile_hover_color'),
        'menu_text_color' => $this->params->get('menu_text_color'),
        'menu_text_hover_color' => $this->params->get('menu_text_hover_color'),
        'menu_text_active_color' => $this->params->get('menu_text_active_color'),
        'menu_dropdown_bg_color' => $this->params->get('menu_dropdown_bg_color'),
        'menu_dropdown_text_color' => $this->params->get('menu_dropdown_text_color'),
        'menu_dropdown_text_hover_color' => $this->params->get('menu_dropdown_text_hover_color'),
        'menu_dropdown_text_active_color' => $this->params->get('menu_dropdown_text_active_color'),
        'bottom_bg_color' => $this->params->get('bottom_bg_color'),
        'bottom_title_color' => $this->params->get('bottom_title_color'),
        'bottom_text_color' => $this->params->get('bottom_text_color'),
        'bottom_link_color' => $this->params->get('bottom_link_color'),
        'bottom_link_hover_color' => $this->params->get('bottom_link_hover_color'),        
        'footer_bg_color' => $this->params->get('footer_bg_color'),
        'footer_text_color' => $this->params->get('footer_text_color'),
        'footer_link_color' => $this->params->get('footer_link_color'),
        'footer_link_hover_color' => $this->params->get('footer_link_hover_color'),
        'topbar_bg_color' => $this->params->get('topbar_bg_color'),
        'topbar_text_color' => $this->params->get('topbar_text_color'),
        'topbar_link_color' => $this->params->get('topbar_link_color'),
        'topbar_link_hover_color' => $this->params->get('topbar_link_hover_color')
    );
} else {
    $scssVars = (array) json_decode($this->params->get('preset'));
}

$scssVars['topbar_padding_top'] = $this->params->get('topbar_padding_top', '10px');
$scssVars['topbar_padding_bottom'] = $this->params->get('topbar_padding_bottom', '10px');
$scssVars['toolbar_font_size'] = $this->params->get('toolbar_font_size', '14px');
$scssVars['social_icons_size'] = $this->params->get('social_icons_size', '16px');
$scssVars['header_height'] = $this->params->get('header_height', '82px');
$scssVars['headerbar_top_padding'] = $this->params->get('headerbar_top_padding', '20px 0');
$scssVars['headerbar_bottom_padding'] = $this->params->get('headerbar_bottom_padding', '20px 0');
$scssVars['header_stacked_margin'] = $this->params->get('header_stacked_margin', '20px');
$scssVars['offcanvas_width'] = $this->params->get('offcanvas_width', '300') . 'px';
$scssVars['body_bg_color'] = $this->params->get('body_bg_color', '#f0f0f0');
$scssVars['page_title_bg_color'] = $this->params->get('page_title_bg_color', '#282828');

$boxed = $this->params->get('boxed_layout');
$boxed_center = $this->params->get('boxed_center') ? ' uk-margin-auto' : '';
$boxed_top_margin = $this->params->get('boxed_top_margin') ? ' tm-page-margin-top' : '';
$boxed_bottom_margin = $this->params->get('boxed_bottom_margin') ? ' tm-page-margin-bottom' : '';
$boxed_header_outside = $this->params->get('boxed_header_outside');

// Body Media
$body_media[] = $boxed ? ' uk-clearfix' : '';

$bg_image = $this->params->get('body_bg_image');
$body_image_size = $this->params->get('body_image_size') ? ' uk-background-'.$this->params->get('body_image_size') : '';
$body_image_position = $this->params->get('body_image_position') ? ' uk-background-'.$this->params->get('body_image_position') : '';
$body_image_visibility = $this->params->get('body_image_visibility') ? ' uk-background-image@'.$this->params->get('body_image_visibility') : '';

$body_image_effect = $this->params->get('body_image_effect');
$body_image_effect_init = $body_image_effect == 'parallax' ? ' uk-background-fixed' : '';
$body_image_effect_init .= $body_image_effect ? ' uk-position-cover uk-position-fixed' : '';

$body_media_init = $boxed && empty($body_image_effect) && $bg_image;

if ($body_media_init) {
    $body_media[] = ' uk-background-norepeat';
    $body_media[] = $body_image_size . $body_image_position . $body_image_visibility;
}

$body_parallax_bgx_start = $this->params->get('body_parallax_bgx_start', '0');
$body_parallax_bgx_end = $this->params->get('body_parallax_bgx_end', '0');
$body_parallax_bgy_start = $this->params->get('body_parallax_bgy_start', '0');
$body_parallax_bgy_end = $this->params->get('body_parallax_bgy_end', '0');

$body_parallax_easing     = $this->params->get('body_parallax_easing') ? ( (int) $this->params->get('body_parallax_easing') / 100 ) : '';
$body_parallax_easing_cls = ( ! empty( $body_parallax_easing ) ) ? 'easing: ' . $body_parallax_easing . ';' : '';

$body_parallax_breakpoint     = $this->params->get('body_parallax_breakpoint');
$body_parallax_breakpoint_cls = ( ! empty( $body_parallax_breakpoint ) ) ? 'media: @' . $body_parallax_breakpoint . ';' : '';

$bgx       = ( ! empty( $body_parallax_bgx_start ) || ! empty( $body_parallax_bgx_end ) ) ? 'bgx: ' . $body_parallax_bgx_start . ',' . $body_parallax_bgx_end . ';' : '';
$bgy       = ( ! empty( $body_parallax_bgy_start ) || ! empty( $body_parallax_bgy_end ) ) ? 'bgy: ' . $body_parallax_bgy_start . ',' . $body_parallax_bgy_end . ';' : '';

$body_parallax = $body_image_effect == 'parallax' ? ' uk-parallax="'.$bgx . $bgy . $body_parallax_easing_cls . $body_parallax_breakpoint_cls .'target:body"' : '';

$body_media       = implode( '', array_filter( $body_media ) );

//Custom CSS
if ($custom_css = $this->params->get('custom_css')) {
    $doc->addStyledeclaration($custom_css);
}

// Reading progress bar position
$progress_bar_position = $this->params->get('reading_timeline_position');
if( $app->input->get('view') == 'article' && $this->params->get('reading_time_progress', 0) ) {    
    $progress_style = 'position:fixed;';
    $progress_style .= 'z-index:9999;';
    $progress_style .= 'height:'.$this->params->get('reading_timeline_height').';';
    $progress_style .= 'background-color:'.$this->params->get('reading_timeline_bg').';';
    $progress_style .= $progress_bar_position == 'top' ? 'top:0;' : 'bottom:0;';
    $progress_style = '.sp-reading-progress-bar { '.$progress_style.' }';
    $doc->addStyledeclaration($progress_style);
}

//Custom JS
if ($custom_js = $this->params->get('custom_js')) {
    $doc->addScriptdeclaration($custom_js);
}

$tpl_assets = $this->params->get('tpl_assets');
?>

<!doctype html>
<html lang="<?php echo $this->language; ?>" dir="<?php echo $this->direction; ?>">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="canonical" href="<?php echo JUri::getInstance()->toString(); ?>">
    <?php

    $theme->head();
    // CSS files
    $theme->add_css('font-awesome.min.css');
    $theme->add_css('custom');
    // Fontawesome 4 to 5 compatible CSS file
    $theme->add_css('fa-v4-shims.css');
    
    if($this->direction == 'rtl')
    {
        $theme->add_css('uikit-rtl.min.css');
        $theme->add_scss('rtl', $scssVars, 'rtl');
    } else {
        $theme->add_css('uikit.min.css');
    }
    // Scss files
    $theme->add_scss('master', $scssVars, 'template');    
    $theme->add_scss('presets', $scssVars, 'presets/' . $scssVars['preset']);

    // JS files
    $theme->add_js('uikit.min.js,main.js');

    //Icon Library
    if ($tpl_assets) {
        $theme->add_js('uikit-icons.min.js');
    }

    //Before Head
    if ($before_head = $this->params->get('before_head'))
    {
        echo $before_head . "\n";
    }

    ?>
</head>

<body class="<?php echo $theme->bodyClass(); ?>">  

    <?php if ($this->params->get('preloader')) : ?>
        <div id="preloader" class="uk-width-1-1 uk-height-1-1 uk-position-fixed uk-overflow-hidden uk-background-default" style="z-index: 9999;">
            <div class="uk-position-center">
                <span class="uk-text-primary" uk-spinner="ratio: 2"></span>
            </div>
        </div>
    <?php endif; ?>

    <?php if($body_media_init) : ?>
    <div class="body-wrapper<?php echo $body_media; ?>" data-src="<?php echo JUri::base(true) . '/' . $bg_image; ?>" uk-img>
    <?php else: ?>
    <div class="body-wrapper<?php echo $body_media; ?>">
    <?php endif; ?>

    <?php if ($boxed && $bg_image && $body_image_effect) : ?>
        <div class="uk-background-norepeat<?php echo $body_image_size; echo $body_image_position; echo $body_image_visibility; echo $body_image_effect_init; ?>" data-src="<?php echo JUri::base(true) . '/' . $bg_image; ?>" uk-img<?php echo $body_parallax; ?>></div>
    <?php endif; ?>

        <?php if ($boxed_header_outside) : ?>
            <?php echo $theme->getHeaderStyle(); ?>
        <?php endif; ?>

        <?php if ($boxed) : ?>
            <div class="tm-page<?php echo $boxed_center; echo $boxed_top_margin; echo $boxed_bottom_margin; ?>">
        <?php endif; ?>

            <?php if (!$boxed_header_outside) : ?>
                <?php echo $theme->getHeaderStyle(); ?>
            <?php endif; ?>

            <?php $theme->render_layout(); ?>

        <?php if ($boxed) : ?>
            </div>
        <?php endif; ?>

    </div>

    <?php $theme->after_body(); ?>

    <jdoc:include type="modules" name="debug" style="none" />

    <?php if ($this->params->get('preloader')) : ?>
        <script>
            jQuery(function($) {
                $(window).on('load', function() {
                    $('#preloader').fadeOut(500, function() {
                        $(this).remove();
                    });
                });
            });
        </script>
    <?php endif; ?>

    <?php if ($this->params->get('goto_top', 0)) : ?>
    <a href="#" class="back__top" aria-label="Scroll Up" uk-scroll><span class="fa fa-chevron-up" aria-hidden="true"></span></a>
    <?php endif; ?>

    <?php if ($app->input->get('view') == 'article' && $this->params->get('reading_time_progress', 0)) : ?>
        <div data-position="<?php echo $progress_bar_position; ?>" class="sp-reading-progress-bar"></div>
    <?php endif; ?>

</body>

</html>