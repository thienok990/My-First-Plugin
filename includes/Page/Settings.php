<?php
namespace YayCommerceSettings\Page;

use YayCommerceSettings\Helper\Utils;

defined('ABSPATH') || exit;

class Settings {
  protected static $instance = null;

  public static function getInstance() {
    if (null == self::$instance) {
      self::$instance = new self;
      self::$instance->doHooks();
    }

    return self::$instance;
  }

  private function doHooks() {
    add_action('admin_menu', array($this, 'add_admin_menu'));
    add_action('admin_enqueue_scripts', array($this, 'my_custom_script_admin'));
    add_action('wp_enqueue_scripts', array($this, 'my_custom_script_frontend'));
  }

  private function __construct() {}

  public function add_admin_menu(){
    add_menu_page(
      'My First Plugin Demo',
      'My First Plugin Demo',
      'manage_options',
      'plugin_options',
      array($this,'show_plugin_options'),
      '',
      '2'
    );  
  }
  public function show_plugin_options(){
    include_once YAYCOMMERCE_PLUGIN_PATH . 'includes/Views/form.php';
  }
  public function my_custom_script_admin(){
    wp_enqueue_script('my_custom_script',  YAYCOMMERCE_PLUGIN_URL . 'assets/js/settings.js', array('jquery'));
    wp_localize_script('my_custom_script', 'yay_settings', array(
   'YAY_ADMIN_AJAX' => admin_url('admin-ajax.php')
   // 'ajaxNonce' => wp_create_nonce("ajax-nonce"),
    ));
  }
  public function my_custom_script_frontend(){
    wp_enqueue_script('my_custom_script_frontend',  YAYCOMMERCE_PLUGIN_URL . 'assets/js/settings_frontend.js', array('jquery'));
  }
}
