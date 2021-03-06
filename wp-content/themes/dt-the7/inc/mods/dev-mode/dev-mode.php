<?php
/**
 * Development mode module.
 */

// File Security Check.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'The7_Dev_Mode_Module' ) ) {

	class The7_Dev_Mode_Module {

		/**
		 * Execute module.
		 */
		public static function execute() {
			// Load dependency.
			include dirname( __FILE__ ) . '/class-the7-dev-admin-page.php';
			include dirname( __FILE__ ) . '/class-the7-dev-re-install.php';
			include dirname( __FILE__ ) . '/class-the7-dev-beta-tester.php';
			include dirname( __FILE__ ) . '/class-the7-dev-tools.php';

			The7_Dev_Admin_Page::init();
			The7_Dev_Re_Install::init();
			The7_Dev_Beta_Tester::init();
			The7_Dev_Tools ::init();

			// Add admin message that BETA tester mode is enabled.
			add_action( 'load-update-core.php', array( __CLASS__, 'add_beta_tester_notice' ) );
			add_action( 'load-the7_page_the7-plugins', array( __CLASS__, 'add_beta_tester_notice' ) );
		}

		/**
		 * Add beta tester notice if it's enabled.
		 */
		public static function add_beta_tester_notice() {
			if ( The7_Dev_Beta_Tester::get_status() ) {
				the7_admin_notices()->add( 'the7-beta-tester', array( __CLASS__, 'print_beta_tester_notice' ), 'the7-dashboard-notice notice-warning' );
			}
		}

		/**
		 * Display beta tester notice.
		 */
		public static function print_beta_tester_notice() {
			include dirname( __FILE__ ) . '/views/beta-tester-notice.php';
		}
	}

	The7_Dev_Mode_Module::execute();
}