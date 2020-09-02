<!DOCTYPE html>
<html <?php language_attributes(); ?>>
	<head profile="http://gmpg.org/xfn/11">
		<meta charset="<?php bloginfo('charset');  ?>">
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<link rel="shortcut" href="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/fc-icon-square-32.png">
		<link rel="icon" sizes="192x192" href="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/fc-icon-square-192.png">
		<link rel="apple-touch-icon" href="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/fc-icon-square-180.png">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<script>var ajaxurl = "<?php echo admin_url('admin-ajax.php'); ?>";</script>
		<meta name="theme-color" content="#000">

		<?php wp_head(); ?>
	</head>
	<body <?php body_class(); ?>>

		<?php
		$header_classes = '';

		if ( is_post_type_archive( 'blog' ) ) {
			$header_classes .= 'extra-class';
		}
		?>
		
		<header class="site-header <?php echo $header_classes; ?>">
			<?php
			wp_nav_menu( array(
				'theme_location'  => 'main-menu',
				'menu'            => '',
				'container'       => 'nav',
				'container_class' => 'main-nav-wrapper',
				'container_id'    => '',
				'menu_class'      => 'menu',
				'menu_id'         => '',
				'echo'            => true,
				'fallback_cb'     => 'wp_page_menu',
				'before'          => '',
				'after'           => '',
				'link_before'     => '',
				'link_after'      => '',
				'items_wrap'      => '<ul id = "%1$s" class = "%2$s">%3$s</ul>',
				'depth'           => 0,
				'walker'          => new FC_Menu_Walker(),
			) ); ?>
		</header>