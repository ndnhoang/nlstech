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
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,400i,700" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Oswald:400,700" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=PT+Sans:400,400i,700,700i" rel="stylesheet">
    <?php get_favicon();?>
    <?php wp_head(); ?>
  </head>
  <body <?php body_class(); ?>>
    <div id="wrapper">
      <header>
        <div class="container">
          <div class="logo">
            <a href="<?php echo home_url(); ?>"><img src="<?php echo $logo['url'] ?>" alt="Logo"></a>
          </div>
          <div class="header-right">
            <?php wp_nav_menu( array(
                 'theme_location' => 'primary',
                 'container' => 'nav',
                 'menu_class' => ''
            ) ); ?>
          </div>
          <div class="clear"></div>
        </div>
      </header>
      <main>