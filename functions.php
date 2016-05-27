<?php
/**
 * @package WordPress
 * @subpackage themename
 */



// removes admin bar on wordpress home
add_filter( 'show_admin_bar', '__return_false' );

// Add Favicon //
function diww_favicon() {
	echo '<link rel="shortcut icon" type="image/x-icon" href="' . get_site_url() . '/favicon.ico" />';
}
add_action('wp_head', 'diww_favicon');
add_action('admin_head', 'diww_favicon');

// pulls in logo for wp admin
function my_login_logo() { ?>
  <style type="text/css">
      body.login div#login h1 a {
          	background-image: url(<?php echo get_bloginfo( 'template_directory' ) ?>/assets/images/logo.jpg);
            background-size: 90%;
			width: auto;
			height: 75px;
			outline: 2px solid black;
			border: 2px solid white;
			background-color: #e31b23;
			background-position: 50% 50%;
      }
  </style>
<?php }
add_action( 'login_enqueue_scripts', 'my_login_logo' );

// ENQUEUE CSS, LESS, & SCSS STYLESHEETS
function add_style_sheets() {
	if( !is_admin() ) {
		wp_enqueue_style( 'reset', get_template_directory_uri().'/style.css', 'screen'  );
		wp_enqueue_style( 'font-awesome', '//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.min.css', 'screen');
		wp_enqueue_style( 'fancybox', get_template_directory_uri().'/assets/css/jquery.fancybox.css', 'screen' );
		wp_enqueue_style( 'flexslider', get_template_directory_uri().'/assets/css/flexslider.css', 'screen' );
		wp_enqueue_style( 'main', get_template_directory_uri().'/assets/css/live.css', 'screen' );
	}
}
add_action('wp_enqueue_scripts', 'add_style_sheets');

/**
 *
 * TAKE GLOBAL DESCRIPTION OUT OF HEADER.PHP AND GENERATE IT FROM A FUNCTION
 *
 */
function site_global_description()
{
	global $page, $paged;
	wp_title( '|', true, 'right' );
	bloginfo( 'name' );
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
	{
		echo " | $site_description";
	}
}


/**
 * REMOVE UNWANTED CAPITAL <P> TAGS
 */
remove_filter( 'the_content', 'capital_P_dangit' );
remove_filter( 'the_title', 'capital_P_dangit' );
remove_filter( 'comment_text', 'capital_P_dangit' );


/**
 * REGISTER NAV MENUS FOR HEADER FOOTER AND UTILITY
 */
register_nav_menus( array(
	'primary' => __( 'Primary Menu', 'themename' ),
	'footer' => __( 'Footer Menu', 'themename' ),
	'utility' => __( 'Utility Menu', 'themename' )
) );


/** 
 * DEFAULT COMMENTS & RSS LINKS IN HEAD
 */
add_theme_support( 'automatic-feed-links' );


/**
 * THEME SUPPORTS THUMBNAILS
 */
add_theme_support( 'post-thumbnails' );


/**
 *	ADD TINY IMAGE SIZE FOR ACF FIELDS, BETTER USABILITY
 */
add_image_size( 'mini-thumbnail', 50, 50 );


//create state taxonomy
add_action( 'init', 'create_offer_tax' );
function create_offer_tax() {
	register_taxonomy(
		'states',
		array('studios'),
		array(
			'label' => __( 'States' ),
			'rewrite' => array( 'slug' => 'state' ),
			'hierarchical' => true
		)
	);
}


