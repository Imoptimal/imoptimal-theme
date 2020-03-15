<?php get_header(); ?>
<div id="imothm-content" class="imothm-content-404" tabindex="-1">
    <?php
    if(!function_exists('imothm_error_wrap')) {
        function imothm_error_wrap() {
            $imothm_error = function() {
                $fourOfour = esc_html__("404", "imoptimal");
                $h2 = esc_html__("Page that you've been looking for, has not been found...", "imoptimal");
                $apology = esc_html__("We apologize for that.", "imoptimal");
                $home_url = esc_url(home_url( '/' ));
                $search_intro = esc_html__("Use the search below to find specified content:", "imoptimal");
                $alternative_start = esc_html__("Alternatively, click", "imoptimal");
                $here = esc_html__("here", "imoptimal");
                $alternative_end = esc_html__("to return on the homepage.", "imoptimal");

                if (function_exists('the_custom_logo')) {
                    the_custom_logo();
                }
                echo "<h2> <span>{$fourOfour}</span> - {$h2}</h2>
                            <p class='apology'>{$apology}</p>
                            <p>{$search_intro}</p>";
                get_search_form();
                echo "<p class='return-home'>{$alternative_start} <a href='{$home_url}'><b>{$here}</b></a>  {$alternative_end}</p>";

            };

            imothm_widgetization('true-sidebar', $imothm_error);
        }
        imothm_error_wrap();
    }
    ?>
</div>
<?php get_footer(); ?>