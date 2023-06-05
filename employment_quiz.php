function include_chartjs() {
    wp_enqueue_script('chartjs', 'https://cdn.jsdelivr.net/npm/chart.js', [], null, true);
}
add_action('wp_enqueue_scripts', 'include_chartjs');

function employment_quiz_shortcode() {
	$output = '
	<style>
		#quiz-intro {
			  position: relative;
			  max-width: 100%;
			  min-height: 840px;
			  padding: 60px;
			  box-shadow: 0px 1px 2px rgba(0,0,0,0.1);
			  border-radius: 5px;
			  background-color: #E9F4F6;
			}
		#intro-page-em {
		  text-align: center;
		  padding: 0px 20px 0px 20px;
		  margin-bottom: 0px;
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
.em-intro-photo{
			padding: 20px 20px 0px 20px;
			margin-bottom: 50px;
			margin-top: 10px;
		}
#question1, #question2, #question3, #question4, #result{
	min-height: 640px;
			  padding: 60px;
			  box-shadow: 2px 0 2px rgba(0, 0, 0, 0.1), -2px 0 2px rgba(0, 0, 0, 0.1), 0 2px 2px rgba(0, 0, 0, 0.1);
			  border-radius: 5px;
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
		@keyframes slide-left {
  0% {
    transform: translateX(100%);
    opacity: 0;
  }
  100% {
    transform: translateX(0);
    opacity: 1;
  }
}

@keyframes slide-right {
  0% {
    transform: translateX(-100%);
    opacity: 0;
  }
  100% {
    transform: translateX(0);
    opacity: 1;
  }
}
.slide-left {
  animation-name: slide-left;
  animation-duration: 1s; /* Adjust the duration as needed */
  animation-fill-mode: both;
}

.slide-right {
  animation-name: slide-right;
  animation-duration: 1s; /* Adjust the duration as needed */
  animation-fill-mode: both;
}
  .rating-list {
    list-style: none;
    padding: 0;
  }

  .rating-item {
    display: flex;
    align-items: center;
    margin-bottom: 10px;
  }

  .rating-rectangle {
    width: 20px;
    height: 20px;
    margin-right: 10px;
  }

  .decline {
    background-color: #FF3131;
  }

  .stable {
    background-color: #FFDE59;
  }

  .moderate {
    background-color: #C1FF72;
  }

  .strong {
    background-color: #7ED957;
  }

  .very-strong {
    background-color: #00BF63;
  }

	</style>';
  $output .= '<div id="quiz-intro" class="slide-up">';
	$output .= '<div id="intro-page-em">';
$output .= '<h2 style="margin-bottom:40px;">Welcome to the Victoria Job Qualification Assessment</h2>';
	
	$output .= '<div class="container">
				 <div class="row">
					<div class="col-sm">
					<div class="element"> </div>
					<div class="element">
					<img src="https://img.icons8.com/ios/50/null/checked--v1.png" style="margin-bottom:30px;"/>
					  <p style="margin-bottom:30px;">This test consists of 4 questions. By answering these questions honestly, you will get insights into whether your qualifications meet the requirements for your desired job in Victoria.</p></div>
					</div>
					<div class="col-sm">
					<div class="element"> </div>
					<div class="element">
					<img src="https://img.icons8.com/ios/50/null/light-on--v1.png" style="margin-bottom:30px;"/>
					  <p style="margin-bottom:30px;">It is important to remember that this test is not a substitute for professional advice. It is recommended to seek professional guidance before making any career-related decisions.</p></div>
					</div>
					<div class="col-sm">
					<div class="element"> </div>
					<div class="element">
					<img src="https://img.icons8.com/ios/50/null/pencil--v1.png" style="margin-bottom:30px;"/>
					  <p style="margin-bottom:30px;">The quiz will also present informative insights, including distribution of gender, employment types, current and future employment levels for your desired job position.</p></div>
					  </div>
					</div>
				</div>';
	$output .= '<div class="em-intro-photo">';
    $output .= '<img src="https://cdn.pixabay.com/photo/2018/11/02/10/51/job-3790033_960_720.jpg" style="max-height: 400px; width: auto; overflow: hidden;">';
    $output .= '</div>';
	
  $output .= '<button id="start-quiz-button" style="margin: 0 auto; display: block;">Start Quiz</button>';
  $output .= '</div>';
  $output .= '</div>';

$output .= '<div id="quiz-header" style="display: none;">';
$output .= ' <h2 class="qualification-assessment">Qualification Assessment</h2>';
$output .= '<div class="q-progress-bar-container">';

$output .= '<div class="q-label-container">';
$output .= '<span class="q-label" id="q-Q1">Question 1</span>';
$output .= '<span class="q-label" id="q-Q2">Question 2</span>';
$output .= ' <span class="q-label" id="q-Q3">Question 3</span>';
$output .= '<span class="q-label" id="q-Q4">Question 4</span>';
	$output .= '<span class="q-label" id="q-Q5">Results</span>';
