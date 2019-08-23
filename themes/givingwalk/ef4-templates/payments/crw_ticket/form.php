<?php ob_start(); ?>
            <table>
                <tr>
                    <th><?php esc_html_e('Events','givingwalk');?></th>
                    <td data-title="<?php esc_attr_e( 'Events' ,'givingwalk'); ?>">{{_event_name_}}</td>
                </tr>
                <tr>
                    <th><?php esc_html_e('Events Times','givingwalk');?></th>
                    <td data-title="<?php esc_attr_e( 'Events Times' ,'givingwalk'); ?>"><p><?php esc_html_e('Started:','givingwalk');?> {{_start_time_}}</p><p> <?php esc_html_e('Ending:','givingwalk');?> {{_end_time_}}</p></td>
                </tr>
            </table>
<?php $event_info = ob_get_clean();
ob_start() ?>
                <tr>
                    <th>{{_name_}}</th>
                    <td data-title="{{_name_}}">
                        <div>
                            <div class="view-single active view-initial" data-name="ticket-short-{{_id_}}" data-group="ticket-info-{{_id_}}">{{_description_}}
                                <span class="math-group math-result" data-math="m-s-{{_id_}}" >0</span>/{{_available_}}
                                <div class="view-trigger btn" data-show="ticket-full-{{_id_}}">+</div>
                            </div>
                            <div class="view-single" data-name="ticket-full-{{_id_}}" data-group="ticket-info-{{_id_}}">
                                <div class="view-trigger btn" data-show="ticket-short-{{_id_}}">-</div>
                                <table>
                                    <tr>
                                        <th><?php esc_html_e('Descriptions:','givingwalk');?></th>
                                        <td data-title="<?php esc_attr_e( 'Descriptions:' ,'givingwalk'); ?>">{{_description_}}</td>
                                    </tr>
                                    <tr>
                                        <th><?php esc_html_e('Price:','givingwalk');?></th>
                                        <td data-title="<?php esc_attr_e( 'Price:' ,'givingwalk'); ?>">{{_price_view_}}</td>
                                    </tr>
                                    <tr>
                                        <th><?php esc_html_e('Booked:','givingwalk');?></th>
                                        <td data-title="<?php esc_attr_e( 'Booked:' ,'givingwalk'); ?>">{{_sold_}}/{{_max_stock_}}</td>
                                    </tr>
                                    <tr>
                                        <th><?php esc_html_e('Stock Available:','givingwalk');?></th>
                                        <td data-title="<?php esc_attr_e( 'Stock Available:' ,'givingwalk'); ?>">{{_available_}}</td>
                                    </tr>
                                    <tr>
                                        <th><?php esc_html_e('Book allow until:','givingwalk');?></th>
                                        <td data-title="<?php esc_attr_e( 'Book allow until:' ,'givingwalk'); ?>">{{_end_time_}}</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </td>
                    <td>
                        <input type="hidden" class="math-group math-element" data-name="m-{{_id_}}" value="{{_price_}}">
                        <input type="hidden" class="math-group math-element" data-name="m-max-{{_id_}}"
                               value="{{_available_}}">
                        <div class="btn btn-submit math-group math-force-value math-dependency"
                             data-match="m-s-{{_id_}}{<}m-max-{{_id_}}" data-target="m-s-{{_id_}}"
                             data-value="sum:{m-s-{{_id_}},1}"><?php esc_html_e('Add','givingwalk');?>
                        </div>
                    </td>
                </tr>
<?php $ticket_info = ob_get_clean();

 ?>


