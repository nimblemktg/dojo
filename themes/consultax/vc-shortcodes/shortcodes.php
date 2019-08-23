<?php

// Button
add_shortcode('otbutton', 'otbutton_func');
function otbutton_func($atts, $content = null){
    extract(shortcode_atts(array(
        'btn_text'  =>  'Click Me',
        'btn_link'  =>  '#',
        'style'     =>  '',
        'type'      =>  '',
        'size'      =>  '',
        'align'     =>  '',
        'color'     =>  '',
        'bg_color'  =>  '',
        'bo_color'  =>  '',
        'target'    =>  '',
        'iclass'    =>  '',
    ), $atts));
    $class     = 'btn ' .esc_attr($size).' '. esc_attr($style).' '. esc_attr($type);
    $color1    = (!empty($color) ? 'color:'.$color.';' : '');
    $tar       = $target ? 'target=_blank' : '';
    $bg_color1 = (!empty($bg_color) ? 'background-color:'.$bg_color.';' : '');
    $bo_color1 = (!empty($bo_color) ? 'border-color:'.$bo_color.';' : '');
    ob_start(); ?>

    <div class="<?php echo esc_attr($align.' '.$iclass); ?>">
        <a <?php echo esc_attr($tar); ?> class="<?php echo esc_attr($class); ?>" href="<?php echo esc_url($btn_link); ?>" style="<?php echo esc_attr($bg_color1);echo esc_attr($bo_color1);echo esc_attr($color1); ?>"><?php echo wp_specialchars_decode($btn_text); ?></a>
    </div>

    <?php
    return ob_get_clean();
}

// OT Heading
add_shortcode('hsection', 'hsection_func');
function hsection_func($atts, $content = null){
    extract(shortcode_atts(array(
        'title'     =>  '',
        'sub'       =>  '',
        'light'     =>  '',
        'iclass'    =>  '',
    ), $atts));
    ob_start(); ?>

    <div class="section-head <?php echo esc_attr($iclass); if($light) echo ' text-light';?>">
        <?php if($sub) { ?>
            <h6><span><?php echo wp_specialchars_decode($sub); ?></span></h6>
        <?php }if($title) { ?>
        <h2 class="section-title"><?php echo wp_specialchars_decode($title); ?></h2>
        <?php } ?>
    </div>

<?php
    return ob_get_clean();
}

// OT Video Button
add_shortcode('videobtn', 'videobtn_func');
function videobtn_func($atts, $content = null){
    extract(shortcode_atts(array(
        'title'     =>  '',
        'link'      =>  '',
        'circle'    =>  '',
        'iclass'    =>  '',
    ), $atts));
    ob_start(); ?>

    <div class="video-btn <?php echo esc_attr($iclass); ?>">
        <a href="<?php echo esc_url($link); ?>">
            <i class="ion-md-play"></i>
            <?php if($circle) { ?>
            <span class="circle1"></span>
            <span class="circle2"></span>
            <?php } ?>
        </a>
        <?php if($title) echo '<h6>'. esc_html($title). '</h6>'; ?>
    </div>

<?php
    return ob_get_clean();
}


// Socials
add_shortcode('isocials', 'isocials_func');
function isocials_func($atts, $content = null){
    extract(shortcode_atts(array(
        'title'       =>  '',
        'social'      =>  '',
        'target'      =>  '',
        'iclass'      =>  '',
    ), $atts));
    $socials = (array) vc_param_group_parse_atts( $social );
    $tar     = $target ? ' target=_blank' : '';
    ob_start(); ?>

    <div class="ot-socials <?php echo esc_attr($iclass) ?>">
        <span><?php echo wp_specialchars_decode($title); ?></span>
        <?php foreach ( $socials as $soc ) : if($soc) : 
            $soc['link'] = isset($soc['link']) ? $soc['link'] : '';
            $soc['icon'] = isset($soc['icon']) ? $soc['icon'] : '';
        ?>
        <a<?php echo esc_attr($tar); ?> href="<?php echo esc_url($soc['link']); ?>"><i class="<?php echo esc_attr($soc['icon']); ?>"></i></a>
        <?php endif; endforeach; ?>
    </div>

<?php
    return ob_get_clean();
}

// Image Carousel
add_shortcode('carousels','carousels_func');
function carousels_func($atts, $content = null){
    extract(shortcode_atts(array(
        'gallery'       =>  '',
        'show'          =>  '1',
        'nav'           =>  '',
        'gaps'          =>  '',
        'iclass'        =>  '',
    ), $atts));

    ob_start(); ?>

    <div class="image-carousel <?php if($gaps) echo 'has-gaps '; echo esc_attr($iclass); ?>" data-show="<?php echo esc_attr($show); ?>" data-arrow="<?php echo esc_attr($nav); ?>">
        <?php
            $img_ids = explode(",",$gallery);
            foreach( $img_ids AS $img_id ){
            $image_src = wp_get_attachment_image($img_id,'full');
        ?>
        <div>
            <div class="img-item">
                <?php echo wp_specialchars_decode($image_src); ?>
            </div>
        </div>
        <?php } ?>
    </div>

    <?php
    return ob_get_clean();
}

