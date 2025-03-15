<?php
/*
Plugin Name: ACF --- habilitar los shortcodes de ACF
Description: .
Version: 1.0
Author: Anonimo
Author URI: https://tusitio.com
*/

add_action( 'acf/init', 'set_acf_settings' );
function set_acf_settings() {
    acf_update_setting( 'enable_shortcode', true );
}

add_shortcode('acf_field', 'acf_field_shortcode');
function acf_field_shortcode($atts) {
    $field_name = $atts['field'];
    $field_value = get_field($field_name);
    return $field_value;
}

?>