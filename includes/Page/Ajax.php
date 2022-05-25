<?php
namespace YayCommerceSettings\Page;

use YayCommerceSettings\Helper\Utils;

defined('ABSPATH') || exit;

class Ajax {
  protected static $instance = null;

  public static function getInstance() {
    if (null == self::$instance) {
      self::$instance = new self;
      self::$instance->doHooks();
    }

    return self::$instance;
  }

  private function doHooks() {
    add_action( 'wp_ajax_save_settings',   array($this, 'save_settings') );
  }

  private function __construct() {}

  public function save_settings() {
    $params_data = $_POST['params'];
    global $wpdb;
    if(!empty($params_data) && !empty($params_data['vehicleData'])){
        $param = $params_data['vehicleData'];
        $result = update_option('yay_settings',$param);
        // foreach($param as $value){
        //     $table = $wpdb->prefix.'yay_vehicle';
        //     $vehicle_name = $value['value'];
        //     $vehicle_costs = $value['cost'];
        //     $wpdb->insert($table,
        //     array(
        //         'value_vehicle' => $vehicle_name,
        //         'costs' => $vehicle_costs
        //     ),
        //     array(
        //         '%s',
        //         '%d',
        //     )
        // );
        // }

        if(!empty($result)){
            wp_send_json_success(array('mess' => __('Update success.', 'yay_settings')));
        }
        else{
            wp_send_json_error(array('mess' => __('Update false.', 'yay_settings')));
        }
    }
    else{
      update_option('yay_settings',[]);
        // wp_send_json_error(array('mess' => __('Params is empty.', 'yay_settings')));
    }
 }
}
