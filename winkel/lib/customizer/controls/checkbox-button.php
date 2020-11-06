<?php

if( class_exists( 'WP_Customize_Control' ) && !class_exists( 'THMC_Checkbox_Button_Control' ) ):
	/**
	* 
	*/
	class THMC_Checkbox_Button_Control extends WP_Customize_Control
	{
		public $type = 'checkbox_button';
		
		public function render_content() {
			if (empty($this->choices)) {
				return;
			}


			$name = '_customize-checkbox-button-' . $this->id;

			if ( ! empty( $this->label ) ) : ?>
				<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
			<?php endif;
			if ( ! empty( $this->description ) ) : ?>
				<span class="description customize-control-description"><?php echo esc_html($this->description) ; ?></span>
			<?php endif; ?>
			<div class="thmc-checkbox-buttons thmc-multi-checkbox clearfix">
				<?php foreach ($this->choices as $input_value => $input_title): ?>
					<div class="thmc-checkbox-button">
						<input type="checkbox" id="<?php echo esc_attr( $name.'_'.$input_value ); ?>" value="<?php echo esc_attr( $input_value ); ?>" <?php checked( in_array( $input_value, $this->value() ) ); ?>>
						<label for="<?php echo esc_attr( $name.'_'.$input_value ); ?>"><?php echo esc_attr( $input_title ); ?></label>
					</div>
				<?php endforeach;?>
				
			</div>
			<input type="hidden" value="<?php echo esc_attr( implode( ',', $this->value() ) ); ?>" <?php $this->link(); ?>>
			<?php
		}
	}
endif;