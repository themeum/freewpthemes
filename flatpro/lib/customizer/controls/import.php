<?php

if( class_exists( 'WP_Customize_Control' ) && !class_exists( 'THMC_Import_Control' ) ):
	/**
	* 
	*/
	class THMC_Import_Control extends WP_Customize_Control
	{
		public $type = 'export';
		
		public function render_content() {

			$name = '_customize-export-button-' . $this->id;

			if ( ! empty( $this->label ) ) : ?>
				<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
			<?php endif; ?>
			<input type="file" id="tmm-import-data-file">
			<button type="button" id="tmm-import-data" class="button"><?php esc_html_e('Import', 'flatpro'); ?></button>
			<div class="thm-import-status" id="thm-import-status"></div>
			<?php
		}
	}
endif;