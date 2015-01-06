<?php
/**
 * Page Break Editor Button
 *
 * Adds Page Break Button to Wordpress editor
 * For easy insertion of Page Break <!--nextpage--> Tag in your Blog Posts.
 *
 * @link              http://espreson.net/
 * @since             1.0.0
 * @package           Page_Break
 *
 * @wordpress-plugin
 * Plugin Name:       Page Break
 * Plugin URI:        http://espreson.net/
 * Description:       Adds Page Break Button to Wordpress editor For easy insertion of Page Break "<!--nextpage" Tag in your Blog Posts.
 * Version:           1.0.0
 * Author:            Espreson Media
 * Author URI:        http://espreson.net/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 */
if ( ! defined( 'WPINC' ) ) {
    die;
}

/** Loads the 'page-break' class file. */
require_once( dirname( __FILE__ ) . '/class-page-break.php' );

/**
 * Creates an instance of the 'page-break' class
 * and calls its initialization method.
 *
 * @since    1.0.0
 */
function page_break_run() {

    $page_break = new page_break();
    $page_break->init();

}
page_break_run();
