<?php
/**
 * @link http://www.nlstech.net/
 * @package nlstech
 * @author NLS Team
 */
global $nls_option; 
$logo  = $nls_option['logo-image'];
$copyright  = $nls_option['copyright'];
?>
            </main>
            <footer>
                  <div class="container">
                        <div class="cols-3">
                              <div class="widget-column-1">
                                    <?php if ( is_active_sidebar( 'about_us_widget' ) ) : 
                                             dynamic_sidebar( 'about_us_widget' ); 
                                    endif; ?>
                              </div>
                              <div class="widget-column-2">
                                    <?php if ( is_active_sidebar( 'latest_posts_widget' ) ) : 
                                             dynamic_sidebar( 'latest_posts_widget' ); 
                                    endif; ?>
                              </div>
                              <div class="widget-column-3">
                                    <?php if ( is_active_sidebar( 'find_us_widget' ) ) : 
                                             dynamic_sidebar( 'find_us_widget' ); 
                                    endif; ?>
                              </div>
                              <div class="clear"></div>
                        </div>
                        <div class="copyright"></div>
                  </div>
            </footer>
            
            <div id="overlay"></div>
        </div>
        <?php wp_footer(); ?>
    </body>
</html>