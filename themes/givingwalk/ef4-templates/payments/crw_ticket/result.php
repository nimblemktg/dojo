<div class="payment-result-form">
	<div class="show-if-match" data-match="paypal" data-check="{{ payment|payment_type }}">
	    <?php esc_html_e('We will redirect to paypal for complete payment in 15s,if not please click','givingwalk');?> <a href="#"><?php esc_html_e('here','givingwalk');?></a></div>
	<h1><?php esc_html_e('There is your details','givingwalk');?></h1>
	<div class="hidden-if-empty" data-check="{{ hash => payment|customer_name}}" > <?php esc_html_e('Your name :','givingwalk');?> {{ payment|customer_name }}</div>
	<div class="hidden-if-empty" data-check="{{ hash =>  payment|customer_phone }}" > <?php esc_html_e('Your phone :','givingwalk');?> {{ payment|customer_phone }}</div>
	<div class="hidden-if-empty" data-check="{{ hash =>  payment|customer_email }}" > <?php esc_html_e('Your email :','givingwalk');?> {{ payment|customer_email }}</div>
	<div class="hidden-if-empty" data-check="{{ hash =>  payment|customer_message }}" > <?php esc_html_e('Your message :','givingwalk');?> {{ payment|customer_message }}</div>
	<h1><?php esc_html_e('Payments details','givingwalk');?></h1>
	<div class="hidden-if-empty" data-check="{{ hash =>  payment|amount_preview }}" > <?php esc_html_e('Total amount :','givingwalk');?> {{ payment|amount_preview }}</div>
	<div class="hidden-if-empty" data-check="{{ hash =>  payment|description }}" > <?php esc_html_e('Description :','givingwalk');?> {{ payment|description }}</div>
</div>
