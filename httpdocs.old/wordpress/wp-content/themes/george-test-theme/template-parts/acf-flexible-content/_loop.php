<?php
$page_id = get_the_ID();

if ( is_home() ) {
	$page_id = get_option( 'page_for_posts' );
}

if ( have_rows('firecask_sections', $page_id ) ) {
	while ( have_rows('firecask_sections', $page_id) ) {
		the_row();
		$layout = get_row_layout();

		?>
		<section class="section-<?php echo $layout; ?>">
			<?php include( locate_template('template-parts/acf-flexible-content/'.$layout.'.php') ); ?>
		</section>
		<?php
	}
}