// Icon Box
add_shortcode('iconbox', 'iconbox_func');
function iconbox_func($atts, $content = null){
    extract(shortcode_atts(array(
        'icon'        =>  '',
        'ion'         =>  '',
        'photo'       =>  '',
        'title'       =>  '',
        'link'        =>  '',
        'bghover'     =>  '',
        'type'        =>  '',
        'style'       =>  '',
        'iclass'      =>  '',
    ), $atts));
    $img     = wp_get_attachment_image($photo,'full');
    $url    = vc_build_link( $link );
    ob_start(); ?>

    <?php if ( !$url['title'] && $url['url'] ) echo '<a href="'.esc_url( $url['url'] ).'">'; ?>
    <div class="service-box icon-box <?php echo esc_attr($iclass.' '.$type.' '.$style); if(!$bghover) echo ' hover-box'; ?>">
        <?php if($icon) { ?><i class="<?php echo esc_attr($icon); ?>"></i><?php } ?>
        <?php if($ion) { ?><i class="ion-md-<?php echo esc_attr($ion); ?> ion-logo-<?php echo esc_attr($ion); ?>"></i><?php } ?>
        <?php if($img) echo wp_specialchars_decode($img); ?>
        <div class="content-box">
            <h4><?php echo wp_specialchars_decode($title); ?></h4>
            <p><?php echo wp_specialchars_decode($content); ?></p>
            <?php if ( strlen( $link ) > 0 && strlen( $url['title'] ) > 0 && strlen( $url['url'] ) > 0 ) {
                echo '<a class="link-box pagelink" href="' . esc_url( $url['url'] ) . '" target="' . ( strlen( $url['target'] ) > 0 ? esc_attr( $url['target'] ) : '_self' ) . '">' . esc_attr( $url['title'] ) .'</a>';
            } ?>
        </div>
    </div>
    <?php if ( !$url['title'] && $url['url'] ) echo '</a>'; ?>

    <?php
    return ob_get_clean();
}

// Service Box
add_shortcode('servicebox', 'servicebox_func');
function servicebox_func($atts, $content = null){
    extract(shortcode_atts(array(
        'photo'       =>  '',
        'title'       =>  '',
        'link'        =>  '',
        'linkimg'     =>  '',
        'linktitle'   =>  '',
        'iclass'      =>  '',
    ), $atts));
    $img    = wp_get_attachment_image($photo,'full');
    $url    = vc_build_link( $link );
    ob_start(); ?>

    <div class="service-box image-box <?php echo esc_attr($iclass); ?>">
        <?php if ( strlen( $link ) > 0 && $img && $linkimg ) echo '<a href="'.esc_attr( $url['url'] ).'">'; if($img) echo wp_specialchars_decode($img); if ( strlen( $link ) > 0 && $img && $linkimg ) echo '</a>'; ?>
        <div class="content-box">
            <h4><?php if ( strlen( $link ) > 0 && $title && $linktitle ) echo '<a href="'.esc_attr( $url['url'] ).'">'; echo wp_specialchars_decode($title); if ( strlen( $link ) > 0 && $title && $linktitle ) echo '</a>'; ?></h4>
            <p><?php echo wp_specialchars_decode($content); ?></p>
            <?php if ( strlen( $link ) > 0 && strlen( $url['url'] ) > 0 ) {
                echo '<a class="link-box pagelink" href="' . esc_attr( $url['url'] ) . '" target="' . ( strlen( $url['target'] ) > 0 ? esc_attr( $url['target'] ) : '_self' ) . '">' . esc_attr( $url['title'] ) .'</a>';
            } ?>
        </div>
    </div>

    <?php
    return ob_get_clean();
}

// Menu Services
add_shortcode('menuservice', 'menuservice_func');
function menuservice_func($atts, $content = null){
    extract(shortcode_atts(array(
        'title'     =>  '',
        'service'   =>  '',
        'btn'       =>  '',
        'photo'     =>  '',
        'iclass'    =>  '',
    ), $atts));
    $services = (array) vc_param_group_parse_atts( $service );
    $url      = vc_build_link( $btn );
    $bg       = wp_get_attachment_image_url($photo,'full');
    ob_start(); ?>

    <div class="menu-service <?php echo esc_attr($iclass); ?>">
        <?php echo '<h4>'. wp_specialchars_decode($title) .'</h4>'; ?>
        <div class="list-service">
            <?php foreach ( $services as $ser ) :
                $ser['icon']  = isset($ser['icon']) ? $ser['icon'] : '';
                $ser['ion']   = isset($ser['ion']) ? $ser['ion'] : '';
                $ser['name']  = isset($ser['name']) ? $ser['name'] : '';
                $ser['link']  = isset($ser['link']) ? $ser['link'] : '';
            ?>
            <a href="<?php echo esc_url($ser['link']); ?>">
                <?php if($ser['icon']) { ?><i class="<?php echo esc_attr($ser['icon']); ?>"></i><?php } ?>
                <?php if($ser['ion']) { ?><i class="ion-md-<?php echo esc_attr($ser['ion']); ?> ion-logo-<?php echo esc_attr($ser['ion']); ?>"></i><?php } ?>
                <?php echo esc_html($ser['name']); ?>
            </a>
            <?php endforeach; ?>
        </div>
        <div class="call-action" style="background-image: url(<?php echo esc_url($bg); ?>);">
            <?php if ( $url['url'] ) {
                echo '<a class="btn btn-trans" href="' . esc_url( $url['url'] ) . '" target="' . ( strlen( $url['target'] ) > 0 ? esc_attr( $url['target'] ) : '_self' ) . '">' . esc_attr( $url['title'] ) .'</a>';
            } ?>
        </div>
    </div>

    <?php
    return ob_get_clean();
}


