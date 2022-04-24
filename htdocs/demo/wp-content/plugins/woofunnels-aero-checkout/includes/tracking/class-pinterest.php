<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class WFACP_Analytics_Pint extends WFACP_Analytics {
	private static $self = null;
	protected $slug = 'pint';

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

		$get_pixel_key = apply_filters( 'wfacp_pinterest_key', $this->admin_general_settings->get_option( 'pint_key' ) );

		return empty( $get_pixel_key ) ? '' : $get_pixel_key;
	}

	public function enable_custom_event() {
		return $this->admin_general_settings->get_option( 'is_pint_custom_events' );
	}

	/**
	 * @param $product_obj WC_Product
	 * @param $cart_item WC_Order_Item
	 *
	 * @return array
	 */
	public function get_item( $product_obj, $cart_item ) {

		if ( ! $product_obj instanceof WC_Product ) {
			return parent::get_item( $product_obj, $cart_item );
		}

		$product_id = $this->get_cart_item_id( $cart_item );

		if ( $cart_item['variation_id'] ) {
			$variation = wc_get_product( $cart_item['variation_id'] );
			if ( $variation->get_type() == 'variation' ) {
				$categories   = implode( '/', $this->get_object_terms( 'product_cat', $variation->get_parent_id() ) );
				$product_tags = implode( '/', $this->get_object_terms( 'product_tags', $variation->get_parent_id() ) );
			} else {
				$categories   = implode( '/', $this->get_object_terms( 'product_cat', $product_id ) );
				$product_tags = implode( '/', $this->get_object_terms( 'product_tags', $product_id ) );
			}
		} else {
			$categories   = implode( '/', $this->get_object_terms( 'product_cat', $product_id ) );
			$product_tags = implode( '/', $this->get_object_terms( 'product_tags', $product_id ) );
		}


		$item_id = $this->get_cart_item_id( $cart_item );
		$item_id = $this->get_product_content_id( $item_id );

		$sub_total = $cart_item['line_subtotal'];
		if ( ! wc_string_to_bool( $this->exclude_tax ) ) {
			$sub_total += $cart_item['line_subtotal_tax'];
		}
		$product_plugin = 'WooFunnels Checkout';
		if ( isset( $cart_item['_wfob_product'] ) ) {
			$product_plugin = 'OrderBump';
		}

		$sub_total       = $this->number_format( $sub_total );
		$item_added_data = [
			'plugin'     => $product_plugin,
			'currency'   => get_woocommerce_currency(),
			'user_role'  => WFACP_Common::get_current_user_role(),
			'value'      => $sub_total,
			'line_items' => [
				[
					'product_category' => $categories,
					'product_id'       => $item_id,
					'product_name'     => $product_obj->get_name(),
					'product_price'    => $sub_total,
					'product_quantity' => $cart_item['quantity'],
					'tags'             => $product_tags,
				]
			]
		];

		return $item_added_data;
	}


	public function get_product_item( $product_obj ) {

		if ( ! $product_obj instanceof WC_Product ) {
			return parent::get_product_item( $product_obj );
		}

		$product_id = $product_obj->get_id();

		$categories   = implode( '/', $this->get_object_terms( 'product_cat', $product_id ) );
		$product_tags = implode( '/', $this->get_object_terms( 'product_tags', $product_id ) );

		$item_id = $product_id;
		$item_id = $this->get_product_content_id( $item_id );

		$sub_total = $product_obj->get_price();


		$sub_total       = $this->number_format( $sub_total );
		$item_added_data = [
			'currency'   => get_woocommerce_currency(),
			'user_role'  => WFACP_Common::get_current_user_role(),
			'value'      => $sub_total,
			'line_items' => [
				[
					'product_category' => $categories,
					'product_id'       => $item_id,
					'product_name'     => $product_obj->get_name(),
					'product_price'    => $sub_total,
					'product_quantity' => 1,
					'tags'             => $product_tags,
				]
			]
		];

		return $item_added_data;
	}

	public function remove_item( $product_obj, $cart_item ) {
		return $this->get_item( $product_obj, $cart_item );
	}


	public function get_checkout_data() {
		$output = new stdClass();
		if ( ! function_exists( 'WC' ) || is_null( WC()->cart ) ) {
			return $output;
		}

		$contents = WC()->cart->get_cart_contents();
		if ( empty( $contents ) ) {
			return $output;
		}

		$subtotal = $this->getWooCartTotal();
		$output   = [ 'line_items' => [] ];
		foreach ( $contents as $item ) {
			if ( $item['data'] instanceof WC_Product ) {
				$add_to_cart = $this->get_item( $item['data'], $item );
				if ( empty( $add_to_cart ) ) {
					continue;
				}
				unset( $add_to_cart['user_role'], $add_to_cart['currency'], $add_to_cart['value'], $add_to_cart['plugin'] );
				$output['line_items'][] = $add_to_cart['line_items'][0];
			}
		}
		$output['currency']  = get_woocommerce_currency();
		$output['value']     = $this->number_format( $subtotal );
		$output['num_items'] = count( $output['line_items'] );
		$output['plugin']    = 'WooFunnels Checkout';
		$output['subtotal']  = $this->number_format( WC()->cart->cart_contents_total );


		return $output;
	}


	public function get_add_to_cart_data() {
		if ( ! function_exists( 'WC' ) || is_null( WC()->cart ) ) {
			return [];
		}
		$contents = WC()->cart->get_cart_contents();
		if ( empty( $contents ) ) {
			return [];
		}
		$cart_data = [];
		foreach ( $contents as $item_key => $item ) {
			if ( ! $item['data'] instanceof WC_Product ) {
				continue;
			}
			$cart_data[] = $this->get_item( $item['data'], $item );
		}

		return $cart_data;
	}
	public function is_global_add_to_cart_enabled() {
		return wc_string_to_bool( $this->admin_general_settings->get_option( 'is_pint_add_to_cart_global' ));
	}

}
