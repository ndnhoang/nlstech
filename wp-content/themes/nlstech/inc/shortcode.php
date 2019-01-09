<?php
// show contact
add_filter( 'widget_text', 'do_shortcode' );
add_shortcode('show_contact','show_contact');
function show_contact(){
    global $jayahr_option; 
    $phone  = $jayahr_option['phone'];
    $email  = $jayahr_option['email'];
    ob_start();
    if ($phone || $email) : ?>
        <ul>
            <?php if ($phone) : ?>
                <li><a href=tell:<?php echo $phone; ?>><?php echo $phone; ?></a></li>
            <?php endif; ?>
            <?php if ($email) : ?>
                <li><a href=mailto:<?php echo $email; ?>><?php echo $email; ?></a></li>
            <?php endif; ?>
        </ul>
    <?php endif;
    $result = ob_get_contents();
    ob_end_clean();
    return $result;
}
//show socials
add_shortcode('show_socials_icon','show_socials_icon');
function show_socials_icon(){
    global $jayahr_option; 
    ob_start();?>
    <ul>
        <?php if( !empty($jayahr_option['facebook']) ): ?>
        <li><a class="facebook" href="<?php echo $jayahr_option['facebook']; ?>" target="_blank"><img src="<?php echo get_stylesheet_directory_uri().'/images/facebook-icon.png'; ?>" alt="facebook"></a></li>
        <?php endif; ?>
        <?php if( !empty($jayahr_option['instagram']) ): ?>
        <li><a class="instagram" href="<?php echo $jayahr_option['instagram']; ?>" target="_blank"><img src="<?php echo get_stylesheet_directory_uri().'/images/instagram-icon.png'; ?>" alt="instagram"></a></li>
        <?php endif; ?>
        <?php if( !empty($jayahr_option['social-email']) ): ?>
        <li><a class="email" href="<?php echo $jayahr_option['social-email']; ?>" target="_blank"><img src="<?php echo get_stylesheet_directory_uri().'/images/email-icon.png'; ?>" alt="email"></a></li>
        <?php endif; ?>
    </ul>
    <?php
    $result = ob_get_contents();
    ob_end_clean();
    return $result;
}