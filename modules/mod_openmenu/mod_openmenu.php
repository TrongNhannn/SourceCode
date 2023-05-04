<?php
/**
* @version		$Id: mod_openmenu.php 14401 2012-01-10 14:10:00Z chris $
* @package		Joomla
* @copyright	Copyright (C) 2005 - 2017 OpenMenu. All rights reserved.
* @license		http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
* Joomla! is free software. This version may have been modified pursuant
* to the GNU General Public License, and as distributed it includes or
* is derivative of works licensed under the GNU General Public License or
* other free or open source software licenses.
* See COPYRIGHT.php for copyright notices and details.
*/

// no direct access
defined('_JEXEC') or die('Restricted access');

// Include the syndicate functions only once
require_once( dirname(__FILE__).'/helper.php' );
$document=JFactory::getDocument();
$document->addStyleSheet(JURI::base().'modules/mod_openmenu/styles/style.css');
//$document->addScript('https://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js');
$document->addScript('http://maps.google.com/maps/api/js?sensor=true');

$moduleclass_sfx = $params->get('moduleclass_sfx', '');

		$omf_url =  $params->get('omf_url', '');
		$menu_filter =  $params->get('menu_filter','');
		$group_filter =  $params->get('group_filter','');
		$display_columns =  $params->get('display_columns', 1);
		$display_type =  $params->get('display_type', 'menu');
		$split_on =  $params->get('split_on', 'item');
		$background_color =  $params->get('background_color', '');
		$show_allergy =  $params->get('show_allergy', true);
		$show_calories =  $params->get('show_calories', true);
		$hide_prices =  $params->get('hide_prices', false);
		$use_short_tag =  $params->get('use_short_tag', false);
		
		$display='';
		if ( !empty( $omf_url ) ) {
			// Get the menu
			$omf_details = _get_menu_details( $omf_url );   

?>
 
      <div id="openmenu">
      
<?php 
	// Display the restaurant information
	if ( strcasecmp($display_type, 'restaurant information / menu') == 0 || 
	  strcasecmp($display_type, 'restaurant information') == 0 ) {
?>

	<script type="text/javascript">
		var $j = jQuery.noConflict();
		var geocoder;
		var map;
	    var image = '<?php echo JURI::base().'modules/mod_openmenu' ; ?>/images/ico-32-restaurant.png';

		$j(document).ready(function() {
			// Initialize the mapping stuff
			initialize();

<?php

	// If we have the cords then no need to geo-code
	if (!empty($omf_details['restaurant_info']['latitude']) && !empty($omf_details['restaurant_info']['longitude'])) {
		echo 'map_cords("'.$omf_details['restaurant_info']['latitude'].'", "'.$omf_details['restaurant_info']['longitude'].'");';
	} else {
		echo 'map_address("'.$omf_details['formatted_address'].'");';
	}
	
?>
		});

	  function initialize() {
	    geocoder = new google.maps.Geocoder();
	    var myOptions = {
	      zoom: 14,
	      mapTypeId: google.maps.MapTypeId.ROADMAP
	    }
	    map = new google.maps.Map(document.getElementById("locationmap"), myOptions);
	  }

	  function map_cords(lat, lng) {
		var myLatLng = new google.maps.LatLng(lat, lng);
		var marker = new google.maps.Marker({
		    position: myLatLng,
		    map: map,
		    icon: image
		});
		map.setCenter(new google.maps.LatLng(lat, lng));
	  }

	  function map_address(address) {
	    if (geocoder) {
	      geocoder.geocode( { 'address': address}, function(results, status) {
	        if (status == google.maps.GeocoderStatus.OK) {
	          map.setCenter(results[0].geometry.location);
	          var marker = new google.maps.Marker({
	              map: map, 
	              icon: image, 
	              position: results[0].geometry.location,
	              title: '<?php echo addslashes($omf_details['restaurant_info']['restaurant_name']); ?>'
	          });
	        } else {
	          // alert("Geocode could not process the requested address\n" + status);
	        }
	      });
	    }
	  }
	</script>

			<div id="om_restaurant">

				<div id="location-map"> 
					<div id="locationmap"></div>
				</div>
				
				<!--
				<div id="rest_name"><?php echo $omf_details['restaurant_info']['restaurant_name']; ?></div>
				-->
				
				<div id="details">
		            <p><?php echo $omf_details['restaurant_info']['brief_description']; ?></p>
		            <p>
		            	<strong><?php echo 'Address'; ?>:</strong><br />
		            	<?php echo $omf_details['restaurant_info']['address_1']; ?><br />
		            	<?php echo $omf_details['restaurant_info']['city_town']; ?>, <?php echo $omf_details['restaurant_info']['state_province']; ?> <?php echo $omf_details['restaurant_info']['postal_code']; ?> <?php echo $omf_details['restaurant_info']['country']; ?>
		            </p>
		            <p>
			            <strong><?php echo 'Phone'; ?>: </strong> <?php echo $omf_details['restaurant_info']['phone']; ?><br />
			            <strong><?php echo 'Website'; ?>: </strong> <a href="<?php echo $omf_details['restaurant_info']['website_url']; ?>"><?php echo $omf_details['restaurant_info']['website_url']; ?></a>
		            </p>
		            
		            <p>
		            	<strong><?php echo 'Hours'; ?>:</strong><br />
<?php 
	foreach ($omf_details['operating_days']['printable'] AS $daytime) {
		echo $daytime.'<br />';
	}
?>
			        </p>
			        
			        <div><strong><?php echo 'Type'; ?>:</strong> <?php echo $omf_details['environment_info']['cuisine_type_primary']; ?></div>
				</div>

			<div class="clear"></div>
		</div>
		
		
<?php 
	} // end restaurant info
   
            			
			
			if ( strcasecmp($display_type, 'restaurant information / menu') == 0 || 
	 strcasecmp($display_type, 'menu') == 0 ) {
				$display .= build_menu_from_details($omf_details, $display_columns, $menu_filter, $group_filter, $background_color, $split_on, $show_allergy, $show_calories, $use_short_tag, $hide_prices);
			}

		} else {
			$display = 'OpenMenu must be provided';
		}

	echo $display;
	
?>

</div>
