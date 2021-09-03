<?php

namespace WPMailSMTP\Admin;

use WPMailSMTP\Admin\Pages\TestTab;
use WPMailSMTP\Connect;
use WPMailSMTP\Helpers\PluginImportDataRetriever;
use WPMailSMTP\Options;
use WPMailSMTP\WP;

/**
 * Class for the plugin's Setup Wizard.
 *
 * @since 2.6.0
 */
class SetupWizard {

	/**
	 * Run all the hooks needed for the Setup Wizard.
	 *
	 * @since 2.6.0
	 */
	public function hooks() {

		add_action( 'admin_init', [ $this, 'maybe_load_wizard' ] );
		add_action( 'admin_init', [ $this, 'maybe_redirect_after_activation' ], 9999 );
		add_action( 'admin_menu', [ $this, 'add_dashboard_page' ], 20 );
		add_filter( 'removable_query_args', [ $this, 'maybe_disable_automatic_query_args_removal' ] );

		// API AJAX callbacks.
		add_action( 'wp_ajax_wp_mail_smtp_vue_get_settings', [ $this, 'get_settings' ] );
		add_action( 'wp_ajax_wp_mail_smtp_vue_update_settings', [ $this, 'update_settings' ] );
		add_action( 'wp_ajax_wp_mail_smtp_vue_import_settings', [ $this, 'import_settings' ] );
		add_action( 'wp_ajax_wp_mail_smtp_vue_get_oauth_url', [ $this, 'get_oauth_url' ] );
		add_action( 'wp_ajax_wp_mail_smtp_vue_remove_oauth_connection', [ $this, 'remove_oauth_connection' ] );
		add_action( 'wp_ajax_wp_mail_smtp_vue_get_connected_data', [ $this, 'get_connected_data' ] );
		add_action( 'wp_ajax_wp_mail_smtp_vue_install_plugin', [ $this, 'install_plugin' ] );
		add_action( 'wp_ajax_wp_mail_smtp_vue_get_partner_plugins_info', [ $this, 'get_partner_plugins_info' ] );
		add_action( 'wp_ajax_wp_mail_smtp_vue_subscribe_to_newsletter', [ $this, 'subscribe_to_newsletter' ] );
		add_action( 'wp_ajax_wp_mail_smtp_vue_upgrade_plugin', [ $this, 'upgrade_plugin' ] );
		add_action( 'wp_ajax_wp_mail_smtp_vue_check_mailer_configuration', [ $this, 'check_mailer_configuration' ] );
		add_action( 'wp_ajax_wp_mail_smtp_vue_send_feedback', [ $this, 'send_feedback' ] );
	}

	/**
	 * Get the URL of the Setup Wizard page.
	 *
	 * @since 2.6.0
	 *
	 * @return string
	 */
	public static function get_site_url() {

		return wp_mail_smtp()->get_admin()->get_admin_page_url() . '-setup-wizard';
	}

	/**
	 * Checks if the Wizard should be loaded in current context.
	 *
	 * @since 2.6.0
	 */
	public function maybe_load_wizard() {

		// Check for wizard-specific parameter
		// Allow plugins to disable the setup wizard
		// Check if current user is allowed to save settings.
		if (
			! (
				isset( $_GET['page'] ) && // phpcs:ignore
				Area::SLUG . '-setup-wizard' === $_GET['page'] && // phpcs:ignore
				$this->should_setup_wizard_load() &&
				current_user_can( 'manage_options' )
			)
		) {
			return;
		}

		// Don't load the interface if doing an ajax call.
		if ( defined( 'DOING_AJAX' ) && DOING_AJAX ) {
			return;
		}

		set_current_screen();

		// Remove an action in the Gutenberg plugin ( not core Gutenberg ) which throws an error.
		remove_action( 'admin_print_styles', 'gutenberg_block_editor_admin_print_styles' );

		$this->load_setup_wizard();
	}

	/**
	 * Maybe redirect to the setup wizard after plugin activation on a new install.
	 *
	 * @since 2.6.0
	 */
	public function maybe_redirect_after_activation() {

		if ( wp_doing_ajax() || wp_doing_cron() ) {
			return;
		}

		// Check if we should consider redirection.
		if ( ! get_transient( 'wp_mail_smtp_activation_redirect' ) ) {
			return;
		}

		delete_transient( 'wp_mail_smtp_activation_redirect' );

		// Check option to disable setup wizard redirect.
		if ( get_option( 'wp_mail_smtp_activation_prevent_redirect' ) ) {
			return;
		}

		// Only do this for single site installs.
		if ( isset( $_GET['activate-multi'] ) || is_network_admin() ) { // WPCS: CSRF ok.
			return;
		}

		// Don't redirect if the Setup Wizard is disabled.
		if ( ! $this->should_setup_wizard_load() ) {
			return;
		}

		// Initial install.
		if ( get_option( 'wp_mail_smtp_initial_version' ) === WPMS_PLUGIN_VER ) {
			update_option( 'wp_mail_smtp_activation_prevent_redirect', true );
			wp_safe_redirect( self::get_site_url() );
			exit;
		}
	}