$output .= '</div>';
	$output .= '<div id="q-progress-bar">';
$output .= ' <span id="q-progress"></span>';
$output .= '</div>';
$output .= '</div>';
$output .= '</div>';
	
$output .= '<div id="question1" style="display: none; padding: 40px;">';
$output .= '<div class="row">';
$output .= '<div class="col-sm slide-right">';
$output .= '<h4>1. Which industry do you want to work in?</h4>';
$output .= '<input type="radio" id="industry1" name="industry" class="radio-button" value="administrative">';
$output .= '<label for="industry1" class="mc-label">Administrative and Support Service</label><br>';
$output .= '<input type="radio" id="industry2" name="industry" class="radio-button" value="education">';
$output .= '<label for="industry2" class="mc-label">Education</label><br>';
$output .= '<input type="radio" id="industry3" name="industry" class="radio-button" value="healthcare">';
$output .= '<label for="industry3" class="mc-label">Health Care and Social Assistance</label><br>';
$output .= '<p id="alert-message1" style="color: red; display: none; margin-top: 15px;  margin-left: 30px;"></p>';
$output .= '</div>';
$output .= '<div class="col-sm slide-left">';
$output .= '<img src="https://cdn.pixabay.com/photo/2015/01/09/11/08/startup-594090_1280.jpg" style="max-height: 400px; width: auto; overflow: hidden;">';
$output .= '</div>';
$output .= '</div>';
$output .= '<div class="q-button-container">';
$output .= '<button id="next-button" class="next-button-right">Next</button>';
$output .= '</div>';
$output .= '</div>';


  $output .= '<div id="question2" style="display: none; padding: 40px;">';
	$output .= '<div class="row">';
$output .= '<div class="col-sm slide-right">';
	
  $output .= '<h4>2. Which job position are you interested in?</h4>';
  $output .= '<input type="text" id="occupation-input" name="occupation" list="occupation-list" style="width:500px;  margin-left: 30px;" placeholder="Please enter a job position or select from the list">';
  $output .= '<datalist id="occupation-list">';
  // options will be added dynamically by JavaScript
  $output .= '</datalist>';
	$output .= '<p id="alert-message2" style="color: red; display: none; margin-top: 15px;  margin-left: 30px;"></p>';
	$output .= '</div>';
$output .= '<div class="col-sm slide-left">';
$output .= '<img src="https://cdn.pixabay.com/photo/2021/02/03/00/10/receptionists-5975962_1280.jpg" style="max-height: 400px; width: auto; overflow: hidden;">';
$output .= '</div>';
$output .= '</div>';
	
	$output .= '<div class="q-button-container">';
	 $output .= '<button id="previous-button2" class="previous-button-left">Previous</button>';
	 $output .= '<button id="next-button2" class="next-button-right">Next</button>';
  $output .= '</div>';
	  $output .= '</div>';
	

	$output .= '<div id="question3" style="display: none; padding: 40px;">';
		$output .= '<div class="row">';
$output .= '<div class="col-sm slide-right">';
	
	$output .= '<h4>3. What is the highest level of education you have completed?</h4>';
	$output .= '<input type="radio" id="education1" name="education" class="radio-button" value="Post Grad/Grad Dip or Grad Cert">';
	$output .= '<label for="education1" class="mc-label">Post Grad/Grad Dip or Grad Cert</label><br>';
	$output .= '<input type="radio" id="education2" name="education" class="radio-button" value="Bachelor degree">';
	$output .= '<label for="education2" class="mc-label">Bachelor Degree</label><br>';
	$output .= '<input type="radio" id="education3" name="education" class="radio-button" value="Advanced Diploma/Diploma">';
	$output .= '<label for="education3" class="mc-label">Advanced Diploma/Diploma</label><br>';
	$output .= '<input type="radio" id="education4" name="education" class="radio-button" value="Certificate III/IV">';
	$output .= '<label for="education4" class="mc-label">Certificate III/IV</label><br>';
	$output .= '<input type="radio" id="education5" name="education" class="radio-button" value="High school">';
	$output .= '<label for="education5" class="mc-label">High School</label><br>';
	$output .= '<p id="alert-message3" style="color: red; display: none; margin-top: 15px;  margin-left: 30px;"></p>';
		$output .= '</div>';
$output .= '<div class="col-sm slide-left">';
$output .= '<img src="https://cdn.pixabay.com/photo/2014/10/14/20/14/library-488690_1280.jpg" style="max-height: 400px; width: auto; overflow: hidden;">';
$output .= '</div>';
$output .= '</div>';
	
	$output .= '<div class="q-button-container">';
	$output .= '<button id="previous-button3" class="previous-button-left">Previous</button>';
	$output .= '<button id="next-button3" class="next-button-right">Next</button>';
	$output .= '</div>';
	$output .= '</div>';
	
	$output .= '<div id="question4" style="display: none; padding: 40px;">';
		$output .= '<div class="row">';
