<?php get_header(); ?>
<div id="imothm-content" class="imothm-content" tabindex="-1">
    <div class="columns">
        <main class="main-column">
            <h2><?php
                $space = ' ';
                esc_html_e('Search results for:', 'imoptimal');
                echo $space;
                trim(the_search_query()); ?>
            </h2>
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
</div>
<?php get_footer(); ?>

