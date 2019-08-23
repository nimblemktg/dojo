<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
$sidebar = givingwalk_get_sidebar();
givingwalk_on_off_options();
?>
<div id="primary" class="<?php givingwalk_main_content_class($sidebar); ?>">

