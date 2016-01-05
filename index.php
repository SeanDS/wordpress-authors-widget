<?php 
/*
Plugin Name: Author List Widget
Plugin URI: http://attackllama.com/
Description: Links to authors in a drop-down list widget
Version: 0.9
Author: Sean Leavey
Author URI: http://attackllama.com/
Plugin URI: http://github.com/SeanDS/wordpress-author-widget/
License: GPL2
*/

include('functions.php');

add_action( 'widgets_init', 'author_widget_init');