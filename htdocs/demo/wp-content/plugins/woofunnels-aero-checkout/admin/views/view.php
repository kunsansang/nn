<?php
defined( 'ABSPATH' ) || exit;

/**
 * @var $this WFACP_admin
 */
$wfacp_id      = WFACP_Common::get_id();
$wfacp_section = WFACP_Common::get_current_step();
$wfacp_post    = get_post( $wfacp_id );

$localize_data = $this->get_localize_data();

$selected_design = $localize_data['design']['selected_type'];

if ( is_null( $wfacp_post ) ) {
	return;
}
$steps           = WFACP_Common::get_admin_menu();
$products        = WFACP_Common::get_page_product( WFACP_Common::get_id() );
$localize_data   = $this->get_localize_data();
$template_is_set = get_post_meta( $this->wfacp_id, '_wfacp_selected_design' );

$preview_url = get_the_permalink( $wfacp_id );


$box_size_class = ( isset( $_GET['wffn_funnel_ref'] ) ) ? 'wfacp_bread' : '';

$header_nav_data = array();
foreach ( $steps as $step ) {
	$href = BWF_Admin_Breadcrumbs::maybe_add_refs( add_query_arg( [
		'page'     => 'wfacp',
		'wfacp_id' => $wfacp_id,
		'section'  => $step['slug'],
	], admin_url( 'admin.php' ) ) );

	$header_nav_data[ $step['slug'] ] = array(
		'name' => $step['name'],
		'link' => $href,
	);
}
$funnel_status = $wfacp_post->post_status;
if ( class_exists( 'WFFN_Header' ) ) {
	$header_ins = new WFFN_Header();
	$header_ins->set_level_1_navigation_active( 'funnels' );

	ob_start();
	?>
    <div class="wffn-ellipsis-menu">
        <div class="wffn-menu__toggle">
            <span class="bwfan-tag-rounded bwfan_ml_12 <?php echo 'publish' == $funnel_status ? 'clr-green' : 'clr-orange'; ?>">
                <span class="bwfan-funnel-status"><?php echo 'publish' == $funnel_status ? 'Published' : 'Draft'; ?></span>
                
                <?php echo file_get_contents( plugin_dir_path( WFACP_PLUGIN_FILE ) . 'admin/assets/img/icons/arrow-down.svg' ); //phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
            </span>
        </div>
        <div class="wffn-ellipsis-menu-dropdown">
            <a data-izimodal-open="#modal-checkout-page" data-iziModal-title="New Checkout page" data-izimodal-transitionin="fadeInDown" href="javascript:void(0);" class="bwf_edt wffn-ellipsis-menu-item"><?php esc_html_e( 'Edit' ) ?></a>
            <a href="<?php echo $preview_url; ?>" target="_blank" class="wffn-step-preview wffn-step-preview-admin wffn-ellipsis-menu-item"><?php esc_html_e( 'Preview' ) ?></a>
            <div class="wf_funnel_card_switch">
                <label class="funnel_state_toggle wfacp_toggle_btn wffn-ellipsis-menu-item">
                    <span class="bwfan-status-toggle"><?php echo 'publish' == $funnel_status ? 'Draft' : 'Publish'; ?></span>
                    <input name="offer_state" id="state_<?php echo $wfacp_id; ?>" data-id="<?php echo $wfacp_id; ?>" type="checkbox" class="wfacp-tgl wfacp-tgl-ios wfacp_checkout_page_status" <?php echo( $wfacp_post->post_status == 'publish' ? 'checked="checked"' : '' ); ?>>
                </label>
            </div>
        </div>
    </div>
    <?php
    $funnel_actions = ob_get_contents();
    ob_end_clean();

    $get_header_data = BWF_Admin_Breadcrumbs::render_top_bar(true);
    if( is_array( $get_header_data ) ) {
        $data_count      = count($get_header_data);
        $page_title_data = $get_header_data[ $data_count - 1 ];
        $back_link_data  = $get_header_data[ $data_count - 2 ];
        $page_title      = $page_title_data['text'] ?? esc_html( 'Funnels' );
        $back_link       = $back_link_data['link'] ?? '#';

        if( version_compare( WFFN_VERSION, '2.0.0 beta', '>=' ) ) {
            $header_ins->set_page_back_link( $back_link );
            $header_ins->set_page_heading( "$page_title" );
            $header_ins->set_page_heading_meta($funnel_actions);
        } else {
            $header_ins->set_level_2_post_title($funnel_actions);
        }
    }

	$header_ins->set_level_2_side_navigation( $header_nav_data ); //set header 2nd level navigation
	$header_ins->set_level_2_side_navigation_active( $wfacp_section ); // active navigation

	echo $header_ins->render();
} else {
	BWF_Admin_Breadcrumbs::render_sticky_bar();
}

