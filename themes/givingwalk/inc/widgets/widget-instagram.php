<?php
if (!class_exists('EF4Framework')) return;
add_action('widgets_init', 'GivingwalkInstagramWidget');

function GivingWalkInstagramWidget() {
    register_ef4_widget('GivingwalkInstagramWidget');
}


class GivingWalkInstagramWidget extends WP_Widget {
    function __construct() {
        parent::__construct(
            'GivingwalkInstagramWidget', // Base ID
            esc_html__('Givingwalk Instagram', 'givingwalk'), // Name
            array('description' => esc_html__('Show Instagram Image', 'givingwalk'),) // Args
        );
    }
    
    function widget($args, $instance) {      
        extract($args);
		$title         = empty($instance['title']) ? '' : apply_filters('widget_title', $instance['title']);
		$layout_mode   = empty($instance['layout_mode']) ? '0' : $instance['layout_mode'];
		$username      = empty($instance['username']) ? '' : $instance['username'];
		$id            = empty($instance['id']) ? '' : $instance['id'];
		$api           = empty($instance['api']) ? '' : $instance['api'];
		$limit         = empty($instance['number']) ? 6 : $instance['number'];
		$columns       = empty($instance['columns']) ? 3 : $instance['columns'];
		$columns_space = (int)$instance['columns_space'];
		$size          = empty($instance['size']) ? 'thumbnail' : $instance['size'];
		$show_author   = (int) $instance['show_author'];
		$target        = empty($instance['target']) ? '_self' : $instance['target'];
		$author_text   = $instance['author_text'];
		$extra_class   = empty($instance['extra_class']) ? '' : $instance['extra_class'];
		switch ($columns) {
			case 1:
	            $span = "col-12";
	            break;
	        case 2:
	            $span = "col-6";
	            break;
			case 3:
	            $span = "col-4";
	            break;
	        case 4:
	            $span = "col-4 col-md-3 col-lg-3 col-xl-3";
	            break;
	        default:
	            $span = "col-4 col-md-2 col-lg-2 col-xl-2";
	    }
        echo wp_kses_post($before_widget);

        if (!empty($title))
            echo wp_kses_post($before_title . $title . $after_title);
        switch ($layout_mode) {
        	default:
        		echo '<div class="red-instagram layout'.$layout_mode.' '.$extra_class.'">';
        		if ($show_author != '') {
					?><div class="user"><a href="//instagram.com/<?php echo trim($username); ?>" rel="me" target="<?php echo esc_attr( $target ); ?>"><?php if(!empty($author_text)) echo '<span class="author-text">'.esc_html($author_text).'</span>'; ?> <span class="author-name">@<?php echo trim($username); ?></span></a></div><?php
				}
		        if ($id != '') {

					$media_array = $this->scrape_instagram($id, $api, $limit);

					if ( is_wp_error($media_array) ) {

					   echo wp_kses_post($media_array->get_error_message());

					} else {

						// filter for images only?
						if ( $images_only = apply_filters( 'givingwalk_images_only', FALSE ) )
							$media_array = array_filter( $media_array, array( $this, 'images_only' ) );

						?>
						<div class="row gutter-<?php echo esc_attr($columns_space);?> clearfix">
						<?php
						foreach ($media_array as $item) {
							echo '<div class="instagram-item '.$span.' overlay-wrap">
								<a href="'. esc_url( $item['link'] ) .'" target="'. esc_attr( $target ) .'">
									<img src="'. esc_url($item[$size]['url']) .'" style="width:100%; max-width:100%;"/>
								</a><div class="overlay"><div class="overlay-inner vertical-align text-center"><a class="like" href="'. esc_url( $item['link'] ) .'" target="'. esc_attr( $target ) .'"><span class="fa fa-heart-o"></span>&nbsp;'.$item['likes'].'</a> <a class="comments" href="'. esc_url( $item['link'] ) .'" target="'. esc_attr( $target ) .'"><span class="fa fa-comments-o"></span>&nbsp;'.$item['comments'].'</a></div></div></div>';
						}
						?>
						</div>
						<?php
					}
				}
				echo '</div>';
        		break;
        }
        
        echo wp_kses_post($after_widget);
    }         
    
