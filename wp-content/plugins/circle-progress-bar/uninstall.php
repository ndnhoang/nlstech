<?php
if (!defined('WP_UNINSTALL_PLUGIN')) {
    die;
}

function circle_progress_delete_plugin(){
	/* Delete Option */
	$options = array( 'circle_progress_first_stoke_color', 'circle_progress_second_stoke_color');
	    
	foreach ( $options as $option ) {
	    delete_option( $option ); 
		delete_site_option($option);
	}
	  
	/* Delete Post */
	$post_statuses = array( 'any', 'trash', 'auto-draft' );

	// Delete the 'circle_bar_plugin' custom post types.
	foreach ( $post_statuses as $post_status ) {
	    $posts = get_posts( array( 'post_type' => 'circle_bar_plugin', 'post_status' => $post_status, 'posts_per_page' => -1, 'fields' => 'ids' ) );

	    if ( $posts ) {
	        foreach ( $posts as $post ) {
	            wp_delete_post( $post, true );
	        }
	    }
	}
}

circle_progress_delete_plugin();
wp_cache_flush();
?>