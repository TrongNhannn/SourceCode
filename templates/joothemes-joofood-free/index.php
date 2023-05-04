<?php
/*******************************************************************************************

JooFood Joomla! 3 Responsive Template - November 2019
Package tpl-joothemes-joofood-j3.zip

@copyright	(C) 2019 JooThemes.net

http://joothemes.net

*******************************************************************************************/
defined('_JEXEC') or die;

include 'includes/params.php';

if ($params->get('compile_sass', '0') === '1')
{
	require_once "includes/sass.php";
}

?>
<!DOCTYPE html>
<html lang="en">
<?php
 include 'includes/head.php'; ?>
<body class="default-layout <?php if ($menu->getActive()!== $menu->getDefault()) {echo 'no-homepage'; }else {}?>">
<?php
 if($layout=='boxed'){ ?>
<?php  $path= JURI::base().'templates/'.$this->template."/images/elements/pattern".$pattern.".png"; ?>
<style type="text/css">
 body {
    background: url("<?php  echo $path ; ?>") repeat fixed center top rgba(0, 0, 0, 0);
 }
</style>
<div class="layout-boxed">
  <?php  } ?>
<div id="wrap">
<!--Navigation-->
<header id="header" class="header header-fixed hide-from-print" role="banner">

<!--top-->
<div id="navigation">
<div class="navbar navbar-default" role="navigation">
<div class="container">
	<div class="top-header">
		<div class="row">
			<div id="">
				 <a href="<?php  echo $this->params->get('logo_link')   ?>">
					   <?php if ($logotype == 'image' ) : ?>
							<img style="width:<?php  echo $this->params->get('logo_width')   ?>px; height:<?php  echo $this->params->get('logo_height')   ?>px; " src="<?php  echo $this->params->get('logo_file')   ?>" alt="<?php echo htmlspecialchars($app->getCfg('sitename')); ?>" />
							<?php endif; ?>
							<?php if ($logotype == 'text' ) : ?>
								<span class="brand-txt"><?php echo $logotext; ?></span>
								<?php if ($logoslogan != '' ) : ?>
									<span class="brand-slogan"><?php echo $logoslogan; ?></span>
								<?php endif; ?>
							<?php endif; ?>
				 </a>
				</div>
				<div class="main-menu-top">
				<?php  if ($this->countModules('navigation')) : ?>
				                        <nav class="navigation" role="navigation">
				                                <jdoc:include type="modules" name="navigation" style="none" />
				                        </nav>
				                        <?php  endif; ?>
				<?php if ($superfish == 'yes' ) : ?>
					<?php $doc->addStyleSheet('templates/' . $this->template . '/css/superfish.css');  ?>
					<script type="text/javascript" src="<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/js/hoverIntent.js"></script>
				    <script type="text/javascript" src="<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/js/superfish.js"></script>

				    <script type="text/javascript">
						jQuery(document).ready(function(){
							jQuery('#navigation .menu').superfish({
								animation: {height:'show'},	// slide-down effect without fade-in
								 speed:         'fast',
								delay:		 600			// 1.2 second delay on mouseout
							});
						});
					</script>
				<?php endif; ?>
				<?php  if($this->countModules('top-search')) : ?>
						<div  class="top-search">
											 <jdoc:include type="modules" name="top-search" style="block"/>
						</div>
				<?php  endif; ?>
				</div>
		 </div>
	</div>



</div>
</div>
</div>
</header>
<div class="clearfix"></div>
<!--Navigation-->
<section <?php if ($menu->getActive()!== $menu->getDefault()) {echo 'class="section_m"'; }else {}?> >


<!--fullwidth-->
<?php if ($this->countModules( 'fullwidth' )) : ?>
	<div id="fullwidth">
						<jdoc:include type="modules" name="fullwidth" style="block"/>
	</div>
<?php  endif; ?>
<!--fullwidth-->

<!--Breadcrum-->
<?php  if($this->countModules('breadcrumbs')) : ?>
<div id="breadcrumbs">
<div class="container">
<jdoc:include type="modules" name="breadcrumbs" style="block" />
</div>
</div>
<!--Breadcrum-->
<?php  endif; ?>

<!--Feature-->
<?php  if($this->countModules('feature')) : ?>
<div id="feature">
<div class="container">
<div class="row">
	<div class="col-md-12">
<jdoc:include type="modules" name="feature" style="block" />
</div>
</div>
</div>
</div>
<?php  endif; ?>
<!--Feature-->

<!--Feature-->
<?php  if($this->countModules('box-line')) : ?>
<div id="box-line">

<jdoc:include type="modules" name="box-line" style="block" />

</div>
<?php  endif; ?>
<!--Feature-->



<!--top-box-->
<?php if ($this->countModules( 'top-box' )) : ?>
	<div id="top-box">
		<div class="container">
			<div class="row">
					<div class="col-sm-12">
						<jdoc:include type="modules" name="top-box" style="block"/>
					</div>
	</div>
</div>
</div>
<?php  endif; ?>
<!--top-box-->
<!-- Content -->
<div class="container ">
	<div class="row">
