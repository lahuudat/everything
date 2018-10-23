<!-- start content container -->
<div class="row">      
	<article class="col-md-<?php bulk_main_content_width_columns(); ?>">
		<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>                         
				<div <?php post_class(); ?>>
					<div class="single-content">
            <div class="single-content-top">
              <h1><?php the_title(); ?></h1>
              <div class="single-meta">
                <?php the_author(); ?> | <?php echo get_the_date();?> | <?php the_category(); ?>
              </div>
            </div> 
						<div class="single-entry-summary">
							<?php the_content(); ?> 
						</div><!-- .single-entry-summary -->
						<?php wp_link_pages(); ?>                                                           
					</div>
					<div class="single-footer row">
						<div class="col-md-4">
							<?php get_template_part( 'template-parts/template-part', 'postauthor' ); ?>
						</div>
						<div class="col-md-8">
							<?php comments_template(); ?> 
						</div>
					</div>
				</div>        
			<?php endwhile; ?>        
		<?php else : ?>            
			<?php get_template_part( 'content', 'none' ); ?>        
		<?php endif; ?>  
	 


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
            	<?php if (has_post_thumbnail()) : ?>
            		<figure> <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail(); ?></a> </figure>
            	<?php else: ?>
            		<figure> <a href="<?php the_permalink(); ?>"><img src="http://placehold.it/600x600"></a> </figure>
            		
            	<?php endif; ?>
            </div>
            <div class="meta_p">
              <div class="ngaythang_p">
                <i class="far fa-clock"></i>
                <?php echo get_the_date();?>
              </div>
              <div class="catt_p">
                <i class="fas fa-folder"></i>
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


	</article> 

	<?php get_sidebar( 'right' ); ?>
</div>
<!-- end content container -->
