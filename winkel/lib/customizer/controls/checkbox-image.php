<?php

if( class_exists( 'WP_Customize_Control' ) && !class_exists( 'THMC_Checkbox_Image_Control' ) ):
	/**
	* 
	*/
	class THMC_Checkbox_Image_Control extends WP_Customize_Control
	{
		public $type = 'checkbox_image';
		
		public function render_content() {
			if (empty($this->choices)) {
				return;
			}

			$name = '_customize-checkbox-image-' . $this->id;

			if ( ! empty( $this->label ) ) : ?>
				<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
			<?php endif;
			if ( ! empty( $this->description ) ) : ?>
				<span class="description customize-control-description"><?php echo esc_html($this->description) ; ?></span>
			<?php endif; ?>
			<div class="thmc-checkbox-images thmc-multi-checkbox clearfix">
				<?php foreach ($this->choices as $input_value => $img_src): ?>
					<div class="thmc-checkbox-image">
						<input type="checkbox" id="<?php echo esc_attr( $name.'_'.$input_value ); ?>" value="<?php echo esc_attr( $input_value ); ?>" <?php checked( in_array( $input_value, $this->value() ) ); ?>>
						<label for="<?php echo esc_attr( $name.'_'.$input_value ); ?>"><img src="<?php echo esc_attr( $img_src ); ?>" alt=""/></label>
					</div>
				<?php endforeach;?>
				<input type="hidden" value="<?php echo esc_attr( implode( ',', $this->value() ) ); ?>" <?php $this->link(); ?>>
			</div>
			<?php
		}
	}
endif;