<div class="event-ticket-form">
    <div>
        <span class="form-close"><i class="fa fa-close"></i></span>
        <div class="causes-form-wrap view-single active view-initial" data-name="ticket-chose" data-group="payment-info">
        
            <div class="dynamic-data" data-target="group" data-template="<?php echo esc_attr($event_info) ?>">
                
            </div>
            <table>
                <tr class="dynamic-data" data-target="items" data-template="<?php echo esc_attr($ticket_info) ?>"
                    data-insert-mode="after">
                    <th><?php esc_html_e('Tickets','givingwalk');?></th>
                    <th><?php esc_html_e('Information','givingwalk');?></th>
                    <th></th>
                </tr>

            </table>
            <div class="clear-both"></div>
            <table class="math-group math-dependency" data-match="total-product{>}0">
                <?php ob_start() ?>
                <tr class="math-group math-dependency" data-match="m-s-{{_id_}}{>}0">
                    <td data-title="<?php esc_attr_e( 'Items' ,'givingwalk'); ?>">{{_name_}}</td>
                    <td data-title="<?php esc_attr_e( 'Spaces' ,'givingwalk'); ?>"><input type="number" name="quantity-of-{{_id_}}" class="math-group math-element" min="0" max="{{_available_}}" data-name="m-s-{{_id_}}" value="0"></td>
                    <td data-title="<?php esc_attr_e( 'Price per space' ,'givingwalk'); ?>">{{_price_view_}}</td>
                    <td data-title="<?php esc_attr_e( 'Amount' ,'givingwalk'); ?>"><span class="math-group math-result" data-math="mul:{m-{{_id_}},m-s-{{_id_}}}"
                              data-value-wrap="{{_price_mask_}}"></span></td>
                    <td>
                        <div class="math-group math-force-value remove-ticket-item" data-target="m-s-{{_id_}}" data-value="0">X</div>
                    </td>
                </tr>
                <?php $ticket_info_2 = ob_get_clean(); ?>
                <tr class="dynamic-data" data-target="items" data-template="<?php echo esc_attr($ticket_info_2) ?>"
                    data-insert-mode="after">
                    <th><?php esc_html_e('Items','givingwalk');?></th>
                    <th><?php esc_html_e('Spaces','givingwalk');?></th>
                    <th><?php esc_html_e('Price per space','givingwalk');?></th>
                    <th><?php esc_html_e('Amount','givingwalk');?></th>
                    <th></th>
                </tr>
                <tr>
                    <th></th>
                    <th></th>
                    <th><?php esc_html_e('Total:','givingwalk');?></th>
                    <?php $dynamic_attr_total_amount_preview = [
                        'data-value-wrap'=>[
                            'elements'=>'items',
                            'segment'=>'{{_price_mask_}}',
                        ]
                    ] ?>
                    <th><span class="math-group math-result dynamic-attr"
                              data-options="<?php echo esc_attr(json_encode($dynamic_attr_total_amount_preview)) ?>"
                              data-math="total-amount" ></span>
                    </th>
                    <th></th>
                </tr>
            </table>
            <?php $dynamic_attr_total_amount = [
                'data-math' => [
                    'elements' => 'items',
                    'segment'=>'mul:{m-{{_id_}},m-s-{{_id_}}}',
                    'join'=>',',
                    'wrap'=>'sum:{{-value-}}',
                ]
            ];
            $dynamic_attr_total_product = [
                'data-math' => [
                    'elements' => 'items',
                    'segment'=>'m-s-{{_id_}}',
                    'join'=>',',
                    'wrap'=>'sum:{{-value-}}',
                ]
            ];
            ?>
            <input type="hidden" class="math-group math-result math-element dynamic-attr"
                   data-options="<?php echo esc_attr(json_encode($dynamic_attr_total_amount)) ?>" data-math="0"
                   data-name="total-amount">
            <input type="hidden" class="math-group math-result math-element dynamic-attr"
                   data-options="<?php echo esc_attr(json_encode($dynamic_attr_total_product)) ?>" data-math="0"
                   data-name="total-product">
            <div class="text-center">
                <div class="view-trigger btn btn-primary math-group math-dependency" data-show-mode="fade"
                     data-hide-mode="none"
                     data-match="total-product{>}0" data-show="checkout" data-mode="fade">
                    <?php esc_html_e('Checkout','givingwalk');?>
                </div>
            </div>
        </div>
        <div class="causes-form-wrap view-single" data-name="checkout" data-group="payment-info">
            <div>
                <label><?php esc_html_e('Total Amount','givingwalk');?></label>
                <span class="math-group math-result dynamic-attr"
                      data-options="<?php echo esc_attr(json_encode($dynamic_attr_total_amount_preview)) ?>"
                      data-math="total-amount" ></span>
            </div>
            <div class="form-group">
                <label><?php esc_html_e('Name *','givingwalk');?></label>
                <input type="text" name="name" value="" required="required">
            </div>
            <div class="form-group">
                <label><?php esc_html_e('Email *','givingwalk');?></label>
                <input type="email" name="email" value="" required="required">
            </div>
            <div class="form-group">
                <label><?php esc_html_e('Phone *','givingwalk');?></label>
                <input type="text" name="phone" required="required">
            </div>
            <div class="form-group">
                <label><?php esc_html_e('Messages to Admin','givingwalk');?></label>
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
                <div class="view-trigger btn btn-primary" data-show="ticket-chose"
                     data-show-mode="fade" data-hide-mode="none"><?php esc_html_e('Back','givingwalk');?>
                </div>
                <button class="btn btn-submit" type="submit"><?php esc_html_e('Process','givingwalk');?></button>
            </div>
        </div>
    </div>
</div>






















