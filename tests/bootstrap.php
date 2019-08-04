<?php

$_tests_dir = getenv( 'WP_TESTS_DIR' );
if ( ! $_tests_dir ) {
	$_tests_dir = dirname( dirname( __FILE__ ) ) . '/tmp/wordpress-tests-lib';
}

require_once $_tests_dir . '/includes/functions.php';

function _manually_load_plugin() {
	if ( ! class_exists( 'RGForms' ) ) {
		require dirname( dirname( __FILE__ ) ) . '/tmp/gravityforms/gravityforms.php';
	}
	require dirname( dirname( __FILE__ ) ) . '/gravityflow.php';
	//GFForms::setup( true );
	gf_upgrade()->install();
	GFForms::loaded();
	gravity_flow()->setup();
}
tests_add_filter( 'muplugins_loaded', '_manually_load_plugin' );

require $_tests_dir . '/includes/bootstrap.php';

$_gf_tests_dir = GFCommon::get_base_path() . '/tests';
require $_gf_tests_dir . '/gravityforms-utils.php';
require $_gf_tests_dir . '/gravityforms-testcase.php';
require $_gf_tests_dir . '/gravityforms-field-testcase.php';
