<?php
/**
 * @link http://www.nlstech.net/
 * @package jayahr
 * @author NLS Team
 */
$keyword = get_search_query();
$default_posts_per_page = get_option( 'posts_per_page' );
get_header();?>
<div class="container">
	<h2 class="page-title">Search product for: <strong><?php echo $keyword; ?></strong></h2>
	<?php $query = new WP_Query(array(
		'post_type'   		=> 'product',
		'post_status' 		=> 'public',
		'order' 	  		=> 'asc',
		's'			  		=> $keyword,
		'posts_per_page'	=> $default_posts_per_page
	)); 
	$total_product = $query->found_posts;
	$total_page = ceil($total_product / $default_posts_per_page);
	if ($query->have_posts()) : ?>
		<div class="woocommerce">
			<ul class="products columns-3">
				<?php while ($query->have_posts()) : 
					$query->the_post();
					wc_get_template_part( 'content', 'product' );
				endwhile; ?>
			</ul>
			<?php if ($total_product > $default_posts_per_page) : ?>
				<div class="load-more">
					<a href="#" class="read-more" data-page="1" data-pages="<?php echo $total_page; ?>" data-cat="0" data-keyword="<?php echo $keyword; ?>">Load more</a>
					<a href="#" class="loading"><img src="<?php echo get_stylesheet_directory_uri().'/images/spinner.gif'; ?>" alt="">Loading</a>
				</div>
			<?php endif; ?>
		</div>
	<?php else : 
		do_action( 'woocommerce_no_products_found' );
	endif; ?>
</div>
<?php get_footer();