<?php


//add_filter('wp_nav_menu_items', 'nav_menu_add_search', 10, 2);
//
//function nav_menu_add_search( $items, $args ) {
//	if ( 'header-right-nav' == $args->theme_location ) {
//		$searchbar = '<li><a class="uk-navbar-toggle uk-search-icon uk-icon" href="#modal-full" uk-search-icon="" uk-toggle=""></a></li>';
//
//		$items .= $searchbar;
//	}
//	return $items;
//}


add_filter('wp_nav_menu_args', 'need_walker_texas_ranger');

function need_walker_texas_ranger( $args ) {

	if($args['theme_location'] == 'header-nav'){
		$args['walker'] = new CSS_Menu_Maker_Walker();
	}

	if($args['theme_location'] == 'footer-right-nav'){
		$args['walker'] = new CSS_Menu_Maker_Walker_Footer();
	}
//
	if($args['theme_location'] == 'footer-left-nav'){
		$args['walker'] = new CSS_Menu_Maker_Walker_Footer();
	}
	return $args;
}