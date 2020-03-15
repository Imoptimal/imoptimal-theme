<?php
if(!function_exists('imothm_theme_functions')) {
    function imothm_theme_functions() {
        //	Inserting style and script documents
        function imothm_site_resources() {
            wp_enqueue_style( 'imothm-style', get_template_directory_uri() . '/style.css', array());
            wp_enqueue_script('imothm-footer', get_template_directory_uri() . '/js/footer.js', array('jquery'), '1.0', true );
        }
        add_action('wp_enqueue_scripts', 'imothm_site_resources');

        // Theme setup
        function imothm_site_setup() {
            // Navigation Menus
            register_nav_menus(array(
                'header' => esc_html__('Header Menu', 'imoptimal'),
                'footer' => esc_html__('Footer Menu', 'imoptimal')
            ));

            // Add arrows to menu parent
            function imothm_add_menu_parent_class( $items ) {

                $parents = array();
                foreach ( $items as $item ) {
                    if ( $item->menu_item_parent && $item->menu_item_parent > 0 ) {
                        $parents[] = $item->menu_item_parent;
                    }
                }

                foreach ( $items as $item ) {
                    if ( in_array( $item->ID, $parents ) ) {
                        $item->classes[] = 'has-children';
                    }
                }

                return $items;
            }
            add_filter( 'wp_nav_menu_objects', 'imothm_add_menu_parent_class' );

            // Add featured image support
            add_theme_support('post-thumbnails'); //enable post featured image option
            add_image_size('imothm-front-page', 300, 150, true);
            add_image_size('imothm-archive-image', 600, 300, true);
            add_image_size('imothm-post-image', 900, 600, array('left', 'top'));

            //Internationalization of the theme files
            load_theme_textdomain( 'imoptimal', get_template_directory() . '/lang' );

            // Adding title tag
            add_theme_support( 'title-tag' );

            // Adding custom logo
            add_theme_support( 'custom-logo', array(
                'height'      => 150,
                'width'       => 150,
                'flex-height' => true,
                'flex-width'  => true,
                'header-text' => '',
            ) );

            // Adding RSS feed link
            add_theme_support( 'automatic-feed-links' );

            // Setting the default content width
            if ( ! isset( $content_width ) ) {
                $content_width = 960;
            }

            // Add woocommerce support
            if ( class_exists( 'WooCommerce' ) ) {
                add_theme_support( 'woocommerce' );
            }

            // Add Siteorigin page builder option for custom homepage
            add_theme_support( 'siteorigin-panels', array(
                'home-page'  => true,
            ) );

        }
        add_action('after_setup_theme', 'imothm_site_setup');

        // Add Widget Areas
        function imothm_widgets_init() {

            register_sidebar( array(
                'name'          => esc_html__( 'Header', 'imoptimal'),
                'id'            => 'header-sidebar',
                'description'   => esc_html__( 'Widget area added in the header section.', 'imoptimal' ),
                'before_widget' => '<div class="widget header-widget">',
                'after_widget'  => '</div>',
                'before_title'  => '<h2 class="widget-title">',
                'after_title'   => '</h2>',
            ) );

            register_sidebar( array(
                'name'          => esc_html__( 'Homepage', 'imoptimal' ),
                'id'            => 'homepage-sidebar',
                'description'   => esc_html__( 'Widget area added in the homepage content section.', 'imoptimal' ),
                'before_widget' => '<div class="widget homepage-widget">',
                'after_widget'  => '</div>',
                'before_title'  => '<h2 class="widget-title">',
                'after_title'   => '</h2>',
            ) );

            register_sidebar( array(
                'name'          => esc_html__( 'Pages', 'imoptimal' ),
                'id'            => 'pages-sidebar',
                'description'   => esc_html__( 'Widget area added in any page but homepage content section.', 'imoptimal' ),
                'before_widget' => '<div class="widget page-widget">',
                'after_widget'  => '</div>',
                'before_title'  => '<h2 class="widget-title">',
                'after_title'   => '</h2>',
            ) );

            register_sidebar( array(
                'name'          => esc_html__( 'Footer', 'imoptimal' ),
                'id'            => 'footer-sidebar',
                'description'   => esc_html__( 'Widget area added in the footer section.', 'imoptimal' ),
                'before_widget' => '<div class="widget footer-widget">',
                'after_widget'  => '</div>',
                'before_title'  => '<h2 class="widget-title">',
                'after_title'   => '</h2>',
            ) );

            register_sidebar( array(
                'name'          => esc_html__( 'Sidebar', 'imoptimal' ),
                'id'            => 'true-sidebar',
                'description'   => esc_html__( 'Widget area added in the sidebar section.', 'imoptimal' ),
                'before_widget' => '<aside class="widget true-widget">',
                'after_widget'  => '</aside>',
                'before_title'  => '<h2 class="widget-title">',
                'after_title'   => '</h2>',
            ) );

            register_sidebar( array(
                'name'          => esc_html__( '404 error', 'imoptimal' ),
                'id'            => 'error-sidebar',
                'description'   => esc_html__( 'Widget area added in the 404 page.', 'imoptimal' ),
                'before_widget' => '<aside class="widget error-widget">',
                'after_widget'  => '</aside>',
                'before_title'  => '<h2 class="widget-title">',
                'after_title'   => '</h2>',
            ) );

            if ( function_exists( 'is_woocommerce' ) ) {
                register_sidebar( array(
                    'name' 			=> esc_html__( 'Shop', 'imoptimal' ),
                    'id' 			=> 'shop-sidebar',
                    'description' 	=> esc_html__( 'Displays on WooCommerce pages.', 'imoptimal' ),
                    'before_widget' => '<aside id="%1$s" class="widget">',
                    'after_widget' 	=> '</aside>',
                    'before_title' 	=> '<h2 class="widget-title heading-strike">',
                    'after_title' 	=> '</h2>',
                ) );
            }
        }
        add_action( 'widgets_init', 'imothm_widgets_init' );

        // Customizer theme options
        function imothm_customize_register( $wp_customize ) {
            $wp_customize->add_setting( 'imothm_theme_widgetization', array(
                'type' => 'theme_mod', // or 'option'
                'capability' => 'edit_theme_options', // Administrator only
                'theme_supports' => '',
                'default' => 'false', // unchecked
                'transport' => 'refresh', // or postMessage (if js is used for preview)
                'sanitize_callback' => 'imothm_sanitaze_callback'
            ));

            $wp_customize->add_section('imothm_theme_section', array(
                'title' => esc_html__( 'Imoptimal - Widgetization', 'imoptimal' ),
                'description' => '',
            ));

            $wp_customize->add_control( 'imothm_theme_ctrl', array(
                'type' => 'checkbox',
                'priority' => 10, // Within the section.
                'settings' => 'imothm_theme_widgetization',
                'section' => 'imothm_theme_section', // Required, core or custom.
                'label' => esc_html__( 'Enable theme widgetization', 'imoptimal' ),
                'description' => esc_html__( 'Check the box if you want to enable the option to build your whole website with widgets. Otherwise, if checkbox remains unchecked, default page templates will be used.', 'imoptimal' ),
            ));

            function imothm_sanitaze_callback($checked) {
                // Boolean check.
                return ((isset($checked) && true == $checked ) ? true : false );
            }

        }
        add_action( 'customize_register', 'imothm_customize_register' );

        // Sane defaults 
        function imothm_get_option_defaults() {
            $defaults = array(
                'checked' => 'false'
            );
            return apply_filters( 'imothm_get_option_defaults', $defaults );
        }

        // Enable widgetization if theme option is enabled, else leave the default template
        function imothm_widgetization($sidebar, $function) {
            $imothm_widgetization = get_theme_mod('imothm_theme_widgetization', imothm_get_option_defaults());
            if ($imothm_widgetization == 'true') {
                if (is_active_sidebar($sidebar)) :
                dynamic_sidebar($sidebar);
                endif;
            } else {
                $function();
            }
        }

        // Enable customizer Edit button on hover for widgets
        add_theme_support( 'customize-selective-refresh-widgets' );

        // Add custom post classes alongside the default ones
        function imothm_add_post_classes($mainClass, $hasThumbClass) {
            if (has_post_thumbnail()) { 
                $classes = array(
                    $mainClass,
                    $hasThumbClass
                );
            } else {
                $classes = array(
                    $mainClass
                );
            }
            post_class($classes);
        }

        //Display categories with separator
        function imothm_separate_categories() {
            if(has_category()) {
                esc_html_e('Categorized as: ', 'imoptimal');
                the_category( ' / ' );
            } else {
                esc_html_e('Uncategorized', 'imoptimal'); 
            }
        }

        //Display tags with separator
        function imothm_separate_tags() {
            if(has_tag()) {
                esc_html_e('Tags: ', 'imoptimal');
                the_tags('', ' / ' );
            } else {
                esc_html_e('Untagged', 'imoptimal');
            }
        }

        // Pagination for manually paginated posts 
        $imothm_defaults = array(
            'before'           => '<p>' . esc_html__( 'Pages:', 'imoptimal' ),
            'after'            => '</p>',
            'link_before'      => '',
            'link_after'       => '',
            'next_or_number'   => 'number',
            'separator'        => ' ',
            'nextpagelink'     => esc_html__( 'Next page', 'imoptimal'),
            'previouspagelink' => esc_html__( 'Previous page', 'imoptimal' ),
            'pagelink'         => '%',
            'echo'             => 1
        );
        wp_link_pages( $imothm_defaults );

        // Exclude all pages from WordPress Search
        if (!is_admin()) {
            function imothm_search_filter($query) {
                if ($query->is_search) {
                    $query->set('post_type', 'post');
                }
                return $query;
            }
            add_filter('pre_get_posts','imothm_search_filter');
        }

        // Footer watermark
        function imothm_watermark() {
            $designed = esc_html__("Designed by", "imoptimal");
            $link = esc_url("https://imoptimal.com/");
            $imoptimal = esc_html__("Imoptimal", "imoptimal");
            echo "<div class='branding'>{$designed} <a href='{$link}' target='_blank'>{$imoptimal}</a><div>";
        }

    }
    imothm_theme_functions();
}