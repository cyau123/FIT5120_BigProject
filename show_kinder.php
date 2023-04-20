function show_kinder_on_map( $atts ) {
	global $wpdb;
    $kinder_locations = $wpdb->get_results( "SELECT * FROM wp_kinders WHERE address != ''" );

    ob_start();
    ?>
    <style>
		.kinder-container {
        	display: flex;
        	flex-direction: column;
    	}
	    ul {
	      list-style: none;
	      padding: 0;
	      margin: 0;
	    }
	    .kinder-box {
            background-color: #E3E5E7;
            border: 1px solid #ddd;
            border-radius: 5px;
            margin-bottom: 10px;
            padding: 10px;
            box-shadow: 0px 1px 2px rgba(0,0,0,0.1); 
        }
		.kinder-box:hover {
            background-color: #C5E2FF;
        }
	    .kinder-box.active {
            background-color: #C5E2FF;
        }
	</style>
	<div style="display:flex;">
		<div style="flex-basis:70%; margin-right:15px;">
        	<div id="map"></div>
        </div>
        <div style="flex-basis:30%;">
			<div id="trip-info" style="margin-bottom:15px; background-color: #E9F4F6; padding:15px; border-radius: 5px; box-shadow: 0px 1px 2px rgba(0,0,0,0.1); ">
            	<h3>Get directions</h3>
    			<p><b>Starting point:</b></p>
				<input id="search-input" class="controls" type="text" placeholder="Please enter your address">
    			<p><b>Destination:</b></p>
				<input id="selected-kinder" class="controls" type="text" placeholder="Please select a Kinder on map or from the list" readonly style="background-color: #eee;">
    			<button id="search-route-btn">Search Route</button>
			</div>
			<div class="kinder-container" style="background-color: #E9F4F6; padding:15px; border-radius: 5px; box-shadow: 0px 1px 2px rgba(0,0,0,0.1); ">
				<h3 class="kinder-title">Kinder locations</h3>
            	<ul id="kinder-list">
                	<?php foreach ( $kinder_locations as $i => $location ) : ?>
                    	<div class="kinder-box">
                        	<li class="kinder-location" data-lat="<?php echo $location->latitude; ?>" data-lng="<?php echo $location->longitude; ?>">
                            	<h5><?php echo addslashes($location->name); ?></h5>
                            	<p style="font-size:16px;"><b>Address:</b> <?php echo addslashes($location->address); ?></p>
                            	<p style="font-size:16px;"><b>Phone:</b> <?php echo addslashes($location->phone); ?></p>
                            	<p style="font-size:16px;"><b>Email:</b> <a href="mailto:<?php echo addslashes($location->email); ?>" onclick="event.stopPropagation();"><?php echo addslashes($location->email); ?></a></p>
                        	</li>
                    	</div>
                	<?php endforeach; ?>
            	</ul>
        	</div>
		</div>
  	</div>
    
    <script>
    function initMap() {
        var melbourne = { lat: -37.8136, lng: 144.9631 };
        var map = new google.maps.Map(document.getElementById('map'), {
            zoom: 15,
            center: melbourne
        });
		
		// Create a DirectionsService and DirectionsRenderer instance
        var directionsService = new google.maps.DirectionsService();
    	var directionsRenderer = new google.maps.DirectionsRenderer({ suppressMarkers: true });
    	directionsRenderer.setMap(map);
		
		// Create a marker for the user's address and initialize it with a null position
    	var userMarker = new google.maps.Marker({
        	position: null,
        	map: map,
        	icon: {
            	url: "https://img.icons8.com/dusk/64/null/order-delivered.png"
        	}
   		});
		var selectedDestination = null;

        var infowindows = [];
		var markers = [];

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
		
		    markers.push(marker);
		
		 // Create a closure function to capture the current marker and infowindow objects
            (function (marker, infowindow, index, lat, lng) {
                marker.addListener('click', function () {
					
                    // Close all other InfoWindows
                    infowindows.forEach(function (infoWindow) {
                        infoWindow.close();
                    });
                    infowindow.open(map, marker);

                    // Remove the active class from all other locations
                    var locations = document.querySelectorAll(".kinder-box");
                    locations.forEach(function (location) {
                        location.classList.remove("active");
                    });

                    // Find the related .kinder-box element and add the "active" class to it
                    var selectedBox = document.querySelector(".kinder-location[data-lat='" + lat + "'][data-lng='" + lng + "']");
                    selectedBox.parentElement.classList.add("active");
		
		            // Scroll the list to make the selected item visible
                    selectedBox.scrollIntoView({ behavior: 'smooth', block: 'center' });
					
					selectedDestination = { lat: lat, lng: lng };
					
					var kinderName = '<?php echo addslashes($location->name); ?>';
					document.getElementById('selected-kinder').value = kinderName;
				});
			})(marker, infowindows[<?php echo $i ?>], <?php echo $i ?>, <?php echo $location->latitude; ?>, <?php echo $location->longitude; ?>);

			<?php endforeach; ?>

			// Autocomplete address search
        
        	var searchInput = document.getElementById('search-input');
        	var autocomplete = new google.maps.places.Autocomplete(searchInput);
			autocomplete.setComponentRestrictions({country: "au"});

        	autocomplete.addListener('place_changed', function() {
            	var place = autocomplete.getPlace();
				if (!place.geometry) {
                	window.alert("No details available for input: '" + place.name + "'");
                	return;
            	}
				// Center the map on the selected address
            	map.setCenter(place.geometry.location);
            	map.setZoom(16);
				userMarker.setPosition(place.geometry.location);
			});
					
			// Click handler for list items
        	var locationItems = document.querySelectorAll(".kinder-location");
        	locationItems.forEach(function(item, index) {
            	item.addEventListener("click", function() {
                	var lat = parseFloat(this.dataset.lat);
                	var lng = parseFloat(this.dataset.lng);
                	map.setCenter({ lat: lat, lng: lng });
                	map.setZoom(16);

              		// Remove the active class from all other locations
               		var locations = document.querySelectorAll(".kinder-location");
              		locations.forEach(function(location) {
                   		location.parentElement.classList.remove("active");
               		});
               		// Add the active class to the selected location
               		this.parentElement.classList.add("active");
		       		// Close all other InfoWindows
               		infowindows.forEach(function (infoWindow) {
                   		infoWindow.close();
               		});
               		// Open the InfoWindow for the selected location
               		infowindows[index].open(map, markers[index]);
					selectedDestination = { lat: lat, lng: lng };
				
					var kinderName = this.querySelector('h5').textContent;
					document.getElementById('selected-kinder').value = kinderName;
				});
			});
		
			function calculateAndDisplayRoute(directionsService, directionsRenderer, origin, destination) {
            	var request = {
            		origin: origin,
            		destination: destination,
            		travelMode: 'DRIVING'
        		};

        		directionsService.route(request, function (response, status) {
            		if (status === 'OK') {
               			directionsRenderer.setDirections(response);
            			var route = response.routes[0].legs[0];
            			var directionsPanel = document.createElement('div');
            			directionsPanel.innerHTML =  '<p><b>Driving distance:</b> ' + route.distance.text + '</p>' +
                                         '<p><b>Driving time:</b> ' + route.duration.text + '</p>';
            
            			var tripInfo = document.getElementById('trip-info');
           				// Remove existing route information, if any
            			var existingRouteInfo = tripInfo.querySelector('.route-info');
            			if (existingRouteInfo) {
                			tripInfo.removeChild(existingRouteInfo);
            			}
            
            			directionsPanel.classList.add('route-info');
            			tripInfo.appendChild(directionsPanel);
               
            		} else {
                		window.alert('Directions request failed due to ' + status);
            		}
        		});
			}
		
			document.getElementById('search-route-btn').addEventListener('click', function() {
				var origin = searchInput.value;
				
				if (!origin) {
       				window.alert('Please enter your address.');
        			return;
    			}
				if (!selectedDestination) {
        			window.alert('Please select a Kinder on map or from the list.');
        			return;
    			}

   				calculateAndDisplayRoute(directionsService, directionsRenderer, origin, selectedDestination);
			});
	}
	</script>
	<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBI6rIQzeTg4UxOJsrRg2KygemYaiNLERQ&libraries=places&callback=initMap"></script>
    <?php return ob_get_clean();
}
add_shortcode( 'show_kinder', 'show_kinder_on_map' );