<?php


class BPSWORLD_Admin {
  /**
   * Constructor will create the menu item
   */
  public function __construct() {
      add_action( 'admin_menu', array($this, 'plugin_setup_menu' ));
  }

  public function plugin_setup_menu(){
    add_menu_page( 'Intro', 'World Map', 'manage_options',  'bps-worldmap', '', 'dashicons-admin-site', 40);
    add_submenu_page( 'bps-worldmap', 'Country List', 'Country List', 'manage_options', 'bpsworld-country-list',  array( $this, 'bpsworld_map_clist'));
    add_submenu_page( 'bps-worldmap', 'Category', 'Category', 'manage_options', 'bpsworld-country-cate',  array( $this, 'bpsworld_map_ccate'));
    remove_submenu_page('bps-worldmap','bps-worldmap');
  }

  public function bpsworld_map_clist() {
    if ( ! class_exists( 'Country_List_Table' ) ) {
      require_once BPSWORLD_PLUGIN_DIR . '/admin/includes/class-country-list-table.php';
    }

    $list_table = new Country_List_Table();
    $list_table->prepare_items();
    $list_table->display();
  }

  public function bpsworld_map_ccate() {
    if ( ! class_exists( 'Country_Cate_Table' ) ) {
      require_once BPSWORLD_PLUGIN_DIR . '/admin/includes/class-country-cate-table.php';
    }

    $cate_table = new Country_Cate_Table();
    $cate_table->prepare_items();
    $cate_table->display();
  }

}

?>