// Portfolio Filter
add_shortcode('portfoliof', 'portfoliof_func');
function portfoliof_func($atts, $content = null){
    extract(shortcode_atts(array(
        'all'       =>  '',
        'num'       =>  '-1',
        'col'       =>  '3',
        'idcate'    =>  '',
        'filter'    =>  '',
        'nogap'		=>	'',
        'style'		=>	'',
        'iclass'    =>  '',
    ), $atts));
    ob_start(); ?>

    <div class="project-filter <?php echo esc_attr($iclass); ?>" data-column="<?php echo esc_attr($col); ?>">
        <?php if($filter) { ?>
            <div id="filters" class="cat-filter">
                <?php if($all) { ?><a href="#" data-filter="*" class="filter-item all-cat selected"><?php echo esc_html($all); ?></a><?php } ?>

                <?php
                if($idcate){

                    $categories = explode(",",$idcate);
                    foreach( (array)$categories as $categorie){
                        $cates = get_term_by('slug', $categorie, 'portfolio_cat');
                        $cat_name = $cates->name;
                        $cat_slug = $cates->slug;

                ?>

                    <a href="#" data-filter=".<?php echo esc_attr( $cat_slug ); ?>" class="filter-item"><?php echo esc_html( $cat_name ); ?></a>

                <?php } }else{

                    $categories = get_terms('portfolio_cat');
                    foreach( (array)$categories as $categorie){
                        $cat_name = $categorie->name;
                        $cat_slug = $categorie->slug;
                    ?>

                    <a href="#" data-filter=".<?php echo esc_attr( $cat_slug ); ?>" class="filter-item"><?php echo esc_html( $cat_name ); ?></a>

                <?php } } ?>

            </div>
        <?php } ?>
        <div id="projects" class="project-grid projects row <?php echo esc_attr($style); if( $nogap ) echo ' no-gaps'; ?>">
            <?php
            if($idcate){
                $args = array(
                    'posts_per_page' => $num,
                    'post_type' => 'ot_portfolio',
                    'tax_query' => array(
                        array(
                            'taxonomy' => 'portfolio_cat',
                            'field' => 'slug',
                            'terms' => explode(',',$idcate),
                        ),
                    ),              
                );
            }else{
                $args = array(
                    'post_type' => 'ot_portfolio',
                    'posts_per_page' => $num,
                );
            }
            $wp_query = new WP_Query($args);
            while ($wp_query -> have_posts()) : $wp_query -> the_post();
                $cates = get_the_terms(get_the_ID(),'portfolio_cat');
                $cate_name ='';
                $cate_slug = '';
                foreach((array)$cates as $cate){
                    if(count($cates)>0){
                        $cate_name .= '<span>'.$cate->name .'</span>';
                        $cate_slug .= $cate->slug .' ';
                    }
                }
                $column = '';
                if( $col == 4 ){
                    $column = 'col-md-3 col-sm-6';
                }elseif( $col == 2 ){
                    $column = 'col-md-6 col-sm-6';
                }else{
                    $column = 'col-md-4 col-sm-6';
                }
                ?>
                <div class="project-item <?php echo esc_attr($cate_slug.$column); ?>">
                    <div class="inner">
                        <a href="<?php the_permalink(); ?>">
                            <?php the_post_thumbnail(); ?>
                        </a>
                        <div class="p-info">
                            <h6><?php echo wp_specialchars_decode($cate_name); ?></h6>
                            <h4>
                                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                            </h4>
                        </div>
                    </div>
                </div>
            <?php endwhile; wp_reset_postdata(); ?>
        </div>
    </div>

    <?php
    return ob_get_clean();
}

