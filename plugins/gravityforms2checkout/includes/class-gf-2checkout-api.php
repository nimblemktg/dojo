<?php

defined( 'ABSPATH' ) or die();

/**
 * Gravity Forms 2Checkout API library.
 *
 * @since     1.0
 * @package   GravityForms
 * @author    Rocketgenius
 * @copyright Copyright (c) 2018, Rocketgenius
 */
class GF_2Checkout_API {

	/**
	 * 2Checkout API mode.
	 *
	 * @since  1.0
	 * @var    string
	 * @access protected
	 */
	protected $api_mode = 'production';

	/**
	 * Base 2Checkout Production API URL.
	 *
	 * @since  1.0
	 * @var    string
	 * @access protected
	 */
	protected $api_url = 'https://www.2checkout.com/';

	/**
	 * Base 2Checkout Sandbox API URL.
	 *
	 * @since  1.0
	 * @var    string
	 * @access protected
	 */
	protected $api_sandbox_url = 'https://sandbox.2checkout.com/';

	/**
	 * 2Checkout Password.
	 *
	 * @since  1.0
	 * @var    string
	 * @access protected
	 */
	protected $password = '';

	/**
	 * 2Checkout Private Key.
	 *
	 * @since  1.0
	 * @var    string
	 * @access protected
	 */
	protected $private_key = '';

	/**
	 * 2Checkout Seller ID.
	 *
	 * @since  1.0
	 * @var    string
	 * @access protected
	 */
	protected $seller_id = '';

	/**
	 * 2Checkout Username.
	 *
	 * @since  1.0
	 * @var    string
	 * @access protected
	 */
	protected $username = '';

	/**
	 * Initialize 2Checkout API library.
	 *
	 * @since  1.0
	 * @access public
	 *
	 * @param string $api_mode    API mode.
	 * @param string $seller_id   2Checkout Seller ID.
	 * @param string $private_key 2Checkout Private Key.
	 * @param string $username    2Checkout Username.
	 * @param string $password    2Checkout Password.
	 */
	public function __construct( $api_mode, $seller_id, $private_key, $username, $password ) {

		$this->api_mode    = $api_mode;
		$this->seller_id   = $seller_id;
		$this->private_key = $private_key;
		$this->username    = $username;
		$this->password    = $password;

	}





	// # SALES ---------------------------------------------------------------------------------------------------------

	/**
	 * Create sale.
	 *
	 * @since  1.0
	 * @access public
	 *
	 * @param array $sales Sale parameters.
	 *
	 * @uses   GF_2Checkout_API::make_request()
	 *
	 * @return array
	 * @throws Exception
	 */
	public function create_sale( $sale = array() ) {

		// Prepare base sale parameters.
		$sale_base = array(
			'sellerId'   => $this->seller_id,
			'privateKey' => $this->private_key,
		);

		// Merge sales parameters.
		$sale = array_merge( $sale_base, $sale );

		return $this->make_request( 'checkout/api/1/' . $this->seller_id . '/rs/authService', $sale, 'POST', 'response' );

	}

	/**
	 * Get details for a sale.
	 *
	 * @since  1.0
	 * @access public
	 *
	 * @param string $sale_id Sale ID or order number.
	 *
	 * @uses   GF_2Checkout_API::make_request()
	 *
	 * @return array
	 * @throws Exception
	 */
	public function detail_sale( $sale_id = '' ) {

		return $this->make_request( 'api/sales/detail_sale', array( 'sale_id' => $sale_id ), 'GET', 'sale' );

	}





	// # COMPANY INFO --------------------------------------------------------------------------------------------------

	/**
	 * Get company information details for current account.
	 *
	 * @since  1.0
	 * @access public
	 *
	 * @uses   GF_2Checkout_API::make_request()
	 *
	 * @return array
	 * @throws Exception
	 */
	public function detail_company_info() {

		return $this->make_request( 'api/acct/detail_company_info', array(), 'GET', 'vendor_company_info' );

	}





	// # REQUEST METHODS -----------------------------------------------------------------------------------------------

	/**
	 * Make API request.
	 *
	 * @since  1.0
	 * @access private
	 *
	 * @param string $action     Request action.
	 * @param array  $options    Request options.
	 * @param string $method     HTTP method. Defaults to GET.
	 * @param string $return_key Array key from response to return. Defaults to null (return full response).
	 *
	 * @return array
	 * @throws Exception
	 */
	private function make_request( $action, $options = array(), $method = 'GET', $return_key = null ) {

		// Build request URL.
		$request_url = ( 'sandbox' === $this->api_mode ? $this->api_sandbox_url : $this->api_url ) . $action;

		// Add query parameters.
		if ( 'GET' === $method && ! empty( $options ) ) {
			$request_url = add_query_arg( $options, $request_url );
		}

		// Build request headers.
		$headers = array(
			'Accept'        => 'application/json',
			'Content-Type'  => 'application/json',
			'Authorization' => 'Basic ' . base64_encode( $this->username . ':' . $this->password ),
		);

		// Build request arguments.
		$args = array(
			'body'    => 'GET' !== $method ? json_encode( $options ) : null,
			'headers' => $headers,
			'method'  => $method,
			'timeout' => 120,
		);

		// Execute request.
		$result = wp_remote_request( $request_url, $args );

		// If response is an error, throw an Exception.
		if ( is_wp_error( $result ) ) {
			throw new Exception( $result->get_error_message() );
		}

		// Decode response.
		$response = wp_remote_retrieve_body( $result );
		$response = gf_2checkout()->maybe_decode_json( $response );

		// If an exception is set, throw Exception.
		if ( rgar( $response, 'exception' ) ) {
			throw new Exception( $response['exception']['errorMsg'], $response['exception']['errorCode'] );
		}

		// If an error is set, throw Exception.
		if ( rgar( $response, 'code' ) && rgar( $response, 'message' ) ) {
			throw new Exception( $response['code'], $response['message'] );
		}

		// If a return key is defined and array item exists, return it.
		if ( ! rgblank( $return_key ) && rgar( $response, $return_key ) ) {
			return $response[ $return_key ];
		}

		return $response;

	}

}
