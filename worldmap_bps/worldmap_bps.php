<?php
/*
Plugin Name: BPS World Map Plugin
Description: A plugin to able users to pin the location in the world map
Author: DataEstate
Version: 0.1
*/
define( 'BPSWORLD_PLUGIN', __FILE__ );
define( 'BPSWORLD_PLUGIN_DIR', untrailingslashit( dirname( BPSWORLD_PLUGIN ) ) );
require_once BPSWORLD_PLUGIN_DIR . '/functions.php';

//Add setting link to plugin
function plugin_add_settings_link( $links ) {
    $settings_link = '<a href="admin.php?page=bpsworld-country-list">' . __( 'Settings' ) . '</a>';
    array_push( $links, $settings_link );
  	return $links;
}

$plugin = plugin_basename( __FILE__ );
add_filter( "plugin_action_links_$plugin", 'plugin_add_settings_link' );

//Load Jquery Script & css
add_action('init', 'init_cssscript');
//Load Jquery Script & css
function init_cssscript() {
	wp_register_style( 'bpsworld_style', plugin_dir_url( __FILE__ )  . 'assets/css/style.css', true);
	wp_enqueue_style( 'bpsworld_style' );

	wp_enqueue_script('jquery');
	wp_enqueue_script('bpsworld_js', plugin_dir_url( __FILE__ )  . 'assets/js/functions.js', array( 'jquery' ) );

	wp_localize_script( 'bpsworld_jquery', 'ajax_auth_arr', array(
			'ajaxurl' => admin_url( 'admin-ajax.php' ),
			'loadingmessage' => __('Sending user info, please wait...'),
			'is_user_logged_in' => is_user_logged_in()
	));
}

//Database Setting
register_activation_hook( __FILE__, 'bpsworld_cate' );								//create database table
register_activation_hook( __FILE__, 'bpsworld_country' );								   //create database table
register_deactivation_hook( __FILE__, 'bpsworld_rm' );

//Create and Remove Database
function bpsworld_cate() {
  global $wpdb;
	$version = get_option( 'bpsworld_db_version', '1.0' );
	$charset_collate = $wpdb->get_charset_collate();
	$table_name = $wpdb->prefix . 'bpsworld_cate';

	$sql = "CREATE TABLE IF NOT EXISTS $table_name (
			id int(11) NOT NULL AUTO_INCREMENT,
			cate_title TEXT NOT NULL,
      cate_slug TEXT NOT NULL,
      map_color TEXT NOT NULL,
      region_selected TEXT NOT NULL,
      marker TEXT NOT NULL,
      time_created int(16) NOT NULL,
      status int(1) NOT NULL,
			UNIQUE KEY id (id)
	) $charset_collate;";

	require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
	dbDelta( $sql );
	add_option("bpsworld_db_version", $version);

  $wpdb->insert(
      $table_name,
      array(
          'id'     => 1,
          'cate_title'    => 'Current Licensee',
          'cate_slug' => 'cl',
          'map_color' => '#96ce2f',
          'region_selected' => '#08519C',
          'marker' => '#0085ba',
          'time_created'   =>  time(),
          'status'      => 1
      )
  );
}


function bpsworld_country() {
  global $wpdb;
	$version = get_option( 'bpsworld_db_version', '1.0' );
	$charset_collate = $wpdb->get_charset_collate();
	$table_name = $wpdb->prefix . 'bpsworld_country';

	$sql = "CREATE TABLE IF NOT EXISTS $table_name (
			id int(11) NOT NULL AUTO_INCREMENT,
      cate_slug TEXT NOT NULL,
			country_name TEXT NOT NULL,
      country_code TEXT NOT NULL,
      country_title TEXT NOT NULL,
			country_lat TEXT NOT NULL,
			country_lon TEXT NOT NULL,
      country_content TEXT NOT NULL,
      country_link TEXT NOT NULL,
      time_created int(16) NOT NULL,
      status int(1) NOT NULL,
			UNIQUE KEY id (id)
	) $charset_collate;";

	require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
	dbDelta( $sql );
	add_option("bpsworld_db_version", $version);

  $wpdb->insert(
      $table_name,
      array(
          'id'     => 1,
          'country_name'    => 'Australia',
          'country_code'    => 'AU',
          'country_title'    => 'testing',
					'country_lat'     => '-27',
					'country_lon'     => '133',
          'country_content'    => 'testing',
          'country_link'    => 'http://www.google.com',
          'cate_slug' => 'cl',
          'time_created'   =>  time(),
          'status'      => 1
      )
  );
}

function bpsworld_rm() {
	// global $wpdb;
	// $catetable = $wpdb->prefix."bpsworld_cate";
	// delete_option('bpsworld_db_version');
	// $wpdb->query("DROP TABLE IF EXISTS $catetable");
  //
  // $countrytable = $wpdb->prefix."bpsworld_country";
	// delete_option('bpsworld_db_version');
	// $wpdb->query("DROP TABLE IF EXISTS $countrytable");
}

//check whether in frontend or admin
if(is_admin()) {
	if ( ! class_exists( 'BPSWORLD_Admin' ) ) {
		require_once BPSWORLD_PLUGIN_DIR . '/admin/admin_panel.php';
		require_once BPSWORLD_PLUGIN_DIR . '/admin/create_country.php';
	}
  new BPSWORLD_Admin();
} else {
	if ( ! class_exists( 'bpsworld_Front' ) ) {
		require_once BPSWORLD_PLUGIN_DIR . '/bpsworld_front.php';
	}
	$BPSWorld_Front = new BPSWORLD_Front();
	add_shortcode('bpsmap', array( $BPSWorld_Front, 'init_bpsworld') );
}
?>