$output .= '<div class="col-sm slide-right">';
$output .= '<h4>4. How many years of relevant work experience do you have?</h4>';
$output .= '<select id="experience-input" style="width:100px;  margin-left: 30px;" name="experience">';
for ($i=0; $i<=30; $i++) {
    $output .= '<option value="'.$i.'">'.$i.'</option>';
}
$output .= '</select>';
		$output .= '</div>';
$output .= '<div class="col-sm slide-left">';
$output .= '<img src="https://cdn.pixabay.com/photo/2019/04/16/11/15/job-4131482_1280.jpg" style="max-height: 400px; width: auto; overflow: hidden;">';
$output .= '</div>';
$output .= '</div>';
		$output .= '<div class="q-button-container">';
$output .= '<button id="previous-button4" class="previous-button-left">Previous</button>';
$output .= '<button id="next-button4" class="next-button-right">Next</button>';
$output .= '</div>';
	$output .= '</div>';
	
	$output .= '<div id="result" style="display: none; padding: 40px;">';
		$output .= '<h2>Results</h2>';
				$output .= '<div class="results-container fade-in" style="margin-left: 30px; margin-right: 30px;">';
						$output .= '<div class="message-container" style="background-color: #fff; border: solid #046BD2; border-width: 1.5px 1.5px 1.5px 7px; padding: 15px; margin-top: 40px; margin-bottom: 40px; border-radius: 5px;">';
							$output .= '<p id="result-message"></p>';
							$output .= '<p id="additional-message"></p>';
							$output .= '<p id="seek-link"></p>';
						$output .= '</div>';
				$output .= '<h4 id="insight-title"></h4>';
				$output .= '<div class="chart-background" style="margin-top: 40px; padding: 15px; border-radius: 5px; border: solid #5bc0de; width: 900px;">';
						$output .= '<div class="qualification-chart-container">';
					$output .= '<canvas id="qualification-chart"></canvas></div>';
				$output .= '</div>';
				$output .= '<div class="row-container" style="display: flex; margin-top: 40px;">';
					$output .= '<div class="chart-background" style="padding: 15px; border-radius: 5px; border: solid #5bc0de;">';
						$output .= '<div class="gender-chart-container">';
							$output .= '<canvas id="gender-chart"></canvas></div>';
					$output .= '</div>';
					$output .= '<div class="chart-background" style="margin-left: 30px; padding: 15px; border-radius: 5px; border: solid #5bc0de;">';
						$output .= '<div class="employment-chart-container">';
							$output .= '<canvas id="employment-chart"></canvas></div>';
				$output .= '</div></div>';
	$output .= '<div class="description-container" style="background-color: #fff; border: solid #046BD2; border-width: 1.5px 1.5px 1.5px 7px; padding: 15px; margin-top: 40px; margin-bottom: 40px; border-radius: 5px;">';
							$output .= '<p id="description"></p>';
						$output .= '</div>';
				$output .= '<h4 id="trend-title" style="margin-top:40px;"></h4>';
				$output .= '<div class="chart-background" style="margin-top: 40px; padding: 15px; border-radius: 5px; border: solid #5bc0de; width: 900px;">';
						$output .= '<div class="line-chart-container">';
						$output .= '<canvas id="line-chart"></canvas></div>';
				$output .= '</div>';

				$output .= '<div class="trend-text-container" style="background-color: #fff; border: solid #046BD2; border-width: 1.5px 1.5px 1.5px 7px; padding: 15px; margin-top: 40px; margin-bottom: 40px; border-radius: 5px;">';
						$output .= '<p id="trend-text"></p>';
	$output .= '<ul class="rating-list">';
$output .= '  <li class="rating-item">';
$output .= '    <div class="rating-rectangle decline"></div>';
$output .= '    <span>Decline: Less than -3%</span>';
$output .= '  </li>';
$output .= '  <li class="rating-item">';
$output .= '    <div class="rating-rectangle stable"></div>';
$output .= '    <span>Stable: -3% to 2.9%</span>';
$output .= '  </li>';
$output .= '  <li class="rating-item">';
$output .= '    <div class="rating-rectangle moderate"></div>';
$output .= '    <span>Moderate: 3% to 7.9%</span>';
$output .= '  </li>';
$output .= '  <li class="rating-item">';
$output .= '    <div class="rating-rectangle strong"></div>';
$output .= '    <span>Strong: 8% to 14.9%</span>';
$output .= '  </li>';
$output .= '  <li class="rating-item">';
$output .= '    <div class="rating-rectangle very-strong"></div>';
$output .= '    <span>Very Strong: 15% and over</span>';
$output .= '  </li>';
$output .= '</ul>';
$output .= '</div>';
$output .= '<div style="padding:15px;">';
		$output .= '<h4>Disclaimer</h4><p>It is important to remember that this test is not a substitute for professional advice or diagnosis. While it can be a helpful starting point for assessing your qualifications for a desired job in Victoria, it is recommended to seek professional guidance and conduct further research before making any career-related decisions. Additionally, please note that we do not collect any personal data from participants during this test.</p>';
	$output .= '</div>';
	$output .= '<div class="retake-button-container">';
    $output .= '<button id="retake-button" style="margin-bottom:20px;">Retake the quiz</button>';
