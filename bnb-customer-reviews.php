<?php

/**
 * Plugin Name: BnB Customer Reviews
 * Plugin URI: http://avelient.co
 * Description: Plugin for displaying and saving information about multiple customer reviews.
 * Version: 1.0
 * Author: Art Armstrong
 * Author URI: http://artarmstrong.com
 * Text Domain: bnb-customer-reviews
 * License: GPL2
 */

 /*  Copyright 2013  Art Armstrong  (email : me@artarmstrong.com)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as
    published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

//error_reporting(E_ALL);
//ini_set('display_errors', '1');

/*-------------------------------------------
	Global Variables
---------------------------------------------*/
global $bcr_db_version;
$bcr_db_version = "1.0";

/*-------------------------------------------
	Includes
---------------------------------------------*/
include( plugin_dir_path( __FILE__ ) . '_inc/activate_deactivate.php');
include( plugin_dir_path( __FILE__ ) . '_inc/scripts_styles.php');
include( plugin_dir_path( __FILE__ ) . '_inc/custom-post-type.php');
include( plugin_dir_path( __FILE__ ) . '_inc/taxonomies.php');
include( plugin_dir_path( __FILE__ ) . '_inc/meta-box.php');
include( plugin_dir_path( __FILE__ ) . '_inc/shortcodes.php');
