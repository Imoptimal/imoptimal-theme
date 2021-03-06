<!DOCTYPE html>
<html <?php language_attributes(); ?>>
    <head>
        <meta charset="<?php bloginfo('charset'); ?>">
        <meta name="viewport" content="width=device-width">
        <?php wp_head(); ?>
    </head>

    <body <?php body_class(); ?>>
        <?php
        if (function_exists('wp_body_open')) {
            wp_body_open();
        } else {
            do_action('wp_body_open');
        }
        
        if (!function_exists('imothm_elementor')) {
            function imothm_elementor() {
                $imothm_widgetization = get_theme_mod('imothm_theme_widgetization', imothm_get_option_defaults());
                if ($imothm_widgetization == 'elementor') { ?>
                    <div class="imothm-container imothm-elementor">
                <?php } else { ?>
                    <div class="imothm-container">
                <?php }
            }
            imothm_elementor();
        }
        ?>
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
                echo "<div class='dropdown-menu'>
                            <input type='checkbox' class='handle js-off screen-reader-text'>
                            <label class='menu toggle' for='dropdown-menu' title='{$handle_title}'>
                                <div class='menu icon'></div>
			                 </label>";
                
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