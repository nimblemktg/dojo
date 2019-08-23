<?php
if (!function_exists('vc_iconpicker_type_flaticon')) :
/**
 * awesome class.
 * 
 * @return string[]
 * @author FOX.
 */
add_filter( 'vc_iconpicker-type-flaticon', 'vc_iconpicker_type_flaticon' );

function vc_iconpicker_type_flaticon( $icons ) {  
    $flat_icons = array(
        array( 'flaticon-heart'                             => esc_html( 'heart' ) ),
        array( 'flaticon-home'                              => esc_html( 'home' ) ),
        array( 'flaticon-donation'                          => esc_html( 'donation' ) ),
        array( 'flaticon-driver'                            => esc_html( 'driver' ) ),
        array( 'flaticon-family'                            => esc_html( 'family' ) ),
        array( 'flaticon-school-material'                   => esc_html( 'school material' ) ),
        array( 'flaticon-saving-a-dollar-coin'              => esc_html( 'saving a dollar coin' ) ),
        array( 'flaticon-eco-volunteer'                     => esc_html( 'eco volunteer' ) ),
        array( 'flaticon-tool'                              => esc_html( 'tool' ) ),
        array( 'flaticon-graduation-student-black-cap'      => esc_html( 'graduation student black cap' ) ),
        array( 'flaticon-globe'                             => esc_html( 'globe' ) ),
        array( 'flaticon-black-male-user-symbol'            => esc_html( 'black male user symbol' ) ),
        array( 'flaticon-movie-film'                        => esc_html( 'movie film' ) ),
        array( 'flaticon-school'                            => esc_html( 'school' ) ),
        array( 'flaticon-give-money'                        => esc_html( 'give money' ) ),
        array( 'flaticon-interface'                         => esc_html( 'interface' ) ),
        array( 'flaticon-medical'                           => esc_html( 'medical' ) ),
        array( 'flaticon-play-button-1'                     => esc_html( 'play button 1' ) ),
        array( 'flaticon-email'                             => esc_html( 'email' ) ),
        array( 'flaticon-arrows'                            => esc_html( 'arrows' ) ),
        array( 'flaticon-fruit'                             => esc_html( 'fruit' ) ),
        array( 'flaticon-telephone'                         => esc_html( 'telephone' ) ),
        array( 'flaticon-share'                             => esc_html( 'share' ) ),
        array( 'flaticon-phone-call'                        => esc_html( 'phone call' ) ),
        array( 'flaticon-play-button'                       => esc_html( 'play button' ) ),
        array( 'flaticon-favorite'                          => esc_html( 'favorite' ) ),
        array( 'flaticon-money-2'                           => esc_html( 'money 2' ) ),
        array( 'flaticon-real-estate'                       => esc_html( 'real estate' ) ),
        array( 'flaticon-money-1'                           => esc_html( 'money 1' ) ),
        array( 'flaticon-shapes'                            => esc_html( 'shapes' ) ),
        array( 'flaticon-multimedia-1'                      => esc_html( 'multimedia 1' ) ),
        array( 'flaticon-multimedia'                        => esc_html( 'multimedia' ) ),
        array( 'flaticon-transfer'                          => esc_html( 'transfer' ) ),
        array( 'flaticon-money'                             => esc_html( 'money' ) ),
        array( 'flaticon-signs'                             => esc_html( 'signs' ) ),
        array( 'flaticon-user-icon'                         => esc_html( 'user icon' ) ),
    );
    return array_merge( $icons, $flat_icons );
}
endif;
