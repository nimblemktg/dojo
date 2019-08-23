<?php
/**
 * The default template for displaying content
 *
 * Used for index/archive/author/search.
 *
 * @package SpyroPress
 * @subpackage Giving Walk
 * @since 1.0.0
 */
?>

<article <?php post_class('entry-archive entry-grid'); ?>>
	<?php 
		givingwalk_post_media('medium');  
	?>
	<div class="entry-info">
		<?php givingwalk_archive_header('h3'); ?>
        <div class="detail-author clearfix">
            <span class="author-avatar">
                <?php 
                    echo get_avatar(get_the_author_meta('ID'), 35, '', get_the_author(), array('class' => 'img-circle'));
                ?>
            </span>
            <span class="author-info">
                <?php echo esc_html__('Posted by ','givingwalk'); ?>
                <?php the_author_posts_link(); ?>
            </span>
        </div>
		
		<?php givingwalk_archive_footer(); ?>
	</div>
</article>
