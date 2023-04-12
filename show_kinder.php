function show_kinder_on_map( $atts ) {
    global $wpdb;
    $kinder_locations = $wpdb->get_results( "SELECT * FROM wp_kinders WHERE address != ''" );

    ob_start();
    ?>
<style>
	    ul {
	      list-style: none;
	      padding: 0;
	      margin: 0;
	    }
	 .kinder-box {
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 4px;
            margin-bottom: 10px;
            padding: 10px;
            box-shadow: 0 2px 2px rgba(0, 0, 0, 0.3);
        }
	</style>
	<div style="display:flex;">
        <div style="flex-basis:60%;">
            <input id="search-input" class="controls" type="text" placeholder="Please enter your address">
            <div id="map"></div>
        </div>
        <div style="flex-basis:40%;">
            <h3>Kinder Locations</h3>
            <ul id="kinder-list">
                <?php foreach ( $kinder_locations as $i => $location ) : ?>
                    <div class="kinder-box">
                        <li class="kinder-location" data-lat="<?php echo $location->latitude; ?>" data-lng="<?php echo $location->longitude; ?>">
                            <h4><?php echo addslashes($location->name); ?></h4>
                            <p style="font-size:16px;"><b>Address:</b> <?php echo addslashes($location->address); ?></p>
                            <p style="font-size:16px;"><b>Phone:</b> <?php echo addslashes($location->phone); ?></p>
                            <p style="font-size:16px;"><b>Email:</b> <?php echo addslashes($location->email); ?></p>
                        </li>
                    </div>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>
    
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
             '<p style="font-size:16px;"><b>Email:</b> <a href="mailto:<?php echo addslashes($location->email); ?>" onclick="event.stopPropagation();"><?php echo addslashes($location->email); ?></a></p>'+
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
		 autocomplete.setComponentRestrictions({
    country: "au"
  });

        autocomplete.addListener('place_changed', function() {
            var place = autocomplete.getPlace();

            if (!place.geometry) {
                window.alert("No details available for input: '" + place.name + "'");
                return;
            }

            // Center the map on the selected address
            map.setCenter(place.geometry.location);
            map.setZoom(16);
			
			// Highlight the corresponding location in the list
    var selectedLocation = document.querySelector(
      ".kinder-location[data-lat='" + lat + "'][data-lng='" + lng + "']"
    );
    if (selectedLocation) {
      // Remove the active class from all other locations
      var locations = document.querySelectorAll(".kinder-location");
      locations.forEach(function(location) {
        location.classList.remove("active");
      });

      // Add the active class to the selected location
      selectedLocation.classList.add("active");
    }

        }); 
		
		 // Click handler for list items
  var locationItems = document.querySelectorAll(".kinder-location");
  locationItems.forEach(function(item) {
    item.addEventListener("click", function() {
      var lat = parseFloat(this.dataset.lat);
      var lng = parseFloat(this.dataset.lng);

      map.setCenter({ lat: lat, lng: lng });
      map.setZoom(16);

      // Remove the active class from all other locations
      var locations = document.querySelectorAll(".kinder-location");
      locations.forEach(function(location) {
        location.classList.remove("active");
      });

      // Add the active class to the selected location
      this.classList.add("active");
    });
  });
		
	
    }
    </script>

<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBI6rIQzeTg4UxOJsrRg2KygemYaiNLERQ&libraries=places&callback=initMap"></script>

    <?php
    return ob_get_clean();
}
add_shortcode( 'show_kinder', 'show_kinder_on_map' );