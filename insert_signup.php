<?php error_reporting(E_ERROR); ?>
<?php include_once ('config.php'); ?>

<?php
/*
 * ============================================================================
 *
 * #name: 			insert_signup.php
 *
 * #package: 		Server
 *
 * #university: 	Rochester Institute of Technlogy
 *
 * #department:		Computer Science
 *
 * #course: 		CSCI 735 - Foundations of Intelligent Security Systems
 *
 * #author: 		akanshaSharma			akshaySSalunke
 * ____________________________________________________________________________
 *
 * Description: 	Sub-routine invoked if user submitted signup form
 *
 * ============================================================================
 */

/*
 * #---------------------------------------------------------------------------#
 * # Sub-routine invoked if user submitted signup form
 * #---------------------------------------------------------------------------#
 */
function submit_form($uname, $pwd, $email, $dob, $sex, $state, $city, $news) {
	record_signup ( $uname, md5 ( $pwd ), $email, $dob, $sex, $state, $city, $news );
}

/*
 * #---------------------------------------------------------------------------#
 * # Record each user signup to users table
 * #---------------------------------------------------------------------------#
 */
function record_signup($uname, $pwd, $email, $dob, $sex, $state, $city, $news) {
	$insert_signup = "insert INTO users VALUES ('', '$uname', '$pwd', '$email', '$dob', '$sex', '$state', '$city', '$news')";
	$query = mysql_query ( $insert_signup );
	if ($query) {
		echo "<h1>Signup Success.</h1>";
	} else {
		echo "Error: " . $insert_signup . "<br>";
	}
}
?>