<?php

/*-------------------------------------------
	Custom Meta Box
---------------------------------------------*/
add_action( 'add_meta_boxes', 'bcr_custom_meta_box_add' );
add_action( 'save_post', 'bcr_custom_meta_box_save' );

/* Adds a box to the main column on the Post and Page edit screens */
function bcr_custom_meta_box_add() {

  add_meta_box(
    "bcr_review_information",
    __( "Review Information", "bnb-customer-reviews" ),
    "bcr_custom_meta_general_information",
    "bnb-review",
    "normal",
    "high"
  );

}

/* When the post is saved, saves our custom data */
function bcr_custom_meta_box_save( $post_id ) {

	// Check if its an autosave, if so, do nothing
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )
	  return;

	// Verify this came from the our screen and with proper authorization,
	if ( isset($_POST['bcr_noncename']) && !wp_verify_nonce( $_POST['bcr_noncename'], basename( __FILE__ ) ) )
	  return;

	// Check permissions
	if ( !current_user_can( 'edit_post', $post_id ) )
    return;

	// Review Information
	$bcr_about      = (isset($_POST['bcr_about']) ? $_POST['bcr_about'] : "");
	$bcr_source     = (isset($_POST['bcr_source']) ? $_POST['bcr_source'] : "");
	$bcr_type       = (isset($_POST['bcr_type']) ? $_POST['bcr_type'] : "");
	$bcr_date       = (isset($_POST['bcr_date']) ? $_POST['bcr_date'] : "");
	$bcr_date_hide  = (isset($_POST['bcr_date_hide']) ? $_POST['bcr_date_hide'] : "");
	update_post_meta($post_id, 'bcr_about',     $bcr_about);
	update_post_meta($post_id, 'bcr_source',    $bcr_source);
	update_post_meta($post_id, 'bcr_type',      $bcr_type);
	update_post_meta($post_id, 'bcr_date',      $bcr_date);
	update_post_meta($post_id, 'bcr_date_hide', $bcr_date_hide);

  // Return
	return;

}

/* Prints the box content */
function bcr_custom_meta_general_information( $post ) {

	// Use nonce for verification
	wp_nonce_field( basename( __FILE__ ), 'bcr_noncename' );

	// Fields
	?>
	<div style="float:left;" class="bcr_form">

		<table>
			<tr>
				<td width="100" style="padding: 5px 15px" valign="middle">
					<label>Shortcode</label>
				</td>
				<td colspan="3">
          <span style="color:#6E6E6E">[bnb-reviews id="<?= $post->ID; ?>"]</span>
				</td>
			</tr>
			<tr>
				<td width="100" style="padding: 5px 15px" valign="middle">
					<label>Room Type</label>
				</td>
				<td colspan="3">
				  <?php
				  // Type field
				  $bcr_about = get_post_meta($post->ID, 'bcr_about', true);
				  ?>
				  <input type="text" id="bcr_about" name="bcr_about" style="width:200px;" placeholder="Bed and Breakfast" value="<?= (!empty($bcr_about) ? $bcr_about : ""); ?>" />
				</td>
			</tr>
			<tr>
				<td width="100" style="padding: 5px 15px" valign="middle">
					<label>Source</label>
				</td>
				<td colspan="3">
				  <?php
				  // Source field
				  $bcr_source = get_post_meta($post->ID, 'bcr_source', true);
				  ?>
					<select id="bcr_source" name="bcr_source" style="width:200px;">
					  <option value="BedAndBreakfast" <?= ($bcr_source == "BedAndBreakfast" ? "selected" : ""); ?>>BedAndBreakfast.com</option>
					  <option value="GooglePlus" <?= ($bcr_source == "GooglePlus" ? "selected" : ""); ?>>GooglePlus</option>
					  <option value="TripAdvisor" <?= ($bcr_source == "TripAdvisor" ? "selected" : ""); ?>>TripAdvisor</option>
					  <option value="Yelp" <?= ($bcr_source == "Yelp" ? "selected" : ""); ?>>Yelp</option>
					  <option value="BNBFinder" <?= ($bcr_source == "BNBFinder" ? "selected" : ""); ?>>BNBFinder.com</option>
					  <option value="Expedia" <?= ($bcr_source == "Expedia" ? "selected" : ""); ?>>Expedia</option>
					  <option value="Travelocity" <?= ($bcr_source == "Travelocity" ? "selected" : ""); ?>>Travelocity</option>
					  <option value="Guestbook" <?= ($bcr_source == "Guestbook" ? "selected" : ""); ?>>Guestbook</option>
					</select>
				</td>
			</tr>
			<tr>
				<td width="100" style="padding: 5px 15px" valign="middle">
					<label>Type of Trip</label>
				</td>
				<td colspan="3">
				  <?php
				  // Type field
				  $bcr_type = get_post_meta($post->ID, 'bcr_type', true);
				  ?>
					<select id="bcr_type" name="bcr_type" style="width:200px;">
            <option value="Business" <?= ($bcr_type == "Business" ? "selected" : ""); ?>>Business</option>
            <option value="Couple" <?= ($bcr_type == "Couple" ? "selected" : ""); ?>>Couple</option>
            <option value="Family" <?= ($bcr_type == "Family" ? "selected" : ""); ?>>Family</option>
            <option value="Solo" <?= ($bcr_type == "Solo" ? "selected" : ""); ?>>Solo</option>
            <option value="Everyone" <?= ($bcr_type == "Everyone" ? "selected" : ""); ?>>Everyone</option>
					</select>
				</td>
			</tr>
			<tr>
				<td width="100" style="padding: 5px 15px" valign="middle">
					<label>Date of Review</label>
				</td>
				<td colspan="3">
				  <?php
				  // Type field
				  $bcr_date = get_post_meta($post->ID, 'bcr_date', true);
				  $bcr_date_hide = get_post_meta($post->ID, 'bcr_date_hide', true);
				  ?>
				  <input type="text" id="bcr_date" name="bcr_date" style="width:200px;" value="<?= (!empty($bcr_date) ? $bcr_date : ""); ?>" />
				  <input type="checkbox" id="bcr_date_hide" name="bcr_date_hide" value="true" <?= ($bcr_date_hide == "true" ? "checked" : ""); ?> /> Hide Date?
				</td>
			</tr>
		</table>

	</div>
	<div style="clear:both;"></div>
	<?php
}