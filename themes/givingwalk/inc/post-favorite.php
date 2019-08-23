<?php
class NectarLove {
	 function __construct()   {
        add_action('wp_enqueue_scripts', array($this, 'enqueue_scripts'));
        add_action('wp_ajax_nectar-love', array($this, 'ajax'));
		add_action('wp_ajax_nopriv_nectar-love', array($this, 'ajax'));
	}

	function enqueue_scripts() {
		wp_register_script( 'post-favorite', get_template_directory_uri() . '/assets/js/post-favorite.js', 'jquery', '1.0', TRUE );
		global $post;
		wp_localize_script('post-favorite', 'nectarLove', array(
			'ajaxurl' => admin_url('admin-ajax.php'),
			'postID' => $post ? $post->ID : 0,
			'rooturl' => home_url('/')
		));
		wp_enqueue_script('post-favorite');
	}

	function ajax($post_id) {
		//update
		if( isset($_POST['loves_id']) ) {
			$post_id = str_replace('nectar-love-', '', $_POST['loves_id']);
			echo ''.$this->love_post($post_id, 'update');
		}
		//get
		else {
			$post_id = str_replace('nectar-love-', '', $_POST['loves_id']);
			echo ''.$this->love_post($post_id, 'get');
		}
		exit;
	}

	function love_post($post_id, $action = 'get')
	{
		if(!is_numeric($post_id)) return;
		$love_count = (int)get_post_meta($post_id, '_nectar_love', true);
		switch($action) {

			case 'get':
				if( !$love_count ){
					$love_count = 0;
					add_post_meta($post_id, '_nectar_love', $love_count, true);
				}
				return $love_count;
				break;

			case 'update':
				
				if( isset($_COOKIE['nectar_love_'. $post_id]) ) return $love_count;
				$love_count++;
				if($love_count > 1){
					$text = esc_html__('Likes','givingwalk');
				} else {
					$text = esc_html__('Like','givingwalk');
				}
				update_post_meta($post_id, '_nectar_love', $love_count);
				setcookie('nectar_love_'. $post_id, $post_id, time()*20, '/');

				return  $love_count .' '. $text ;
				break;

		}
	}

	function add_love($show_text = true, $show_icon = true) {
		global $post;

		$output = $this->love_post($post->ID);

  		$class = 'nectar-love';
  		$icon = 'fa fa-heart-o';
  		$title = esc_html__('Like this', 'givingwalk');
  		
  		$love_count = (int)get_post_meta($post->ID, '_nectar_love', true);
  		if($love_count > 1 || $love_count == 0){
  			$text = esc_html__('Likes','givingwalk');
  		} else {
  			$text = esc_html__('Like','givingwalk');;
  		}
		if( isset($_COOKIE['nectar_love_'. $post->ID]) ){
			$class = 'nectar-love loved unselected';
			$icon = 'fa fa-heart';
			$title = esc_html__('You already liked this!', 'givingwalk');
			if($show_text) $text = esc_html__('liked!','givingwalk');
		}
		$heart_icon = '';
		if($show_icon){
			$heart_icon = '<i class="'.$icon.'"></i>&nbsp;';
		}
		return '<a href="#" class="'. $class .'" id="nectar-love-'. $post->ID .'" title="'. esc_attr($title) .'"> '.$heart_icon. ' <span class="nectar-love-count">' . $output .' '.$text.'</span></a>';
	}

}
global $post_favorite;
$post_favorite = new NectarLove();

function post_favorite($return = false, $show_text = true, $show_icon = true) {
	global $post_favorite;
	if($return) {
		return $post_favorite->add_love($show_text,$show_icon);
	} else {
		echo ''.$post_favorite->add_love($show_text,$show_icon);
	}
}
?>
