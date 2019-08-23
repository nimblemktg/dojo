<div class="payment-result-form">
	<div class="show-if-match" data-match="paypal" data-check="{{ payment|payment_type }}"  >
	    <?php echo esc_html__('We will redirect to paypal for complete payment in 15s,if not please click','givingwalk');?> <a href="#"><?php echo esc_html__('here','givingwalk');?></a></div>
	<h2><?php echo esc_html__('There is your details','givingwalk');?></h2> 
	<div class="hidden-if-empty" data-check="{{ hash => payment|customer_name}}" > <?php echo esc_html__('Your name :','givingwalk');?> {{ payment|customer_name }}</div>
	<div class="hidden-if-empty" data-check="{{ hash =>  payment|customer_phone }}" > <?php echo esc_html__('Your phone :','givingwalk');?> {{ payment|customer_phone }}</div>
	<div class="hidden-if-empty" data-check="{{ hash =>  payment|customer_email }}" > <?php echo esc_html__('Your email :','givingwalk');?> {{ payment|customer_email }}</div>
	<div class="hidden-if-empty" data-check="{{ hash =>  payment|customer_message }}" > <?php echo esc_html__('Your message :','givingwalk');?> {{ payment|customer_message }}</div>
	<h2><?php echo esc_html__('Payments details','givingwalk');?></h2>
	<div class="hidden-if-empty" data-check="{{ hash =>  payment|amount_preview }}" > <?php echo esc_html__('Total amount :','givingwalk');?> {{ payment|amount_preview }}</div>
	<div class="hidden-if-empty" data-check="{{ hash =>  payment|description }}" > <?php echo esc_html__('Description :','givingwalk');?> {{ payment|description }}</div>
</div>
