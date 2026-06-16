<?php
/**
 * Custom nav walker for the primary navbar.
 *
 * Outputs bare <a class="nl"> links without <ul>/<li> wrappers.
 * Used with wp_nav_menu( [ 'items_wrap' => '%3$s', 'walker' => new Eraai_Navbar_Walker() ] ).
 *
 * @package era_ai
 */
class Eraai_Navbar_Walker extends Walker_Nav_Menu {

	/**
	 * Start element output — renders a single <a> tag.
	 *
	 * @param string   $output            Passed by reference. Used to append additional content.
	 * @param WP_Post  $data_object       Menu item data object.
	 * @param int      $depth             Depth of menu item.
	 * @param stdClass $args              An object of wp_nav_menu() arguments.
	 * @param int      $current_object_id Optional. ID of the current menu item. Default 0.
	 */
	public function start_el( &$output, $data_object, $depth = 0, $args = null, $current_object_id = 0 ) {
		// Only render top-level items; drop sub-menus.
		if ( $depth > 0 ) {
			return;
		}

		$item    = $data_object;
		$classes = empty( $item->classes ) ? [] : (array) $item->classes;

		$is_active = in_array( 'current-menu-item', $classes, true )
				  || in_array( 'current-menu-ancestor', $classes, true )
				  || in_array( 'current-page-ancestor', $classes, true );

		$atts = [
			'href'  => ! empty( $item->url ) ? $item->url : '#',
			'class' => 'nl' . ( $is_active ? ' active' : '' ),
		];

		if ( $is_active ) {
			$atts['aria-current'] = 'page';
		}
		if ( ! empty( $item->target ) ) {
			$atts['target'] = $item->target;
			if ( '_blank' === $item->target ) {
				$atts['rel'] = 'noopener noreferrer';
			}
		}
		if ( ! empty( $item->xfn ) ) {
			$atts['rel'] = $item->xfn;
		}
		if ( ! empty( $item->attr_title ) ) {
			$atts['title'] = $item->attr_title;
		}

		/** This filter is documented in wp-includes/class-walker-nav-menu.php */
		$atts = apply_filters( 'nav_menu_link_attributes', $atts, $item, $args, $depth );

		$attr_str = '';
		foreach ( $atts as $attr => $value ) {
			if ( '' !== $value ) {
				$attr_str .= ' ' . $attr . '="' . esc_attr( $value ) . '"';
			}
		}

		$title = apply_filters( 'the_title', $item->title, $item->ID );

		/** This filter is documented in wp-includes/class-walker-nav-menu.php */
		$title = apply_filters( 'nav_menu_item_title', $title, $item, $args, $depth );

		$output .= '<a' . $attr_str . '>' . esc_html( $title ) . '</a>';
	}

	// Suppress <ul> wrapper for sub-menus (not used in this design).
	public function start_lvl( &$output, $depth = 0, $args = null ) {}
	public function end_lvl( &$output, $depth = 0, $args = null ) {}

	// No closing tag needed — <a> is self-contained.
	public function end_el( &$output, $data_object, $depth = 0, $args = null ) {}
}
