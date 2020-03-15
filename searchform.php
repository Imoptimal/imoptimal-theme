<?php
$imothm_home_url = esc_url(home_url( '/' ));
$imothm_search_label = esc_html__("Search:", "imoptimal");
$imothm_search_title = esc_html__("Search content", "imoptimal");
$imothm_search_placeholder = esc_attr__("Type your search here", "imoptimal");
$imothm_search_button = esc_attr__("Search", "imoptimal");

echo "<form role='search' method='get' id='searchform' class='search' action='{$imothm_home_url}'>
    <label class='screen-reader-text' for='s'>{$imothm_search_label}</label>
    <input title='{$imothm_search_title}' type='text' value='' name='s' id='search-field' placeholder='{$imothm_search_placeholder}' />
    <input type='submit' id='search-submit' value='{$imothm_search_button}' />
</form>";
