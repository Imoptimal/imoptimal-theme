<article <?php imothm_add_post_classes('full-post', 'has-thumbnail'); ?>> 
    <h2><?php the_title(); ?></h2>
    <p class="post-info"><?php the_date(); ?>
        <span class="imothm-authors"><a href="<?php echo esc_url(get_author_posts_url( get_the_author_meta( 'ID' ), get_the_author_meta( 'user_nicename' ) )); ?>"><?php the_author(); ?></a></span> | 
        <span class="imothm-categories"><?php imothm_separate_categories(); ?></span> | 
        <span class="imothm-tags"><?php imothm_separate_tags(); ?>
        </span>
    </p>

    <div class="full-image">
        <?php the_post_thumbnail('imothm-post-image'); ?>
    </div>

    <div class="entry-content">
        <?php the_content(); ?>
    </div>
</article>