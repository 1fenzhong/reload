<?php

// custom post type
add_action( 'init', 'create_post_type' );
function create_post_type() {
  register_post_type( 'dream',
    array(
      'labels' => array(
        'name' => __( '梦想号' ),
        'singular_name' => __( 'Dreams' ),
        'add_new' => __('生产 Dream'),
        'add_new_item' => __('生产 Dream'),
                        ),
      'menu_position' => 5,
      'publicly_queryable' => true,
      'capability_type' => 'post',
      'query_var' => true,
      'public' => true,
      'has_archive' => true,
      'supports' => array('title', 'editor', 'comments', 'revisions'),
      'taxonomies' => array('dream_tag')));
  register_post_type( 'log',
    array(
      'labels' => array(
        'name' => __( 'Logs' ),
        'singular_name' => __( 'Logs' ),
        'add_new' => __('生产 Log'),
        'add_new_item' => __('生产 Log'),
                        ),
      'menu_position' => 5,
      'publicly_queryable' => true,
      'capability_type' => 'post',
      'query_var' => true,
      'public' => true,
      'has_archive' => true,
      'supports' => array('title', 'editor', 'comments', 'revisions', 'post-formats'),
      'taxonomies' => array('log_tag')));
}

// dream tag
register_taxonomy('dream_tag', 'dream', array(
  'label' => 'Dream 标签',
  'singular_label' => 'Dream 标签',
  'public' => true,
  'show_tagcloud' => false,
  'query_var' => true,
  'hierarchical' => false,
  'rewrite' => array(
    'slug' => 'dream/tag',
    'with_front' => 'false'
  ),
));

// log tag
register_taxonomy('log_tag', 'log', array(
  'label' => 'Log 标签',
  'singular_label' => 'Log 标签',
  'public' => true,
  'show_tagcloud' => false,
  'query_var' => true,
  'hierarchical' => false,
  'rewrite' => array(
    'slug' => 'log/tag',
    'with_front' => 'false'
  ),
));

// time format
function human_readable_time() {
  echo human_time_diff(get_the_time('U'), current_time('timestamp'))." 前";
}

// thumbnail
add_image_size( '240', 240, 240, true );

// excerpt length
function shorted_excerpt($charlength) {
  $excerpt = get_the_excerpt();
  $charlength++;
  if(strlen($excerpt)>$charlength) {
    $subex = substr($excerpt,0,$charlength-5);
    $exwords = explode(" ",$subex);
    $excut = -(strlen($exwords[count($exwords)-1]));
    if($excut<0) {
      echo substr($subex,0,$excut);
    } else {
      echo $subex;
    }
  } else {
    echo $excerpt;
  }
}

// always show adminbar
function always_show_adminbar( $wp_admin_bar) {
	if ( !is_user_logged_in() )
        $wp_admin_bar->add_menu( array( 'id' => 'register', 'title' => __( 'Register' ), 'href' => wp_login_url() . '?action=register' ) );
	if ( !is_user_logged_in() )
        $wp_admin_bar->add_menu( array( 'id' => 'login', 'title' => __( 'Log In' ), 'href' => wp_login_url() ) );
        if ( !is_super_admin() )
        $wp_admin_bar->remove_menu('dashboard');
}
add_action( 'admin_bar_menu', 'always_show_adminbar', 1 );
add_filter( 'show_admin_bar', '__return_true' , 1000 );

// remove dashboard widget
function remove_dashboard_widgets() {
	remove_meta_box( 'dashboard_primary', 'dashboard', 'side' );
	remove_meta_box( 'dashboard_secondary', 'dashboard', 'side' );
} 

add_action('wp_dashboard_setup', 'remove_dashboard_widgets' );

?>