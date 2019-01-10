<h1>Circle Stoke Setting</h1>
<?php settings_errors(); ?>
<form method="post" action="options.php">
	<?php settings_fields( 'circle-settings-group' ); ?>
	<?php do_settings_sections( 'circle_progress_settings' ); ?>
	<?php submit_button(); ?>
</form>