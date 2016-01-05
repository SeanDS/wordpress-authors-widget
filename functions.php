<?php

class author_widget extends WP_Widget {
  public function __construct() {
    parent::__construct(
      'author_widget',
      __('Author List', 'text_domain'),
      array( 'description' => __( 'List of authors with links to their author pages', 'text_domain' ), )
    );
    
    add_action( 'wp_enqueue_scripts', 'scripts' );
  }
  
  public function scripts() {
    // register script
    wp_register_script('authors-url-onchange', plugins_url('authors-url-onchange.js');
  }
  
  public function widget( $args, $instance ) {  
    $title = $instance['title'];
  
    $html = '<aside class="widget clearfix">
<h3 class="widget-title">' . $title . '</h3>';
    
    // create author query
    $author_query = new WP_User_Query(['who' => 'authors', 'orderby' => 'display_name']);
    
    // get list of authors ordered by name
    $authors = $author_query->get_results();

    // fill drop-down list
    if (!empty($authors)) {
      $html .= '<select name="authors" id="authors" class="postform">';
      $html .= '<option value="-1">Select Author</option>';
      
      // loop over authors
      foreach ($authors as $author) {
	// get author name
	$author_name = get_the_author_meta('display_name', $author->ID);
      
        // add list entry
        $html .= '<option class="level-0" value="' . $author->ID . '">' . $author_name . '</option>';
      }
      
      $html .= '</select>';
    } else {
      $html .= '<p>No authors found</p>';
    }
    
    $html .= '</aside>';
    
    // output result
    echo $html;
    wp_enqueue_scripts('authors-url-onchange');
  }

  public function form( $instance ) {
    $title = isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : '';
?>
<p>
  <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label>
  <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
</p>
<?php
  }

  public function update( $new_instance, $old_instance ) {
    // processes widget options to be saved

    $instance = array();
    $instance['title'] = strip_tags($new_instance['title']);

    return $instance;
  }
}

if (! function_exists( 'author_widget_init' )) {
  function author_widget_init() {
    register_widget( 'author_widget' );
  }
}

?>