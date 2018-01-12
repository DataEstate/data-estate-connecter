<?php

if ( ! class_exists( 'WP_List_Table' ) )
	require_once( ABSPATH . 'wp-admin/includes/class-wp-list-table.php' );

class Country_Cate_Table extends WP_List_Table {
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
	        echo '<h2 class="page_title">Category </h2>&nbsp;&nbsp;<input type="button" value="Add New" class="btn_newccaterow">&nbsp;&nbsp;<a href="https://www.webpagefx.com/web-design/color-picker/" target="_blank">Color Picker</a>';
	     }
	}

	function prepare_items() {
		$columns = $this->get_columns();
    $hidden = $this->get_hidden_columns();
    $sortable = $this->get_sortable_columns();
		$this->_column_headers = array($columns, $hidden, $sortable);

		$this->items = $this->get_countrycate( 20, 1);
		//print_r($this->items);
	}



	public static function get_countrycate( $per_page = 20, $page_number = 1) {
		global $wpdb;
		$sql = "SELECT c.*
				FROM {$wpdb->prefix}bpsworld_cate c
				where c.status = '1'";

		if ( ! empty( $_REQUEST['orderby'] ) ) {
			$sql .= ' ORDER BY ' . esc_sql( $_REQUEST['orderby'] );
			$sql .= ! empty( $_REQUEST['order'] ) ? ' ' . esc_sql( $_REQUEST['order'] ) : ' ASC';
		} else {
			$sql .= ' ORDER BY id';
		}
		$sql .= " LIMIT $per_page";
		$sql .= ' OFFSET ' . ( $page_number - 1 ) * $per_page;

		$result = $wpdb->get_results( $sql, 'ARRAY_A' );
		return $result;
	}

	public function column_default( $item, $column_name ) {
        switch( $column_name ) {
						case 'cate_slug':
						case 'cate_title':
						case 'map_color':
						case 'region_selected':
						case 'marker':
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
						'cate_slug'					=> 'Category ID',
            'cate_title'				=> 'Category Title',
						'map_color'					=> 'Map Color',
						'region_selected'		=> 'Region Selected',
						'marker'						=> 'Marker',
            'time_created'			=> 'Created At',
            'action'        		=> 'Action'
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

	function column_cate_slug($item){
		return '<input type="hidden" value="'.$item['id'].'" class="cate_id"><input type="text" value="'.$item['cate_slug'].'" class="cate_slug country_tbl_fields">';
	}

	function column_cate_title($item){
		return '<input type="text" value="'.$item['cate_title'].'" class="cate_title country_tbl_fields">';
	}

	function column_map_color($item){
		return '<input type="text" value="'.$item['map_color'].'" class="map_color country_tbl_fields">';
	}

	function column_region_selected($item){
		return '<input type="text" value="'.$item['region_selected'].'" class="region_selected country_tbl_fields">';
	}

	function column_marker($item){
		return '<input type="text" value="'.$item['marker'].'" class="marker country_tbl_fields">';
	}

	function column_time_created($item){
		$content = "<div class='record_created'>".date('d/m/Y', $item['time_created'] )."</div>";
		return $content;
	}

	function column_action($item){
			$content = "<div class='add_panel' style='display:none;'>";
				$content .= "<input type='button' value='Add' class='btn_ccate_add btn_add'>";
				$content .= "<input type='button' value='Delete' class='btn_ccate_del btn_del'>";
			$content .= "</div>";
			$content .= "<div class='edit_panel'>";
				$content .= "<input type='button' value='Save' class='btn_ccate_edit btn_edit'>";
				$content .= "<input type='button' value='Remove' class='btn_ccate_remove btn_remove'>";
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
    private function sort_data( $a, $b )
    {
        // Set defaults
        $orderby = 'user_login';
        $order = 'asc';

        // If orderby is set, use this as the sort column
        if(!empty($_GET['orderby']))
        {
            $orderby = $_GET['orderby'];
        }

        // If order is set use this as the order
        if(!empty($_GET['order']))
        {
            $order = $_GET['order'];
        }


        $result = strnatcmp( $a[$orderby], $b[$orderby] );

        if($order === 'asc')
        {
            return $result;
        }

        return -$result;
    }



}

?>
