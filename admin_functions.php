<?php
wp_register_style( 'admin-style ', DEC_URL . '/css/admin-style .css' );
wp_enqueue_style( 'admin-style ' );
wp_register_style( 'bootstrap', DEC_URL . '/css/bootstrap.css' );
wp_enqueue_style( 'bootstrap' );
wp_register_style( 'bootstrap.min', DEC_URL . '/css/bootstrap.min.css' );
wp_enqueue_style( 'bootstrap.min' );
global $current_user, $wpdb, $table_prefix;
$api_details = DEC_TABLE_DETAILS;
if(isset($_POST['api_detail_submit'])){
	$table_name = $api_details;
	$inputValidate = true;
	if($inputValidate) {
		$api_base_url = $_POST['api_base_url'];
		$api_end_point = $_POST['api_end_point'];
		$api_key = $_POST['api_key'];
		$main_estate = $_POST['estate_id'];

		// /** Category alias **/
		// $cat_accomm = $_POST['cat_map_accomm'];
		// /** end category alias **/
		/** Add DE API INFO **/
		$data = array( 
			'api_base_url' => $api_base_url, 
			'api_end_point' => $api_end_point, 
			'api_key' => $api_key,
			'main_estate_id' => $main_estate
		);
		$where = array('id'=>1);

		$status = $wpdb->update( $table_name, $data, $where, $format = null, $where_format = null );
		/** Add GMAP API INFO **/
		if (isset($_POST['gmap_key'])) {

			$gmap_key = $_POST['gmap_key'];
			$data = [
				"api_key"=>$gmap_key
			];
			$where = array('id'=>2);
			$g_stat = $wpdb->update($table_name, $data, $where, $format = null, $where_format=null);
			// TODO: check GMAP stats?
		}

		if($status==1){
			$msz='<div class="success_msz"><p>Api details are save successfully.</p></div>';
		}
		else{
			$msz='<div class="success_msz"><p>Api details are not save successfully.</p></div>';
		} 
	}
}
$myrows = $wpdb->get_results( "SELECT * FROM `".DEC_TABLE_DETAILS."`" );
$api_base_url_1 = $myrows[0]->api_base_url;
$api_end_point_1= $myrows[0]->api_end_point;
$api_key_1= $myrows[0]->api_key;
$estate_id_1 = $myrows[0]->main_estate_id;
//TODO: Refactor this to be more flexible. 
if (isset($myrows[1])) {
	$gmap_key_1 = $myrows[1]->api_key;
}
else {
	$gmap_key_1 = null;
}
