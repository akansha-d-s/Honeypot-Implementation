<?php error_reporting(E_ERROR); ?>
<?php include_once ('config.php'); ?>
<?php include ('insert_signup.php'); ?>

<?php

/*
 * ============================================================================
 *
 * #name: 			check_signup.php
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
 * Description: 	The signup form validation
 *
 * ============================================================================
 */

/*
 * #---------------------------------------------------------------------------#
 * # If the form is not submitted then the user got in this program by mistake.
 * # User goes back to signup.php. If form successfully submitted then perform
 * # form validation. After all tests succeed, submit the signup form
 * #---------------------------------------------------------------------------#
 *
 */
if ($_POST ['submit']) {
	$uname = $_POST ['uname'];
	$pwd = $_POST ['pwd'];
	$email = $_POST ['email'];
	$dob = $_POST ['dob'];
	$sex = $_POST ['sex'];
	$state = $_POST ['state'];
	$city = $_POST ['city'];
	$news = $_POST ['news'];
	
	$success = form_validation ( $uname, $pwd, $email, $dob, $sex, $state, $city, $news );
	
	if ($success == 1) {
		submit_form ( $uname, $pwd, $email, $dob, $sex, $state, $city, $news );
	}
}

/*
 * ---------------------------------------------------------------------------#
 * Perform form validation and print errors, if any. User goes back to
 * signup page, if any errors persist, for refilling form correctly this time.
 * ---------------------------------------------------------------------------#
 *
 */
function form_validation($uname, $pwd, $email, $dob, $sex, $state, $city, $news) {
	$error_message = "";
	
	$error_message = validate_username ( $uname, $error_message );
	$error_message = validate_password ( $pwd, $error_message );
	$error_message = validate_email ( $email, $error_message );
	$error_message = validate_dob ( $dob, $error_message );
	$error_message = validate_sex ( $sex, $error_message );
	$error_message = validate_state ( $state, $error_message );
	$error_message = validate_city ( $city, $error_message );
	$error_message = validate_newsletter ( $news, $error_message );
	
	if ($error_message) {
		echo "<br>I am sorry, but you haven't filled the form correctly. Please check the following.<br><br>" . $error_message;
		// echo "I am now redirecting you to the previous page. Please fill it correctly this time.";
		// header ( "Location: ../Client/signup.html" );
		
		return 0;
	} 

	else {
		return 1;
	}
}

/*
 * #--------------------------------------------------------------------------#
 * # Validate username field
 * #--------------------------------------------------------------------------#
 */
function validate_username($uname, $error_message) {
	$pattern = '/[A-Za-z0-9\']{6,50}/';
	if (! $uname) {
		$error_message .= "Please enter username. <br>";
	} else if (0 === preg_match ( $pattern, $uname )) {
		$error_message .= "Please enter username between 6-50 alnum characters. <br>";
	}
	
	return $error_message;
}

/*
 * #--------------------------------------------------------------------------#
 * # Validate password field
 * #--------------------------------------------------------------------------#
 */
function validate_password($pwd, $error_message) {
	$pattern = '/[A-Za-z0-9\']{6,50}/';
	if (! $pwd) {
		$error_message .= "Please enter password. <br>";
	} else if (0 === preg_match ( $pattern, $pwd )) {
		$error_message .= "Please enter password between 6-50 alnum characters. <br>";
	}
	
	return $error_message;
}

/*
 * #--------------------------------------------------------------------------#
 * # Validate email field
 * #--------------------------------------------------------------------------#
 */
