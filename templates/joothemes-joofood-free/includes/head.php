<?php
 /*------------------------------------------------------------------------
# author    Gonzalo Suez
# Copyright © 2013 gsuez.cl. All rights reserved.
# @license  http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
# Website   http://www.gsuez.cl
-------------------------------------------------------------------------*/// no direct access
defined('_JEXEC') or die;
JHtml::_('bootstrap.framework');
$googleFont		= $this->params->get('googleFont');
$googleFontBody	= $this->params->get('googleFontBody');
$googleFontWeight = $this->params->get('googleFontWeight');
$googleFontCharacter = $this->params->get('googleFontCharacter');

?>
<head>

	<jdoc:include type="head" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
	<link href='//fonts.googleapis.com/css?family=<?php echo $this->params->get('googleFont');?>|<?php echo $this->params->get('googleFontBody');?>:<?php echo $this->params->get('googleFontWeight');?>&subset=<?php echo $this->params->get('googleFontCharacter');?>' rel='stylesheet' type='text/css' />

    <style type="text/css">

/* Template Style
---------------------------------------------------------------------- */
<?php // Google Font Body
if ($googleFontBody) { ?>
	body, h3, h4, h5, h6, .navigation a, #fullwidth a, 	.blog-featured .page-header h1{
		font-family: '<?php echo str_replace('+', ' ', $this->params->get('googleFontBody'));?>', Verdana, Arial, Helvetica, sans-serif;

	}
<?php } ?>

<?php // Google Font Regular
if ($googleFont) { ?>
h1
	 {
		font-family: '<?php echo str_replace('+', ' ', $this->params->get('googleFont'));?>', sans-serif;
		font-weight: 400;
	}
<?php } ?>
<?php // Google Font regular
if ($googleFont) { ?>
	.logo a, .bt-title,
	div.profile legend,
	.hello,
	div.k2ItemsBlock ul li div.moduleItemTags b,
	span.itemNavigationTitle,
  #top p {
		font-family: '<?php echo str_replace('+', ' ', $this->params->get('googleFont'));?>', sans-serif;
		font-weight: 500;
	}
<?php } ?>

<?php // Google Font 300
if ($googleFont) { ?>
	h2.item-page-title,
	 {
		font-family: '<?php echo str_replace('+', ' ', $this->params->get('googleFont'));?>', sans-serif;
		font-weight: 300;
	}
<?php } ?>

<?php // Google Font 700
if ($googleFont) { ?>
	#menu-icon, .portfolio h2,  #showcase .col-md-6 h3, .bt-category,
  .more_bt, .lndtitle, .breadcrumb, #main-box .jweb-content-title  {
		font-family: '<?php echo str_replace('+', ' ', $this->params->get('googleFont'));?>', sans-serif;
		font-weight: 700!important;
	}
<?php } ?>

</style>
    <!--[if lte IE 8]>
		<script src="//cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.js"></script>
		<?php  if ($pie == 1) : ?>
			<style>
				{behavior:url(<?php  echo $tpath; ?>/js/PIE.htc);}
			</style>
		<?php  endif; ?>
	<![endif]-->
</head>
