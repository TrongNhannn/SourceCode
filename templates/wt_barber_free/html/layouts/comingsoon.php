<?php
/**
* @package Helix Ultimate Framework
* @author JoomShaper https://www.joomshaper.com
* @copyright Copyright (c) 2010 - 2018 JoomShaper
* @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or later
*/

defined('_JEXEC') or die;

extract($displayData);

$app = \JFactory::getApplication();
$doc = JFactory::getDocument();
$params = $app->getTemplate(true)->params;

$helix_path = JPATH_PLUGINS . '/system/helixultimate/core/helixultimate.php';
if (file_exists($helix_path)) {
  require_once($helix_path);
  $theme = new helixUltimate;
} else {
  die('Install and activate <a target="_blank" href="https://www.joomshaper.com/helix">Helix Ultimate Framework</a>.');
}

$site_title = $app->get('sitename');
// if offline page
$offline_condition = !$params->get('comingsoon') &&  $app->get('offline');
$offline_class = ( $offline_condition )? 'offline': '';

$offline_title_style = $params->get('comingsoon_title_tyle', '');
$offline_title_style_cls = $offline_title_style ? ' uk-'.$offline_title_style : '';

$offline_title_background_size 	 	 = $params->get('comingsoon_title_background_size', '');
$offline_title_background_size_cls = $offline_title_background_size ? ' uk-background-'.$offline_title_background_size : '';

$offline_title_bg_position 	 	 = $params->get('comingsoon_title_bg_position', 'center-center');

$offline_title_bg_blendmode 	 	 = $params->get('comingsoon_title_bg_blendmode', '');
$offline_title_bg_blendmode_cls = $offline_title_bg_blendmode ? ' uk-background-blend-'.$offline_title_bg_blendmode : '';

$offline_title_bg_color 	 	 = $params->get('comingsoon_title_bg_color');
$offline_title_bg_color_cls = $offline_title_bg_color ? 'background-color: ' . $offline_title_bg_color . ';' : '';
$offline_title_bg_image = $params->get('comingsoon_bg_image');
$style = '';

if($offline_title_bg_color)
{
	$style .= 'background-color: ' . $offline_title_bg_color . ';';
} else {
	$style .= $offline_title_bg_color_cls;
}

if($offline_title_bg_image)
{
	$style .= 'background-image: url(' . \JURI::base(true) . '/' . $offline_title_bg_image . ');';
}

if($style)
{
	$style = 'style="' . $style . '"';
}

?>

<!doctype html>
<html class="coming-soon <?php echo $offline_class; ?>" lang="<?php echo $language; ?>" dir="<?php echo $direction; ?>">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <?php
			$theme->head();
      $theme->add_css('font-awesome.min.css, template.css, uikit.min.css');
			$theme->add_js('uikit.min.js');
			$theme->add_js('custom.js');      
			$theme->add_css('presets/' . $params->get('preset', 'preset1') . '.css');
			$theme->add_css('custom.css');
			//Custom CSS
			if ($custom_css = $params->get('custom_css')) {
				$doc->addStyledeclaration($custom_css);
			}
			//Custom JS
			if ($custom_js = $params->get('custom_js')) {
				$doc->addScriptdeclaration($custom_js);
			}
        ?>  
