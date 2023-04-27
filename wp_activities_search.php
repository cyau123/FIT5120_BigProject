function wp_activities_search($atts) {
    global $wpdb;
    $atts = shortcode_atts( array(
        'table_name' => 'wp_activities',
        'column_name' => 'name',
        'link_column' => 'website'
    ), $atts, 'wp_activities_search' );

    // Get all the activity names from the database
    $sql = "SELECT DISTINCT $atts[column_name] FROM $atts[table_name]";
    $activity_names = $wpdb->get_col($sql);

    // Create the datalist options
    $options = '';
    foreach ($activity_names as $activity_name) {
        $options .= '<option value="' . esc_attr($activity_name) . '">';
    }

    $output = '<div class="outside-container"><div class="container form-container">
	
	<form action="" method="get" class="wp-activities-search-form">
  <div class="form-row">
    <div class="form-group col-md-4 ">
		<label for="wp_activities" style="font-weight:bold">Name:</label>
		<input type="hidden" name="search_type" value="wp_activities" />
      	<input type="text" name="wp_activities_search" placeholder="Please enter activity name" list="activity_names" class="form-control search-bar"/>
      	<datalist id="activity_names">' . $options . '</datalist>
    </div>
    <div class="form-group col-md-4">
		<label for="wp_activities_location" style="font-weight:bold">Location:</label>
      	<select name="wp_activities_location" class="form-control custom-select ">
        <option value="">All Locations</option>';
          $locations = $wpdb->get_col("SELECT DISTINCT location FROM $atts[table_name] ORDER BY location ASC");
          foreach ($locations as $location) {
            $selected = '';
            if (isset($_GET['wp_activities_location']) && $_GET['wp_activities_location'] === $location) {
              $selected = 'selected';
            }
            $output .= '<option value="' . esc_attr($location) . '" ' . $selected . '>' . esc_html($location) . '</option>';
          }
        	$output .= '</select>
    </div>
    <div class="form-group col-md-4 ">
	<label for="wp_activities_category" style="font-weight:bold">Category:</label>
      <select name="wp_activities_category" class="form-control custom-select">
        <option value="">All Categories</option>';
          $categories = $wpdb->get_col("SELECT DISTINCT category FROM $atts[table_name] ORDER BY category ASC");
          foreach ($categories as $category) {
            $selected = '';
            if (isset($_GET['wp_activities_category']) && $_GET['wp_activities_category'] === $category) {
              $selected = 'selected';
            }
            $output .= '<option value="' . esc_attr($category) . '" ' . $selected . '>' . esc_html($category) . '</option>';
          }
        $output .= '</select>
    </div>
  </div>
<div class="buttons-row row">
  <div class="form-group">
  <button type="submit" class="btn btn-primary search-btn">Search</button>
  <button type="button" class="btn btn-secondary reset-btn" onclick="resetPage()">Reset</button>
  </div>
  </div> 
</form></div>';


    $sql = "SELECT * FROM $atts[table_name] WHERE 1=1";

if (isset($_GET['wp_activities_search']) && !empty($_GET['wp_activities_search'])) {
    $search_term = $_GET['wp_activities_search'];
    $sql .= " AND $atts[column_name] LIKE '%$search_term%'";
}

if (isset($_GET['wp_activities_location']) && !empty($_GET['wp_activities_location'])) {
    $location = $_GET['wp_activities_location'];
    $sql .= " AND location = '$location'";
}

if (isset($_GET['wp_activities_category']) && !empty($_GET['wp_activities_category'])) {
    $category = $_GET['wp_activities_category'];
    $sql .= " AND category = '$category'";
}

$results = $wpdb->get_results($sql);

$items_per_page = 6;

if (count($results) > 0) {
    $output .= '<div class="container">';
    $output .= '<div class="row activities-grid">';

    $count = 0; // Add a counter variable
    foreach ($results as $result) {
        $page_number = floor($count / $items_per_page) + 1;
        $output .= '<a href="' . esc_url($result->{$atts['link_column']}) . '" target="_blank" class="col-md-4 col-sm-6 mb-4 activity-item" data-page="' . $page_number . '">';
            $output .= '<div class="card wp-activities-box">';
            $output .= '<div class="card-body">';
            $output .= '<img src="' . esc_url($result->image_link) . '" alt="' . esc_attr($result->name) . '" class="card-img-top mb-2">'; //  image 
            $output .= '<h4 class="card-title activity-name">' . ($result->name) . '</h4>';
            $output .= '<p class="card-text activity-location"><b>Location:</b> ' . ($result->location) . '</p>';
            $output .= '<p class="card-text activity-category"><b>Category:</b>  ' . ($result->category) . '</p>';
            $output .= '<p class="card-text activity-price-range"><b>Price Range:</b> ' . ($result->price) . '</p>';
            $output .= '<p class="card-text activity-description">' . ($result->description) . '</p>';
            $output .= '</div></div></a>';
        	$count++; // Increment the counter variable
    }
		$output .= '</div>'; // Close the activities-grid div

		// Add buttons for next and previous pages
		$output .= '<div class="pagination">';
		$output .= '<button type="button" class="btn btn-primary previous-btn" disabled>Previous</button>';
		$output .= '<button type="button" class="btn btn-primary next-btn">Next</button>';
		$output .= '</div>';

		$output .= '</div></div>'; // Close the container div
	} else {
		$output .= '<p>No results found.</p>';
	}

    // Add JavaScript function to reset the page
    $output .= '<script>
	
					let currentPage = 1;
    const itemsPerPage = 6;

    function updatePagination() {
        const activityItems = document.querySelectorAll(\'.activity-item\');
        activityItems.forEach((item) => {
            item.classList.add(\'hidden-grid\');

            if (item.dataset.page == currentPage) {
                item.classList.remove(\'hidden-grid\');
            }
        });

        document.querySelector(\'.previous-btn\').disabled = (currentPage === 1);
        document.querySelector(\'.next-btn\').disabled = (currentPage * itemsPerPage >= activityItems.length);
    }

    document.querySelector(\'.previous-btn\').addEventListener(\'click\', () => {
        currentPage--;
        updatePagination();
    });

    document.querySelector(\'.next-btn\').addEventListener(\'click\', () => {
        currentPage++;
        updatePagination();
    });

    // Call the updatePagination function on page load
    updatePagination();
                    function resetPage() {
                        window.location.href = "https://financialguidevic.link/search-test";
                    }
                </script>';

    return $output;
}
add_shortcode('wp_activities_search', 'wp_activities_search');
