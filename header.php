<!DOCTYPE html>
<html <?php language_attributes(); ?>>
    <head>
        <meta charset="<?php bloginfo('charset'); ?>">
        <meta name="viewport" content="width=device-width">
        <?php wp_head(); ?>
    </head>

    <body <?php body_class(); ?>>
        <?php if (!function_exists('imothm_body_open')) {
    function imothm_body_open() {
        do_action('wp_body_open');
    }
} ?>

        <div class="imothm-container">

            <a class="skip-link screen-reader-text" href="#imothm-content">
                <?php esc_html_e( 'Skip to content', 'imoptimal' ); ?> </a>

            <?php if(is_404()) {
    $empty = '';
    return $empty;
} else { ?>

            <header class="site-header">
                <?php
    if(is_user_logged_in()) {
        echo "<div class='logged-in'></div>";
    }
    if(!function_exists('imothm_header_wrap')) {
        function imothm_header_wrap() {
            $imothm_header = function() {

                $handle_title = esc_html__("Dropdown Menu", "imoptimal");
                $menu_label = esc_html__("Menu", "imoptimal");
                echo "<div class='dropdown-menu'>
                            <input type='checkbox' class='handle js-off screen-reader-text'>
                            <label class='toggle-menu' for='dropdown-menu' title='{$handle_title}'>
                                {$menu_label}
			                 </label>";
                {

                }
                wp_nav_menu( array(
                    'theme_location' => 'header',
                    'container_class' => 'header-menu')
                           );

                echo "</div>";

                echo "<div class='bloginfo'>";

                if ( function_exists( 'the_custom_logo' ) ) {
                    the_custom_logo();
                }

                $name = get_bloginfo( 'name' );
                $description = get_bloginfo( 'description' );
                echo "<div class='spans'>
                                    <span class='name'>{$name}</span>
                                    <span class='description'>{$description}</span>
                                </div>
                            </div>";

                get_search_form();
            };

            imothm_widgetization('header-sidebar', $imothm_header);
        }
        imothm_header_wrap();
    }
                ?>

            </header>
            <?php } ?>