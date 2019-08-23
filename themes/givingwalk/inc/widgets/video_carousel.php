<?php
/**
 * Cms Certificates Widget
 * This widget allows you to pick multiple images and show at the front-end with some options
 */
if (!class_exists('EF4Framework')) return;
add_action('widgets_init', 'register_video_carousel_widget');
function register_video_carousel_widget() {
    register_ef4_widget('Cms_Video_Carousel_Widget');
}

class Cms_Video_Carousel_Widget extends WP_Widget
{
    /**
     * Constructor
     *
     * @return void
     **/
    function __construct()
    {
        parent::__construct(
            'cms_video_carousel', // Base ID
            esc_html__( 'Cms Video Carousel', 'givingwalk' ), // Name
            array(
                'description' => esc_html__( 'Add multiple images with some options and optional links.', 'givingwalk' ),
                'customize_selective_refresh' => true
            )  
        );
         
    }
     
    
    /**
     * Outputs the HTML for this widget.
     *
     * @param array $args An array of standard parameters for widgets in this theme
     * @param array $instance An array of settings for this widget instance
     * @return void Echoes it's output
     **/
    
    function widget( $args, $instance )
    {
        global $cms_carousel;
        if(!is_array($cms_carousel))
            $cms_carousel = [];
        extract( $args, EXTR_SKIP );

        $instance = wp_parse_args(
            (array) $instance,
            array(
                'title' => '',
                'images' => '',
                'urls'  => '',
                'desc' => '',
                'icon_class' => '',
                'size' => 'thumbnail'
            )
        );

        if ( ! empty( $instance['title'] ) )
        {
            $title = apply_filters( 'widget_title', $instance['title'], $instance, $this->id_base );
        }
          
        echo wp_kses_post($before_widget);

        if ( ! empty( $title ) )
        {
            echo wp_kses_post($before_title . $title . $after_title);
        }

        $images = $urls = $desc = array();

        if ( ! empty( $instance['images'] ) )
        {
            $images = explode( ",", $instance['images'] );
        }
        if ( ! empty( $instance['urls'] ) )
        {
            $urls = explode( "|", $instance['urls'] );
        }
        if ( ! empty( $instance['desc'] ) )
        {
            $desc = explode( "|", $instance['desc'] );
        }
        $icon_class = $instance['icon_class'] ;
        $size = $instance['size'] ;
        
        if ( ! empty( $images ) )
        {
            echo '<div id="video-carousel-wg" class="red-carousel owl-carousel">';

            for ( $i = 0; $i < count( $images ) ; $i++ )
            {
                echo '<div class="item vdeo-item">';
                    echo '<div class="content-video-item">';
                        if ( isset( $images[$i] ) && !empty( $images[$i] ) ){
                            echo '<div class="video-wrap" onclick="">';
                            echo givingwalk_get_image_crop_has_default( $images[$i], $size );
                                echo '<div class="video-inner">';
                                    if ( isset( $urls[$i] ) && !empty( $urls[$i] ) ){
                                        echo '<a href="'.esc_url($urls[$i]).'" class="v-url red-video-popup">';
                                        if(!empty($icon_class)) echo '<i class="'.esc_attr($icon_class).'"></i>';
                                        else echo '<i class="flaticon-movie-film"></i>';
                                        echo '</a>';
                                    }
                                    if ( isset( $desc[$i] ) && !empty( $desc[$i] ) ){
                                        echo '<p class="desc">'.esc_html($desc[$i]).'</p>';
                                    }
                                echo '</div>';
                            echo '</div>';
                        }
                    echo '</div>';
                echo '</div>';
            }
            echo '</div>';
        }

        echo wp_kses_post($after_widget);
        
        wp_enqueue_script('vc_pageable_owl-carousel');
        wp_enqueue_script('red-owlcarousel');
        wp_enqueue_style( 'vc_pageable_owl-carousel-css');
        wp_enqueue_style( 'animate-css');
         
        $cms_carousel['video-carousel-wg'] = array(
            'loop' => true,
            'mouseDrag' => true,
            'nav' => false,
            'dots' => false,
            'margin' => 0,
            'autoplay' => false,
            'autoplayTimeout' => 5000,
            'smartSpeed' => 1500,
            'autoplayHoverPause' => true,
            'navText' => array('<i class="fa fa-angle-left"></i>','<i class="fa fa-angle-right"></i>'),
            'responsive'         => array(
                0 => array(
                    'items' => 1,
                ),
                480 => array(
                    "items" => 1,
                ),
                768 => array(
                    'items' => 1,
                ),
                992 => array(
                    'items' => 1,
                ),
                1200 => array(
                    'items' => 1,
                ) 
            )
        );
    wp_localize_script('vc_pageable_owl-carousel', 'cmscarousel', $cms_carousel);
 
    }

