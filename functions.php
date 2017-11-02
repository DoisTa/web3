<?php

// Register Sidebars
function widget1() {

  $args = array(
    'name'          => __( 'Widget 1', 'text_domain' ),
    'id'          => 'widget1',
  );
  register_sidebar( $args );

}

add_action( 'widgets_init', 'widget1' );
add_filter('acf/fields/google_map/api', function ( $api ){
  $api['key'] = 'AIzaSyBOTzyIy2NTtWIc4IyVtOXE13FSzP6Kbpk';

  return $api;

});
add_filter('redirect_post_location', function($location)
{
  global $post;
  if (
  (isset($_POST['publish']) || isset($_POST['save'])) &&
  preg_match("/post=([0-9]*)/", $location, $match) &&
  $post &&
  $post->ID == $match[1] &&
  (isset($_POST['publish']) || $post->post_status == 'publish') && // Publishing draft or updating published post
  $pl = get_permalink($post->ID)
  ) {
    if (isset($_POST['publish'])) {
      // Homepage for new posts only
      $location = home_url();
    } elseif ($ref = wp_get_original_referer()) {
      // Referer for edited posts
      $ref = explode('#', $ref, 2);
      //$location = $ref[0] . '#post-' . $post->ID;
      if ($post->post_type == 'page')
        $location = $ref[0] . '#' . $post->post_name;
      else
        $location = $ref[0] . '#post-' . $post->ID;
    } else {
      // Post page as a last resort
      $location = $pl;
    }
  }
  return $location;
});
if(function_exists("register_field_group"))
{
  register_field_group(array (
    'id' => 'acf_post-data',
    'title' => 'Post data',
    'fields' => array (
      array (
        'key' => 'field_59ba8537c101b',
        'label' => 'Menüü tiitel',
        'name' => 'menu_title',
        'type' => 'text',
        'default_value' => '',
        'placeholder' => '',
        'prepend' => '',
        'append' => '',
        'formatting' => 'html',
        'maxlength' => '',
      ),
      array (
        'key' => 'field_59cd57c2b9202',
        'label' => 'Favicon class',
        'name' => 'favicon_class',
        'type' => 'text',
        'instructions' => 'http://fontawesome.io/icons/ Kui soovid kasutada ikoone',
        'default_value' => '',
        'placeholder' => '',
        'prepend' => '',
        'append' => '',
        'formatting' => 'none',
        'maxlength' => '',
      ),
      array (
        'key' => 'field_59ba90925c64d',
        'label' => 'Paani tüüp',
        'name' => 'pane_type',
        'type' => 'select',
        'choices' => array (
          'text' => 'Tekstileht',
          'banner' => 'Suur (esilehe) banner',
          'map' => 'Kaart',
          'wide' => 'Täislaius',
          'widget1' => 'Widget 1',
        ),
        'default_value' => '',
        'allow_null' => 0,
        'multiple' => 0,
      ),
      array (
        'key' => 'field_59ba84bec101a',
        'label' => 'Taustavärv',
        'name' => 'bg_color',
        'type' => 'radio',
        'required' => 1,
        'conditional_logic' => array (
          'status' => 1,
            'rules' => array (
              array (
                'field' => 'field_59ba90925c64d',
                'operator' => '==',
                'value' => 'text',
              ),
              array (
                'field' => 'field_59ba90925c64d',
                'operator' => '==',
                'value' => 'banner',
              ),
            ),
          'allorany' => 'any',
        ),
        'choices' => array (
          'bg-primary' => 'Oranz',
          'bg-white' => 'Valge',
        ),
        'other_choice' => 0,
        'save_other_choice' => 0,
        'default_value' => 'bg-primary',
        'layout' => 'vertical',
      ),
      array (
        'key' => 'field_59ba91410b3cf',
        'label' => 'Asukoht',
        'name' => 'location',
        'type' => 'google_map',
        'conditional_logic' => array (
          'status' => 1,
          'rules' => array (
            array (
              'field' => 'field_59ba90925c64d',
              'operator' => '==',
              'value' => 'map',
            ),
          ),
          'allorany' => 'all',
        ),
        'center_lat' => '',
        'center_lng' => '',
        'zoom' => '',
        'height' => '',
      ),
      array (
        'key' => 'field_59ba91a1daea0',
        'label' => 'Bänneri pilt',
        'name' => 'banner_bg',
        'type' => 'image',
        'conditional_logic' => array (
          'status' => 1,
          'rules' => array (
            array (
              'field' => 'field_59ba90925c64d',
              'operator' => '==',
              'value' => 'banner',
            ),
          ),
          'allorany' => 'all',
        ),
        'save_format' => 'url',
        'preview_size' => 'full',
        'library' => 'all',
      ),
      array (
        'key' => 'field_59ba91c3daea1',
        'label' => 'Banneri tegevusnupu tekst',
        'name' => 'banner_btn_txt',
        'type' => 'text',
        'conditional_logic' => array (
          'status' => 1,
          'rules' => array (
            array (
              'field' => 'field_59ba90925c64d',
              'operator' => '==',
              'value' => 'banner',
            ),
          ),
          'allorany' => 'all',
        ),
        'default_value' => '',
        'placeholder' => '',
        'prepend' => '',
        'append' => '',
        'formatting' => 'none',
        'maxlength' => 30,
      ),
      array (
        'key' => 'field_59bb93396e744',
        'label' => 'Tegevuse lingi aadress',
        'name' => 'action_link_url',
        'type' => 'text',
        'instructions' => 'Lisa tegevuse aadress näitena #registreeru  või https://minesinna.ee',
        'conditional_logic' => array (
          'status' => 1,
          'rules' => array (
            array (
              'field' => 'field_59ba90925c64d',
              'operator' => '==',
              'value' => 'banner',
            ),
          ),
          'allorany' => 'all',
        ),
        'default_value' => '',
        'placeholder' => '',
        'prepend' => '',
        'append' => '',
        'formatting' => 'html',
        'maxlength' => '',
      ),
      array (
        'key' => 'field_59bcec70984bc',
        'label' => 'Peida paani pealkiri',
        'name' => 'hide_default_title',
        'type' => 'checkbox',
        'instructions' => 'Kui soovid lisada paanile enda pealkirja, siis võimalus peita vaikimisi pealkiri.',
        'choices' => array (
          1 => 'Peida',
        ),
        'default_value' => '',
        'layout' => 'vertical',
      ),
      array (
        'key' => 'field_menutitle',
        'label' => 'Peida men?? pealkiri',
        'name' => 'hide_default_menu_title',
        'type' => 'checkbox',
        'instructions' => 'Kui soovid et paan ei ilmuks navbari',
        'choices' => array (
          1 => 'Peida',
        ),
        'default_value' => '',
        'layout' => 'vertical',
      ),
    ),
    'location' => array (
      array (
        array (
          'param' => 'post_type',
          'operator' => '==',
          'value' => 'page',
          'order_no' => 0,
          'group_no' => 0,
        ),
      ),
    ),
    'options' => array (
      'position' => 'normal',
      'layout' => 'no_box',
      'hide_on_screen' => array (
      ),
    ),
    'menu_order' => 0,
  ));
}
//define( 'ACF_LITE', true );
// Ank konverentsidele
add_action('admin_menu', function (){
  //     remove_menu_page('wpcf7');
  remove_menu_page('tools.php');
  remove_menu_page('edit.php');
  $menu = add_menu_page('Database', 'Päringud', 'edit_pages', 'cf7-data', 'cf7d_custom_submenu_page_callback', 'dashicons-media-default', 0);

  add_action('load-' . $menu, 'cf7d_form_action_callback');
});
function remove_admin_bar_links() {
  global $wp_admin_bar;
  $wp_admin_bar->remove_menu('wp-logo');          // Remove the WordPress logo
  $wp_admin_bar->remove_menu('about');            // Remove the about WordPress link
  $wp_admin_bar->remove_menu('wporg');            // Remove the WordPress.org link
  $wp_admin_bar->remove_menu('documentation');    // Remove the WordPress documentation link
  $wp_admin_bar->remove_menu('support-forums');   // Remove the support forums link
  $wp_admin_bar->remove_menu('feedback');         // Remove the feedback link
#$wp_admin_bar->remove_menu('site-name');        // Remove the site name menu
#    $wp_admin_bar->remove_menu('view-site');        // Remove the view site link
#   $wp_admin_bar->remove_menu('updates');          // Remove the updates link
  $wp_admin_bar->remove_menu('comments');         // Remove the comments link
#   $wp_admin_bar->remove_menu('new-content');      // Remove the content link
  $wp_admin_bar->remove_menu('edit');      // Edit post link
#   $wp_admin_bar->remove_menu('my-account');       // Remove the user details tab
}

