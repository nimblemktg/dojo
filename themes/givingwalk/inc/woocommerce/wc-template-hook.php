<?php
/**
 * WooCommerce Template Hooks
 *
 * Action/filter hooks used for WooCommerce functions/templates.
 *
 * @author      Red Team
 * @category    Core
 * @package     WooCommerce/Templates
 * @version     3.1.x
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

add_filter('woocommerce_enqueue_styles', '__return_empty_array');

remove_action('woocommerce_before_main_content', 'woocommerce_breadcrumb', 20);

add_filter('woocommerce_show_page_title', 'givingwalk_woo_hide_page_title');
function givingwalk_woo_hide_page_title()
{
    return false;
}

function givingwalk_shop_sidebar(){
    global $opt_theme_options;

    $_sidebar = 'full';

    if(isset($opt_theme_options['opt_woo_loop_layout']))
        $_sidebar = $opt_theme_options['opt_woo_loop_layout'];
    
    if(isset($_GET['layout']) && trim($_GET['layout']) == 'full' )
        $_sidebar = 'full';
    if(isset($_GET['layout']) && trim($_GET['layout']) == 'left' )
        $_sidebar = 'left';
    if(isset($_GET['layout']) && trim($_GET['layout']) == 'right' )
        $_sidebar = 'right';
    return 'is-sidebar-' . esc_attr($_sidebar);
}

function givingwalk_loop_columns(){
	global $opt_theme_options;

    if(!isset($opt_theme_options['opt_woo_loop_layout']))
        return '4';
        
    $is_sidebar = givingwalk_shop_sidebar();
    if ( is_singular('product') ) {
        if(!empty($opt_theme_options['opt_product_related_number'])){
            return (int)$opt_theme_options['opt_product_related_number'];
        }
    }

    if(isset($_GET['cols']) && trim($_GET['cols']) == 2 )
            return '2';
        if(isset($_GET['cols']) && trim($_GET['cols']) == 3 )
            return '3';
        if(isset($_GET['cols']) && trim($_GET['cols']) == 4 )
            return '4';
    if($is_sidebar == 'is-sidebar-full'){
        return $opt_theme_options['opt_shop_columns_full'];
    }else{
        return $opt_theme_options['opt_shop_columns'];
    }
}

add_filter( 'loop_shop_per_page', 'givingwalk_get_products_per_page' ); 
function givingwalk_get_products_per_page(){
    global $opt_theme_options;

    $number_product = ( !empty($opt_theme_options['opt_shop_products']) ) ? $opt_theme_options['opt_shop_products'] : 8; 
    return $number_product;
}

function givingwalk_on_off_options(){
    global $opt_theme_options;
    
    if(isset($opt_theme_options['opt_disable_result_count_ordering']) && ($opt_theme_options['opt_disable_result_count_ordering']) == '1' ){
    	remove_action('woocommerce_before_shop_loop', 'woocommerce_result_count', 20);
    	remove_action('woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30);
    } 

    if(isset($opt_theme_options['opt_disable_product_related']) && ($opt_theme_options['opt_disable_product_related']) == '1' ){
    	remove_action('woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20);
    } 
}

add_filter( 'woocommerce_output_related_products_args', 'givingwalk_related_products_args' );
function givingwalk_related_products_args( $args ) {
    global $opt_theme_options;  
    if(isset($opt_theme_options) && !empty($opt_theme_options['opt_product_related_number'])){
        $args['posts_per_page'] = (int)$opt_theme_options['opt_product_related_number']; 
        $args['columns'] = (int)$opt_theme_options['opt_product_related_number']; 
    }else{
        $args['posts_per_page'] = 4;  
        $args['columns'] = 4;
    }
     
    return $args;
}

/* cropt catalog image */
add_filter('woocommerce_get_image_size_thumbnail', function ($size) {
    $size['width'] = 405;
    $size['height'] = 480;
    $size['crop'] = 1;
    return $size;
});

/* cropt single image */
add_filter('woocommerce_get_image_size_single', function ($size) {
    $size['width'] = 525;
    $size['height'] = 645;
    $size['crop'] = 1;
    return $size;
});

/* cropt single gallery image */
add_filter('woocommerce_get_image_size_gallery_thumbnail', function ($size) {
    $size['width'] = 250;
    $size['height'] = 250;
    $size['crop'] = 1;
    return $size;
});

add_filter( 'woocommerce_product_thumbnails_columns', 'givingwalk_thumbnails_columns' );
if (!function_exists('givingwalk_thumbnails_columns')) {
    function givingwalk_thumbnails_columns()
    {
        return 4;
    }
}