//Portfolio Slider
add_shortcode('projrelated','projrelated_func');
function projrelated_func($atts, $content = null){
    extract(shortcode_atts(array(
        'idpost'	=>	'',
        'btn'		=>	'',
        'dot'		=>	'',
        'nav'		=>	'',
        'auto'      =>  '',
        'exc'		=>	'',
        'style'     =>  '',
        'iclass'    =>  '',
    ), $atts));
    ob_start();
    ?>

    <div class="project-slider projects <?php echo esc_attr($iclass); ?>" data-show="1" data-auto="<?php echo esc_attr($auto); ?>" data-arrow="<?php echo esc_attr($nav); ?>" data-dot="<?php echo esc_attr($dot); ?>">
        <?php

        $args = array(
            'post_type' => 'ot_portfolio',
            'posts_per_page' => -1,
            'post__in' => explode(',',$idpost)
        );

        $wp_query = new WP_Query($args);

        while ($wp_query -> have_posts()) : $wp_query -> the_post();
        
        ?>
            <div>
                <div class="project-item">

                    <?php if( function_exists( 'rwmb_meta' ) ) { 
                        $info   = get_post_meta( get_the_ID(), 'extra', true );
                        $images = rwmb_meta( 'slide', "type=image" );
                        foreach ( $images as $image ) {  $img = $image['full_url']; ?>

                        <img class="radius" src="<?php echo esc_url($img); ?>" alt="<?php the_title(); ?>">

                    <?php } } ?>

                    <div class="inner">
                        <?php if($info) echo wp_specialchars_decode('<p class="contract">'.$info.'</p>'); ?>
                        <h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
                        <?php if($exc) echo '<p class="exc">'.consultax_excerpt(17).'</p>'; ?>
                        <a class="pagelink" href="<?php the_permalink(); ?>"><?php echo wp_specialchars_decode($btn); ?></a>
                    </div>
                </div>
            </div>
        <?php endwhile; wp_reset_postdata();?>
    </div>

    <?php
    return ob_get_clean();
}

//Portfolio Slider 2
add_shortcode('projslide','projslide_func');
function projslide_func($atts, $content = null){
    extract(shortcode_atts(array(
        'idpost'    =>  '',
        'btn'       =>  '',
        'dot'       =>  '',
        'nav'       =>  '',
        'auto'      =>  '',
        'style'     =>  '',
        'iclass'    =>  '',
    ), $atts));
    ob_start();
    ?>

    <div class="project-list-2">
        <div class="project-slider-2 projects <?php echo esc_attr($iclass); ?>" data-show="1" data-auto="<?php echo esc_attr($auto); ?>" data-dot="<?php echo esc_attr($dot); ?>">
            <?php

            $args = array(
                'post_type' => 'ot_portfolio',
                'posts_per_page' => -1,
                'post__in' => explode(',',$idpost)
            );

            $wp_query = new WP_Query($args);

            while ($wp_query -> have_posts()) : $wp_query -> the_post();
            
            ?>
                <div class="col-md-12">
                    <div class="project-item">

                        <?php if( function_exists( 'rwmb_meta' ) ) { 
                            $info   = get_post_meta( get_the_ID(), 'extra', true );
                            $exc    = get_the_excerpt();
                            $images = rwmb_meta( 'slide', "type=image" );
                            foreach ( $images as $image ) {  $img = $image['full_url']; ?>

                            <div class="slide-img"><img src="<?php echo esc_url($img); ?>" alt="<?php the_title(); ?>"></div>

                        <?php } } ?>

                        <div class="inner row">
                            <?php if($info) { ?>
                            <div class="col-md-3">
                                <?php echo wp_specialchars_decode($info); ?>
                                <div class="gaps lg-hidden"></div>
                            </div>
                            <?php } ?>
                            <div class="col-md-<?php if($info) echo '9'; else echo '12'; ?>">
                                <h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
                                <p><?php echo wp_specialchars_decode($exc); ?></p>
                                <a class="pagelink gray" href="<?php the_permalink(); ?>"><?php echo wp_specialchars_decode($btn); ?></a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endwhile; wp_reset_postdata();?>
        </div>
        <?php if($nav) { ?>
        <div class="container">
            <div class="arrows-slick">
                <button type="button" class="btn-left slick-arrow prev-nav"><i class="fa fa-angle-left"></i></button>
                <button type="button" class="btn-right slick-arrow next-nav"><i class="fa fa-angle-right"></i></button>
            </div>
        </div>
        <?php } ?>
    </div>

    <?php
    return ob_get_clean();
}

