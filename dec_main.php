<?php
/*

Plugin Name: Data Estate Connector	 
Description: The Data Estate Connector (DEC) plugin integrates your WordPress site with the Data Estate API gain access to various Estate content. The API supports accessing ATDW’s tourism data as long as you have a valid ATDW distributor API Key.
Author: Data Estate
Author URI: http://www.dataestate.com.au
Version: 1.6.3
License:           GPL-2.0+
License URI:       http://www.gnu.org/licenses/gpl-2.0.txt

Settings: link to the settings page. 
*/

global $wpdb, $table_prefix;
$siteurl = get_option('siteurl');
//Define Constants
define('DEC_FOLDER', dirname(plugin_basename(__FILE__)));
define('DEC_URL', $siteurl . '/wp-content/plugins/' . DEC_FOLDER);
define('DEC_FILE_PATH', dirname(__FILE__));
define('DEC_DIR_NAME', basename(DEC_FILE_PATH));
define('DEC_TABLE_DETAILS', $table_prefix . 'dec_details');

if (! class_exists('DE_CONNECT')):
class DE_Connect {

	public static function init() {

		//Initialise Activation Hooks
		register_activation_hook(__FILE__, array(__CLASS__, 'dec_activate'));
		register_deactivation_hook(__FILE__, array(__CLASS__, 'dec_deactivate'));
		register_uninstall_hook(__FILE__, array(__CLASS__, 'dec_uninstall'));

		//Add Admin Menu and settings
		add_action('admin_menu', array(__CLASS__, 'add_menu_options'));
		add_filter('plugin_action_links_'.plugin_basename(__FILE__), array(__CLASS__, 'add_settings_links'));

		//Register Front-End Scripts - 
		//DE Search Widget Script: dec-search-widget, dec-search-widget-txa
		add_action('wp_enqueue_script', array(__CLASS__, 'register_search_widget'));
		//Google Map Script with API KEY: dec-google-map, dec-map-clusterer
		add_action('wp_enqueue_script', array(__CLASS__, 'register_google_map'));
		//Enqueu Stylesheets: google-material-font, shortcode-style
		add_action('wp_enqueue_script', array(__CLASS__, 'register_required_stylesheets'));
		//Add jQuery UI
		add_action('wp_enqueue_script', array(__CLASS__, 'register_jquery_ui'));
	}
	//Activation Hook - Activate
	public static function dec_activate() {
		global $wpdb;
		// Create USERS table
		$api_details = DEC_TABLE_DETAILS;
		if ($wpdb->get_var("show tables like '$api_details'") != $api_details){
			$sql0  = "CREATE TABLE IF NOT EXISTS `" . $api_details . "` ( ";
			$sql0 .= "  `id`  int(11)   NOT NULL auto_increment, ";
			$sql0 .= "  `api_base_url` text NOT NULL, ";
			$sql0 .= "  `api_end_point` text NOT NULL, ";
			$sql0 .= "  `api_key` text NOT NULL, ";
			$sql0 .= "  `type` text NOT NULL, ";
			$sql0 .= "  `main_estate_id` text NOT NULL, ";
			$sql0 .= "  PRIMARY KEY `id` (`id`) ";
			$sql0 .= ") ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ; ";
			#We need to include this file so we have access to the dbDelta function below (which is used to create the table)
			require_once(ABSPATH . '/wp-admin/upgrade-functions.php');
			dbDelta($sql0);
			$sql = "INSERT INTO `".DEC_TABLE_DETAILS."`(`api_base_url`,`api_end_point`,`api_key`,`main_estate_id`,`type`) 
					VALUES ('https://api.dataestate.net/v2','estates/data/','','','de')";
			$da_value=$wpdb->query($wpdb->prepare($sql, array($api_end_point,$api_key)));
			//TODO... Refactor this
			$sql = "INSERT INTO `".DEC_TABLE_DETAILS."`(`api_base_url`,`api_end_point`,`api_key`,`main_estate_id`,`type`) 
					VALUES ('maps.googleapis.com','maps/api/js','','','google')";
			$da_value=$wpdb->query($wpdb->prepare($sql, [$gmap_api_endpoint, $gmap_key]));
		}
	}
	//Deactivation Hook - Deactivate
	public static function dec_deactivate() {
		// global $wpdb;
		// $api_details = DEC_TABLE_DETAILS;
		// $del_albums = "DROP TABLE IF EXISTS `%s`";
		// $wpdb->query($wpdb->prepare($del_albums, [$api_details])); 
	}
	//Uninstallation Hook - Remove Tables and configs
	public static function dec_uninstall() {
		global $wpdb;
		$api_details = DEC_TABLE_DETAILS;
		$del_albums = "DROP TABLE IF EXISTS `%s`";
		$wpdb->query($wpdb->prepare($del_albums, [$api_details])); 
	}
	//Add Settings Link Filter
	public static function add_settings_links($links) {
		$mylinks = array(
		'<a href="' . admin_url( 'options-general.php?page=dec_details_page.php').'">Settings</a>',
		);
		return array_merge( $links, $mylinks );
	}
	//Add Menu Options 
	public static function add_menu_options() {
		add_options_page( 
			'DEC Settings',
			'DEC Config',
			'manage_options',
			'dec_details_page.php',
			array(__CLASS__, 'add_menu_options_callback')
		);
	}
	//Add Admin Configuration
	public static function add_menu_options_callback() {
		require_once('dec_details_page.php');
	}
	//Register Scripts and Styles.
	public static function register_search_widget() {
		global $wpdb;
		$api_info = $wpdb->get_results("SELECT api_base_url, api_end_point, api_key from `".DEC_TABLE_DETAILS."` WHERE id=1", ARRAY_A);
		if (count($api_info) > 0) {
			wp_register_script('dec-search-widget', $api_info[0]["api_base_url"].'/Widget/search2?api_key='.$api_info[0]["api_key"].'&callback=init');
			wp_register_script('dec-search-widget-txa', $api_info[0]["api_base_url"].'/Widget/search2?api_key='.$api_info[0]["api_key"].'&callback=init&txa_widget=true');
		}
	}
	//TODO: Registration may not be necessary, and can be added in the shortcode. 
	public static function register_google_map() {
		global $wpdb;
		$api_info = $wpdb->get_results("SELECT api_base_url, api_end_point, api_key from `".DEC_TABLE_DETAILS."` WHERE id=2", ARRAY_A);
		if (count($api_info) > 0) {
			wp_register_script('dec-google-map', 'https://'.$api_info[0]["api_base_url"].'/'.$api_info[0]["api_end_point"].'?key='.$api_info[0]["api_key"].'&callback=initMap');
		}
		wp_register_script('dec-map-clusterer', DEC_URL.'/js/markerclusterer.js');
	}
	//Enqueu Material Icon Styles
	public static function register_required_stylesheets() {
		wp_register_style('google-material-font', 'https://fonts.googleapis.com/icon?family=Material+Icons');
		wp_enqueue_style( 'shortcode-style', DEC_URL . '/css/shortcode-style.css' );
	}
	//jQuery UI TODO: Should load in shortcode. 
	public static function register_jquery_ui() {
		wp_enqueue_script( 'jquery-ui-datepicker' );
		wp_enqueue_style( 'dec-jquery-ui-css', '//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css');
	}
}
endif;

DE_CONNECT::init();
require_once('de_api.php');
require_once('functions.php');