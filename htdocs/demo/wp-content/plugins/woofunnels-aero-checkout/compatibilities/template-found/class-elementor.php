<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
if ( ! defined( 'ELEMENTOR_VERSION' ) ) {
	return;
}

use Elementor\Core\Base\Module as BaseModule;
use Elementor\Plugin as wfacp_element;

if ( defined( 'ELEMENTOR_VERSION' ) ) {
	class WFACP_Compatibility_With_Elementor {

		public function __construct() {
			add_action( 'wfacp_after_checkout_page_found', [ $this, 'remove_actions' ] );
			add_action( 'wfacp_before_process_checkout_template_loader', [ $this, 'remove_actions' ] );
		}

		public function remove_actions() {
			$page_template = wfacp_element::instance()->modules_manager->get_modules( 'page-templates' );

			if ( $page_template instanceof BaseModule ) {
				remove_filter( 'update_post_metadata', [ $page_template, 'filter_update_meta' ], 10 );
			}

		}
	}

	WFACP_Plugin_Compatibilities::register( new WFACP_Compatibility_With_Elementor(), 'elementor' );
}
