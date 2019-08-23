window.GF2Checkout = null;

( function( $ ) {

	GF2Checkout = function( args ) {

		var self = this;

		self.form = null;

		for ( var prop in args ) {
			if ( args.hasOwnProperty( prop ) ) {
				this[ prop ] = args[ prop ];
			}
		}

		/**
		 * Initialize 2Checkout.
		 *
		 * @since 1.0
		 */
		self.init = function() {

			if ( ! self.isCreditCardOnPage() ) {
				return;
			}

			TCO.loadPubKey( self.apiMode );

			// Bind 2Checkout functionality to submit event.
			$( '#gform_' + self.formId ).on( 'submit', function( e ) {

				if ( $( this ).data( 'gf_2checkout_submitting' ) || $( '#gform_save_' + self.formId ).val() == 1 || ! self.isLastPage() ) {
					return;
				} else {
					e.preventDefault();
					$( this ).data( 'gf_2checkout_submitting', true );
					self.maybeAddSpinner();
				}

				// Get form object.
				self.form = $( this );

				// Prepare credit card field input prefix.
				var ccInputPrefix = 'input_' + self.formId + '_' + self.ccFieldId + '_';

				// Prepare request arguments.
				var args = {
					sellerId:       self.sellerId,
					publishableKey: self.publishableKey,
					ccNo:           self.form.find('#' + ccInputPrefix + '1').val(),
					cvv:            self.form.find('#' + ccInputPrefix + '3').val(),
					expMonth:       self.form.find('#' + ccInputPrefix + '2_month').val(),
					expYear:        self.form.find('#' + ccInputPrefix + '2_year').val(),
				};

				TCO.requestToken( self.responseHandler, self.responseHandler, args );

			} );

		};

		/**
		 * Handle response from 2co.js.
		 *
		 * @since 1.0
		 */
		self.responseHandler = function( response ) {

			// Append 2co.js response
			self.form.append( $( '<input type="hidden" name="2checkout_response" />' ).val( $.toJSON( response ) ) );

			// submit the form
			self.form.submit();

		}






		// # HELPER METHODS ------------------------------------------------------------------------------------------------

		/**
		 * Get the current page number.
		 *
		 * @since 1.0
		 *
		 * @return int|bool
		 */
		self.getCurrentPageNumber = function() {

			var currentPageInput = $( '#gform_source_page_number_' + self.formId );

			return currentPageInput.length > 0 ? currentPageInput.val() : false;

		};

		/**
		 * Determine if the credit card field is on this page.
		 *
		 * @since 1.0
		 *
		 * @uses GF2Checkout.getCurrentPageNumber()
		 *
		 * @return bool
		 */
		self.isCreditCardOnPage = function() {

			var currentPage = self.getCurrentPageNumber();

			// If current page is false or no credit card page number, assume this is not a multi-page form.
			if ( ! self.ccPage || ! currentPage ) {
				return true;
			}

			return this.ccPage == currentPage;

		};

		/**
		 * Determine if this is the last page of the form.
		 *
		 * @since 1.0
		 *
		 * @return bool
		 */
		self.isLastPage = function() {

			var targetPageInput = $( '#gform_target_page_number_' + self.formId );

			if ( targetPageInput.length > 0 ) {
				return targetPageInput.val() == 0;
			}

			return true;

		};

		/**
		 * Add spinner to form on submit.
		 *
		 * @since 1.0
		 */
		self.maybeAddSpinner = function() {

			if ( self.isAjax ) {
				return;
			}

			if ( 'function' === typeof gformAddSpinner) {
				gformAddSpinner( self.formId );
				return;
			}

			if ( $( '#gform_ajax_spinner_' + self.formId ).length == 0 ) {

				var spinnerUrl     = gform.applyFilters( 'gform_spinner_url', gf_global.spinnerUrl, self.formId ),
					$spinnerTarget = gform.applyFilters( 'gform_spinner_target_elem', $( '#gform_submit_button_' + self.formId + ', #gform_wrapper_' + self.formId + ' .gform_next_button, #gform_send_resume_link_button_' + self.formId ), self.formId );

				$spinnerTarget.after( '<img id="gform_ajax_spinner_' + self.formId + '"  class="gform_ajax_spinner" src="' + spinnerUrl + '" alt="" />' );

			}

		};

		self.init();

	}

} )( jQuery );
