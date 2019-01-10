<?php
/*
Plugin Name: Circle Progress Bar Plugin
Plugin URI: #
Description: Circle Progress Bar
Version: 1.0
Author: 
Author URI: 
*/

$plugin    = define( 'CIRCLE_PROGRESS_BAR_PLUGIN', __FILE__);
$pluginDir = define( 'CIRCLE_PROGRESS_BAR_DIR', untrailingslashit( dirname( CIRCLE_PROGRESS_BAR_PLUGIN ) ) );

require_once CIRCLE_PROGRESS_BAR_DIR . '/includes/class-circle-progress-bar.php';

register_activation_hook(__FILE__, array('Circle_Progress_Bar', 'do_install') );
Circle_Progress_Bar::get_instance();

/*
* Admin Notice- PHP version below than 5.4
*/
add_action('admin_notices', 'circle_progress_admin_notice');
function circle_progress_admin_notice()
{
	$style = "overflow: hidden;"; 
	/* start phpversion error notification*/
    $phpVersion = phpVersion();
	if($phpVersion <= '5.4')
	{
	?>	
         	<style type="text/css">
			.circle_progress_show_phperror_notification {
			   	color: #fff;
			   	text-decoration: underline;
			}
			form.sfsi_phperrorNoticeDismiss {
			    display: inline-block;
			    margin: 5px 0 0;
			    vertical-align: middle;
			}
			.sfsi_phperrorNoticeDismiss input[type='submit']
			{
				background-color: transparent;
			    border: medium none;
			    color: #fff;
			    margin: 0;
			    padding: 0;
			    cursor: pointer;
			}
			.circle_progress_show_phperror_notification p{line-height: 10px; }
			p.circle_progress_show_notifictaionpragraph{padding: 0 !important;font-size: 18px;color: #0e0e0e;}
			.circle_progress_alignleft{float: left;}
			
		</style>
	    <div class="updated circle_progress_show_phperror_notification" style="<?php echo $style; ?>background-color: #D22B2F; color: #fff; font-size: 18px; border-left-color: #D22B2F;">
			<div class="circle_progress_alignleft" style="margin: 9px 0;">
				<p class="circle_progress_show_notifictaionpragraph">
					We noticed you are running your site on a PHP version older than 5.4. 
                </p>
			</div>
		</div>      
	<?php
	}
}

