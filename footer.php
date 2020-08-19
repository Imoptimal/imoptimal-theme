<?php 
if(is_404()) {
    imothm_watermark(); 
} else { ?>
        <footer class="site-footer">
    <?php
    if(!function_exists('imothm_footer_wrap')) {
        function imothm_footer_wrap() {
            $imothm_footer = function() {
                echo "<div class='footer-content'>";
                wp_nav_menu( array(
                    'theme_location' => 'footer',
                    'container_class' => 'footer-menu')
                           );

                echo "<div class='footer-widget-area'>";
                if (is_active_sidebar('footer-sidebar')) :
                dynamic_sidebar('footer-sidebar');
                endif;
                echo "</div>
                </div>";
            };

            imothm_widgetization('footer-sidebar', $imothm_footer);
        }
        imothm_footer_wrap();
    }
    imothm_watermark();
    ?>
</footer>
<?php } ?>
</div>
<?php wp_footer(); ?>
</body>

</html>