$output .= '</div>';
				$output .= '</div>';
	$output .= '</div>';

	
   $output .= '<script>';
	$output .= 'var selectedIndustry;';
	$output .= 'var qualificationChart;';
	$output .= 'var genderChart;';
	$output .= 'var employmentChart;';
	$output .= 'var lineChart;';

  $output .= 'jQuery(document).ready(function($) {';
		$output .= 'function resetFormFields() {';
$output .= '  $("input[type=radio]").prop("checked", false);';
$output .= '  $("#occupation-input").val("");';
$output .= '  $("input[type=radio][name=education]").prop("checked", false);';
$output .= '  $("#experience-input").val("0");';
$output .= '}';
	$output .= '	function updateProgressBar(questionNumber) {';
$output .= '  $("#q-progress").css("width", (questionNumber) * 20 + "%");';
$output .= '  $("#q-Q1, #q-Q2, #q-Q3, #q-Q4, #q-Q5").css("color", "#a09d9d");';
$output .= '  $("#q-Q" + questionNumber).css("color", "black");';
$output .= '}';
	
	
  $output .= '$("#start-quiz-button").click(function() {';
  $output .= '$("#quiz-intro").hide();';
	 $output .= '$("#quiz-header").show();';
	 $output .= 'updateProgressBar(1);';
  $output .= '$("#question1").show();';
  $output .= '});';

  $output .= '$("#next-button").click(function() {';
	 $output .= 'if ($("input[name=\'industry\']:checked").length > 0) {';
	
  $output .= '  selectedIndustry = $("input[name=\'industry\']:checked").val();';
  $output .= '  $.ajax({';
  $output .= '    type: "POST",';
  $output .= '    url: "/wp-admin/admin-ajax.php",';
  $output .= '    data: {';
  $output .= '      action: "fetch_job_positions",';
  $output .= '      industry: selectedIndustry';
  $output .= '    },';
  $output .= '    success: function(data) {';
  $output .= '      var response = JSON.parse(data);';

  $output .= '      $("#occupation-list").empty();';
  $output .= '      $.each(response, function(index, position) {';
  $output .= '        $("#occupation-list").append(\'<option value="\' + position.occupation + \'">\');';
  $output .= '      });';
  
  $output .= '      $("#occupation-input").on("input", function() {';
  $output .= '        var inputVal = $(this).val();';
  $output .= '        $("#occupation-list option").each(function() {';
  $output .= '          var optionVal = $(this).val();';
  $output .= '          if (optionVal.toLowerCase().indexOf(inputVal.toLowerCase()) === -1) {';
  $output .= '            $(this).prop("hidden", true);';
  $output .= '          } else {';
  $output .= '            $(this).prop("hidden", false);';
  $output .= '          }';
  $output .= '        });';
  $output .= '      });';
  $output .= '      $("#alert-message1").hide();';
  $output .= '      $("#question1").hide();';
  $output .= '      $("#question2").show();';
	
	 $output .= 'updateProgressBar(2);';
  $output .= '    },';
  $output .= '    error: function() {';
  $output .= '      alert("An error occurred while fetching the job positions.");';
  $output .= '    }';
  $output .= '  });';
	
	 $output .= ' } else {';
    $output .= ' $("#alert-message1").text("Please select an industry before proceeding.").show();';
   $output .= '}';
	
  $output .= '});';
	
	$output .= '$("#previous-button2").click(function() {';
  $output .= '$("#question2").hide();';
  $output .= '$("#question1").show();';
	$output .= 'updateProgressBar(1);';
$output .= '});';

$output .= '$("#next-button2").click(function() {';
$output .= '  var inputValue = $("#occupation-input").val().toLowerCase();';
$output .= '  var isValid = false;';
$output .= '  $("#occupation-list option").each(function() {';
$output .= '    if ($(this).val().toLowerCase() === inputValue) {';
$output .= '      isValid = true;';
$output .= '      return false;'; // break the loop
$output .= '    }';
$output .= '  });';

$output .= '  if (isValid) {';
	  $output .= '      $("#alert-message2").hide();';
$output .= '    $("#question2").hide();';
$output .= '    $("#question3").show();';
$output .= '    updateProgressBar(3);';
$output .= '  } else {';
$output .= '    $("#alert-message2").text("Please enter a job position from the list before proceeding.").show();';
$output .= '  }';
$output .= '});';

$output .= '$("#previous-button3").click(function() {';
$output .= '  $("#question3").hide();';
$output .= '  $("#question2").show();';
	$output .= 'updateProgressBar(2);';
