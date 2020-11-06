<?php

if( class_exists( 'WP_Customize_Control' ) && !class_exists( 'THMC_Radio_Image_Control' ) ):
	/**
	* 
	*/
	class THMC_Radio_Image_Control extends WP_Customize_Control
	{
		public $type = 'radio_images';
		
		public function render_content() {
			if (empty($this->choices)) {
				return;
			}

			$name = '_customize-radio-image-' . $this->id;

			if ( ! empty( $this->label ) ) : ?>
				<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
			<?php endif;
			if ( ! empty( $this->description ) ) : ?>
				<span class="description customize-control-description"><?php echo esc_html($this->description) ; ?></span>
			<?php endif; ?>
			<div class="thmc-radio-images clearfix">
				<?php foreach ($this->choices as $input_value => $img_src): ?>
					<div class="thmc-radio-image">
						<input type="radio" id="<?php echo esc_attr( $name.'_'.$input_value ); ?>" name="<?php echo esc_attr( $name ); ?>" value="<?php echo esc_attr( $input_value ); ?>" <?php $this->link(); checked( $this->value(), $input_value ); ?>>
						<label for="<?php echo esc_attr( $name.'_'.$input_value ); ?>"><img src="<?php echo esc_attr( $img_src ); ?>" alt=""/></label>
					</div>
				<?php endforeach;?>
			</div>
			<?php
		}
	}
endif;