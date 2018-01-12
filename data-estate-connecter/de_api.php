<?php 
/**
* DE API Caller Class
* @author Rolf Chen
* @version 1.0
*/
class De_api {
	private $_apiKey;
	private $_apiUrl;

	private static $_instance=null;
	public function __construct($api_key=null, $api_url=null) {
		if (!is_null($api_key)) {
			$this->_apiKey = $api_key;
		}
		if (!is_null($api_url)) {
			$this->_apiUrl = $api_url;
		}
	}
	public function get_api_key() {
		return $this->_apiKey;
	}
	public function estates($params=[], $id=null, $command="data") {
		$endpoint="/estates/$command";
		$url = $this->_apiUrl.$endpoint;
		if (!is_null($id)) {
			$url.='/'.$id;
		}
		if (!is_null($this->_apiKey)) {
			$url.='?api_key='.$this->_apiKey;
			if (count($params) > 0) {
				$url.='&'.http_build_query($params);
			}
		}
		else {
			if (count($params) > 0) {
				$url.='?'.http_build_query($params);
			}
		}
		$request = wp_remote_get($url);
		$response = wp_remote_retrieve_body($request);
		return json_decode($response);
	}
	public function assets($params=[], $id=null) {
		$endpoint='/assets/data';
		$url = $this->_apiUrl.$endpoint;
		if (!is_null($id)) {
			$url.='/'.$id;
		}
		if (!is_null($this->_apiKey)) {
			$url.='?api_key='.$this->_apiKey;
			if (count($params) > 0) {
				$url.='&'.http_build_query($params);
			}
		}
		else {
			if (count($params) > 0) {
				$url.='?'.http_build_query($params);
			}
		}
		$request = wp_remote_get($url);
		$response = wp_remote_retrieve_body($request);
		return json_decode($response);
	}
	public static function get_instance($api_key=null, $api_url=null) {
		if (null==self::$_instance)  {
			self::$_instance = new self($api_key, $api_url);
		}
		return self::$_instance;
	}
}