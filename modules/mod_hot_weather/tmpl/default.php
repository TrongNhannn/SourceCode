<?php
/*------------------------------------------------------------------------
# "Hot Weather" Joomla module
# Copyright (C) 2009-2021 HotThemes. All Rights Reserved.
# License: http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 only
# Author: HotJoomlaTemplates.com
# Website: https://www.hotjoomlatemplates.com
-------------------------------------------------------------------------*/
defined('_JEXEC') or die('Restricted access'); // no direct access

// get the document object
$doc = JFactory::getDocument();

// add stylesheet
$doc->addStyleSheet( 'modules/mod_hot_weather/tmpl/style.css' );

// style declaration
$doc->addStyleDeclaration( '
#hot_weather_container'.$module_id.' {
  flex-direction: '.$direction.';
}

#hot_weather_container'.$module_id.' .hot_weather_value {
  font-size: '.$value_font.';
}

#hot_weather_container'.$module_id.' .hot_weather_description {
  font-size: '.$desc_font.';
}
');

// location
$hot_weather_location = $location;
if ($state) {
  $hot_weather_location .= ",".$state;
}
if ($country) {
  $hot_weather_location .= ",".$country;
}
?>


<div id="hot_weather_container<?php echo $module_id ?>" class="hot_weather_container">
  <div class="hot_weather_label">
    <div id="hot_weather_label<?php echo $module_id ?>" class="hot_weather_value"></div>
    <div id="hot_weather_description<?php echo $module_id ?>" class="hot_weather_description"></div>
  </div>
  <div class="hot_weather_icon">
    <div id="hot_weather_icon<?php echo $module_id ?>"></div>
  </div>
  <div class="hot_weather_temperature">
    <div id="hot_weather_temperature<?php echo $module_id ?>" class="hot_weather_value"></div>
    <div class="hot_weather_description">current</div>
  </div>
  <?php if ($temperature_feels) { ?>
  <div class="hot_weather_temperature_feels">
    <div id="hot_weather_temperature_feels<?php echo $module_id ?>" class="hot_weather_value"></div>
    <div class="hot_weather_description">feels like</div>
  </div>
  <?php } ?>
  <?php if ($temperature_min) { ?>
  <div class="hot_weather_temperature_min">
    <div id="hot_weather_temperature_min<?php echo $module_id ?>" class="hot_weather_value"></div>
    <div class="hot_weather_description">min</div>
  </div>
  <?php } ?>
  <?php if ($temperature_max) { ?>
  <div class="hot_weather_temperature_max">
    <div id="hot_weather_temperature_max<?php echo $module_id ?>" class="hot_weather_value"></div>
    <div class="hot_weather_description">max</div>
  </div>
  <?php } ?>
  <?php if ($pressure) { ?>
  <div class="hot_weather_pressure">
    <div id="hot_weather_pressure<?php echo $module_id ?>" class="hot_weather_value"></div>
    <div class="hot_weather_description">pressure</div>
  </div>
  <?php } ?>
  <?php if ($humidity) { ?>
  <div class="hot_weather_humidity">
    <div id="hot_weather_humidity<?php echo $module_id ?>" class="hot_weather_value"></div>
    <div class="hot_weather_description">humidity</div>
  </div>
  <?php } ?>
  <?php if ($visibility) { ?>
  <div class="hot_weather_visibility">
    <div id="hot_weather_visibility<?php echo $module_id ?>" class="hot_weather_value"></div>
    <div class="hot_weather_description">visibility</div>
  </div>
  <?php } ?>
  <?php if ($wind) { ?>
  <div class="hot_weather_wind">
    <div id="hot_weather_wind<?php echo $module_id ?>" class="hot_weather_value"></div>
    <div class="hot_weather_description">wind</div>
  </div>
  <?php } ?>


</div>

<script>
// https://api.openweathermap.org/data/2.5/weather?q=nis,rs&units=metric&appid=2318db14b28ce30cc35ce6690af8d453
// https://openweathermap.org/img/w/01d.png

var hot_weather_request<?php echo $module_id ?> = new XMLHttpRequest();
hot_weather_request<?php echo $module_id ?>.open('GET', 'https://api.openweathermap.org/data/2.5/weather?q=<?php echo $hot_weather_location; ?>&units=<?php echo $units; ?>&appid=<?php echo $api_key; ?>', true);

