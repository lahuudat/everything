<?php get_header(); ?>
<?php get_template_part( 'template-parts/template-part', 'content' ); ?>
<!-- start content container -->
<div class="dd-box1">
		<?php dd_box(25,25,25,25,25); ?>
	</div>
<div class="row">

    <div class="col-md-<?php bulk_main_content_width_columns(); ?>">

		<?php
		$count= 1;
		if ( have_posts() ) :

			while ( have_posts() ) : the_post();
				if($count %2 ==1):

				get_template_part( 'content', get_post_format() );

				else:
					get_template_part( 'content', 'second' );

				 endif;	
			    $count++;
				
			endwhile;

			the_posts_pagination();

		else :

			get_template_part( 'content', 'none' );

		endif;
		?>

	</div>

	<?php get_sidebar( 'right' ); ?>

</div>

<?php echo get_the_title( 25 ); ?>
<?php get_post_meta( 25 ); ?>
<?php echo get_the_date('j F Y', get_the_ID(25)); ?>
<?php echo get_the_post_thumbnail_url(27, 'full'); ?>


<!-- end content container -->

<?php get_footer(); ?>
