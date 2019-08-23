<?php
    $atts = vc_map_get_attributes( $this->getShortcode(), $atts );
    extract( $atts );
    if($el_show_author === 'true') 
        $el_show_author = true;
    else 
        $el_show_author = false;
    the_widget( 'GivingwalkInstagramWidget', array(
        'title'         => $el_title, 
        'layout_mode'   => $el_layout_mode, 
        'username'      => $el_username, 
        'id'            => $el_id, 
        'api'           => $el_api, 
        'number'        => $el_number,  
        'columns'       => $el_columns, 
        'columns_space' => $el_columns_space, 
        'size'          => $el_size, 
        'target'        => $el_target, 
        'show_author'   => $el_show_author, 
        'author_text'   => $el_author_text, 
        'extra_class'   => $el_class ) 
    );
?>