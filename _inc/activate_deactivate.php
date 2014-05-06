<?php

/*-------------------------------------------
	Activate / Deactivate
---------------------------------------------*/

function bcr_activate() {
	flush_rewrite_rules();
}
register_activation_hook( __FILE__, 'bcr_activate' );

function bcr_deactivate() {
	flush_rewrite_rules();
}
register_deactivation_hook( __FILE__, 'bcr_deactivate' );