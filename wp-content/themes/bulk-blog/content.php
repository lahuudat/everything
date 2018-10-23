<article class="dd-art art1">
    <div class="row">
        <div class="col-md-5">
            <?php if ( has_post_thumbnail() ) : ?>                               
            <a class="featured-thumbnail" href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"> 
                <?php the_post_thumbnail( 'bulk-single' ); ?>
            </a>
            <?php else : ?>
                <img src="http://placehold.it/600x450">                                                
        <?php endif; ?>
        </div>
        <div class="col-md-7">
            <div class=" dd-main-content main-content text-center">
                <h4 class="page-header dd-h4">                                
                    <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" rel="bookmark">
                    <?php the_title(); ?>
                    </a>                            
                </h4>
                <div class="post-meta dd-left-border">
                    <i class="fas fa-user"></i>
                    <?php the_author(); ?>
                    <i class="far fa-clock"></i>
                    <?php echo get_the_date();?> 
                    <i class="fas fa-folder"></i>
                    <?php the_category(); ?>
                </div><!-- .single-entry-summary -->
                <div class="content-inner">                                                      
                    <div class="dd-single-entry single-entry-summary ">
                    <?php the_excerpt(); ?>
                    <?php bulk_entry_footer(); ?>
                    </div><!-- .single-entry-summary -->
                    
                </div>                                                             
            </div>  
        </div>
    </div>
</article>
