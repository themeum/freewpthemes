<?php
defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

class Bizness_Theme_License{

	private $api_end_point;
	private $theme_name;
	private $theme_version;

	public static function init() {
		return new self();
	}

	public function __construct() {
		$theme = wp_get_theme();
		$this->theme_name = strtolower($theme->get('Name'));
		$this->theme_version = $theme->get("Version");

	    $this->api_end_point = 'https://www.themeum.com/wp-json/themeum-license/v1/';

		add_action( 'admin_enqueue_scripts', array($this, 'license_page_asset_enquee') );
		add_action('admin_menu', array($this, 'add_license_page'), 20);
		add_action('admin_init', array($this, 'check_license_key'));

		add_filter( 'pre_set_site_transient_update_themes', array( $this, 'check_for_update' ) );
	}

	public function license_page_asset_enquee(){
		wp_enqueue_style('plugin-license-handler', BIZNESS_URI.'lib/license/license.css');
	}

	public function add_license_page(){
		global $submenu;
		add_submenu_page('bizness-options','License', 'License', 'manage_options', 'bizness-theme-license', array($this, 'license_form'));
		$submenu['bizness-options'][] = array( 'Bizness Docs', 'manage_options' , 'https://www.themeum.com/docs/bizness-introduction/');
		$submenu['bizness-options'][] = array( 'Bizness Support Forum', 'manage_options' , 'https://www.themeum.com/forums/forum/bizness/');
	}

	public function check_license_key(){
		if ( ! empty($_POST['thm_check_license_code'])){
			if ( ! check_admin_referer('thm_license_nonce')){
				return;
			}

			$blog = esc_url( get_option( 'home' ) );
			$key  = sanitize_text_field($_POST['bizness_license_key']);
			$unique_id = $_SERVER['REMOTE_ADDR'];

			$api_call = wp_remote_post( $this->api_end_point.'validator',
				array(
					'body'          => array(
						'blog_url'      => $blog,
						'license_key'   => $key,
						'action'        => 'check_license_key_api',
						'blog_ip'       => $unique_id,
						'request_from'  => 'plugin_license_page',
					),
				)
			);

			if ( is_wp_error( $api_call ) ) {
				//$error_message = $api_call->get_error_message();
				//echo "Something went wrong: $error_message";
			} else {
				$response_body = $api_call['body'];
				$response = json_decode($response_body);


				$response_msg = '';
				if ( ! empty($response->data->msg)){
					$response_msg = $response->data->msg;
				}
				if ($response->success){
					//Verified License
					$license_info = array(
						'activated'     => true,
						'license_key'   => $key,
						'license_to'    => $response->data->license_info->customer_name,
						'expires_at'    => $response->data->license_info->expires_at,
						'activated_at'  => $response->data->license_info->activated_at,
						'msg'  => $response_msg,
					);

					$license_info_serialize = serialize($license_info);
					update_option($this->theme_name.'_license_info', $license_info);
				}else{
					//License is invalid
					$license_info = array(
						'activated'     => false,
						'license_key'   => $key,
						'license_to'    => '',
						'expires_at'    => '',
						'msg'  => $response_msg,
					);

					$license_info_serialize = serialize($license_info);
					update_option($this->theme_name.'_license_info', $license_info);
				}

			}

		}
	}

