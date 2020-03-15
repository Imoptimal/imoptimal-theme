<?php 
if(!function_exists('imothm_sidebar_wrap')) {
    function imothm_sidebar_wrap() {
        if (is_active_sidebar('true-sidebar')) { ?>
<div class="side-column">
    <?php dynamic_sidebar('true-sidebar'); ?>
</div> 
<?php }
    }
    imothm_sidebar_wrap();
}
?>