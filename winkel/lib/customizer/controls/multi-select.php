<?php

if( class_exists( 'WP_Customize_Control' ) && !class_exists( 'THMC_Multi_Select_Control' ) ):
	/**
	* 
	*/
	class THMC_Multi_Select_Control extends WP_Customize_Control
	{
		public $type = 'multi_select';
		
		public function render_content() {
			if (empty($this->choices)) {
				return;
			}

			if ( ! empty( $this->label ) ) : ?>
				<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
			<?php endif;
			if ( ! empty( $this->description ) ) : ?>
				<span class="description customize-control-description"><?php echo esc_html($this->description) ; ?></span>
			<?php endif; ?>
			<div class="thmc-multi-select clearfix">
				<select <?php $this->link(); ?> multiple>
				<?php foreach ($this->choices as $input_value => $input_title): ?>
					<option value="<?php echo esc_attr( $input_value ); ?>" <?php selected(in_array($input_value, $this->value())); ?>><?php echo esc_html( $input_title ); ?></option>
				<?php endforeach;?>
				</select>
			</div>
			<?php
		}
	}
endif;