//Portfolio Slider 3
add_shortcode('projslide2','projslide2_func');
function projslide2_func($atts, $content = null){
    extract(shortcode_atts(array(
        'idpost'    =>  '',
        'btn'       =>  '',
        'light'     =>  '',
        'iclass'    =>  '',
    ), $atts));
    ob_start();
    ?>

    <div class="project-with-nav <?php echo esc_attr($iclass); if($light) echo ' text-light'; ?>">
        <div class="project-images">
            <?php
            $args = array(
                'post_type' => 'ot_portfolio',
                'posts_per_page' => -1,
                'post__in' => explode(',',$idpost)
            );

            $wp_query = new WP_Query($args);

            while ($wp_query -> have_posts()) : $wp_query -> the_post();
            
            ?>
            
                <div>
                    <div class="image-item">

                        <?php if( function_exists( 'rwmb_meta' ) ) { 
                            $info   = get_post_meta( get_the_ID(), 'extra', true );
                            $images = rwmb_meta( 'slide', "type=image" );
                            foreach ( $images as $image ) {  $img = $image['full_url']; ?>

                            <img class="radius box-shadow" src="<?php echo esc_url($img); ?>" alt="<?php the_title(); ?>">

                        <?php } } ?>
                        
                    </div>
                </div>
            
            <?php endwhile; wp_reset_postdata();?>
        </div>

        <div class="project-nav">
            <?php
            $args = array(
                'post_type' => 'ot_portfolio',
                'posts_per_page' => -1,
                'post__in' => explode(',',$idpost)
            );

            $wp_query = new WP_Query($args);

            while ($wp_query -> have_posts()) : $wp_query -> the_post();
            
            ?>
            
                <div>
                    <div class="nav-item">
                        <?php if($info) echo wp_specialchars_decode('<p class="contract">'.$info.'</p>'); ?>
                        <h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
                        <a class="pagelink" href="<?php the_permalink(); ?>"><?php echo wp_specialchars_decode($btn); ?></a>
                    </div>
                </div>
            <?php endwhile; wp_reset_postdata();?>
        </div>
    </div>

    <?php
    return ob_get_clean();
}

// Team Single
add_shortcode('teamsingle', 'teamsingle_func');
function teamsingle_func($atts, $content = null){
    extract(shortcode_atts(array(
        'name'      =>  '',
        'photo'     =>  '',
        'socials'   =>  '',
        'job'       =>  '',
        'style'     =>  '',
        'iclass'    =>  '',
    ), $atts));
    $img  = wp_get_attachment_image($photo,'full');
    $social = (array) vc_param_group_parse_atts( $socials );
    ob_start(); ?>

    <?php if( $style == 's3' ) { ?>
    <div class="member-item-3 radius <?php echo esc_attr($iclass); ?>">
        <div class="avatar">
            <?php echo wp_specialchars_decode($img); ?>
        </div>
        <div class="mem-info">
            <h5><?php echo wp_specialchars_decode($name); ?><span class="font12 normal"><?php echo wp_specialchars_decode($job); ?></span></h5>
            <div class="line"></div>
            <p><?php echo wp_specialchars_decode($content); ?></p>
            <div class="social-mem">
                <?php foreach ( $social as $soc ) :
                    $soc['icon'] = isset($soc['icon']) ? $soc['icon'] : '';
                    $soc['link'] = isset($soc['link']) ? $soc['link'] : '';
                ?>
                    <a href="<?php echo esc_url($soc['link']); ?>" target="_blank"><i class="<?php echo esc_attr($soc['icon']); ?>"></i></a>
                <?php endforeach; ?>
            </div>            
        </div>
    </div>
    <?php }elseif( $style == 's2' ) { ?>
    <div class="member-item radius <?php echo esc_attr($iclass); ?>">
        <div class="avatar">
            <?php echo wp_specialchars_decode($img); ?>
            <span class="overlay"></span>
            <div class="social-mem">
                <?php foreach ( $social as $soc ) :
                    $soc['icon'] = isset($soc['icon']) ? $soc['icon'] : '';
                    $soc['link'] = isset($soc['link']) ? $soc['link'] : '';
                ?>
                    <a href="<?php echo esc_url($soc['link']); ?>" target="_blank"><i class="<?php echo esc_attr($soc['icon']); ?>"></i></a>
                <?php endforeach; ?>
            </div>
        </div>
        <div class="mem-info">
            <h5><?php echo wp_specialchars_decode($name); ?><span class="font12 normal"><?php echo wp_specialchars_decode($job); ?></span></h5>
            <p><?php echo wp_specialchars_decode($content); ?></p>
        </div>
    </div>
    <?php }else{ ?>
    <div class="team-item single radius <?php echo esc_attr($iclass); ?>">
        <?php echo wp_specialchars_decode($img); ?>
        <div class="team-info text-light">
            <span class="overlay"></span>
            <h5><?php echo wp_specialchars_decode($name); ?><span class="font12 normal"><?php echo wp_specialchars_decode($job); ?></span></h5>
            <div class="line"></div>
            <p><?php echo wp_specialchars_decode($content); ?></p>
            <div class="ot-socials">
                <?php foreach ( $social as $soc ) :
                    $soc['icon'] = isset($soc['icon']) ? $soc['icon'] : '';
                    $soc['link'] = isset($soc['link']) ? $soc['link'] : '';
                ?>
                    <a href="<?php echo esc_url($soc['link']); ?>" target="_blank"><i class="<?php echo esc_attr($soc['icon']); ?>"></i></a>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
    <?php } ?>

    <?php
    return ob_get_clean();
}

