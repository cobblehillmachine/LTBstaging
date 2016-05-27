<?php
/**
 * @package WordPress
 * @subpackage Eclectic
 */
?>
<!DOCTYPE html>
<!--[if IE 8 ]><html <?php language_attributes(); ?> class="IE ie8"> <![endif]-->
<!--[if IE 9 ]><html <?php language_attributes(); ?> class="IE ie9"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--><html <?php language_attributes(); ?>><!--<![endif]-->
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<!--[if IE 8 ]><meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"><![endif]-->
<title><?php echo site_global_description(); ?></title>
<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
<!--[if lt IE 9]><script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
<link rel="icon" href="<?php bloginfo('siteurl'); ?>/favicon.ico" type="image/x-icon" />
<link rel="shortcut icon" href="<?php bloginfo('siteurl'); ?>/favicon.ico" type="image/x-icon" />
<?php wp_head(); ?>

<!-- TYPEKIT -->
<script src="https://use.typekit.net/dnz6wkb.js"></script>
<script>try{Typekit.load({ async: true });}catch(e){}</script>

<script src="//code.jquery.com/jquery-1.11.2.min.js"></script>
<script src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/assets/js/jquery.flexslider.js"></script>
<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/assets/js/jquery.columnizer.js"></script>
<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/assets/js/jquery.fancybox.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/masonry/3.3.2/masonry.pkgd.js"></script>
<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/assets/js/instafeedly.js"></script>
<!-- <script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/assets/js/pinimages.js"></script> -->
<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/assets/js/imagesLoaded.js"></script>
<!-- <script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/assets/js/jquery.elevatezoom.js"></script> -->
<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/assets/js/general.js"></script>

<script src="https://widgets.healcode.com/javascripts/healcode.js" type="text/javascript"></script>


</head>
<?php $hide_header = get_field('hide_header');
if ($hide_header) { ?>
	<body <?php body_class('hide-header'); ?>>
<?php } else { ?>
	<body <?php body_class(); ?>>
<?php } ?>
	<div class="side-nav">
		<div class="close">Close</div>
		<div class="back">Back</div>
	    <?php wp_nav_menu(array('menu' => 'Main Site Nav - Mobile')) ?>
	</div>
	<div class="moved-by-nav">
		<header>
			<div class="mobile">
				<div class="staging">
					<p>This is a demo site please return to the live site <a href="http://purebarre.com">here</a> if you arrived here in error.</p>
				</div>
				<div class="main-nav table">
					<div class="logo table-cell"><a href="http://staging.purebarre.com"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/logo.jpg"></a></div>
					<div class="nav-toggle table-cell small"><i class="fa fa-bars"></i></div>
					<div class="table-cell small"><a href="http://staging.purebarre.com/locations"><i class="fa fa-map-marker"></i></a></div>
				</div>
				<div class="microsite-nav">
					<div class="table">
						<div class="back-to-home table-cell"><a href="/">Learn to Barre</a></div>
						<div class="microsite-nav-toggle table-cell closed">Menu</div>
					</div>
					<?php wp_nav_menu(array('menu' => 'Microsite Nav')) ?>
				</div>
			</div>
			<div class="desktop">
				<div class="staging">
					<p>This is a demo site please return to the live site <a href="http://purebarre.com">here</a> if you arrived here in error.</p>
				</div>
				<div class="find-a-studio nav">
					<div class="container">
						<div><a href="http://staging.purebarre.com/locations">find a studio</a></div>
					</div>
				</div>
				<div class="main-nav nav">
					<div class="table">
						<div class="logo"><a href="http://staging.purebarre.com/"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/logo.jpg"></a></div>
						<?php wp_nav_menu(array('menu' => 'Main Site Nav')) ?>
					</div>
				</div>
					<div class="microsite-nav nav">
						<?php wp_nav_menu(array('menu' => 'Microsite Nav')) ?>
					</div>

			</div>
		</header>
		<div class="body-wrapper">	
			
			
			
			
			
			
			