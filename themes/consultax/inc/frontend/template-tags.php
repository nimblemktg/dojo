<?php
/**
 * Custom template tags for this theme
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Consultax
 */

if ( ! function_exists( 'consultax_posted_on' ) ) :
    /**
     * Prints HTML with meta information for the current post-date/time.
     */
    function consultax_posted_on() {
        $time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
        if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
            $time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
        }

        $time_string = sprintf( $time_string,
            esc_attr( get_the_date( DATE_W3C ) ),
            esc_html( get_the_date() ),
            '',
            ''
        );

        $posted_on = sprintf(
        /* translators: %s: post date. */
            esc_html_x( '%s', 'post date', 'consultax' ),
            '<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
        );

        echo '<span class="posted-on">' . $posted_on . '</span>'; // WPCS: XSS OK.

    }
endif;

if ( ! function_exists( 'consultax_posted_by' ) ) :
    /**
     * Prints HTML with meta information for the current author.
     */
    function consultax_posted_by() {
        $byline = sprintf(
        /* translators: %s: post author. */
            esc_html_x( '%s', 'post author', 'consultax' ),
            '<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
        );

        echo '<span class="byline"> ' . $byline . '</span>'; // WPCS: XSS OK.

    }
endif;

if ( ! function_exists( 'consultax_post_meta' ) ) :
    /**
     * Prints HTML with meta information for the current author.
     */
    function consultax_post_meta() {
        $time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
        if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
            $time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
        }

        $time_string = sprintf( $time_string,
            esc_attr( get_the_date( DATE_W3C ) ),
            esc_html( get_the_date() ),
            '',
            ''
        );

        $posted_on = sprintf(
        /* translators: %s: post date. */
            esc_html_x( '%s', 'post date', 'consultax' ),$time_string
        );

        $byline = sprintf(
        /* translators: %s: post author. */
            esc_html_x( '%s', 'post author', 'consultax' ),
            '<a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a>'
        );

        $categories_list = get_the_category_list( esc_html__( ', ', 'consultax' ) );
        if ( $categories_list ) {
            /* translators: 1: list of categories. */
            $posted_in = sprintf( esc_html__( '%1$s', 'consultax' ), $categories_list ); // WPCS: XSS OK.
        }

        /* translators: used between list items, there is a space after the comma */
        $tags_list = get_the_tag_list( '', esc_html_x( ', ', 'list item separator', 'consultax' ) );
        if ( $tags_list ) {
            /* translators: 1: list of tags. */
            $tag_with = sprintf( '<span class="tags-links">' . esc_html__( '%1$s', 'consultax' ) . '</span>', $tags_list ); // WPCS: XSS OK.
        }
        $metas = consultax_get_option( 'post_entry_meta' );
        if ( ! empty( $metas ) ) :
            if( in_array('date', $metas) ) echo '<span class="posted-on">' . $posted_on . '</span>';
            if( in_array('cat', $metas) ) echo '<span class="posted-in">' . $posted_in . '</span>';
            if( in_array('author', $metas) ) echo '<span class="byline">' . $byline . '</span>';
        endif;

    }
endif;

if ( ! function_exists( 'consultax_entry_footer' ) ) :
	/**
	 * Prints HTML with meta information for the categories, tags and comments.
	 */
	function consultax_entry_footer() {
		// Hide category and tag text for pages.
		if ( 'post' === get_post_type() ) {
			/* translators: used between list items, there is a space after the comma */
			$tags_list = get_the_tag_list( '', esc_html_x( ' ', 'list item separator', 'consultax' ) );
			if ( $tags_list ) {
				/* translators: 1: list of tags. */
				printf( '<div class="tags-links">' . esc_html__( '%1$s', 'consultax' ) . '</div>', $tags_list ); // WPCS: XSS OK.
			}
		}

	}
endif;

