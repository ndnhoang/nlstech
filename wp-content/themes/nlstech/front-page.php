<?php
/**
 * Template Name: Home
 * @link http://www.nlstech.net/
 * @author NLS Team
 * @package jayahr
 */
get_header(); ?>
	<?php
		while ( have_posts() ) : the_post();
			the_content();
		endwhile; ?>
<?php get_footer();