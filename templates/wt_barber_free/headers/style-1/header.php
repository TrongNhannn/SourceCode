<?php
/**
 * Navbar Left
 */

defined ('_JEXEC') or die('Restricted Access');

$doc                  = JFactory::getDocument();
$data                 = $displayData;
$attrs_sticky[]       = '';

$navbar_search = $data->params->get( 'search_position' );

$feature_folder_path = JPATH_THEMES . '/' . $data->template->template . '/features';

$mobile_breakpoint_options     = $data->params->get( 'mobile_breakpoint_options', 'm' );

include_once $feature_folder_path . '/contact.php';
include_once $feature_folder_path . '/cookie.php';
include_once $feature_folder_path . '/logo.php';
include_once $feature_folder_path . '/menu.php';
include_once $feature_folder_path . '/mobile.php';
include_once $feature_folder_path . '/search.php';
include_once $feature_folder_path . '/social.php';
include_once $feature_folder_path . '/toolbar.php';

$header_outside     = $data->params->get( 'boxed_layout' ) && $data->params->get( 'boxed_header_outside' );
$transparent_header = $data->params->get( 'transparent_header' );
$header_wrap[]      = '';
$header_wrap[]      = 'tm-header uk-visible@' . $mobile_breakpoint_options . ' header-' . $data->params->get( 'header_style' );

// Navbar Container
$navbar_container[] = 'uk-navbar-container';

$sticky = $data->params->get( 'header_navbar' );

if ( $sticky ) {

	$attrs_sticky[] = 'sel-target: .uk-navbar-container';
	$attrs_sticky[] = 'cls-active: uk-navbar-sticky';
	$attrs_sticky[] = 'media: @' . $mobile_breakpoint_options;

	if ( '2' === $sticky ) {
		$attrs_sticky[] = 'animation: uk-animation-slide-top';
		$attrs_sticky[] = 'show-on-up: true';
	}
}

if ( $header_outside && $transparent_header ) {

	$header_wrap[] = 'tm-header-transparent';

	if ( $sticky ) {
		$attrs_sticky[] = 'cls-inactive: uk-navbar-transparent uk-' . $transparent_header;
		$attrs_sticky[] = 'top: 300';
		if ( '1' === $sticky ) {
			$attrs_sticky[] = 'animation: uk-animation-slide-top';
		}
	} else {
		$navbar_container[] = 'uk-navbar-transparent uk-' . $transparent_header;
	}
}

$transparent_header_cls = ( $transparent_header && $header_outside ) ? ' uk-navbar-transparent uk-' . $transparent_header : '';

$header_container = $data->params->get( 'header_maxwidth', 'default' );

// Width Container
$header_container_cls[] = '';

if ( $header_outside ) {
	$header_container_cls[]  = $header_container === 'expand' ? 'uk-container uk-container-expand' : 'container tm-page-width';
} else {
	$header_container_cls[]  = $header_container != 'default' ? 'uk-container uk-container-' . $header_container : 'container';
}

$social_pos               = $data->params->get( 'social_pos' );
$contact_pos              = $data->params->get( 'contact_pos' );

$remove_logo_padding    = $data->params->get( 'remove_logo_padding', '0' );
$header_container_cls[] = $header_container === 'expand' && $remove_logo_padding ? 'uk-padding-remove-left' : '';
$header_menu_style      = $data->params->get( 'header_menu_options' ) ? ' uk-navbar-primary' : '';
$header_wrap            = implode( ' ', array_filter( $header_wrap ) );
$attrs_sticky           = ' uk-sticky="' . implode( '; ', array_filter( $attrs_sticky ) ) . '"';
$header_container_cls   = implode( ' ', array_filter( $header_container_cls ) );
$navbar_container       = implode( ' ', array_filter( $navbar_container ) );

/**
 * Helper classes for-
 * social icons, contact info, site logo, Menu header, toolbar, cookie, search.
 */

