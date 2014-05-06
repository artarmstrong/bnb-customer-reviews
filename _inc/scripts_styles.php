<?php

/*-------------------------------------------
	Scripts / Styles
---------------------------------------------*/

add_action('admin_init','bcr_load_scripts_styles');
function bcr_load_scripts_styles() {

  // Globals
  global $pagenow, $typenow;

  // Check if we have typenow and post
  if (empty($typenow) && !empty($_GET['post'])) {
    $post = get_post($_GET['post']);
    $typenow = $post->post_type;
  }

  // Check pagenow and custom post type
  if (is_admin() && ($pagenow=='post-new.php' || $pagenow=='post.php') && $typenow=="bnb-review") {
    wp_enqueue_script('jquery');
    wp_enqueue_script('jquery-ui-datepicker');
    wp_enqueue_script('bcr_custom_js_docready', plugins_url( '/_js/jquery.docready.js', dirname(__FILE__) ), array('jquery'));
    wp_enqueue_style('jquery-style', '//code.jquery.com/ui/1.10.4/themes/smoothness/jquery-ui.css');
  }

}

add_action( 'wp_enqueue_scripts', 'bcr_public_scripts_styles' );
function bcr_public_scripts_styles() {
  wp_enqueue_script('bcr_custom_js', plugins_url( '/_js/jquery.public.js', dirname(__FILE__) ), array('jquery'));
	wp_enqueue_style('bcr_custom_css', plugins_url( '/_css/custom.css', dirname(__FILE__) ));
}
