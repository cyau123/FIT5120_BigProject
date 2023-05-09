function include_chartjs() {
    wp_enqueue_script('chartjs', 'https://cdn.jsdelivr.net/npm/chart.js', [], null, true);
}
add_action('wp_enqueue_scripts', 'include_chartjs');

function employment_quiz_shortcode() {
  $output = '<div id="quiz-intro" style="background-image: url(\'https://img.freepik.com/free-photo/silhouette-person-standing-beach-cloudy-sky-during-breathtaking-sunset_181624-13424.jpg?w=1800&t=st=1683160635~exp=1683161235~hmac=4b26cc61b0d757aa93075be7e43a01c3cfd0bba7af0a4fa2f2b9947cd0b01d2a\');">';
  $output .= '<div style="background-color: rgba(0, 0, 0, 0.5);">';
  $output .= '<h2 style="color: #fff; text-align: center;">Path to Employment: Assessing Your Qualifications for Job Positions in Victoria</h2>';
  $output .= '<button id="start-quiz-button" style="margin: 0 auto; display: block;">Start Quiz</button>';
  $output .= '</div>';
  $output .= '</div>';

$output .= '<div id="quiz-header" style="display: none;">';
$output .= ' <h2 class="qualification-assessment" style="color:white;">Qualification Assessment</h2>';
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
  $output .= '<h2>1. Which industry do you want to work in?</h2>';
  $output .= '<input type="radio" id="industry1" name="industry" class="radio-button" value="administrative">';
  $output .= '<label for="industry1" class="mc-label">Administrative and Support Service</label><br>';
  $output .= '<input type="radio" id="industry2" name="industry" class="radio-button" value="education">';
  $output .= '<label for="industry2" class="mc-label">Education</label><br>';
  $output .= '<input type="radio" id="industry3" name="industry" class="radio-button" value="healthcare">';
  $output .= '<label for="industry3" class="mc-label">Health Care and Social Assistance</label><br>';
	$output .= '<p id="alert-message1" style="color: red; display: none; margin-top: 15px;  margin-left: 30px;"></p>';
$output .= '<div class="q-button-container">';
  $output .= '<button id="next-button" class="next-button-right">Next</button>';
  $output .= '</div>';
	  $output .= '</div>';

  $output .= '<div id="question2" style="display: none; padding: 40px;">';
  $output .= '<h2>2. Which job position are you interested in?</h2>';
  $output .= '<input type="text" id="occupation-input" name="occupation" list="occupation-list" style="width:500px;  margin-left: 30px;" placeholder="Please enter a job position or select from the list">';
  $output .= '<datalist id="occupation-list">';
  // options will be added dynamically by JavaScript
  $output .= '</datalist>';
	$output .= '<p id="alert-message2" style="color: red; display: none; margin-top: 15px;  margin-left: 30px;"></p>';
	$output .= '<div class="q-button-container">';
	 $output .= '<button id="previous-button2" class="previous-button-left">Previous</button>';
	 $output .= '<button id="next-button2" class="next-button-right">Next</button>';
  $output .= '</div>';
	  $output .= '</div>';

	$output .= '<div id="question3" style="display: none; padding: 40px;">';
	$output .= '<h2>3. What is the highest level of education you have completed?</h2>';
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
	$output .= '<div class="q-button-container">';
	$output .= '<button id="previous-button3" class="previous-button-left">Previous</button>';
	$output .= '<button id="next-button3" class="next-button-right">Next</button>';
	$output .= '</div>';
	$output .= '</div>';
	
	$output .= '<div id="question4" style="display: none; padding: 40px;">';
$output .= '<h2>4. How many years of relevant work experience do you have?</h2>';
$output .= '<select id="experience-input" style="width:100px;  margin-left: 30px;" name="experience">';
for ($i=0; $i<=30; $i++) {
    $output .= '<option value="'.$i.'">'.$i.'</option>';
}
$output .= '</select>';
		$output .= '<div class="q-button-container">';
$output .= '<button id="previous-button4" class="previous-button-left">Previous</button>';
$output .= '<button id="next-button4" class="next-button-right">Next</button>';
$output .= '</div>';
	$output .= '</div>';
	
	$output .= '<div id="result" style="display: none; padding: 40px;">';
$output .= '<h2>Results</h2>';
$output .= '<div class="results-container" style="margin-left: 30px; margin-right: 30px;">';
	$output .= '<div class="message-container" style="background-color: #fff; border: solid #046BD2; border-width: 1.5px 1.5px 1.5px 7px; padding: 15px; margin-top: 40px; margin-bottom: 40px; border-radius: 5px;">';
$output .= '<p id="result-message"></p>';
	$output .= '<p id="additional-message"></p>';
	$output .= '<p id="seek-link"></p>';
	$output .= '</div>';
	$output .= '<h4 id="trend-title"></h4>';
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
	$output .= '</div>';
	$output .= '<div class="q-button-container">';
	$output .= '<button id="previous-button5" class="previous-button-left">Previous</button>';
$output .= '</div>';
$output .= '</div>';

  $output .= '<style>';
  $output .= '#quiz-intro {';
  $output .= '  height: 100vh;';
  $output .= '  background-size: cover;';
  $output .= '  background-position: center;';
  $output .= '  display: flex;';
  $output .= '  justify-content: center;';
  $output .= '  align-items: center;';
  $output .= '} ';
  $output .= '</style>';

   $output .= '<script>';
	$output .= 'var selectedIndustry;';
	$output .= 'var qualificationChart;';
	$output .= 'var genderChart;';
	$output .= 'var employmentChart;';
  $output .= 'jQuery(document).ready(function($) {';
	
	$output .= '	function updateProgressBar(questionNumber) {';
$output .= '  $("#q-progress").css("width", (questionNumber) * 20 + "%");';
$output .= '  $("#q-Q1, #q-Q2, #q-Q3, #q-Q4, #q-Q5").css("color", "#999999");';
$output .= '  $("#q-Q" + questionNumber).css("color", "white");';
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
	
$output .= '$("#previous-button5").click(function() {';
$output .= '  $("#result").hide();';
$output .= '  $("#question4").show();';
	$output .= 'updateProgressBar(4);';
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
$output .= '        $("#result-message").html("Sorry, it is most likely that you are <b>not qualified</b> for the position of a  <b>" + selectedOccupation + "</b>.");';
$output .= '  $("#additional-message").html("The <b>majority of individuals</b> in this position completed <b>" + response.most_position + "</b>. Your highest level of education is <b>lower</b> than this, and you have <b>" + yearsExperience + "</b> years of relevant work experience. For this position, it is recommended to complete " + response.most_position + " or have at least <b>" + workExperience + "</b> years of relevant experience as a substitute for the formal qualification.");';
$output .= '      }';

$output .= '$("#seek-link").html(\'<a href="https://www.seek.com.au/\' + selectedOccupation + \'-jobs" target="_blank">Click here</a> to view \' + selectedOccupation + \' jobs on Seek.com.au\');';
$output .= '$("#trend-title").html("Key Insights for " + selectedOccupation);';
	// Destroy the previous chart if it exists
$output .= '  if (qualificationChart) {';
$output .= '    qualificationChart.destroy();';
$output .= '  }';
		// Create the bar chart using Chart.js
$output .= '  var chartData = {';
$output .= '    labels: ["Post Grad/Grad Dip or Grad Cert", "Bachelor Degree", "Advanced Diploma/Diploma", "Certificate III/IV", "High School"],';
$output .= '    datasets: [{';
$output .= '      data: [response.grad, response.bachelor_degree, response.diploma, response.certificate, response.high_school],';
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

   $result = $wpdb->get_row($wpdb->prepare("SELECT most_position, work_experience, grad, bachelor_degree, diploma, certificate, high_school, male_share, female_share, full_time_share, part_time_share FROM $job_positions_table WHERE occupation = %s", $selected_occupation), ARRAY_A);

  echo json_encode($result);
  wp_die();
}

add_action('wp_ajax_fetch_most_position', 'fetch_most_position');
add_action('wp_ajax_nopriv_fetch_most_position', 'fetch_most_position');