hot_weather_request<?php echo $module_id ?>.onload = function() {
  if (this.status >= 200 && this.status < 400) {
    // Success!
    var hot_weather_data<?php echo $module_id ?> = JSON.parse(this.response);
    console.log(hot_weather_data<?php echo $module_id ?>);

    // label
    let label_div = document.getElementById("hot_weather_label<?php echo $module_id ?>");
    let label_value = document.createTextNode(hot_weather_data<?php echo $module_id ?>.name + ", " + hot_weather_data<?php echo $module_id ?>.sys.country);
    label_div.appendChild(label_value);

    // temperature
    let temperature_div = document.getElementById("hot_weather_temperature<?php echo $module_id ?>");
    let temperature_value = document.createTextNode(Math.round(hot_weather_data<?php echo $module_id ?>.main.temp) + "°" + "<?php if ($units=="metric") { echo "C"; }else{ echo "F"; } ?>");
    temperature_div.appendChild(temperature_value);

    // icon
    let hot_weather_icon_div = document.getElementById("hot_weather_icon<?php echo $module_id ?>");
    let hot_weather_icon_image = document.createElement("IMG");
    hot_weather_icon_image.setAttribute("src", "https://openweathermap.org/img/wn/" + hot_weather_data<?php echo $module_id ?>.weather[0].icon + "@2x.png");
    hot_weather_icon_div.appendChild(hot_weather_icon_image);

    // weather description
    let weather_desc_div = document.getElementById("hot_weather_description<?php echo $module_id ?>");
    let weather_desc_value = document.createTextNode(hot_weather_data<?php echo $module_id ?>.weather[0].description);
    weather_desc_div.appendChild(weather_desc_value);

    <?php // feels like
    if ($temperature_feels) { ?>
    
      let temperature_feels_div = document.getElementById("hot_weather_temperature_feels<?php echo $module_id ?>");
      let temperature_feels_value = document.createTextNode(Math.round(hot_weather_data<?php echo $module_id ?>.main.feels_like) + "°" + "<?php if ($units=="metric") { echo "C"; }else{ echo "F"; } ?>");
      temperature_feels_div.appendChild(temperature_feels_value);

    <?php } ?>

    <?php // min temperature
    if ($temperature_min) { ?>
    
      let temperature_min_div = document.getElementById("hot_weather_temperature_min<?php echo $module_id ?>");
      let temperature_min_value = document.createTextNode(Math.round(hot_weather_data<?php echo $module_id ?>.main.temp_min) + "°" + "<?php if ($units=="metric") { echo "C"; }else{ echo "F"; } ?>");
      temperature_min_div.appendChild(temperature_min_value);

    <?php } ?>

    <?php // max temperature
    if ($temperature_max) { ?>
    
      let temperature_max_div = document.getElementById("hot_weather_temperature_max<?php echo $module_id ?>");
      let temperature_max_value = document.createTextNode(Math.round(hot_weather_data<?php echo $module_id ?>.main.temp_max) + "°" + "<?php if ($units=="metric") { echo "C"; }else{ echo "F"; } ?>");
      temperature_max_div.appendChild(temperature_max_value);

    <?php } ?>

    <?php // pressure
    if ($pressure) { ?>
    
      let pressure_div = document.getElementById("hot_weather_pressure<?php echo $module_id ?>");
      let pressure_value = document.createTextNode(Math.round(hot_weather_data<?php echo $module_id ?>.main.pressure) + "hPa");
      pressure_div.appendChild(pressure_value);

    <?php } ?>

    <?php // humidity
    if ($humidity) { ?>
    
      let humidity_div = document.getElementById("hot_weather_humidity<?php echo $module_id ?>");
      let humidity_value = document.createTextNode(Math.round(hot_weather_data<?php echo $module_id ?>.main.humidity) + "%");
      humidity_div.appendChild(humidity_value);

    <?php } ?>

    <?php // visibility
    if ($visibility) { ?>
    
      let visibility_div = document.getElementById("hot_weather_visibility<?php echo $module_id ?>");
      let visibility_value = document.createTextNode(hot_weather_data<?php echo $module_id ?>.visibility / 1000 + "km");
      visibility_div.appendChild(visibility_value);

    <?php } ?>

    <?php // wind
    if ($wind) { ?>
    
      let wind_div = document.getElementById("hot_weather_wind<?php echo $module_id ?>");
      let wind_value = document.createTextNode(hot_weather_data<?php echo $module_id ?>.wind.speed + "<?php if($units=="metric") {echo "m/s "; } else { echo "mph "; } ?>");
      wind_div.appendChild(wind_value);

      let wind_arrow = document.createElement("SPAN");
      let wind_arrow_icon = document.createTextNode("➤");
      wind_arrow.appendChild(wind_arrow_icon); 
      wind_div.appendChild(wind_arrow);

      // wind direction
      // -90 because arrow symbol has 90deg
      // +180 because weather is FROM direction
      let wind_direction = hot_weather_data<?php echo $module_id ?>.wind.deg - 90 + 180;

      wind_arrow.style.transform = "rotate(" + wind_direction + "deg)";

    <?php } ?>


  } else {
    console.log("We reached our target server, but it returned an error");
  }
};

hot_weather_request<?php echo $module_id ?>.onerror = function() {
  console.log("There was a connection error of some sort");
};

hot_weather_request<?php echo $module_id ?>.send();


</script>