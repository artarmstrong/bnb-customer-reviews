<?php

/*-------------------------------------------
	Custom Post Type
---------------------------------------------*/

function bcr_create_post_type() {

  // Labels
  $labels = array(
    "name"               => "Reviews",
    "singular_name"      => "Customer Review",
    "add_new"            => "Add New",
    "add_new_item"       => "Add New Review",
    "edit_item"          => "Edit Customer Review",
    "new_item"           => "New Customer Review",
    "all_items"          => "View All",
    "view_item"          => "View Reviews",
    "search_items"       => "Search Reviews",
    "not_found"          => "No items found",
    "not_found_in_trash" => "No items found in Trash",
    "parent_item_colon"  => "",
    "menu_name"          => "Reviews"
  );

  // Args
  $args = array(
    "labels"             => $labels,
    "public"             => true,
    "publicly_queryable" => true,
    "show_ui"            => true,
    "show_in_menu"       => true,
    "query_var"          => true,
    "rewrite"            => array( "slug" => "bnb-review" ),
    "capability_type"    => "post",
    "has_archive"        => true,
    "hierarchical"       => false,
    "menu_position"      => null,
    "supports"           => array( "title", "editor" ),
    //"taxonomies"         => array( "category" )
  );

  // Register
  register_post_type( "bnb-review", $args );

}
add_action( 'init', 'bcr_create_post_type' );