remove_action('woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_link_open', 10);
remove_action('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close', 5);

/** add div wrap loop product
 * add_action('woocommerce_before_shop_loop_item', 'givingwalk_wc_loop_open', 0);
 * add_action('woocommerce_after_shop_loop_item', 'givingwalk_wc_loop_close', 99999);
*/
add_action('woocommerce_before_shop_loop_item', 'givingwalk_wc_loop_open', 0);
if (!function_exists('givingwalk_wc_loop_open')) {
    function givingwalk_wc_loop_open()
    {
        echo '<div class="wc-product-wrap clearfix">';
    }
}
add_action('woocommerce_after_shop_loop_item', 'givingwalk_wc_loop_close', 99999);
if (!function_exists('givingwalk_wc_loop_close')) {
    function givingwalk_wc_loop_close()
    {
        echo '</div>';
    }
}

/* add div wrap image */
add_action('woocommerce_before_shop_loop_item_title', 'givingwalk_wc_loop_image_open', 0);
if (!function_exists('givingwalk_wc_loop_image_open')) {
    function givingwalk_wc_loop_image_open()
    {
        echo '<div class="wc-img-wrap"><a href="' . esc_url( get_permalink() ) . '">';
    }
}

/**
 * Change sale flash
 * woocommerce_before_shop_loop_item_title hook.
 *
 * @hooked givingwalk_woocommerce_show_product_loop_sale_flash - 10
 */
remove_action('woocommerce_before_shop_loop_item_title', 'woocommerce_show_product_loop_sale_flash', 10);
add_action('woocommerce_before_shop_loop_item_title', 'givingwalk_woocommerce_show_product_loop_sale_flash', 10);
if (!function_exists('givingwalk_woocommerce_show_product_loop_sale_flash')) {
    function givingwalk_woocommerce_show_product_loop_sale_flash()
    {
        global $product;
        if ( $product->is_on_sale()){
            if($product->get_type() == 'variable'){
                $regular_price = $product->get_variation_regular_price('max');
                $sales_price = $product->get_variation_sale_price('max');
               
            }elseif($product->get_type() == 'simple'){
                $regular_price = $product->get_regular_price();
                $sales_price = $product->get_sale_price();
            }
            if(isset($regular_price) && isset($sales_price)){
                $percentage = round( ( ( $regular_price - $sales_price ) / $regular_price ) * 100 );
                echo '<span class="onsale">-'. sprintf( '%s', $percentage . '%' ).'</span>';  
            }
        }
          
    }
}

if (!function_exists('givingwalk_wc_loop_image_close')) {
    function givingwalk_wc_loop_image_close()
    {
        echo '</a></div>';
    }
}
add_action('woocommerce_before_shop_loop_item_title', 'givingwalk_wc_loop_image_close', 9999);


