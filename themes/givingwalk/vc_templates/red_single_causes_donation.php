<?php 
$extra_text = '';
$content_css = $title_css = array();

$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$css_class = '';
$classes=array('red-single-causes-donation');
if(!empty($atts['css'])){
    $classes[]=vc_shortcode_custom_css_class($atts['css']);
}

$css_class = preg_replace( '/\s+/', ' ', apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, implode( ' ', array_filter( $classes ) ), $this->settings['base'], $atts ) );

$layout_mode = !empty($layout_mode) ? $layout_mode : '1';

$overlap_bottom_cls = (isset($overlap_bottom) && $overlap_bottom && $layout_mode == '2') ? 'overlap-bottom' : '';

if(!empty($content_color)){
    $content_css[] ='color:'.$content_color;
}
if(!empty($title_color)){
    $title_css[] ='color:'.$title_color;
}

global $wp_query;
if( !empty($cause_id) && ((int)$cause_id) > 0){
    $ids = explode(',',$cause_id);
    $id = $ids[rand(0,count($ids)-1)];
    $args = [
        'post_type'=>'crw_causes',
        'post__in' => array($id), 
    ]; 
}else{
    $args = [
        'post_type'=>'crw_causes',
        'post_status' => 'publish',
        'posts_per_page'=>'1',
        'orderby'=>'date',
        'order'=>'DESC'
    ];
}

$posts = $wp_query = new WP_Query($args);

