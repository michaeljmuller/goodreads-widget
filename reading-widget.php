<?php
/*
* Plugin Name: Reading Widget
* Version: 0.1
* Plugin URI: http://themullers.org/mike
* Description: Displays information about the blogger's current reading activities
* Author: Michael Muller
* Author URI: http://themullers.org/mike
*/
class Reading_Widget extends WP_Widget {

    public function __construct() {
    
        parent::__construct(
            'reading_widget', // Base ID
            'Reading Widget', // Name
            array( 'description' => __( 'Reading Widget', 'text_domain' ),) // Args
        );
        add_action('wp_head', array(&$this, "serveHeader"));
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
        echo "<div class='reading-widget'>";
        echo "<div class='reading-logo'>&nbsp;</div>";
        echo "<div class='reading-content'>";

        foreach ($books as $book) {
            echo "<div class='reading-book'>";
            echo "<a href='{$book['link']}' target='_blank'><img class='reading-book-image' src='{$book['img']}' /></a>";
            echo "<div class='reading-title'><a href='{$book['link']}' target='_blank'>{$book['title']}</a></div>";
            echo "<div class='reading-author'>{$book['author']}</div>";
            echo "</div>";
        }
              
        echo "</div>";
        echo "<div class='reading-footer'>&nbsp;</div>";
        echo "</div>";
        echo $after_widget;
    }

    function serveHeader() {
        $style = plugins_url(plugin_basename(dirname(__FILE__))) . '/style.css';
        echo <<<EOT
<link rel='stylesheet' type='text/css' media='all' href='$style'>
EOT;
    }
}

add_action( 'widgets_init', create_function( '', 'register_widget( "reading_widget" );' ) );

?>