remove_action('woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5);
add_action('woocommerce_shop_loop_item_title', 'givingwalk_wc_loop_content_open', 1);
function givingwalk_wc_loop_content_open(){
    echo '<div class="wc-loop-content-wrap">';
}

add_action('woocommerce_shop_loop_item_title', 'givingwalk_wc_loop_code_rating_open', 2);
function givingwalk_wc_loop_code_rating_open(){
    echo '<div class="wc-loop-code-rating clearfix">';
}

add_action('woocommerce_shop_loop_item_title', 'givingwalk_wc_get_code', 3);
function givingwalk_wc_get_code(){
    global $product;
    if ( ! $product->get_sku() ) return;
    echo '<div class="code">'.esc_html__('Code: ','givingwalk').esc_html( $product->get_sku() ).'</div>';
}
add_action('woocommerce_shop_loop_item_title', 'woocommerce_template_loop_rating', 8);

add_action('woocommerce_shop_loop_item_title', 'givingwalk_wc_loop_code_rating_close', 9);
function givingwalk_wc_loop_code_rating_close(){
    echo '</div>';
}

add_action('woocommerce_after_shop_loop_item', 'givingwalk_wc_loop_content_close', 999999);
function givingwalk_wc_loop_content_close(){
    echo '</div>';
}

 
/**
 * Change title structure
 * woocommerce_after_shop_loop_item hook.
 *
 * @hooked givingwalk_woocommerce_template_loop_product_title - 10
 */
remove_action('woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title', 10);
add_action('woocommerce_shop_loop_item_title', 'givingwalk_woocommerce_template_loop_product_title', 10);
if (!function_exists('givingwalk_woocommerce_template_loop_product_title')) {
    function givingwalk_woocommerce_template_loop_product_title()
    {
        the_title('<h5 class="wc-loop-title"><a href="' . esc_url( get_permalink() ) . '">', '</a></h5>' );
    }
}

/**
 * Change title structure
 * woocommerce_after_shop_loop hook.
 *
 * @hooked givingwalk_woocommerce_pagination - 10
 */
add_filter('woocommerce_pagination_args','givingwalk_pagination_args_filter');
function givingwalk_pagination_args_filter($args=array()){
    $args['prev_text'] = '<i class="fa fa-angle-double-left"></i>';
    $args['next_text'] = '<i class="fa fa-angle-double-right"></i>';
    
    return $args;
}
 

/* Single Product */
/* add div wrap image / summary */
add_action('woocommerce_before_single_product_summary', 'givingwalk_woo_wrap_image_summary_open', 0);
if (!function_exists('givingwalk_woo_wrap_image_summary_open')) {
    function givingwalk_woo_wrap_image_summary_open()
    {
        echo '<div class="img-summary-wrap row clearfix">';

    }
}
add_action('woocommerce_after_single_product_summary', 'givingwalk_woo_wrap_image_summary_close', 0);
if (!function_exists('givingwalk_woo_wrap_image_summary_close')) {
    function givingwalk_woo_wrap_image_summary_close()
    {
        echo '</div></div>';
    }
}
add_action('woocommerce_before_single_product_summary', 'givingwalk_woo_wrap_image_open', 1);
add_action('woocommerce_before_single_product_summary', 'givingwalk_woo_wrap_image_close', 999999);
if (!function_exists('givingwalk_woo_wrap_image_open')) {
    function givingwalk_woo_wrap_image_open()
    {
        echo '<div class="wc-single-img-wrap col-left">';
    }
}
if (!function_exists('givingwalk_woo_wrap_image_close')) {
    function givingwalk_woo_wrap_image_close()
    {
        echo '</div><div class="col-right">';
    }
}

/**
 * Change sale flash
 * woocommerce_before_single_product_summary hook.
 *
 * @hooked givingwalk_woocommerce_show_product_sale_flash - 10
 */
remove_action('woocommerce_before_single_product_summary', 'woocommerce_show_product_sale_flash', 10);
add_action('woocommerce_before_single_product_summary', 'givingwalk_wc_product_sale_flash', 10);
function givingwalk_wc_product_sale_flash(){
    global $product;
    if ( $product->is_on_sale()){
        if($product->get_type() == 'variable'){
            $regular_price = $product->get_variation_regular_price('max');
            $sales_price = $product->get_variation_sale_price('max');
        }elseif($product->get_type() == 'simple'){
            $regular_price = $product->get_regular_price();
            $sales_price = $product->get_sale_price();
        }
        if(isset($regular_price) && isset($sales_price)){
            $percentage = round( ( ( $regular_price - $sales_price ) / $regular_price ) * 100 );
            echo '<span class="onsale">-'. sprintf( '%s', $percentage . '%' ).'</span>';  
        }
    }
}

/* Remove single excerpt - 20 */
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_rating', 10);

/* add code to top of title - 1 */
add_action('woocommerce_single_product_summary', 'givingwalk_wc_add_code_rate', 1);
function givingwalk_wc_add_code_rate(){
    global $product;
    echo '<div class="code-rating">';
        if ( wc_product_sku_enabled() && $product->get_sku() ){
            echo '<div class="code">'.esc_html__('Code: ','givingwalk').esc_html( $product->get_sku() ).'</div>';
        }
        if ( 'no' !== get_option( 'woocommerce_enable_review_rating' )) {
            $rating_count = $product->get_rating_count();
            $review_count = $product->get_review_count();
            $average      = $product->get_average_rating();

            if ( $rating_count > 0 ){
                echo '<div class="woocommerce-product-rating">';
                    echo wc_get_rating_html( $average, $rating_count );
                echo '</div>';
            }
        }
    echo '</div>';
}

/* Change title structure */
if (!function_exists('woocommerce_template_single_title')) {
    function woocommerce_template_single_title()
    {
        the_title('<h3 class="product-title">', '</h3>');
    }
}


/* Remove single excerpt - 20 */
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20);

remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40);
add_action('woocommerce_single_product_summary', 'givingwalk_template_single_meta', 40);
function givingwalk_template_single_meta(){
    global $product;
    
    echo '<div class="product_meta">';
        do_action( 'woocommerce_product_meta_start' );
        echo wc_get_product_category_list( $product->get_id(), ', ', '<div class="posted_in"><span class="lbl">' . _n( 'Category:', 'Categories:', count( $product->get_category_ids() ), 'givingwalk' ) . '</span> ', '</div>' );
        echo wc_get_product_tag_list( $product->get_id(), ', ', '<div class="tagged_as"><span class="lbl">' . _n( 'Tag:', 'Tags:', count( $product->get_tag_ids() ), 'givingwalk' ) . '</span> ', '</div>' ); 
        do_action( 'woocommerce_product_meta_end' ); 
    echo '</div>';

}


add_filter('woocommerce_product_description_heading', function() { return ''; });

remove_action( 'woocommerce_product_additional_information', 'wc_display_product_attributes', 10 );

add_filter('woocommerce_product_additional_information_heading', function() { return ''; });
add_action( 'woocommerce_product_additional_information', 'givingwalk_wc_display_product_attributes', 10 );
function givingwalk_wc_display_product_attributes($product){
    global $post;
 
    $availability = $product->get_availability();

    $attributes = array_filter( $product->get_attributes(), 'wc_attributes_array_filter_visible' );
    $display_dimensions = apply_filters( 'wc_product_enable_dimensions_display', $product->has_weight() || $product->has_dimensions() );

    $short_description = apply_filters( 'woocommerce_short_description', $post->post_excerpt );
    $col_cls = isset($short_description ) ? 'col-12 col-lg-6 col-xl-6' : 'col-12';
    ?>
    <div class="addition-information-wrap row">
        <div class="<?php echo esc_attr($col_cls);?>">
            <span class="silent-heading"><?php echo esc_html__( 'Additional Information', 'givingwalk' ) ?></span>
            <table class="shop_attributes">
                <?php if ( ! empty( $availability['availability'] ) ):?>
                <tr>
                    <th><?php esc_html_e( 'Availability', 'givingwalk' ) ?></th>
                    <td class="product_stock"><?php echo wc_get_stock_html( $product ); ?></td>
                </tr>
                <?php endif; ?>
                <?php if ( $display_dimensions && $product->has_weight() ) : ?>
                    <tr>
                        <th><?php esc_html_e( 'Weight', 'givingwalk' ) ?></th>
                        <td class="product_weight"><?php echo esc_html( wc_format_weight( $product->get_weight() ) ); ?></td>
                    </tr>
                <?php endif; ?>

                <?php if ( $display_dimensions && $product->has_dimensions() ) : ?>
                    <tr>
                        <th><?php esc_html_e( 'Dimensions', 'givingwalk' ) ?></th>
                        <td class="product_dimensions"><?php echo esc_html( wc_format_dimensions( $product->get_dimensions( false ) ) ); ?></td>
                    </tr>
                <?php endif; ?>

                <?php foreach ( $attributes as $attribute ) : ?>
                    <tr>
                        <th><?php echo wc_attribute_label( $attribute->get_name() ); ?></th>
                        <td><?php
                            $values = array();

                            if ( $attribute->is_taxonomy() ) {
                                $attribute_taxonomy = $attribute->get_taxonomy_object();
                                $attribute_values = wc_get_product_terms( $product->get_id(), $attribute->get_name(), array( 'fields' => 'all' ) );

                                foreach ( $attribute_values as $attribute_value ) {
                                    $value_name = esc_html( $attribute_value->name );

                                    if ( $attribute_taxonomy->attribute_public ) {
                                        $values[] = '<a href="' . esc_url( get_term_link( $attribute_value->term_id, $attribute->get_name() ) ) . '" rel="tag">' . $value_name . '</a>';
                                    } else {
                                        $values[] = $value_name;
                                    }
                                }
                            } else {
                                $values = $attribute->get_options();

                                foreach ( $values as &$value ) {
                                    $value = make_clickable( esc_html( $value ) );
                                }
                            }

                            echo apply_filters( 'woocommerce_attribute', wpautop( wptexturize( implode( ', ', $values ) ) ), $attribute, $values );
                        ?></td>
                    </tr>
                <?php endforeach; ?>
            </table>
        </div>
        <?php
        
        if ( isset($short_description )) {
            echo '<div class="'. esc_attr($col_cls) .'">';
                echo '<span class="silent-heading">'. esc_html__( 'Product Features', 'givingwalk' ) .'</span>';
                echo '<div class="woocommerce-product-details__short-description">';
                    echo wp_kses_post($short_description);
                echo '</div>';    
            echo '</div>';    
        }
    ?>
    </div>
    <?php 
}

