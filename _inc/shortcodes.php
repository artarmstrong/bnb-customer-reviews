<?php

/*-------------------------------------------
	Shortcodes
---------------------------------------------*/

// [bnb-reviews]
function bcr_all_func( $atts ) {

  global $post;

  extract( shortcode_atts( array(
		'id' => '',
		'cat' => '',
	), $atts ) );

  // Start our output
  $output = "";
  $output .= "<ul>";

  // Get all review arguments
  if(!empty($id) && is_numeric($id)){
    $args = array( 'post_type' => 'bnb-review', 'posts_per_page' => 1, 'p' => $id );
  }elseif(!empty($cat)){
    $term = term_exists($cat, 'bnb-review-cat');
    if ($term !== 0 && $term !== null) {
      if(is_numeric($term)){
        $args = array(
          'post_type' => 'bnb-review',
          'posts_per_page' => -1,
          'tax_query' => array(
        		array(
        			'taxonomy' => 'bnb-review-cat',
        			'field' => 'term_id',
        			'terms' => $term
        		)
        	)
        );
      }elseif(is_array($term)){
        $args = array(
          'post_type' => 'bnb-review',
          'posts_per_page' => -1,
          'orderby' => 'rand',
          'tax_query' => array(
        		array(
        			'taxonomy' => 'bnb-review-cat',
        			'field' => 'term_id',
        			'terms' => $term['term_id']
        		)
        	)
        );
      }
    }

  }else{
    $args = array( 'post_type' => 'bnb-review', 'posts_per_page' => -1, 'orderby' => 'rand' );
  }

  // Get review posts
  if(is_array($args) && !empty($args))
    $reviews = get_posts( $args );
  else
    $reviews = array();
  foreach($reviews as $review):
  setup_postdata($review);

  // Get fields
  $bcr_about = get_post_meta($review->ID, 'bcr_about', true);
  $bcr_source = get_post_meta($review->ID, 'bcr_source', true);
  $bcr_type = get_post_meta($review->ID, 'bcr_type', true);
  $bcr_date = get_post_meta($review->ID, 'bcr_date', true);
  $bcr_date_hide = get_post_meta($review->ID, 'bcr_date_hide', true);
  $bcr_str_length = 250;
  $bcr_title = get_the_title($review->ID);
  $bcr_link = get_permalink($review->ID);
  $bcr_content = get_the_content();
  $bcr_content_first = "";
  $bcr_content_second = "";
  if(strlen($bcr_content) > $bcr_str_length){
    $bcr_content_split_pos = strpos($bcr_content, " ", $bcr_str_length);
    $bcr_content_first = substr($bcr_content, 0, $bcr_content_split_pos);
    $bcr_content_second = substr($bcr_content, $bcr_content_split_pos+1);
  }

  ob_start();
  ?>

  <li class="bnb-review-item">
    <div itemprop="review" itemscope itemtype="http://schema.org/Review">
      <div class="bnb-review-source">
        <span class="bnb-review-image">
          <img src="<?= plugins_url( '_img', dirname(__FILE__))."/".$bcr_source; ?>.png" width="127px" / >
        </span><br />
        <span class="bnb-review-rating">
          <img src="<?= plugins_url( '_img', dirname(__FILE__))."/five_stars.png"; ?>" height="22px" / >
        </span><br />
        <span class="bnb-review-hidden" itemprop="reviewRating">5</span>
        <span class="bnb-review-type">Trip Type: <?= $bcr_type; ?></span>
      </div>
      <div class="bnb-review-content">
        <span class="bnb-review-title">
          <strong><a href="<?= $bcr_link; ?>"><span itemprop="name"><?= $bcr_title; ?></span></a></strong>
        </span><br />



        <span class="bnb-review-body">
        <span itemprop="reviewBody">
          <?php
          // Check our length
          if(strlen($bcr_content) > $bcr_str_length){
            echo "$bcr_content_first <span id='hidden-content-{$review->ID}' style='display:none;'>$bcr_content_second</span>";
          }else{
            echo $bcr_content;
          }
          ?>
        </span>
        <?php
        if(strlen($bcr_content) > $bcr_str_length){
        echo "<span id=\"bnb-review-body-more-{$review->ID}\">... </span><a class=\"show-more-content\" title=\"{$review->ID}\">More</a>";
        }?>
        </span>

    <div class="bnb-bottom-info">
        <?php
        // Check if date is hidden
        if($bcr_date_hide != "true"):
        ?>
        <span itemprop="about"><?= (!empty($bcr_about) ? $bcr_about : "Bed and Breakfast"); ?></span>
        <span class="bnb-review-date">
          <meta itemprop="datePublished" content="<?= date('Y-m-d', strtotime($bcr_date)); ?>"><?= $bcr_date; ?>
        </span>
        <?php endif; ?>
    </div><!--bnb-bottom-info-->

      </div>
    </div>
  </li>

  <?php
  $output .= ob_get_contents();
  ob_end_clean();
  endforeach;
  wp_reset_postdata();

  // End output
  $output .= "</ul>";

  // Return
  return $output;

}
add_shortcode( 'bnb-reviews', 'bcr_all_func' );

