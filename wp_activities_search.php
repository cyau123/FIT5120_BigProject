function get_activity_names_callback() {
    global $wpdb;

    // Check the nonce
    if (!isset($_GET['nonce']) || !wp_verify_nonce($_GET['nonce'], 'my-ajax-script-nonce')) {
        wp_die();
    }

    $location = isset($_GET['location']) ? $_GET['location'] : '';

    $table_name = 'wp_activities';
    $column_name = 'name';
    $sql = "SELECT DISTINCT $column_name FROM $table_name";
    if (!empty($location)) {
        $sql .= " WHERE location = '$location'";
    }
    $activity_names = $wpdb->get_col($sql);

    echo json_encode($activity_names);

    wp_die(); // All ajax handlers should die when finished
}
add_action('wp_ajax_get_activity_names', 'get_activity_names_callback');
add_action('wp_ajax_nopriv_get_activity_names', 'get_activity_names_callback');

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
  <div class="form-row justify-content-left">
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
            $output .= '<option value="' . esc_attr($location) . '" ' . $selected . 'class="custom-option">' . esc_html($location) . '</option>';
          }
        	$output .= '</select>
    </div>
	  <div class="form-group col-md-4 ">
		<label for="wp_activities" style="font-weight:bold">Name:</label>
		<input type="hidden" name="search_type" value="wp_activities" />
      	<input type="text" name="wp_activities_search" placeholder="Please enter activity name" list="activity_names" class="form-control search-bar"/>
      	<datalist id="activity_names">' . $options . '</datalist>
    </div>
  </div>
<div class="buttons-row row">
  <div class="form-group">
<button type="submit" class="btn btn-primary search-btn">
  <i class="fas fa-search"></i> Search
</button>
  <button type="button" class="btn btn-secondary reset-btn" onclick="resetPage()">
  <i class="fas fa-times"></i> Reset
</button>
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

$results = $wpdb->get_results($sql);

$items_per_page = 6;
$total_pages = ceil(count($results) / $items_per_page);
	


if (count($results) > 0) {
    $output .= '<div class="container">';
	
	$output .= '<div class="row align-items-center mb-3">'; 
	$output .= '<div class="col-md-6"></div>';
	$output .= '<div class="col-md-6">'; 
	$output .= '<div class="search-results-count" style="float: right; margin-right:10px; margin-top:10px;">Total Results: ' . count($results) . '</div>'; // Display the search results count
	$output .= '</div>';
	$output .= '</div>';

	
    $output .= '<div class="row activities-grid">';
    $count = 0; // Add a counter variable
    foreach ($results as $result) {
        $page_number = floor($count / $items_per_page) + 1;
        $output .= '<a href="' . esc_url($result->{$atts['link_column']}) . '" target="_blank" class="col-md-6 activity-item" data-page="' . $page_number . '">';
            $output .= '<div class="card wp-activities-box">';
            $output .= '<div class="card-body">';
            $output .= '<div class="card-img-container"><img src="' . esc_url($result->image_link) . '" alt="' . esc_attr($result->name) . '" class="card-img-top mb-2"></div>'; //  image 
            $output .= '<h4 class="card-title activity-name">' . ($result->name) . '</h4>';
            $output .= '<p class="card-text activity-location"><b>Location:</b> ' . ($result->location) . '</p>';
            $output .= '<p class="card-text activity-category"><b>Category:</b>  ' . ($result->category) . '</p>';
            $output .= '<p class="card-text activity-price-range"><b>Price Range:</b> ' . ($result->price) . '</p>';
            $output .= '<p class="card-text activity-description">' . ($result->description) . '</p>';
            $output .= '</div></div></a>';
        	$count++; // Increment the counter variable
    }
		$output .= '</div>'; // Close the activities-grid div

		$output .= '<div class="pagination">';
$output .= '<button type="button" class="btn btn-primary previous-btn" disabled><i class="fas fa-chevron-left"></i> Previous</button>';
// Add buttons for individual pages
for ($i = 1; $i <= $total_pages; $i++) {
    $output .= '<button type="button" class="btn btn-secondary individual-page-btn" data-page="' . $i . '">' . $i . '</button>';
}
$output .= '<button type="button" class="btn btn-primary next-btn activity-next-btn">Next <i class="fas fa-chevron-right"></i></button>';

$output .= '</div>';


		$output .= '</div></div>'; // Close the container div
	} else {
	$output .= '<div class="outside-container"><div class="container">';
		$output .= '<p>No results found.</p>';
	$output .= '<div class="pagination">';
		$output .= '<button type="button" class="btn btn-primary previous-btn" disabled>Previous</button>';
		$output .= '<button type="button" class="btn btn-primary next-btn" disabled>Next</button>';
		$output .= '</div>';
		$output .= '</div></div>'; 
	}

    // Add JavaScript function to reset the page
    $output .= '<script>
	
	jQuery(document).ready(function ($) {
        $("select[name=\'wp_activities_location\']").change(function () {
            const location = $(this).val();
            const nonce = "' . wp_create_nonce('my-ajax-script-nonce') . '";
            const ajaxUrl = "' . admin_url('admin-ajax.php') . '";
			
			// Clear the input value when the location dropdown changes
            $("input[name=\'wp_activities_search\']").val("");

            $.ajax({
                type: "GET",
                url: ajaxUrl,
                data: {
                    action: "get_activity_names",
                    nonce: nonce,
                    location: location,
                },
                success: function (response) {
                    const activityNames = JSON.parse(response);
                    const datalist = $("#activity_names");
                    datalist.empty();
                    activityNames.forEach(function (activityName) {
                        datalist.append("<option value=\'" + activityName + "\'>");
                    });
                },
                error: function (errorThrown) {
                    console.log(errorThrown);
                },
            });
        });
    });
	
					let currentPage = 1;
    const itemsPerPage = 6;
	
	function updateActivePageNumberButton() {
    document.querySelectorAll(\'.individual-page-btn\').forEach((button) => {
        if (button.dataset.page == currentPage) {
            button.classList.add(\'active-page-btn\');
        } else {
            button.classList.remove(\'active-page-btn\');
        }
    });
}

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

    // Update the active button style
    updateActivePageNumberButton();
}
	
	document.querySelectorAll(\'.individual-page-btn\').forEach((button) => {
    button.addEventListener(\'click\', () => {
        currentPage = parseInt(button.dataset.page);
        updatePagination();
    });
});

    document.querySelector(\'.previous-btn\').addEventListener(\'click\', () => {
    currentPage--;
    updatePagination();
    updateActivePageNumberButton();
});

document.querySelector(\'.next-btn\').addEventListener(\'click\', () => {
    currentPage++;
    updatePagination();
    updateActivePageNumberButton();
});

	

	
	document.querySelectorAll(\'.individual-page-btn\').forEach((button) => {
    button.addEventListener(\'click\', () => {
        currentPage = parseInt(button.dataset.page);
        updatePagination();
    });
});

    // Call the updatePagination function on page load
    updatePagination();
		
                    function resetPage() {
                        window.location.href = "https://financialguidevic.link/mental-health/discover-victoria";
                    }
					
                </script>';

    return $output;
}
add_shortcode('wp_activities_search', 'wp_activities_search');