function wpdocs_web3_scripts(){

  wp_enqueue_script("jquery", get_template_directory_uri()."/node_modules/jquery/dist/jquery.min.js");
  wp_enqueue_script("jquery-easing", get_template_directory_uri()."/node_modules/jquery-easing/dist/jquery.easing.1.3.umd.min.js");
  wp_enqueue_script("popper", get_template_directory_uri()."/node_modules/popper.js/dist/umd/popper.min.js");
  wp_enqueue_script("popper-utils", get_template_directory_uri()."/node_modules/popper.js/dist/umd/popper-utils.min.js");
  wp_enqueue_script("creativejs", get_template_directory_uri()."/js/creative.min.js");
  wp_enqueue_script("bootstrap", get_template_directory_uri()."/node_modules/bootstrap3/dist/js/bootstrap.min.js");
  wp_enqueue_script("mapjs", get_template_directory_uri()."/js/map.js");
  wp_enqueue_style("style", get_template_directory_uri()."/style.css");
  wp_enqueue_style("creative", get_template_directory_uri()."/css/creative.min.css");
  wp_enqueue_style("bootstrap", get_template_directory_uri()."/node_modules/bootstrap3/dist/css/bootstrap.min.css");
  wp_enqueue_style("font-awesome", get_template_directory_uri()."/node_modules/font-awesome/css/font-awesome.min.css");
}

add_action( 'wp_before_admin_bar_render', 'remove_admin_bar_links' );
add_action( 'wp_enqueue_scripts', 'wpdocs_web3_scripts' );

?>