$output .= '});';
	
$output .= '$("#retake-button").click(function() {';
$output .= '  $("#result").hide();';
$output .= '  $("#question1").show();';
	$output .= 'updateProgressBar(1);';
	$output .= 'resetFormFields();';
$output .= '});';

	$output .= '	function educationTextToRank(text) {';

$output .= '  switch (text) {';
$output .= '    case "Post Grad/Grad Dip or Grad Cert":';
$output .= '      return 1;';
$output .= '    case "Bachelor degree":';
$output .= '      return 2;';
$output .= '    case "Advanced Diploma/Diploma":';
$output .= '      return 3;';
$output .= '    case "Certificate III/IV":';
$output .= '      return 4;';
$output .= '    case "High school":';
$output .= '      return 5;';
$output .= '    default:';
$output .= '      return -1;';
$output .= '  }';
$output .= '}';
	
$output .= '$("#next-button3").click(function() {';
	
	 $output .= 'if ($("input[name=\'education\']:checked").length > 0) {';
	  $output .= '      $("#alert-message3").hide();';
	$output .= '     $("#question3").hide();';
	$output .= '      $("#question4").show();';
	 $output .= 'updateProgressBar(4);';
	 $output .= ' } else {';
    $output .= ' $("#alert-message3").text("Please select a level of education before proceeding.").show();';
   $output .= '}';
	$output .= '      });';
	
	
	$output .= '       $("#previous-button4").click(function() {                              ';
	$output .= '      $("#question4").hide();                               ';
	$output .= '      $("#question3").show();                            ';
	$output .= 'updateProgressBar(3);';
	$output .= '    });                           ';
	

// Update the next-button4 click function
$output .= '$("#next-button4").click(function() {';	
$output .= '  var selectedEducationText = $("input[name=\'education\']:checked").val();';
$output .= '  var selectedEducation = educationTextToRank(selectedEducationText);';
$output .= '  var selectedOccupation = $("#occupation-input").val();';
$output .= '  var yearsExperience = parseInt($("#experience-input").val(), 10);';

$output .= '  $.ajax({';
$output .= '    type: "POST",';
$output .= '    url: "/wp-admin/admin-ajax.php",';
$output .= '    data: {';
$output .= '      action: "fetch_most_position",';
$output .= '      occupation: selectedOccupation,';
$output .= '      industry: selectedIndustry';
$output .= '    },';
$output .= '    success: function(data) {';
$output .= '      var response = JSON.parse(data);';
$output .= '      var mostPosition = educationTextToRank(response.most_position);';
$output .= '      var workExperience = parseInt(response.work_experience, 10);';

$output .= '      if (selectedEducation <= mostPosition) {';
$output .= '        $("#result-message").html("Based on your qualifications and experience, it is likely that you are <b>qualified</b> for the position of a  <b>" + selectedOccupation + "</b>.");';
$output .= '  $("#additional-message").html("The <b>majority of individuals</b> in this position completed <b>" + response.most_position + "</b>. Your highest level of education is <b>equivalent to or higher</b> than this, placing you in a strong position for this role. In some instances, relevant experience or on-the-job training may be required in addition to the formal qualification.");';
$output .= '      } else if (yearsExperience >= workExperience) {';
$output .= '        $("#result-message").html("Based on your experience, it is likely that you are <b>qualified</b> for the position of a <b>" + selectedOccupation + "</b>.");';
$output .= '  $("#additional-message").html("The <b>majority of individuals</b> in this position completed <b>" + response.most_position + "</b>. Although your highest level of education is <b>lower</b> than this, you have <b>" + yearsExperience + "</b> years of relevant work experience. For this position, at least <b>" + workExperience + "</b> years of relevant experience may be considered as a substitute for the formal qualification.");';
$output .= '      } else {';
$output .= '        $("#result-message").html("Based on your qualifications and experience, it may be challenging to meet the requirements for the position of a  <b>" + selectedOccupation + "</b>.");';
$output .= '  $("#additional-message").html("The <b>majority of individuals</b> in this position completed <b>" + response.most_position + "</b>. Your highest level of education is <b>lower</b> than this, and you have <b>" + yearsExperience + "</b> years of relevant work experience. For this position, it is recommended to complete " + response.most_position + " or have at least <b>" + workExperience + "</b> years of relevant experience as a substitute for the formal qualification.");';
$output .= '      }';
$output .= '        $("#description").html("Most individuals in this job position have completed <b>" + response.most_position + "</b>.</br><b>" + response.male_share + "%</b> are <b>male</b> and <b>" + response.female_share + "%</b> are <b>female</b>.</br><b>" + response.full_time_share + "%</b> work <b>full-time</b> and <b>" + response.part_time_share + "%</b> work <b>part-time</b>.");';
$output .= '        $("#trend-text").html("The future growth rate of <b>" + selectedOccupation + "</b> is projected to be <b>" + response.growth_rate + "%</b>, indicating a <b>" + response.future_growth_rating + "</b> growth rate.");';
	

