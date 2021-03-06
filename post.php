
<?php
  $pane_type = get_field("pane_type"); 
  $hide_default_title = get_field("hide_default_title");
  $id=get_post()->post_name;
  $paneclass=get_field("bg_color");
  switch ($pane_type) {
    case 'text':         
?>


<section class="<?php echo $paneclass; ?>" id="<?php echo $id; ?>">
  <div class="container">
    <div class="row">
      <div class="section-col mx-auto">
        <?php $hide_default_title != TRUE ? the_title('<h2 class="section-heading text-center">', '</h2>') : ''; ?>
        <?php edit_post_link(); ?>
        <p class="text-faded">
          <?php the_content(); ?>
        </p>
      </div>
    </div>
  </div>
</section>


<?php
break;
case 'banner':
// Banner html
?>


<header class="masthead <?php echo $paneclass; ?>"  style="<?php echo get_field("banner_bg") ? "background-image: url('" . get_field("banner_bg") ."');": ''?>" id="<?php echo $id; ?>">
  <div class="header-content">
    <div class="header-content-inner">
      <?php edit_post_link(); ?>
      <?php
        the_content(); 
      ?>
      <a class="btn btn-<?php echo get_field('bg_color') != 'bg-primary' ? 'primaryy' : 'default'; ?> btn-xl js-scroll-trigger btn_tegevus" href="<?php echo get_field('action_link_url') ? the_field('action_link_url') : '#'; ?>"><?php echo get_field('banner_btn_txt') ? the_field('banner_btn_txt') : 'Lisa nupu tekst'; ?></a>
    </div>
  </div>
</header>


<?php
break;
case 'widget1':
?>


<section class="<?php echo $paneclass; ?>" id="<?php echo $id; ?>">
  <div class="container">
    <div class="row">
      <div class="mx-auto section-col">
        <?php if ( is_active_sidebar( 'widget1' ) ) : ?>
          <div id="widget1" class="widget-area">
            <?php dynamic_sidebar( 'widget1' ); ?>
          </div>
        <?php endif; ?>
      </div>
    </div>
  </div>
</section>


<?php
break;
case 'map':
  // Map html
  $location = get_field('location');

  if( !empty($location) ):
?>


  <section class="<?php echo $paneclass; ?> map-container" id="<?php echo $id; ?>">
    <div class="container">
      <div class="row">
        <div class="mx-auto section-col">
          <?php $hide_default_title != TRUE ? the_title('<h2 class="section-heading text-center">', '</h2>') : ''; ?>
          <?php edit_post_link(); ?>
        </div>
      </div>
    </div>
    <div class="acf-map">
      <div class="marker" data-lat="<?php echo $location['lat']; ?>" data-lng="<?php echo $location['lng']; ?>"></div>
    </div>
  </section>


<?php endif;
break;
} 
?>
