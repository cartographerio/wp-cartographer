<?php
/**
 * Plugin Name: Cartographer Maps
 * Plugin URI: https://github.com/cartographerio/wp-cartographer
 * Description: Add Cartographer maps to your Wordpress web site
 * Version: 1.0.0
 * Author: Dave Gurnell
 * Author URI: http://cartographer.io
 * License: GPL2
 */

defined('ABSPATH') or die("No script kiddies please!");

$cartographer_map_atts_spec = array(
  'subdomain'    => null,
  'layer'        => null,
  'center'       => null,
  'zoom'         => null,
  'autodiscover' => null,
  'inspector'    => null,
  'legend'       => null,
  'charts'       => null,
  'selectlayers' => null,
  'selectradius' => null,
  'from'         => null,
  'to'           => null
);

$cartographer_map_atts_defaults = array();

function cartographer_register_map_script() {
  if(!defined("cartographer_map_script_registered")) {
    define("cartographer_map_script_registered", 1);
    wp_enqueue_script("cartographer_map_script", 'https://cartographer.io/static/widget/map/v1/loader.js', null, null, null, true);
  }
}

function cartographer_register_map_style() {
  if(!defined("cartographer_map_style_registered")) {
    define("cartographer_map_style_registered", 1);
    wp_enqueue_style("cartographer_map_style", plugin_dir_url( __FILE__ ) . "wp-cartographer.css", null, null, 'all');
  }
}

function cartographer_map_defaults_shortcode( $atts, $content = null ) {
  global $cartographer_map_atts_spec;
  global $cartographer_map_atts_defaults;

  cartographer_register_map_script();
  cartographer_register_map_style();

  $cartographer_map_atts_defaults = shortcode_atts($cartographer_map_atts_spec, $atts);

  return '';
}

function cartographer_map_shortcode( $atts, $content = null ) {
  global $cartographer_map_atts_spec;
  global $cartographer_map_atts_defaults;

  cartographer_register_map_script();
  cartographer_register_map_style();

  $atts = shortcode_atts($cartographer_map_atts_spec, array_merge($cartographer_map_atts_defaults, $atts));

  if(isset($atts['subdomain']) && isset($atts['layer'])) {
    $html_atts = '';
    foreach($atts as $key => $value) {
      if($value) {
        $enc_key     = "data-$key";
        $enc_value   = htmlentities($value);
        $html_atts []= "$enc_key=\"$enc_value\"";
      }
    }
    $html_atts = join(' ', $html_atts);

    return "<div class=\"cartographer-map\" data-cartographer-map $html_atts></div>";
  } else {
    return <<<ENDERROR
<div class="cartographer-error">
  <p><strong>Error in Cartographer Shortcode</strong></p>

  <p>Please specify a <tt>subdomain</tt> and <tt>layer</tt> in your shortcode, for example:</p>

  <pre>[cartographer_map subdomain="mysubdomain" layer="myLayer.myAttribute"]</pre>

  <p>or:</p>

  <pre>[cartographer_map_defaults subdomain="mysubdomain"]

[cartographer_map layer="myLayer.myAttribute"]</pre>
</div>
ENDERROR;
  }
}

add_shortcode('cartographer_map_defaults', 'cartographer_map_defaults_shortcode');
add_shortcode('cartographer_map',          'cartographer_map_shortcode');

?>
