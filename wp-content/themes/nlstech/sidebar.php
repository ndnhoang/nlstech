<?php
/**
 * @link http://www.nlstech.net/
 * @package jayahr
 * @author NLS Team
 */
get_header();

if ( ! is_active_sidebar( 'sidebar-1' ) ) {
	return;
}?>

<aside id="secondary" class="sidebar-area" role="complementary">
	<?php dynamic_sidebar( 'sidebar-1' ); ?>
</aside><!-- #secondary -->
