<?php
if (!class_exists('EF4Framework')) return;
function GivingWalkSocialWidget() {
    register_ef4_widget('GivingwalkSocialWidget');
}
add_action('widgets_init', 'GivingwalkSocialWidget');

class GivingWalkSocialWidget extends WP_Widget {

    function __construct() {
        parent::__construct(
            'GivingwalkSocialWidget', // Base ID
            esc_html__('Givingwalk Social', 'givingwalk'), // Name
            array('description' => esc_html__('Social Widget', 'givingwalk'),) // Args
        );
    }

    function widget($args, $instance) {
        extract($args);
		if (!empty($instance['title'])) {
            $title = apply_filters('widget_title', empty($instance['title']) ? esc_html__('Social', 'givingwalk' ) : $instance['title'], $instance, $this->id_base);
        }
        $source = '';
        if(!empty($instance['source'])){
            $source = $instance['source'];
        }
        $style = '';
        if(!empty($instance['style'])){
            $style = $instance['style'];
        }
        $color_mode = '';
        if(!empty($instance['color_mode'])){
            $color_mode = $instance['color_mode'];
        }
        $shape_mode = '';
        if(!empty($instance['shape_mode'])){
            $shape_mode = $instance['shape_mode'];
        }
        $icon_size = '';
        if(!empty($instance['icon_size'])){
            $icon_size = $instance['icon_size'];
        }
        $align = '';
        if(!empty($instance['align'])){
            $align = $instance['align'];
        }
        $extra_class = !empty($instance['extra_class']) ? $instance['extra_class'] : "";
        if(is_rtl()){
            $extra_class .= ' rtl';
        }
        // no 'class' attribute - add one with the value of width
        if( strpos($before_widget, 'class') === false ) {
            $before_widget = str_replace('>', 'class="'. $extra_class . '"', $before_widget);
        }
        // there is 'class' attribute - append width value to it
        else {
            $before_widget = str_replace('class="', 'class="'. $extra_class . ' ', $before_widget);
        }
        echo wp_kses_post($before_widget);
            if (!empty($title))
                echo wp_kses_post($before_title . $title . $after_title);
            if($source === ''){
                givingwalk_social_list('','<div class="red-social '.$style.' '.$align.' '.$color_mode.' '.$shape_mode.' '.$icon_size.' clearfix">','</div>');
            } else {
                echo '<div class="red-social '.$style.' '.$align.' '.$color_mode.' '.$shape_mode.' '.$icon_size.' clearfix">';
                for($i=1; $i<=10; $i++){
                    $icon_i = isset($instance['icon_'.$i]) ? $instance['icon_'.$i] : '';
                    $link_i = isset($instance['link_'.$i]) ? $instance['link_'.$i] : '';
                    if(!empty($icon_i) && !empty($link_i))
                        echo '<a target="_blank" href="'.esc_url($link_i).'"><i class="'.esc_attr($icon_i).'"></i></a>';
                }
                echo "</div>";
            }   
        echo wp_kses_post($after_widget);
    }

    function update( $new_instance, $old_instance ) {
        $instance                = $old_instance;
        $instance['title']       = strip_tags($new_instance['title']);
        $instance['source']      = $new_instance['source'];
        $instance['style']       = $new_instance['style'];
        $instance['color_mode']  = $new_instance['color_mode'];
        $instance['shape_mode']  = $new_instance['shape_mode'];
        $instance['icon_size']   = $new_instance['icon_size'];
        $instance['align']       = $new_instance['align'];
        $instance['extra_class'] = $new_instance['extra_class'];

        for($i=1; $i<=10; $i++){
            $instance['icon_'.$i] = strip_tags($new_instance['icon_'.$i]);
            $instance['link_'.$i] = strip_tags($new_instance['link_'.$i]);
        }
        return $instance;
    }

