function show_kinder_on_map( $atts ) {
    global $wpdb;
    $kinder_locations = $wpdb->get_results( "SELECT * FROM wp_kinders WHERE address != ''" );

    ob_start();
    ?>
    <div id="map"></div>
    <input id="search-input" class="controls" type="text" placeholder="Enter an address">
    <script>
    function initMap() {
        var melbourne = { lat: -37.8136, lng: 144.9631 };
        var map = new google.maps.Map(document.getElementById('map'), {
            zoom: 15,
            center: melbourne
        });

        var infowindows = [];

        <?php foreach ( $kinder_locations as $i => $location ) : ?>
            var contentString<?php echo $i ?> = '<div id="content">'+
              '<h5 id="firstHeading " class="firstHeading"><?php echo addslashes($location->name); ?></h5>'+
              '<div id="bodyContent">'+
              '<p style="font-size:16px;"><b>Address:</b> <?php echo addslashes($location->address); ?></p>'+
              '<p style="font-size:16px;"><b>Phone:</b> <?php echo addslashes($location->phone); ?></p>'+
              '<p style="font-size:16px;"><b>Email:</b> <?php echo addslashes($location->email); ?></p>'+
              '<p style="font-size:16px;"><b>Program Type:</b> <?php echo addslashes($location->program_type); ?></p>'+
              '<p style="font-size:16px;"><b>Council:</b> <?php echo addslashes($location->council); ?></p>'+
              '<p style="font-size:16px;"><b>License ID:</b> <?php echo addslashes($location->licese_id); ?></p>'+
              '</div>'+
              '</div>';

            infowindows.push(new google.maps.InfoWindow({
                content: contentString<?php echo $i ?>
            }));

            var marker = new google.maps.Marker({
                position: {lat: <?php echo $location->latitude; ?>, lng: <?php echo $location->longitude; ?>},
                map: map,
                title: '<?php echo addslashes($location->name); ?>'
            });

		 // Create a closure function to capture the current marker and infowindow objects
            (function(marker, infowindow) {
                marker.addListener('click', function() {
                    infowindow.open(map, marker);
                });
            })(marker, infowindows[<?php echo $i ?>]);
		
        <?php endforeach; ?>

        // Autocomplete address search
        
        var searchInput = document.getElementById('search-input');
        var autocomplete = new google.maps.places.Autocomplete(searchInput);

        autocomplete.addListener('place_changed', function() {
            var place = autocomplete.getPlace();

            if (!place.geometry) {
                window.alert("No details available for input: '" + place.name + "'");
                return;
            }

            // Center the map on the selected address
            map.setCenter(place.geometry.location);
            map.setZoom(17);
        }); 
    }
    </script>

<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBI6rIQzeTg4UxOJsrRg2KygemYaiNLERQ&libraries=places&callback=initMap"></script>

    <?php
    return ob_get_clean();
}
add_shortcode( 'show_kinder', 'show_kinder_on_map' );