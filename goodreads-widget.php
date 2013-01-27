<?php
/*
* Plugin Name: Goodreads Widget
* Version: 0.1
* Plugin URI: http://themullers.org/mike
* Description: Displays information about the blogger's current reading activities from goodreads.com
* Author: Michael Muller
* Author URI: http://themullers.org/mike
*/
class Goodreads_Widget extends WP_Widget {

    public function __construct() {
    
        parent::__construct(
            'goodreads_widget', // Base ID
            'Goodreads Widget', // Name
            array( 'description' => __( 'Goodreads Widget', 'text_domain' ),) // Args
        );
        add_action('wp_head', array(&$this, "serveHeader"));
        add_action('wp_enqueue_scripts', array(&$this, "initScripts"));
    }

    public function form( $instance ) {
        // outputs the options form on admin
    }

    public function update( $new_instance, $old_instance ) {
        // processes widget options to be saved
    }
    
    public function widget( $args, $instance ) {

        // this defines the before_widget and after_widget variables
        extract($args);
        
        echo $before_widget;
        echo "<div class='goodreads-widget'>";
        echo "<div class='goodreads-logo'>&nbsp;</div>";
        echo "<div id='goodreads-content' class='goodreads-content'>";

              
        echo "</div>";
        echo "<div class='goodreads-footer'>&nbsp;</div>";
        echo "</div>";
        echo $after_widget;
    }

    function serveHeader() {
        $style = plugins_url(plugin_basename(dirname(__FILE__))) . '/style.css';
        echo <<<EOT
<link rel='stylesheet' type='text/css' media='all' href='$style'>
EOT;
    }

    function initScripts() {
        if (!is_admin()) {
            wp_enqueue_script('jquery');
        }
        wp_enqueue_script('goodreads-widget-script', plugins_url('goodreads-widget.js', __File__), array('jquery'));
    }
}

add_action( 'widgets_init', create_function( '', 'register_widget( "goodreads_widget" );' ) );

?>
