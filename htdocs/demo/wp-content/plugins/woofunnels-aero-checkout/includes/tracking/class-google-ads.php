<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
class WFACP_Analytics_GADS extends WFACP_Analytics_GA {
	private static $self = null;
	protected $slug = 'google_ads';

	protected function __construct() {
		parent::__construct();
	}

	public static function get_instance() {
		if ( is_null( self::$self ) ) {
			self::$self = new self;
		}

		return self::$self;
	}
	public function get_key() {
		$get_ga_key = apply_filters( 'wfacp_get_gad_key', $this->admin_general_settings->get_option( 'gad_key' ) );

		return empty( $get_ga_key ) ? '' : $get_ga_key;
	}
	public function enable_custom_event() {
		return $this->admin_general_settings->get_option( 'is_gad_custom_events' );
	}
	public function is_global_pageview_enabled() {
		return wc_string_to_bool( $this->admin_general_settings->get_option( 'is_gad_page_view_global' ));
	}

	public function is_global_add_to_cart_enabled() {
		return wc_string_to_bool( $this->admin_general_settings->get_option( 'is_gad_add_to_cart_global' ));
	}
}