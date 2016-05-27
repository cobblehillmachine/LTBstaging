<?php get_header(); ?>

<?php get_template_part('content', 'top'); ?>

<div class="red tip content first-class">
	<div class="mid-cont"><?php the_field('first_class_intro'); ?></div>
</div>

<div class="slider-wrapper">
	<div class="first-class-stories wide-cont flexslider fade-in">
		<ul class="slides">
			<?php while( have_rows('first_class_stories') ): the_row();
		    	$img = get_sub_field('photo');
		    	$name = get_sub_field('name');
		    	$story = get_sub_field('story');
		    	$advice = get_sub_field('advice_for_beginners'); ?>
		        <li class="story table">
					<div class="table-cell">
						<img src="<?php echo $img ?>">
					</div>
					<div class="table-cell">
						<h3><?php echo $name ?></h3>
						<p><?php echo $story ?></p>
					</div>
					<div class="table-cell">
						<div class="advice">
							<h4>My Advice to Beginners</h4>
							<p><?php echo $advice ?></p>
						</div>
					</div>
				</li>
			<?php endwhile; ?>
		</ul>
	</div>
</div>

<div class="red tip content badge fade-in">
	<div class="mid-cont"><?php the_field('badge_intro'); ?></div>
</div>

<div class="badges wide-cont grid-four fade-in">

	<?php $badges = new WP_query(array('post_type' => 'badges', 'order' => 'ASC')) ?>
	<?php while ( $badges->have_posts() ) : $badges->the_post(); ?>
		<?php get_template_part('content', 'badge'); ?>
	<?php endwhile; wp_reset_query(); ?>
</div>

<div class="red tip content shares fade-in">
	<div class="mid-cont"><?php the_field('shares_intro'); ?></div>
</div>

<div id="instafeed" class="isurvived">
</div>

<?php get_footer() ?>