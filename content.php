<article <?php imothm_add_post_classes('post', 'has-thumbnail'); ?>>

    <?php if (is_archive() OR is_search()) { ?>

    <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>

    <p class="post-info"><?php the_date(); ?>
        <span class="imothm-authors"><a href="<?php echo esc_url(get_author_posts_url( get_the_author_meta( 'ID' ), get_the_author_meta( 'user_nicename' ) )); ?>"><?php the_author(); ?></a></span> | 
        <span class="imothm-categories"><?php imothm_separate_categories(); ?></span> | 
        <span class="imothm-tags"><?php imothm_separate_tags(); ?>
        </span>
    </p>

    <div class="archive-thumbnail">
        <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('imothm-archive-image'); ?></a>
    </div>

    <p class="excerpt">
        <?php the_excerpt(); ?>
        <a href="<?php the_permalink(); ?>"><?php esc_html_e('Read more', 'imoptimal'); ?> &raquo;</a>
    </p>

    <?php } elseif (is_home()) { // blog posts on front page or any other selected ?>

    <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>

    <p class="post-info"><?php the_date(); ?>
        <span class="imothm-authors"><a href="<?php echo esc_url(get_author_posts_url( get_the_author_meta( 'ID' ), get_the_author_meta( 'user_nicename' ) )); ?>"><?php the_author(); ?></a></span> | 
        <span class="imothm-categories"><?php imothm_separate_categories(); ?></span> | 
        <span class="imothm-tags"><?php imothm_separate_tags(); ?>
        </span>
    </p>

    <div class="homepage-thumbnail">
        <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('imothm-front-page'); ?></a>
    </div>

    <p class="excerpt">
        <?php the_excerpt(); ?>
        <a href="<?php the_permalink(); ?>"><?php esc_html_e('Read more', 'imoptimal'); ?> &raquo;</a>
    </p>

    <?php } else { 

    if ($post->post_excerpt) { ?> 
    <p class="excerpt">
        <?php the_excerpt(); ?>
        <a href="<?php the_permalink(); ?>"><?php esc_html_e('Read more', 'imoptimal'); ?> &raquo;</a>
    </p>

    <?php } else { //if custom front-page ?>
    <div class="entry-content">
        <?php the_content(); ?>
    </div>

    <?php }
}?>	

</article>