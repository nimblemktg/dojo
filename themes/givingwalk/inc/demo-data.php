<?php
/* Remove default widget Before import sample data */
add_action('ef3-import-start','givingwalk_removed_widgets', 10, 2);
function givingwalk_removed_widgets(){
    /* get all registered sidebars */
    global $wp_registered_sidebars;
    /*get saved widgets*/
    $widgets = get_option('sidebars_widgets');
    /*loop over the sidebars and remove all widgets*/
    foreach ($wp_registered_sidebars as $sidebar => $value) {
        unset($widgets[$sidebar]);
    }
    /*update with widgets removed*/
    update_option('sidebars_widgets',$widgets);
}

/* Replace dev site url with curren site url 
 * replace in content options, post meta
 *  
*/
add_action('ef3-import-start', 'givingwalk_import_start', 10, 2);
function givingwalk_import_start($id, $part){
    global $wp_filesystem;
    /* replace content url */
    $file_content = $part . 'content/content-data.xml';
    $data_content = file_get_contents($file_content);
    $data_content = preg_replace(
        array(
            '/http:\/\/dev\.joomexp\.com\/wordpress\/givingwalk/',
        ), 
        site_url(), 
        $data_content
    );
    $wp_filesystem ->put_contents($file_content, $data_content);
    /* replace attach file url */
    $file_attach = $part . 'content/attachment-data.xml';
    $data_attach = file_get_contents($file_attach);
    $data_attach = preg_replace(
        array(
            '/http:\/\/dev\.joomexp\.com\/wordpress\/givingwalk/',
        ), 
        site_url(), 
        $data_attach
    );
    $wp_filesystem ->put_contents($file_attach, $data_attach);
}

/**
 * Replace Content
 * remove query
 * Replace dev site url with curren site url in content
*/
function str_replace_assoc( $replace, $subject) { 
   return str_replace(array_keys($replace), array_values($replace), $subject);    
}
function givingwalk_replace_content($replaces, $attachment){
    /**
     * $replace
     * fixed vc_link param when use in VC Param
    */
    $replace = array( 
        ':' => '%3A', 
        '/' => '%2F' 
    );
    /**
     * $replace2
     * fixed vc_link param when use in VC Param Group
    */
    $replace2 = array( 
        ':' => '%253A', 
        '/' => '%252F' 
    );
    $new_site_url = get_site_url();
    $btn_link_url = str_replace_assoc($replace, $new_site_url);
    $btn_link_url2 = str_replace_assoc($replace2, $new_site_url);
    return array(
        '/category="(.+?)"/'                                               => 'category=""',
        '/category:"(.+?)"/'                                               => '',
        '/tax_query:/'                                                     => 'remove_query:',
        '/categories:/'                                                    => 'remove_query:',
        '/http%3A%2F%2Fdev.joomexp.com%2Fwordpress%2Fgivingwalk%2F/'         => $btn_link_url.'%2F',
        '/http%253A%252F%252Fdev.joomexp.com%252Fwordpress%252Fgivingwalk/'  => $btn_link_url2
    );
}
add_filter('ef3-replace-content', 'givingwalk_replace_content', 10 , 2);

/** 
 * Replace Theme Option Name 
 * Replace theme option name with default theme option name from framework
*/
add_filter('ef3-theme-options-opt-name', 'givingwalk_set_demo_opt_name');
function givingwalk_set_demo_opt_name(){
    return 'opt_theme_options';
}

/* Replace Theme Option 
 * replace default theme option after import sample data
*/
add_filter('ef3-replace-theme-options', 'givingwalk_replace_theme_options');
function givingwalk_replace_theme_options(){
    return array(
        'opt_dev_mode' => 0,
    );
}
/** 
 * Remove Create Demo
 * remove create demo content screen
*/
add_filter('ef3-enable-create-demo', 'givingwalk_enable_create_demo');
function givingwalk_enable_create_demo(){
    return false;
}

/**
 * Set woo page.
 *
 * get array woo page title and update options.
 *
 * @author Red Team
 * @since 1.0.0
 */
function givingwalk_set_woo_page(){
    $woo_pages = array(
        'woocommerce_shop_page_id'      => 'Shop',
        'woocommerce_cart_page_id'      => 'Cart',
        'woocommerce_checkout_page_id'  => 'Checkout',
        'woocommerce_myaccount_page_id' => 'My Account',
        'woocommerce_terms_page_id'     => 'Terms and conditions'
    );
    foreach ($woo_pages as $key => $woo_page){
        $page = get_page_by_title($woo_page);
        if(!isset($page->ID))
            return ;
        update_option($key, $page->ID);
    }
}
add_action('ef3-import-finish', 'givingwalk_set_woo_page');

