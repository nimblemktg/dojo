<?php

/**
 * Gravity Forms 2Checkout Add-On.
 *
 * @since     1.0
 * @package   GravityForms
 * @author    Rocketgenius
 * @copyright Copyright (c) 2018, Rocketgenius
 */

defined( 'ABSPATH' ) or die();

// Include the Payment Add-On framework.
GFForms::include_payment_addon_framework();

/**
 * Class GF_2Checkout
 *
 * Primary class to manage the 2Checkout Add-On.
 *
 * @since 1.0
 *
 * @uses GFPaymentAddOn
 */
class GF_2Checkout extends GFPaymentAddOn {

	/**
	 * Contains an instance of this class, if available.
	 *
	 * @since  1.0
	 * @access private
	 *
	 * @used-by GF_2Checkout::get_instance()
	 *
	 * @var object $_instance If available, contains an instance of this class.
	 */
	private static $_instance = null;

	/**
	 * Defines the version of the 2Checkout Add-On.
	 *
	 * @since  1.0
	 * @access protected
	 *
	 * @used-by GF_2Checkout::scripts()
	 *
	 * @var string $_version Contains the version, defined from 2checkout.php
	 */
	protected $_version = GF_2CHECKOUT_VERSION;

	/**
	 * Defines the minimum Gravity Forms version required.
	 *
	 * @since  1.0
	 * @access protected
	 *
	 * @var string $_min_gravityforms_version The minimum version required.
	 */
	protected $_min_gravityforms_version = '2.2';

	/**
	 * Defines the plugin slug.
	 *
	 * @since  1.0
	 * @access protected
	 *
	 * @var string $_slug The slug used for this plugin.
	 */
	protected $_slug = 'gravityforms2checkout';

	/**
	 * Defines the main plugin file.
	 *
	 * @since  1.0
	 * @access protected
	 *
	 * @var string $_path The path to the main plugin file, relative to the plugins folder.
	 */
	protected $_path = 'gravityforms2checkout/2checkout.php';

	/**
	 * Defines the full path to this class file.
	 *
	 * @since  1.0
	 * @access protected
	 *
	 * @var string $_full_path The full path.
	 */
	protected $_full_path = __FILE__;

	/**
	 * Defines the URL where this Add-On can be found.
	 *
	 * @since  1.0
	 * @access protected
	 *
	 * @var string $_url The URL of the Add-On.
	 */
	protected $_url = 'http://www.gravityforms.com';

	/**
	 * Defines the title of this Add-On.
	 *
	 * @since  1.0
	 * @access protected
	 *
	 * @var string $_title The title of the Add-On.
	 */
	protected $_title = 'Gravity Forms 2Checkout Add-On';

	/**
	 * Defines the short title of the Add-On.
	 *
	 * @since  1.0
	 * @access protected
	 *
	 * @var string $_short_title The short title.
	 */
	protected $_short_title = '2Checkout';

	/**
	 * Defines if Add-On should use Gravity Forms servers for update data.
	 *
	 * @since  1.0
	 * @access protected
	 *
	 * @var bool $_enable_rg_autoupgrade true
	 */
	protected $_enable_rg_autoupgrade = true;

	/**
	 * Defines if user will not be able to create feeds for a form until a credit card field has been added.
	 *
	 * @since  1.0
	 * @access protected
	 *
	 * @var bool $_requires_credit_card true.
	 */
	protected $_requires_credit_card = true;

	/**
	 * Defines the capability needed to access the Add-On settings page.
	 *
	 * @since  1.4.3
	 * @access protected
	 * @var    string $_capabilities_settings_page The capability needed to access the Add-On settings page.
	 */
	protected $_capabilities_settings_page = 'gravityforms_2checkout';

	/**
	 * Defines the capability needed to access the Add-On form settings page.
	 *
	 * @since  1.4.3
	 * @access protected
	 * @var    string $_capabilities_form_settings The capability needed to access the Add-On form settings page.
	 */
	protected $_capabilities_form_settings = 'gravityforms_2checkout';

	/**
	 * Defines the capability needed to uninstall the Add-On.
	 *
	 * @since  1.4.3
	 * @access protected
	 * @var    string $_capabilities_uninstall The capability needed to uninstall the Add-On.
	 */
	protected $_capabilities_uninstall = 'gravityforms_2checkout_uninstall';

	/**
	 * Defines the capabilities needed for the 2Checkout Add-On
	 *
	 * @since  1.0
	 * @access protected
	 * @var    array $_capabilities The capabilities needed for the Add-On
	 */
	protected $_capabilities = array( 'gravityforms_2checkout', 'gravityforms_2checkout_uninstall' );