$output .= '$("#seek-link").html(\'<a href="https://www.seek.com.au/\' + selectedOccupation + \'-jobs" target="_blank">Click here</a> to view \' + selectedOccupation + \' jobs on <b>Seek.com.au</b>\');';
$output .= '$("#insight-title").html("Key Insights for " + selectedOccupation);';
	$output .= '$("#trend-title").html("Key Trend for " + selectedOccupation);';
	// Destroy the previous chart if it exists
$output .= '  if (qualificationChart) {';
$output .= '    qualificationChart.destroy();';
$output .= '  }';
		// Create the bar chart using Chart.js
$output .= '  var chartData = {';
$output .= '    labels: ["High School", "Certificate III/IV", "Advanced Diploma/Diploma", "Bachelor Degree", "Post Grad/Grad Dip or Grad Cert"],';
$output .= '    datasets: [{';
$output .= '      data: [response.high_school, response.certificate, response.diploma, response.bachelor_degree, response.grad],';
$output .= '      backgroundColor: [';
$output .= '        "rgba(75, 192, 192, 0.5)",';
$output .= '        "rgba(255, 206, 86, 0.5)",';
$output .= '        "rgba(255, 99, 132, 0.5)",';
$output .= '        "rgba(255, 159, 64, 0.5)",';
$output .= '        "rgba(54, 162, 235, 0.5)"';
$output .= '      ],';
$output .= '      borderColor: [';
$output .= '        "rgba(75, 192, 192, 1)",';
$output .= '        "rgba(255, 206, 86, 1)",';
$output .= '        "rgba(255, 99, 132, 1)",';
$output .= '        "rgba(255, 159, 64, 1)",';
$output .= '        "rgba(54, 162, 235, 1)"';
$output .= '      ],';
$output .= '      borderWidth: 1';
$output .= '    }]';
$output .= '  };';

$output .= '  var chartOptions = {';
$output .= '    plugins: {';
$output .= '      legend: {';
$output .= '        display: false'; // Hide the legend
$output .= '      },';
$output .= '      title: {';
$output .= '        display: true,';
$output .= '        text: "",'; // Initialize title with an empty string
	$output .= '        font: {';
$output .= '          size: 16,';
$output .= '          weight: "bold"';
$output .= '        }';
$output .= '      },';
$output .= '      tooltip: {'; // Add tooltip options
$output .= '        callbacks: {';
$output .= '          label: function(context) {'; // Customize the tooltip label
$output .= '            return context.parsed.y + "%";'; // Append "%" to the tooltip value
$output .= '          }';
$output .= '        }';
$output .= '      }';
$output .= '    },';
$output .= '    scales: {';
$output .= '      x: {';
$output .= '        title: {';
$output .= '          display: true,';
$output .= '          text: "Level of Education",'; // Add the x-axis title
	$output .= '        font: {';
$output .= '          size: 16,';
$output .= '          weight: "bold"';
$output .= '        }';
$output .= '        },';
$output .= '        ticks: {'; // Add ticks options
$output .= '	autoSkip: false,';
$output .= '          maxRotation: 0,'; // Set maximum rotation to 0 degrees
$output .= '          minRotation: 0'; // Set minimum rotation to 0 degrees
$output .= '        }';
$output .= '      },';
$output .= '      y: {';
$output .= '        title: {';
$output .= '          display: true,';
$output .= '          text: "Percentage of People \(%\)",'; // Add the y-axis title
	$output .= '        font: {';
$output .= '          size: 16,';
$output .= '          weight: "bold"';
$output .= '        }';
$output .= '        },';
$output .= '        beginAtZero: true';
$output .= '      }';
$output .= '    }';
$output .= '  };';

$output .= '	var ctx = $("#qualification-chart")[0].getContext("2d");';

// Create a new bar chart
$output .= '  qualificationChart = new Chart(ctx, {';
$output .= '    type: \'bar\',';
$output .= '    data: chartData,';
$output .= '    options: chartOptions';
$output .= '  });';

// Update the chart title with the selected occupation
$output .= '  qualificationChart.options.plugins.title.text = "Highest Education Level of " + selectedOccupation;';
$output .= '  qualificationChart.update();';
	
$output .= '	if (genderChart) {';
$output .= '  genderChart.destroy();';
$output .= '}';
	
// Create the pie chart using Chart.js
$output .= '  var pieData = {';
$output .= '    labels: ["Male", "Female"],';
$output .= '    datasets: [{';
$output .= '      data: [response.male_share, response.female_share],';
$output .= '      backgroundColor: [';
$output .= '        "rgba(54, 162, 235, 0.5)",';
$output .= '        "rgba(255, 99, 132, 0.5)"';
$output .= '      ],';
$output .= '      borderColor: [';
$output .= '        "rgba(54, 162, 235, 1)",';
$output .= '        "rgba(255, 99, 132, 1)"';
$output .= '      ],';
$output .= '      borderWidth: 1';
$output .= '    }]';
$output .= '  };';

