<?php
/**
 * Created by Luke.Lazurite.
 * Date: 12/31/2015
 * Time: 5:42 PM
 */


/**
 * @package QRCode Viewer
 */

/*
Plugin Name: QRCode Viewer
Plugin URI:
Description: To get access to QRCode of a specific post or page in the dashboard.
Version: 0.0.1
Author: XLuke
Author URI: https://blog.xlk.me
License: GPLv2 or later
Text Domain: qrcode-viewer
*/

/*
This program is free software; you can redistribute it and/or
modify it under the terms of the GNU General Public License
as published by the Free Software Foundation; either version 2
of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.

Copyright 2015-2016 XLuke.
*/

if ( !function_exists("add_action")) {
    echo "Hi there! I'm just a plugin, not much I can do when called directly.";
    exit;
}

define("QRCODE_VIEWER_VERSION", "0.0.1");
define("QRCODE_VIEWER_MINIMUM_WP_VERSION", "4.4");
define("QRCODE_VIEWER__PLUGIN_URL", plugin_dir_url(__FILE__));
define("QRCODE_VIEWER__PLUGIN_DIR", plugin_dir_path(__FILE__));

if (!class_exists("QRCodeViewer")) {
    class QRCodeViewer {
        public function __construct() {
            add_action("plugins_loaded", array(&$this, "onPluginLoaded"));
            add_action("admin_enqueue_scripts", array(&$this, "onAdminEnqueueScripts"));
        }

        public static function activate() {

        }

        public static function deactivate() {

        }

        public function onPluginLoaded() {
            load_plugin_textdomain("qrcode-viewer", false, plugin_basename(dirname(__FILE__)) . '/languages');
        }

        public function onAdminEnqueueScripts($hook) {
            if ($hook === "edit.php") {
                wp_register_script("qrcode-viewer", plugins_url("static/script/main.js", __FILE__), array(), "0.0.1", true);
                wp_enqueue_script("qrcode-viewer");
                wp_localize_script("qrcode-viewer", "l10n", array(
                    "qrcode" => __("QRCode", "qrcode-viewer"),
                    "download-qrcode" => __("Download QRCode", "qrcode-viewer")
                ));
            }
        }
    }
}

if (class_exists("QRCodeViewer")) {
    register_activation_hook(__FILE__, array("QRCodeViewer", "activate"));
    register_deactivation_hook(__FILE__, array("QRCodeViewer", "deactivate"));

    $QRCodeViewer = new QRCodeViewer();
}

