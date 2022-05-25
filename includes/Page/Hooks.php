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
    add_action( 'woocommerce_before_add_to_cart_quantity', array($this, 'add_settings_html'), 10, 0); 
    //add_filter( 'woocommerce_add_to_cart_validation' , array($this, 'add_to_cart_validation'), 10, 3);
    add_filter( 'woocommerce_add_cart_item_data',  array($this, 'add_cart_item_data'), 10, 4 );
    add_filter( 'woocommerce_get_item_data', array($this, 'display_on_cart_and_checkout'), 10, 2);
    add_filter( 'woocommerce_before_calculate_totals',array($this, 'add_custom_price'), 10, 3);
  }

  private function __construct() {}

  public function add_settings_html(){
    include_once YAYCOMMERCE_PLUGIN_PATH . 'includes/Views/option_settings.php';
  }

  public function add_cart_item_data($cart_item_data, $product_id, $variation_id, $quantity){
    if (isset($_POST['vehicle']) && ! empty($_POST['vehicle'])) {
      $array_item_data = $_POST['vehicle'];
      foreach($array_item_data as $key => $value)
      {
        $cart_item_data['yay_vehicle'][$key] = (float) $value;
      }
    } 
    return $cart_item_data;
  }
  public function display_on_cart_and_checkout($cart_data, $cart_item){
   // var_dump($cart_item);
    if(isset($cart_item['yay_vehicle'])){
      foreach($cart_item['yay_vehicle'] as $key => $value){
        $cart_data[] = array( 
          "key" => __($key, "woocommerce"),  
          "value" => $value
        );
      }
    }
    return $cart_data;
  }
  public function add_custom_price($cart){
    foreach ( $cart->get_cart() as $cart_item ) {
      $price_original = $cart_item['data']->get_price();
      $price_regular = $cart_item['data']->get_regular_price();
      if(!empty($cart_item['yay_vehicle'])){
        foreach($cart_item['yay_vehicle'] as $key => $value){
          $price_original += $value;
          $price_regular  += $value;
        }
      }
      $cart_item['data']->set_price( $price_original);
      $cart_item['data']->set_regular_price( $price_regular); 
    }  
  }
}