<div id="main" class="row show-grid">
<!-- Component -->
<div id="container" class="col-sm-<?php  echo (12-$leftcolgrid-$rightcolgrid); ?>">
<!-- Content-top Module Position -->
<?php  if($this->countModules('content-top')) : ?>
<div id="content-top">

<jdoc:include type="modules" name="content-top" style="block" />

</div>
<?php  endif; ?>
<!-- Front page show or hide -->
<?php
	$app = JFactory::getApplication();
	$menu = $app->getMenu();
	if ($frontpageshow){
		// show on all pages
		?>
<div id="main-box">
<jdoc:include type="message" />
<jdoc:include type="component" />
</div>
<?php
	} else {

		if ($menu->getActive() !== $menu->getDefault()) {
			// show on all pages but the default page
			?>
<div id="main-box">
<jdoc:include type="component" />
</div>
<?php
 }} ?>
<!-- Front page show or hide -->
<!-- Below Content Module Position -->
<?php  if($this->countModules('content-bottom')) : ?>
<div id="content-bottom">


		<jdoc:include type="modules" name="content-bottom" style="block" />


</div>
<?php  endif; ?>
</div>
<!-- Right -->
<?php  if($this->countModules('right')) : ?>
<div id="sidebar-2" class="col-sm-<?php  echo $rightcolgrid; ?>">
<jdoc:include type="modules" name="right" style="block" />
</div>
<?php  endif; ?>
</div>
</div>
</div>
<!-- Content -->



<!-- bottom -->
<?php  if($this->countModules('bottom')) : ?>
<div id="bottom">

    <jdoc:include type="modules" name="bottom" style="block" />

</div>
<?php  endif; ?>
<?php	$footer1 = $this->countModules( 'footer1 + footer2 + footer3 + footer4' );
		switch ($footer1) {
		    case "1":
		       $footerclass1='col-md-12';
		        break;
		    case "2":
		       $footerclass1='col-md-6 col-xs-6';
		        break;
		    case "3":
		       $footerclass1='col-md-4 col-sm-4 ';
		        break;
				case "4":
				    $footerclass1='col-md-3 col-sm-3 col-xs-6';
				    break;
				default:
					 $footerclass1='col-md-4';
		}
?>
<?php if ($this->countModules( 'footer1 or footer2 or footer3 or footer4' )) : ?>
<!-- footer -->
	<div id="footer">
		<div class="container">
			  <div class="row">
					<?php  if($this->countModules('footer1')) : ?>
							<div class="<?php echo $footerclass1 ?>">
									<jdoc:include type="modules" name="footer1" style="block" />
						  </div>
					<?php  endif; ?>
					<?php  if($this->countModules('footer2')) : ?>
							<div class="<?php echo $footerclass1 ?>">
									<jdoc:include type="modules" name="footer2" style="block" />
							</div>
					<?php  endif; ?>
					<?php  if($this->countModules('footer3')) : ?>
							<div class="<?php echo $footerclass1 ?>">
									<jdoc:include type="modules" name="footer3" style="block" />
						  </div>
					<?php  endif; ?>

			  </div>
		</div>
	</div>
<?php  endif; ?>
<!-- footer -->
<div id="footer_social">
    <div class="container">
							<?php include "social.php"; ?>
		</div>
</div>


<div id="footer_copy">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
            	<div class="custom"  >
	                <p class="pull-left">Copyright &copy; <?php echo (date("Y")); ?> <?php echo htmlspecialchars($app->getCfg('sitename')); ?></p>
					 <p class="pull-right">Template from JooThemes.net <a href="https://joothemes.net" target="_blank">Food blog, Recipes Free Joomla Template</a>.</p>
				</div>
            </div>
        </div>
    </div>
</div>

<!-- copy -->
<!-- menu slide -->
<?php  if($this->countModules('panelnav')): ?>
<div id="panelnav">
    <jdoc:include type="modules" name="panelnav" style="none" />
</div><!-- end panelnav -->
<?php  endif;// end panelnav  ?>
<!-- menu slide -->
<a href="#" class="back-to-top iconn-arrow_up"></a>
<jdoc:include type="modules" name="debug" />

</section>
</div>
<!-- page -->
<!-- JS -->
<script type="text/javascript" src="<?php echo $tpath; ?>/js/jquery.flexisel.js"></script>
<script type="text/javascript" src="<?php echo $tpath; ?>/js/jquery.slicknav.min.js"></script>
<script type="text/javascript" src="<?php echo $tpath; ?>/js/image-scale.min.js"></script>
<script type="text/javascript" src="<?php echo $tpath; ?>/js/jquery.tinyTips.js"></script>
<script type="text/javascript" src="<?php echo $tpath; ?>/js/tools.js"></script>
<script type="text/javascript" src="<?php echo $tpath; ?>/js/jquery.matchHeight-min.js"></script>
<script type="text/javascript" src="<?php echo $tpath; ?>/js/jquery.corner.js"></script>
<script type="text/javascript" src="<?php echo $tpath; ?>/js/template.min.js"></script>
<!-- JS -->
</body>
</html>
