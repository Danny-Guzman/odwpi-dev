<?php
/**
 * Main Options File
 *
 * @package ODWPI
 */

add_action( 'admin_menu', 'odwpi_dev_plugin_menu' );
add_action( 'network_admin_menu', 'odwpi_dev_plugin_menu' );

/**
 * CAWeb NetAdmin Administration Menu Setup
 * Fires before the administration menu loads in the admin.
 *
 * @link https://developer.wordpress.org/reference/hooks/admin_menu/
 * @return void
 */
function odwpi_dev_plugin_menu() {
	$cap = is_multisite() ? 'manage_network_options' : 'manage_options';

	add_menu_page( 'ODWPI Dev', 'ODWPI Dev', $cap, 'odwpi-dev', 'odwpi_dev_main_page', '' );

	add_submenu_page( 'odwpi-dev', 'IDE', 'IDE', $cap, 'odwpi-dev-ide', 'odwpi_dev_main_page' );
	//add_submenu_page( 'odwpi-dev', 'Port', 'Port', $cap, 'odwpi-dev-port', 'odwpi_dev_main_page' );

	//add_submenu_page( 'odwpi-dev', 'Settings', 'Settings', $cap, 'odwpi-dev-settings', 'odwpi_dev_main_page' );

}

/**
 * Setup Main Options Page
 *
 * @return void
 */
function odwpi_dev_main_page() {
	$nonce = wp_create_nonce( 'odwpi_dev_nonce' );

	$page = wp_verify_nonce( $nonce, 'odwpi_dev_nonce' ) && isset( $_GET['page'] ) ? sanitize_text_field( wp_unslash( $_GET['page'] ) ) : '';

	$page = substr( $page, strrpos( $page, '-', -1 ) + 1 );

	?>
	<div class="container-fluid mt-4">
		<div id="odwpi-dev-page" class="p-3 me-3 bg-white">
			<?php
				if ( ! in_array($page, array('ide', 'port'), true ) ) {
			?>
				<h3>Welcome to the Office of Digital & WordPress Innovation</h3>
				<p class="fs-6">This plugin was created to help facilitate running code in realtime in a WordPress Instance.</p>

				<h5>Current Features:</h5>
				<ul>
					<li>IDE</li>
				</ul>
				<h5>Frameworks, Tools and Supported Languages:</h5>
				<div class="row align-items-end text-center">
					<?php foreach( odwpi_dev_tools() as $tool => $data ): ?>
						<div class="col-sm-6 col-md-4">
							<?php if ( isset( $data['logo'] ) && ! empty( $data['logo'] ) ): ?>
								<img class="odwpi-dev-tool-img" src="<?php print esc_attr( $data['logo'] ); ?>" />
							<?php elseif ( isset( $data['icon'] ) && ! empty( $data['icon'] ) ): ?>
								<span class="odwpi-dev-tool-icon <?php print esc_attr( $data['icon'] ); ?>"></span>
							<?php endif; ?>

							<p class="fs-4">
								<?php printf('%1$s v%2$s', esc_html( $data['label'] ), esc_html( $data['version'] ) ) ; ?>
								<?php if ( isset( $data['url'] ) && ! empty( $data['url'] ) ): ?>
								<a href="<?php print esc_url($data['url']); ?>" target="_blank" class="fs-6 align-super bi bi-box-arrow-up-right"></a>
								<?php endif; ?>
							</p>
						</div>
					<?php endforeach; ?>
				</div>

			<?php
				}else{
					require_once "admin/pages/$page.php";
				}
			?>
		</div>
	</div>
	<?php
}

/**
 * Save Plugin Settings
 *
 * @return void
 */
/*
function odwpi_dev_update_settings() {
	$verified = isset( $_POST['odwpi_dev_settings_nonce'] ) &&
		wp_verify_nonce( sanitize_key( $_POST['odwpi_dev_settings_nonce'] ), 'odwpi_dev_settings' );

	$dev_users = isset( $_POST['dev_users'] ) ? array_map( 'sanitize_text_field', wp_unslash( $_POST['dev_users'] ) ) : array();
	$dev       = array();

	foreach ( $dev_users as $i => $d ) {
		$id   = substr( $d, strrpos( $d, '-' ) + 1 );
		$user = substr( $d, 0, strrpos( $d, '-' ) );

		$dev[ $id ] = $user;

	}
	update_site_option( 'odwpi_dev_users', $dev );
}
*/