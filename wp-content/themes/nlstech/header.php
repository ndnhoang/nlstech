<?php
/**
 * @link http://www.nlstech.net/
 * @package nlstech
 * @author NLS Team
 */
global $nls_option;
$logo  = $nls_option['logo-image'];
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
  <head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
    <?php get_favicon();?>
    <?php wp_head(); ?>
  </head>
  <body <?php body_class(); ?>>
    <div id="wrapper">
      <header>
        <div class="header-inner">
          <div class="logo">
            <a href="<?php echo home_url(); ?>"><img src="<?php echo $logo['url'] ?>" alt="Logo"></a>
          </div>
          <div class="header-right">
            <nav>
              <?php wp_nav_menu( array(
                   'theme_location' => 'primary',
                   'menu_class' => ''
              ) ); ?>
            </nav>
          </div>
          <div class="clear"></div>
        </div>
      </header>
      <main>