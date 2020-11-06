<?php

if( class_exists( 'WP_Customize_Control' ) && !class_exists( 'THMC_Color_Palette_Control' ) ):
	/**
	* 
	*/
	class THMC_Color_Palette_Control extends WP_Customize_Control
	{
		public $type = 'color_palette';
		
		public function render_content() {
			if (empty($this->choices)) {
				return;
			}

			$name = '_customize-color-palette-' . $this->id;

			if ( ! empty( $this->label ) ) : ?>
				<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
			<?php endif;
			if ( ! empty( $this->description ) ) : ?>
				<span class="description customize-control-description"><?php echo esc_html($this->description) ; ?></span>
			<?php endif; ?>
			<div class="thmc-color-palettes clearfix">
				<?php foreach ($this->choices as $input_value => $colors): ?>
					<div class="thmc-color-palette">
						<input type="radio" id="<?php echo esc_attr( $name.'_'.$input_value ); ?>" name="<?php echo esc_attr( $name ); ?>" value="<?php echo esc_attr( $input_value ); ?>" <?php $this->link(); checked( $this->value(), $input_value ); ?>>
						<label for="<?php echo esc_attr( $name.'_'.$input_value ); ?>">
							<?php
							foreach ($colors as $color) {
								?>
								<span style="background-color:<?php echo esc_attr($color); ?>;"></span>
								<?php
							}
							?>
						</label>
					</div>
				<?php endforeach;?>
			</div>
			<?php
		}
	}
endif;