<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Spicy multiunit dimension control
 * A base control for creating multiunit dimension control. Displays input fields with seprate unit for top,
 * right, bottom, left and the option to link them together.
 *
 * @since 1.0.0
 */
class spicy_multi_unit extends \Elementor\Control_Base_Multiple {

	/**
	 * Get multiunit dimensions control type.
	 *
	 * Retrieve the control type, in this case `dimensions`.
	 */
	public function get_type() {
		return 'spicy-multi-unit-control';
	}

	/**
	 * Get dimensions control default values.
	 */
	public function get_default_value() {
		return [
			'top' => '',
			'right' => '',
			'bottom' => '',
			'left' => '',
			'top_unit'=>'px',
			'right_unit' =>'px',
			'left_unit' =>'px',
			'bottom_unit' =>'px',
			'isLinked' => true,
		];
	}

	/**
	 * Get dimensions control default settings.
	 */
	protected function get_default_settings() {
		return [
			'size_units' => [ 'px' ],
			'label_block' => true,
			'range' => [
				'px' => [
					'min' => '',
					'max' => 100,
					'step' => 1,
				],
				'em' => [
					'min' => 0.1,
					'max' => 10,
					'step' => 0.1,
				],
				'rem' => [
					'min' => 0.1,
					'max' => 10,
					'step' => 0.1,
				],
				'%' => [
					'min' => 0,
					'max' => 100,
					'step' => 1,
				],
				'deg' => [
					'min' => 0,
					'max' => 360,
					'step' => 1,
				],
				'vh' => [
					'min' => 0,
					'max' => 100,
					'step' => 1,
				],
				'vw' => [
					'min' => 0,
					'max' => 100,
					'step' => 1,
				],
			],
		];
	}
	// add css and javascript files to control
	public function enqueue() {
		wp_enqueue_script( 'spicy_multi_unit',plugins_url( '/js/MultiUnit.js', __FILE__ ) );
		wp_enqueue_style( 'spicy_multi_unit' , plugins_url( '/css/MultiUnit.css', __FILE__ )  );

	} 
    // render gear and sublink 
	private function print_link_unit_template(){
		?>
			<# if ( data.size_units && data.size_units.length > 1 ) { #>
				<button class="spicy_linkAllUnit">
			 		<span class="spicy_link_first">
					 <i class="fa fa-gear" aria-hidden="true"></i>
					 <i class="spicy_link_tooltiptext">Sync Unit</i>
					</span>
					<div class="spicy_tooltip">
					 <# _.each( data.size_units, function( unit ) { #>
						<span class="spicy_link">{{{unit}}}</span>
					 <#});#>	
					</div>
				</button>  
			<#}#>
		<?php	
	}
	// render units
	private function print_units_template($arg){
		?>
			<# if ( data.size_units && data.size_units.length > 1 ) { #>
				<div class="spicy-units-choices">
					<# _.each( data.size_units, function( unit ) { 
						if(unit=='px' && data.range.px.step < 1){
						data.range.px.step=1;
						}
					#>
					<input id="spicy-choose-{{ data._cid + data.name + unit }}-<?php echo $arg ?>" type="radio" class="{{data.name}}" name="spicy-choose-{{data.name}}-<?php echo $arg ?>" data-setting="<?php echo $arg ?>_unit" value="{{ unit }}" /> 
					<label class="spicy-units-choices-label-<?php echo $arg ?>" data-cat="<?php echo $arg ?>_{{ data._cid }}" for="spicy-choose-{{ data._cid + data.name + unit }}-<?php echo $arg ?>">{{{ unit }}}</label>
					<# } ); #>
				</div>
			<# } #>
		<?php
	}
	
	/**
	 * Render dimensions control output in the editor.
	 */
	public function content_template() {
		
		$dimensions = [
			'top' => __( 'Top', 'Spicy-extension' ),
			'right' => __( 'Right', 'Spicy-extension' ),
			'bottom' => __( 'Bottom', 'Spicy-extension' ),
			'left' => __( 'Left', 'Spicy-extension' ),
		];
		?>
		<div class="elementor-control-field">
			<label class="elementor-control-title">{{{ data.label }}}</label>
			<div class="spicy-control-input-wrapper">
			<div class="units-wrapper">
				<div>	
					<ul>
						<?php
						foreach ( $dimensions as $dimension_key => $dimension_title ) : 
						echo '<li>';
							?>
								<# if ( -1 !== _.indexOf( allowed_dimensions, '<?php echo $dimension_key; ?>' ) ) { #>
									<?php
										$this->print_units_template($dimension_key );
									?>	
								<# } #>
							<?php			
						echo '</li>';
						endforeach;
						?>
					</ul>
				</div>	
			</div>
			
			<div>
				<ul class="spicy-control-dimensions">
					<?php
						foreach ( $dimensions as $dimension_key => $dimension_title ) :
							$control_uid = $this->get_control_uid( $dimension_key );
							?>
							<li class="spicy-control-multiunit">
								<# 
								var unit=data.controlValue[<?php echo "'". $dimension_key.'_unit'."'"; ?>]; 
								#>
								<input id="<?php echo $control_uid; ?>" type="number"  data-name="{{data.name}}-<?php echo esc_attr( $dimension_key ); ?>" min="{{ data.range[unit].min}}" max="{{ data.range[unit].max}}" step="{{ data.range[unit].step}}" data-setting="<?php echo esc_attr( $dimension_key ); ?>"
									placeholder="<#
								if ( _.isObject( data.placeholder ) ) {
									if ( ! _.isUndefined( data.placeholder.<?php echo $dimension_key; ?> ) ) {
										print( data.placeholder.<?php echo $dimension_key; ?> );
									}
								} else {
									print( data.placeholder );
								} #>"
								
								<# if ( -1 === _.indexOf( allowed_dimensions, '<?php echo $dimension_key; ?>' ) ) { #>
									disabled
									<# } #>							
										/>
								<label for="<?php echo esc_attr( $control_uid ); ?>" class="spicy-control-multiunit-label"><?php echo $dimension_title; ?></label>
							</li>
						<?php endforeach; ?> 
							<li>					
					   			<div style="display: flex;">
									<button class="spicy-link-dimensions tooltip-target" data-tooltip="<?php echo esc_attr__( 'Link values together', 'spicy' ); ?>">
										<span id="spisy-{{data.name}}" class="spicy-linked">
											<i class="fa fa-link" aria-hidden="true"></i>
										<span class="elementor-screen-only"><?php echo __( 'Link values together', 'spicy' ); ?></span>
										</span>
										<span id="spisy-{{data.name}}" class="spicy-unlinked">
											<i class="fa fa-chain-broken" aria-hidden="true"></i>
										<span class="elementor-screen-only"><?php echo __( 'Unlinked values', 'spicy' ); ?></span>
										</span>
									</button>
								<?php		
								$this->print_link_unit_template();   
								?> 
							</li>
				</ul>
			</div>
		</div>
		</div>
		<# if ( data.description ) { #>
		<div class="elementor-control-field-description">{{{ data.description }}}</div>
		<# } #>
		<?php
	}
}