if ($posts -> have_posts() ) :
    ?>
    <div class="<?php echo esc_attr($css_class);?> <?php echo esc_attr('layout-'.$layout_mode);?> <?php echo esc_attr($overlap_bottom_cls);?>" style="<?php echo join(';',$content_css);?>">
        <?php
        while ( $posts -> have_posts() ) : $posts -> the_post();
            $meta = apply_filters('ef4_get_post_meta',[
                    'start_date_time'=>'',
                    'end_date_time'=>'',
                    'donation_goal'=>'',
                    'donation_raised'=>'',
            ],get_the_ID(),false);
            if($layout_mode == '1'){
                $max_time = $meta['end_date_time'];
                $min_time = $meta['start_date_time'];
                $now = time();
                $raised = (float)$meta['donation_raised'];
                $goal = (float)$meta['donation_goal'];
                echo '<div class="progress-amount-wrap">';
                    if(!empty($min_time) && !empty($max_time))
                    {
                        $min_time = (is_numeric($min_time)) ? $min_time : strtotime($min_time);
                        $max_time = (is_numeric($max_time)) ? $max_time : strtotime($max_time);
                        if($now > $min_time && $now < $max_time){
                            $max_time_left = $max_time - $min_time;
                            $current_time_left = $now - $min_time;
                            $pecent_val = ($current_time_left / $max_time_left)*100;
                            $pecent_round = number_format($pecent_val,2);
                            $pecent_round_org = $pecent_round;
                            if($pecent_round > 100) $pecent_round = 100;
                            echo '<div class="datetime-progress">';
                                echo '<div class="p-col-left"><span class="p-lable" style="'. join(';',$content_css).'">'.esc_html__( 'Donation Time','givingwalk' ).'</span></div>';
                                echo '<div class="give-progress-bar" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="'.esc_attr($pecent_round).'">';
                                    echo '<span style="width: '.esc_attr($pecent_round).'%;">'.esc_html($pecent_round_org).'%</span>';
                                echo '</div>';
                            echo '</div>';
                        }
                    }
                    if(!empty($raised) && !empty($goal) && $goal > 0)
                    {
                        $pecent_val = ($raised / $goal)*100;
                        $pecent_round = number_format($pecent_val,2);
                        $pecent_round_org = $pecent_round;
                        if($pecent_round > 100) $pecent_round = 100;
                        $raised_value = apply_filters('ef4_payment_create_amount','$'.$raised,$raised);
                        echo '<div class="donate-progress">';
                            echo '<div class="p-col-left">';
                                echo '<span class="p-lable" style="'. join(';',$content_css) .'">'.esc_html__( 'Donation Raised','givingwalk' ).'</span>';
                                echo '<span class="p-value">'.esc_html( $raised_value ).'</span>';
                            echo '</div>';
                            echo '<div class="give-progress-bar" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="'.esc_attr($pecent_round).'">';
                                echo '<span style="width: '.esc_attr($pecent_round).'%;">'.esc_html($pecent_round_org).'%</span>';
                            echo '</div>';
                        echo '</div>';
                    }
                    givingwalk_show_donate_button(['id'=>get_the_ID(),'class'=>'btn btn-alt']);
                    if(!empty($extra_text))
                        echo '<span class="extra-text">'.esc_html( $extra_text ).'</span>';
                echo '</div>';   
            }
            if($layout_mode == '2'){
                $goal = (float)$meta['donation_goal'];
                $raised = (float)$meta['donation_raised'];
                $goal_value = apply_filters('ef4_payment_create_amount','$'.$goal,$goal);
                $raised_value = apply_filters('ef4_payment_create_amount','$'.$raised,$raised);

                ?>
                <div class="row">
                    <div class="col-left col-12 col-lg-6">
                        <?php echo givingwalk_get_image_crop(get_post_thumbnail_id(get_the_ID()), '350x468'); ?>
                    </div>
                    <div class="col-12 col-lg-6">
                        <div class="single-cause-info">
                            <?php 
                            if(!empty($custom_title))
                                echo '<h2 class="entry-title" style="'. join(';',$title_css).'"><a href="' . esc_url( get_permalink() ) . '">'.esc_html( $custom_title ).'</a></h2>';
                            else
                                the_title( '<h2 class="entry-title" style="'. join(';',$title_css).'"><a href="' . esc_url( get_permalink() ) . '">', '</a></h2>' ); 
                            ?>
                            <div class="d-amount d-goal">
                                <span class="lbl" style="<?php echo join(';',$content_css);?>"><?php echo esc_html__('Donation Target: ','givingwalk');?></span>
                                <span class="amount"><?php echo esc_html($goal_value);?></span>
                            </div>
                            <div class="d-amount">
                                <span class="lbl" style="<?php echo join(';',$content_css);?>"><?php echo esc_html__('Donation Raised: ','givingwalk');?></span>
                                <span class="amount"><?php echo esc_html($raised_value);?></span>
                            </div>
                            <div class="desc"><?php the_excerpt(); ?></div>
                            <div class="button-action">
                                <?php givingwalk_show_donate_button(['id'=>get_the_ID()]); ?>
                                <a href="<?php the_permalink()?>" class="btn btn-alt"><?php echo esc_html__('Read More','givingwalk'); ?></a>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
            }
            if($layout_mode == '3'){
                $goal = (float)$meta['donation_goal'];
                $raised = (float)$meta['donation_raised'];
                $goal_value = apply_filters('ef4_payment_create_amount','$'.$goal,$goal);
                $raised_value = apply_filters('ef4_payment_create_amount','$'.$raised,$raised);

                ?>
                <div class="row align-items-center">
                    <div class="col-12 col-lg-5">
                        <?php 
                        if(!empty($custom_title))
                            echo '<h2 class="entry-title" style="'. join(';',$title_css).'"><a href="' . esc_url( get_permalink() ) . '">'.esc_html( $custom_title ).'</a></h2>';
                        else
                            the_title( '<h2 class="entry-title" style="'. join(';',$title_css).'"><a href="' . esc_url( get_permalink() ) . '">', '</a></h2>' ); 

                        if(!empty($extra_text))
                            echo '<span class="extra-text">'.esc_html( $extra_text ).'</span>';
                        ?>     
                    </div>
                    <div class="col-12 col-md-auto">
                        <div class="d-amount-wrap row">
                            <div class="d-amount d-goal col-auto">
                                <span class="lbl" style="<?php echo join(';',$content_css);?>"><?php echo esc_html__('Donation Target','givingwalk');?></span>
                                <span class="amount"><?php echo esc_html($goal_value);?></span>
                            </div>
                            <div class="d-amount col-auto">
                                <span class="lbl" style="<?php echo join(';',$content_css);?>"><?php echo esc_html__('Donation Raised','givingwalk');?></span>
                                <span class="amount"><?php echo esc_html($raised_value);?></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-auto">
                        <div class="button-action">
                            <?php givingwalk_show_donate_button(['id'=>get_the_ID()]); ?>
                        </div>
                    </div> 
                </div>
                <?php
            }
        endwhile;  
        wp_reset_postdata(); 
        ?> 
    </div>
<?php 
else:
    esc_html_e('Invalid source config','givingwalk');
endif;