// Team Slider
add_shortcode('teamslide', 'teamslide_func');
function teamslide_func($atts, $team, $iclass, $content = null){
    extract(shortcode_atts(array(
        'style'     =>  '',
        'team'      =>  '',
        'number'    =>  '4',
        'nav'       =>  '',
        'iclass'    =>  '',
    ), $atts));
    $teams   = (array) vc_param_group_parse_atts( $team );
    ob_start(); ?>

    <div class="team-slider <?php echo esc_attr($iclass); ?>" data-show="<?php echo esc_attr($number); ?>" data-arrow="<?php echo esc_attr($nav); ?>">
        <?php foreach ( $teams as $member ) :
            $member['photo'] = isset($member['photo']) ? $member['photo'] : '';
            $img             = wp_get_attachment_image($member['photo'],'full');
            $member['name']  = isset($member['name']) ? $member['name'] : '';
            $member['job']   = isset($member['job']) ? $member['job'] : '';
            $member['des']   = isset($member['des']) ? $member['des'] : '';
            $socials         = (array) vc_param_group_parse_atts( $member['socials'] );
        ?>
            <?php if( $style == 's2' ) { ?>
            <div class="member-item slide-item box-shadow-2 radius">
                <div class="avatar">
                    <?php echo wp_specialchars_decode($img); ?>
                    <span class="overlay"></span>
                    <div class="social-mem">
                        <?php foreach ( $socials as $soc ) :
                            $soc['icon'] = isset($soc['icon']) ? $soc['icon'] : '';
                            $soc['link'] = isset($soc['link']) ? $soc['link'] : '';
                        ?>
                            <a href="<?php echo esc_url($soc['link']); ?>" target="_blank"><i class="<?php echo esc_attr($soc['icon']); ?>"></i></a>
                        <?php endforeach; ?>
                    </div>
                </div>
                <div class="mem-info">
                    <h5><?php echo wp_specialchars_decode($member['name']); ?><span class="font12 normal"><?php echo wp_specialchars_decode($member['job']); ?></span></h5>
                    <p><?php echo wp_specialchars_decode($member['des']); ?></p>
                </div>
            </div>
            <?php }else{ ?>
            <div class="team-item slide-item radius">
                <?php echo wp_specialchars_decode($img); ?>
                <div class="team-info text-light">
                    <span class="overlay"></span>
                    <h5><?php echo wp_specialchars_decode($member['name']); ?><span class="font12 normal"><?php echo wp_specialchars_decode($member['job']); ?></span></h5>
                    <div class="line"></div>
                    <p><?php echo wp_specialchars_decode($member['des']); ?></p>
                    <div class="ot-socials">
                        <?php foreach ( $socials as $soc ) :
                            $soc['icon'] = isset($soc['icon']) ? $soc['icon'] : '';
                            $soc['link'] = isset($soc['link']) ? $soc['link'] : '';
                            if( $soc['icon'] ) : 
                        ?>
                            <a href="<?php echo esc_url($soc['link']); ?>" target="_blank"><i class="<?php echo esc_attr($soc['icon']); ?>"></i></a>
                        <?php endif; endforeach; ?>
                    </div>
                </div>
            </div>
        <?php } endforeach; ?>
    </div>

    <?php
    return ob_get_clean();
}

// Career Box
add_shortcode('careerbox', 'careerbox_func');
function careerbox_func($atts, $content = null){
    extract(shortcode_atts(array(
        'title'       =>  '',
        'btn'         =>  '',
        'iclass'      =>  '',
    ), $atts));
    $url    = vc_build_link( $btn );
    $content = wpb_js_remove_wpautop( $content, true );
    ob_start(); ?>

    <div class="career-box<?php echo esc_attr(' '.$iclass); ?>">
        <h5><?php echo wp_specialchars_decode($title); ?></h5>
        <div class="content-box">
            <?php echo wp_specialchars_decode($content); ?>
            <?php if ( strlen( $btn ) > 0 && strlen( $url['url'] ) > 0 ) {
                echo '<a class="btn" href="' . esc_attr( $url['url'] ) . '" target="' . ( strlen( $url['target'] ) > 0 ? esc_attr( $url['target'] ) : '_self' ) . '">' . esc_attr( $url['title'] ) .'</a>';
            } ?>
        </div>
    </div>

    <?php
    return ob_get_clean();
}

// Testimonial
add_shortcode('testimonial', 'testimonial_func');
function testimonial_func($atts, $content = null){
    extract(shortcode_atts(array(
        'name'      =>  '',
        'photo'     =>  '',
        'add'       =>  '',
        'stars'     =>  '',
        'iclass'    =>  '',
    ), $atts));
    $img  = wp_get_attachment_image($photo,'full');
    $star = wp_get_attachment_image($stars,'full');
    ob_start(); ?>

    <div class="testi-item single <?php echo esc_attr($iclass); ?>">
        <div class="testi-head">
            <?php if($photo) echo wp_specialchars_decode($img); ?>
            <h5><?php echo wp_specialchars_decode($name); ?><span class="font12 normal"><?php echo wp_specialchars_decode($add); ?></span></h5>
        </div>
        <div class="line"></div>
        <div class="testi-content">
            <i class="ion-md-quote"></i>
            <?php if($stars) echo wp_specialchars_decode($star); ?>
            <p><?php echo wp_specialchars_decode($content); ?></p>
        </div>
    </div>

    <?php
    return ob_get_clean();
}