$output .= '  var pieOptions = {';
$output .= '    plugins: {';
$output .= '      legend: {';
$output .= '        position: "right"';
$output .= '      },';
$output .= '      title: {';
$output .= '        display: true,';
$output .= '        text: "",'; // Add the chart title
$output .= '        font: {';
$output .= '          size: 16,';
$output .= '          weight: "bold"';
$output .= '        }';
$output .= '      },';
	$output .= '      tooltip: {'; // Add tooltip options
$output .= '        callbacks: {'; // Add tooltip callbacks
$output .= '          label: function(context) {'; // Customize the tooltip label
$output .= '            var label = context.label || "";';
$output .= '            var value = context.parsed || 0;';
$output .= '            if (value) {';
$output .= '              label += ": " + value + "%";'; // Append "%" to the tooltip value
$output .= '            }';
$output .= '            return label;';
$output .= '          }';
$output .= '        }';
$output .= '      }';
	
$output .= '    }';
$output .= '  };';

$output .= '  var ctx2 = $("#gender-chart")[0].getContext("2d");';

// Create a new pie chart
$output .= '  genderChart = new Chart(ctx2, {';
$output .= '    type: "pie",';
$output .= '    data: pieData,';
$output .= '    options: pieOptions';
$output .= '  });';

	// Update the chart title with the selected occupation
$output .= '  genderChart.options.plugins.title.text = "Gender of " + selectedOccupation;';
$output .= '  genderChart.update();';
	
$output .= '	if (employmentChart) {';
$output .= '  employmentChart.destroy();';
$output .= '}';
	
// Create the pie chart using Chart.js
$output .= '  var pie2Data = {';
$output .= '    labels: ["Full Time", "Part Time"],';
$output .= '    datasets: [{';
$output .= '      data: [response.full_time_share, response.part_time_share],';
$output .= '      backgroundColor: [';
$output .= '        "rgba(75, 192, 192, 0.5)",';
$output .= '        "rgba(255, 159, 64, 0.5)"';
$output .= '      ],';
$output .= '      borderColor: [';
$output .= '        "rgba(75, 192, 192, 1)",';
$output .= '        "rgba(255, 159, 64, 1)"';
$output .= '      ],';
$output .= '      borderWidth: 1';
$output .= '    }]';
$output .= '  };';

$output .= '  var pie2Options = {';
$output .= '    plugins: {';
$output .= '      legend: {';
$output .= '        position: "right"';
$output .= '      },';
$output .= '      title: {';
$output .= '        display: true,';
$output .= '        text: "",'; // Add the chart title
$output .= '        font: {';
$output .= '          size: 16,';
$output .= '          weight: "bold"';
$output .= '        }';
$output .= '      },';
	$output .= '      tooltip: {'; // Add tooltip options
$output .= '        callbacks: {'; // Add tooltip callbacks
$output .= '          label: function(context) {'; // Customize the tooltip label
$output .= '            var label = context.label || "";';
$output .= '            var value = context.parsed || 0;';
$output .= '            if (value) {';
$output .= '              label += ": " + value + "%";'; // Append "%" to the tooltip value
$output .= '            }';
$output .= '            return label;';
$output .= '          }';
$output .= '        }';
$output .= '      }';
	
$output .= '    }';
$output .= '  };';

$output .= '  var ctx3 = $("#employment-chart")[0].getContext("2d");';

// Create a new pie chart
$output .= '  employmentChart = new Chart(ctx3, {';
$output .= '    type: "pie",';
$output .= '    data: pie2Data,';
$output .= '    options: pie2Options';
$output .= '  });';

	// Update the chart title with the selected occupation
$output .= '  employmentChart.options.plugins.title.text = "Employment Type of " + selectedOccupation;';
$output .= '  employmentChart.update();';
	
//line graph for trend
$output .= '	if (lineChart) {';
$output .= '  lineChart.destroy();';
$output .= '}';

$output .= '  var lineData = {';
$output .= '    labels: ["Nov-11", "Nov-12", "Nov-13", "Nov-14", "Nov-15", "Nov-16", "Nov-17", "Nov-18", "Nov-19", "Nov-20", "Nov-21", "Nov-22", "Nov-22", "Nov-23", "Nov-24", "Nov-26"],';
$output .= '    datasets: [{';
$output .= '      label: "Employment level (2011-2021)",';
$output .= '      data: [response["2011_11"], response["2012_11"], response["2013_11"], response["2014_11"], response["2015_11"], response["2016_11"], response["2017_11"], response["2018_11"], response["2019_11"], response["2020_11"], response["2021_11"], null, null, null, null, null],';
$output .= '      fill: false,';
$output .= '      borderColor: "rgba(98,75,192, 1)",';
$output .= '      backgroundColor: "rgba(98,75,192, 1)",';
$output .= '      pointBackgroundColor: "rgba(98,75,192, 0.5)",';
$output .= '      borderWidth: 2';
$output .= '    }, {';
$output .= '      label: "Projected employment level (2026)",';
$output .= '      data: [null, null, null, null, null, null, null, null, null, null, null, null, null, null, null, response["project_level"]],';
$output .= '      pointStyle: "star",';
$output .= '      pointRadius: 10,';
$output .= '      pointHoverRadius: 12,';
$output .= '      fill: false,';
$output .= '      borderColor: "rgba(192,98,75, 1)",';
$output .= '      backgroundColor: "rgba(192,98,75, 1)",';
$output .= '      pointBackgroundColor: "rgba(192,98,75, 0.5)",'; // Set point background color
$output .= '      borderWidth: 2';
$output .= '    }]';
$output .= '  };';

