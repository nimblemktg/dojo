<?php
ob_start(); ?>
<table>
    <tr>
        <th><?php echo esc_html__( 'Donate to' ,'givingwalk'); ?></th>
        <td data-title="<?php esc_attr_e( 'Donate to' ,'givingwalk'); ?>">{{_title_}}</td>
    </tr>
</table>
<?php
$event_info_template = ob_get_clean();
ob_start();
?>
<label class="button radio-group" data-group="amount" data-connect="amount" data-value="{{_key_}}">{{_value_}}</label>
<?php
$sample_amount_template = ob_get_clean();
ob_start();
?>
<div class="form-group">
    <input type="text" class="connect-group group-amount" name="amount" value="200">{{_currency_}}
</div>
<?php
$input_amount_template = ob_get_clean();
?>

<div class="event-ticket-form">
    <div>
        <span class="form-close"><i class="fa fa-close"></i></span>
        <div class="causes-form-wrap view-single active view-initial" data-name="donor-info" data-group="payment-info">
            <div class="dynamic-data" data-target="items" data-template="<?php echo esc_attr($event_info_template) ?>"></div>
            <div class="clear-both"></div>
            <div class="row-amount">
                <p><?php echo esc_html__( 'How much would you like to donate?','givingwalk'); ?></p>
                <div class="row">
                    <div class="col-12 col-lg-6">
                        <div class="dynamic-data" data-target="special:sample_amount" data-template="<?php echo esc_attr($sample_amount_template) ?>" >
                        </div>
                    </div>
                    <div class="col-12 col-lg-6">
                        <div class="dynamic-data" data-target="group" data-template="<?php echo esc_attr($input_amount_template) ?>"></div>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label><?php echo esc_html__( 'Name *','givingwalk'); ?></label>
                <input type="text" name="name" value="" required="required">
            </div>
            <div class="form-group">
                <label><?php echo esc_html__( 'Email *' ,'givingwalk'); ?></label>
                <input type="email" name="email" value="" required="required">
            </div>
            <div class="form-group">
                <label><?php echo esc_html__( 'Phone *' ,'givingwalk'); ?></label>
                <input type="text" name="phone" required="required">
            </div>
            <div class="form-group">
                <label><?php echo esc_html__( 'Messages to Admin','givingwalk'); ?></label>
                <textarea name="messages" rows="3"></textarea>
            </div>
            <div class="form-group">
                <label><?php echo esc_html__('Payment type', 'givingwalk'); ?></label>
                <?php
                $settings = apply_filters('ef4_payment_type_settings', [], $post_type = 'crw_causes');
                $settings = wp_parse_args($settings, [
                    'default' => '',
                    'support' => '',
                    'notice'  => ''
                ]);
                $payment_default = $settings['default'];//
                $payment_method = (is_array($settings['support'])) ? $settings['support'] : [];
                $payment_notice = (is_array($settings['notice'])) ? $settings['notice'] : [];
                ?>
                <select name="payment_type" class="view-input-state">
                    <?php
                    foreach ($payment_method as $value => $title) {
                        ?>
                        <option
                        value="<?php echo esc_attr($value) ?>" <?php selected($payment_default, $value) ?>><?php echo esc_html($title) ?></option><?php
                    } ?>
                </select>
            </div>
            <?php $method = "paypal";
            if (array_key_exists($method, $payment_method)) {
                ?>
                <div class="view-single<?php if ($payment_default == $method) echo " active" ?>"
                     data-name="<?php echo esc_attr($method) ?>" data-group="payment-type-section">
                    <?php if (!empty($payment_notice[$method])) { ?>
                        <div><?php echo wp_kses_post($payment_notice[$method]) ?></div>
                    <?php } ?>
                </div>
                <?php
            } ?>
            <?php $method = "custom";
            if (array_key_exists($method, $payment_method)) {
                ?>
                <div class="view-single<?php if ($payment_default == $method) echo " active" ?>"
                     data-name="<?php echo esc_attr($method) ?>" data-group="payment-type-section">
                    <?php if (!empty($payment_notice[$method])) { ?>
                        <div><?php echo wp_kses_post($payment_notice[$method]) ?></div>
                    <?php } ?>
                </div>
                <?php
            } ?>
            <?php $method = "stripe";
            if (array_key_exists($method, $payment_method)) {
                ?>
                <div class="view-single<?php if ($payment_default == $method) echo " active" ?>"
                     data-name="<?php echo esc_attr($method) ?>" data-group="payment-type-section">
                    <div class="form-group">
                        <input type="text" name="card_number" pattern="[0-9]{16}"
                               title="<?php esc_attr_e('Invalid Card Number', 'givingwalk') ?>" autocomplete="off"
                               placeholder="<?php esc_attr_e('Card number', 'givingwalk') ?>"
                               class="form-control ">
                    </div>
                    <div class="row">
                        <div class="form-group col-12 col-lg-6">
                            <select name="card_exp_month">
                                <?php for ($i = 1; $i < 13; $i++) { ?>
                                    <option value="<?php echo esc_attr($i) ?>"><?php echo esc_html($i) ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group col-12 col-lg-6">
                            <select name="card_exp_year">
                                <?php
                                $current_year = date('Y');
                                for ($i = 0; $i < 21; $i++) {
                                    $value = $current_year + $i;
                                    ?>
                                    <option
                                    value="<?php echo esc_attr($value) ?>"><?php echo esc_html($value) ?></option><?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <input type="text" name="card_cvc" pattern="[0-9]{3,4}"
                               autocomplete="off" placeholder="<?php esc_attr_e('CVV', 'givingwalk') ?>"
                               class="form-control ">
                    </div>
                    <?php if (!empty($payment_notice[$method])) { ?>
                        <div><?php echo wp_kses_post($payment_notice[$method]) ?></div>
                    <?php } ?>
                </div>
                <?php
            } ?>

            <div class="action-row text-center">
                <button class="btn btn-submit" type="submit"><?php echo esc_html__( 'Process','givingwalk'); ?></button>
            </div>
        </div>
    </div>
</div>






