	/**
	 * Register page through WordPress's hooks.
	 *
	 * Create a dummy admin page, where the Setup Wizard app can be displayed,
	 * but it's not visible in the admin dashboard menu.
	 *
	 * @since 2.6.0
	 */
	public function add_dashboard_page() {

		if ( ! $this->should_setup_wizard_load() ) {
			return;
		}

		add_submenu_page( '', '', '', 'manage_options', Area::SLUG . '-setup-wizard', '' );
	}

	/**
	 * Load the Setup Wizard template.
	 *
	 * @since 2.6.0
	 */
	private function load_setup_wizard() {

		/**
		 * Before setup wizard load.
		 *
		 * @since 2.8.0
		 *
		 * @param \WPMailSMTP\Admin\SetupWizard  $setup_wizard SetupWizard instance.
		 */
		do_action( 'wp_mail_smtp_admin_setup_wizard_load_setup_wizard_before', $this );

		$this->enqueue_scripts();

		$this->setup_wizard_header();
		$this->setup_wizard_content();
		$this->setup_wizard_footer();

		/**
		 * After setup wizard load.
		 *
		 * @since 2.8.0
		 *
		 * @param \WPMailSMTP\Admin\SetupWizard  $setup_wizard SetupWizard instance.
		 */
		do_action( 'wp_mail_smtp_admin_setup_wizard_load_setup_wizard_after', $this );

		exit;
	}

	/**
	 * Load the scripts needed for the Setup Wizard.
	 *
	 * @since 2.6.0
	 */
	public function enqueue_scripts() {

		if ( ! defined( 'WPMS_VUE_LOCAL_DEV' ) || ! WPMS_VUE_LOCAL_DEV ) {
			$rtl = is_rtl() ? '.rtl' : '';
			wp_enqueue_style( 'wp-mail-smtp-vue-style', wp_mail_smtp()->assets_url . '/vue/css/wizard' . $rtl . '.min.css', [], WPMS_PLUGIN_VER );
		}

		wp_enqueue_script( 'wp-mail-smtp-vue-vendors', wp_mail_smtp()->assets_url . '/vue/js/chunk-vendors.min.js', [], WPMS_PLUGIN_VER, true );
		wp_enqueue_script( 'wp-mail-smtp-vue-script', wp_mail_smtp()->assets_url . '/vue/js/wizard.min.js', [ 'wp-mail-smtp-vue-vendors' ], WPMS_PLUGIN_VER, true );

		wp_localize_script(
			'wp-mail-smtp-vue-script',
			'wp_mail_smtp_vue',
			[
				'ajax_url'           => admin_url( 'admin-ajax.php' ),
				'nonce'              => wp_create_nonce( 'wpms-admin-nonce' ),
				'is_multisite'       => is_multisite(),
				'translations'       => WP::get_jed_locale_data( 'wp-mail-smtp' ),
				'exit_url'           => wp_mail_smtp()->get_admin()->get_admin_page_url(),
				'email_test_tab_url' => add_query_arg( 'tab', 'test', wp_mail_smtp()->get_admin()->get_admin_page_url( Area::SLUG . '-tools' ) ),
				'is_pro'             => wp_mail_smtp()->is_pro(),
				'license_exists'     => apply_filters( 'wp_mail_smtp_admin_setup_wizard_license_exists', false ),
				'plugin_version'     => WPMS_PLUGIN_VER,
				'other_smtp_plugins' => $this->detect_other_smtp_plugins(),
				'mailer_options'     => $this->prepare_mailer_options(),
				'upgrade_link'       => wp_mail_smtp()->get_upgrade_link( 'setup-wizard' ),
				'versions'           => $this->prepare_versions_data(),
				'public_url'         => wp_mail_smtp()->assets_url . '/vue/',
				'education'          => [
					'upgrade_text'   => esc_html__( 'We\'re sorry, the %mailer% mailer is not available on your plan. Please upgrade to the PRO plan to unlock all these awesome features.', 'wp-mail-smtp' ),
					'upgrade_button' => esc_html__( 'Upgrade to Pro', 'wp-mail-smtp' ),
					'upgrade_url'    => add_query_arg( 'discount', 'SMTPLITEUPGRADE', wp_mail_smtp()->get_upgrade_link( '' ) ),
					'upgrade_bonus'  => sprintf(
						wp_kses( /* Translators: %s - discount value $50 */
							__( '<strong>Bonus:</strong> WP Mail SMTP users get <span class="highlight">%s off</span> regular price,<br>applied at checkout.', 'wp-mail-smtp' ),
							[
								'strong' => [],
								'span'   => [
									'class' => [],
								],
								'br'     => [],
							]
						),
						'$50'
					),
					'upgrade_doc'    => '<a href="https://wpmailsmtp.com/docs/how-to-upgrade-wp-mail-smtp-to-pro-version/?utm_source=WordPress&amp;utm_medium=link&amp;utm_campaign=liteplugin" target="_blank" rel="noopener noreferrer" class="already-purchased">
												' . esc_html__( 'Already purchased?', 'wp-mail-smtp' ) . '
											</a>',
				],
			]
		);
	}