	/**
	 * Contains an instance of the 2Checkout API library, if available.
	 *
	 * @since  1.0
	 * @access protected
	 * @var    GF_2Checkout_API[] $api If available, contains an instance of the 2Checkout API library.
	 */
	protected $api = array();

	/**
	 * Get an instance of this class.
	 *
	 * @since  1.0
	 * @access public
	 *
	 * @uses GF_2Checkout::$_instance
	 *
	 * @return GF_2Checkout
	 */
	public static function get_instance() {

		if ( null === self::$_instance ) {
			self::$_instance = new self;
		}

		return self::$_instance;

	}

	/**
	 * Initialize the frontend hooks.
	 *
	 * @since  1.0
	 * @access public
	 *
	 * @uses GF_2Checkout::register_init_scripts()
	 * @uses GF_2Checkout::add_2checkout_inputs()
	 * @uses GF_2Checkout::populate_credit_card_last_four()
	 * @uses GFPaymentAddOn::init()
	 *
	 * @return void
	 */
	public function init() {

		add_filter( 'gform_field_content', array( $this, 'add_2checkout_inputs' ), 10, 5 );
		add_filter( 'gform_register_init_scripts', array( $this, 'register_init_scripts' ), 10, 3 );
		add_action( 'gform_pre_submission', array( $this, 'populate_credit_card_last_four' ) );

		parent::init();

	}

	/**
	 * Return the scripts which should be enqueued.
	 *
	 * @since  1.0
	 * @access public
	 *
	 * @uses   GF_2Checkout::frontend_script_callback()
	 * @uses   GFAddOn::get_base_url()
	 * @uses   GFAddOn::get_short_title()
	 * @uses   GFAddOn::get_version()
	 * @uses   GFCommon::get_base_url()
	 * @uses   GFPaymentAddOn::scripts()
	 *
	 * @return array
	 */
	public function scripts() {

		$scripts = array(
			array(
				'handle'  => '2co.js',
				'src'     => 'https://www.2checkout.com/checkout/api/2co.min.js',
				'version' => $this->get_version(),
				'deps'    => array(),
			),
			array(
				'handle'    => 'gform_2checkout_frontend',
				'src'       => $this->get_base_url() . '/js/frontend.js',
				'version'   => $this->get_version(),
				'deps'      => array( 'jquery', '2co.js' ),
				'in_footer' => false,
				'enqueue'   => array(
					array( $this, 'frontend_script_callback' ),
				),
			),
		);

		return array_merge( parent::scripts(), $scripts );

	}

	/**
	 * Check if the form has an active 2Checkout feed and a credit card field.
	 *
	 * @since  1.0
	 * @access public
	 *
	 * @used-by GF_2Checkout::scripts()
	 * @uses    GFFeedAddOn::has_feed()
	 * @uses    GFPaymentAddOn::has_credit_card_field()
	 *
	 * @param array $form The form currently being processed.
	 *
	 * @return bool
	 */
	public function frontend_script_callback( $form ) {

		return $form && $this->has_feed( $form['id'] ) && $this->has_credit_card_field( $form );

	}





	// # PLUGIN SETTINGS -----------------------------------------------------------------------------------------------

