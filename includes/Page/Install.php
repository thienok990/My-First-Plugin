<?php
namespace YayCommerceSettings\Page;

use YayCommerceSettings\Helper\Utils;

defined('ABSPATH') || exit;

class Install {
  protected static $instance = null;

  public static function getInstance() {
    if (null == self::$instance) {
      self::$instance = new self;
      self::$instance->doHooks();
    }

    return self::$instance;
  }

  private function doHooks() {
    $this->createTable();
  }

  private function __construct() {}

  public function createTable(){
    global $wpdb;
    $table = $wpdb->prefix.'yay_vehicle';
    $sql = "CREATE TABLE $table (
      `id` int auto_increment NOT NULL,
      `value_vehicle` varchar(255) NOT NULL,
      `costs` int NOT NULL,
      PRIMARY KEY  (id)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8;";
   
    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
    if ( $wpdb->get_var( "show tables like '$table'" ) != $table ) {
        dbDelta( $sql );
    }
  }  
}