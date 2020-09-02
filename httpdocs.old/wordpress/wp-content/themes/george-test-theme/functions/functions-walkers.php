<?php
class FC_Menu_Walker extends Walker_Nav_Menu{

	function start_lvl(&$output, $depth = 0, $args = array()){
		$tabs = str_repeat("\t", $depth);
		// If we are about to start the first submenu, we need to give it a sub-menu class
		if ($depth == 0) { //really, level-1 or level-2, because $depth is misleading here (see note above)
			$output .= "\n{$tabs}<ul class=\"sub-menu top-level\">\n";
		} else {
			$output .= "\n{$tabs}<ul class=\"sub-menu depth-".$depth."\">\n";
		}
		return;

	}

	function end_lvl(&$output, $depth = 0, $args = array()){
		if ($depth == 0) { // This is actually the end of the level-1 submenu ($depth is misleading here too!)

			// we don't have anything special for Bootstrap, so we'll just leave an HTML comment for now
			$output .= '<!--.dropdown-->';
		}
		$tabs = str_repeat("\t", $depth);
		$output .= "\n{$tabs}</ul>\n";
		return;
	}

	function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0){
		global $wp_query;
		$indent      = ($depth) ? str_repeat("\t", $depth) : '';
		$class_names = $value = '';
		$classes     = empty($item->classes) ? array() : (array) $item->classes;

		// ACF Fields
		$description = get_post_meta( $item->ID, 'fc_nav_description', true );
		$is_mega_menu = get_post_meta( $item->ID, 'fc_nav_mega_menu', true );
		$hide_title = get_post_meta( $item->ID, 'fc_nav_hide_title', true );

		if ( !empty($description) && 0 != $depth ) {
			$classes[] = 'with-description';
		}

		$class_names = join(' ', apply_filters('nav_menu_css_class', array_filter($classes), $item));
		$class_names = ' class="' . esc_attr($class_names) . '"';
		$output .= $indent . '<li id="menu-item-' . $item->ID . '"' . $value . $class_names . '>';
		$attributes = !empty($item->attr_title) ? ' title="' . esc_attr($item->attr_title) . '"' : '';
		$attributes .= !empty($item->target) ? ' target="' . esc_attr($item->target) . '"' : '';
		$attributes .= !empty($item->xfn) ? ' rel="' . esc_attr($item->xfn) . '"' : '';
		$attributes .= !empty($item->url) ? ' href="' . esc_attr($item->url) . '"' : '';
		
		if ( 'true' == $is_mega_menu  && 0 == $depth ) {
			$attributes .= ' class="fc-mega-dropdown"';
		}

		if ( 'true' == $hide_title  && 0 != $depth ) {
			$attributes .= ' class="no-title"';
		}

		$item_output = "";

		if ( is_object($args) ) {

			$item_output = $args->before;
	
		}
		$item_output .= '<a' . $attributes . '>';

		if ( is_object($args) ) {
			$item_output .= '<span class="link-text">' . $args->link_before . apply_filters('the_title', $item->title, $item->ID) . $args->link_after . '</span>';
			
			if ( !empty($description) && 0 != $depth ) {
				$item_output .= '<span class="description">' . $description . '</span>';
			}

		} else {

			$item_output .= apply_filters('the_title', $item->title, $item->ID);
		
		}

		$item_output .= '</a>';

		if ( is_object($args) ) {
		 
			$item_output .= $args->after;
		
		}
		$output .= apply_filters('walker_nav_menu_start_el', $item_output, $item, $depth, $args);
		return;
	}

	function end_el(&$output, $object, $depth = 0, $args = array()){
		$output .= '</li>';
		return;
	}
	/* Add a 'hasChildren' property to the item
	 * Code from: http://wordpress.org/support/topic/how-do-i-know-if-a-menu-item-has-children-or-is-a-leaf#post-3139633
	 */

	function display_element($element, &$children_elements, $max_depth, $depth = 0, $args, &$output){
		// check whether this item has children, and set $item->hasChildren accordingly
		$element->hasChildren = isset($children_elements[$element->ID]) && !empty($children_elements[$element->ID]);

		// continue with normal behavior
		return parent::display_element($element, $children_elements, $max_depth, $depth, $args, $output);
	}

}