	/**
	 * Prepare plugin settings fields.
	 *
	 * @since  1.0
	 * @access public
	 *
	 * @uses   GF_2Checkout::initialize_api()
	 *
	 * @return array
	 */
	public function plugin_settings_fields() {

		return array(
			array(
				'fields' => array(
					array(
						'name'          => 'apiMode',
						'label'         => esc_html__( 'API Mode', 'gravityforms2checkout' ),
						'type'          => 'radio',
						'required'      => true,
						'horizontal'    => true,
						'default_value' => 'sandbox',
						'choices'       => array(
							array(
								'label' => esc_html__( 'Production', 'gravityforms2checkout' ),
								'value' => 'production',
							),
							array(
								'label' => esc_html__( 'Sandbox', 'gravityforms2checkout' ),
								'value' => 'sandbox',
							),
						),
					),
				),
			),
			array(
				'title'  => esc_html__( 'Production Credentials', 'gravityforms2checkout' ),
				'fields' => array(
					array(
						'name'  => 'production[sellerId]',
						'label' => esc_html__( 'Account Number', 'gravityforms2checkout' ),
						'type'  => 'text',
						'class' => 'medium',
					),
					array(
						'name'  => 'production[publishableKey]',
						'label' => esc_html__( 'Publishable Key', 'gravityforms2checkout' ),
						'type'  => 'text',
						'class' => 'medium',
					),
					array(
						'name'              => 'production[privateKey]',
						'label'             => esc_html__( 'Private Key', 'gravityforms2checkout' ),
						'type'              => 'text',
						'class'             => 'medium',
						'input_type'        => $this->initialize_api( 'production' ) ? 'password' : 'text',
						'feedback_callback' => array( $this, 'validate_production_credentials' ),
					),
					array(
						'name'              => 'production[username]',
						'label'             => esc_html__( 'Username', 'gravityforms2checkout' ),
						'type'              => 'text',
						'class'             => 'medium',
						'feedback_callback' => array( $this, 'validate_production_credentials' ),
					),
					array(
						'name'              => 'production[password]',
						'label'             => esc_html__( 'Password', 'gravityforms2checkout' ),
						'type'              => 'text',
						'class'             => 'medium',
						'input_type'        => $this->initialize_api( 'production' ) ? 'password' : 'text',
						'feedback_callback' => array( $this, 'validate_production_credentials' ),
					),
				),
			),
			array(
				'title'  => esc_html__( 'Sandbox Credentials', 'gravityforms2checkout' ),
				'fields' => array(
					array(
						'name'  => 'sandbox[sellerId]',
						'label' => esc_html__( 'Account Number', 'gravityforms2checkout' ),
						'type'  => 'text',
						'class' => 'medium',
					),
					array(
						'name'  => 'sandbox[publishableKey]',
						'label' => esc_html__( 'Publishable Key', 'gravityforms2checkout' ),
						'type'  => 'text',
						'class' => 'medium',
					),
					array(
						'name'              => 'sandbox[privateKey]',
						'label'             => esc_html__( 'Private Key', 'gravityforms2checkout' ),
						'type'              => 'text',
						'class'             => 'medium',
						'input_type'        => $this->initialize_api( 'sandbox' ) ? 'password' : 'text',
						'feedback_callback' => array( $this, 'validate_sandbox_credentials' ),
					),
					array(
						'name'              => 'sandbox[username]',
						'label'             => esc_html__( 'Username', 'gravityforms2checkout' ),
						'type'              => 'text',
						'class'             => 'medium',
						'feedback_callback' => array( $this, 'validate_sandbox_credentials' ),
					),
					array(
						'name'              => 'sandbox[password]',
						'label'             => esc_html__( 'Password', 'gravityforms2checkout' ),
						'type'              => 'text',
						'class'             => 'medium',
						'input_type'        => $this->initialize_api( 'sandbox' ) ? 'password' : 'text',
						'feedback_callback' => array( $this, 'validate_sandbox_credentials' ),
					),
				),
			),
		);

	}

	/**
	 * Validate production API credentials.
	 *
	 * @since   1.0
	 * @access  public
	 *
	 * @used-by GF_2Checkout::plugin_settings_fields()
	 * @uses    GF_2Checkout::initialize_api()
	 *
	 * @return bool|null
	 */
	public function validate_production_credentials() {

		// Capture API response.
		$api_response = $this->initialize_api( 'production' );

		return is_a( $api_response, 'GF_2Checkout_API' ) ? true : $api_response;

	}

	/**
	 * Validate sandbox API credentials.
	 *
	 * @since   1.0
	 * @access  public
	 *
	 * @used-by GF_2Checkout::plugin_settings_fields()
	 * @uses    GF_2Checkout::initialize_api()
	 *
	 * @return bool|null
	 */
	public function validate_sandbox_credentials() {

		// Capture API response.
		$api_response = $this->initialize_api( 'sandbox' );

		return is_a( $api_response, 'GF_2Checkout_API' ) ? true : $api_response;

	}





	// # FEED SETTINGS -------------------------------------------------------------------------------------------------

	/**
	 * Set feed creation control.
	 *
	 * @since  1.0
	 * @access public
	 *
	 * @uses   GF_2Checkout::initialize_api()
	 *
	 * @return bool
	 */
	public function can_create_feed() {

		return is_a( $this->initialize_api(), 'GF_2Checkout_API' );

	}

	/**
	 * Setup fields for feed settings.
	 *
	 * @since  1.0
	 * @access public
	 *
	 * @uses   GFAddOn::remove_field()
	 * @uses   GFFeedAddOn::feed_settings_fields()
	 *
	 * @return array $settings
	 */
	public function feed_settings_fields() {

		// Get feed settings fields.
		$settings = parent::feed_settings_fields();

		// Remove trial field.
		$settings = $this->remove_field( 'trial', $settings );

		return $settings;

	}