$output .= '  var lineOptions = {';
$output .= '    responsive: true,';
$output .= '    plugins: {';
$output .= '      legend: {';
$output .= '        display: true,'; // Set display to true
$output .= '      },';
$output .= '      title: {';
$output .= '        display: true,';
$output .= '        text: "Employment level, past and projected growth to November 2026",'; // Add the chart title
$output .= '        font: {';
$output .= '          size: 16,';
$output .= '          weight: "bold"';
$output .= '        }';
$output .= '      }';
$output .= '    },';
$output .= '    scales: {';
$output .= '      x: {';
$output .= '        title: {';
$output .= '          display: true,';
$output .= '          text: "Year"';
$output .= '        }';
$output .= '      },';
$output .= '      y: {';
$output .= '        title: {';
$output .= '          display: false,';
$output .= '          text: "Value"';
$output .= '        },';
$output .= '        ticks: {';
$output .= '          stepSize: 5000'; // Adjust the stepSize to set the interval between ticks
$output .= '        }';
$output .= '      }';
$output .= '    }';
$output .= '  };';
	
$output .= '  var ctx4 = $("#line-chart")[0].getContext("2d");';
$output .= '  lineChart = new Chart(ctx4, {';
	$output .= '    type: "line",';
$output .= '    data: lineData,';
$output .= '    options: lineOptions';
$output .= '  });';
	
$output .= '      $("#question4").hide();';
$output .= '      $("#result").show();';
$output .= 'updateProgressBar(5);';
		
$output .= '    },';
$output .= '    error: function() {';
$output .= '      alert("An error occurred while fetching the most_position.");';
$output .= '    }';
$output .= '  });';		
$output .= '});';

  $output .= '});';
  $output .= '</script>';

  return $output;
}
add_shortcode('employment_quiz', 'employment_quiz_shortcode');

function fetch_job_positions() {
  $selected_industry = isset($_POST['industry']) ? $_POST['industry'] : '';

  global $wpdb;
  $job_positions_table = '';

  if ($selected_industry == 'administrative') {
    $job_positions_table = $wpdb->prefix . 'administrative';
  } elseif ($selected_industry == 'education') {
    $job_positions_table = $wpdb->prefix . 'education';
  } elseif ($selected_industry == 'healthcare') {
    $job_positions_table = $wpdb->prefix . 'healthcare';
  }

  $job_positions = $wpdb->get_results("SELECT occupation FROM $job_positions_table");

  $output = array();
  foreach ($job_positions as $position) {
    $output[] = array('occupation' => $position->occupation);
  }

  echo json_encode($output);
  wp_die();
}

add_action('wp_ajax_fetch_job_positions', 'fetch_job_positions');
add_action('wp_ajax_nopriv_fetch_job_positions', 'fetch_job_positions');

function fetch_most_position() {
  $selected_occupation = isset($_POST['occupation']) ? $_POST['occupation'] : '';
  $selected_industry = isset($_POST['industry']) ? $_POST['industry'] : '';

  global $wpdb;
  $job_positions_table = '';

  if ($selected_industry == 'administrative') {
    $job_positions_table = $wpdb->prefix . 'administrative';
  } elseif ($selected_industry == 'education') {
    $job_positions_table = $wpdb->prefix . 'education';
  } elseif ($selected_industry == 'healthcare') {
    $job_positions_table = $wpdb->prefix . 'healthcare';
  }

   $result = $wpdb->get_row($wpdb->prepare("SELECT most_position, work_experience, grad, bachelor_degree, diploma, certificate, high_school, male_share, female_share, full_time_share, part_time_share, 2011_11, 2012_11, 2013_11, 2014_11, 2015_11, 2016_11, 2017_11, 2018_11, 2019_11, 2020_11, 2021_11, project_level, project_growth, growth_rate, future_growth_rating FROM $job_positions_table WHERE occupation = %s", $selected_occupation), ARRAY_A);

  echo json_encode($result);
  wp_die();
}

add_action('wp_ajax_fetch_most_position', 'fetch_most_position');
add_action('wp_ajax_nopriv_fetch_most_position', 'fetch_most_position');