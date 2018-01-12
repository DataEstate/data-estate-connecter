<?php
//ajax part - del cate record
add_action('wp_ajax_del_cate', 'ajax_delcate');
add_action('wp_ajax_nopriv_del_cate', 'ajax_delcate');//for us
function ajax_delcate() {
  global $wpdb;
  $cate_id                  = $_REQUEST["cate_id"];

  $inserted_data =  array(
     "status" => 0
  );

  $db_table = $wpdb->prefix.'bpsworld_cate';
  $updated = $wpdb->update($db_table, $inserted_data, array('id'=>$cate_id));

  if ( ! $updated ) {
    $wpdb->print_error();
    $data = array(
      'error'           => 1
    );
  } else {
    $data = array(
      'error'           => 0
    );
  }
  wp_send_json( $data );
  die();
}

//ajax part - edit cate record
add_action('wp_ajax_edit_cate', 'ajax_editcate');
add_action('wp_ajax_nopriv_edit_cate', 'ajax_editcate');//for us
function ajax_editcate() {
  global $wpdb;
  $cate_slug                     = $_REQUEST["cate_slug"];
  $cate_id                       = $_REQUEST["cate_id"];
  $cate_title                    = $_REQUEST["cate_title"];
  $map_color                     = $_REQUEST["map_color"];
  $region_selected               = $_REQUEST["region_selected"];
  $marker                        = $_REQUEST["marker"];

  $inserted_data =  array(
     "cate_slug" => $cate_slug,
     "cate_title" => $cate_title,
     "map_color" => $map_color,
     "region_selected" => $region_selected,
     "marker" => $marker,
     "time_created" => time(),
     "status" => 1
  );

  $db_table = $wpdb->prefix.'bpsworld_cate';
  $updated = $wpdb->update($db_table, $inserted_data, array('id'=>$cate_id));

  if ( ! $updated ) {
    $wpdb->print_error();
    $data = array(
      'error'           => 1
    );
  } else {
    $data = array(
      'error'           => 0,
      'new_id'          => $wpdb->insert_id,
      'time_created'    => date("d/m/Y", time())
    );
  }
  wp_send_json( $data );
  die();
}

//ajax part - add cate record
add_action('wp_ajax_add_cate', 'ajax_addcate');
add_action('wp_ajax_nopriv_add_cate', 'ajax_addcate');//for us
function ajax_addcate() {
  global $wpdb;
  $cate_slug                     = $_REQUEST["cate_slug"];
  $cate_id                       = $_REQUEST["cate_id"];
  $cate_title                    = $_REQUEST["cate_title"];
  $map_color                     = $_REQUEST["map_color"];
  $region_selected               = $_REQUEST["region_selected"];
  $marker                        = $_REQUEST["marker"];

  $inserted_data =  array(
     "cate_slug" => $cate_slug,
     "cate_title" => $cate_title,
     "map_color" => $map_color,
     "region_selected" => $region_selected,
     "marker" => $marker,
     "time_created" => time(),
     "status" => 1
  );

  $db_table = $wpdb->prefix.'bpsworld_cate';
  $updated = $wpdb->insert($db_table, $inserted_data);

  if ( ! $updated ) {
    $wpdb->print_error();
    $data = array(
      'error'           => 1
    );
  } else {
    $data = array(
      'error'           => 0,
      'new_id'          => $wpdb->insert_id,
      'time_created'    => date("d/m/Y", time())
    );
  }
  wp_send_json( $data );
  die();
}


//ajax part - remove country record
add_action('wp_ajax_del_country', 'ajax_delcountry');
add_action('wp_ajax_nopriv_del_country', 'ajax_delcountry');//for us
function ajax_delcountry() {
  global $wpdb;
  $country_id               = $_REQUEST["country_id"];

  $inserted_data =  array(
     "status" => 0
  );

  $db_table = $wpdb->prefix.'bpsworld_country';
  $updated = $wpdb->update($db_table, $inserted_data, array('id'=>$country_id));

  if ( ! $updated ) {
    $wpdb->print_error();
    $data = array(
      'error'           => 1
    );
  } else {
    $data = array(
      'error'           => 0
    );
  }
  wp_send_json( $data );
  die();

}


//ajax part - edit country record
add_action('wp_ajax_edit_country', 'ajax_editcountry');
add_action('wp_ajax_nopriv_edit_country', 'ajax_editcountry');//for us
function ajax_editcountry() {
  global $wpdb;
  $cate_slug                = $_REQUEST["cate_slug"];
  $country_id               = $_REQUEST["country_id"];
  $country_code             = $_REQUEST["country_code"];
  $country_latlon           = explode(",",$_REQUEST["country_latlon"]);
  $country_name             = $_REQUEST["country_name"];
  $country_title            = $_REQUEST["country_title"];
  $country_content          = $_REQUEST["country_content"];
  $country_link             = $_REQUEST["country_link"];

  $inserted_data =  array(
     "cate_slug" => $cate_slug,
     "country_code" => $country_code,
     "country_lat" => $country_latlon[0],
     "country_lon" => $country_latlon[1],
     "country_name" => $country_name,
     "country_title" => $country_title,
     "country_content" => $country_content,
     "country_link" => $country_link,
     "time_created" => time(),
     "status" => 1
  );

  $db_table = $wpdb->prefix.'bpsworld_country';
  $updated = $wpdb->update($db_table, $inserted_data, array('id'=>$country_id));

  if ( ! $updated ) {
    $wpdb->print_error();
    $data = array(
      'error'           => 1
    );
  } else {
    $data = array(
      'error'           => 0,
      'new_id'          => $country_id,
      'time_created'    => date("d/m/Y", time())
    );
  }
  wp_send_json( $data );
  die();
}