	/**
	 * Prepare a list of needed billing information fields.
	 *
	 * @since  1.0
	 * @access public
	 *
	 * @return array
	 */
	public function billing_info_fields() {

		$fields = array(
			array( 'name' => 'email',    'label' => esc_html__( 'Email', 'gravityforms2checkout' ),        'required' => true ),
			array( 'name' => 'address',  'label' => esc_html__( 'Address', 'gravityforms2checkout' ),      'required' => true ),
			array( 'name' => 'address2', 'label' => esc_html__( 'Address 2', 'gravityforms2checkout' ),    'required' => false ),
			array( 'name' => 'city',     'label' => esc_html__( 'City', 'gravityforms2checkout' ),         'required' => true ),
			array( 'name' => 'state',    'label' => esc_html__( 'State', 'gravityforms2checkout' ),        'required' => true ),
			array( 'name' => 'zip',      'label' => esc_html__( 'Zip', 'gravityforms2checkout' ),          'required' => true ),
			array( 'name' => 'country',  'label' => esc_html__( 'Country', 'gravityforms2checkout' ),      'required' => true ),
			array( 'name' => 'phone',    'label' => esc_html__( 'Phone Number', 'gravityforms2checkout' ), 'required' => true ),
		);

		return $fields;

	}

	/**
	 * Define the choices available in the billing cycle drop downs.
	 *
	 * @since   1.0
	 * @access  public
	 *
	 * @used-by GFPaymentAddOn::settings_billing_cycle()
	 *
	 * @return array
	 */
	public function supported_billing_intervals() {

		return array(
			'week'  => array( 'label' => esc_html__( 'week(s)', 'gravityforms2checkout' ), 'min' => 1, 'max' => 12 ),
			'month' => array( 'label' => esc_html__( 'month(s)', 'gravityforms2checkout' ), 'min' => 1, 'max' => 12 ),
			'year'  => array( 'label' => esc_html__( 'year(s)', 'gravityforms2checkout' ), 'min' => 1, 'max' => 1 ),
		);

	}

	/**
	 * Define the option choices available.
	 *
	 * @since   1.0
	 * @access  public
	 *
	 * @used-by GFPaymentAddOn::other_settings_fields()
	 *
	 * @return array
	 */
	public function option_choices() {

		return array();

	}





	// # FRONTEND ------------------------------------------------------------------------------------------------------

	/**
	 * Register 2Checkout script when displaying form.
	 *
	 * @since   1.0
	 * @access  public
	 *
	 * @param array $form         Form object.
	 * @param array $field_values Current field values. Not used.
	 * @param bool  $is_ajax      If form is being submitted via AJAX.
	 *
	 * @used-by GF_2Checkout::init()
	 * @uses    GFAddOn::get_plugin_settings()
	 * @uses    GFFeedAddOn::has_feed()
	 * @uses    GFFormDisplay::add_init_script()
	 * @uses    GFFormDisplay::ON_PAGE_RENDER
	 * @uses    GFPaymentAddOn::get_credit_card_field()
	 */
	public function register_init_scripts( $form, $field_values, $is_ajax ) {

		// Get credit card field.
		$cc_field = $this->get_credit_card_field( $form );

		// If form does not have a 2Checkout feed and does not have a credit card field, exit.
		if ( ! $this->has_feed( $form['id'] ) || ! $cc_field || ! $this->initialize_api() ) {
			return;
		}

		// Get plugin settings.
		$settings = $this->get_plugin_settings();

		// Prepare 2Checkout Javascript arguments.
		$args = array(
			'apiMode'        => $settings['apiMode'],
			'sellerId'       => $settings[ $settings['apiMode'] ]['sellerId'],
			'publishableKey' => $settings[ $settings['apiMode'] ]['publishableKey'],
			'formId'         => $form['id'],
			'ccFieldId'      => $cc_field->id,
			'ccPage'         => $cc_field->pageNumber,
			'isAjax'         => $is_ajax,
		);

		// Initialize 2Checkout script.
		$script = 'new GF2Checkout( ' . json_encode( $args ) . ' );';

		// Add 2Checkout script to form scripts.
		GFFormDisplay::add_init_script( $form['id'], '2checkout', GFFormDisplay::ON_PAGE_RENDER, $script );

	}

	/**
	 * Add required 2Checkout inputs to form.
	 *
	 * @since   1.0
	 * @access  public
	 *
	 * @param string $content  The field content to be filtered.
	 * @param object $field    The field that this input tag applies to.
	 * @param string $value    The default/initial value that the field should be pre-populated with.
	 * @param int    $entry_id When executed from the entry detail screen, $entry_id will be populated with the Entry ID.
	 * @param int    $form_id  The current Form ID.
	 *
	 * @used-by GF_2Checkout::init()
	 * @uses    GFFeedAddOn::has_feed()
	 * @uses    GF_2Checkout::get_2checkout_js_response()
	 *
	 * @return string
	 */
	public function add_2checkout_inputs( $content, $field, $value, $entry_id, $form_id ) {

		// If this form does not have a 2Checkout feed or if this is not a credit card field, return field content.
		if ( ! $this->has_feed( $form_id ) || 'creditcard' !== $field->get_input_type() ) {
			return $content;
		}

		// If a 2Checkout response exists, populate it to a hidden field.
		if ( $this->get_2checkout_js_response() ) {
			$content .= "<input type='hidden' name='2checkout_response' id='gf_2checkout_response' value='" . rgpost( 'gf_2checkout_response' ) . "' />";
		}

		// Remove name attribute from credit card field inputs for security.
		// Removes: name='input_2.1', name='input_2.2[]', name='input_2.3' where 2 is the credit card field id.
		$content = preg_replace( "/name='input_{$field->id}.[1|2|3](\[])?'/", '', $content );

		return $content;

	}





