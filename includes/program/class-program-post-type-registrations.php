<?php
/**
 * Program Post Type
 *
 * @package   Program_Post_Type
 * @author    Devin Price
 * @author    Gary Jones
 * @license   GPL-2.0+
 * @link      http://wptheming.com/program-post-type/
 * @copyright 2011 Devin Price, Gary Jones
 */

/**
 * Register post types and taxonomies.
 *
 * @package Program_Post_Type
 * @author  Devin Price
 * @author  Gary Jones
 */
class Program_Post_Type_Registrations {

	public $post_type;

	public $taxonomies;

	public function init() {
		// Add the portfolio post type and taxonomies
		add_action( 'init', array( $this, 'register' ) );
	}

	/**
	 * Initiate registrations of post type and taxonomies.
	 */
	public function register() {
		global $program_post_type_post_type, $program_post_type_taxonomy_category;

		$program_post_type_post_type = new Program_Post_Type_Post_Type;
		$program_post_type_post_type->register();
		$this->post_type = $program_post_type_post_type->get_post_type();

		$program_post_type_taxonomy_category = new Program_Post_Type_Taxonomy_Category;
		$program_post_type_taxonomy_category->register();
		$this->taxonomies[] = $program_post_type_taxonomy_category->get_taxonomy();
		register_taxonomy_for_object_type(
			$program_post_type_taxonomy_category->get_taxonomy(),
			$program_post_type_post_type->get_post_type()
		);
	}

	/**
	 * Unregister post type and taxonomies registrations.
	 */
	public function unregister() {
		global $program_post_type_post_type, $program_post_type_taxonomy_category;
		$program_post_type_post_type->unregister();
		$this->post_type = null;

		$program_post_type_taxonomy_category->unregister();
		unset( $this->taxonomies[ $program_post_type_taxonomy_category->get_taxonomy() ] );
	}
}

