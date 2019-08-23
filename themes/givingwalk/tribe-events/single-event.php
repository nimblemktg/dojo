<?php
/**
 * List View Single Event
 * This file contains one event in the list view
 *
 * Override this template in your own theme by creating a file at [your-theme]/tribe-events/list/single-event.php
 *
 * @version 4.6.19
 *
 */
if ( ! defined( 'ABSPATH' ) ) {
    die( '-1' );
}

$events_label_singular = tribe_get_event_label_singular();
$events_label_plural   = tribe_get_event_label_plural();

$event_id = get_the_ID();

$organizer_ids = tribe_get_organizer_ids();

$organic_name = array();
foreach ( $organizer_ids as $organizer ) {
    if ( ! $organizer ) {
        continue;
    }
    $organizer_post = get_post($organizer);
    $organic_name[] = $organizer_post->post_title;
}

$venue_id = tribe_get_venue_id();

$phone = tribe_get_organizer_phone();
$email = tribe_get_organizer_email();
$website = tribe_get_event_website_link();
$map = tribe_get_embedded_map();
?>

<div id="tribe-events-contents" class="tribe-events-single">
 
    <?php tribe_the_notices() ?>
 
    <?php while ( have_posts() ) :  the_post(); ?>
        <div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
            <!-- Event featured image, but exclude link -->
            <?php echo tribe_event_featured_image( $event_id, 'large', false ); ?>
            <div class="event-content-wrap">
                <div class="single-event-top-wrap">
                    <div class="col-left">
                        <span class="event-day"><?php echo get_the_date('d');?></span>
                        <span class="event-month"><?php echo get_the_date('M');?></span>
                    </div>
                    <div class="col-right">
                        <?php the_title( '<h3 class="single-event-title">', '</h3>' ); ?>
                        <div class="org-name"><span><?php echo esc_html__('Organized By:','givingwalk');?></span> <?php echo join(', ',$organic_name); ?></div>
                        <div class="events-schedule">
                            <div class="event-date-start">
                                <span><?php echo esc_html__('Started:','givingwalk');?></span> <?php echo tribe_get_start_date(null,true,'j F Y',null); ?> <?php echo esc_html__('at','givingwalk');?> <?php echo tribe_get_start_time(null,'g:i a',null); ?>
                            </div>
                            <div class="event-date-end">
                                <span><?php echo esc_html__('Ending:','givingwalk');?></span> <?php echo tribe_get_end_date(null,true,'j F Y',null); ?> <?php echo esc_html__('at','givingwalk');?> <?php echo tribe_get_end_time(null,'g:i a',null); ?>
                            </div>
                        </div>
                        <?php if($venue_id){ 
                            $location_add = tribe_get_address( $venue_id );
                            if(!empty($location_add))
                                echo '<p class="location"><i class="flaticon-signs"></i>'.esc_html($location_add).'</p>';
                        }?>
                        <div class="event-meta">
                            <div class="meta-left">
                                <?php if(!empty($phone)): ?>
                                <p><i class="flaticon-phone-call"></i><?php echo esc_html( $phone ); ?></p>
                                <?php endif; ?>
                                <?php if(!empty($email)): ?>
                                <p><i class="flaticon-email"></i><?php echo esc_html( $email ); ?></p>
                                <?php endif; ?>
                                <?php if(!empty($website)): ?>
                                <p><i class="fa fa-globe"></i><?php echo wp_kses_post( $website ); ?></p>
                                <?php endif; ?>
                            </div>
                            <div class="event-action">
                                <?php givingwalk_show_buy_ticket_button();?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="single-event-content">
                    <div class="single-event-desc">
                        <?php the_content(); ?>    
                    </div>
                    <?php givingwalk_single_events_facilities(); ?>
                    <?php 
                    $map_type = get_post_meta($venue_id,'crw_map_type',true);
                    switch ($map_type) {
                        case 'use-img':
                            $map_img = get_post_meta($venue_id,'crw_map_img',true);
                            if(!empty($map_img)){
                                echo '<div class="single-event-map">';
                                echo '<img src="'.wp_get_attachment_url($map_img).'" alt="'.get_the_title($venue_id).'"/>';
                                echo '</div>';
                            }
                        break;
                        case 'use-embed':
                            $map_embed = get_post_meta($venue_id,'crw_map_embed',true);
                            if(!empty($map_embed)){
                                echo '<div class="single-event-map">';
                                echo wp_kses( $map_embed,array('iframe' => array('src'=>array(),'width' => array(),'height' => array(),'frameborder'=>array(),'style'=>array())) );
                                echo '</div>';
                            }
                        break;
                        default:
                            if ( !empty( $map ) ): ?>
                                <div class="events-map">
                                    <?php
                                    do_action( 'tribe_events_single_meta_map_section_start' );
                                    echo wp_kses_post($map);
                                    do_action( 'tribe_events_single_meta_map_section_end' );
                                    ?>
                                </div>
                            <?php 
                            endif;
                        break;
                    }
                    givingwalk_single_events_get_involved(); ?>
                    <?php givingwalk_single_events_gallery(); ?>
                    <?php givingwalk_single_events_quote(); ?>
                </div>
                <?php givingwalk_single_events_footer(); ?>
                <?php givingwalk_single_events_organizer(); ?>
                <?php if ( get_post_type() == Tribe__Events__Main::POSTTYPE && tribe_get_option( 'showComments', false ) ) comments_template() ?>
            </div>
        </div>
    <?php endwhile; ?>
</div>