/** Posts Navigation **/
if ( ! function_exists( 'consultax_posts_navigation' ) ) :
    function consultax_posts_navigation($prev = '<i class="fa fa-angle-left"></i>', $next = '<i class="fa fa-angle-right"></i>', $pages='') {
        global $wp_query, $wp_rewrite;
        $wp_query->query_vars['paged'] > 1 ? $current = $wp_query->query_vars['paged'] : $current = 1;
        if($pages==''){
            global $wp_query;
            $pages = $wp_query->max_num_pages;
            if(!$pages)
            {
                $pages = 1;
            }
        }
        $pagination = array(
            'base'          => str_replace( 999999999, '%#%', get_pagenum_link( 999999999 ) ),
            'format'        => '',
            'current'       => max( 1, get_query_var('paged') ),
            'total'         => $pages,
            'prev_text'     => $prev,
            'next_text'     => $next,
            'type'          => 'list',
            'end_size'      => 3,
            'mid_size'      => 3
        );
        $return =  paginate_links( $pagination );
        echo str_replace( "<ul class='page-numbers'>", '<ul class="page-pagination none-style">', $return );
    }
endif;

/**** Change length of the excerpt ****/
if ( ! function_exists( 'consultax_excerpt' ) ) :
    function consultax_excerpt($limit) {
        $excerpt = explode(' ', get_the_excerpt(), $limit);
        if (count($excerpt)>=$limit) {
            array_pop($excerpt);
            $excerpt = implode(" ",$excerpt).'...';
        } else {
            $excerpt = implode(" ",$excerpt);
        }
        $excerpt = preg_replace('`[[^]]*]`','',$excerpt);
        return $excerpt;
    }
endif;

//Custom comment list
if ( ! function_exists( 'consultax_comment_list' ) ) :
    function consultax_comment_list($comment, $args, $depth) {

        $GLOBALS['comment'] = $comment; ?>

        <li id="comment-<?php comment_ID(); ?>" <?php comment_class('comment-item'); ?>>
            <article class="comment-wrap clearfix">

                <div class="gravatar">
                    <?php echo get_avatar($comment,68 ); ?>
                </div>

                <div class="comment-content">
                    <div class="comment-meta">
                        <h6 class="comment-author"><?php printf(__('%s','consultax'), get_comment_author()) ?></h6>
                        <span class="comment-time"><?php comment_time( get_option( 'date_format' ) ); ?></span>
                    </div>
                    <div class="comment-text">
                        <?php if ($comment->comment_approved == '0'){ ?>
                            <em><?php esc_html_e('Your comment is awaiting moderation.','consultax') ?></em>
                        <?php }else{ ?>
                            <?php comment_text() ?>
                        <?php } ?>
                        <div class="comment-reply"><?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?></div>
                    </div>
                </div>

            </article>
        </li>

        <?php
    }
endif;

//Generate custom search form
function consultax_search_form( $form ) {
    $form = '<form role="search" method="get" id="search-form" class="search-form" action="' . esc_url( home_url( '/' ) ) . '" >
    <input type="search" class="search-field" placeholder="' . esc_html__( 'Enter keyword...', 'consultax' ) . '" value="' . get_search_query() . '" name="s" />
	<button type="submit" class="search-submit"><i class="fa fa-search"></i></button>
    </form>';

    return $form;
}
add_filter( 'get_search_form', 'consultax_search_form' );

//Add span to category post count
function consultax_cat_count_span($links) {
    $links = str_replace('</a> (', '</a> <span class="posts-count">(', $links);
    $links = str_replace(')', ')</span>', $links);
    return $links;
}
add_filter('wp_list_categories', 'consultax_cat_count_span');

//Add span to archive post count
function consultax_archive_count_span($links) {
    $links = str_replace('</a>&nbsp;(', '</a> <span class="posts-count">(', $links);
    $links = str_replace(')', ')</span>', $links);
    return $links;
}
add_filter('get_archives_link', 'consultax_archive_count_span');

require get_template_directory() . '/inc/frontend/widgets/recent-posts.php';