add_action('woocommerce_review_before_comment_meta', 'givingwalk_review_before_comment_meta_open', 0);
if (!function_exists('givingwalk_review_before_comment_meta_open')) {
    function givingwalk_review_before_comment_meta_open()
    {
        echo '<div class="comment-meta-wrap">';
    }
}

add_action('woocommerce_review_meta', 'givingwalk_woocommerce_review_meta_close', 999);
if (!function_exists('givingwalk_woocommerce_review_meta_close')) {
    function givingwalk_woocommerce_review_meta_close()
    {
        echo '</div>';
    }
}

/**
 * Remove field label
 * add_filter( 'woocommerce_form_field_args' , 'givingwalk_override_woocommerce_form_field' );
 */
//add_filter( 'woocommerce_form_field_args' , 'givingwalk_override_woocommerce_form_field' );
function givingwalk_override_woocommerce_form_field($args)
{
    $args['label'] = false;
    return $args;
}

add_action('woocommerce_before_checkout_form','givingwalk_wc_before_checkout_form');
function givingwalk_wc_before_checkout_form(){
    echo '<div class="checkout-heading">';
    echo '<h3 class="checkout-heading-title">'.esc_html__( 'Cart Checkout','givingwalk' ).'</h3>';
    echo '<span class="silent-heading"><a href="'.esc_url( apply_filters( 'woocommerce_return_to_shop_redirect', wc_get_page_permalink( 'shop' ) ) ).'">'.esc_html__( 'Return to shoping cart','givingwalk' ).'</a></span>';
    echo '</div>';
}

/* Overide checkout field */
add_filter( 'woocommerce_checkout_fields' , 'givingwalk_override_checkout_fields' );
function givingwalk_override_checkout_fields( $fields ) {
    $fields['billing']['billing_first_name']['placeholder'] = esc_html__('First Name *','givingwalk');
    $fields['billing']['billing_last_name']['placeholder'] = esc_html__('Last Name *','givingwalk');
    $fields['billing']['billing_company']['placeholder'] = esc_html__('Company Name','givingwalk');
    $fields['billing']['billing_email']['placeholder'] = esc_html__('Email Address *','givingwalk');
    $fields['billing']['billing_phone']['placeholder'] = esc_html__('Phone *','givingwalk');
    $fields['billing']['billing_city']['placeholder'] = esc_html__('Town / City *','givingwalk');
    $fields['billing']['billing_postcode']['placeholder'] = esc_html__('Postcode *','givingwalk');
    $fields['billing']['billing_state']['placeholder'] = esc_html__('State *','givingwalk');
    $fields['billing']['billing_country']['placeholder'] = esc_html__('Country *','givingwalk');

    $fields['shipping']['shipping_first_name']['placeholder'] = esc_html__('First Name *','givingwalk');
    $fields['shipping']['shipping_last_name']['placeholder'] = esc_html__('Last Name *','givingwalk');
    $fields['shipping']['shipping_company']['placeholder'] = esc_html__('Company Name','givingwalk');
    $fields['shipping']['shipping_city']['placeholder'] = esc_html__('Town / City *','givingwalk');
    $fields['shipping']['shipping_postcode']['placeholder'] = esc_html__('Postcode *','givingwalk');
    $fields['shipping']['shipping_state']['placeholder'] = esc_html__('State *','givingwalk');
    $fields['shipping']['shipping_country']['placeholder'] = esc_html__('Country *','givingwalk');
    
    $fields['account']['account_username']['placeholder'] = esc_html__('Username or email *','givingwalk');
    $fields['account']['account_password']['placeholder'] = esc_html__('Password *','givingwalk');
    $fields['account']['account_password-2']['placeholder'] = esc_html__('Retype Password *','givingwalk');

    $fields['order']['order_comments']['placeholder'] = esc_html__('Order Notes','givingwalk');

    /* Add Email/ Phone on Shipping fields*/
    $fields['shipping']['shipping_email'] = array(
        'label'         => esc_html__('Email Address', 'givingwalk'),
        'placeholder'   => _x('Email Address', 'placeholder', 'givingwalk'),
        'required'      => false,
        'class'         => array('form-row-first'),
        'clear'         => false
    );
    $fields['shipping']['shipping_phone'] = array(
        'label'         => esc_html__('Phone', 'givingwalk'),
        'placeholder'   => _x('Phone', 'placeholder', 'givingwalk'),
        'required'      => false,
        'class'         => array('form-row-last'),
        'clear'         => true,
        'order'         => '6'
    );

    return $fields;
}
