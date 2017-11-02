<?php
  $query = new WP_Query(array("post_type"=>"page", "orderby"=>"menu_order", "order"=>"ASC","posts_per_page" => '-1'));
get_header(); 
  while($query->have_posts()){
    $query->the_post();
    get_template_part("post", $query->get_post_format());
  }
  get_footer();
  return;
?>
