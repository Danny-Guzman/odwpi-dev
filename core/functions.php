<?php
/**
 * ODWPI Helper Functions
 *
 * @package ODWPI
 */

/**
 * Load Minified Version of a file
 *
 * @param  string $f File to load.
 * @param  mixed  $ext Extension of file, default css.
 *
 * @return string
 */
function odwpi_dev_get_min_file( $f, $ext = 'css' ) {
	// if a minified version exists.
	if ( false && file_exists( ODWPI_DEV_PLUGIN_DIR . str_replace( ".$ext", ".min.$ext", $f ) ) ) {
		return ODWPI_DEV_PLUGIN_URL . str_replace( ".$ext", ".min.$ext", $f );
	} else {
		return ODWPI_DEV_PLUGIN_URL . $f;
	}
}

function odwpi_dev_tools(){
	$tools = array(
		'codemirror' => array(
			'label' => 'CodeMirror',
			'version' => '6.0.1',
			'url' => 'https://codemirror.net/',
			'logo' => 'https://codemirror.net/style/logo.svg'
		),
		'bootstrap' => array(
			'label' => 'Bootstrap',
			'version' => '5.2.3',
			'url' => 'https://getbootstrap.com/docs/5.2/getting-started/introduction/',
			'icon' => 'bi bi-bootstrap-fill'
		),
		'webpack' => array(
			'label' => 'webpack',
			'version' => '5.82.1',
			'url' => 'https://webpack.js.org/',
			'logo' => 'https://webpack.js.org/icon_192x192.png'
		),
		'npm' => array(
			'label' => 'npm',
			'version' => '9.6.4',
			'url' => 'https://docs.npmjs.com/',
			'logo' => 'https://docs.npmjs.com/favicon-32x32.png'
		),
	);

	return $tools;
}

/**
 * Return array of all tables in the database.
 *
 * @return array
 */
/*
function odwpi_dev_get_database_tables() {
	global $wpdb;
	$sql     = '';
	$results = $wpdb->get_results( 'show tables' );

	return $results;
}
*/