// Testimonials Slider
add_shortcode('testislide', 'testislide_func');
function testislide_func($atts, $content = null){
    extract(shortcode_atts(array(
        'testi'     =>  '',
        'number'    =>  '2',
        'nav'       =>  '',
        'style'     =>  '',
        'iclass'    =>  '',
    ), $atts));
    $says = (array) vc_param_group_parse_atts( $testi );
    ob_start(); ?>

    <div class="testi-slider <?php echo esc_attr($iclass.' '.$style); ?>" data-show="<?php echo esc_attr($number); ?>" data-arrow="<?php echo esc_attr($nav); ?>">
        <?php foreach ( $says as $say ) :
            $say['photo'] = isset($say['photo']) ? $say['photo'] : '';
            $say['stars'] = isset($say['stars']) ? $say['stars'] : '';
            $avatar       = wp_get_attachment_image($say['photo'], 'full', '', array('class' => 'client-img'));
            $star         = wp_get_attachment_image($say['stars'],'full');
            $say['name']  = isset($say['name']) ? $say['name'] : '';
            $say['job']   = isset($say['job']) ? $say['job'] : '';
            $say['des']   = isset($say['des']) ? $say['des'] : '';
        ?>
            <?php if( $style == 'style-2' ) { ?>
            <div>
                <div class="testi-item-2">
                    <?php if($avatar) echo wp_specialchars_decode($avatar); ?>                    
                    <div class="client-info">
                        <i class="ion-md-quote"></i>
                        <p class="says italic"><?php echo wp_specialchars_decode($say['des']); ?></p>
                        <div class="f-left">
                            <h5><?php echo wp_specialchars_decode($say['name']); ?></h5>
                            <span class="jobs font12"><?php echo wp_specialchars_decode($say['job']); ?></span>
                        </div>
                        <div class="f-left stars"><?php if($star) echo wp_specialchars_decode($star); ?></div>
                    </div>
                </div>
            </div>
            <?php }else{ ?>
            <div>
                <div class="testi-item box-shadow-hover">
                    <div class="testi-head">
                        <?php if($avatar) echo wp_specialchars_decode($avatar); ?>
                        <h5><?php echo wp_specialchars_decode($say['name']); ?><span class="font12 normal"><?php echo wp_specialchars_decode($say['job']); ?></span></h5>
                    </div>
                    <div class="line"></div>
                    <div class="testi-content">
                        <i class="ion-md-quote"></i>
                        <?php if($star) echo wp_specialchars_decode($star); ?>
                        <p><?php echo wp_specialchars_decode($say['des']); ?></p>
                    </div>
                </div>
            </div>
        <?php } endforeach; ?>
    </div>

    <?php
    return ob_get_clean();
}

// Testimonials Slider 2
add_shortcode('testislide2', 'testislide2_func');
function testislide2_func($atts, $content = null){
    extract(shortcode_atts(array(
        'testi'     =>  '',
        'iclass'    =>  '',
    ), $atts));
    $says = (array) vc_param_group_parse_atts( $testi );
    ob_start(); ?>

    <div class="testi-with-nav row <?php echo esc_attr($iclass); ?>">
        <div class="col-md-8">
            <div class="testi-slider-2">
                <?php foreach ( $says as $say ) :
                    $say['stars'] = isset($say['stars']) ? $say['stars'] : '';
                    $star         = wp_get_attachment_image($say['stars'],'full');
                    $say['name']  = isset($say['name']) ? $say['name'] : '';
                    $say['job']   = isset($say['job']) ? $say['job'] : '';
                    $say['des']   = isset($say['des']) ? $say['des'] : '';
                ?>
                <div>
                    <div class="testi-item-2">
                        <div class="client-info">
                            <i class="ion-md-quote"></i>
                            <p class="says italic"><?php echo wp_specialchars_decode($say['des']); ?></p>
                            <div class="f-right text-right">
                                <h5><?php echo wp_specialchars_decode($say['name']); ?></h5>
                                <span class="jobs font12"><?php echo wp_specialchars_decode($say['job']); ?></span>
                            </div>
                            <div class="f-right stars"><?php if($star) echo wp_specialchars_decode($star); ?></div>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
        <div class="col-md-4">
            <div class="testi-nav">
                <?php foreach ( $says as $say ) :
                    $say['photo'] = isset($say['photo']) ? $say['photo'] : '';
                    $avatar       = wp_get_attachment_image($say['photo'], 'full', '', array('class' => 'client-img'));
                ?>
                <div>
                    <div class="nav-item-3">
                        <?php if($avatar) echo wp_specialchars_decode($avatar); ?>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>

    <?php
    return ob_get_clean();
}

