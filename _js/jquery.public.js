jQuery(document).ready(function($) {

  // Selectize
  $('.show-more-content').click(function() {

    var post_id = $(this).attr('title');

    if($("#hidden-content-"+post_id).is(':visible')) {
      $("#hidden-content-"+post_id).hide();
      $("#bnb-review-body-more-"+post_id).show();
      $(this).html('More');
    }else{
      $("#hidden-content-"+post_id).show();
      $("#bnb-review-body-more-"+post_id).hide();
      $(this).html('Close');
    }

  });

});