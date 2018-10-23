<?php

/**
 * Function describe for Bulk Blog
 * 
 * @package bulk_blog
 */
function bulk_blog_enqueue_styles() {
	/* bulk-stylesheet <- Handle in parent theme */
	wp_enqueue_style( 'bulk-stylesheet', get_template_directory_uri() . '/style.css', array( 'bootstrap' ) );
	wp_enqueue_style( 'bulk-blog-style', get_stylesheet_uri(), array( 'bulk-stylesheet' ) );
	wp_register_style( 'icon', 'https://use.fontawesome.com/releases/v5.0.13/css/all.css', 'all' );
  wp_enqueue_style( 'icon' );
  wp_register_style( 'slider-same-post', 'https://cdnjs.cloudflare.com/ajax/libs/bxslider/4.2.5/jquery.bxslider.css', 'all' );
  wp_enqueue_style( 'slider-same-post' );
}

add_action( 'wp_enqueue_scripts', 'bulk_blog_enqueue_styles' );


function hocwp_load_theme_style_and_script() {

  
  wp_enqueue_script('jquery112', 'https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js');
    wp_enqueue_script('slider-same-post-bx','https://cdnjs.cloudflare.com/ajax/libs/bxslider/4.2.5/jquery.bxslider.min.js');
    wp_enqueue_script('slider', get_stylesheet_directory_uri() . '/js/slider.js');
    // wp_enqueue_script('ajaxx', get_stylesheet_directory_uri() . '/js/nameofjsfile.js');

}
add_action('wp_enqueue_scripts', 'hocwp_load_theme_style_and_script',12);



/**
 * Remove parent footer credits
 */
function bulk_blog_remove_parent_footer() {
	remove_action( 'bulk_generate_footer', 'bulk_generate_construct_footer' );
}

add_action( 'init', 'bulk_blog_remove_parent_footer' );

/**
 * Build footer
 */
add_action( 'bulk_generate_footer', 'bulk_blog_generate_construct_footer' );

function bulk_blog_generate_construct_footer() {
	?>
	<p class="footer-credits-text text-center">
		<?php
		/* translators: %s: link to https://wordpress.org/ */
		printf( esc_html__( 'Proudly powered by %s', 'bulk-blog' ), '<a href="' . esc_url( __( 'https://wordpress.org/', 'bulk-blog' ) ) . '">WordPress</a>' );
		?>
		<span class="sep"> | </span>
		<?php
		/* translators: %1$s: link to theme page */
		printf( esc_html__( 'Theme: %1$s', 'bulk-blog' ), '<a href="https://themes4wp.com/theme/bulk-blog/">Bulk Blog</a>' );
		?>
	</p> 
	<?php
}

add_action( 'after_setup_theme', 'bulk_blog_setup', 99 );

/**
 * Global functions
 */
function bulk_blog_setup() {

	// Recommend plugins removal - no needed for this child theme
	add_theme_support( 'recommend-plugins', array() );
}

add_action( 'after_setup_theme', 'bulk_blog_header_image' );

/**
 * New header image
 */
function bulk_blog_header_image() {
  add_theme_support( 'custom-header', apply_filters( 'bulk_setup_args', array(
      'default-image'      => get_stylesheet_directory_uri( ) . '/img/header.jpg',
			'width'              => 2000,
			'height'             => 1200,
			'flex-height'        => true,
			'video'              => false,
  ) ) );
}


add_action( 'bulk_after_header_image_title', 'bulk_blog_generate_arrow' );
add_action( 'bulk_after_post_meta', 'bulk_blog_generate_arrow' );
add_action( 'bulk_after_page_title', 'bulk_blog_generate_arrow' );

/**
 * Build scroll to content arrow
 */
function bulk_blog_generate_arrow() {
	?>
	<div id="header-image-arrow">
		<a href="#bulk-content"><span></span></a>
	</div>
	<?php
}

/**
 * Remove unused customizer sections
 */
function bulk_blog_customize_register() {     
  global $wp_customize;
  $wp_customize->remove_section( 'customizer-plugin-notice-section' );
  $wp_customize->remove_section( 'theme_demo_content' );  
} 

add_action( 'customize_register', 'bulk_blog_customize_register', 11 );

/**
 * Remove unused tabs
 */
add_action( 'admin_init', 'bulk_blog_remove_action');
function bulk_blog_remove_action() {
     remove_action( 'bulk_recommended_title', 'bulk_recommended_title_construct' );
     remove_action( 'bulk_import_title', 'bulk_recommended_import_construct' );
}

/**
 * Remove parent theme function
 */
function bulk_get_actions_required() {
	// Not needed for this child theme	
};


