<?php error_reporting(E_ERROR); ?>
<?php include ('insert_login.php'); ?>
<?php include ('attack_list.php');?>
<?php include ('sanitize.php'); ?>

<?php
/*
 * ============================================================================
 *
 * #name: 			check_login.php
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
 * Description: 	The login form validation
 *
 * ============================================================================
 */

/*
 * ---------------------------------------------------------------------------#
 * If the form is not submitted then the user got in this program by mistake.
 * If form successfully submitted then perform form validation if validator
 * checkbox's value is allow. Likewise, perform code injection if its checkbox
 * value is allow. Perform user-entered string check here invoking
 * check_blacklist sub-routine to determine if user is malicious. After all
 * tests, submit the login form
 * ---------------------------------------------------------------------------#
 */
if ($_POST ['submit']) {
	$uname = $_POST ['uname'];
	$pwd = $_POST ['pwd'];
	$message = $_POST ['message'];
	$injection = $_POST ['injection'];
	$validation = $_POST ['validation'];
	
	$success = 0;
	if (0 == strcmp ( $validation, "allow" )) {
		$success = form_validation ( $uname, $pwd, $message, $injection );
	} else if (0 == strcmp ( $validation, "block" )) {
		$success = 1;
	}
	
	if ($success == 1) {
		$attack = check_blacklist ( $uname, $pwd );
		$user_details = strict_form_checking ( $injection, $uname, $pwd, $message );
		$uname = $user_details [0];
		$pwd = $user_details [1];
		submit_form ( $uname, $pwd, $attack );
	}
} else {
	echo "<h2>Hmm...I think you reached this page by mistake.</h2>";
}

/*
 * ---------------------------------------------------------------------------#
 * Perform HTML sanitizing if code injection is blocked. While sanitizing data,
 * ensure that suspicious characters are subsitututed or encoded with
 * respective HTML character entities
 * ---------------------------------------------------------------------------#
 *
 */
function strict_form_checking($injection, $uname, $pwd, $message) {
	if (0 == strcmp ( $injection, "block" )) {
		
		$uname = sanitize_username ( $uname );
		$pwd = sanitize_password ( $pwd );
		$message = sanitize_message ( $message );
	}
	
	echo "username is: " . $uname . "<br>";
	echo "password is: " . $pwd . "<br>";
	echo "message is: " . $message . "<br>";
		
	$user_details = array (
			$uname,
			$pwd 
	);
	
	return $user_details;
}

/*
 * ---------------------------------------------------------------------------#
 * Perform form validation here and print errors, if any. Show user on the
 * next page the errors and go to login page for successful form submission
 * ---------------------------------------------------------------------------#
 */
function form_validation($uname, $pwd, $message, $injection) {
	$error_message = "";
	
	$error_message = validate_username ( $uname, $error_message );
	$error_message = validate_password ( $pwd, $error_message );
	$error_message = validate_message ( $message, $error_message );
	$error_message = validate_injection ( $injection, $error_message );
	
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
	} else if (0 == preg_match ( $pattern, $uname )) {
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
	} else if (0 == preg_match ( $pattern, $pwd )) {
		$error_message .= "Please enter password between 6-50 alnum characters. <br>";
	}
	
	return $error_message;
}

/*
 * #--------------------------------------------------------------------------#
 * # Validate newsletter field
 * #--------------------------------------------------------------------------#
 */
function validate_message($message, $error_message) {
	if (! $message) {
		$error_message .= "Please enter some message. <br>";
	}
	return $error_message;
}

/*
 * #--------------------------------------------------------------------------#
 * # Validate newsletter field
 * #--------------------------------------------------------------------------#
 */
function validate_injection($injection, $error_message) {
	if (! $injection) {
		$error_message .= "Please check either allow or block code injection. <br>";
	}
	return $error_message;
}

?>