    function form( $instance ) {
            $title       = isset($instance['title']) ? esc_attr($instance['title']) : '';
            $source      = isset($instance['source']) ? esc_attr($instance['source']) : '';
            $style       = isset($instance['style']) ? esc_attr($instance['style']) : '';
            $color_mode  = isset($instance['color_mode']) ? esc_attr($instance['color_mode']) : '';
            $shape_mode  = isset($instance['shape_mode']) ? esc_attr($instance['shape_mode']) : '';
            $icon_size   = isset($instance['icon_size']) ? esc_attr($instance['icon_size']) : '';
            $align       = isset($instance['align']) ? esc_attr($instance['align']) : '';
            $extra_class = isset($instance['extra_class']) ? esc_attr($instance['extra_class']) : '';
        ?>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php esc_html_e( 'Title:', 'givingwalk' ); ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id('title') ); ?>" name="<?php echo esc_attr( $this->get_field_name('title') ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
        </p>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('source')); ?>"><?php esc_html_e( 'Source:', 'givingwalk' ); ?></label>
            <select class="widefat" id="<?php echo esc_attr( $this->get_field_id('source') ); ?>" name="<?php echo esc_attr( $this->get_field_name('source') ); ?>">
                <option value="" <?php if( $source == '' ){ echo 'selected="selected"';} ?>><?php esc_html_e('From Theme', 'givingwalk'); ?></option>
                <option value="custom" <?php if( $source == 'custom' ){ echo 'selected="selected"';} ?>><?php esc_html_e('Custom', 'givingwalk'); ?></option>
            </select>
        </p>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('style')); ?>"><?php esc_html_e( 'Layout Mode:', 'givingwalk' ); ?></label>
            <select class="widefat" id="<?php echo esc_attr( $this->get_field_id('style') ); ?>" name="<?php echo esc_attr( $this->get_field_name('style') ); ?>">
                <option value="" <?php if( $style == '' ){ echo 'selected="selected"';} ?>><?php esc_html_e('Default', 'givingwalk'); ?></option>
            </select>
        </p>
        
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('color_mode')); ?>"><?php esc_html_e( 'Color Mode:', 'givingwalk' ); ?></label>
            <select class="widefat" id="<?php echo esc_attr( $this->get_field_id('color_mode') ); ?>" name="<?php echo esc_attr( $this->get_field_name('color_mode') ); ?>">
                <option value="" <?php if( $color_mode == '' ){ echo 'selected="selected"';} ?>><?php esc_html_e('Default', 'givingwalk'); ?></option>
                <option value="text-colored" <?php if( $color_mode == 'text-colored' ){ echo 'selected="selected"';} ?>><?php esc_html_e('Colored', 'givingwalk'); ?></option>
                <option value="bg-colored" <?php if( $color_mode == 'bg-colored' ){ echo 'selected="selected"';} ?>><?php esc_html_e('Background Colored', 'givingwalk'); ?></option>
            </select>
        </p>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('shape_mode')); ?>"><?php esc_html_e( 'Shape Mode:', 'givingwalk' ); ?></label>
            <select class="widefat" id="<?php echo esc_attr( $this->get_field_id('shape_mode') ); ?>" name="<?php echo esc_attr( $this->get_field_name('shape_mode') ); ?>">
                <option value="" <?php if( $shape_mode == '' ){ echo 'selected="selected"';} ?>><?php esc_html_e('Default', 'givingwalk'); ?></option>
                <option value="square" <?php if( $shape_mode == 'square' ){ echo 'selected="selected"';} ?>><?php esc_html_e('Square', 'givingwalk'); ?></option>
                <option value="rounded" <?php if( $shape_mode == 'rounded' ){ echo 'selected="selected"';} ?>><?php esc_html_e('Rounded', 'givingwalk'); ?></option>
                <option value="circle" <?php if( $shape_mode == 'circle' ){ echo 'selected="selected"';} ?>><?php esc_html_e('Circle', 'givingwalk'); ?></option>
                <option value="square outline" <?php if( $shape_mode == 'square outline' ){ echo 'selected="selected"';} ?>><?php esc_html_e('Square Outline', 'givingwalk'); ?></option>
                <option value="rounded outline" <?php if( $shape_mode == 'rounded outline' ){ echo 'selected="selected"';} ?>><?php esc_html_e('Rounded Outline', 'givingwalk'); ?></option>
                <option value="circle outline" <?php if( $shape_mode == 'circle outline' ){ echo 'selected="selected"';} ?>><?php esc_html_e('Circle Outline', 'givingwalk'); ?></option>
            </select>
        </p>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('icon_size')); ?>"><?php esc_html_e( 'Icon Size:', 'givingwalk' ); ?></label>
            <select class="widefat" id="<?php echo esc_attr( $this->get_field_id('icon_size') ); ?>" name="<?php echo esc_attr( $this->get_field_name('icon_size') ); ?>">
                <option value="" <?php if( $icon_size == '' ){ echo 'selected="selected"';} ?>><?php esc_html_e('Default', 'givingwalk'); ?></option>
                <option value="small" <?php if( $icon_size == 'small' ){ echo 'selected="selected"';} ?>><?php esc_html_e('Small', 'givingwalk'); ?></option>
                <option value="medium" <?php if( $icon_size == 'medium' ){ echo 'selected="selected"';} ?>><?php esc_html_e('Medium', 'givingwalk'); ?></option>
                <option value="large" <?php if( $icon_size == 'large' ){ echo 'selected="selected"';} ?>><?php esc_html_e('Large', 'givingwalk'); ?></option>
            </select>
        </p>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('align')); ?>"><?php esc_html_e( 'Content Align:', 'givingwalk' ); ?></label>
            <select class="widefat" id="<?php echo esc_attr( $this->get_field_id('align') ); ?>" name="<?php echo esc_attr( $this->get_field_name('align') ); ?>">
                <option value="" <?php if( $align == '' ){ echo 'selected="selected"';} ?>><?php esc_html_e('Default', 'givingwalk'); ?></option>
                <option value="text-left" <?php if( $align == 'text-left' ){ echo 'selected="selected"';} ?>><?php esc_html_e('Left', 'givingwalk'); ?></option>
                <option value="text-center" <?php if( $align == 'text-center' ){ echo 'selected="selected"';} ?>><?php esc_html_e('Center', 'givingwalk'); ?></option>
                <option value="text-right" <?php if( $align == 'text-right' ){ echo 'selected="selected"';} ?>><?php esc_html_e('Right', 'givingwalk'); ?></option>
            </select>
        </p>
        <p>
            <label for=""><?php esc_html_e( 'All options below just work when SOURCE option is CUSTOM', 'givingwalk' ); ?></label>
        </p>
        <?php
         for($i=1; $i<=10; $i++){
            $icon_i = isset($instance['icon_'.$i]) ? esc_attr($instance['icon_'.$i]) : '';
            $link_i = isset($instance['link_'.$i]) ? esc_attr($instance['link_'.$i]) : '';
         ?>
             <p>
             <label for="<?php echo esc_attr($this->get_field_id('icon_'.$i)); ?>"><?php esc_html_e( 'Icon', 'givingwalk' ); ?> <?php echo esc_attr($i);?></label>
             <input class="widefat" id="<?php echo esc_attr( $this->get_field_id('icon_'.$i) ); ?>"  name="<?php echo esc_attr( $this->get_field_name('icon_'.$i) ); ?>" type="text" value="<?php echo esc_attr( $icon_i ); ?>" placeholder="fa fa-facebook" />
             </p>
             <p>
             <label for="<?php echo esc_attr($this->get_field_id('link_'.$i)); ?>"><?php esc_html_e( 'Link', 'givingwalk' ); ?> <?php echo esc_attr($i);?></label>
             <input class="widefat" id="<?php echo esc_attr( $this->get_field_id('link_'.$i) ); ?>" name="<?php echo esc_attr( $this->get_field_name('link_'.$i) ); ?>" type="text" value="<?php echo esc_attr( $link_i ); ?>" placeholder="https://facebook.com" /></p>
         <?php   
         }
         ?>   
        <label for="<?php echo esc_attr($this->get_field_id('extra_class')); ?>"><?php esc_html_e('Extra Class','givingwalk');?>:</label>
        <input class="widefat" id="<?php echo esc_attr($this->get_field_id('extra_class')); ?>" name="<?php echo esc_attr($this->get_field_name('extra_class')); ?>" value="<?php echo esc_attr($extra_class); ?>" />
        </p>
    <?php
    }

}
?>