    /**
     * Deals with the settings when they are saved by the admin. Here is
     * where any validation should be dealt with.
     *
     * @param array $new_instance An array of new settings as submitted by the admin
     * @param array $old_instance An array of the previous settings
     * @return array The validated and (if necessary) amended settings
     **/
    function update( $new_instance, $old_instance )
    {

        $instance = $old_instance;
        $instance['title'] = sanitize_text_field( $new_instance['title'] );
        $instance['images'] = sanitize_text_field( $new_instance['images'] );
          
        $urls = array();
        $urls_arr = explode( "\n", $new_instance['urls'] );
        foreach ( $urls_arr as $url)
        {
            $url = trim( $url );
            if ( empty( $url ) )
                continue;
            $urls[] = $url;
        }
        $instance['urls'] = implode( "|", $urls );
        
        $desc = array();
        $desc_arr = explode( "\n", $new_instance['desc'] );
        foreach ( $desc_arr as $des)
        {
            $des = trim( $des );
            if ( empty( $des ) )
                continue;
            $desc[] = $des;
        }
        $instance['desc'] = implode( "|", $desc );
        
        $instance['icon_class'] = sanitize_text_field( $new_instance['icon_class'] ); 
        $instance['size'] = sanitize_text_field( $new_instance['size'] ); 
          
        return $instance;
    }
     
    /**
     * Displays the form for this widget on the Widgets page of the WP Admin area.
     *
     * @param array  An array of the current settings for this widget
     * @return void Echoes it's output
     **/
    function form( $instance )
    {
        $instance = wp_parse_args(
            (array) $instance,
            array(
                'title' => '',
                'images' => '',
                'urls' => '',
                'desc' => '',
                'icon_class' => '',
            )
        );

        $image_holder = $this->get_field_id( 'images' ) . '-' . givingwalk_generate_uiqueid();
        $title      = isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : '';
        $image_ids  = explode( ",", $instance['images'] );
        $urls       = explode( "|", $instance['urls'] );
        $desc       = explode( "|", $instance['desc'] );
        $icon_class = !empty( $instance['icon_class'] ) ? esc_attr( $instance['icon_class'] ) : '';
        $size = !empty( $instance['size'] ) ? esc_attr( $instance['size'] ) : 'thumbnail';
        ?>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Title:', 'givingwalk' ); ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
        </p>
         
        <div class="redexp-widget-image">
            <input type="hidden" name="<?php echo esc_attr($this->get_field_name( 'images' )); ?>" id="<?php echo esc_attr($this->get_field_id( 'images' )); ?>" value="<?php echo esc_attr( $instance['images'] ); ?>"/>
            <label><?php esc_html_e( 'Images', 'givingwalk' ); ?></label>
            <ul class="redexp-mu-images" id="<?php echo esc_attr( $image_holder ); ?>" data-img-mu-field="<?php echo esc_attr($this->get_field_id( 'images' )); ?>"><?php
            foreach ( $image_ids as $image )
            {
                $attachment_image = wp_get_attachment_image_src( $image, 'thumbnail' );
                if ( ! empty( $attachment_image ) )
                {
                    printf(
                        '<li data-id="%1$s" style="background-image:url(%2$s);">',
                        esc_attr( $image ),
                        esc_url( $attachment_image[0] )
                    );

                    printf(
                        '<a class="image-edit" href="#" onclick="RedExpMedia.Images.edit(event,%s);"><i class="dashicons dashicons-edit"></i></a>',
                        esc_attr( '"' . $image_holder . '"' )
                    );

                    printf(
                        '<a class="image-delete" href="#" onclick="RedExpMedia.Images.remove(event,%s);"><i class="dashicons dashicons-trash"></i></a>',
                        esc_attr( '"' . $image_holder . '"' )
                    );

                    echo '</li>';
                }
            }
            printf(
                '<li data-id="0"><a class="image-add" href="#" onclick="RedExpMedia.Images.add(event,%s);"><i class="dashicons dashicons-plus-alt"></i></a></li>',
                esc_attr( '"' . $image_holder . '"' )
            );
            ?></ul>
            
        </div>

        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'size' ) ); ?>"><?php esc_html_e( 'Image size(thumbnail,270x295,...:', 'givingwalk' ); ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'size' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'size' ) ); ?>" type="text" value="<?php echo esc_attr( $size ); ?>" />
        </p>

        <label for="<?php echo esc_attr( $this->get_field_id( 'urls' ) ); ?>"><?php echo esc_html__( 'Video url', 'givingwalk' ); ?></label>
        <textarea class="image-urls widefat" id="<?php echo esc_attr( $this->get_field_id( 'urls' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'urls' ) ); ?>" rows="10"><?php
            foreach ( $urls as $url ) {
                if ( empty( $url ) ) {
                    continue;
                }
                echo esc_attr($url) ;
                echo "\n";
            }
        ?></textarea>
        <p class="howto"><?php echo esc_html__( 'Add video url for images, seperate by newline.', 'givingwalk' ); ?></p>
        
        <label for="<?php echo esc_attr( $this->get_field_id( 'desc' ) ); ?>"><?php echo esc_html__( 'description', 'givingwalk' ); ?></label>
        <textarea class="image-descs widefat" id="<?php echo esc_attr( $this->get_field_id( 'desc' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'desc' ) ); ?>" rows="10"><?php
            foreach ( $desc as $des ) {
                if ( empty( $des ) ) {
                    continue;
                }
                echo esc_html($des) ;
                echo "\n";
            }
        ?></textarea>
        <p class="howto"><?php echo esc_html__( 'Add description for images, seperate by newline.', 'givingwalk' ); ?></p>
        
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'icon_class' ) ); ?>"><?php esc_html_e( 'Icon class:', 'givingwalk' ); ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'icon_class' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'icon_class' ) ); ?>" type="text" value="<?php echo esc_attr( $icon_class ); ?>" />
        </p>
        <?php
    }
}
