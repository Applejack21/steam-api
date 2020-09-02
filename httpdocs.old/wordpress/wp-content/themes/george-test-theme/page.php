<?php get_header(); ?>

<?php if( have_posts() ) : while( have_posts() ) : the_post(); ?>
	<?php the_content(); ?>
<?php endwhile; endif; ?>

<div class="page-sections">
	<?php include( locate_template('template-parts/acf-flexible-content/_loop.php') ); ?>
</div>

<?php get_footer(); ?>