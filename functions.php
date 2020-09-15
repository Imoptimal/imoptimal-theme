<?php
if(!function_exists('imothm_theme_functions')) {
    function imothm_theme_functions() {
        get_template_part('admin-notices/Dismiss.php');
        get_template_part('admin-notices/Notice.php');
        get_template_part('admin-notices/Notices.php');
        //	Inserting style and script documents
        function imothm_site_resources() {
            wp_enqueue_style('imothm-style', get_template_directory_uri() . '/style.css', array());
            wp_enqueue_script('imothm-footer', get_template_directory_uri() . '/js/footer.js', array('jquery'), '1.0', true );
            if (is_singular()) {
                wp_enqueue_script("comment-reply");
            }
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

            // Adding custom color pallete for blocks
            add_theme_support( 'editor-color-palette', array(
                array(
                    'name' => esc_html__( 'Dark', 'imoptimal' ),
                    'slug' => 'imo-dark',
                    'color' => '#050303',
                ),
                array(
                    'name' => esc_html__( 'Ice', 'imoptimal' ),
                    'slug' => 'imo-ice',
                    'color' => '#efedf5',
                ),
                array(
                    'name' => esc_html__( 'Latte', 'imoptimal' ),
                    'slug' => 'imo-latte',
                    'color' => '#f4c951',
                ),
                array(
                    'name' => esc_html__( 'Dark Purple', 'imoptimal' ),
                    'slug' => 'imo-dark-purple',
                    'color' => '#27061c',
                ),
                array(
                    'name' => esc_html__( 'Light Purple', 'imoptimal' ),
                    'slug' => 'imo-light-purple',
                    'color' => '#84285b',
                )
            ) );

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
                'default' => 'none',
                'transport' => 'refresh', // or postMessage (if js is used for preview)
                'sanitize_callback' => 'imothm_sanitaze_callback'
            ));

            $wp_customize->add_section('imothm_theme_section', array(
                'title' => esc_html__('Imoptimal - Modification', 'imoptimal' ),
                'description' => '',
            ));

            $wp_customize->add_control('imothm_theme_ctrl', array(
                'type' => 'radio',
                'priority' => 10, // Within the section.
                'settings' => 'imothm_theme_widgetization',
                'section' => 'imothm_theme_section', // Required, core or custom.
                'label' => esc_html__('Theme modification options', 'imoptimal' ),
                'description' => esc_html__('Check an option of theme modification - through widgets or by Elementor', 'imoptimal' ),
                'choices' => array(
                    'none' => esc_html__('No modification', 'imoptimal'),
                    'widgets' => esc_html__('Widgetization', 'imoptimal'),
                    'elementor' => esc_html__('Elementorization', 'imoptimal'),
                  ),
            ));

            function imothm_sanitaze_callback($input) {
                $valid = array(
                    'none' => esc_html__('No modification', 'imoptimal'),
                    'widgets' => esc_html__('Widgetization', 'imoptimal'),
                    'elementor' => esc_html__('Elementorization', 'imoptimal'),
                );
             
                if (array_key_exists($input, $valid)) {
                    return $input;
                } else {
                    return '';
                }
            }
        }
        add_action('customize_register', 'imothm_customize_register');

        // Sane defaults 
        function imothm_get_option_defaults() {
            $defaults = array(
                'none' => esc_html__('No modification', 'imoptimal')
            );
            return apply_filters('imothm_get_option_defaults', $defaults );
        }

        // Enable widgetization if theme option is enabled, else leave the default template
        function imothm_widgetization($sidebar, $function) {
            $imothm_widgetization = get_theme_mod('imothm_theme_widgetization', imothm_get_option_defaults());
            if ($imothm_widgetization == 'widgets' || $imothm_widgetization == 'true') {    // true - previous theme version with checkbox
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
                //the_category( ' ' );
                $terms = get_the_category();
                foreach ($terms as $term) {
                    $class = (is_category($term->name)) ? 'current' : '';
                    echo '<a href="' . get_term_link($term) . '" class="' . $class . '">' . $term->name . '</a> ';
                }
            } else {
                esc_html_e('Uncategorized', 'imoptimal'); 
            }
        }
        //Display tags with separator
        function imothm_separate_tags() {
            if(has_tag()) {
                esc_html_e('Tags: ', 'imoptimal');
                //the_tags('', ' ' );
                $terms = get_the_tags();
                foreach ($terms as $term) {
                    $class = (is_tag($term->name)) ? 'current' : '';
                    echo '<a href="' . get_term_link($term) . '" class="' . $class . '">' . $term->name . '</a> ';
                }
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

        // Admin notices
        function imothm_admin_notice($hook) {
            $hook = get_current_screen();
            if ($hook->id != "dashboard") { // if not the main dashboard page
                return;
            }
            $message = esc_html__('Imoptimal Theme version 1.5.4 added another Customizer option besides the widgetization of your website - making it easy for you to build your whole website by Elementor as well.', 'imoptimal');
            echo "<div class='notice notice-info is-dismissible'>
                <p>{$message}</p>
            </div>";
        }
        add_action('admin_notices', 'imothm_admin_notice');

    }
    imothm_theme_functions();
}