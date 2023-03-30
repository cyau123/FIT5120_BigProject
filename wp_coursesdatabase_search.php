function wp_coursesdatabase_search($atts) {
    global $wpdb;
    $atts = shortcode_atts( array(
        'table_name' => 'wp_coursesdatabase',
        'column_name' => 'course_name',
        'link_column' => 'link_address'
    ), $atts, 'wp_coursesdatabase_search' );

    $output = '<form action="" method="get">
                <input type="hidden" name="search_type" value="wp_coursesdatabase" />
                <input type="text" name="wp_coursesdatabase_search" placeholder="Search..." />
                <input type="submit" value="Search" />
              </form>';

    $sql = "SELECT * FROM $atts[table_name]";
    $results = $wpdb->get_results($sql);

    if (isset($_GET['search_type']) && $_GET['search_type'] === 'wp_coursesdatabase' && isset($_GET['wp_coursesdatabase_search'])) {
        $search_term = $_GET['wp_coursesdatabase_search'];
        $sql = "SELECT * FROM $atts[table_name] WHERE $atts[column_name] LIKE '%$search_term%'";
        $results = $wpdb->get_results($sql);
    }

    if (count($results) > 0) {
        $output .= '<div class="wp-coursesdatabase-results">';
        $output .= '<div class="wp-coursesdatabase-row">';
        $i = 0;
        foreach ($results as $result) {
            if ($i % 3 === 0 && $i !== 0) {
                $output .= '</div><div class="wp-coursesdatabase-row">';
            }
            $output .= '<a href="' . $result->{$atts['link_column']} . '" target="_blank"><div class="wp-coursesdatabase-box">' . $result->course_name . '</div></a>';
            $i++;
        }
        $output .= '</div></div>';
    } else {
        $output .= '<p>No results found.</p>';
    }

    return $output;
}
add_shortcode('wp_coursesdatabase_search', 'wp_coursesdatabase_search');