// Lastest News
add_shortcode('lastestnews','lastestnews_func');
function lastestnews_func($atts, $content = null){
    extract(shortcode_atts(array(
        'show'		=>	'3',
        'num'       =>  '3',
        'exc'	    =>	'16',
        'btn'		=>	'',
        'dot'		=>	'',
        'auto'      =>  '',
        'style'	    =>	'',
        'iclass'    =>  '',
    ), $atts));

    ob_start();
    ?>
    <div class="news-slider posts-grid row <?php echo esc_attr($iclass.' '.$style); ?>" data-show="<?php echo esc_attr($show); ?>" data-auto="<?php echo esc_attr($auto); ?>" data-dot="<?php echo esc_attr($dot); ?>">
        <?php
        $args = array(
            'post_type' => 'post',
            'posts_per_page' => $num,
        );
        $blogpost = new WP_Query($args);
        if($blogpost->have_posts()) : while($blogpost->have_posts()) : $blogpost->the_post();
            $format = get_post_format();
            ?>
            <div>
                <article class="news-item content-area">
                    <div class="inner-item radius-top">
                        <?php if ( has_post_thumbnail() ) : ?>
                            <div class="thumb-image">
                                <a href="<?php the_permalink(); ?>">
                                    <?php if( $style == 's2' ){ the_post_thumbnail('consultax-latest-news-thumbnail-second'); }else{ the_post_thumbnail('consultax-latest-news-thumbnail'); } ?>
                                </a>
                            </div>
                        <?php endif; ?>
                        <div class="inner-post radius-bottom">
                            <div class="entry-meta">
                                <?php consultax_post_meta(); ?>
                            </div>
                            <h4 class="entry-title">
                                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                            </h4>
                            <?php if($exc != 0) echo wp_specialchars_decode('<p>'.consultax_excerpt($exc).'</p>'); ?>
                            <?php if($btn) { ?>
                            <a class="post-link" href="<?php the_permalink(); ?>">
                                <?php echo wp_specialchars_decode($btn); ?>
                            </a>
                            <?php } ?>
                        </div>
                    </div>
                </article>
            </div>
        <?php endwhile; wp_reset_postdata(); endif; ?>
    </div>

    <?php
    return ob_get_clean();
}


// Fun Fact
add_shortcode('funfacts', 'funfacts_func');
function funfacts_func($atts, $content = null){
    extract(shortcode_atts(array(
        'icon'      =>  '',
        'ion'       =>  '',
        'number'    =>  '',
        'symbol'    =>  '',
        'extra'     =>  '',
        'light'     =>  '',
        'style'     =>  '',
        'iclass'    =>  '',
    ), $atts));

    ob_start(); ?>

    <?php if( $style == 's2' ) { ?>
    <div class="fun-facts s2 <?php echo esc_attr($iclass); if($light) echo(' bg-light'); ?>">
        <h2><span class="number text-primary" data-to="<?php echo esc_attr($number); ?>" data-inviewport="yes">0</span><span class="text-primary"><?php echo esc_html($symbol); ?></span></h2>
        <div class="icon-fact text-right">
            <?php if($icon) { ?><i class="<?php echo esc_attr($icon); ?>"></i><?php } ?>
            <?php if($ion) { ?><i class="ion ion-md-<?php echo esc_attr($ion); ?> ion-logo-<?php echo esc_attr($ion); ?>"></i><?php } ?>
        </div>
        <h5 class="text-right"><?php echo wp_specialchars_decode($extra); ?></h5>
    </div>
    <?php }else{ ?>
    <div class="fun-facts <?php echo esc_attr($iclass); if($light) echo(' bg-light'); ?>">
        <div class="icon-fact">
            <?php if($icon) { ?><i class="<?php echo esc_attr($icon); ?>"></i><?php } ?>
            <?php if($ion) { ?><i class="ion ion-md-<?php echo esc_attr($ion); ?> ion-logo-<?php echo esc_attr($ion); ?>"></i><?php } ?>
        </div>
        <h4><span class="number text-primary bolder" data-to="<?php echo esc_attr($number); ?>" data-inviewport="yes">0</span> <span class="bolder text-primary"><?php echo esc_html($symbol); ?></span> <?php echo wp_specialchars_decode($extra); ?></h4>
    </div>
    <?php } ?>

    <?php
    return ob_get_clean();
}

// Logo Clients
add_shortcode('clients','clients_func');
function clients_func($atts, $content = null){
    extract(shortcode_atts(array(
        'gallery'       =>  '',
        'show'          =>  '5',
        'iclass'        =>  '',
    ), $atts));

    ob_start(); ?>

    <div class="partner-slider image-carousel <?php echo esc_attr($iclass); ?>" data-show="<?php echo esc_attr($show); ?>" data-arrow="false">
        <?php
            $img_ids = explode(",",$gallery);
            foreach( $img_ids AS $img_id ){
                $meta = wp_prepare_attachment_for_js($img_id);
                $link = $meta['caption'];
                $image_src = wp_get_attachment_image($img_id,'full');
            ?>
        <div>
            <div class="partner-item text-center clearfix">
                <div class="inner">
                    <?php if($link) { ?><a target="_blank" href="<?php echo esc_url($link); ?>"><?php } ?>
                        <div class="thumb">
                            <?php echo wp_specialchars_decode($image_src); ?>
                        </div>
                    <?php if($link) { ?></a><?php } ?>
                </div>
            </div>
        </div>
        <?php } ?>
    </div>

    <?php
    return ob_get_clean();
}