//ajax part - add country record
add_action('wp_ajax_add_country', 'ajax_addcountry');
add_action('wp_ajax_nopriv_add_country', 'ajax_addcountry');//for us
function ajax_addcountry() {
  global $wpdb;
  $cate_slug             = $_REQUEST["cate_slug"];
  $country_code             = $_REQUEST["country_code"];
  $country_latlon           = explode(",",$_REQUEST["country_latlon"]);
  $country_name             = $_REQUEST["country_name"];
  $country_title            = $_REQUEST["country_title"];
  $country_content          = $_REQUEST["country_content"];
  $country_link             = $_REQUEST["country_link"];

  $inserted_data =  array(
     "cate_slug" => $cate_slug,
     "country_code" => $country_code,
     "country_lat" => $country_latlon[0],
     "country_lon" => $country_latlon[1],
     "country_name" => $country_name,
     "country_title" => $country_title,
     "country_content" => $country_content,
     "country_link" => $country_link,
     "time_created" => time(),
     "status" => 1
  );

  $db_table = $wpdb->prefix.'bpsworld_country';
  $updated = $wpdb->insert($db_table, $inserted_data);

  if ( ! $updated ) {
    $wpdb->print_error();
    $data = array(
      'error'           => 1
    );
  } else {
    $data = array(
      'error'           => 0,
      'new_id'          => $wpdb->insert_id,
      'time_created'    => date("d/m/Y", time())
    );
  }
  wp_send_json( $data );
  die();
}

