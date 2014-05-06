<?php

/*-------------------------------------------
	Taxonomies (if enabled)
---------------------------------------------*/

function bcr_create_taxonomies() {

  // Add new taxonomy, make it hierarchical (like categories)
	$labels = array(
		"name"              => __( "Categories" ),
		"singular_name"     => __( "Category" ),
		"search_items"      => __( "Search Categories" ),
		"all_items"         => __( "All Categories" ),
		"parent_item"       => __( "Parent Category" ),
		"parent_item_colon" => __( "Parent Category:" ),
		"edit_item"         => __( "Edit Category" ),
		"update_item"       => __( "Update Category" ),
		"add_new_item"      => __( "Add New Category" ),
		"new_item_name"     => __( "New Category Name" ),
		"menu_name"         => __( "Categories" ),
	);

	$args = array(
		"hierarchical"      => true,
		"labels"            => $labels,
		"show_ui"           => true,
		"show_admin_column" => true,
		"query_var"         => true,
		"rewrite"           => array( "slug" => "bnb-review-cat" ),
	);

	register_taxonomy( "bnb-review-cat", "bnb-review", $args );
}
add_action( "init", "bcr_create_taxonomies", 0 );