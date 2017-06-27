<?php

session_start();
if($_REQUEST['id']==''){
	$_SESSION['api_arry']='';	
}
else if($_SESSION['api_arry']->id==$_REQUEST['id']){
	global $api_arry;
	$api_arry=$_SESSION['api_arry'] ;
}
else{
 	global $current_user, $wpdb, $table_prefix,$api_arry;
	$id=$_REQUEST['id'];
	$myrows = $wpdb->get_results( "SELECT * FROM `".DEC_TABLE_DETAILS."` where id=1" );
	foreach($myrows as $myrow){
		$api_base_url_1= $myrow->api_base_url;
		$api_end_point_1= $myrow->api_end_point;
		$api_key_1=$myrow->api_key;
	}
	$url=$api_base_url_1.'/'.$api_end_point_1.$id.'?api_key='.$api_key_1;
	$request  = wp_remote_get( $url);
	$response = wp_remote_retrieve_body($request);
	$response_1 = json_decode($response);
	$api_arry=$response_1;
	$_SESSION['api_arry']=$api_arry;
}
/**Function**/
function api_error_function(){
	global $api_arry;
	if($api_arry->status=='error'){
 		$api_key_error= $api_arry->description;
		return $api_key_error;
	}
	else if($api_arry->status==false){
 		$api_key_error= $api_arry->error;
		return $api_key_error;
	}
}
/*****Require Files***/
require_once 'shortcodes/shortcodes.php';
require_once 'shortcodes/widget.php';

?>