?>
<div class="wfacp_body wfacp_funnels" id="wfacp_control" data-id="<?php echo $wfacp_id; ?>" data-template-set="<?php echo empty( $template_is_set ) ? 'yes' : '' ?>">
    <div id="poststuff">
        <div class="wfacp_inside">
			<?php if ( ! class_exists( 'WFFN_Header' ) ) : ?>
                <div class="wfacp_fixed_header">
                    <div class="wfacp_box_size <?php echo $box_size_class; ?>">
                        <div class="wfacp_head_m wfacp_tl">
                            <div class="wfacp_head_mr" data-status="live">
                                <div class="funnel_state_toggle wfacp_toggle_btn">
                                    <input name="offer_state" id="state_<?php echo $wfacp_id; ?>" data-id="<?php echo $wfacp_id; ?>" type="checkbox" class="wfacp-tgl wfacp-tgl-ios wfacp_checkout_page_status" <?php echo( $wfacp_post->post_status == 'publish' ? 'checked="checked"' : '' ); ?>>
                                    <label for="state_<?php echo $wfacp_id; ?>" class="wfacp-tgl-btn wfacp-tgl-btn-small"></label>
                                </div>
                            </div>
                            <div class="wfacp_head_ml">
								<?php BWF_Admin_Breadcrumbs::render(); ?>
                                <a href="javascript:void(0)" data-izimodal-open="#modal-checkout-page" data-iziModal-title="New Checkout page" data-izimodal-transitionin="fadeInDown">
                                    <span class="dashicons dashicons-edit"></span>
                                    <span><?php _e( 'Edit', 'wordpress' ) ?></span>
                                </a>
                                <a href="<?php echo $preview_url; ?>" target="_blank" class="wfacp-preview wfacp-preview-admin">
                                    <i class="dashicons dashicons-visibility wfacp-dash-eye"></i>
                                    <span class="preview_text"><?php _e( 'View', 'wordpress' ) ?></span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bwf_menu_list_primary">
                    <ul>
						<?php
						foreach ( $steps as $step ) {
							$href = BWF_Admin_Breadcrumbs::maybe_add_refs( add_query_arg( [
								'page'     => 'wfacp',
								'wfacp_id' => $wfacp_id,
								'section'  => $step['slug'],
							], admin_url( 'admin.php' ) ) );
							?>
                            <li class="<?php echo( $step['slug'] == $wfacp_section ? 'active' : '' ); ?>">
                                <a data-slug="<?php echo $step['slug']; ?>" href="<?php echo $href; ?>">
									<?php echo $step['name']; ?>
                                </a>
                            </li>
							<?php
						}
						?>
                    </ul>
                </div>
			<?php endif; ?>

            <div class="wfacp_wrap wfacp_box_size <?php echo $wfacp_section; ?>">
                <div class="wfacp_loader"><span class="spinner"></span></div>
				<?php include_once $this->current_section; ?>
				<?php include_once __DIR__ . '/global/model.php'; ?>
            </div>
        </div>
    </div>
</div>