	public function license_form(){
		?>

		<?php
		$license_key = '';
		$license_to = '';
		$license_activated = false;
		$license_info = (object) get_option($this->theme_name.'_license_info');
		if(! empty($license_info->license_key)){
			$license_key = $license_info->license_key;
		}
		if ( ! empty($license_info->license_to)){
			$license_to = $license_info->license_to;
		}
		if ( ! empty($license_info->activated)){
			$license_activated = $license_info->activated;
		}
		?>

		<div class="thm-license-head">
			<div class="thm-license-head__inside-container">
				<div class="thm-license-head__logo-container">
					<a href="https://themeum.com/?utm_source=plugin_license&utm_medium=top_menu_link&utm_campaign=activation_license" target="_blank"><img class="thm-license-head__logo" src="https://www.themeum
			.com/wp-content/themes/themeum/images/themeum.svg" /> </a>
				</div>

				<div class="thm-license-head__menu-container">
					<ul>
						<li><a href="https://www.themeum.com/?utm_source=plugin_license&utm_medium=top_menu_link&utm_campaign=activation_license" target="_blank">Home</a></li>
						<li> <a href="https://www.themeum.com/wordpress-themes/?utm_source=plugin_license&utm_medium=top_menu_link&utm_campaign=activation_license" target="_blank"> Themes</a></li>
						<li> <a href="https://www.themeum.com/wordpress-plugins/?utm_source=plugin_license&utm_medium=top_menu_link&utm_campaign=activation_license" target="_blank"> Plugins</a></li>
						<li>
							<a href="#">Support</a>
							<ul class="sub-menu">
								<li><a href="https://www.themeum.com/support/?utm_source=plugin_license&utm_medium=top_menu_link&utm_campaign=activation_license" target="_blank">Support Forum</a></li>
								<li><a href="https://www.themeum.com/about-us/?utm_source=plugin_license&utm_medium=top_menu_link&utm_campaign=activation_license" target="_blank">About us</a></li>
								<li><a href="https://www.themeum.com/docs/?utm_source=plugin_license&utm_medium=top_menu_link&utm_campaign=activation_license" target="_blank">Documentation</a></li>
								<li><a href="https://www.themeum.com/contact-us/?utm_source=plugin_license&utm_medium=top_menu_link&utm_campaign=activation_license" target="_blank">Contact Us</a></li>
								<li><a href="https://www.themeum.com/faq/?utm_source=plugin_license&utm_medium=top_menu_link&utm_campaign=activation_license" target="_blank">FAQ</a></li>
							</ul>
						</li>
						<li><a href="https://www.themeum.com/blog/?utm_source=plugin_license&utm_medium=top_menu_link&utm_campaign=activation_license" target="_blank">Blog</a></li>
					</ul>
				</div>

			</div>
		</div>

		<div class="themeum-lower">
			<div class="themeum-box themeum-box-<?php echo $license_activated ? 'success':'error'; ?>">
				<?php if ($license_activated){
					?>
					<h3> <i class="dashicons-before dashicons-thumbs-up"></i> Your license is connected with Themeum.com</h3>
					<p><i class="dashicons-before dashicons-tickets-alt"></i> Licensed To : <?php echo $license_to; ?> </p>
					<?php
				}else{
					?>
					<h3> <i class="dashicons-before dashicons-warning"></i> Valid license required</h3>
					<p><i class="dashicons-before dashicons-tickets-alt"></i> A valid license is required to unlock available features </p>
					<?php
				}

				if ( ! empty($license_info->msg)){
					echo "<p> <i class='dashicons-before dashicons-admin-comments'></i> {$license_info->msg}</p>";
				}
				?>
			</div>


			<div class="themeum-boxes">
				<div class="themeum-box">
					<h3>Power Up your Theme and Get automatic Update</h3>
					<div class="themeum-right">
						<a href="https://themeum.com" class="themeum-button themeum-is-primary" target="_blank"> Get License Key</a>
					</div>
					<p> Please enter your license key. An active license key is needed for automatic theme updates and <a href="https://www.themeum.com/support/" target="_blank">support</a>.</p>
				</div>
				<div class="themeum-box">
					<h3>Enter License Key</h3>
					<p>Already have your key? Enter it here. </p>
					<form action="" method="post">
						<?php wp_nonce_field('thm_license_nonce'); ?>
						<input type="hidden" name="thm_check_license_code" value="checking" />
						<p style="width: 100%; display: flex; flex-wrap: nowrap; box-sizing: border-box;">
							<input id="bizness_license_key" name="bizness_license_key" size="15" value="" class="regular-text code" style="flex-grow: 1; margin-right: 1rem;" type="text" placeholder="Enter your license key here" />

							<input name="submit" id="submit" class="themeum-button" value="Connect with License key" type="submit">
						</p>
					</form>
				</div>
			</div>
		</div>

		<?php
	}

	/**
	 * @return array|bool|mixed|object
     *
     * Get update information
	 */
	public function check_for_update_api($request_from = ''){
		// Plugin update
		$license_info = (object) get_option($this->theme_name.'_license_info');
		if (empty($license_info->activated) || ! $license_info->activated || empty($license_info->license_key) ){
			return false;
		}

		$params = array(
			'body' => array(
				'action'       => 'check_update_by_license',
				'license_key'  => $license_info->license_key,
				'product_slug'  => $this->theme_name,
				'request_from'  => $request_from,
			),
		);

		// Make the POST request
		$request = wp_remote_post($this->api_end_point.'check-update', $params );

		$request_body = false;
		// Check if response is valid
		if ( !is_wp_error( $request ) || wp_remote_retrieve_response_code( $request ) === 200 ) {
			$request_body = json_decode($request['body']);

			if ( !$request_body->success){
				$license_info = (array) $license_info;
				$license_info['activated'] = 0;
				update_option($this->theme_name.'_license_info', $license_info);
			}
		}

		return $request_body;
    }

	/**
	 * @param $transient
	 *
	 * @return mixed
	 */
	public function check_for_update($transient){
		if( empty( $transient->checked[$this->theme_name] ) ){
			return $transient;
		}

		$request_body = $this->check_for_update_api('update_check');

		if ($request_body && $request_body->success){
			if ( version_compare( $this->theme_version, $request_body->data->version, '<' ) ) {
				$transient->response[$this->theme_name] = array(
					'new_version'   => $request_body->data->version,
					'package'       => $request_body->data->download_url,
					'url'       => $request_body->data->url,
				);

			}
        }
		return $transient;
	}

}


Bizness_Theme_License::init();
