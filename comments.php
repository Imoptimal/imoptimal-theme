<div id="comments" class="comments-area">

    <?php if ( have_comments() ) : ?>
    <h3 class="comments-title">
        <?php
        $comments_number = get_comments_number();
        if ( '1' === $comments_number ) {
            /* translators: %s: post title */
            esc_html(printf( _x( 'One Reply to "%s"', 'comments title', 'imoptimal' ), get_the_title() ));
        } else {
            esc_html(printf(
                /* translators: 1: number of comments, 2: post title */
                _nx(
                    '%1$s Reply to "%2$s"',
                    '%1$s Replies to "%2$s"',
                    $comments_number,
                    'comments title',
                    'imoptimal'
                ),
                number_format_i18n( $comments_number ),
                get_the_title()
            ));
        }
        ?>
    </h3>

    <ol class="comment-list">
        <?php
        wp_list_comments( array(
            'style'       => 'ol',
            'short_ping'  => true,
            'avatar_size' => 74,
        ) );
        ?>
    </ol>

    <?php
    // Are there comments to navigate through?
    if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) :
    ?>
    <nav class="comment-navigation" role="navigation">
        <h1 class="screen-reader-text section-heading"><?php esc_html_e( 'Comment navigation', 'imoptimal' ); ?></h1>
        <div class="nav-previous"><?php previous_comments_link( __( 'Older Comments', 'imoptimal' ) ); ?></div>
        <div class="nav-next"><?php next_comments_link( __( 'Newer Comments', 'imoptimal' ) ); ?></div>
    </nav>

    <?php endif; // Check for comment navigation ?>

    <?php if ( ! comments_open() && get_comments_number() ) : ?>
    <p class="no-comments">
        <?php esc_html_e( 'Comments are closed.' , 'imoptimal' ); ?></p>
    <?php endif; ?>

    <?php endif; // have_comments() ?>

    <?php comment_form(); ?>

</div>