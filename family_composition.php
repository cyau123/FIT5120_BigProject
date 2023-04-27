function family_composition_shortcode($atts) {
    ob_start(); // Start output buffering
    ?>
    <script type="text/javascript">
        function updateStatusOptions() {
            const familyCompositionSelect = document.getElementById("family-composition");
            const statusSelect = document.getElementById("status");
            const options = {
                "Couple Family with dependent children": ["Married"],
                "Couple only": ["Married", "De facto", "Pregnancy"],
                "Multiple family households": ["Married", "Pregnancy"],
                "One parent family": ["Single"],
                "Other one family households": ["Married", "Pregnancy"]
            };

            statusSelect.innerHTML = ""; // Clear options
			statusSelect.disabled = true;

            if (familyCompositionSelect.value) { // Enable the second dropdown if the first dropdown has a value
                statusSelect.disabled = false;
                options[familyCompositionSelect.value].forEach(function (optionValue) {
                    const option = document.createElement("option");
                    option.value = optionValue;
                    option.text = optionValue;
                    statusSelect.appendChild(option);
                });
            }
        }
		
		// Call updateStatusOptions once the page loads
        document.addEventListener("DOMContentLoaded", function() {
            updateStatusOptions();
        });

        function handleSubmit() {
            const statusSelect = document.getElementById("status");
            const variables = {
                "Strength": "Do a range of activities that incorporate fitness, strength, balance, and flexibility.",
            };

            if (statusSelect.value === "Pregnancy") {
				variables["Physical Activity"] = "Be active on most (preferably all) days, to weekly total of 2.5 to 5 hours of moderate activity or 1.25 to 2.5 hours of vigorous activity or an equivalent combination of both. Do pelvic floor exercises.";
                variables["Vegetables & legumes/beans"] = "5-6 servings";
                variables["Fruit"] = "2 servings";
                variables["Grain (cereal) foods, mostly wholegrain"] = "8.5-10 servings";
                variables["Lean meat and poultry, fish, eggs, nuts and seeds, and legumes/beans"] = "3.5 servings";
                variables["Milk, yoghurt, cheese and/or alternatives (mostly reduced fat)"] = "2.5 servings";
            } else {
				variables["Physical Activity"] = "Be active on most (preferably all) days, to weekly total of 2.5 to 5 hours of moderate activity or 1.25 to 2.5 hours of vigorous activity or an equivalent combination of both.";
                variables["Vegetables & legumes/beans"] = "5 servings";
                variables["Fruit"] = "2 servings";
                variables["Grain (cereal) foods, mostly wholegrain"] = "6 servings";
                variables["Lean meat and poultry, fish, eggs, nuts and seeds, and legumes/beans"] = "2.5 servings";
                variables["Milk, yoghurt, cheese and/or alternatives (mostly reduced fat)"] = "2.5 servings";
            }
			 // Save the results to localStorage
    localStorage.setItem("familyCompositionResults", JSON.stringify(variables));

    // Update the results in the Elementor widget
    if (typeof displayResults === "function") {
        displayResults();
    }
        }
    </script>
<div class="form-bg-container">
    <form onsubmit="event.preventDefault(); handleSubmit();" class="wp-activities-search-form">
		<div class="strategy-form-row">
		<div class="form-group col-md-4 ">
			<label for="family-composition" style="font-weight:bold;">Family Composition:</label>
			<select id="family-composition" onchange="updateStatusOptions()" class="form-control custom-select">
				<option value="">-- Select a family composition --</option>
				<option value="Couple Family with dependent children">Couple Family with dependent children</option>
				<option value="Couple only">Couple only</option>
				<option value="Multiple family households">Multiple family households</option>
				<option value="One parent family">One parent family</option>
				<option value="Other one family households">Other one family households</option>
			</select>
		</div>
		<div class="form-group col-md-4">
			<label for="status" style="font-weight:bold;">Status:</label>
			<select id="status" class="form-control custom-select"></select>
		</div>
		</div>
		<div class="buttons-row row">
  			<div class="form-group">
  				<button type="submit" class="btn btn-primary search-btn" value="submit">Search</button>
	  		</div>
		</div>
	</form>
</div>
	<?php
	$output = ob_get_clean(); // Get the buffered content
	return $output; // Return the content for the shortcode to display
	}
	add_shortcode('family_composition', 'family_composition_shortcode');