// Creating a check-box--
// ----------------------
// ----------------------
function sm_custom_meta() {
    add_meta_box( 'sm_meta', __( 'Featured Posts', 'sm-textdomain' ), 'sm_meta_callback', 'post' );
}
function sm_meta_callback( $post ) {
    $featured = get_post_meta( $post->ID );
    ?>
 
  <p>
    <div class="sm-row-content">
        <label for="meta-checkbox">
            <input type="checkbox" name="meta-checkbox" id="meta-checkbox" value="yes" <?php if ( isset ( $featured['meta-checkbox'] ) ) checked( $featured['meta-checkbox'][0], 'yes' ); ?> />
            <?php _e( 'Featured this post', 'sm-textdomain' )?>
        </label>
        
    </div>
</p>
 
    <?php
}
add_action( 'add_meta_boxes', 'sm_custom_meta' );



/**
 * Saves the custom meta input
 */
function sm_meta_save( $post_id ) {
 
    // Checks save status
    $is_autosave = wp_is_post_autosave( $post_id );
    $is_revision = wp_is_post_revision( $post_id );
    $is_valid_nonce = ( isset( $_POST[ 'sm_nonce' ] ) && wp_verify_nonce( $_POST[ 'sm_nonce' ], basename( __FILE__ ) ) ) ? 'true' : 'false';
 
    // Exits script depending on save status
    if ( $is_autosave || $is_revision || !$is_valid_nonce ) {
        return;
    }
 
 // Checks for input and saves
if( isset( $_POST[ 'meta-checkbox' ] ) ) {
    update_post_meta( $post_id, 'meta-checkbox', 'yes' );
} else {
    update_post_meta( $post_id, 'meta-checkbox', '' );
}
 
}
add_action( 'save_post', 'sm_meta_save' );


// shortcode show tab----
// --------------------
function create_shortcode_tab() {
 ob_start();
 ?>
 <div class="tab-box">
  <div class="tab">
    <button class="tablinks" onclick="openCity(event, 'London')" id="defaultOpen">Nổi bật</button>
    <button class="tablinks" onclick="openCity(event, 'Paris')">Xem nhiều nhất</button>
  </div>

  <div id="London" class="tabcontent">
    <?php echo do_shortcode('[featured]'); ?> 
  </div>

  <div id="Paris" class="tabcontent">
    <h3>Paris</h3>
    <p>Paris is the capital of France.</p> 
  </div>
</div>

<script>
function openCity(evt, cityName) {
    var i, tabcontent, tablinks;
    tabcontent = document.getElementsByClassName("tabcontent");
    for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
    }
    tablinks = document.getElementsByClassName("tablinks");
    for (i = 0; i < tablinks.length; i++) {
        tablinks[i].className = tablinks[i].className.replace(" active", "");
    }
    document.getElementById(cityName).style.display = "block";
    evt.currentTarget.className += " active";
}

// Get the element with id="defaultOpen" and click on it
document.getElementById("defaultOpen").click();
</script>
<?php  $tab = ob_get_contents();
  ob_end_clean();
 
        return $tab;
}
add_shortcode('tab', 'create_shortcode_tab');


function create_shortcode_featured() {
 ob_start();
 ?>
<?php
  $args = array(
        'posts_per_page' => 5,
        'meta_key' => 'meta-checkbox',
        'meta_value' => 'yes'
    );
    $featured = new WP_Query($args);
 
if ($featured->have_posts()): while($featured->have_posts()): $featured->the_post(); ?>

<div class="row art-p">
  <div class="col-md-5" style="margin-top: 10px;">
    <?php if (has_post_thumbnail()) : ?>
      <figure> <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail(); ?></a> </figure>
    <?php endif; ?>
  </div>
  <div class="col-md-7 p0">
    <h4><a href="<?php the_permalink(); ?>"> <?php the_title(); ?></a></h4>
    <p class="details"><?php echo get_the_date('F j, Y'); ?>  <?php the_category(', '); ?></p>
  </div>
</div>

<?php
endwhile; else:
endif;
?>
<?php  $featured = ob_get_contents();
  ob_end_clean();
 
        return $featured;
}
add_shortcode('featured', 'create_shortcode_featured');

/**
 * Filter the except length to 20 words.
 *
 * @param int $length Excerpt length.
 * @return int (Maybe) modified excerpt length.
 */
function wpdocs_custom_excerpt_length( $length ) {
    return 20;
}
add_filter( 'excerpt_length', 'wpdocs_custom_excerpt_length', 999 );

