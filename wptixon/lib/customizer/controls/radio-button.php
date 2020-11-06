<?php

if( class_exists( 'WP_Customize_Control' ) && !class_exists( 'THMC_Radio_Button_Control' ) ):
	/**
	* 
	*/
	class THMC_Radio_Button_Control extends WP_Customize_Control
	{
		public $type = 'radio_button';
		
		public function render_content() {
			if (empty($this->choices)) {
				return;
			}

			$name = '_customize-radio-button-' . $this->id;

			if ( ! empty( $this->label ) ) : ?>
				<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
			<?php endif;
			if ( ! empty( $this->description ) ) : ?>
				<span class="description customize-control-description"><?php echo esc_html($this->description) ; ?></span>
			<?php endif; ?>
			<div class="thmc-radio-buttons clearfix">
				<?php foreach ($this->choices as $input_value => $input_title): ?>
					<div class="thmc-radio-button">
						<input type="radio" id="<?php echo esc_attr( $name.'_'.$input_value ); ?>" name="<?php echo esc_attr( $name ); ?>" value="<?php echo esc_attr( $input_value ); ?>" <?php $this->link(); checked( $this->value(), $input_value ); ?>>
						<label for="<?php echo esc_attr( $name.'_'.$input_value ); ?>"><?php echo esc_attr( $input_title ); ?></label>
					</div>
				<?php endforeach;?>
			</div>
			<?php
		}
	}
endif;