<?php get_header(); ?>
<div class="blog">
	<?php while ( have_posts() ) : the_post();?>
		<div class="post-content">
			<?php the_content(); ?>               
		</div>
	<?php endwhile; ?>     
</div>
<?php get_footer(); ?>