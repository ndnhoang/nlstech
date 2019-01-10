<?php
// show contact
add_filter( 'widget_text', 'do_shortcode' );
add_shortcode('latest_posts_footer','latest_posts_footer');
function latest_posts_footer($atts = '') {
    $value = shortcode_atts(array(
        'number' => 3
    ), $atts);
    ob_start();
    $query = new WP_Query(array(
        'post_type' => 'post',
        'post_status' => 'publish',
        'order' => 'desc',
        'orderby' => 'date',
        'posts_per_page' => $value['number']
    ));
    if ($query->have_posts()) : ?>
        <div class="latest-posts-footer">
            <?php while ($query->have_posts()) :
                $query->the_post(); 
                $image = get_the_post_thumbnail_url(get_the_ID(), 'full');
                $image = crop_img(150,150, $image);
                ?>
                <div class="item">
                    <a href="<?php the_permalink() ?>" class="thumb"><img src="<?php echo $image ?>" alt="<?php echo the_title() ?>"></a>
                    <div class="desc">
                        <h5><a href="<?php the_permalink() ?>"><?php the_title() ?></a></h5>
                        <p><?php echo wp_trim_words(get_the_excerpt(), 14) ?></p>
                    </div>
                    <div class="clear"></div>
                </div>
            <?php endwhile; ?>
        </div>
    <?php wp_reset_postdata(); endif;
    $result = ob_get_contents();
    ob_end_clean();
    return $result;
}
//show socials
add_shortcode('socials','socials');
function socials(){
    global $nls_option; 
    ob_start();?>
    <div class="social-icons">
        <?php if( !empty($nls_option['facebook']) ): ?>
        <a class="fa fa-facebook fa-1x" href="<?php echo $nls_option['facebook']; ?>" target="_blank"></a>
        <?php endif; ?>
        <?php if( !empty($nls_option['twitter']) ): ?>
        <a class="fa fa-twitter fa-1x" href="<?php echo $nls_option['twitter']; ?>" target="_blank"></a>
        <?php endif; ?>
        <?php if( !empty($nls_option['instagram']) ): ?>
        <a class="fa fa-instagram fa-1x" href="<?php echo $nls_option['instagram']; ?>" target="_blank"></a>
        <?php endif; ?>
        <?php if( !empty($nls_option['google_plus']) ): ?>
        <a class="fa fa-google-plus fa-1x" href="<?php echo $nls_option['google_plus']; ?>" target="_blank"></a>
        <?php endif; ?>
    </ul>
    <?php
    $result = ob_get_contents();
    ob_end_clean();
    return $result;
}
// portfolio home page
add_shortcode('portfolio_home','portfolio_home');
function portfolio_home($atts = '') {
    $value = shortcode_atts(array(
        'number' => 6
    ), $atts);
    ob_start();
    $query = new WP_Query(array(
        'post_type' => 'portfolio_type',
        'post_status' => 'publish',
        'order' => 'desc',
        'orderby' => 'date',
        'posts_per_page' => $value['number']
    ));
    if ($query->have_posts()) : ?>
        <div class="container">
            <div class="portfolio-home">
                <?php while ($query->have_posts()) :
                    $query->the_post(); 
                    $image = get_the_post_thumbnail_url(get_the_ID(), 'full');
                    ?>
                    <div class="item">
                        <a href="<?php the_permalink() ?>" class="thumb"><img src="<?php echo $image ?>" alt="<?php echo the_title() ?>"></a>
                        <div class="desc">
                            <h5><a href="<?php the_permalink() ?>"><?php the_title() ?></a></h5>
                            <p><?php echo wp_trim_words(get_the_excerpt(), 4) ?></p>
                            <a class="read-more" href="<?php the_permalink() ?>"><?php echo __('View full project', 'nls') ?></a>
                        </div>
                        <div class="clear"></div>
                    </div>
                <?php endwhile; ?>
            </div>
        </div>
    <?php wp_reset_postdata(); endif;
    $result = ob_get_contents();
    ob_end_clean();
    return $result;
}
// services home page
add_shortcode('services_home','services_home');
function services_home($atts = '') {
    $value = shortcode_atts(array(
        'number' => 3
    ), $atts);
    ob_start();
    $query = new WP_Query(array(
        'post_type' => 'service',
        'post_status' => 'publish',
        'order' => 'asc',
        'orderby' => 'date',
        'posts_per_page' => $value['number']
    ));
    if ($query->have_posts()) : ?>
        <div class="container">
            <div class="list-services-home">
                <?php while ($query->have_posts()) :
                    $query->the_post(); 
                    $image = get_the_post_thumbnail_url(get_the_ID(), 'full');
                    $image = crop_img(135, 135, $image);
                    ?>
                    <div class="item">
                        <a href="<?php the_permalink() ?>" class="thumb"><img src="<?php echo $image ?>" alt="<?php echo the_title() ?>"></a>
                        <div class="desc">
                            <h5><a href="<?php the_permalink() ?>"><?php the_title() ?></a></h5>
                            <h6><?php the_field('desc', get_the_ID()) ?></h6>
                        </div>
                        <div class="clear"></div>
                        <?php echo get_the_content(); ?>
                        <a class="read-more" href="<?php the_permalink() ?>"><?php echo __('Read more →', 'nls') ?></a>
                        <div class="clear"></div>
                    </div>
                <?php endwhile; ?>
            </div>
        </div>
    <?php wp_reset_postdata(); endif;
    $result = ob_get_contents();
    ob_end_clean();
    return $result;
}
// testimonial home page
add_shortcode('testimonials_home','testimonials_home');
function testimonials_home($atts = '') {
    $value = shortcode_atts(array(
        'number' => 2
    ), $atts);
    ob_start();
    $query = new WP_Query(array(
        'post_type' => 'testimonial',
        'post_status' => 'publish',
        'order' => 'desc',
        'orderby' => 'date',
        'posts_per_page' => $value['number']
    ));
    if ($query->have_posts()) : ?>
        <div class="container">
            <div class="list-testimonials-home owl-carousel">
                <?php while ($query->have_posts()) :
                    $query->the_post();
                    ?>
                    <div class="item">
                        <h5><?php the_field('desc', get_the_ID()) ?></h5>
                        <h6><?php the_title() ?></h6>
                        <?php echo get_the_content() ?>
                        <div class="clear"></div>
                    </div>
                <?php endwhile; ?>
            </div>
        </div>
    <?php wp_reset_postdata(); endif;
    $result = ob_get_contents();
    ob_end_clean();
    return $result;
}