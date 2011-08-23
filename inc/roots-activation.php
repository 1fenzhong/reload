<?php

// http://foolswisdom.com/wp-activate-theme-actio/

global $pagenow;
if (is_admin() && $pagenow  === 'themes.php' && isset( $_GET['activated'])) {
	
	$wp_rewrite->init();
	$wp_rewrite->flush_rules();	
	
	// don't organize uploads by year and month
	update_option('uploads_use_yearmonth_folders', 0);
	update_option('upload_path', 'assets');
	
	// automatically create menus and set their locations
	// add all pages to the Primary Navigation
	$roots_nav_theme_mod = false;

	if (!has_nav_menu('primary_navigation')) {
		$primary_nav_id = wp_create_nav_menu('Primary Navigation', array('slug' => 'primary_navigation'));
		$roots_nav_theme_mod['primary_navigation'] = $primary_nav_id;
	}	

	if (!has_nav_menu('utility_navigation')) {
		$utility_nav_id = wp_create_nav_menu('Utility Navigation', array('slug' => 'utility_navigation'));
		$roots_nav_theme_mod['utility_navigation'] = $utility_nav_id;
	}

	if ($roots_nav_theme_mod) { 
	  set_theme_mod('nav_menu_locations', $roots_nav_theme_mod);
	}
	
  $primary_nav = wp_get_nav_menu_object('Primary Navigation');

  $primary_nav_term_id = (int) $primary_nav->term_id;
  $menu_items= wp_get_nav_menu_items($primary_nav_term_id);
  if (!$menu_items || empty($menu_items)) {
     $pages = get_pages();
     foreach($pages as $page) {
        $item = array(
           'menu-item-object-id' => $page->ID,
           'menu-item-object' => 'page',
           'menu-item-type' => 'post_type',
           'menu-item-status' => 'publish'
        );
        wp_update_nav_menu_item($primary_nav_term_id, 0, $item);
     }
  }

}

?>