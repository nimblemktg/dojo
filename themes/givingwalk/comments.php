<?php
/**
 * The template for displaying comments
 *
 * The area of the page that contains both current comments
 * and the comment form.
 *
 * @package SpyroPress
 * @subpackage Giving Walk
 * @author Red Team
 * @since 1.0.0
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() ) {
	return;
}
?>

<div id="comments" class="comments-area">
	<?php
	// You can start editing here -- including this comment!
	if ( have_comments() ) : ?>
		<h3 class="comments-title">
            <?php
	            $comments_number = get_comments_number();
				if ( '1' === $comments_number ) {
					printf( _x( '1 Comment', 'comments title', 'givingwalk' ) );	
				}else{
					printf( _nx( '0 Comment ', '%1$s Comments', get_comments_number(), 'comments title', 'givingwalk' ), number_format_i18n( get_comments_number() ));
				}
			?>
		</h3>
		  
		<div class="comment-list">
			<?php
				wp_list_comments( array(
					'avatar_size' => 100,
					'style'       => 'div',
					'short_ping'  => true,
					'callback'	  => 'givingwalk_comment'	
				) );
			?>
		</div>

		<?php the_comments_pagination( array(
			'prev_text' => '<i class="fa fa-angle-left"></i>',
			'next_text' =>  '<i class="fa fa-angle-right"></i>',
		) );

	endif; // Check for have_comments().

	// If comments are closed and there are comments, let's leave a little note, shall we?
	if ( ! comments_open() && get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) : ?>
		<p class="no-comments"><?php esc_html_e( 'Comments are closed.', 'givingwalk' ); ?></p>
	<?php
	endif;
	$args = array(
		'title_reply' => have_comments() ? esc_html__( 'Leave a Comments', 'givingwalk' ) : sprintf( esc_html__( 'Be the first to comment', 'givingwalk' ), get_the_title() ),
		'title_reply_before' => '<h3 id="reply-title" class="comment-reply-title"><i class="icon-comment-2"></i>',
		'comment_notes_before' => '',
		'fields' => apply_filters( 'comment_form_default_fields', array(

				'author' =>
				'<p class="comment-form-author"><input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) .
				'" size="30" aria-required="true" required="required" placeholder="'.esc_attr__('Complete Name','givingwalk').'"/></p>',

				'email' =>
				'<p class="comment-form-email"><input id="email" name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) .
				'" size="30" aria-required="true" required="required" placeholder="'.esc_attr__('Email Address','givingwalk').'"/></p>',

				'phone' => 
				'<p class="comment-form-phone"><input id="phone" name="phone" type="text" size="30"  placeholder="'.esc_attr__('Phone No','givingwalk').'" /></p>',
			)
		),
		'comment_field' =>  '<p class="comment-form-comment"><textarea id="comment" name="comment" cols="45" rows="3" aria-required="true" required="required" placeholder="'.esc_attr__('Your Comments','givingwalk').'"></textarea></p>',
	);

	comment_form($args);
	?>

</div><!-- #comments -->