/* move default post / page to trash */
add_action('ef3-import-finish', 'givingwalk_move_trash', 1);
if(!function_exists('givingwalk_move_trash')){
    function givingwalk_move_trash(){
        wp_trash_post(1);
        wp_trash_post(2);
    }
}

/* User and User Meta */
add_action('ef3-import-finish', 'givingwalk_import_user_metadata' ,1,2);
function givingwalk_import_user_metadata($id,$folder_dir){

    if (file_exists($file = $folder_dir . 'user_data.json')){
        $users_data = json_decode(file_get_contents($file),true);
        foreach ($users_data as $user)
        {
            $insert = $user['insert'];
            $insert['role'] = $user['roles'][0];
            if(username_exists($insert['user_login']) || email_exists($insert['user_email']))
                continue;
            $id = wp_insert_user($insert);
            if(!$id)
                continue;
            $new_user = get_user_by('id',$id);
            if(!$new_user instanceof WP_User)
                continue;
            foreach ($user['roles'] as $role)
            {
                $new_user->add_role($role);
            }
            if(count($new_user->roles) !== count($user['roles']) )
                foreach ($user['roles'] as $role)
                {
                    $new_user->add_role($role);
                }
            foreach ($user['meta'] as $field=>$meta)
            {
                update_user_meta($new_user->ID,$field,$meta[0]);
            }
        }
    }
}

add_action('ef3-export','givingwalk_export_user_metadata',1,2);
function givingwalk_export_user_metadata($id='',$folder_dir=''){
    global $wp_filesystem;
    $file = $folder_dir . 'user_data.json';
    if (file_exists($file)){
        return;
    }
    $users = get_users(array(
        'exclude'=>array(1)
    ));
    $users_data = array();
    $user_data_field = array(
        'user_pass',
        'user_login',
        'user_nicename',
        'user_url',
        'user_email',
        'display_name',
        'nickname',
        'first_name',
        'last_name',
        'description',
    );
    foreach ($users as $user)
    {
        if(!$user instanceof WP_User)
            continue;
        $user_data = array(
            'insert'=>array(),
            'roles'=>$user->roles,
            'meta'=>get_user_meta($user->ID)
        );
        foreach ($user_data_field as $field)
        {
            $user_data['insert'][$field] = $user->$field;
        }
        $users_data[] = $user_data;
    }
    $file_contents = json_encode($users_data);
    $wp_filesystem->put_contents( $file, $file_contents, FS_CHMOD_FILE);
}

add_action('ef3-import-finish', 'givingwalk_import_ef4_settings' ,1,2);
function givingwalk_import_ef4_settings($id,$folder_dir){

    if (file_exists($file = $folder_dir . 'ef4_settings.json')){
        $result = [];
        $data = json_decode(file_get_contents($file),true);
        foreach ($data as $post_type => $raw_data)
        {
            $result[] = apply_filters('ef4_import_custom_settings_data',false,[
                'post_type'=>$post_type,
                'data'=>$raw_data
            ]);
        }
        // save log of import result
        // none
    }
}
add_action('ef3-export','givingwalk_export_ef4_settings',1,2);
function givingwalk_export_ef4_settings($id='',$folder_dir=''){
    global $wp_filesystem;
    $file = $folder_dir . 'ef4_settings.json';
    if (file_exists($file)){
        return;
    }
    $post_types = ["crw_stories","crw_causes","tribe_organizer","tribe_events","crw_ticket","tribe_venue"];
    $data = [];
    foreach ($post_types as $post_type)
    {
        $data_export = apply_filters('ef4_get_export_custom_settings_data','',['post_type'=>$post_type]);
        if(empty($data_export))
            continue;
        $data[$post_type] = $data_export;
    }
    $file_contents = json_encode($data);
    $wp_filesystem->put_contents( $file, $file_contents, FS_CHMOD_FILE);
}

add_action('ef3-import-finish', 'givingwalk_crop_images',99,2);
function givingwalk_crop_images() {
    $query = array(
        'post_type'      => 'attachment',
        'posts_per_page' => -1,
        'post_status'    => 'inherit',
    );

    $media = new WP_Query($query);
    if ($media->have_posts()) {
        foreach ($media->posts as $image) {
            if (strpos($image->post_mime_type, 'image/') !== false) {
                $image_path = get_attached_file($image->ID);
                $metadata = wp_generate_attachment_metadata($image->ID, $image_path);
                wp_update_attachment_metadata($image->ID, $metadata);
            }
        }
    }
}