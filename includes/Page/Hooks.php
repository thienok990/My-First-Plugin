<?php
namespace YayCommerceSettings\Page;

use YayCommerceSettings\Helper\Utils;

defined('ABSPATH') || exit;

class Hooks {
  protected static $instance = null;

  public static function getInstance() {
    if (null == self::$instance) {
      self::$instance = new self;
      self::$instance->doHooks();
    }

    return self::$instance;
  }

  private function doHooks() {
    add_action( 'woocommerce_before_add_to_cart_quantity', array($this, 'add_settings_html'), 10, 0 ); 
    add_filter( 'woocommerce_add_to_cart_validation' , array($this, 'add_to_cart_validation'), 10, 3); 
  }

  private function __construct() {}

  public function add_settings_html(){
    include_once YAYCOMMERCE_PLUGIN_PATH . 'includes/Views/option_settings.php';
  }
  public function add_to_cart_validation($passed, $product_id, $quantity){
    if(!isset($_POST['vehicle'])){
      wc_add_notice( __( 'Please Fill', 'textdomain' ), 'error' );
      $passed = false;
    }
    else{
      $passed = true;
    }
    return $passed;
  }
}
