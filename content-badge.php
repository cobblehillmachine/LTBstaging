<div class="grid-item">
	<?php $thumb_id = get_post_thumbnail_id();
		$thumb_url_array = wp_get_attachment_image_src($thumb_id);
		$thumb_url = $thumb_url_array[0];
		$url = rtrim(get_permalink(),'/'); ?>
	<div class="image"><?php the_post_thumbnail('full') ?></div>
	<h3><?php the_title()  ?></h3>
	<div class="share">
		<a target=_blank class="facebook" href="http://www.facebook.com/sharer.php?u=<?php echo $url ?>"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/facebook-share.jpg"></a>
		<a target=_blank class="twitter" href="https://twitter.com/intent/tweet?text=<?php the_title() ?>! <?php echo get_post_field('post_content', $post->ID) ?> Learn to Barre @Pure_Barre: <?php the_permalink() ?>"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/twitter-share.jpg"></a>
		<a target=_blank class="pinterest" href="https://pinterest.com/pin/create/button/?url=<?php echo get_site_url() ?>&media=<?php echo $thumb_url ?>&description=<?php the_title() ?>! <?php echo get_post_field('post_content', $post->ID) ?> Learn to Barre @purebarre: <?php the_permalink() ?>"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/pinterest-share.jpg"></a>
	</div>
</div>