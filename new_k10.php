function new_k10_shortcode() {
    // Prepare the K10 data
    $k10_questions = [
        "In the past 4 weeks, about how often did you feel tired out for no good reason?",
        "In the past 4 weeks, about how often did you feel nervous?",
        "In the past 4 weeks, about how often did you feel so nervous that nothing could calm you down?",
        "In the past 4 weeks, about how often did you feel hopeless?",
        "In the past 4 weeks, about how often did you feel restless or fidgety?",
        "In the past 4 weeks, about how often did you feel so restless you could not sit still?",
        "In the past 4 weeks, about how often did you feel depressed?",
        "In the past 4 weeks, about how often did you feel that everything was an effort?",
        "In the past 4 weeks, about how often did you feel so sad that nothing could cheer you up?",
        "In the past 4 weeks, about how often did you feel worthless?"
    ];

    $response_options = [
        1 => "None of the time",
        2 => "A little of the time",
        3 => "Some of the time",
        4 => "Most of the time",
        5 => "All of the time"
    ];

    // Generate the K10 HTML
    $output = '<form id="k10">';
	$output .= '
	<style>
		#k10 {
			  position: relative;
			  max-width: 100%;
			  min-height: 840px;
			  padding: 60px;
			  background-color: #E9F4F6;
			  box-shadow: 0px 1px 2px rgba(0,0,0,0.1);
			  border-radius: 5px;
			}
		.k10-header{
			padding: 20px 20px 0px 20px;
			margin-bottom: 50px;
			margin-top: 10px;
		}
		#intro-page {
		  text-align: center;
		  padding: 0px 20px 0px 20px;
		  margin-bottom: 0px;
		}
		.question {
			margin-bottom: 35px;
		}

		.hidden {
			display: none;
		}
		
		.scale-container {
			margin-bottom: 30px;
			position: relative;
		}

		.scale-label {
			font-size: 16px;
			white-space: nowrap;
			position: absolute;
			top: -25px;
		}

		.scale-label[data-value="1"] {
			left: 7.5%; /* Update this line */
			transform: translateX(-50%);
		}
		.scale-label[data-value="2"] {
			left: 28.75%; /* Update this line */
			transform: translateX(-50%);
		}
		.scale-label[data-value="3"] {
			left: 50%; /* Update this line */
			transform: translateX(-50%);
		}
		.scale-label[data-value="4"] {
			left: 71.25%; /* Update this line */
			transform: translateX(-50%);
		}
		.scale-label[data-value="5"] {
			left: 92.5%;
			transform: translateX(-50%);
		}

		input[type=range] {
			-webkit-appearance: none;
			width: 85%; 
			margin: 0 auto;
			margin: 0 auto;
			margin-top: 20px;
			margin-left: 7.5%;
			margin-right: 7.5%;
			height: 16px;
			border-radius: 5px;
			background: #E3E5E9;
			outline: none;
		}
		
		input[type=range]::-webkit-slider-thumb {
			-webkit-appearance: none;
			appearance: none;
			width: 24px;
			height: 24px;
			border-radius: 50%;
			border: 3px solid #5bc0de;
			background: #5bc0de;
			cursor: pointer;
			transition: background 0.15s ease-in-out;
		}

		input[type=range]::-webkit-slider-thumb:hover {
			background: #045CB4;
		}

		input[type=range]::-moz-range-thumb {
			width: 24px;
			height: 24px;
			border-radius: 50%;
			border: 3px solid #5bc0de;
			background: #5bc0de;
			cursor: pointer;
			transition: background 0.15s ease-in-out;
		}

		input[type=range]::-moz-range-thumb:hover {
			background: #045CB4;
		}

		button {
			background-color: #5bc0de;
			color: white;
			border: none;
			border-radius: 5px;
			font-size: 16px;
			cursor: pointer;
			transition: background-color 0.15s ease-in-out;
		}

		button:focus {
		  background-color: #5bc0de;
		  outline: none;
		}
		
		button:hover {
			background-color: #045CB4;
		}
		
		.bottom-container {
			position: absolute;
			bottom: 20px;
			left: 20px;
			right: 20px;
			display: flex;
			flex-direction: column;
		}
		.button-wrapper {
			display: flex;
			justify-content: space-between;
			align-items: center;
			width: 100%;
		}
	
		.button-group {
			display: flex;
        justify-content: space-between;
        align-items: center;
        width: 100%;
		}
		.button-right-wrapper {
			display: flex;
			justify-content: flex-end;
			width: 100%;
		}

		#k10-result {
		  margin-top: 20px;
		  margin-bottom: 20px;
		  text-align: center;
		}
		
		p, .entry-content p {
			margin: 0px 0px 50px;
		}
		
		.k10-result-container,
			.retake-button-container {
			  display: flex;
			  justify-content: center;
			  margin-top: 0px;
			  margin-bottom: 30px;
			}
		.progress-bar-wrapper {
		  width: 50%; /* Update this line */
		  position: relative;
		  margin: 20px auto;
		}

		.progress-bar-container {
		  width: 100%;
		  height: 8px;
		  background-color: #E3E5E9;
		  border-radius: 5px;
		  position: relative;
		}

		.progress-bar {
		  height: 8px;
		  background-color: #5bc0de;
		  border-radius: 5px;
		  position: absolute;
		  left: 0;
		  top: 0;
		}

		.progress-percentage {
		  position: absolute;
		  right: 0;
		  top: 8px;
		  font-size: 16px;
		  color: #333;
		}
		@keyframes fadeIn {
			  0% {
				opacity: 0;
			  }
			  100% {
				opacity: 1;
			  }
			}

			.fade-in {
			  animation-name: fadeIn;
			  animation-duration: 2s;
			  animation-fill-mode: both;
			}
		.slide-up {
		  animation-name: slide-up;
		  animation-duration: 1s;
		  animation-timing-function: ease-out;
		  animation-fill-mode: forwards;
		}

		@keyframes slide-up {
		  from {
			transform: translateY(100%);
		  }
		  to {
			transform: translateY(0%);
		  }
		}
		.meter-container {
			display: flex;
			justify-content: center;
			align-items: center;
			width: 100%;
		}
		.entry-content ul{
   list-style-type: none;
}
  .centered-content {
    display: flex;
    flex-direction: column;
    align-items: center;
	text-align: center;
  }
