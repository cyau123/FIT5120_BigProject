function entry_year_shortcode() {
	wp_enqueue_script('jquery-ui-datepicker');
   wp_enqueue_style('jquery-ui-datepicker-style', 'https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css');
    ob_start();
    ?>

<style>
    label[for="dob"] {
        font-size: 16px;
		font-weight: bolder;
    }
	p{
		font-size: 16px;
	}
</style>

<style>
  .box {
    background-color: #E9F4F6;
    padding: 10px;
  }
  .box h2 {
    font-size: 20px;
    margin-top: 0;
  }
</style>


    <form id="entry-year-form" method="post">
        <p>
            <label for="dob">Date of Birth:</label>
            <input type="text" id="dob" name="dob" required>
            <input type="submit" name="submit" value="Submit">
        </p>
    </form>

    <div id="entry-year-output">
        <?php
        if(isset($_POST['submit']) && isset($_POST['dob'])) {
            $dob = $_POST['dob'];
            $dob_timestamp = strtotime($dob);
            $dob_month = date('m', $dob_timestamp);
            $dob_year = date('Y', $dob_timestamp);
            $age = date('Y') - $dob_year;
			
			if ($age >= 6){
				echo "<div class = 'box'> 
					<p>Your child has exceeded the age requirement for kindergarten enrollment</p>
					</div>";
			}
			else if ($dob_month >= 1 && $dob_month <= 4){
				$entry_year_three = $dob_year + 3 ;
				$entry_three_plus = $entry_year_three+1;
				$entry_year_four = $dob_year + 4 ;
				$entry_four_plus = $entry_year_four+1;
				
				echo "<div class = 'box'>
				<p><b>Your child can start Three-Year-Old Kinder in:</b></br>
				$entry_year_three or $entry_three_plus</p>
				<p><b>Your child can start Four-Year-Old Kinder in:</b></br> 
				$entry_year_four or $entry_four_plus</p>
				</div>";
			}
			else{
				$entry_year_three = $dob_year + 4;
				$entry_year_four = $dob_year + 5 ;
				
				echo "<div class = 'box'>
				</br><p><b>Your child can start Three-Year-Old Kinder in:</b> $entry_year_three</p>
				<p><b>Your child can start Four-Year-Old Kinder in:</b> $entry_year_four</p>
				</div>";
			}
        }
        ?>
    </div>

    <script>
        jQuery(document).ready(function($) {
            $('#dob').datepicker({
                dateFormat: 'yy-mm-dd',
                changeYear: true,
                yearRange: "-100:+0"
            });
        });
    </script>
    <?php
    return ob_get_clean();
}
add_shortcode('entry_year', 'entry_year_shortcode');