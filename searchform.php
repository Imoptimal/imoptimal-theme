<?php
$imothm_handle = esc_attr__("Search", "imoptimal");
$imothm_home_url = esc_url(home_url( '/' ));
$imothm_search_label = esc_html__("Search:", "imoptimal");
$imothm_search_placeholder = esc_attr__("Type your search here", "imoptimal");
$imothm_search_button = esc_attr__("Search", "imoptimal");

echo "<div class='search-toggle'>
<input type='checkbox' class='handle js-off screen-reader-text'>
<label class='search toggle' for='search-toogle' title='{$imothm_handle}'>
    <div class='search icon'></div>
</label>
<form role='search' method='get' id='searchform' class='search' action='{$imothm_home_url}'>
    <div class='content'>
        <label class='screen-reader-text' for='s'>{$imothm_search_label}</label>
        <input type='text' value='' name='s' id='search-field' placeholder='{$imothm_search_placeholder}' />
        <input type='submit' id='search-submit' value='{$imothm_search_button}' />
    </div>
</form>
</div>";
?>
