<?php error_reporting(E_ERROR); ?>
<?php

/*
 * ============================================================================
 *
 * #name: 			sanitize.php
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
 * Description: HTML Data Sanitizer (encode or decode strings as HTML entities
 * This can be used to potentially prevent Code Injection. We have performed a
 * similar functionality)
 *
 * ============================================================================
 */

/*
 * #---------------------------------------------------------------------------#
 * # Sanitize the username and return sanitized username
 * #---------------------------------------------------------------------------#
 */
function sanitize_username($uname) {
	$uname = sanitize ( $uname );
	return $uname;
}

/*
 * #---------------------------------------------------------------------------#
 * # Sanitize the password and return sanitized password
 * #---------------------------------------------------------------------------#
 */
function sanitize_password($pwd) {
	$pwd = sanitize ( $pwd );
	return $pwd;
}

/*
 * #---------------------------------------------------------------------------#
 * # Sanitize the message and return sanitized message
 * #---------------------------------------------------------------------------#
 */
function sanitize_message($message) {
	$message = sanitize ( $message );
	return $message;
}

/*
 * #---------------------------------------------------------------------------#
 * # Sanitize the string passed to this sub-routine. Goal here is to sanitize
 * # the string containing <, >, &, ", ', and /, as these characters are used to
 * # perform malicious activities.
 * #---------------------------------------------------------------------------#
 */
function sanitize($string) {
	$string = str_replace ( "&", "&amp", $string );
	$string = str_replace ( "<", "&lt", $string );
	$string = str_replace ( ">", "&gt", $string );
	$string = str_replace ( "\"", "&quot", $string );
	$string = str_replace ( "'", "&#039;", $string );
	$string = str_replace ( "/", "&#x2F", $string );
	
	return $string;
}

?>