.element {
  padding: 10px;
  background-color: white;
  border-radius: 0px 0px 5px 5px;
  box-shadow: 0px 1px 2px rgba(0,0,0,0.1);
}

.element:first-child {
  background-color: #5bc0de;
  color: white;
  border-radius: 5px 5px 0px 0px;
}
.low {
    background-color: #fff;
    border: solid green;
    border-width: 1.5px 1.5px 1.5px 7px;
    padding: 10px;
    margin-bottom: 20px;
    border-radius: 5px;
}
.high {
    background-color: #fff;
    border: solid orange;
    border-width: 1.5px 1.5px 1.5px 7px;
    padding: 10px;
    margin-bottom: 20px;
    border-radius: 5px;
}
.veryhigh {
    background-color: #fff;
    border: solid red;
    border-width: 1.5px 1.5px 1.5px 7px;
    padding: 10px;
    margin-bottom: 20px;
    border-radius: 5px;
}

	</style>';
		
	// Introduction page
	
    $output .= '<div id="intro-page" class="question slide-up">';
	 $output .= '<h2 style="margin-bottom:40px;">Welcome to the Mental Health Test</h2>';
	$output .= '<div class="container">
				 <div class="row">
					<div class="col-sm">
					<div class="element"> </div>
					<div class="element">
					<img src="https://img.icons8.com/ios/50/null/checked--v1.png" style="margin-bottom:30px;"/>
					  <p style="margin-bottom:30px;">This test consists of 10 questions. By answering these questions honestly, you will get a score that can help you identify if you are experiencing low, high, or very high levels of psychological distress.</p></div>
					</div>
					<div class="col-sm">
					<div class="element"> </div>
					<div class="element">
					<img src="https://img.icons8.com/ios/50/null/light-on--v1.png" style="margin-bottom:30px;"/>
					  <p style="margin-bottom:30px;">It is important to remember that this test is not a substitute for professional advice or diagnosis. However, it can be a helpful starting point for addressing any mental health concerns you may have.</p></div>
					</div>
					<div class="col-sm">
					<div class="element"> </div>
					<div class="element">
					<img src="https://img.icons8.com/ios/50/null/pencil--v1.png" style="margin-bottom:30px;"/>
					  <p style="margin-bottom:30px;">We encourage you to take this test in a quiet and comfortable place. Take your time to answer each question thoughtfully. Remember, there are no right or wrong answers, and your responses will be kept confidential.</p></div>
					  </div>
					</div>
				</div>';
	$output .= '<div class="k10-header fade-in">';
    $output .= '<img src="https://images.pexels.com/photos/5668869/pexels-photo-5668869.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=2" style="max-height: 400px; width: auto;" overflow: hidden;>';
    $output .= '</div>';
    $output .= '<button type="button" id="start-test" onclick="startTest()">Start Test</button>';
    $output .= '</div>';
	
	foreach ($k10_questions as $index => $question) {
		$output .= '<div class="question hidden slide-up" style="padding: 0px 50px 0px 50px;">';
		$output .= '<p><b>' . ($index + 1) . '. ' . $question . '</b></p>';
		$output .= '<div class="scale-container">'; // Add the scale-container div

		$output .= '<div class="scale-labels">';
		foreach ($response_options as $value => $label) {
			$output .= '<span class="scale-label" data-value="' . $value . '">' . $label . '</span>';
		}
		$output .= '</div>';

		$output .= '<input type="range" name="question-' . ($index + 1) . '" min="1" max="5" step="1" value="3">';

		$output .= '</div>'; // Close the scale-container div

		$output .= '</div>';
	}
	
  	$output .= '
				<div class="bottom-container">
                <div class="progress-bar-wrapper" id="progress-bar-wrapper">
                    <div class="progress-bar-container">
                        <div class="progress-bar"></div>
                    </div>
                    <div class="progress-percentage"></div>
                </div>
                <div class="button-wrapper">
        <div class="button-group">
            <button type="button" id="prev-button" class="hidden" onclick="prevPage()">Previous</button>
        </div>
        <div class="button-right-wrapper">
            <button type="button" id="next-button" class="hidden" onclick="nextPage()">Next</button>
            <button type="button" id="submit-button" class="hidden" onclick="submitK10()">Submit</button>
        </div>
    </div>
            </div>';
	
	$output .= '	<div class="k10-result-container">
  						<div id="k10-result"></div>
    				</div>
					<div class="meter-container">
						<div id="k10-meter" class="hidden">
							<div class="chartBox">
								<canvas id="myChart"></canvas>
							  </div>
						</div>
					</div>					
					<div class="k10-recommendation-container hidden" id="k10-recommendation-container" style="padding:50px;">
  						<div id="k10-recommendation">
						<p style="margin-bottom:30px;"><b>Based on the total score obtained, the level of psychological distress into 3 groups:</b></p>
					<div class="low">
					<b>Low (10-24):</b> Individuals in this category have a <b>low</b> level of psychological distress. Generally, they may not require any professional intervention for mental health issues. However, it is still essential to maintain good mental health practices such as self-care, regular exercise, healthy diet, and social connections to continue feeling well.
					</div>
					<div class="high">
					<b>High (25-29):</b> A <b>high</b> level of psychological distress may indicate more severe symptoms of anxiety or depression. People in this category should consider seeking support from friends, family, or mental health professionals. They may also benefit from exploring community resources, support groups, and self-help materials. Professional help, such as therapy or counseling, can be particularly beneficial for this group.
					</div>
					<div class="veryhigh">
					<b>Very High (30-50):</b> Individuals with <b>very high</b> psychological distress are likely experiencing significant mental health challenges. It is crucial for them to seek professional help immediately, as they may be at risk for serious mental health conditions such as major depressive disorder, generalized anxiety disorder, or other related issues. Accessing appropriate support, treatment, and resources can make a significant difference in their mental health journey.
					</div>
					<p style="margin-bottom:25px;"><b>We recommend looking into different resources to improve your mental health and well-being. Please <a href="https://financialguidevic.link/mental-health/mental-health-self-test/#mental-health-resources">click here</a> to access a range of helpful information.</b></p>
					</div>
				  </div>
    				<div class="retake-button-container">
  						<button type="button" id="retake-button" class="hidden fade-in" onclick="retakeTest()">Retake the test</button>
    				</div>';

    // Generate the K10 JavaScript

	$output .= '

	<script>
	var introPage = true;
	var currentPage = 0;
	var questionsPerPage = [3,3,4];
	var totalQuestions = 10;
	
	function startTest() {
        document.getElementById("intro-page").classList.add("hidden");
		introPage = false;
		showPage(0);
		document.getElementById("prev-button").classList.add("hidden");
		}
	
	function updateProgressBar() {
			var totalPages = questionsPerPage.length;
			var completedQuestions = questionsPerPage[0];

			for (var i = 0; i < currentPage; i++) {
				completedQuestions += questionsPerPage[i+1];
			}
									
			var progressPercentage = (completedQuestions / totalQuestions) * 100;

			var progressBar = document.querySelector(".progress-bar");
			var progressText = document.querySelector(".progress-percentage");

			progressBar.style.width = progressPercentage + "%";
			progressText.innerHTML = Math.round(progressPercentage) + "%";
		}



	function showPage(page) {
        if (!introPage) {
            var allQuestions = document.querySelectorAll(".question:not(#intro-page)");
            var startIndex = 0;

            for (var i = 0; i < page; i++) {
                startIndex += questionsPerPage[i];
            }

            var endIndex = startIndex + questionsPerPage[page];

            for (var i = 0; i < totalQuestions; i++) {
                if (i >= startIndex && i < endIndex) {
                    allQuestions[i].classList.remove("hidden");
                } else {
                    allQuestions[i].classList.add("hidden");
                }
            }

            currentPage = page;

            document.getElementById("prev-button").classList.toggle("hidden", page === 0);
            document.getElementById("next-button").classList.toggle("hidden", page === questionsPerPage.length - 1);
            document.getElementById("submit-button").classList.toggle("hidden", page !== questionsPerPage.length - 1);
			document.getElementById("progress-bar-wrapper").classList.remove("hidden");
            updateProgressBar();
        }
		if (introPage) {
        document.getElementById("progress-bar-wrapper").classList.add("hidden");
        document.getElementById("next-button").classList.add("hidden");
        document.getElementById("prev-button").classList.add("hidden");
        return;
    	}
    }

	function prevPage() {
		if (currentPage > 0) {
			showPage(currentPage - 1);
		}
	}

	function nextPage() {
		if (currentPage < questionsPerPage.length - 1) {
			showPage(currentPage + 1);
		} 
	}
		
	function retakeTest() {
		document.querySelectorAll("input[type=range]").forEach(function (input) {
			input.value = "3";
		});
		document.getElementById("k10-result").innerHTML = "";

		updateProgressBar();
		showPage(0);

		if (document.getElementById("prev-button").classList.contains("hidden")) {
			document.getElementById("prev-button").classList.remove("hidden");
		}

		if (currentPage === 0 && !document.getElementById("prev-button").classList.contains("hidden")) {
			document.getElementById("prev-button").classList.add("hidden");
		}

		if (document.getElementById("next-button").classList.contains("hidden")) {
			document.getElementById("next-button").classList.remove("hidden");
		}
		
		document.getElementById("k10-meter").classList.add("hidden");
		document.getElementById("k10-recommendation-container").classList.add("hidden");
		document.getElementById("retake-button").classList.add("hidden");
	}
	
	function submitK10() {
    var score = 0;
	var level = "";

    for (var i = 1; i <= totalQuestions; i++) {
        var userAnswer = document.querySelector(\'input[name="question-\' + i + \'"]\').value;
        if (userAnswer) {
            score += parseInt(userAnswer);
        }
    }

    // Hide all questions
    document.querySelectorAll(".question").forEach(function (question) {
        question.classList.add("hidden");
    });
	
	document.getElementById("prev-button").classList.add("hidden");
    document.getElementById("next-button").classList.add("hidden");
    document.getElementById("submit-button").classList.add("hidden");
	document.getElementById("retake-button").classList.remove("hidden");
	if (score < 25){
		level = "Low";
	}
	else if ((score >= 25) && (score <= 29)){
		level = "High";
	}
	else{
		level = "Very High";
	}
	
	localStorage.setItem("score", score);
	initializeChart();
	document.getElementById("mental-health-resources").classList.remove("hidden");
	var k10Result = document.getElementById("k10-result");
    k10Result.innerHTML = "<h2>Thank you for completing the test</h2>" + "Your score is: <b>" + score + "</b><br>" + "Your level of psychological distress is: <b>" + level + "</b>";
	var k10Recommendation = document.getElementById("k10-recommendation");
	

	document.getElementById("k10-meter").classList.remove("hidden");
	document.getElementById("k10-recommendation-container").classList.remove("hidden");
	k10Result.classList.add("fade-in");
	k10Recommendation.classList.add("fade-in");
	document.getElementById("k10-meter").classList.add("fade-in");
	var progressBar = document.querySelector(".progress-bar");
    var progressText = document.querySelector(".progress-percentage");
    progressBar.style.width = "100%";
    progressText.innerHTML = "100%";
}

	window.onload = function() {
        showPage(-1);
    };
	</script><script type="text/javascript" src="https://cdn.jsdelivr.net/npm/chart.js/dist/chart.umd.min.js"></script>
	';

    return $output;
}

add_shortcode('new_k10', 'new_k10_shortcode');
