<?php get_header(); ?>
<div id="imothm-content" class="imothm-content" tabindex="-1">
    <?php          
    if(!function_exists('imothm_homepage_wrap')) {
        function imothm_homepage_wrap() {
            $imothm_homepage = function() { ?>
    <div class="columns">
        <main class="main-column">
            <?php
                if (have_posts()) :
                while (have_posts()) : the_post();
                get_template_part('content', get_post_format());
                endwhile; ?>
            <div class="pagination">
                <?php the_posts_pagination( array(
                    'mid_size'  => 2,
                    'prev_text' => esc_html__( 'Previous Page', 'imoptimal' ),
                    'next_text' => esc_html__( 'Next Page', 'imoptimal' ),
                ) ); ?>
            </div>
            <?php
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

    <?php };
            imothm_widgetization('homepage-sidebar', $imothm_homepage);
        }
        imothm_homepage_wrap();
    };
    ?>
</div> 
<?php get_footer(); ?>
