<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title><?php bloginfo(); ?></title>
    <?php echo wp_head(); ?>
  </head>
  <body id="page-top" <?php echo body_class() ?>>
    <!-- Navigation -->
    <nav id="mainNav" class="nav navbar-default navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>                        
          </button>
          <!--a class="navbar-brand" href="#"><?bloginfo();?></a-->
        </div>
        <div class="collapse navbar-collapse" id="myNavbar">
          <ul class="nav navbar-nav navbar-right">
            <?php 
              $navquery = new WP_Query(array("post_type"=>"page", "orderby"=>"menu_order", "order"=>"ASC", "posts_per_page" => -1));
              while($navquery->have_posts()) {
                $navquery->the_post();
                if(!get_field("hide_default_menu_title")){
			$fa = get_field("favicon_class") ? ' <i class="' . get_field("favicon_class") . ' fa"></i> ' : '';
			echo '<li class="nav-item"><a class="nav-link js-scroll-trigger" href="#'.get_post()->post_name.'">' . $fa . (get_field("menu_title")?get_field("menu_title"):get_post()->post_title).'</a></li>';
		}
              }
            ?>
          </ul>
        </div>
      </div>
    </nav>
