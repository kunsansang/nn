<?php
/**
 * Customizer controls underscore.js template.
 *
 * @package     WFACPKirki
 * @subpackage  Controls
 * @copyright   Copyright (c) 2017, Aristeides Stathopoulos
 * @license     http://opensource.org/licenses/https://opensource.org/licenses/MIT
 * @since       3.0.17
 */
?>

<#
data = _.defaults( data, {
	label: '',
	description: '',
	mode: 'full',
	inputAttrs: '',
	'data-palette': data['data-palette'] ? data['data-palette'] : true,
	'data-default-color': data['data-default-color'] ? data['data-default-color'] : '',
	'data-alpha': data['data-alpha'] ? data['data-alpha'] : false,
	value: '',
	'data-id': ''
} );
#>

<div class="wfacpkirki-input-container" data-id="{{ data['data-id'] }}">
	<label>
		<# if ( data.label ) { #>
			<span class="customize-control-title">{{{ data.label }}}</span>
		<# } #>
		<# if ( data.description ) { #>
			<span class="description customize-control-description">{{{ data.description }}}</span>
		<# } #>

	</label>
	<input
		type="text"
		data-type="{{ data.mode }}"
		{{{ data.inputAttrs }}}
		data-palette="{{ data['data-palette'] }}"
		data-default-color="{{ data['data-default-color'] }}"
		data-alpha="{{ data['data-alpha'] }}"
		value="{{ data.value }}"
		class="wfacpkirki-color-control"
		data-id="{{ data['data-id'] }}"
	/>
</div>