<?php get_header(); ?>
<div id="imothm-content" class="imothm-content" tabindex="-1">
    <div class="columns">
        <main class="main-column">
            <?php
            if (have_posts()) :
            while (have_posts()) : the_post();

            if(!function_exists('imothm_pages_wrap')) {
                function imothm_pages_wrap() {
                    $imothm_pages = function() { ?>
            <article <?php imothm_add_post_classes('post', 'has-thumbnail'); ?>>
                <h1><?php the_title(); ?></h1>
                <div class="entry-content">
                    <?php the_content(); ?>
                </div>
            </article>
            <?php };
                    imothm_widgetization('pages-sidebar', $imothm_pages);
                }
                imothm_pages_wrap();
            }

            endwhile;
            else : ?>
            <p class="no-content">
                <?php esc_html_e( 'Content not found.' , 'imoptimal' ); ?>
            </p>
            <?php
            endif;
            ?>
        </main>
        <?php get_sidebar(); ?>
    </div>
</div>
<?php get_footer(); ?>