	/**
	 * Outputs the simplified header used for the Setup Wizard.
	 *
	 * @since 2.6.0
	 */
	public function setup_wizard_header() {
		?>
		<!DOCTYPE html>
		<html <?php language_attributes(); ?>>
		<head>
			<meta name="viewport" content="width=device-width"/>
			<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
			<title><?php esc_html_e( 'WP Mail SMTP &rsaquo; Setup Wizard', 'wp-mail-smtp' ); ?></title>
			<?php do_action( 'admin_print_styles' ); ?>
			<?php do_action( 'admin_print_scripts' ); ?>
			<?php do_action( 'admin_head' ); ?>
		</head>
		<body class="wp-mail-smtp-setup-wizard">
		<?php
	}

	/**
	 * Outputs the content of the current step.
	 *
	 * @since 2.6.0
	 */
	public function setup_wizard_content() {
		$admin_url = is_network_admin() ? network_admin_url() : admin_url();

		$this->settings_error_page( 'wp-mail-smtp-vue-setup-wizard', '<a href="' . $admin_url . '">' . esc_html__( 'Go back to the Dashboard', 'wp-mail-smtp' ) . '</a>' );
		$this->settings_inline_js();
	}

	/**
	 * Outputs the simplified footer used for the Setup Wizard.
	 *
	 * @since 2.6.0
	 */
	public function setup_wizard_footer() {
		?>
		<?php wp_print_scripts( 'wp-mail-smtp-vue-script' ); ?>
		</body>
		</html>
		<?php
	}