	// # TRANSACTIONS --------------------------------------------------------------------------------------------------

	/**
	 * Initialize authorizing the transaction for the product & services type feed or return the 2co.js error.
	 *
	 * @since  1.0
	 * @access public
	 *
	 * @param array $feed            The Feed object currently being processed.
	 * @param array $submission_data The customer and transaction data.
	 * @param array $form            The Form object currently being processed.
	 * @param array $entry           The Entry object currently being processed.
	 *
	 * @uses   GF_2Checkout::authorize_product()
	 * @uses   GF_2Checkout::get_2checkout_js_error()
	 * @uses   GF_2Checkout::initialize_api()
	 * @uses   GFPaymentAddOn::authorization_error()
	 *
	 * @return array
	 */
	public function authorize( $feed, $submission_data, $form, $entry ) {

		// Initialize API.
        if ( ! is_a( $api = $this->initialize_api(), 'GF_2Checkout_API' ) ) {
			return $this->authorization_error( esc_html__( 'Unable to initialize API.', 'gravityforms2checkout' ) );
		}

		// If there was an error when retrieving the 2co.js token, return an authorization error.
		if ( $this->get_2checkout_js_error() ) {
			return $this->authorization_error( $this->get_2checkout_js_error() );
		}

		// Authorize product.
		return $this->authorize_product( $feed, $submission_data, $form, $entry );

	}

	/**
	 * Create the 2Checkout sale authorization and return any authorization errors which occur.
	 *
	 * @since  1.0
	 * @access public
	 *
	 * @param array $feed            The Feed object currently being processed.
	 * @param array $submission_data The customer and transaction data.
	 * @param array $form            The Form object currently being processed.
	 * @param array $entry           The Entry object currently being processed.
	 *
	 * @used-by GF_2Checkout::authorize()
	 * @uses    GFAddOn::get_field_map_fields()
	 * @uses    GFAddOn::get_field_value()
	 * @uses    GFAddOn::log_debug()
	 * @uses    GFAddOn::log_error()
	 * @uses    GF_2Checkout::prepare_sale()
	 * @uses    GF_2Checkout::validate_customer_info()
	 * @uses    GF_2Checkout_API::create_sale()
	 * @uses    GFPaymentAddOn::authorization_error()
	 *
	 * @return array
	 */
	public function authorize_product( $feed, $submission_data, $form, $entry ) {

		// Get billing info field map.
		$billing_map = $this->get_field_map_fields( $feed, 'billingInformation' );

		// Prepare sale arguments.
		$sale = $this->prepare_sale( $submission_data, $form, $entry, $billing_map );

		// Validate customer information.
		$validation_errors = $this->validate_customer_info( $sale, $form, $billing_map );

		// If there were validation errors, return them.
		if ( is_array( $validation_errors ) ) {
			return $validation_errors;
		}

		// Loop through line items.
		foreach ( $submission_data['line_items'] as $line_item ) {

			// Add line item to sale.
			$sale['lineItems'][] = array(
				'name'     => $line_item['name'],
				'price'    => strval( $line_item['unit_price'] ),
				'type'     => 'product',
				'quantity' => strval( $line_item['quantity'] ),
			);

		}

		// Log sale item.
		$this->log_debug( __METHOD__ . '(): Sale to be created; ' . print_r( $sale, true ) );

		try {

			// Create sale.
			$sale = $this->initialize_api()->create_sale( $sale );

			// Log returned sale object.
			$this->log_debug( __METHOD__ . '(): Sale created; ' . print_r( $sale, true ) );

			// Prepare authorization response.
			$auth = array(
				'is_authorized'  => true,
				'transaction_id' => $sale['orderNumber'],
			);

		} catch ( Exception $e ) {

			// Log that sale could not be created.
			$this->log_error( __METHOD__ . '(): Could not create sale; ' . $e->getMessage() . ' (' . $e->getCode() . ')' );

			// Prepare authorization response.
			$auth = $this->authorization_error( $e->getMessage() );

		}

		return $auth;

	}

