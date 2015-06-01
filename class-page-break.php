<?php

class page_break {

    public function init_page_break() {
    
        add_action( 'admin_head', 'add_tinymce' );
                
        function page_break_css() {
            wp_enqueue_style('page_break_css', plugins_url('css/page-break-css.css', __FILE__));
        }

        add_action('admin_enqueue_scripts', 'page_break_css');
				
				function page_break_js() {
					if( ! is_admin() ) {
							
							wp_enqueue_script('page_break_js', plugins_url('js/page-break-js.js', __FILE__), array(), '1.0');
							
							$config_array = array(
								'pagin_title' => get_option('pagin_title'),
								'pagincolor' => get_option('pagin_color')
								);
 
								wp_localize_script('page-break-js', 'setting', $config_array);
						}
        }
        add_action('wp_enqueue_scripts', 'page_break_js');
				
				
				var_dump($config_array);
		
				function page_break_front_css() {
            wp_enqueue_style('page-break-front', plugins_url('css/page-break-front.css', __FILE__));
        }
				add_action('wp_enqueue_scripts', 'page_break_front_css');
    
        //ADDS THE TINYMCE BUTTON
        function add_tinymce() {
            add_filter( "mce_external_plugins", "page_break_add_buttons" );
            add_filter( "mce_buttons", "page_break_register_buttons" );

        }
        
        function page_break_add_buttons( $plugin_array ) {
            $plugin_array['pagebreak'] = plugins_url("js/mce.js" , __file__);
            
            return $plugin_array;
        }
        function page_break_register_buttons( $buttons ) {
            array_push( $buttons, 'pagebreak' );
            return $buttons;
        }
        //end
    }
    
				
    
    
    //INITIALIZING THE BUTTON
    public function init() {
        add_action( 'init', array( $this, 'init_page_break' ) );
    }

}