$contact = new HelixUltimateFeatureContact( $data->params );
$cookie  = new HelixUltimateFeatureCookie( $data->params );
$logo    = new HelixUltimateFeatureLogo( $data->params );
$menu    = new HelixUltimateFeatureMenu( $data->params );
$mobile    = new HelixUltimateFeatureMobile( $data->params );
$search  = new HelixUltimateFeatureSearch( $data->params );
$social  = new HelixUltimateFeatureSocial( $data->params );
$toolbar  = new HelixUltimateFeatureToolbar( $data->params );

?>

<?php echo $cookie->renderFeature(); ?>
<?php echo $mobile->renderFeature(); ?>

<?php if ( ! $data->params->get('toolbar_transparent') ) : ?>
  <?php echo $toolbar->renderFeature(); ?>
<?php endif; ?>

<div class="<?php echo $header_wrap; ?>" uk-header>

<?php if ( $data->params->get('toolbar_transparent') ) : ?>
  <?php echo $toolbar->renderFeature(); ?>
<?php endif; ?>

<?php if ( $sticky ) : ?>
	<div<?php echo $attrs_sticky; ?>>
<?php endif; ?>

<div class="<?php echo $navbar_container; echo $header_menu_style; ?>">

<div class="<?php echo $header_container_cls; ?>">

<nav class="uk-navbar" uk-navbar>

<div class="uk-navbar-left">

	<?php echo $logo->renderFeature(); ?>
	<?php if ( $doc->countModules('logo') ) : ?>
		<jdoc:include type="modules" name="logo" style="warp_xhtml" />
	<?php endif; ?>

	<?php if ( isset( $menu->load_pos ) && $menu->load_pos === 'before' ) : ?>
		<?php echo $menu->renderFeature(); ?>
			<jdoc:include type="modules" name="menu" style="sp_xhtml" />
		<?php else : ?>
			<jdoc:include type="modules" name="menu" style="sp_xhtml" />
		<?php echo $menu->renderFeature(); ?>
	<?php endif; ?>

	<?php if ( $doc->countModules( 'navbar' ) ) : ?>
		<jdoc:include type="modules" name="navbar" style="warp_xhtml" />
	<?php endif; ?>

	<?php if ( $navbar_search === 'navbar' ) : ?>
		<div class="uk-navbar-item">
			<?php echo $search->renderFeature(); ?>
		</div>
	<?php endif; ?>

	<?php if ( $social_pos === 'navbar' ) : ?>
		<div class="uk-navbar-item">
			<?php echo $social->renderFeature(); ?>
		</div>
	<?php endif; ?>

	<?php if ( $contact_pos === 'navbar' ) : ?>
		<div class="uk-navbar-item">
			<?php echo $contact->renderFeature(); ?>
		</div>
	<?php endif; ?>

</div>

<?php if ( $doc->countModules( 'header' ) || $navbar_search === 'header' || $social_pos === 'header' || $contact_pos === 'header' ) : ?>

<div class="uk-navbar-right">

	<?php if ( $doc->countModules( 'header' ) ) : ?>
		<jdoc:include type="modules" name="header" style="warp_xhtml" />
	<?php endif; ?>

	<?php if ( $navbar_search === 'header' ) : ?>
		<div class="uk-navbar-item">
			<?php echo $search->renderFeature(); ?>
		</div>
	<?php endif; ?>

	<?php if ( $social_pos === 'header' ) : ?>
		<div class="uk-navbar-item">
			<?php echo $social->renderFeature(); ?>
		</div>
	<?php endif; ?>

	<?php if ( $contact_pos === 'header' ) : ?>
		<div class="uk-navbar-item">
			<?php echo $contact->renderFeature(); ?>
		</div>
	<?php endif; ?>

</div>

<?php endif; ?>

</nav>

</div>

</div>

<?php if ( $sticky ) : ?>
	</div>
<?php endif; ?>

</div>