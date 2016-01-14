<?php error_reporting(E_ERROR); ?>
<?php include_once ('config.php'); ?>

<?php

/*
 * ============================================================================
 *
 * #name: 			print_user.php
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
 * Description: 	Prints the user details, if it exists.
 *
 * ============================================================================
 */

/*
 * #---------------------------------------------------------------------------#
 * # Prints the user's details from the users table after establishing
 * # connection with the database Honeypot
 * #---------------------------------------------------------------------------#
 */
function print_user_details($uname, $pwd, $attack) {
	$select = "select * FROM users where uname = '$uname' and pwd = '$pwd'";
	
	$query = mysql_query ( $select );
	
	$record = 0;
	if ($query) {
		while ( $row = mysql_fetch_assoc ( $query ) ) {
			echo "<h2>Record # " . $record ++ . "</h2>";
			echo "Username: " . $row ["uname"] . "<br>";
			echo "Password: " . $row ["pwd"] . "<br>";
			echo "Email: " . $row ["email"] . "<br>";
			echo "Date of Birth: " . $row ["dob"] . "<br>";
			echo "Sex: " . $row ["sex"] . "<br>";
			echo "State: " . $row ["state"] . "<br>";
			echo "City: " . $row ["city"] . "<br>";
			echo "Newsletter: " . $row ["newsletter"] . "<br><br><br>";
		}
	} else {
		echo "Error: " . $select . "<br>";
	}
}

?>