<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $product;

if ( ! comments_open() ) {
	return;
}

?>
<div id="reviews" class="woocommerce-Reviews">
	<div id="comments">
		<h4 class="woocommerce-Reviews-title"><?php
			if ( get_option( 'woocommerce_enable_review_rating' ) === 'yes' && ( $count = $product->get_review_count() ) ) {
				printf( esc_html( _n( '%1$s review', '%1$s reviews', $count, 'givingwalk' ) ), esc_html( $count ));
			} else {
				esc_html_e( 'Reviews', 'givingwalk' );
			}
		?></h4>

		<?php if ( have_comments() ) : ?>

			<ol class="commentlist">
				<?php wp_list_comments( apply_filters( 'woocommerce_product_review_list_args', array( 'callback' => 'woocommerce_comments' ) ) ); ?>
			</ol>

			<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) :
				echo '<nav class="woocommerce-pagination">';
				paginate_comments_links( apply_filters( 'woocommerce_comment_pagination_args', array(
					'prev_text' => '&larr;',
					'next_text' => '&rarr;',
					'type'      => 'list',
				) ) );
				echo '</nav>';
			endif; ?>

		<?php else : ?>

			<p class="woocommerce-noreviews"><?php esc_html_e( 'There are no reviews yet.', 'givingwalk' ); ?></p>

		<?php endif; ?>
	</div>

	<?php if ( get_option( 'woocommerce_review_rating_verification_required' ) === 'no' || wc_customer_bought_product( '', get_current_user_id(), $product->get_id() ) ) : ?>

		<div id="review_form_wrapper">
			<div id="review_form">
				<?php
					$commenter = wp_get_current_commenter();
					if ( !is_user_logged_in() ) {
						$comment_form = array(
							'title_reply'          => have_comments() ? esc_html__( 'Post Reviews', 'givingwalk' ) : sprintf( esc_html__( 'Be the first to review &ldquo;%s&rdquo;', 'givingwalk' ), get_the_title() ),
							'title_reply_to'       => esc_html__( 'Leave a Reply to %s', 'givingwalk' ),
							'title_reply_before'   => '<span id="reply-title" class="comment-reply-title">',
							'title_reply_after'    => '</span>',
							'comment_notes_before' => '',
							'comment_notes_after'  => '',
							'fields'               => array(
								'author' => '<p class="comment-form-author">'.
											'<input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30" aria-required="true" placeholder="'.esc_attr__('Complete Name','givingwalk').'" required /></p>',
								'email'  => '<p class="comment-form-email">'.
											'<input id="email" name="email" type="email" value="' . esc_attr( $commenter['comment_author_email'] ) . '" size="30" aria-required="true" placeholder="'.esc_attr__('Email Address','givingwalk').'" required /></p>',

								'rating' => '<div class="comment-form-rating"><select name="rating" id="rating" aria-required="true" required>
									<option value="">' . esc_html__( 'Rate&hellip;', 'givingwalk' ) . '</option>
									<option value="5">' . esc_html__( 'Perfect', 'givingwalk' ) . '</option>
									<option value="4">' . esc_html__( 'Good', 'givingwalk' ) . '</option>
									<option value="3">' . esc_html__( 'Average', 'givingwalk' ) . '</option>
									<option value="2">' . esc_html__( 'Not that bad', 'givingwalk' ) . '</option>
									<option value="1">' . esc_html__( 'Very poor', 'givingwalk' ) . '</option>
								</select></div>',
							),
							'label_submit'  => esc_html__( 'Post Review', 'givingwalk' ),
							'logged_in_as'  => '',
							'comment_field' => '',
						);
					}else{
						$comment_form = array(
							'title_reply'          => have_comments() ? esc_html__( 'Post Reviews', 'givingwalk' ) : sprintf( esc_html__( 'Be the first to review &ldquo;%s&rdquo;', 'givingwalk' ), get_the_title() ),
							'title_reply_to'       => esc_html__( 'Leave a Reply to %s', 'givingwalk' ),
							'title_reply_before'   => '<span id="reply-title" class="comment-reply-title">',
							'title_reply_after'    => '</span>',
							'comment_notes_before' => '',
							'comment_notes_after'  => '',
							'fields'               => array(
								'author' => '<p class="comment-form-author">'.
											'<input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30" aria-required="true" placeholder="'.esc_attr__('Complete Name','givingwalk').'" required /></p>',
								'email'  => '<p class="comment-form-email">'.
											'<input id="email" name="email" type="email" value="' . esc_attr( $commenter['comment_author_email'] ) . '" size="30" aria-required="true" placeholder="'.esc_attr__('Email Address','givingwalk').'" required /></p>',

							),
							'label_submit'  => esc_html__( 'Post Review', 'givingwalk' ),
							'logged_in_as'  => '',
							'comment_field' => '',
						);
					}
					if ( $account_page_url = wc_get_page_permalink( 'myaccount' ) ) {
						$comment_form['must_log_in'] = '<p class="must-log-in">' . sprintf( esc_html__( 'You must be <a href="%s">logged in</a> to post a review.', 'givingwalk' ), esc_url( $account_page_url ) ) . '</p>';
					}
					if ( is_user_logged_in() ) {
						if ( get_option( 'woocommerce_enable_review_rating' ) === 'yes' ) {
							$comment_form['comment_field'] = '<div class="comment-form-rating"><select name="rating" id="rating" aria-required="true" required>
								<option value="">' . esc_html__( 'Rate&hellip;', 'givingwalk' ) . '</option>
								<option value="5">' . esc_html__( 'Perfect', 'givingwalk' ) . '</option>
								<option value="4">' . esc_html__( 'Good', 'givingwalk' ) . '</option>
								<option value="3">' . esc_html__( 'Average', 'givingwalk' ) . '</option>
								<option value="2">' . esc_html__( 'Not that bad', 'givingwalk' ) . '</option>
								<option value="1">' . esc_html__( 'Very poor', 'givingwalk' ) . '</option>
							</select></div>';
						}
					}

					$comment_form['comment_field'] .= '<p class="comment-form-comment"><textarea id="comment" name="comment" cols="45" rows="3" aria-required="true" placeholder="'.esc_attr__('Your Review','givingwalk').'" required></textarea></p>';

					comment_form( apply_filters( 'woocommerce_product_review_comment_form_args', $comment_form ) );
				?>
			</div>
		</div>

	<?php else : ?>

		<p class="woocommerce-verification-required"><?php esc_html_e( 'Only logged in customers who have purchased this product may leave a review.', 'givingwalk' ); ?></p>

	<?php endif; ?>

	<div class="clear"></div>
</div>
