<?php
/*
  Plugin Name: MoneyPress : Commission Junction Edition (defunct)
  Plugin URI: http://www.cybersprocket.com/products/wpcjproductsearch/
  Description: (defunct) Quickly and easily display products from your Commission Junction affiliate partners on your website. Great for earning affiliate revenue or adding content.
  Version: 1.2.1
  Author: Cyber Sprocket Labs
  Author URI: http://www.cybersprocket.com
  License: GPL3
  
Copyright 2012  Cyber Sprocket Labs (info@cybersprocket.com)

This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation; either version 3 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

// Drive Path Defines 
//
if (defined('MP_CJ_PLUGINDIR') === false) {
    define('MP_CJ_PLUGINDIR', plugin_dir_path(__FILE__));
}
if (defined('MP_CJ_COREDIR') === false) {
    define('MP_CJ_COREDIR', MP_CJ_PLUGINDIR . 'core/');
}
if (defined('MP_CJ_ICONDIR') === false) {
    define('MP_CJ_ICONDIR', MP_CJ_COREDIR . 'images/icons/');
}

// URL Defines
//
if (defined('MP_CJ_PLUGINURL') === false) {
    define('MP_CJ_PLUGINURL', plugins_url('',__FILE__));
}
if (defined('MP_CJ_COREURL') === false) {
    define('MP_CJ_COREURL', MP_CJ_PLUGINURL . '/core/');
}
if (defined('MP_CJ_ICONURL') === false) {
    define('MP_CJ_ICONURL', MP_CJ_COREURL . 'images/icons/');
}

// The relative path from the plugins directory
//
if (defined('MP_CJ_BASENAME') === false) {
    define('MP_CJ_BASENAME', plugin_basename(__FILE__));
}

// Our product prefix
//
if (defined('MP_CJ_PREFIX') === false) {
    define('MP_CJ_PREFIX', 'csl-mp-cj');
}

// Include our needed files
//
include_once(MP_CJ_PLUGINDIR . '/include/config.php'   );
include_once(MP_CJ_COREDIR   . 'csl_helpers.php'       );
include_once(MP_CJ_PLUGINDIR . 'plus.php'       );
if (class_exists('PanhandlerProduct') === false) {
    try {
        require_once('Panhandler/Panhandler.php');
    }
    catch (PanhandlerMissingRequirement $exception) {
        add_action('admin_notices', array($exception, 'getMessage'));
        exit(1);
    }
}
if (class_exists('CommissionJunctionPanhandler') === false) {
    try {
        require_once('Panhandler/Drivers/CommissionJunction.php');
    }
    catch (PanhandlerMissingRequirement $exception) {
        add_action('admin_notices', array($exception, 'getMessage'));
        exit(1);
    }
}




register_activation_hook( __FILE__, 'csl_mpcj_activate');

add_action('wp_print_styles', 'csl_mpcj_user_stylesheet');
add_action('admin_print_styles','csl_mpcj_admin_stylesheet');
add_action('admin_init','csl_mpcj_setup_admin_interface',10);
                         


