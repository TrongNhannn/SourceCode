<?php
/**
* @package Helix Ultimate Framework
* @author JoomShaper https://www.joomshaper.com
* @copyright Copyright (c) 2010 - 2018 JoomShaper
* @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or Later
*/

defined ('_JEXEC') or die();

use Joomla\CMS\Factory;
use Joomla\CMS\Uri\Uri;
use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Language\Text;

$app = Factory::getApplication();
$doc = JFactory::getDocument();
$params = $app->getTemplate(true)->params;
$theme_url = URI::base(true) . '/templates/'. $this->template;

$error_title_style = $params->get('error_title_tyle', '');
$error_title_style_cls = $error_title_style ? ' uk-'.$error_title_style : '';

$error_title_background_size 	 	 = $params->get('error_title_background_size', '');
$error_title_background_size_cls = $error_title_background_size ? ' uk-background-'.$error_title_background_size : '';

$error_title_bg_position 	 	 = $params->get('error_title_bg_position', 'center-center');

$error_title_bg_blendmode 	 	 = $params->get('error_title_bg_blendmode', '');
$error_title_bg_blendmode_cls = $error_title_bg_blendmode ? ' uk-background-blend-'.$error_title_bg_blendmode : '';

$error_title_bg_color 	 	 = $params->get('error_title_bg_color');
$error_title_bg_color_cls = $error_title_bg_color ? 'background-color: ' . $error_title_bg_color . ';' : '';
$error_title_bg_image = $params->get('error_bg');
$style = '';

if($error_title_bg_color)
{
	$style .= 'background-color: ' . $error_title_bg_color . ';';
} else {
	$style .= $error_title_bg_color_cls;
}

if($error_title_bg_image)
{
	$style .= 'background-image: url(' . \JURI::base(true) . '/' . $error_title_bg_image . ');';
}

if($style)
{
	$style = 'style="' . $style . '"';
}
?>

<!doctype html>
<html class="error-page" lang="<?php echo $this->language; ?>" dir="<?php echo $this->direction; ?>">
<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<title><?php echo $this->title; ?> <?php echo htmlspecialchars($this->error->getMessage(), ENT_QUOTES, 'UTF-8'); ?></title>

		<?php if ($favicon = $params->get('favicon')) : ?>
			<link rel="icon" href="<?php echo URI::base(true) . '/' . $favicon; ?>" />
		<?php else: ?>
			<link rel="icon" href="<?php echo $theme_url .'/images/favicon.ico'; ?>" />
		<?php endif; ?>

		<?php if(file_exists( \JPATH_THEMES . '/' . $this->template . '/css/bootstrap.min.css' )) : ?>
			<link href="<?php echo $theme_url . '/css/bootstrap.min.css'; ?>" rel="stylesheet">
		<?php else: ?>
			<link href="<?php echo URI::base(true) . '/plugins/system/helixultimate/css/bootstrap.min.css'; ?>" rel="stylesheet">
		<?php endif; ?>

		<?php if(file_exists( \JPATH_THEMES . '/' . $this->template . '/css/custom.css' )) : ?>
			<link href="<?php echo $theme_url . '/css/custom.css'; ?>" rel="stylesheet">
		<?php endif; ?>

		<link href="<?php echo $theme_url . '/css/font-awesome.min.css'; ?>" rel="stylesheet">
		<?php if($this->direction == 'rtl') : ?>
			<link href="<?php echo $theme_url . '/css/uikit-rtl.min.css'; ?>" rel="stylesheet">
		<?php else: ?>
			<link href="<?php echo $theme_url . '/css/uikit.min.css'; ?>" rel="stylesheet">
		<?php endif; ?>
		
		<link href="<?php echo $theme_url . '/css/template.css'; ?>" rel="stylesheet">
		<script src="<?php echo $theme_url . '/js/uikit.min.js'; ?>" type="text/javascript"></script>
		<?php $preset = (isset(json_decode($params->get('preset', (object) ['preset' => 'preset1']))->preset) && json_decode($params->get('preset'))->preset) ? json_decode($params->get('preset'))->preset : 'preset1'; ?>
		<link href="<?php echo $theme_url . '/css/presets/' . $preset . '.css'; ?>" rel="stylesheet">
		
	</head>

<body>

	<?php if($params->get('error_bg')) : ?>
		<div class="uk-background-norepeat<?php echo $error_title_style_cls; echo $error_title_background_size_cls; echo $error_title_bg_blendmode_cls; ?> uk-background-<?php echo $error_title_bg_position; ?> uk-flex uk-flex-center uk-flex-middle uk-text-center"<?php echo $style; ?> uk-height-viewport="expand: true">
		<?php else: ?>
			<div class="uk-panel uk-flex uk-flex-center uk-flex-middle uk-text-center<?php echo $error_title_style_cls; ?>"<?php echo $style; ?> uk-height-viewport="expand: true">
			<?php endif; ?>

			<div class="container uk-text-center">

				<?php if($params->get('error_logo')) : ?>
					<a href="<?php echo $this->baseurl; ?>/index.php">
						<img class="error-logo" src="<?php echo URI::base(true) . '/' . $params->get('error_logo'); ?>" alt="<?php echo htmlspecialchars($this->title); ?>">
					</a>
				<?php endif; ?>

				<h1 class="uk-heading-2xlarge uk-text-bold"><?php echo $this->error->getCode(); ?></h1>
				<h2 class="uk-h3 uk-margin"><?php echo htmlspecialchars($this->error->getMessage(), ENT_QUOTES, 'UTF-8'); ?></h2>

				<a href="<?php echo $this->baseurl; ?>/index.php" class="uk-button uk-button-secondary uk-margin-top"><span class="fas fa-home" aria-hidden="true"></span> <?php echo Text::_('JERROR_LAYOUT_HOME_PAGE'); ?></a>
				<?php
				$modules = JModuleHelper::getModules( '404' );
				$attribs['style'] = 'sp_xhtml';
				if(!empty($modules) && count($modules)): // Render modules if published in 404 position ?>
					<div class="error-modules">
						<?php foreach ($modules as $key => $module) :
							echo JModuleHelper::renderModule( $module, $attribs );
						endforeach; ?>
					</div>
				<?php endif; ?>

				<?php if ($this->debug) : ?>
					<div class="error-debug mt-3">
						<?php echo $this->renderBacktrace(); ?>
						<?php if ($this->error->getPrevious()) : ?>
							<?php $loop = true; ?>
							<?php $this->setError($this->_error->getPrevious()); ?>
							<?php while ($loop === true) : ?>
								<p><strong><?php echo Text::_('JERROR_LAYOUT_PREVIOUS_ERROR'); ?></strong></p>
								<p><?php echo htmlspecialchars($this->_error->getMessage(), ENT_QUOTES, 'UTF-8'); ?></p>
								<?php echo $this->renderBacktrace(); ?>
								<?php $loop = $this->setError($this->_error->getPrevious()); ?>
							<?php endwhile; ?>
							<?php // Reset the main error object to the base error ?>
							<?php $this->setError($this->error); ?>
						<?php endif; ?>
					</div>
				<?php endif; ?>
			</div>
		</div>


	</body>

	</html>