	/**
	 * Capture the 2Checkout charge which was authorized during validation.
	 *
	 * @since  1.0
	 * @access public
	 *
	 * @param array $auth            Contains the result of the authorize() function.
	 * @param array $feed            The Feed object currently being processed.
	 * @param array $submission_data The customer and transaction data.
	 * @param array $form            The Form object currently being processed.
	 * @param array $entry           The Entry object currently being processed.
	 *
	 * @uses   GF_2Checkout::initialize_api()
	 * @uses   GF_2Checkout_API::detail_sale()
	 * @uses   GFPaymentAddOn::authorization_error()
	 *
	 * @return array
	 */
	public function capture( $auth, $feed, $submission_data, $form, $entry ) {

		// Initialize API.
		if ( ! is_a( $api = $this->initialize_api(), 'GF_2Checkout_API' ) ) {
			return $this->authorization_error( esc_html__( 'Unable to initialize API.', 'gravityforms2checkout' ) );
		}

		try {

			// Get sale.
			$sale = $api->detail_sale( $auth['transaction_id'] );

			// Prepare payment details.
			$payment = array(
				'is_success'     => true,
				'transaction_id' => $auth['transaction_id'],
				'amount'         => $sale['invoices'][0]['customer_total'],
				'payment_method' => $sale['customer']['pay_method']['method'],
			);

		} catch ( Exception $e ) {

			// Log that sale could not be retrieved.
			$this->log_error( __METHOD__ . '(): Could not retrieve sale; ' . $e->getMessage() . ' (' . $e->getCode() . ')' );

			// Prepare payment details.
			$payment = array(
				'is_success'    => false,
				'error_message' => $e->getMessage(),
			);

		}

		return $payment;

	}

	/**
	 * Subscribe the user to a 2Checkout recurring sale.
	 *
	 * @since  1.0
	 * @access public
	 *
	 * @param array $feed            The Feed object currently being processed.
	 * @param array $submission_data The customer and transaction data.
	 * @param array $form            The Form object currently being processed.
	 * @param array $entry           The Entry object currently being processed.
	 *
	 * @uses   GFAddOn::get_field_map_fields()
	 * @uses   GFAddOn::get_field_value()
	 * @uses   GFAddOn::log_debug()
	 * @uses   GFAddOn::log_error()
	 * @uses   GF_2Checkout::initialize_api()
	 * @uses   GF_2Checkout::prepare_sale()
	 * @uses   GF_2Checkout::validate_customer_info()
	 * @uses   GF_2Checkout_API::create_sale()
	 * @uses   GFPaymentAddOn::authorization_error()
	 *
	 * @return array
	 */
	public function subscribe( $feed, $submission_data, $form, $entry ) {

		// Initialize API.
        if ( ! is_a( $api = $this->initialize_api(), 'GF_2Checkout_API' ) ) {
			return $this->authorization_error( esc_html__( 'Unable to initialize API.', 'gravityforms2checkout' ) );
		}

		// If there was an error when retrieving the 2co.js token, return an authorization error.
		if ( $this->get_2checkout_js_error() ) {
			return $this->authorization_error( $this->get_2checkout_js_error() );
		}

		// Get billing info field map.
		$billing_map = $this->get_field_map_fields( $feed, 'billingInformation' );

		// Prepare sale arguments.
		$sale = $this->prepare_sale( $submission_data, $form, $entry, $billing_map );

		// Validate customer information.
		$validation_errors = $this->validate_customer_info( $sale, $form, $billing_map );

		// If there were validation errors, return them.
		if ( is_array( $validation_errors ) ) {
			return $validation_errors;
		}

		// Add subscription.
		$sale['lineItems'][] = array(
			'name'       => rgars( $feed, 'meta/feedName' ),
			'price'      => strval( $submission_data['payment_amount'] ),
			'type'       => 'product',
			'startupFee' => strval( $submission_data['setup_fee'] ),
			'recurrence' => $feed['meta']['billingCycle_length'] . ' ' . ucwords( $feed['meta']['billingCycle_unit'] ),
			'duration'   => 0 == $feed['meta']['recurringTimes'] ? 'Forever' : $feed['meta']['recurringTimes'] . ' ' . ucwords( $feed['meta']['billingCycle_unit'] ),
		);

		try {

			// Create sale.
			$sale = $api->create_sale( $sale );

			// Log returned sale object.
			$this->log_debug( __METHOD__ . '(): Subscription created; ' . print_r( $sale, true ) );

			// Prepare authorization response.
			$auth = array(
				'is_success'      => true,
				'subscription_id' => $sale['orderNumber'],
				'amount'          => $submission_data['payment_amount'],
			);

		} catch ( Exception $e ) {

			// Log that sale could not be created.
			$this->log_error( __METHOD__ . '(): Could not create subscription; ' . $e->getMessage() . ' (' . $e->getCode() . ')' );

			// Prepare authorization response.
			$auth = $this->authorization_error( $e->getMessage() );

		}

		return $auth;

	}





