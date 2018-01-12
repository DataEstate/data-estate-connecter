<?php

if ( ! class_exists( 'WP_List_Table' ) )
	require_once( ABSPATH . 'wp-admin/includes/class-wp-list-table.php' );

class Country_List_Table extends WP_List_Table {
	function __construct() {
		date_default_timezone_set('Australia/Brisbane');
		parent::__construct( array(
			'singular' => 'post',
			'plural' => 'posts',
			'ajax' => false ) );
	}

	//add new question button
	function extra_tablenav( $which ) {
	      if ( $which == "top" ){
	        echo '<h2 class="page_title">Country List </h2>&nbsp;&nbsp;<input type="button" value="Add New" class="btn_newcountryrow">';
	     }
	}

	function prepare_items() {
		$columns = $this->get_columns();
    $hidden = $this->get_hidden_columns();
    $sortable = $this->get_sortable_columns();
		$this->_column_headers = array($columns, $hidden, $sortable);

		$this->items = $this->get_countrylist( 20, 1);
		//print_r($this->items);
	}

	public static function get_countrylist( $per_page = 20, $page_number = 1) {
		global $wpdb;
		$sql = "SELECT c.*
				FROM {$wpdb->prefix}bpsworld_country c
				where c.status = '1'";

		if ( ! empty( $_REQUEST['orderby'] ) ) {
			$sql .= ' ORDER BY ' . esc_sql( $_REQUEST['orderby'] );
			$sql .= ! empty( $_REQUEST['order'] ) ? ' ' . esc_sql( $_REQUEST['order'] ) : ' ASC';
		} else {
			$sql .= ' ORDER BY id DESC';
		}
		$sql .= " LIMIT $per_page";
		$sql .= ' OFFSET ' . ( $page_number - 1 ) * $per_page;

		$result = $wpdb->get_results( $sql, 'ARRAY_A' );
		return $result;
	}

	public function column_default( $item, $column_name ) {
        switch( $column_name ) {
						case 'cate_slug':
						case 'country_code':
            case 'country_name':
						case 'country_title':
						case 'country_content':
						case 'country_link':
            case 'time_created':
            case 'action':
                return $item[ $column_name ];
            default:
                return print_r( $item, true ) ;
        }
    }


	public function get_columns(){
        $columns = array(
            //'cb'						=> '<input type="checkbox" />',
						'cate_slug'		=> 'Category ID',
            'country_code'		=> 'Country Code',
						'country_latlon'		=> 'Country Loc',
						'country_name'		=> 'Country Name',
						'country_title'		=> 'Title',
						'country_content'		=> 'Content',
						'country_link'		=> 'Link',
            'time_created'	=> 'Created At',
            'action'        => 'Action'
        );

        return $columns;
    }

	// function column_cb($item){
	// 	return sprintf(
	// 		'<input type="checkbox" name="%1$s[]" value="%2$s" />',
	// 		/*$1%s*/ $this->_args['singular'],
	// 		/*$2%s*/ $item['ID']
	// 	);
	// }

	function get_catelist() {
		global $wpdb;
		$sql = "SELECT c.*
				FROM {$wpdb->prefix}bpsworld_cate c
				where c.status = '1'";

		$result = $wpdb->get_results( $sql, 'ARRAY_A' );
		return $result;
	}

	function column_cate_slug($item){
		$cate_list = $this->get_catelist();

		$content = "<input type='hidden' value='".$item['id']."' class='country_id'>";
		$content .= "<select class='cate_slug'>";
			foreach ($cate_list as $cate_key) {
				if ($item['cate_slug'] == $cate_key['cate_slug']) {
					$content .= "<option value='".$cate_key['cate_slug']."' selected>".$cate_key['cate_slug']."</option>";
				} else {
					$content .= "<option value='".$cate_key['cate_slug']."'>".$cate_key['cate_slug']."</option>";
				}
			}
		$content .= "</select>";
		return $content;
	}

	function column_country_latlon($item){
		$content = "<input type='text' value='".$item['country_lat'].",".$item['country_lon']."' class='country_latlon' readonly>";
		return $content;
	}

	function column_country_name($item){
		$countries = get_countries();
			$content = "<select class='country_name'>";
			foreach ($countries as $country_key => $country_val) {
				if (strtolower($country_val['country_name']) == strtolower($item['country_name'])) {
					$content .= "<option value='".$country_val['country_code']."' data-loc='".$country_val['country_lat'].",".$country_val['country_lon']."' selected>".$country_val['country_name']."</option>";
				} else {
					$content .= "<option value='".$country_val['country_code']."' data-loc='".$country_val['country_lat'].",".$country_val['country_lon']."'>".$country_val['country_name']."</option>";
				}
			}
			$content .= "</select>";
			return $content;
		//return '<input type="type" value="'.$item['country_name'].'" class="country_name country_tbl_fields">';
	}

	function column_country_code($item){
		return '<input type="text" value="'.$item['country_code'].'" class="country_code country_tbl_fields" readonly>';
	}

	function column_country_title($item){
		return '<input type="text" value="'.$item['country_title'].'" class="country_title country_tbl_fields">';
	}

	function column_country_content($item){
		return '<textarea class="country_content country_tbl_fields">'.$item['country_content'].'</textarea>';
	}

	function column_country_link($item){
		return '<input type="text" value="'.$item['country_link'].'" class="country_link country_tbl_fields">';
	}

	function column_time_created($item){
		$content = "<div class='record_created'>".date('d/m/Y', $item['time_created'] )."</div>";
		return $content;
	}

	function column_action($item){
			$content = "<div class='add_panel' style='display:none;'>";
				$content .= "<input type='button' value='Add' class='btn_country_add btn_add'>";
				$content .= "<input type='button' value='Delete' class='btn_country_del btn_del'>";
			$content .= "</div>";

			$content .= "<div class='edit_panel'>";
				$content .= "<input type='button' value='Save' class='btn_country_edit btn_edit'>";
				$content .= "<input type='button' value='Remove' class='btn_country_remove btn_remove'>";
			$content .= "</div>";
		return $content;
	}

	public function get_hidden_columns(){
        return array();
    }

	public function get_sortable_columns(){
        return array('user_login' => array('user_login', false));
  }

	/**
     * Allows you to sort the data by the variables set in the $_GET
     *
     * @return Mixed
     */
    private function sort_data( $a, $b ){
        // Set defaults
        $orderby = 'user_login';
        $order = 'asc';

        // If orderby is set, use this as the sort column
        if(!empty($_GET['orderby'])){
            $orderby = $_GET['orderby'];
        }
        // If order is set use this as the order
        if(!empty($_GET['order']))  {
            $order = $_GET['order'];
        }

        $result = strnatcmp( $a[$orderby], $b[$orderby] );
        if($order === 'asc'){
            return $result;
        }
        return -$result;
    }


}

?>
