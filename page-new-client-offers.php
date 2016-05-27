<?php
/**
 * Template Name: Studio List Template
 * Description: Template for LTB pages that should list studio special offers
 *
 * @package WordPress
 * @subpackage themename
 */
 
get_header(); ?>

<?php get_template_part('content', 'top'); ?>

<div class="red content offers tip">
	<div class="wide-cont state-filter">
		<h2>find a studio near you</h2>
		<?php if ( is_page('seattle') || is_page('denver') ) { ?>
		<?php } else { ?>
			<?php wp_dropdown_categories(array('hide_empty' => '0', 'taxonomy' => 'states','show_option_none' => 'Sort by State or Province', 'orderby' => 'name', 'order' => 'ASC', 'value_field' => 'slug')) ?>
			<script type="text/javascript">
		
				var dropdown = document.getElementById("cat");
				function onCatChange() {
					var state = dropdown.options[dropdown.selectedIndex].value
					$('#cat_hero').val(state);
					if (state == '-1') {
						$('.studio').show();
						return false;
					}
					$('.studio').each(function() {
						if ($(this).hasClass(state)) {
							$(this).show();
						} else {
							$(this).hide();
						}
					})
					if ($('.studio').hasClass(state)) {
						$(".no-studios").hide();
					}else {
						$(".no-studios").show();
					}
				}
				dropdown.onchange = onCatChange;
				
			</script>
		<?php } ?>
	</div>
</div>

<div class="offers wide-cont grid-three">
	<div class="no-studios"><h3>Sorry, there are no studios in your area.</h3></div>
	<?php if (is_page('platform')) { ?>
		<?php $studios = new WP_query(array('post_type' => 'studios', 'orderby' => 'title', 'order' => 'ASC', 'posts_per_page' => -1, 'meta_key' => 'participating_in_platform', 'meta_value' => true)) ?>
	<?php } else if ( is_page('denver') || is_page('seattle') ) { ?>
		
		<?php if (is_page('denver')) {
			$state = "colorado";
		} else if (is_page('seattle')) {
			$state = "washington";
		} ?>
		
		<?php $studios = new WP_query(array('post_type' => 'studios', 'orderby' => 'title', 'order' => 'ASC', 'posts_per_page' => -1, 'tax_query' => array(array('taxonomy' => 'states', 'field' => 'name', 'terms' => $state)))) ?>	
	<?php } else { ?>
		<?php $studios = new WP_query(array('post_type' => 'studios', 'orderby' => 'title', 'order' => 'ASC', 'posts_per_page' => -1)) ?>
	<?php } ?>
	
	<?php while ( $studios->have_posts() ) : $studios->the_post(); ?>
		<?php $state = get_the_terms($post->id, 'states'); ?>
		<?php if ( is_page('denver') || is_page('seattle') ) { ?>
			<div class="grid-item center studio <?php echo $state[0]->slug ?>">
				<h3><?php the_title() ?></h3>
				<p><?php the_field('street_address') ?></p>
				<p><?php the_field('city') ?>, <?php the_field('state') ?> <?php the_field('zip') ?></p>
				<p><?php the_field('phone') ?></p>
				<healcode-widget data-type="pricing-link" data-version="0.2" data-site-id="<?php the_field('special_state_site_id') ?>" data-service-id="<?php the_field('special_state_service_id') ?>" data-link-class="button" data-inner-html="special offer for new clients" onclick="_gaq.push(['_trackEvent', 'New Client Offers', 'Click', '<?php the_title() ?>', 1])"></healcode-widget>

			</div>
		<?php } else { ?>
	
	
	
			<?php $link = get_field('site_id');
			if ($link) { ?>
				<div class="grid-item center studio <?php echo $state[0]->slug ?>">
					<h3><?php the_title() ?></h3>
					<p><?php the_field('street_address') ?></p>
					<p><?php the_field('city') ?>, <?php the_field('state') ?> <?php the_field('zip') ?></p>
					<p><?php the_field('phone') ?></p>
					<?php $new_link = get_field('link');
					if ($new_link) { ?>
						<a href="<?php echo $new_link ?>" class="button" target=_blank onclick="_gaq.push(['_trackEvent', 'New Client Offers', 'Click', '<?php the_title() ?>', 1])">special offer for new clients</a>
					<?php } else { ?>
						<healcode-widget data-type="pricing-link" data-version="0.2" data-site-id="<?php the_field('site_id') ?>" data-service-id="<?php the_field('service_id') ?>" data-link-class="button" data-inner-html="special offer for new clients" onclick="_gaq.push(['_trackEvent', 'New Client Offers', 'Click', '<?php the_title() ?>', 1])"></healcode-widget>
					<?php } ?>
	
				</div>
			<?php } ?> <!-- end if link -->
		<?php } ?> <!-- end if denver/seattle -->
	<?php endwhile; wp_reset_query(); ?>
</div>

<?php get_footer() ?>