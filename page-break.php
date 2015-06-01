<?php
/**
 * Page Break Editor Button
 *
 * Adds Page Break Button to Wordpress editor
 * For easy insertion of Page Break <!--nextpage--> Tag in your Blog Posts.
 *
 * @link              http://espreson.net/
 * @since             1.1.0
 * @package           Page_Break
 *
 * @wordpress-plugin
 * Plugin Name:       Page Break
 * Plugin URI:        http://espreson.net/
 * Description:       Adds Page Break Button to Wordpress editor For easy insertion of Page Break "<!--nextpage" Tag in your Blog Posts.
 * Version:           1.1.0
 * Author:            Espreson Media
 * Author URI:        http://espreson.net/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 */
if (!defined('WPINC')) {
    die;
}

/** Loads the 'page-break' class file. */
require_once(dirname(__FILE__) . '/class-page-break.php');

/**
 * Creates an instance of the 'page-break' class
 * and calls its initialization method.
 *
 * @since    1.0.0
 */
function page_break_run()
{

    $page_break = new page_break();
    $page_break->init();

}

page_break_run();

//Add option
add_action('admin_menu', 'page_break_plugin_settings');

function page_break_plugin_settings()
{

    add_menu_page('Page Break Settings', 'Page Break Settings', 'administrator', 'page_break_settings', 'page_break_display_settings');

}

function page_break_display_settings()
{


    $pagin_title = (get_option('pagin_title') != '') ? get_option('pagin_title') : 'Pages';

    $pagin_color = (get_option('pagin_color') != '') ? get_option('pagin_color') : '#000000';


    $html = '</pre>
            <div class="wrap"><form action="options.php" method="post" name="options">
			<h2>Page Break Settings</h2>
			' . wp_nonce_field('update-options') . '
			<table class="form-table" width="100%" cellpadding="10">
			<tbody>
    			<tr>
					<td scope="row" align="left">
					 <label>Enter Name of your Pagination</label><input type="text" name="pagin_title" value="' . $pagin_title . '" /></td>
				</tr>
				<tr>
					<td scope="row" align="left">
					 <label>Set Current Pagination Color (#hex code)</label><input type="text" name="pagin_color" value="' . $pagin_color . '" /></td>
				</tr>
			</tbody>
			</table>
	        <input type="hidden" name="action" value="update" />
			<input type="hidden" name="page_options" value="pagin_title,pagin_color" />
			<input type="submit" name="Submit" value="Update" /></form></div>
			<pre>';
    echo $html;
}

function page_links($args = array())
{
    $defaults = array(
        'before' => '<ul class="page-break-custom">',
        'after' => '</ul>',
        'link_before' => '',
        'next_or_number' => 'number',
        'link_after' => '',
        'pagelink' => '%',
        'echo' => 1,
        'pages' => '<li class="pages">' . __(get_option('pagin_title'), 'pagebreak') . ':</li>',
        'current_first' => '<li class="current"><a style="background-color: ' . esc_attr(get_option('pagin_color')) . ' !important;" href="">',
        'current_last' => '</a></li>',
    );

    $r = wp_parse_args($args, $defaults);
    $r = apply_filters('wp_link_pages_args', $r);
    extract($r, EXTR_SKIP);

    global $page, $numpages, $multipage, $more, $pagenow;


    if (!$multipage) {
        return;
    }

    $output = $before;

    print $output . $pages;

    for ($i = 1; $i < ($numpages + 1); $i++) {
        $j = str_replace('%', $i, $pagelink);
        $output .= ' ';

        if ($i != $page || (!$more && 1 == $page)) {
            $output .= "<li>";
            $output .= _wp_link_page($i) . "{$link_before}{$j}{$link_after}</a>";
            $output .= "</li>";
        } else {
            $output .= "{$current_first}{$link_before}{$j}{$link_after}{$current_last}";
        }
    }

    print $output . $after;


}

add_filter('wp_link_pages', 'page_links');