// custom post type
add_action( 'init', 'create_post_type' );
function create_post_type() {

	$args1 = array(
		'labels' => array(
			'name' => __( 'Badges' ),
			'singular_name' => __( 'Badge' )
		),
		'public' => true,
		'exclude_from_search' => true,
		'menu_icon' => 'dashicons-shield-alt',
		'supports' => array( 'title','editor', 'thumbnail' )
	);
  	register_post_type( 'Badges', $args1);
  	
  	$args2 = array(
		'labels' => array(
			'name' => __( 'Tips' ),
			'singular_name' => __( 'Tip' )
		),
		'public' => true,
		'exclude_from_search' => true,
		'menu_icon' => 'dashicons-thumbs-up',
		'publicly_queryable'  => false,
		'supports' => array( 'title', 'editor', 'thumbnail' )
	);
  	register_post_type( 'Tips', $args2);
  	
  	$args3 = array(
		'labels' => array(
			'name' => __( 'Studios' ),
			'singular_name' => __( 'Studio' )
		),
		'public' => true,
		'exclude_from_search' => true,
		'menu_icon' => 'dashicons-location',
		'publicly_queryable'  => false,
		'supports' => array( 'title' )
	);
  	register_post_type( 'Studios', $args3);
  	register_taxonomy_for_object_type('states', 'studios');
  	
  	$args4 = array(
		'labels' => array(
			'name' => __( 'Virtual Events' ),
			'singular_name' => __( 'Virtual Event' )
		),
		'public' => true,
		'exclude_from_search' => true,
		'menu_icon' => 'dashicons-desktop',
		'publicly_queryable'  => false,
		'supports' => array( 'title')
	);
  	register_post_type( 'Virtual Events', $args4);

  	flush_rewrite_rules();
}

function up_next() {
    global $post;
    $siblings = get_pages('child_of='.$post->post_parent.'&parent='.$post->post_parent);
    foreach ($siblings as $key=>$sibling){
        if ($post->ID == $sibling->ID){
            $ID = $key;
        }
    }
    $title = get_the_title($siblings[$ID-1]->ID);
    $snippet = get_field('snippet', $siblings[$ID-1]->ID);
    $slug = $siblings[$ID-1]->post_name;
    
	echo '<div class="table-cell"><h4>up next...</h4><h2>'.$title.'</h2>';
	echo '<p>'.$snippet.'</p></div>';
	echo '<div class="table-cell"><a href="#'.$slug.'" class="button white deep-link">Continue Reading</a></div>';
}




// customize facebook sharing for badges
function doctype_opengraph($output) {
    return $output . '
    xmlns:og="http://opengraphprotocol.org/schema/"
    xmlns:fb="http://www.facebook.com/2008/fbml"';
}
add_filter('language_attributes', 'doctype_opengraph');


function fb_opengraph() {
    global $post;
 
    if(is_single()) {
        if(has_post_thumbnail($post->ID)) {
            $img_src = wp_get_attachment_image_src(get_post_thumbnail_id( $post->ID ), 'full');
        } 
        $url = rtrim(get_permalink(),'/');
        ?>
 
    <meta property="og:title" content="<?php echo the_title(); ?>"/>
    <meta property="og:description" content="<?php echo get_post_field('post_content', $post->ID); ?> @PureBarre"/>
    <meta property="og:url" content="<?php the_permalink() ?>"/>
    <meta property="og:site_name" content="<?php echo get_bloginfo(); ?>"/>
    <meta property="og:image" content="<?php echo $img_src[0]; ?>"/>
    <meta property="og:image:width" content="400" />
	<meta property="og:image:height" content="400" />
 
<?php
    } else {
        return;
    }
}
add_action('wp_head', 'fb_opengraph', 5);

function twit_opengraph() {
    global $post;
 
    if(is_single()) {
        if(has_post_thumbnail($post->ID)) {
            $img_src = wp_get_attachment_image_src(get_post_thumbnail_id( $post->ID ), 'medium');
        } 
        ?>
 
    <meta name="twitter:card" content="summary">
	<meta name="twitter:site" content="@Pure_Barre">
	<meta name="twitter:title" content="<?php the_title() ?>">
	<meta name="twitter:description" content="<?php echo get_post_field('post_content', $post->ID); ?>">
	<meta name="twitter:image:src" content="<?php echo $img_src[0]; ?>">
 
<?php
    } else {
        return;
    }
}
add_action('wp_head', 'twit_opengraph', 6);