</head>
<body>


  <jdoc:include type="message" />
  <?php if( $offline_condition ) : ?>
				<div class="offline-wrapper">
	<?php endif; ?>

	<?php if($params->get('comingsoon_bg_image')) : ?>
		<div class="uk-background-norepeat<?php echo $offline_title_style_cls; echo $offline_title_background_size_cls; echo $offline_title_bg_blendmode_cls; ?> uk-background-<?php echo $offline_title_bg_position; ?> uk-flex uk-flex-center uk-flex-middle uk-text-center"<?php echo $style; ?> uk-height-viewport="expand: true">
		<?php else: ?>
			<div class="uk-panel uk-flex uk-flex-center uk-flex-middle uk-text-center<?php echo $offline_title_style_cls; ?>"<?php echo $style; ?> uk-height-viewport="expand: true">
			<?php endif; ?>
      
      <div class="container uk-text-center">

        <?php if($params->get('comingsoon_logo') && $params->get('comingsoon')) : ?>
          <img class="coming-soon-logo" src="<?php echo $params->get('comingsoon_logo'); ?>" alt="<?php echo htmlspecialchars($site_title); ?>">
        <?php endif; ?>

        <?php if($params->get('comingsoon_title') && $params->get('comingsoon')) : ?>
          <h1 class="uk-heading-primary"><?php echo htmlspecialchars($params->get('comingsoon_title')); ?></h1>
        <?php else: ?>
          <h1 class="uk-heading-primary"><?php echo htmlspecialchars($site_title); ?></h1>
        <?php endif; ?>

        <?php if($params->get('comingsoon_content') && $params->get('comingsoon')) : ?>
          <div class="row justify-content-center">
            <div class="col-lg-8">
              <div class="uk-h3">
                <?php echo $params->get('comingsoon_content'); ?>
              </div>
            </div>
          </div>
        <?php else: ?>
          <?php if ($app->get('display_offline_message', 1) == 1 && str_replace(' ', '', $app->get('offline_message')) != '') : ?>
            <div class="row justify-content-center">
              <div class="col-lg-8">
                <div class="coming-soon-content uk-margin">
                  <?php echo $app->get('offline_message'); ?>
                </div>
              </div>
            </div>
          <?php elseif ($app->get('display_offline_message', 1) == 2) : ?>
            <div class="row justify-content-center">
              <div class="col-lg-8">
                <div class="coming-soon-content">
                  <?php echo Text::_('JOFFLINE_MESSAGE'); ?>
                </div>
              </div>
            </div>
          <?php endif; ?>
        <?php endif; ?>

        <?php if($params->get('comingsoon_date') && $params->get('comingsoon')) : ?>
          <?php $comingsoon_date = $params->get("comingsoon_date"); ?>

          <div class="uk-grid-small uk-child-width-auto uk-flex-center uk-margin-large" uk-grid uk-countdown="date: <?php echo $comingsoon_date; ?>T14:20:15+00:00">
            <div>
              <div class="uk-countdown-number uk-countdown-days"></div>
              <div class="uk-countdown-label uk-margin-small uk-text-center uk-visible@s"><?php echo JText::_("HELIX_ULTIMATE_DAYS"); ?></div>
            </div>
            <div class="uk-countdown-separator">:</div>
            <div>
              <div class="uk-countdown-number uk-countdown-hours"></div>
              <div class="uk-countdown-label uk-margin-small uk-text-center uk-visible@s"><?php echo JText::_("HELIX_ULTIMATE_HOURS"); ?></div>
            </div>
            <div class="uk-countdown-separator">:</div>
            <div>
              <div class="uk-countdown-number uk-countdown-minutes"></div>
              <div class="uk-countdown-label uk-margin-small uk-text-center uk-visible@s"><?php echo JText::_("HELIX_ULTIMATE_MINUTES"); ?></div>
            </div>
            <div class="uk-countdown-separator">:</div>
            <div>
              <div class="uk-countdown-number uk-countdown-seconds"></div>
              <div class="uk-countdown-label uk-margin-small uk-text-center uk-visible@s"><?php echo JText::_("HELIX_ULTIMATE_SECONDS"); ?></div>
            </div>
          </div>

        <?php endif; ?>

        <?php if($theme->count_modules('comingsoon') && $params->get('comingsoon')) : ?>
          <div class="coming-soon-position">
            <jdoc:include type="modules" name="comingsoon" style="sp_xhtml" />
          </div>
        <?php endif; ?>

        <?php
        $facebook 	= $params->get('facebook');
        $twitter  	= $params->get('twitter');
        $pinterest 	= $params->get('pinterest');
        $youtube 	= $params->get('youtube');
        $linkedin 	= $params->get('linkedin');
        $dribbble 	= $params->get('dribbble');
        $behance 	= $params->get('behance');
        $flickr 	= $params->get('flickr');
        $instagram 	= $params->get('instagram');
        $whatsapp 	= $params->get('whatsapp');
        if( $params->get('comingsoon_social_icons') && ( $facebook || $twitter || $pinterest || $youtube || $linkedin || $dribbble || $behance || $flickr || $instagram || $whatsapp ) && $params->get('comingsoon') )
        {
          $social_output  = '<div class="social-icons">';

          if( $facebook )
          {
            $social_output .= '<a class="uk-icon-button uk-link-reset uk-margin-small-right" target="_blank" href="'. $facebook .'"><i class="fab fa-facebook-f" aria-hidden="true"></i></a>';
          }
          if( $twitter )
          {
            $social_output .= '<a class="uk-icon-button uk-link-reset uk-margin-small-right" target="_blank" href="'. $twitter .'"><i class="fab fa-twitter" aria-hidden="true"></i></a>';
          }
          if( $pinterest )
          {
            $social_output .= '<a class="uk-icon-button uk-link-reset uk-margin-small-right" target="_blank" href="'. $pinterest .'"><i class="fab fa-pinterest" aria-hidden="true"></i></a>';
          }
          if( $youtube )
          {
            $social_output .= '<a class="uk-icon-button uk-link-reset uk-margin-small-right" target="_blank" href="'. $youtube .'"><i class="fab fa-youtube" aria-hidden="true"></i></a>';
          }
          if( $linkedin )
          {
            $social_output .= '<a class="uk-icon-button uk-link-reset uk-margin-small-right" target="_blank" href="'. $linkedin .'"><i class="fab fa-linkedin-in" aria-hidden="true"></i></a>';
          }
          if( $dribbble )
          {
            $social_output .= '<a class="uk-icon-button uk-link-reset uk-margin-small-right" target="_blank" href="'. $dribbble .'"><i class="fab fa-dribbble" aria-hidden="true"></i></a>';
          }
          if( $behance )
          {
            $social_output .= '<a class="uk-icon-button uk-link-reset uk-margin-small-right" target="_blank" href="'. $behance .'"><i class="fab fa-behance" aria-hidden="true"></i></a>';
          }
          if( $flickr )
          {
            $social_output .= '<a class="uk-icon-button uk-link-reset uk-margin-small-right" target="_blank" href="'. $flickr .'"><i class="fab fa-flickr" aria-hidden="true"></i></a>';
          }
          if( $instagram )
          {
            $social_output .= '<a class="uk-icon-button uk-link-reset uk-margin-small-right" target="_blank" href="'. $instagram .'"><i class="fab fa-instagram" aria-hidden="true"></i></a>';
          }
          if( $whatsapp )
          {
            $social_output .= '<a class="uk-icon-button uk-link-reset uk-margin-small-right" target="_blank" href="whatsapp://send?abid='. $whatsapp .'&text=Hi"><i class="fab fa-whatsapp" aria-hidden="true"></i></a>';
          }
          $social_output .= '</div>';

          echo $social_output;
        }
        ?>

        <?php if(isset($login) && $login) : ?>
          <div class="row justify-content-center"><?php echo $login_form; ?></div>
        <?php endif; ?>

        <?php $theme->after_body(); ?>

        </div>

      <?php if($params->get('comingsoon_bg_image')) : ?>
      </div>
      <?php endif; ?>
    
      <?php if( $offline_condition ) : ?>
				</div>
			<?php endif; ?>

</body>
</html>
