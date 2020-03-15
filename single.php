<?php get_header(); ?>
<div id="imothm-content" class="imothm-content" tabindex="-1">
    <div class="columns">
        <main class="main-column">
            <?php
            if (have_posts()) :
            while (have_posts()) : the_post();
            if (get_post_format() == false) { get_template_part('content', 'single'); }
            else { get_template_part('content', get_post_format()); }
            endwhile;
            comments_template(); // adding comments
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