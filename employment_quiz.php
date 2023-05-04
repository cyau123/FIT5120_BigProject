function employment_quiz_shortcode() {
  $output = '<div id="quiz-intro" style="background-image: url(\'https://img.freepik.com/free-photo/silhouette-person-standing-beach-cloudy-sky-during-breathtaking-sunset_181624-13424.jpg?w=1800&t=st=1683160635~exp=1683161235~hmac=4b26cc61b0d757aa93075be7e43a01c3cfd0bba7af0a4fa2f2b9947cd0b01d2a\');">';
  $output .= '<div style="background-color: rgba(0, 0, 0, 0.5);">';
  $output .= '<h2 style="color: #fff; text-align: center;">Path to Employment: Assessing Your Qualifications for Job Positions in Victoria</h2>';
  $output .= '<button id="start-quiz-button" style="margin: 0 auto; display: block;">Start Quiz</button>';
  $output .= '</div>';
  $output .= '</div>';

  $output .= '<div id="question1" style="display: none;">';
  $output .= '<h2>Which industry do you want to work in?</h2>';
  $output .= '<input type="radio" id="industry1" name="industry" value="administrative">';
  $output .= '<label for="industry1">Administrative and Support Service</label><br>';
  $output .= '<input type="radio" id="industry2" name="industry" value="education">';
  $output .= '<label for="industry2">Education</label><br>';
  $output .= '<input type="radio" id="industry3" name="industry" value="healthcare">';
  $output .= '<label for="industry3">Health Care and Social Assistance</label><br>';
  $output .= '<button id="next-button">Next</button>';
  $output .= '</div>';

  $output .= '<div id="question2" style="display: none;">';
  $output .= '<h2>Which job position are you interested in?</h2>';
  $output .= '<input type="text" id="occupation-input" name="occupation" list="occupation-list">';
  $output .= '<datalist id="occupation-list">';
  // options will be added dynamically by JavaScript
  $output .= '</datalist>';
	 $output .= '<button id="previous-button2">Previous</button>';
	 $output .= '<button id="next-button2">Next</button>';
  $output .= '</div>';

	$output .= '<div id="question3" style="display: none;">';
	$output .= '<h2>What is the highest level of education you have completed?</h2>';
	$output .= '<input type="radio" id="education1" name="education" value="Post Grad/Grad Dip or Grad Cert">';
	$output .= '<label for="education1">Post Grad/Grad Dip or Grad Cert</label><br>';
	$output .= '<input type="radio" id="education2" name="education" value="Bachelor degree">';
	$output .= '<label for="education2">Bachelor degree</label><br>';
	$output .= '<input type="radio" id="education3" name="education" value="Advanced Diploma/Diploma">';
	$output .= '<label for="education3">Advanced Diploma/Diploma</label><br>';
	$output .= '<input type="radio" id="education4" name="education" value="Certificate III/IV">';
	$output .= '<label for="education4">Certificate III/IV</label><br>';
	$output .= '<input type="radio" id="education5" name="education" value="High School">';
	$output .= '<label for="education5">High school</label><br>';
	$output .= '<button id="previous-button3">Previous</button>';
	$output .= '<button id="next-button3">Next</button>';
	$output .= '</div>';
	
	$output .= '<div id="question4" style="display: none;">';
$output .= '<h2>How many years of relevant working experience do you have?</h2>';
$output .= '<select id="experience-input" name="experience">';
for ($i=0; $i<=30; $i++) {
    $output .= '<option value="'.$i.'">'.$i.'</option>';
}
$output .= '</select>';
$output .= '<button id="previous-button4">Previous</button>';
$output .= '<button id="next-button4">Next</button>';
$output .= '</div>';
	
	$output .= '<div id="result" style="display: none;">';
$output .= '<h2>Result</h2>';
$output .= '<p id="result-message"></p>';
	$output .= '<button id="previous-button5">Previous</button>';
$output .= '</div>';


  $output .= '<style>';
  $output .= '#quiz-intro {';
  $output .= '  height: 100vh;';
  $output .= '  background-size: cover;';
  $output .= '  background-position: center;';
  $output .= '  display: flex;';
  $output .= '  justify-content: center;';
  $output .= '  align-items: center;';
  $output .= '}';
  $output .= '</style>';

   $output .= '<script>';
	$output .= 'var selectedIndustry;';
  $output .= 'jQuery(document).ready(function($) {';
  $output .= '$("#start-quiz-button").click(function() {';
  $output .= '$("#quiz-intro").hide();';
  $output .= '$("#question1").show();';
  $output .= '});';

  $output .= '$("#next-button").click(function() {';
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
  $output .= '    },';
  $output .= '    error: function() {';
  $output .= '      alert("An error occurred while fetching the job positions.");';
  $output .= '    }';
  $output .= '  });';
  $output .= '});';
	
	$output .= '$("#previous-button2").click(function() {';
  $output .= '$("#question2").hide();';
  $output .= '$("#question1").show();';
$output .= '});';

$output .= '$("#next-button2").click(function() {';
 $output .= ' $("#question2").hide();';
$output .= '  $("#question3").show();';
$output .= '});';

$output .= '$("#previous-button3").click(function() {';
$output .= '  $("#question3").hide();';
$output .= '  $("#question2").show();';
$output .= '});';
	
$output .= '$("#previous-button5").click(function() {';
$output .= '  $("#result").hide();';
$output .= '  $("#question4").show();';
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
$output .= '    case "High School":';
$output .= '      return 5;';
$output .= '    default:';
$output .= '      return -1;';
$output .= '  }';
$output .= '}';
	
$output .= '        $("#next-button3").click(function() {                             ';
	$output .= '     $("#question3").hide();                                ';
	$output .= '      $("#question4").show();                               ';
	$output .= '      });                               ';
	$output .= '       $("#previous-button4").click(function() {                              ';
	$output .= '      $("#question4").hide();                               ';
	$output .= '      $("#question3").show();                            ';
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
$output .= '        $("#result-message").text("Based on your qualifications and experience, it is likely that you are qualified for the selected occupation.");';
$output .= '      } else if (yearsExperience >= workExperience) {'; // Modify this condition
$output .= '        $("#result-message").text("Based on your experience, it is likely that you are qualified for the selected occupation.");';
$output .= '      } else {';
$output .= '        $("#result-message").text("Sorry, it is most likely that you are not qualified for the selected occupation.");';
$output .= '      }';

$output .= '      $("#question4").hide();';
$output .= '      $("#result").show();';
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

  $result = $wpdb->get_row($wpdb->prepare("SELECT most_position, work_experience FROM $job_positions_table WHERE occupation = %s", $selected_occupation), ARRAY_A);

  echo json_encode($result);
  wp_die();

}

add_action('wp_ajax_fetch_most_position', 'fetch_most_position');
add_action('wp_ajax_nopriv_fetch_most_position', 'fetch_most_position');