	/**
	 * Error page HTML
	 *
	 * @since 2.6.0
	 *
	 * @param string $id     The HTML ID attribute of the main container div.
	 * @param string $footer The centered footer content.
	 */
	private function settings_error_page( $id = 'wp-mail-smtp-vue-site-settings', $footer = '' ) {

		$inline_logo_image = 'data:image/svg+xml;base64,PHN2ZyBpZD0iTGF5ZXJfMSIgZGF0YS1uYW1lPSJMYXllciAxIiB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHZpZXdCb3g9IjAgMCAyNDIgNjAiPjxkZWZzPjxzdHlsZT4uY2xzLTExLC5jbHMtMTJ7ZmlsbC1ydWxlOmV2ZW5vZGR9LmNscy00e2ZpbGw6bm9uZX0uY2xzLTExe2ZpbGw6Izg2YTE5Nn0uY2xzLTEye2ZpbGw6I2ZmZn08L3N0eWxlPjwvZGVmcz48cGF0aCBkPSJNNjkuMDYgMTEuMTFMNjQuNyAyMy40OWgtLjA2bC0xLjg5LTYuNTUtMi02LjE0aC0zLjEzdi40NGw2IDE3Ljg5aDEuNjZsNC4zOS0xMS42N2guMDZsNC4zOSAxMS42N2gxLjU2bDYuMDYtMTcuODl2LS40NGgtMy4ybC0xLjkyIDYuMTQtMS44MiA2LjUyaC0uMDZsLTQuMzItMTIuMzV6TTg3LjY4IDI5aC0zVjEwLjhoNy41NGE2LjE3IDYuMTcgMCAwMTYuNDIgNi40MiA2LjE0IDYuMTQgMCAwMS02LjQyIDYuMzJoLTQuNXptLS4wNS04LjExaDQuNTVhMy41NCAzLjU0IDAgMDAzLjUxLTMuNzUgMy40OSAzLjQ5IDAgMDAtMy41MS0zLjcxaC00LjU1em0yOS0uNzNsLTcuNDEtOS40MWgtMS4xMVYyOWgzVjE3LjYxbDUuMjggNi43NGguNDFsNS4yNS02Ljc0VjI5aDMuMDVWMTAuNzVIMTI0em0yNC4xMS0yLjc4djcuODhjMCAxLjE0IDAgMS44NyAxLjM1IDEuNzR2MS45MmMtMS44LjM0LTMuNjQuMTMtMy42NC0ydi0uNTJhNC41NyA0LjU3IDAgMDEtNC4zMiAyLjczYy0zLjgyIDAtNS42Ny0zLjA3LTUuNjctNi42LjA4LTQuMTYgMy4wNS02LjQ1IDcuMTMtNi4zN2ExMi42MiAxMi42MiAwIDAxNS4xNiAxLjIyek0xMzggMjIuNzFWMTlhNi40OSA2LjQ5IDAgMDAtMi42My0uNTJjLTIuMzkgMC00IDEuMzctNC4wOCA0LjA4IDAgMi4yOSAxLjEyIDQuMDggMy40MyA0LjA4IDIuMTMuMDIgMy4yMi0xLjY0IDMuMjgtMy45M3ptNi41Ny0xMC4xMmExLjY1IDEuNjUgMCAwMDEuNzUgMS42OSAxLjYxIDEuNjEgMCAwMDEuNjgtMS42OSAxLjcxIDEuNzEgMCAwMC0zLjQxIDB6bTMuMTIgNGgtMi44M1YyOWgyLjgzek0xNTEuMyAxMHYxNC41M2MwIDQuMTggMS43NyA1LjE3IDUuNjIgNC41NWwtLjExLTIuMTljLTIuMTUuMzQtMi43LS4zMS0yLjctMi4zOVYxMHptMTMuNDcgMTMuODZjLjA4IDMuODIgMy44IDUuNTkgNy4zNiA1LjUxIDMuNCAwIDcuMTctMS41MSA3LjE3LTUuNTEgMC00LjE5LTMuMzgtNC45Mi03LjA3LTUuMzMtMi4xLS4yOS00LjE2LS41NS00LjE2LTIuNnMyLjE2LTIuNzMgMy44Mi0yLjczIDMuODUuNjIgNCAyLjU3aDIuODZjLS4wOC0zLjcyLTMuMzUtNS4yOC02LjgxLTUuMjhzLTYuODQgMS43Ny02Ljg0IDUuNTEgMy4zIDQuNzEgNi42MyA1YzIuMTEuMiA0LjU4LjQ0IDQuNTggMi44M3MtMi4yOSAyLjgzLTQuMjEgMi44My00LjIyLS43NS00LjM1LTIuOHptMjYuNDQtMy42N2wtNy40MS05LjQxaC0xLjEyVjI5aDNWMTcuNjFsNS4zMiA2Ljc0aC40Mmw1LjI1LTYuNzRWMjloM1YxMC43NWgtMS4wN3ptMTYuNTQtNi42OFYyOWgzVjEzLjQ4SDIxNlYxMC44aC0xMy41M3YyLjY4em0xNCAxNS41MmgtM1YxMC44aDcuNTRhNi4xNyA2LjE3IDAgMDE2LjQyIDYuNDIgNi4xNCA2LjE0IDAgMDEtNi40MiA2LjMyaC00LjV6bTAtOC4xMWg0LjU1YTMuNTQgMy41NCAwIDAwMy41MS0zLjc1IDMuNDkgMy40OSAwIDAwLTMuNTEtMy43MWgtNC41NXoiIGZpbGwtcnVsZT0iZXZlbm9kZCIgZmlsbD0iIzIzMjgyYyIvPjxwYXRoIGQ9Ik05NC4xOCAzOC4wOWEuNDYuNDYgMCAwMS4wOS4xOSAxLjE1IDEuMTUgMCAwMTAgLjJ2LjE4YTEuMzMgMS4zMyAwIDAxLS4wOC4yNCAxLjA5IDEuMDkgMCAwMS0uMjEuMzcuNTguNTggMCAwMS0uNDYgMCAuMy4zIDAgMDAtLjE3IDAgMS41OSAxLjU5IDAgMDAtLjM0LS4wNmgtLjM1YTEuNyAxLjcgMCAwMC0uNTUuMDggMS4xMiAxLjEyIDAgMDAtLjQ3LjI5IDEuNzIgMS43MiAwIDAwLS4zNC42IDMuMzQgMy4zNCAwIDAwLS4xNiAxdjEuMTNoMi4xcTAgLjM5LS4wNi42M2EyLjEgMi4xIDAgMDEtLjEuNC42MS42MSAwIDAxLS4xNS4yMiAxLjI2IDEuMjYgMCAwMS0uMjMuMTNoLS4yM2E1LjM1IDUuMzUgMCAwMS0uNjEgMGgtLjc1djcuMTFhMS4xMiAxLjEyIDAgMDEwIC4yNC4yNS4yNSAwIDAxLS4yLjIxIDYuMDggNi4wOCAwIDAxLS42Ni4wN2gtLjUzYTMuMTUgMy4xNSAwIDAxLS42MS0uMDYgMS40IDEuNCAwIDAxMC0uMjNWNDMuN2EyLjE5IDIuMTkgMCAwMS0xLjE3LS4zMWMwLS4xOSAwLS4zNS4wOC0uNDZhLjY5LjY5IDAgMDEuMS0uMjcuNjEuNjEgMCAwMS4xNy0uMTUuODYuODYgMCAwMS4yNS0uMWwuMjItLjA2LjM1LS4wN3YtLjczYTYuMjYgNi4yNiAwIDAxLjA2LS42NSAzLjc5IDMuNzkgMCAwMS40My0xLjYxIDMuMTYgMy4xNiAwIDAxLjg1LTEgMy4yNCAzLjI0IDAgMDExLjA5LS40OSA0LjQgNC40IDAgMDExLjEtLjE1IDMuMiAzLjIgMCAwMTEgLjEzIDEuMzYgMS4zNiAwIDAxLjUzLjI3em05LjgyIDUuNjhhMi4wOCAyLjA4IDAgMDAtLjcxLjEyIDEuNjUgMS42NSAwIDAwLS41OS4zOHY2YTIuNTQgMi41NCAwIDAxMCAuNDEuOTEuOTEgMCAwMS0uMTYuMzcgMS4wNSAxLjA1IDAgMDEtLjI0LjE1IDEuMyAxLjMgMCAwMS0uMzMuMDZoLTEuMjd2LTdhMy44OCAzLjg4IDAgMDAtLjA3LS44MSA0LjczIDQuNzMgMCAwMC0uMTgtLjYzIDEuNjYgMS42NiAwIDAxLjMxLS4yMyAzLjY2IDMuNjYgMCAwMS41Mi0uMjUuNTYuNTYgMCAwMS4xNSAwaC4xMmEuODkuODkgMCAwMS40NS4wOS43Ni43NiAwIDAxLjI0LjMgMy41NyAzLjU3IDAgMDEuNTYtLjMzYy4yLS4wOS4zOS0uMTcuNTctLjIzYTMgMyAwIDAxLjU1LS4xNCAxLjUxIDEuNTEgMCAwMS41NiAwYy41OC4wNi45LjI0IDEgLjUzYTIuODkgMi44OSAwIDAxLS4wNy41NyAxLjQ2IDEuNDYgMCAwMS0uMjcuNjRoLS44N2EuNTYuNTYgMCAwMC0uMTUgMHptNy45MSA3LjU2aC0xLjY3di01Ljg5YTMuMiAzLjIgMCAwMC0uMjQtMS40Ny45LjkgMCAwMC0uODYtLjQzIDEuNjcgMS42NyAwIDAwLS44LjIgMi40MSAyLjQxIDAgMDAtLjYzLjQ5djYuMTRhMi4zNyAyLjM3IDAgMDEwIC40MS42NC42NCAwIDAxLS40My40NyAxLjk0IDEuOTQgMCAwMS0uMzIuMDcgMy4yOCAzLjI4IDAgMDEtLjQ5IDBoLS43NnYtNy4wMWEzLjk0IDMuOTQgMCAwMC0uMDctLjgxIDQuODIgNC44MiAwIDAwLS4xNi0uNjMgMi4yMyAyLjIzIDAgMDEuODMtLjQ4LjU2LjU2IDAgMDEuMTUgMGguMDlhLjguOCAwIDAxLjQ1LjEzLjg2Ljg2IDAgMDEuMjYuMjggNC4zOSA0LjM5IDAgMDExLjE0LS41OCAzLjg0IDMuODQgMCAwMTEuMjQtLjE5aC4zOWEyLjcgMi43IDAgMDExIC4yNyAyLjI2IDIuMjYgMCAwMS42OC41MyAyLjU4IDIuNTggMCAwMS42MS0uMzZjLjIzLS4xLjQ0LS4xOS42My0uMjVhMy42NSAzLjY1IDAgMDExLjIxLS4xOWguNGEyLjkxIDIuOTEgMCAwMTEuMTIuMyAxLjkgMS45IDAgMDEuNj