function validate_email($email, $error_message) {
	$len = strlen ( $email );
	
	if (! $email) {
		$error_message .= "Please enter email address. <br>";
	} else {
		if (1 === preg_match ( '/@/', substr ( $email, 1, 1 ) )) {
			$error_message .= "Only 1 character entered before at. Please enter at least 2 for valid email ID <br>";
		} else if (1 === preg_match ( '/\./', substr ( $email, 1, 1 ) )) {
			$error_message .= "Only 1 character entered before dot. Please enter at least 2 for valid email ID <br>";
		} else if (1 === preg_match ( '/@/', substr ( $email, 0, 1 ) )) {
			$error_message .= "No characters entered! Enter at least 2 for valid email ID <br>";
		} else if ((1 === preg_match ( '/\./', substr ( $email, 0, 1 ) ))) {
			$error_message .= "No characters entered! Enter at least 2 for valid email ID <br>";
		} else if (1 === preg_match ( '/@/', substr ( $email, $len - 1, 1 ) )) {
			$error_message .= "Not a valid email ID valid <br>";
		} else if (1 === preg_match ( '/\./', substr ( $email, $len - 1, 1 ) )) {
			$error_message .= "Not a valid email ID valid <br>";
		}
	}
	
	$i;
	$dot_count = 0;
	$at_count = 0;
	
	for($i = 0; $i < $len; $i ++) {
		$char = substr ( $email, $i, 1 );
		
		if (0 === strcmp ( $char, "@" )) {
			$at_count ++;
		} else if (0 === strcmp ( $char, "." )) {
			$dot_count ++;
		}
	}
	
	if ($dot_count != 1) {
		$error_message .= "At least one . required<br>";
	} else if ($at_count != 1) {
		$error_message .= "At least one @ required<br>";
	}
	
	return $error_message;
}

/*
 * #--------------------------------------------------------------------------#
 * # Validate Date of Birth field
 * #--------------------------------------------------------------------------#
 */
function validate_dob($dob, $error_message) {
	$len = strlen ( $dob );
	
	if (! $dob) {
		$error_message .= "Please enter date of birth. <br>";
	} else if ($len != 10) {
		$error_message .= "Please enter date in the format of mm[-:/]dd[-:/]yyyy <br>";
	} else if (0 === preg_match ( '/[-:\/]/', substr ( $dob, 2, 1 ) )) {
		$error_message .= "Please enter : or - or / as delimiters <br>";
	} else if (0 === preg_match ( '/[-:\/]/', substr ( $dob, 5, 1 ) )) {
		$error_message .= "Please enter : or - or / as delimiters <br>";
	}
	
	$i = 0;
	for(; $i < $len; $i ++) {
		if (0 === preg_match ( '/[-:\/0-9]/', substr ( $dob, $i, 1 ) )) {
			$error_message .= "Only : or - or / or 0-9 characters allowed. <br>";
			break;
		}
	}
	return $error_message;
}

/*
 * #--------------------------------------------------------------------------#
 * # Validate sex field
 * #--------------------------------------------------------------------------#
 */
function validate_sex($sex, $error_message) {
	if (! $sex) {
		$error_message .= "Please check one sex. <br>";
	}
	
	return $error_message;
}

/*
 * #--------------------------------------------------------------------------#
 * # Validate state field
 * #--------------------------------------------------------------------------#
 */
function validate_state($state, $error_message) {
	$pattern = '/[A-Za-z0-9\']/';
	if (! $state) {
		$error_message .= "Please enter state. <br>";
	} else if (0 === preg_match ( $pattern, $state )) {
		$error_message .= "Please enter state in alnum characters. <br>";
	}
	
	return $error_message;
}

/*
 * #--------------------------------------------------------------------------#
 * # Validate state field
 * #--------------------------------------------------------------------------#
 */
function validate_city($city, $error_message) {
	$pattern = '/[A-Za-z0-9\']/';
	if (! $city) {
		$error_message .= "Please enter city. <br>";
	} else if (0 === preg_match ( $pattern, $city )) {
		$error_message .= "Please enter city in alnum characters. <br>";
	}
	
	return $error_message;
}

/*
 * #--------------------------------------------------------------------------#
 * # Validate newsletter field
 * #--------------------------------------------------------------------------#
 */
function validate_newsletter($news, $error_message) {
	if (! $news) {
		$error_message .= "Please check newsletter. <br>";
	}
	return $error_message;
}

?>