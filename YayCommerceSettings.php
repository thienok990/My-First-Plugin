<?php
/**
 * Plugin Name: YayCommerce
 * Description: Đây là plugin đầu tiên mà tôi viết dành riêng cho WordPress, chỉ để học tập mà thôi. // Phần mô tả cho plugin
 * Version: 1.0 // Đây là phiên bản đầu tiên của plugin
 * Author: Cao Luong Thien // Tên tác giả, người thực hiện plugin này
 * License: GPLv2 or later // Thông tin license của plugin, nếu không quan tâm thì bạn cứ để GPLv2 vào đây
 */

namespace YayCommerceSettings;

use YayCommerceSettings\Page\Settings;
use YayCommerceSettings\Page\Ajax;
use YayCommerceSettings\Page\Hooks;
use YayCommerceSettings\Page\Install;

defined('ABSPATH') || exit;


if (!defined('YAYCOMMERCE_PLUGIN_URL')) {
  define('YAYCOMMERCE_PLUGIN_URL', plugin_dir_url(__FILE__));
}
if (!defined('YAYCOMMERCE_PLUGIN_PATH')) {
  define('YAYCOMMERCE_PLUGIN_PATH', plugin_dir_path(__FILE__));
}
spl_autoload_register(function ($class) {
  $prefix = __NAMESPACE__; // project-specific namespace prefix
  $base_dir = __DIR__ . '/includes'; // base directory for the namespace prefix
  $len = strlen($prefix);
  if (strncmp($prefix, $class, $len) !== 0) { // does the class use the namespace prefix?
    return; // no, move to the next registered autoloader
  }
  $relative_class_name = substr($class, $len);
  // replace the namespace prefix with the base directory, replace namespace
  // separators with directory separators in the relative class name, append
  // with .php
  $file = $base_dir . str_replace('\\', '/', $relative_class_name) . '.php';
  if (file_exists($file)) {
    require $file;
  }
});
function init() {
  Settings::getInstance();
  Ajax::getInstance();
  Install::getInstance();
  Hooks::getInstance();
}
add_action('plugins_loaded', 'YayCommerceSettings\\init');