	// # HELPER METHODS ------------------------------------------------------------------------------------------------

	/**
	 * Initializes 2Checkout API if credentials are valid.
	 *
	 * @since  1.0
	 * @access public
	 *
	 * @param string $api_mode 2Checkout API mode (production or sandbox).
	 *
	 * @uses   GFAddOn::get_current_settings()
	 * @uses   GFAddOn::get_plugin_settings()
	 * @uses   GFAddOn::get_slug()
	 * @uses   GFAddOn::is_plugin_settings()
	 * @uses   GFAddOn::log_debug()
	 * @uses   GFAddOn::log_error()
	 * @uses   GF_2Checkout_API::detail_company_info()
	 *
	 * @return GF_2Checkout_API|false|null
	 */
	public function initialize_api( $api_mode = '' ) {

        // Get the plugin settings.
        $settings = $this->is_plugin_settings( $this->get_slug() ) ? $this->get_current_settings() : $this->get_plugin_settings();

        // Get API mode.
        $api_mode = rgblank( $api_mode ) ? $settings['apiMode'] : $api_mode;

		// If API is alredy initialized, return.
		if ( isset( $this->api[ $api_mode ] ) && ! is_null( $this->api[ $api_mode ] ) ) {
			return $this->api[ $api_mode ];
		}

		// Load the API library.
		if ( ! class_exists( 'GF_2Checkout_API' ) ) {
			require_once( 'includes/class-gf-2checkout-api.php' );
		}

		// If API credentials are empty, return.
		if ( ! rgars( $settings, $api_mode . '/privateKey' ) || ! rgars( $settings, $api_mode . '/username' ) || ! rgars( $settings, $api_mode . '/password' ) ) {
			return null;
		}

		// Log validation step.
		$this->log_debug( __METHOD__ . '(): Validating API Info.' );

		try {

			// Initialize a new 2Checkout API object.
			$twocheckout = new GF_2Checkout_API(
				$api_mode,
				$settings[ $api_mode ]['sellerId'],
				$settings[ $api_mode ]['privateKey'],
				$settings[ $api_mode ]['username'],
				$settings[ $api_mode ]['password']
			);

			// Get account's company information details.
			$twocheckout->detail_company_info();

			// Log that authentication test passed.
			$this->log_debug( __METHOD__ . '(): API credentials are valid.' );

			// Assign API instance to class.
			$this->api[ $api_mode ] = $twocheckout;

			return $this->api[ $api_mode ];

		} catch ( Exception $e ) {

			// Log that authentication test failed.
			$this->log_error( __METHOD__ . '(): API credentials are invalid; ' . $e->getMessage() );

			return false;

		}

	}

	/**
	 * Response from 2co.js is posted to the server as '2checkout_response'.
	 *
	 * @since   1.0
	 * @access  public
	 *
	 * @used-by GF_2Checkout::add_2checkout_inputs()
	 * @uses    GFAddOn::maybe_decode_json()
	 *
	 * @return array|null
	 */
	public function get_2checkout_js_response() {

		// Get response.
		$response = rgpost( '2checkout_response' );

		return $this->maybe_decode_json( $response );

	}

	/**
	 * Check if a 2co.js error has been returned and then return the appropriate message.
	 *
	 * @since   1.0
	 * @access  public
	 *
	 * @used-by GF_2Checkout::authorize()
	 * @uses    GF_2Checkout::get_2checkout_js_response()
	 *
	 * @return bool|string
	 */
	public function get_2checkout_js_error() {

		// Get 2co.js response.
		$response = $this->get_2checkout_js_response();

		// If an error message is provided, return error message.
		if ( rgar( $response, 'errorMsg' ) ) {
			return $response['errorMsg'];
		}

		return false;

	}

	/**
	 * Populate the $_POST with the last four digits of the card number.
	 *
	 * @since  1.0
	 * @access public
	 *
	 * @param array $form Form object.
	 *
	 * @used-by GF_2Checkout::init()
	 * @uses    GF_2Checkout::get_2checkout_js_error()
	 * @uses    GF_2Checkout::get_2checkout_js_response()
	 * @uses    GFPaymentAddOn::$is_payment_gateway
	 * @uses    GFPaymentAddOn::get_credit_card_field()
	 */
	public function populate_credit_card_last_four( $form ) {

		if ( ! $this->is_payment_gateway ) {
			return;
		}

		// If response was an error, exit.
		if ( $this->get_2checkout_js_error() ) {
			return;
		}

		// Get the credit card field.
		$cc_field = $this->get_credit_card_field( $form );

		// Get the 2Checkout response.
		$response = $this->get_2checkout_js_response();

		$_POST[ 'input_' . $cc_field->id . '_1' ] = 'XXXXXXXXXXXX' . substr( $response['response']['paymentMethod']['cardNum'], -4 );

	}