function get_countries(){
  $countries = Array(
      0 => Array(
              'country_name' => 'Albania',
              'country_code' => 'AL',
              'country_lat' => '41',
              'country_lon' => '20'
      ),
      1 => Array(
              'country_name' => 'Algeria',
              'country_code' => 'DZ',
              'country_lat' => '28',
              'country_lon' => '3'
      ),
      2 => Array(
              'country_name' => 'American Samoa',
              'country_code' => 'AS',
              'country_lat' => '-14.3333',
              'country_lon' => '-170'
      ),
      3 => Array(
              'country_name' => 'Andorra',
              'country_code' => 'AD',
              'country_lat' => '42.5',
              'country_lon' => '1.6'
      ),
      4 => Array(
              'country_name' => 'Angola',
              'country_code' => 'AO',
              'country_lat' => '-12.5',
              'country_lon' => '18.5'
      ),
      5 => Array(
              'country_name' => 'Anguilla',
              'country_code' => 'AI',
              'country_lat' => '18.25',
              'country_lon' => '-63.1667'
      ),
      6 => Array(
              'country_name' => 'Antarctica',
              'country_code' => 'AQ',
              'country_lat' => '-90',
              'country_lon' => '0'
      ),
      7 => Array(
              'country_name' => 'Antigua and Barbuda',
              'country_code' => 'AG',
              'country_lat' => '17.05',
              'country_lon' => '-61.8'
      ),
      8 => Array(
              'country_name' => 'Argentina',
              'country_code' => 'AR',
              'country_lat' => '-34',
              'country_lon' => '-64'
      ),
      9 => Array(
              'country_name' => 'Armenia',
              'country_code' => 'AM',
              'country_lat' => '40',
              'country_lon' => '45'
      ),
      10 => Array(
              'country_name' => 'Aruba',
              'country_code' => 'AW',
              'country_lat' => '12.5',
              'country_lon' => '-69.9667'
      ),
      11 => Array(
              'country_name' => 'Australia',
              'country_code' => 'AU',
              'country_lat' => '-27',
              'country_lon' => '133'
      ),
      12 => Array(
              'country_name' => 'Austria',
              'country_code' => 'AT',
              'country_lat' => '47.3333',
              'country_lon' => '13.3333'
      ),
      13 => Array(
              'country_name' => 'Azerbaijan',
              'country_code' => 'AZ',
              'country_lat' => '40.5',
              'country_lon' => '47.5'
      ),
      14 => Array(
              'country_name' => 'Bahamas',
              'country_code' => 'BS',
              'country_lat' => '24.25',
              'country_lon' => '-76'
      ),
      15 => Array(
              'country_name' => 'Bahrain',
              'country_code' => 'BH',
              'country_lat' => '26',
              'country_lon' => '50.55'
      ),
      16 => Array  (
              'country_name' => 'Bangladesh',
              'country_code' => 'BD',
              'country_lat' => '24',
              'country_lon' => '90'
      ),
      17 => Array(
              'country_name' => 'Barbados',
              'country_code' => 'BB',
              'country_lat' => '13.1667',
              'country_lon' => '-59.5333'
      ),
      18 => Array(
              'country_name' => 'Belarus',
              'country_code' => 'BY',
              'country_lat' => '53',
              'country_lon' => '28'
      ),
      19 => Array  (
              'country_name' => 'Belgium',
              'country_code' => 'BE',
              'country_lat' => '50.8333',
              'country_lon' => '4'
      ),
      20 => Array(
              'country_name' => 'Belize',
              'country_code' => 'BZ',
              'country_lat' => '17.25',
              'country_lon' => '-88.75'
      ),
      21 => Array(
              'country_name' => 'Benin',
              'country_code' => 'BJ',
              'country_lat' => '9.5',
              'country_lon' => '2.25'
      ),
      22 => Array(
              'country_name' => 'Bermuda',
              'country_code' => 'BM',
              'country_lat' => '32.3333',
              'country_lon' => '-64.75'
      ),
      23 => Array(
              'country_name' => 'Bhutan',
              'country_code' => 'BT',
              'country_lat' => '27.5',
              'country_lon' => '90.5'
      ),
      24 => Array(
              'country_name' => 'Bolivia, Plurinational State of',
              'country_code' => 'BO',
              'country_lat' => '-17',
              'country_lon' => '-65'
      ),
      25 => Array(
              'country_name' => 'Bosnia and Herzegovina',
              'country_code' => 'BA',
              'country_lat' => '44',
              'country_lon' => '18'
      ),
      26 => Array(
              'country_name' => 'Botswana',
              'country_code' => 'BW',
              'country_lat' => '-22',
              'country_lon' => '24'
      ),
      27 => Array(
              'country_name' => 'Bouvet Island',
              'country_code' => 'BV',
              'country_lat' => '-54.4333',
              'country_lon' => '3.4'
      ),
      28 => Array(
              'country_name' => 'Brazil',
              'country_code' => 'BR',
              'country_lat' => '-10',
              'country_lon' => '-55'
      ),
      29 => Array(
              'country_name' => 'British Indian Ocean Territory',
              'country_code' => 'IO',
              'country_lat' => '-6',
              'country_lon' => '71.5'
      ),
      30 => Array(
              'country_name' => 'Brunei Darussalam',
              'country_code' => 'BN',
              'country_lat' => '4.5',
              'country_lon' => '114.6667'
      ),
      31 => Array(
              'country_name' => 'Bulgaria',
              'country_code' => 'BG',
              'country_lat' => '43',
              'country_lon' => '25'
      ),
      32 => Array(
              'country_name' => 'Burkina Faso',
              'country_code' => 'BF',
              'country_lat' => '13',
              'country_lon' => '-2'
      ),
      33 => Array(
              'country_name' => 'Burundi',
              'country_code' => 'BI',
              'country_lat' => '-3.5',
              'country_lon' => '30'
      ),
      34 => Array(
              'country_name' => 'Cambodia',
              'country_code' => 'KH',
              'country_lat' => '13',
              'country_lon' => '105'
      ),
      35 => Array(
              'country_name' => 'Cameroon',
              'country_code' => 'CM',
              'country_lat' => '6',
              'country_lon' => '12'
      ),
      36 => Array(
              'country_name' => 'Canada',
              'country_code' => 'CA',
              'country_lat' => '60',
              'country_lon' => '-95'
      ),
      37 => Array(
              'country_name' => 'Cape Verde',
              'country_code' => 'CV',
              'country_lat' => '16',
              'country_lon' => '-24'
      ),
      38 => Array(
              'country_name' => 'Cayman Islands',
              'country_code' => 'KY',
              'country_lat' => '19.5',
              'country_lon' => '-80.5'
      ),
      39 => Array(
              'country_name' => 'Central African Republic',
              'country_code' => 'CF',
              'country_lat' => '7',
              'country_lon' => '21'
      ),
      40 => Array(
              'country_name' => 'Chad',
              'country_code' => 'TD',
              'country_lat' => '15',
              'country_lon' => '19'
      ),
      41 => Array(
              'country_name' => 'Chile',
              'country_code' => 'CL',
              'country_lat' => '-30',
              'country_lon' => '-71'
      ),
      42 => Array  (
              'country_name' => 'China',
              'country_code' => 'CN',
              'country_lat' => '35',
              'country_lon' => '105'
      ),
      43 => Array(
              'country_name' => 'Christmas Island',
              'country_code' => 'CX',
              'country_lat' => '-10.5',
              'country_lon' => '105.6667'
      ),
      44 => Array(
              'country_name' => 'Cocos (Keeling), Islands',
              'country_code' => 'CC',
              'country_lat' => '-12.5',
              'country_lon' => '96.8333'
      ),
      45 => Array(
              'country_name' => 'Colombia',
              'country_code' => 'CO',
              'country_lat' => '4',
              'country_lon' => '-72'
      ),
      46 => Array(
              'country_name' => 'Comoros',
              'country_code' => 'KM',
              'country_lat' => '-12.1667',
              'country_lon' => '44.25'
      ),
      47 => Array(
              'country_name' => 'Congo',
              'country_code' => 'CG',
              'country_lat' => '-1',
              'country_lon' => '15'
      ),
      48 => Array(
              'country_name' => 'Congo, the Democratic Republic of the',
              'country_code' => 'CD',
              'country_lat' => '0',
              'country_lon' => '25'
      ),
      49 => Array(
              'country_name' => 'Cook Islands',
              'country_code' => 'CK',
              'country_lat' => '-21.2333',
              'country_lon' => '-159.7667'
      ),
      50 => Array(
              'country_name' => 'Costa Rica',
              'country_code' => 'CR',
              'country_lat' => '10',
              'country_lon' => '-84'
      ),
      51 => Array(
              'country_name' => 'Côte d\'Ivoire',
              'country_code' => 'CI',
              'country_lat' => '8',
              'country_lon' => '-5'
      ),
      52 => Array(
              'country_name' => 'Croatia',
              'country_code' => 'HR',
              'country_lat' => '45.1667',
              'country_lon' => '15.5'
      ),
      53 => Array(
              'country_name' => 'Cuba',
              'country_code' => 'CU',
              'country_lat' => '21.5',
              'country_lon' => '-80'
      ),
      54 => Array(
              'country_name' => 'Cyprus',
              'country_code' => 'CY',
              'country_lat' => '35',
              'country_lon' => '33'
      ),
      55 => Array(
              'country_name' => 'Czech Republic',
              'country_code' => 'CZ',
              'country_lat' => '49.75',
              'country_lon' => '15.5'
      ),
      56 => Array(
              'country_name' => 'Denmark',
              'country_code' => 'DK',
              'country_lat' => '56',
              'country_lon' => '10'
      ),
      57 => Array(
              'country_name' => 'Djibouti',
              'country_code' => 'DJ',
              'country_lat' => '11.5',
              'country_lon' => '43'
      ),
      58 => Array(
              'country_name' => 'Dominica',
              'country_code' => 'DM',
              'country_lat' => '15.4167',
              'country_lon' => '-61.3333'
      ),
      59 => Array(
              'country_name' => 'Dominican Republic',
              'country_code' => 'DO',
              'country_lat' => '19',
              'country_lon' => '-70.6667'
      ),
      60 => Array(
              'country_name' => 'Ecuador',
              'country_code' => 'EC',
              'country_lat' => '-2',
              'country_lon' => '-77.5'
      ),
      61 => Array(
              'country_name' => 'Egypt',
              'country_code' => 'EG',
              'country_lat' => '27',
              'country_lon' => '30'
      ),
      62 => Array(
              'country_name' => 'El Salvador',
              'country_code' => 'SV',
              'country_lat' => '13.8333',
              'country_lon' => '-88.9167'
      ),
      63 => Array(
              'country_name' => 'Equatorial Guinea',
              'country_code' => 'GQ',
              'country_lat' => '2',
              'country_lon' => '10'
      ),
      64 => Array(
              'country_name' => 'Eritrea',
              'country_code' => 'ER',
              'country_lat' => '15',
              'country_lon' => '39'
      ),
      65 => Array(
              'country_name' => 'Estonia',
              'country_code' => 'EE',
              'country_lat' => '59',
              'country_lon' => '26'
      ),
      66 => Array(
              'country_name' => 'Ethiopia',
              'country_code' => 'ET',
              'country_lat' => '8',
              'country_lon' => '38'
      ),
      67 => Array(
              'country_name' => 'Falkland Islands (Malvinas)',
              'country_code' => 'FK',
              'country_lat' => '-51.75',
              'country_lon' => '-59'
      ),
      68 => Array(
              'country_name' => 'Faroe Islands',
              'country_code' => 'FO',
              'country_lat' => '62',
              'country_lon' => '-7'
      ),
      69 => Array  (
              'country_name' => 'Fiji',
              'country_code' => 'FJ',
              'country_lat' => '-18',
              'country_lon' => '175'
      ),
      70 => Array(
              'country_name' => 'Finland',
              'country_code' => 'FI',
              'country_lat' => '64',
              'country_lon' => '26'
      ),
      71 => Array(
              'country_name' => 'France',
              'country_code' => 'FR',
              'country_lat' => '46',
              'country_lon' => '2'
      ),
      72 => Array(
              'country_name' => 'French Guiana',
              'country_code' => 'GF',
              'country_lat' => '4',
              'country_lon' => '-53'
      ),
      73 => Array(
              'country_name' => 'French Polynesia',
              'country_code' => 'PF',
              'country_lat' => '-15',
              'country_lon' => '-140'
      ),
      74 => Array(
              'country_name' => 'French Southern Territories',
              'country_code' => 'TF',
              'country_lat' => '-43',
              'country_lon' => '67'
      ),
      75 => Array(
              'country_name' => 'Gabon',
              'country_code' => 'GA',
              'country_lat' => '-1',
              'country_lon' => '11.75'
      ),
      76 => Array(
              'country_name' => 'Gambia',
              'country_code' => 'GM',
              'country_lat' => '13.4667',
              'country_lon' => '-16.5667'
      ),
      77 => Array(
              'country_name' => 'Georgia',
              'country_code' => 'GE',
              'country_lat' => '42',
              'country_lon' => '43.5'
      ),
      78 => Array(
              'country_name' => 'Germany',
              'country_code' => 'DE',
              'country_lat' => '51',
              'country_lon' => '9'
      ),
      79 => Array(
              'country_name' => 'Ghana',
              'country_code' => 'GH',
              'country_lat' => '8',
              'country_lon' => '-2'
      ),
      80 => Array(
              'country_name' => 'Gibraltar',
              'country_code' => 'GI',
              'country_lat' => '36.1833',
              'country_lon' => '-5.3667'
      ),
      81 => Array(
              'country_name' => 'Greece',
              'country_code' => 'GR',
              'country_lat' => '39',
              'country_lon' => '22'
      ),
      82 => Array(
              'country_name' => 'Greenland',
              'country_code' => 'GL',
              'country_lat' => '72',
              'country_lon' => '-40'
      ),
      83 => Array(
              'country_name' => 'Grenada',
              'country_code' => 'GD',
              'country_lat' => '12.1167',
              'country_lon' => '-61.6667'
      ),
      84 => Array(
              'country_name' => 'Guadeloupe',
              'country_code' => 'GP',
              'country_lat' => '16.25',
              'country_lon' => '-61.5833'
      ),
      85 => Array(
              'country_name' => 'Guam',
              'country_code' => 'GU',
              'country_lat' => '13.4667',
              'country_lon' => '144.7833'
      ),
      86 => Array(
              'country_name' => 'Guatemala',
              'country_code' => 'GT',
              'country_lat' => '15.5',
              'country_lon' => '-90.25'
      ),
      87 => Array(
              'country_name' => 'Guernsey',
              'country_code' => 'GG',
              'country_lat' => '49.5',
              'country_lon' => '-2.56'
      ),
      88 => Array(
              'country_name' => 'Guinea',
              'country_code' => 'GN',
              'country_lat' => '11',
              'country_lon' => '-10'
      ),
      89 => Array(
              'country_name' => 'Guinea-Bissau',
              'country_code' => 'GW',
              'country_lat' => '12',
              'country_lon' => '-15'
      ),
      90 => Array(
              'country_name' => 'Guyana',
              'country_code' => 'GY',
              'country_lat' => '5',
              'country_lon' => '-59'
      ),
      91 => Array(
              'country_name' => 'Haiti',
              'country_code' => 'HT',
              'country_lat' => '19',
              'country_lon' => '-72.4167'
      ),
      92 => Array(
              'country_name' => 'Heard Island and McDonald Islands',
              'country_code' => 'HM',
              'country_lat' => '-53.1',
              'country_lon' => '72.5167'
      ),
      93 => Array(
              'country_name' => 'Holy See (Vatican City State)',
              'country_code' => 'VA',
              'country_lat' => '41.9',
              'country_lon' => '12.45'
      ),
      94 => Array(
              'country_name' => 'Honduras',
              'country_code' => 'HN',
              'country_lat' => '15',
              'country_lon' => '-86.5'
      ),
      95 => Array(
              'country_name' => 'Hong Kong',
              'country_code' => 'HK',
              'country_lat' => '22.25',
              'country_lon' => '114.1667'
      ),
      96 => Array(
              'country_name' => 'Hungary',
              'country_code' => 'HU',
              'country_lat' => '47',
              'country_lon' => '20'
      ),
      97 => Array(
              'country_name' => 'Iceland',
              'country_code' => 'IS',
              'country_lat' => '65',
              'country_lon' => '-18'
      ),
      98 => Array(
              'country_name' => 'India',
              'country_code' => 'IN',
              'country_lat' => '20',
              'country_lon' => '77'
      ),
      99 => Array(
              'country_name' => 'Indonesia',
              'country_code' => 'ID',
              'country_lat' => '-5',
              'country_lon' => '120'
      ),
      100 => Array(
              'country_name' => 'Iran, Islamic Republic of',
              'country_code' => 'IR',
              'country_lat' => '32',
              'country_lon' => '53'
      ),
      101 => Array(
              'country_name' => 'Iraq',
              'country_code' => 'IQ',
              'country_lat' => '33',
              'country_lon' => '44'
      ),
      102 => Array(
              'country_name' => 'Ireland',
              'country_code' => 'IE',
              'country_lat' => '53',
              'country_lon' => '-8'
      ),
      103 => Array(
              'country_name' => 'Isle of Man',
              'country_code' => 'IM',
              'country_lat' => '54.23',
              'country_lon' => '-4.55'
      ),
      104 => Array(
              'country_name' => 'Israel',
              'country_code' => 'IL',
              'country_lat' => '31.5',
              'country_lon' => '34.75'
      ),
      105 => Array(
              'country_name' => 'Italy',
              'country_code' => 'IT',
              'country_lat' => '42.8333',
              'country_lon' => '12.8333'
      ),
      106 => Array(
              'country_name' => 'Jamaica',
              'country_code' => 'JM',
              'country_lat' => '18.25',
              'country_lon' => '-77.5'
      ),
      107 => Array(
              'country_name' => 'Japan',
              'country_code' => 'JP',
              'country_lat' => '36',
              'country_lon' => '138'
      ),
      108 => Array(
              'country_name' => 'Jersey',
              'country_code' => 'JE',
              'country_lat' => '49.21',
              'country_lon' => '-2.13'
      ),
      109 => Array(
              'country_name' => 'Jordan',
              'country_code' => 'JO',
              'country_lat' => '31',
              'country_lon' => '36'
      ),
      110 => Array(
              'country_name' => 'Kazakhstan',
              'country_code' => 'KZ',
              'country_lat' => '48',
              'country_lon' => '68'
      ),
      111 => Array(
              'country_name' => 'Kenya',
              'country_code' => 'KE',
              'country_lat' => '1',
              'country_lon' => '38'
      ),
      112 => Array(
              'country_name' => 'Kiribati',
              'country_code' => 'KI',
              'country_lat' => '1.4167',
              'country_lon' => '173'
      ),
      113 => Array(
              'country_name' => 'Korea, Democratic People\'s Republic of',
              'country_code' => 'KP',
              'country_lat' => '40',
              'country_lon' => '127'
      ),
      114 => Array(
              'country_name' => 'Korea, Republic of',
              'country_code' => 'KR',
              'country_lat' => '37',
              'country_lon' => '127.5'
      ),
      115 => Array(
              'country_name' => 'Kuwait',
              'country_code' => 'KW',
              'country_lat' => '29.3375',
              'country_lon' => '47.6581'
      ),
      116 => Array(
              'country_name' => 'Kyrgyzstan',
              'country_code' => 'KG',
              'country_lat' => '41',
              'country_lon' => '75'
      ),
      117 => Array(
              'country_name' => 'Lao People\'s Democratic Republic',
              'country_code' => 'LA',
              'country_lat' => '18',
              'country_lon' => '105'
      ),
      118 => Array(
              'country_name' => 'Latvia',
              'country_code' => 'LV',
              'country_lat' => '57',
              'country_lon' => '25'
      ),
      119 => Array(
              'country_name' => 'Lebanon',
              'country_code' => 'LB',
              'country_lat' => '33.8333',
              'country_lon' => '35.8333'
      ),
      120 => Array
          (
              'country_name' => 'Lesotho',
              'country_code' => 'LS',
              'country_lat' => '-29.5',
              'country_lon' => '28.5'
          ),

      121 => Array
          (
              'country_name' => 'Liberia',
              'country_code' => 'LR',
              'country_lat' => '6.5',
              'country_lon' => '-9.5'
          ),

      122 => Array
          (
              'country_name' => 'Libyan Arab Jamahiriya',
              'country_code' => 'LY',
              'country_lat' => '25',
              'country_lon' => '17'
          ),

      123 => Array
          (
              'country_name' => 'Liechtenstein',
              'country_code' => 'LI',
              'country_lat' => '47.1667',
              'country_lon' => '9.5333'
          ),

      124 => Array
          (
              'country_name' => 'Lithuania',
              'country_code' => 'LT',
              'country_lat' => '56',
              'country_lon' => '24'
          ),

      125 => Array
          (
              'country_name' => 'Luxembourg',
              'country_code' => 'LU',
              'country_lat' => '49.75',
              'country_lon' => '6.1667'
          ),

      126 => Array
          (
              'country_name' => 'Macao',
              'country_code' => 'MO',
              'country_lat' => '22.1667',
              'country_lon' => '113.55'
          ),

      127 => Array
          (
              'country_name' => 'Macedonia, the former Yugoslav Republic of',
              'country_code' => 'MK',
              'country_lat' => '41.8333',
              'country_lon' => '22'
          ),

      128 => Array
          (
              'country_name' => 'Madagascar',
              'country_code' => 'MG',
              'country_lat' => '-20',
              'country_lon' => '47'
          ),

      129 => Array
          (
              'country_name' => 'Malawi',
              'country_code' => 'MW',
              'country_lat' => '-13.5',
              'country_lon' => '34'
          ),

      130 => Array
          (
              'country_name' => 'Malaysia',
              'country_code' => 'MY',
              'country_lat' => '2.5',
              'country_lon' => '112.5'
          ),

      131 => Array
          (
              'country_name' => 'Maldives',
              'country_code' => 'MV',
              'country_lat' => '3.25',
              'country_lon' => '73'
          ),

      132 => Array
          (
              'country_name' => 'Mali',
              'country_code' => 'ML',
              'country_lat' => '17',
              'country_lon' => '-4'
          ),

      133 => Array
          (
              'country_name' => 'Malta',
              'country_code' => 'MT',
              'country_lat' => '35.8333',
              'country_lon' => '14.5833'
          ),

      134 => Array
          (
              'country_name' => 'Marshall Islands',
              'country_code' => 'MH',
              'country_lat' => '9',
              'country_lon' => '168'
          ),

      135 => Array
          (
              'country_name' => 'Martinique',
              'country_code' => 'MQ',
              'country_lat' => '14.6667',
              'country_lon' => '-61'
          ),

      136 => Array
          (
              'country_name' => 'Mauritania',
              'country_code' => 'MR',
              'country_lat' => '20',
              'country_lon' => '-12'
          ),

      137 => Array
          (
              'country_name' => 'Mauritius',
              'country_code' => 'MU',
              'country_lat' => '-20.2833',
              'country_lon' => '57.55'
          ),

      138 => Array
          (
              'country_name' => 'Mayotte',
              'country_code' => 'YT',
              'country_lat' => '-12.8333',
              'country_lon' => '45.1667'
          ),

      139 => Array
          (
              'country_name' => 'Mexico',
              'country_code' => 'MX',
              'country_lat' => '23',
              'country_lon' => '-102'
          ),

      140 => Array
          (
              'country_name' => 'Micronesia, Federated States of',
              'country_code' => 'FM',
              'country_lat' => '6.9167',
              'country_lon' => '158.25'
          ),

      141 => Array
          (
              'country_name' => 'Moldova, Republic of',
              'country_code' => 'MD',
              'country_lat' => '47',
              'country_lon' => '29'
          ),

      142 => Array
          (
              'country_name' => 'Monaco',
              'country_code' => 'MC',
              'country_lat' => '43.7333',
              'country_lon' => '7.4'
          ),

      143 => Array
          (
              'country_name' => 'Mongolia',
              'country_code' => 'MN',
              'country_lat' => '46',
              'country_lon' => '105'
          ),

      144 => Array
          (
              'country_name' => 'Montenegro',
              'country_code' => 'ME',
              'country_lat' => '42',
              'country_lon' => '19'
          ),

      145 => Array
          (
              'country_name' => 'Montserrat',
              'country_code' => 'MS',
              'country_lat' => '16.75',
              'country_lon' => '-62.2'
          ),

      146 => Array
          (
              'country_name' => 'Morocco',
              'country_code' => 'MA',
              'country_lat' => '32',
              'country_lon' => '-5'
          ),

      147 => Array
          (
              'country_name' => 'Mozambique',
              'country_code' => 'MZ',
              'country_lat' => '-18.25',
              'country_lon' => '35'
          ),

      148 => Array
          (
              'country_name' => 'Myanmar',
              'country_code' => 'MM',
              'country_lat' => '22',
              'country_lon' => '98'
          ),

      149 => Array
          (
              'country_name' => 'Namibia',
              'country_code' => 'NA',
              'country_lat' => '-22',
              'country_lon' => '17'
          ),

      150 => Array
          (
              'country_name' => 'Nauru',
              'country_code' => 'NR',
              'country_lat' => '-0.5333',
              'country_lon' => '166.9167'
          ),

      151 => Array
          (
              'country_name' => 'Nepal',
              'country_code' => 'NP',
              'country_lat' => '28',
              'country_lon' => '84'
          ),

      152 => Array
          (
              'country_name' => 'Netherlands',
              'country_code' => 'NL',
              'country_lat' => '52.5',
              'country_lon' => '5.75'
          ),

      153 => Array
          (
              'country_name' => 'Netherlands Antilles',
              'country_code' => 'AN',
              'country_lat' => '12.25',
              'country_lon' => '-68.75'
          ),

      154 => Array
          (
              'country_name' => 'New Caledonia',
              'country_code' => 'NC',
              'country_lat' => '-21.5',
              'country_lon' => '165.5'
          ),

      155 => Array
          (
              'country_name' => 'New Zealand',
              'country_code' => 'NZ',
              'country_lat' => '-41',
              'country_lon' => '174'
          ),

      156 => Array
          (
              'country_name' => 'Nicaragua',
              'country_code' => 'NI',
              'country_lat' => '13',
              'country_lon' => '-85'
          ),

      157 => Array
          (
              'country_name' => 'Niger',
              'country_code' => 'NE',
              'country_lat' => '16',
              'country_lon' => '8'
          ),

      158 => Array
          (
              'country_name' => 'Nigeria',
              'country_code' => 'NG',
              'country_lat' => '10',
              'country_lon' => '8'
          ),

      159 => Array
          (
              'country_name' => 'Niue',
              'country_code' => 'NU',
              'country_lat' => '-19.0333',
              'country_lon' => '-169.8667'
          ),

      160 => Array
          (
              'country_name' => 'Norfolk Island',
              'country_code' => 'NF',
              'country_lat' => '-29.0333',
              'country_lon' => '167.95'
          ),

      161 => Array
          (
              'country_name' => 'Northern Mariana Islands',
              'country_code' => 'MP',
              'country_lat' => '15.2',
              'country_lon' => '145.75'
          ),

      162 => Array
          (
              'country_name' => 'Norway',
              'country_code' => 'NO',
              'country_lat' => '62',
              'country_lon' => '10'
          ),

      163 => Array
          (
              'country_name' => 'Oman',
              'country_code' => 'OM',
              'country_lat' => '21',
              'country_lon' => '57'
          ),

      164 => Array
          (
              'country_name' => 'Pakistan',
              'country_code' => 'PK',
              'country_lat' => '30',
              'country_lon' => '70'
          ),

      165 => Array
          (
              'country_name' => 'Palau',
              'country_code' => 'PW',
              'country_lat' => '7.5',
              'country_lon' => '134.5'
          ),

      166 => Array
          (
              'country_name' => 'Palestinian Territory, Occupied',
              'country_code' => 'PS',
              'country_lat' => '32',
              'country_lon' => '35.25'
          ),

      167 => Array
          (
              'country_name' => 'Panama',
              'country_code' => 'PA',
              'country_lat' => '9',
              'country_lon' => '-80'
          ),

      168 => Array
          (
              'country_name' => 'Papua New Guinea',
              'country_code' => 'PG',
              'country_lat' => '-6',
              'country_lon' => '147'
          ),

      169 => Array
          (
              'country_name' => 'Paraguay',
              'country_code' => 'PY',
              'country_lat' => '-23',
              'country_lon' => '-58'
          ),

      170 => Array
          (
              'country_name' => 'Peru',
              'country_code' => 'PE',
              'country_lat' => '-10',
              'country_lon' => '-76'
          ),

      171 => Array
          (
              'country_name' => 'Philippines',
              'country_code' => 'PH',
              'country_lat' => '13',
              'country_lon' => '122'
          ),

      172 => Array
          (
              'country_name' => 'Pitcairn',
              'country_code' => 'PN',
              'country_lat' => '-24.7',
              'country_lon' => '-127.4'
          ),

      173 => Array
          (
              'country_name' => 'Poland',
              'country_code' => 'PL',
              'country_lat' => '52',
              'country_lon' => '20'
          ),

      174 => Array
          (
              'country_name' => 'Portugal',
              'country_code' => 'PT',
              'country_lat' => '39.5',
              'country_lon' => '-8'
          ),

      175 => Array
          (
              'country_name' => 'Puerto Rico',
              'country_code' => 'PR',
              'country_lat' => '18.25',
              'country_lon' => '-66.5'
          ),

      176 => Array
          (
              'country_name' => 'Qatar',
              'country_code' => 'QA',
              'country_lat' => '25.5',
              'country_lon' => '51.25'
          ),

      177 => Array
          (
              'country_name' => 'Réunion',
              'country_code' => 'RE',
              'country_lat' => '-21.1',
              'country_lon' => '55.6'
          ),

      178 => Array
          (
              'country_name' => 'Romania',
              'country_code' => 'RO',
              'country_lat' => '46',
              'country_lon' => '25'
          ),

      179 => Array
          (
              'country_name' => 'Russian Federation',
              'country_code' => 'RU',
              'country_lat' => '60',
              'country_lon' => '100'
          ),

      180 => Array
          (
              'country_name' => 'Rwanda',
              'country_code' => 'RW',
              'country_lat' => '-2',
              'country_lon' => '30'
          ),

      181 => Array
          (
              'country_name' => 'Saint Helena, Ascension and Tristan da Cunha',
              'country_code' => 'SH',
              'country_lat' => '-15.9333',
              'country_lon' => '-5.7'
          ),

      182 => Array
          (
              'country_name' => 'Saint Kitts and Nevis',
              'country_code' => 'KN',
              'country_lat' => '17.3333',
              'country_lon' => '-62.75'
          ),

      183 => Array
          (
              'country_name' => 'Saint Lucia',
              'country_code' => 'LC',
              'country_lat' => '13.8833',
              'country_lon' => '-61.1333'
          ),

      184 => Array
          (
              'country_name' => 'Saint Pierre and Miquelon',
              'country_code' => 'PM',
              'country_lat' => '46.8333',
              'country_lon' => '-56.3333'
          ),

      185 => Array
          (
              'country_name' => 'Saint Vincent and the Grenadines',
              'country_code' => 'VC',
              'country_lat' => '13.25',
              'country_lon' => '-61.2'
          ),

      186 => Array
          (
              'country_name' => 'Samoa',
              'country_code' => 'WS',
              'country_lat' => '-13.5833',
              'country_lon' => '-172.3333'
          ),

      187 => Array
          (
              'country_name' => 'San Marino',
              'country_code' => 'SM',
              'country_lat' => '43.7667',
              'country_lon' => '12.4167'
          ),

      188 => Array
          (
              'country_name' => 'Sao Tome and Principe',
              'country_code' => 'ST',
              'country_lat' => '1',
              'country_lon' => '7'
          ),

      189 => Array
          (
              'country_name' => 'Saudi Arabia',
              'country_code' => 'SA',
              'country_lat' => '25',
              'country_lon' => '45'
          ),

      190 => Array
          (
              'country_name' => 'Senegal',
              'country_code' => 'SN',
              'country_lat' => '14',
              'country_lon' => -14
          ),

      191 => Array
          (
              'country_name' => 'Serbia',
              'country_code' => 'RS',
              'country_lat' => '44',
              'country_lon' => 21
          ),

      192 => Array
          (
              'country_name' => 'Seychelles',
              'country_code' => 'SC',
              'country_lat' => '-4.5833',
              'country_lon' => 55.6667
          ),

      193 => Array
          (
              'country_name' => 'Sierra Leone',
              'country_code' => 'SL',
              'country_lat' => '8.5',
              'country_lon' => -11.5
          ),

      194 => Array
          (
              'country_name' => 'Singapore',
              'country_code' => 'SG',
              'country_lat' => '1.3667',
              'country_lon' => 103.8
          ),

      195 => Array
          (
              'country_name' => 'Slovakia',
              'country_code' => 'SK',
              'country_lat' => '48.6667',
              'country_lon' => 19.5
          ),

      196 => Array
          (
              'country_name' => 'Slovenia',
              'country_code' => 'SI',
              'country_lat' => '46',
              'country_lon' => 15
          ),

      197 => Array
          (
              'country_name' => 'Solomon Islands',
              'country_code' => 'SB',
              'country_lat' => '-8',
              'country_lon' => 159
          ),

      198 => Array
          (
              'country_name' => 'Somalia',
              'country_code' => 'SO',
              'country_lat' => '10',
              'country_lon' => 49
          ),

      199 => Array
          (
              'country_name' => 'South Africa',
              'country_code' => 'ZA',
              'country_lat' => '-29',
              'country_lon' => 24
          ),

      200 => Array
          (
              'country_name' => 'South Georgia and the South Sandwich Islands',
              'country_code' => 'GS',
              'country_lat' => '-54.5',
              'country_lon' => -37
          ),

      201 => Array
          (
              'country_name' => 'Spain',
              'country_code' => 'ES',
              'country_lat' => '40',
              'country_lon' => -4
          ),

      202 => Array
          (
              'country_name' => 'Sri Lanka',
              'country_code' => 'LK',
              'country_lat' => '7',
              'country_lon' => 81
          ),

      203 => Array
          (
              'country_name' => 'Sudan',
              'country_code' => 'SD',
              'country_lat' => '15',
              'country_lon' => 30
          ),

      204 => Array
          (
              'country_name' => 'Suriname',
              'country_code' => 'SR',
              'country_lat' => '4',
              'country_lon' => -56
          ),

      205 => Array
          (
              'country_name' => 'Svalbard and Jan Mayen',
              'country_code' => 'SJ',
              'country_lat' => '78',
              'country_lon' => 20
          ),

      206 => Array
          (
              'country_name' => 'Swaziland',
              'country_code' => 'SZ',
              'country_lat' => '-26.5',
              'country_lon' => 31.5
          ),

      207 => Array
          (
              'country_name' => 'Sweden',
              'country_code' => 'SE',
              'country_lat' => '62',
              'country_lon' => 15
          ),

      208 => Array
          (
              'country_name' => 'Switzerland',
              'country_code' => 'CH',
              'country_lat' => '47',
              'country_lon' => 8
          ),

      209 => Array
          (
              'country_name' => 'Syrian Arab Republic',
              'country_code' => 'SY',
              'country_lat' => '35',
              'country_lon' => 38
          ),

      210 => Array
          (
              'country_name' => 'Taiwan, Province of China',
              'country_code' => 'TW',
              'country_lat' => '23.5',
              'country_lon' => 121
          ),

      211 => Array
          (
              'country_name' => 'Tajikistan',
              'country_code' => 'TJ',
              'country_lat' => '39',
              'country_lon' => 71
          ),

      212 => Array
          (
              'country_name' => 'Tanzania, United Republic of',
              'country_code' => 'TZ',
              'country_lat' => '-6',
              'country_lon' => 35
          ),

      213 => Array
          (
              'country_name' => 'Thailand',
              'country_code' => 'TH',
              'country_lat' => '15',
              'country_lon' => 100
          ),

      214 => Array
          (
              'country_name' => 'Timor-Leste',
              'country_code' => 'TL',
              'country_lat' => '-8.55',
              'country_lon' => 125.5167
          ),

      215 => Array
          (
              'country_name' => 'Togo',
              'country_code' => 'TG',
              'country_lat' => '8',
              'country_lon' => 1.1667
          ),

      216 => Array
          (
              'country_name' => 'Tokelau',
              'country_code' => 'TK',
              'country_lat' => '-9',
              'country_lon' => -172
          ),

      217 => Array
          (
              'country_name' => 'Tonga',
              'country_code' => 'TO',
              'country_lat' => '-20',
              'country_lon' => -175
          ),

      218 => Array
          (
              'country_name' => 'Trinidad and Tobago',
              'country_code' => 'TT',
              'country_lat' => '11',
              'country_lon' => -61
          ),

      219 => Array
          (
              'country_name' => 'Tunisia',
              'country_code' => 'TN',
              'country_lat' => '34',
              'country_lon' => 9
          ),

      220 => Array
          (
              'country_name' => 'Turkey',
              'country_code' => 'TR',
              'country_lat' => '39',
              'country_lon' => 35
          ),

      221 => Array
          (
              'country_name' => 'Turkmenistan',
              'country_code' => 'TM',
              'country_lat' => '40',
              'country_lon' => 60
          ),

      222 => Array
          (
              'country_name' => 'Turks and Caicos Islands',
              'country_code' => 'TC',
              'country_lat' => '21.75',
              'country_lon' => -71.5833
          ),

      223 => Array
          (
              'country_name' => 'Tuvalu',
              'country_code' => 'TV',
              'country_lat' => '-8',
              'country_lon' => 178
          ),

      224 => Array
          (
              'country_name' => 'Uganda',
              'country_code' => 'UG',
              'country_lat' => '1',
              'country_lon' => 32
          ),

      225 => Array
          (
              'country_name' => 'Ukraine',
              'country_code' => 'UA',
              'country_lat' => '49',
              'country_lon' => 32
          ),

      226 => Array
          (
              'country_name' => 'United Arab Emirates',
              'country_code' => 'AE',
              'country_lat' => '24',
              'country_lon' => 54
          ),

      227 => Array
          (
              'country_name' => 'United Kingdom',
              'country_code' => 'GB',
              'country_lat' => '54',
              'country_lon' => -2
          ),

      228 => Array
          (
              'country_name' => 'United States',
              'country_code' => 'US',
              'country_lat' => '38',
              'country_lon' => -97
          ),

      229 => Array
          (
              'country_name' => 'United States Minor Outlying Islands',
              'country_code' => 'UM',
              'country_lat' => '19.2833',
              'country_lon' => 166.6
          ),

      230 => Array
          (
              'country_name' => 'Uruguay',
              'country_code' => 'UY',
              'country_lat' => '-33',
              'country_lon' => -56
          ),

      231 => Array
          (
              'country_name' => 'Uzbekistan',
              'country_code' => 'UZ',
              'country_lat' => '41',
              'country_lon' => 64
          ),

      232 => Array
          (
              'country_name' => 'Vanuatu',
              'country_code' => 'VU',
              'country_lat' => '-16',
              'country_lon' => 167
          ),

      233 => Array
          (
              'country_name' => 'Venezuela, Bolivarian Republic of',
              'country_code' => 'VE',
              'country_lat' => '8',
              'country_lon' => -66
          ),

      234 => Array
          (
              'country_name' => 'Vietnam',
              'country_code' => 'VN',
              'country_lat' => '16',
              'country_lon' => 106
          ),

      235 => Array
          (
              'country_name' => 'Virgin Islands, British',
              'country_code' => 'VG',
              'country_lat' => '18.5',
              'country_lon' => -64.5
          ),

      236 => Array
          (
              'country_name' => 'Virgin Islands, U.S.',
              'country_code' => 'VI',
              'country_lat' => '18.3333',
              'country_lon' => -64.8333
          ),

      237 => Array
          (
              'country_name' => 'Wallis and Futuna',
              'country_code' => 'WF',
              'country_lat' => '-13.3',
              'country_lon' => -176.2
          ),

      238 => Array
          (
              'country_name' => 'Western Sahara',
              'country_code' => 'EH',
              'country_lat' => '24.5',
              'country_lon' => -13
          ),

      239 => Array
          (
              'country_name' => 'Yemen',
              'country_code' => 'YE',
              'country_lat' => '15',
              'country_lon' => 48
          ),

      240 => Array
          (
              'country_name' => 'Zambia',
              'country_code' => 'ZM',
              'country_lat' => '-15',
              'country_lon' => 30
          ),

      241 => Array
          (
              'country_name' => 'Zimbabwe',
              'country_code' => 'ZW',
              'country_lat' => '-20',
              'country_lon' => 30
          ),

      242 => Array  (
              'country_name' => 'Afghanistan',
              'country_code' => 'AF',
              'country_lat' => '33',
              'country_lon' => 65
          )
  );

  return $countries;
}

?>