    function update( $new_instance, $old_instance ) {
		$instance                  = $old_instance;
		$instance['title']         = strip_tags($new_instance['title']);
		$instance['layout_mode']   = (int)($new_instance['layout_mode']);
		$instance['username']      = trim(strip_tags($new_instance['username']));
		$instance['id']            = trim(strip_tags($new_instance['id']));
		$instance['api']           = trim(strip_tags($new_instance['api']));
		$instance['number']        = !absint($new_instance['number']) ? 6 : $new_instance['number'];
		$instance['columns']       = !absint($new_instance['columns']) ? 3 : $new_instance['columns'];
		$instance['columns_space'] = (int)$new_instance['columns_space'];
		$instance['size']          = (($new_instance['size'] == 'thumbnail' || $new_instance['size'] == 'large') ? $new_instance['size'] : 'thumbnail');
		$instance['show_author']   = $new_instance['show_author'];
		$instance['target']        = (($new_instance['target'] == '_self' || $new_instance['target'] == '_blank') ? $new_instance['target'] : '_self');
		$instance['author_text']   = strip_tags($new_instance['author_text']);
		$instance['extra_class']   = $new_instance['extra_class'];
		
        return $instance;
    }
    
    function form( $instance ) {
		$instance      = wp_parse_args( (array) $instance, array( 'title' => '', 'layout_mode' => '0', 'username' => '', 'api' => '', 'show_author' => '1', 'author_text' => esc_html__('Follow Us', 'givingwalk'), 'number' => 6,'columns' => 3, 'columns_space' => '0', 'size' => 'thumbnail', 'target' => '_self') );
		$title         = esc_attr($instance['title']);
		$layout_mode   = (int)($instance['layout_mode']);
		$username      = !empty($instance['username']) ? $instance['username'] : 'zk.kidsplay';
		$id            = !empty($instance['id']) ? $instance['id'] : '6500395100';
		$api           = !empty($instance['api']) ? $instance['api'] : '6500395100.1677ed0.96ebe958c36346fca373fd4ed7016e47';
		$number        = absint($instance['number']);
		$columns       = absint($instance['columns']);
		$columns_space = (int)$instance['columns_space'];
		$size          = esc_attr($instance['size']);
		$show_author   = isset($instance['show_author']) ? esc_attr($instance['show_author']) : ''; 
		$target        = esc_attr($instance['target']);
		$author_text   = strip_tags($instance['author_text']);
		$extra_class   = isset($instance['extra_class']) ? esc_attr($instance['extra_class']) : '';
        ?>
		<p><label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php esc_html_e('Title', 'givingwalk'); ?>: <input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></label></p>
		
		<p><label for="<?php echo esc_attr($this->get_field_id('layout_mode')); ?>"><?php esc_html_e('Layout Mode', 'givingwalk'); ?>:</label>
			<select id="<?php echo esc_attr($this->get_field_id('layout_mode')); ?>" name="<?php echo esc_attr($this->get_field_name('layout_mode')); ?>" class="widefat">
				<option value="0" <?php selected('0', $target) ?>><?php esc_html_e('Default', 'givingwalk'); ?></option>
			</select>
		</p>

		<p><label for="<?php echo esc_attr($this->get_field_id('username')); ?>"><?php esc_html_e('User ID', 'givingwalk'); ?>: <a target="_blank" href="https://www.instagram.com/zk.kidsplay">https://www.instagram.com/zk.kidsplay</a> Get "zk.kidsplay". <input class="widefat" id="<?php echo esc_attr($this->get_field_id('username')); ?>" name="<?php echo esc_attr($this->get_field_name('username')); ?>" type="text" value="<?php echo esc_attr($username); ?>" placeholder="zk.kidsplay" /></label></p>
		<p><label for="<?php echo esc_attr($this->get_field_id('api')); ?>"><?php esc_html_e('Access Token', 'givingwalk'); ?>: <a target="_blank" href="http://instagram.pixelunion.net/">Generate Instagram Access Token</a> <input class="widefat" id="<?php echo esc_attr($this->get_field_id('api')); ?>" name="<?php echo esc_attr($this->get_field_name('api')); ?>" type="text" value="<?php echo esc_attr($api); ?>" placeholder="6500395100.1677ed0.96ebe958c36346fca373fd4ed7016e47" /></label></p>
		<p><label for="<?php echo esc_attr($this->get_field_id('id')); ?>"><?php esc_html_e('Client ID', 'givingwalk'); ?>: Get numbers before dot from Access Token. <input class="widefat" id="<?php echo esc_attr($this->get_field_id('id')); ?>" name="<?php echo esc_attr($this->get_field_name('id')); ?>" type="text" value="<?php echo esc_attr($id); ?>" placeholder="6500395100" /></label></p>

		<p><label for="<?php echo esc_attr($this->get_field_id('number')); ?>"><?php esc_html_e('Number of photos', 'givingwalk'); ?>: <input class="widefat" id="<?php echo esc_attr($this->get_field_id('number')); ?>" name="<?php echo esc_attr($this->get_field_name('number')); ?>" type="text" value="<?php echo esc_attr($number); ?>" /></label></p>

		<p><label for="<?php echo esc_attr($this->get_field_id('columns')); ?>"><?php esc_html_e('Columns', 'givingwalk'); ?>:</label>
			<select id="<?php echo esc_attr($this->get_field_id('columns')); ?>" name="<?php echo esc_attr($this->get_field_name('columns')); ?>" class="widefat">
				<option value="1" <?php selected('1', $columns) ?>>1</option>
				<option value="2" <?php selected('2', $columns) ?>>2</option>
				<option value="3" <?php selected('3', $columns) ?>>3</option>
				<option value="4" <?php selected('4', $columns) ?>>4</option>
				<option value="6" <?php selected('6', $columns) ?>>6</option>
				<option value="12" <?php selected('12', $columns) ?>>12</option>
			</select>
		</p>

		<p><label for="<?php echo esc_attr($this->get_field_id('columns_space')); ?>"><?php esc_html_e('Columns Space', 'givingwalk'); ?>:</label>
			<select id="<?php echo esc_attr($this->get_field_id('columns_space')); ?>" name="<?php echo esc_attr($this->get_field_name('columns_space')); ?>" class="widefat">
				<option value="0" <?php selected('0', $columns_space) ?>>0</option>
				<option value="10" <?php selected('10', $columns_space) ?>>10</option>
				<option value="15" <?php selected('15', $columns_space) ?>>15</option>
			</select>
		</p>

		<p><label for="<?php echo esc_attr($this->get_field_id('size')); ?>"><?php esc_html_e('Photo size', 'givingwalk'); ?>:</label>
			<select id="<?php echo esc_attr($this->get_field_id('size')); ?>" name="<?php echo esc_attr($this->get_field_name('size')); ?>" class="widefat">
				<option value="thumbnail" <?php selected('thumbnail', $size) ?>><?php esc_html_e('Thumbnail', 'givingwalk'); ?></option>
				<option value="large" <?php selected('large', $size) ?>><?php esc_html_e('Large', 'givingwalk'); ?></option>
			</select>
		</p>
		<p>
            <label for="<?php echo esc_attr($this->get_field_id('show_author')); ?>"><?php esc_html_e( 'Show Author:', 'givingwalk' ); ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id('show_author') ); ?>" name="<?php echo esc_attr( $this->get_field_name('show_author') ); ?>" <?php if($show_author!='') echo 'checked="checked"'; ?> type="checkbox" value="1"  />
        </p>
		<p><label for="<?php echo esc_attr($this->get_field_id('target')); ?>"><?php esc_html_e('Open author links in', 'givingwalk'); ?>:</label>
			<select id="<?php echo esc_attr($this->get_field_id('target')); ?>" name="<?php echo esc_attr($this->get_field_name('target')); ?>" class="widefat">
				<option value="_self" <?php selected('_self', $target) ?>><?php esc_html_e('Current window (_self)', 'givingwalk'); ?></option>
				<option value="_blank" <?php selected('_blank', $target) ?>><?php esc_html_e('New window (_blank)', 'givingwalk'); ?></option>
			</select>
		</p>
		<p><label for="<?php echo esc_attr($this->get_field_id('author_text')); ?>"><?php esc_html_e('Author text', 'givingwalk'); ?>: <input class="widefat" id="<?php echo esc_attr($this->get_field_id('author_text')); ?>" name="<?php echo esc_attr($this->get_field_name('author_text')); ?>" type="text" value="<?php echo esc_html__('Follow Us','givingwalk'); ?>" /></label></p>
		<p>
			<label for="<?php echo esc_attr($this->get_field_id('extra_class')); ?>">Extra Class:</label>
			<input class="widefat" type="text" id="<?php echo esc_attr($this->get_field_id('extra_class')); ?>" name="<?php echo esc_attr($this->get_field_name('extra_class')); ?>" value="<?php echo esc_attr($extra_class); ?>" />
		</p>
         <?php
         
    } 
    function scrape_instagram($id, $api, $slice = 6) {
		if (false === ($instagram = get_transient('instagram-media-'.sanitize_title_with_dashes($id)))) {

			$remote = wp_remote_get("https://api.instagram.com/v1/users/".$id."/media/recent/?access_token=".$api."&count=".$slice, true);

			if (is_wp_error($remote))
	  			return new WP_Error('site_down', esc_html__('Unable to communicate with Instagram.', 'givingwalk'));

  			if ( 200 != wp_remote_retrieve_response_code( $remote ) )
  				return new WP_Error('invalid_response', esc_html__('Instagram did not return a 200.', 'givingwalk'));

			$insta_array = json_decode($remote['body'], TRUE);

			if (!$insta_array)
	  			return new WP_Error('bad_json', esc_html__('Instagram has returned invalid data.', 'givingwalk'));

			$images = $insta_array['data'];

			$instagram = array();

			foreach ($images as $image) {
					$image['link']                          = preg_replace( "/^http:/i", "", $image['link'] );
					$image['images']['thumbnail']           = preg_replace( "/^http:/i", "", $image['images']['thumbnail'] );
					$image['images']['standard_resolution'] = preg_replace( "/^http:/i", "", $image['images']['standard_resolution'] );
					$instagram[] = array(
						/*'description'   => $image['caption']['text'],*/
						'link'          => $image['link'],
						'time'          => $image['created_time'],
						'comments'      => $image['comments']['count'],
						'likes'         => $image['likes']['count'],
						'thumbnail'     => $image['images']['thumbnail'],
						'large'         => $image['images']['standard_resolution'],
						'type'          => $image['type']
					);
			}
			$instagram = serialize( $instagram );
			set_transient('instagram-media-'.sanitize_title_with_dashes($id), $instagram, apply_filters('givingwalk_instagram_cache_time', HOUR_IN_SECONDS*2));
		}
		$instagram = unserialize(  $instagram ) ;
		return array_slice($instagram, 0, $slice);
	}
	function images_only($media_item) {

		if ($media_item['type'] == 'image')
			return true;

		return false;
	}
	function getInstaID($username, $client_id)
	{

	    $username = strtolower($username); // sanitization
	    $url = "https://api.instagram.com/v1/users/search?q=".$username."&client_id=".$client_id;
	    $get = wp_remote_get($url);
	    if (is_wp_error($get))
			return new WP_Error('site_down', esc_html__('Unable to communicate with Instagram.', 'givingwalk'));

		if ( 200 != wp_remote_retrieve_response_code( $get ) )
			return new WP_Error('invalid_response', esc_html__('Instagram did not return a 200.', 'givingwalk'));
	    $json = json_decode($get['body']);

	    foreach($json->data as $user)
	    {
	        if($user->username == $username)
	        {
	            return $user->id;
	        }
	    }

	    return '00000000'; // return this if nothing is found
	}

}
?>