	/**
	 * Prepare initial sale parameters.
	 *
	 * @since  1.0
	 * @access public
	 *
	 * @param array $submission_data The customer and transaction data.
	 * @param array $form            The Form object currently being processed.
	 * @param array $entry           The Entry object currently being processed.
	 * @param array $field_map       Billing Information field map.
	 *
	 * @uses   GFAddOn::get_field_value()
	 * @uses   GF_2Checkout::get_2checkout_js_response()
	 * @uses   GFCommon::get_currency()
	 *
	 * @return array
	 */
	public function prepare_sale( $submission_data, $form, $entry, $field_map ) {

		// Get 2co.js response.
		$response = $this->get_2checkout_js_response();

		return array(
			'token'           => $response['response']['token']['token'],
			'merchantOrderId' => uniqid(),
			'currency'        => GFCommon::get_currency(),
			'lineItems'       => array(),
			'billingAddr'     => array(
				'name'        => rgar( $submission_data, 'card_name' ),
				'addrLine1'   => $this->get_field_value( $form, $entry, $field_map['address'] ),
				'addrLine2'   => $this->get_field_value( $form, $entry, $field_map['address2'] ),
				'city'        => $this->get_field_value( $form, $entry, $field_map['city'] ),
				'state'       => $this->get_field_value( $form, $entry, $field_map['state'] ),
				'zipCode'     => $this->get_field_value( $form, $entry, $field_map['zip'] ),
				'country'     => $this->get_field_value( $form, $entry, $field_map['country'] ),
				'email'       => $this->get_field_value( $form, $entry, $field_map['email'] ),
				'phoneNumber' => $this->get_field_value( $form, $entry, $field_map['phone'] ),
			),
		);

	}

	/**
	 * Validate billing address.
	 *
	 * @since  1.0
	 * @access public
	 *
	 * @param array  $address Billing address.
	 * @param object $field   Address field.
	 *
	 * @uses   GF_Field_Address::get_country_code()
	 *
	 * @return bool
	 */
	public function validate_billing_address( $address = array(), $field ) {

		// If address line 1, city or country are missing, return false.
		if ( ! rgar( $address, 'addrLine1' ) || ! rgar( $address, 'city' ) || ! rgar( $address, 'country' ) ) {
			return false;
		}

		// Prepare list of countries requiring state and zip code.
		$state_zip_required = array( 'AR', 'AU', 'BG', 'CA', 'CN', 'CY', 'EG', 'ES', 'FR', 'GB', 'ID', 'IN', 'IT', 'JP', 'MX', 'MY', 'NL', 'PA', 'PH', 'PL', 'RO', 'RU', 'RS', 'SE', 'SG', 'TH', 'TR', 'US', 'ZA' );

		// Get country code.
		$country_code = $field->get_country_code( $address['country'] );

		// If state or zip code is missing, return false.
		if ( in_array( $country_code, $state_zip_required ) && ( ! rgar( $address, 'state' ) || ! rgar( $address, 'zipCode' ) ) ) {
			return false;
		}

		return true;

	}

	/**
	 * Validate customer information.
	 *
	 * @since  1.0
	 * @access public
	 *
	 * @param array $sale      The Sale object currently being processed.
	 * @param array $form      The Form object currently being processed.
	 * @param array $field_map Billing Information field map.
	 *
	 * @uses   GF_2Checkout::validate_billing_address()
	 * @uses   GFFormsModel::get_field()
	 * @uses   GFPaymentAddOn::authorization_error()
	 *
	 * @return array|bool
	 */
	public function validate_customer_info( $sale = array(), $form = array(), $field_map = array() ) {

		// Validate name.
		if ( ! rgars( $sale, 'billingAddr/name' ) ) {
			return $this->authorization_error( esc_html__( "You must provide the cardholder's name.", 'gravityforms2checkout' ) );
		}

		// Validate email address.
		if ( ! rgars( $sale, 'billingAddr/email' ) ) {
			return $this->authorization_error( esc_html__( 'You must provide your email address.', 'gravityforms2checkout' ) );
		}

		// Validate phone number.
		if ( ! rgars( $sale, 'billingAddr/phoneNumber' ) ) {
			return $this->authorization_error( esc_html__( 'You must provide your phone number.', 'gravityforms2checkout' ) );
		}

		// Validate billing address.
		if ( ! $this->validate_billing_address( $sale['billingAddr'], GFFormsModel::get_field( $form, $field_map['country'] ) ) ) {
			return $this->authorization_error( esc_html__( 'You must provide a valid billing address.', 'gravityforms2checkout' ) );
		}

		return true;

	}

}
