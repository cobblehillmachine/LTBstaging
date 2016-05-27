<?php get_header(); ?>

<?php

/*
if ($_SERVER["HTTP_USER_AGENT"] != "facebookexternalhit/1.1 (+http://www.facebook.com/externalhit_uatext.php)" && $_SERVER["HTTP_USER_AGENT"] != "Twitterbot/1.0") {
    redirect(get_site_url(), 302);
}
function redirect($url, $type=302) {
    if ($type == 301) header("HTTP/1.1 301 Moved Permanently");
    header("Location: $url");
    die();
}
*/

?>

<div class="blog">  
	<?php while ( have_posts() ) : the_post(); ?>
		<?php the_post_thumbnail() ?>
		<h2 class="title"><?php the_title(); ?></h2>
		<div class="post-content">
			<?php the_content(); ?>
		</div>
	<?php endwhile; wp_reset_query(); ?>
</div>
<?php get_footer(); ?>
