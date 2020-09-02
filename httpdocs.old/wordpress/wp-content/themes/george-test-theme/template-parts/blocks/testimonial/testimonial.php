<?php
$id = 'testimonial-' . $block['id'];
if( !empty($block['anchor']) ) {
    $id = $block['anchor'];
}

$className = 'testimonial';
if( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}

$text = get_field('starter_testimonial_text');
$author = get_field('starter_testimonial_author');

?>

<div id="<?php echo esc_attr($id); ?>" class="wp-block wp-block-<?php echo esc_attr($className); ?>">
	<blockquote class="testimonial-blockquote">
	    <div class="text"><?php echo $text; ?></div>
	    <div class="author"><?php echo $author; ?></div>
	</blockquote>
</div>