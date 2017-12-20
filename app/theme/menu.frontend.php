<?php
/**
 * Created by IntelliJ IDEA.
 * User: online2
 * Date: 30/11/2017
 * Time: 11:15
 */

class CSS_Menu_Maker_Walker extends Walker_Nav_Menu {

	function display_element( $element, &$children_elements, $max_depth, $depth, $args, &$output ) {

		$id_field = $this->db_fields['id'];

		if ( isset( $args[0] ) && is_object( $args[0] ) )
		{
			$args[0]->has_children = ! empty( $children_elements[$element->$id_field] );

		}
		return parent::display_element( $element, $children_elements, $max_depth, $depth, $args, $output );
	}
	function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {

		$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

		$class_names = $value = '';

		$classes   = empty( $item->classes ) ? array() : (array) $item->classes;
		$classes[] = 'menu-item-' . $item->ID;

//		// permet d'activer automatiquement le menu courant et ses sous caterorie correspondant
		if($item->type == "taxonomy"){
			$cat = get_the_category()[0];
			if($cat->category_parent == $item->object_id){
				$classes[] = 'uk-active';
				unset($classes['current-menu-item']);
			}
		}

		/* Add active class */
		if(in_array('current-menu-item', $classes)) {
			$classes[] = 'uk-active';
			unset($classes['current-menu-item']);
		}

		$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args ) );
		$class_names = $class_names ? ' class="uk-menu' . esc_attr( $class_names ) . '"' : '';

		$id = apply_filters( 'nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args );
		$id = $id ? ' id="' . esc_attr( $id ) . '"' : '';

		$output .= $indent . '<li' . $id . $value . $class_names .'>';


		$atts = array();
		$atts['title']  = ! empty( $item->attr_title ) ? $item->attr_title : '';
		$atts['target'] = ! empty( $item->target )     ? $item->target     : '';
		$atts['rel']    = ! empty( $item->xfn )        ? $item->xfn        : '';
		$atts['href']   = ! empty( $item->url ) ? $item->url : '';

		$atts = apply_filters( 'nav_menu_link_attributes', $atts, $item, $args );

		$attributes = '';
		foreach ( $atts as $attr => $value ) {
			if ( ! empty( $value ) ) {
				$value = ( 'href' === $attr ) ? esc_url( $value ) : esc_attr( $value );
				$attributes .= ' ' . $attr . '="' . $value . '"';
			}
		}

		// chercher si le menu a des sous menus
		$children = get_posts(array('post_type' => 'nav_menu_item', 'nopaging' => true, 'numberposts' => 1, 'meta_key' => '_menu_item_menu_item_parent', 'meta_value' => $item->ID));



		if($children){
			$item_output = '<a href="#">';
			$item_output .= apply_filters('the_title', $item->title, $item->ID);
			$item_output .= '<span uk-icon="icon:  triangle-down"></span>';
		}else{
			$item_output = '<a' . $attributes . '>';

			$item_output .= apply_filters('the_title', $item->title, $item->ID);
		}

		$item_output .= '</a>';
//		$item_output .= '</li>';


		$output .= apply_filters('walker_nav_menu_start_el', $item_output, $item, $depth, $args);

	}

	function end_el(&$output, $item, $depth = 0, $args = array()) {
		$output .= "</li>\n";
	}


	function start_lvl( &$output, $depth = 0, $args = array() ) {

		$indent = str_repeat("\t", $depth);
		$output .= "\n$indent<div uk-dropdown='mode: click;'><ul class='uk-nav uk-dropdown-nav'>\n";

	}

	public function end_lvl( &$output, $depth = 0, $args = array() ) {

		$indent = str_repeat("\t", $depth);
		$output .= "\n$indent</ul></div>";


	}

}


class CSS_Menu_Maker_Walker_Footer extends Walker_Nav_Menu {

	function display_element( $element, &$children_elements, $max_depth, $depth, $args, &$output ) {

		$id_field = $this->db_fields['id'];

		if ( isset( $args[0] ) && is_object( $args[0] ) )
		{
			$args[0]->has_children = ! empty( $children_elements[$element->$id_field] );

		}
		return parent::display_element( $element, $children_elements, $max_depth, $depth, $args, $output );
	}
	function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {

		$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

		$class_names = $value = '';

		$classes   = empty( $item->classes ) ? array() : (array) $item->classes;
		$classes[] = 'menu-item-' . $item->ID;

		// permet d'activer automatiquement le menu courant et ses sous caterorie correspondant
//		if($item->type == "taxonomy"){
//			$cat = get_the_category()[0];
//			if($cat->category_parent == $item->object_id){
//				$classes[] = 'uk-active';
//				unset($classes['current-menu-item']);
//			}
//		}

		/* Add active class */
		if(in_array('current-menu-item', $classes)) {
			$classes[] = 'uk-active';
			unset($classes['current-menu-item']);
		}

		$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args ) );
		$class_names = $class_names ? ' class="uk-menu' . esc_attr( $class_names ) . '"' : '';

		$id = apply_filters( 'nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args );
		$id = $id ? ' id="' . esc_attr( $id ) . '"' : '';

		$output .= $indent . '<li' . $id . $value . $class_names .'>';


		$atts = array();
		$atts['title']  = ! empty( $item->attr_title ) ? $item->attr_title : '';
		$atts['target'] = ! empty( $item->target )     ? $item->target     : '';
		$atts['rel']    = ! empty( $item->xfn )        ? $item->xfn        : '';
		$atts['href']   = ! empty( $item->url ) ? $item->url : '';

		$atts = apply_filters( 'nav_menu_link_attributes', $atts, $item, $args );

		$attributes = '';
		foreach ( $atts as $attr => $value ) {
			if ( ! empty( $value ) ) {
				$value = ( 'href' === $attr ) ? esc_url( $value ) : esc_attr( $value );
				$attributes .= ' ' . $attr . '="' . $value . '"';
			}
		}

		// chercher si le menu a des sous menus
//		$children = get_posts(array('post_type' => 'nav_menu_item', 'nopaging' => true, 'numberposts' => 1, 'meta_key' => '_menu_item_menu_item_parent', 'meta_value' => $item->ID));




		$item_output = '<a' . $attributes . '>';

		$item_output .= apply_filters('the_title', $item->title, $item->ID);


		$item_output .= '</a>';
//		$item_output .= '</li>';


		$output .= apply_filters('walker_nav_menu_start_el', $item_output, $item, $depth, $args);

	}

	function end_el(&$output, $item, $depth = 0, $args = array()) {
		$output .= "</li>\n";
	}


	function start_lvl( &$output, $depth = 0, $args = array() ) {

		$indent = str_repeat("\t", $depth);
		$output .= "\n$indent\n";

	}

	public function end_lvl( &$output, $depth = 0, $args = array() ) {

		$indent = str_repeat("\t", $depth);
		$output .= "\n$indent</ul>";


	}

}