function show_samepost(){
  ?>
  <div class="bxslider">

    <?php          $related = get_posts( 
      array( 
        'category__in' => wp_get_post_categories( $post->ID ), 
        'numberposts'  => 5, 
        'post__not_in' => array( $post->ID ) 
      ) 
    );

    if( $related ) { 
      foreach( $related as $post ) {
        setup_postdata($post); ?>

        <div>
          <div class="post_slder khongnen">
            <div class="hinh_slider">
              <?php if ( has_post_thumbnail($post['ID']) ) : ?>                               
                <?php echo get_the_post_thumbnail( $post['ID'], 'thumbnail' ); ?>
                
              <?php else : ?>
                gjfjf
                <img src="http://placehold.it/600x450">                                                
              <?php endif; ?>
            </div>
            <div class="meta_p">
              <div class="ngaythang_p">
                <img src="<?php echo get_stylesheet_directory_uri();?>/assets/images/dongho.png">
                <?php echo get_the_date();?>
              </div>
              <div class="catt_p">
                <img src="<?php echo get_stylesheet_directory_uri();?>/assets/images/thumuc.png">
                <?php the_category(); ?>
              </div>

            </div>
            <div class="td_p1">
              <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
            </div>
          </div>
        </div>

        <?php      }
        wp_reset_postdata();
      } ?>
      </div>


<?php
}


function ajax_search_enqueues() {
    if ( is_search() ) {
      wp_enqueue_script( 'ajax-search', get_stylesheet_directory_uri() . '/js/ajax-search.js', array( 'jquery' ), '1.0.0', true );
        wp_localize_script( 'ajax-search', 'myAjax', array( 'ajaxurl' => admin_url( 'admin-ajax.php' ) ) );

      wp_enqueue_style( 'ajax-search', get_stylesheet_directory_uri() . '/css/ajax-search.css' );
    }
}

add_action( 'wp_enqueue_scripts', 'ajax_search_enqueues' );




// add the ajax fetch js
add_action( 'wp_footer', 'ajax_fetch' );
function ajax_fetch() {
?>
<script type="text/javascript">
function fetch(){

    jQuery.ajax({
        url: '<?php echo admin_url('admin-ajax.php'); ?>',
        type: 'post',
        data: { action: 'data_fetch', keyword: jQuery('#s').val() },
        success: function(data) {
            jQuery('#datafetch').html( data );
        }
    });

}
</script>

<?php
}

// the ajax function
add_action('wp_ajax_data_fetch' , 'data_fetch');
add_action('wp_ajax_nopriv_data_fetch','data_fetch');
function data_fetch(){

    $the_query = new WP_Query( array( 'posts_per_page' => -1, 's' => esc_attr( $_POST['keyword'] ), 'post_type' => 'post' ) );
    if( $the_query->have_posts() ) :
        while( $the_query->have_posts() ): $the_query->the_post(); ?>

            <h4><a href="<?php echo esc_url( post_permalink() ); ?>"><?php the_title();?></a></h4>

        <?php endwhile;
        wp_reset_postdata();  
    endif;

    die();
}

//function show header box
function dd_box($p1,$p2,$p3,$p4,$p5){
  ?>
  <div class="row">
      <div class="col-md-6 box bto">
        <div class="imgp">
          <img class="zoom" src="https://znews-photo-td.zadn.vn/w860/Uploaded/ngtmns/2016_12_12/6.jpg" width="100%;">
        </div>
        <div class="td-to"><?php echo get_the_title( $p1 ); ?></div>
      </div>
      <div class="col-md-6 bto2">
        
          
          <div class="box-nho">
            <div class="imgp">
              <img class="zoom" src="https://znews-photo-td.zadn.vn/w860/Uploaded/ngtmns/2016_12_12/6.jpg" width="100%;">
            </div>
            <div class="td"><?php echo get_the_title( $p2 ); ?></div>
          </div>
          
          <div class="box-nho">
            <div class="imgp">
              <img class="zoom" src="https://znews-photo-td.zadn.vn/w860/Uploaded/ngtmns/2016_12_12/6.jpg" width="100%;">
            </div>
            <div class="td"><?php echo get_the_title( $p3 ); ?></div>
          </div>
          <div class="box-nho">
            <div class="imgp">
              <img class="zoom" src="https://znews-photo-td.zadn.vn/w860/Uploaded/ngtmns/2016_12_12/6.jpg" width="100%;">
            </div>
            <div class="td"><?php echo get_the_title( $p4 ); ?></div>
          </div>
          <div class="box-nho">
            <div class="imgp">
              <img class="zoom" src="https://znews-photo-td.zadn.vn/w860/Uploaded/ngtmns/2016_12_12/6.jpg" width="100%;">
            </div>
            <div class="td"><?php echo get_the_title( $p5 ); ?></div>
          </div>
        
      </div>
    </div>



<?php
}