<?php
/*******************************************************************************
 * Copyright (c) 2017, WP Popup Maker
 ******************************************************************************/

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}


/**
 * Class PUM_EIP_Triggers
 */
class PUM_EIP_Triggers {

	/**
	 *
	 */
	public static function init() {
		add_filter( 'pum_registered_triggers', array( __CLASS__, 'register_triggers' ) );
	}

	/**
	 * @param array $triggers
	 *
	 * @return array
	 */
	public static function register_triggers( $triggers = array() ) {
		return array_merge( $triggers, array(
			'exit_intent'     => array(
				'name'            => __( 'Exit Intent', 'popup-maker-exit-intent-popups' ),
				'modal_title'     => sprintf( __( '% Settings', 'popup-maker-exit-intent-popups' ), __( 'Exit Intent', 'popup-maker-exit-intent-popups' ) ),
				'settings_column' => sprintf( '<strong>%1$s</strong>: %2$s; <strong>%3$s</strong>: %4$s', __( 'Top', 'popup-maker-exit-intent-popups' ), '{{data.top_sensitivity}}', __( 'Delay', 'popup-maker-exit-intent-popups' ), '{{data.delay_sensitivity}}' ),
				'fields'          => array(
					'general' => array(
						'top_sensitivity'   => array(
							'label' => __( 'Top Sensitivity', 'popup-maker-exit-intent-popups' ),
							'desc'  => __( 'The distance from the top of the browser window where the users mouse movement is detected.', 'popup-maker-exit-intent-popups' ),
							'type'  => 'rangeslider',
							'std'   => 10,
							'step'  => 1,
							'min'   => 1,
							'max'   => 50,
							'unit'  => __( 'px', 'popup-maker' ),
						),
						'delay_sensitivity' => array(
							'label' => __( 'False Positive Delay', 'popup-maker-exit-intent-popups' ),
							'desc'  => __( 'The delay used for false positive detection. A higher value reduces false positives, but increases chances of not opening in time.', 'popup-maker-exit-intent-popups' ),
							'type'  => 'rangeslider',
							'std'   => 350,
							'step'  => 25,
							'min'   => 100,
							'max'   => 750,
							'unit'  => __( 'ms', 'popup-maker' ),
						),
					),
				),
			),
			'exit_prevention' => array(
				'name'            => __( 'Exit Prevention', 'popup-maker-exit-intent-popups' ),
				'modal_title'     => __( 'Exit Prevention Settings', 'popup-maker-exit-intent-popups' ),
				'settings_column' => sprintf( '<strong>%1$s</strong>: %2$s', __( 'Message', 'popup-maker-exit-intent-popups' ), '{{data.message}}' ),
				'fields'          => array(
					'general' => array(
						'message' => array(
							'label' => __( 'Prompt Message', 'popup-maker-exit-intent-popups' ),
							'desc'  => __( 'Due to changes in modern browser security it is no longer possible to change the prompt message.', 'popup-maker-exit-intent-popups' ),
							'type'  => 'html',
						),

					),
				),
			),
		) );
	}
}
