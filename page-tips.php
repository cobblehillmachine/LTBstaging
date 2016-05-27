<?php get_header(); ?>

<?php get_template_part('content', 'top'); ?>

<div class="tips">
	<?php $tips = new WP_query(array('post_type' => 'tips', 'posts_per_page' => '-1', 'order' => 'ASC', 'orderby' =>'menu_order')); ?>
	<?php while ( $tips->have_posts() ) : $tips->the_post(); ?>
		<?php $type = get_field('type'); ?>
		<div class="masonry-item shadow <?php echo $type ?>">
			<?php if ($type == 'Admin') {
				$title = get_the_title();
				if ($title == 'Social') { ?>
					<h2>connect with us to get ongoing tips and motivation</h2>
					<?php get_template_part('content', 'social'); ?>
				<?php } else if ($title == 'Subscribe') { ?>
					<h4 class="subscribe">subscribe to our blog</h4>
					<form action="https://app.e2ma.net/app2/audience/signup/1755330/1719740/?v=a" method="post" id="newsletter-validate-detail">
					    <input type="email" autocapitalize="off" autocorrect="off" spellcheck="false" name="email" id="newsletter" title="Sign up for our newsletter" class="input-text required-entry validate-email" placeholder="Enter Your Email Address">
					    <button type="submit" title="Submit" class="button"></button>
					</form>
				<?php }  else if ($title == 'App CTA') { ?>
					<h3>GET THE PURE BARRE APP</h3>
					<p>Now it’s even easier to lift, tone, burn! With the Pure Barre mobile app, you can view class schedules, make a reservation, get added to a wait list, purchase class packages, and more—all within just a few clicks.</p>
					<a href="https://itunes.apple.com/us/app/pure-barre/id723157189?mt=8" class="button white" target=_blank>Download the Apple Version</a>
					<a href="https://play.google.com/store/apps/details?id=com.fitnessmobileapps.purebarre&hl=en" class="button white" target=_blank>Download the Google Version</a>
				<?php } ?>
			<?php } else if ($type == 'Testimonial') { ?>
				<img src="<?php the_field('testimonial_photo') ?>">
				<div class="cont">
					<h3><?php the_field('testimonial_name') ?></h3>
					<p><?php the_field('testimonial_content') ?></p>
				</div>
			<?php }  else { ?>
				<?php $video_id = get_field('video_id');
				if ($video_id) { ?>
					<a href="https://www.youtube.com/embed/<?php the_field('video_id') ?>?rel=0&wmode=transparent" class="fancybox.iframe fancybox video"><img src="http://img.youtube.com/vi/<?php the_field('video_id') ?>/mqdefault.jpg"><i class="fa fa-play"></i></a>
<!-- 					<iframe width="420" height="315" src="http://www.youtube.com/embed/<?php echo $video_id ?>?autoplay=1"></iframe> -->
				<?php } ?>
				<h3><?php the_field('tip_label'); ?></h3>
				<p><?php the_field('tip_title'); ?></p>
			<?php } ?>
		</div>
	<?php endwhile; wp_reset_query(); ?>
</div>
<?php get_footer() ?>