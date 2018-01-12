<?php

class BPSWORLD_Front {
  public function __construct() {
    wp_register_style( 'vectormap_style', plugin_dir_url( __FILE__ )  . 'assets/css/jquery-jvectormap-2.0.3.css', true);
  	wp_enqueue_style( 'vectormap_style' );

     wp_enqueue_script('vectormap_js', plugin_dir_url( __FILE__ )  . 'assets/js/jquery-jvectormap-2.0.3.min.js', array( 'jquery' ) );
     wp_enqueue_script('vectormapworld_js', plugin_dir_url( __FILE__ )  . 'assets/js/jquery-jvectormap-world-mill-en.js', array( 'jquery' ) );
     wp_enqueue_script('frontend_js', plugin_dir_url( __FILE__ )  . 'assets/js/functions-frontend.js', array( 'jquery' ) );

    //wp_register_style( 'vmap_style', plugin_dir_url( __FILE__ )  . 'assets/css/jqvmap.min.css', true);
    //wp_enqueue_style( 'vmap_style' );

    // wp_enqueue_script('vmap_js', plugin_dir_url( __FILE__ )  . 'assets/js/jquery.vmap.min.js', array( 'jquery' ) );
    // wp_enqueue_script('world_js', plugin_dir_url( __FILE__ )  . 'assets/js/jquery.vmap.world.js', array( 'jquery' ) );
  }

  function init_bpsworld($params = array()) {
     // default parameters
     extract(shortcode_atts(array('cate' => 'cl'), $params));
     $countries = $this->get_countrylist($cate);
     $cate_details = $this->get_catelist($cate);
     $script='<script>
      jQuery(document).ready(function () {
        initWorldMap("'.$cate.'",  "'.plugin_dir_url( __FILE__ ).'", '.json_encode($countries).', "'.$cate_details[0]['map_color'].'", "'.$cate_details[0]['region_selected'].'", "'.$cate_details[0]['marker'].'");
      });
    </script>';
    $element = '<div id="'.$cate.'_vmap" class="vmap"></div>';
    $element .= '<div id="'.$cate.'_vmap_mobile" class="vmap_mob">';
      $element .= '<label>'.$cate_details[0]["cate_title"].'</label>';
      $element .= '<ul>';
                      foreach($countries as $key => $val) {
                        $web_link = "";
                        if ($val["country_link"] != null && $val["country_link"] != "" ) {
                           $web_link = '<a class="" href="'.$val["country_link"].'">Visit Website</a>';
                        }
                        $element .= '<li>';
                                      $element .= '<div class="clist_header">'.$val["country_name"].'</div>';
                                      $element .= '<div class="clist_content">
                                                      <div class="clist_title">'.$val["country_title"].'</div>
                                                      <div class="clist_desc">'.$val["country_content"].'</div>
                                                    '.$web_link.'
                                                  </div>';
                        $element .= '</li>';
                      }
      $element .= '</ul>';
    $element .= '</div>';
    return $script.$element;
  }

  public static function get_catelist($cate_slug) {
		global $wpdb;
		$sql = "SELECT c.*
				FROM {$wpdb->prefix}bpsworld_cate c
				where c.status = '1'
        and c.cate_slug='".$cate_slug."'";

		$result = $wpdb->get_results( $sql, 'ARRAY_A' );
		return $result;
	}

  public static function get_countrylist($cate_slug) {
		global $wpdb;
		$sql = "SELECT c.*
				FROM {$wpdb->prefix}bpsworld_country c
				where c.status = '1'
        and c.cate_slug='".$cate_slug."'";

		$result = $wpdb->get_results( $sql, 'ARRAY_A' );
		return $result;
	}

}

 ?>
