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
    
        $books = array(
            array(
              'title' => 'The Dog Stars',
              'author' => 'Peter Heller',
              'link' => 'http://www.amazon.com/The-Dog-Stars-Peter-Heller/dp/0307959945/ref=sr_1_1?ie=UTF8&qid=1358705752&sr=8-1&keywords=the+dog+stars',
              'img' => 'http://d.gr-assets.com/books/1333577302l/13330761.jpg',
            ),
            array(
              'title' => 'Version Control with Git',
              'author' => 'Jon Loeliger and Matthew McCullough',
              'link' => 'http://www.amazon.com/Version-Control-Git-collaborative-development/dp/1449316387/ref=sr_1_1?ie=UTF8&qid=1358705868&sr=8-1&keywords=version+control+with+git',
              'img' => 'http://akamaicovers.oreilly.com/images/9780596520137/cat.gif',
            ),
        );            
    
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
