<?php
/**
 * @link http://www.nlstech.net/
 * @package jayahr
 * @author NLS Team
 */
get_header();?>
	<div class="container">
		<img src="<?php echo get_stylesheet_directory_uri().'/images/404.png'; ?>" alt="404">
		<a class="read-more" href="<?php echo home_url(); ?>">Back to home</a>
	</div>
<?php get_footer();