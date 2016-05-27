<?php
/**
 * The template for displaying search results pages.
 *
 * @package WordPress
 * @subpackage Twenty_Fifteen
 * @since Twenty Fifteen 1.0
 */

get_header(); ?>

	<h2 class="title"><?php printf( __( 'Search Results for: <span>%s</span>', 'twentyfifteen' ), get_search_query() ); ?></h2>
	<div class="search-results-list mid-cont">
		<!-- <div class="search-result Product" style="display: none"></div> -->
		<?php if ( have_posts() ) : ?>
			
			<?php while ( have_posts() ) : the_post(); ?>
				<?php the_title() ?>
			<?php endwhile;

		else :
			get_template_part( 'content', 'none' );
		endif; ?>
	</div>



<?php get_footer(); ?>
