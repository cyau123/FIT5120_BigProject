function entry_year_shortcode() {
	wp_enqueue_script('jquery-ui-datepicker');
   wp_enqueue_style('jquery-ui-datepicker-style', 'https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css');
    ob_start();
    ?>

 <form id="entry-year-form" method="post">
        <p>
            <label for="dob">Date of Birth:</label>
            <input type="text" id="dob" name="dob" required>
            <input type="submit" name="submit" value="Submit">
        </p>
    </form>
    <div id="entry-year-output">
        <div class='box'>
            <p><b>Three-Year-Old Kinder:</b> <span id="three-year-old-message"> Please enter the date of birth of your child</span></p>
            <p><b>Four-Year-Old Kinder:</b> <span id="four-year-old-message"> Please enter the date of birth of your child</span></p>
        </div>
    </div>

<style>
    label[for="dob"] {
        font-size: 16px;
		font-weight: bolder;
    }
	p{
		font-size: 16px;
	}
  .box {
    background-color: #E9F4F6;
    padding: 10px;
	  min-height: 156px;
  }
  .box h2 {
    font-size: 20px;
    margin-top: 0;
  }
</style>

<script>
        jQuery(document).ready(function($) {
            // Datepicker
            $('#dob').datepicker({
                dateFormat: 'yy-mm-dd',
                changeYear: true,
                yearRange: "-100:+0"
            });

            // AJAX form submission
            $('#entry-year-form').on('submit', function(event) {
                event.preventDefault();

                $.ajax({
                    url: '<?php echo admin_url('admin-ajax.php'); ?>',
                    type: 'POST',
                    data: {
                        action: 'entry_year_calculate',
                        dob: $('#dob').val()
                    },
                    success: function(response) {
                        $('#three-year-old-message').text(response.three_year_old_message);
                        $('#four-year-old-message').text(response.four_year_old_message);
                    }
                });
            });
        });
    </script>
    <?php
    return ob_get_clean();
}
add_shortcode('entry_year', 'entry_year_shortcode');

// AJAX handler
function entry_year_calculate() {
    if (isset($_POST['dob'])) {
        $dob = $_POST['dob'];
        $dob_timestamp = strtotime($dob);
        $dob_month = date('m', $dob_timestamp);
        $dob_year = date('Y', $dob_timestamp);
        $age = date('Y') - $dob_year;

        if ($age >= 6) {
            $three_year_old_message = 'Your child has exceeded the age requirement for kindergarten enrollment';
            $four_year_old_message = 'Your child has exceeded the age requirement for kindergarten enrollment';
        } else if ($dob_month >= 1 && $dob_month <= 4) {
            $entry_year_three = $dob_year + 3;
            $entry_three_plus = $entry_year_three + 1;
            $entry_year_four = $dob_year + 4;
            $entry_four_plus = $entry_year_four + 1;

            $three_year_old_message = "Your child can start Three-Year-Old Kinder in: $entry_year_three or $entry_three_plus";
            $four_year_old_message = "Your child can start Four-Year-Old Kinder in: $entry_year_four or $entry_four_plus";
        } else {
            $entry_year_three = $dob_year + 4;
            $entry_year_four = $dob_year + 5;

            $three_year_old_message = "Your child can start Three-Year-Old Kinder in: $entry_year_three";
            $four_year_old_message = "Your child can start Four-Year-Old Kinder in: $entry_year_four";
        }

        $response = array(
            'three_year_old_message' => $three_year_old_message,
            'four_year_old_message' => $four_year_old_message
        );

        // Send response as JSON
        wp_send_json($response);
    }

    wp_die();
}
add_action('wp_ajax_entry_year_calculate', 'entry_year_calculate');
add_action('wp_ajax_nopriv_entry_year_calculate', 'entry_year_calculate');