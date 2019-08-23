<?php
if ( ! function_exists( 'consultax_page_header' ) ) {
    function consultax_page_header (){
        if ( function_exists('rwmb_meta') ) {
            if( is_home() || is_singular('post') || is_archive() || is_search() ){
                $pheader = rwmb_meta('pheader_switch', "type=switch", get_option( 'page_for_posts' ));
                if( class_exists( 'WooCommerce' ) ){
                    if( is_shop() || is_product_category() || is_product_tag() || is_singular('product') ){
                        $pheader = rwmb_meta('pheader_switch', "type=switch", get_option( 'woocommerce_shop_page_id' ));
                    }
                }
            }elseif( is_singular('product') ){
                $pheader = rwmb_meta('pheader_switch', "type=switch", get_option( 'woocommerce_shop_page_id' ));
            }else{
                $pheader = rwmb_meta('pheader_switch');
            }
            if( !$pheader || is_404() ){
                return;
            }
        }
        if( !consultax_get_option('pheader_switch') && !$pheader ) {
            return;
        }else{
            $bg     = '';
            $title  = '';
            $output = array();

            if ( is_home() ) {
                $title = get_the_title(get_option('page_for_posts'));
            } elseif ( is_search() ) {
                $title = esc_html__('Search Results for: ', 'consultax') . get_search_query();
            } elseif ( is_archive() ) {
                $title = get_the_archive_title();
            } else {
                $title = get_the_title();
            }

            if (!function_exists('rwmb_meta')) {
                $bg = consultax_get_option( 'pheader_img' );
            } else {
                if( is_home() ) {
                    $images = rwmb_meta('pheader_bg_image', "type=image", get_option( 'page_for_posts' ));
                }elseif( class_exists( 'WooCommerce' ) && is_shop() ){
                    $images = rwmb_meta('pheader_bg_image', "type=image", get_option( 'woocommerce_shop_page_id' ));
                }else{
                    $images = rwmb_meta('pheader_bg_image', "type=image");
                }
                if (!$images) {
                    $bg = consultax_get_option( 'pheader_img' );
                } else {
                    foreach ($images as $image) {
                        $bg = $image['full_url'];
                        break;
                    }
                }
            }

            if ($title) {
                $output[] = sprintf('%s', $title);
            }

        ?>
        
        <div class="page-header" <?php if ($bg) { ?> style="background-image: url(<?php echo esc_url($bg); ?>);" <?php } ?>>
            <div class="container">
                <div class="breadc-box<?php if ( $bg || consultax_get_option( 'pheader_color' ) ) echo ' no-line'; ?>">
                    <div class="row">
                        <div class="col-md-6">
                            <?php if( class_exists( 'WooCommerce' ) && is_shop() ) { ?>
                                    <h1 class="page-title"><?php woocommerce_page_title(); ?></h1>
                                <?php }else{ ?>
                                    <h1 class="page-title"><?php echo implode('', $output); ?></h1>
                                <?php } ?>
                        </div>
                        <div class="col-md-6 mobile-left text-right">
                            <?php 
                                if (function_exists('consultax_breadcrumbs') && consultax_get_option('breadcrumbs')):
                                    echo consultax_breadcrumbs();
                                endif;
                             ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php
        }
    }
}