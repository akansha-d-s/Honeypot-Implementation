<?php error_reporting(E_ERROR); ?>
<?php include_once ('config.php'); ?>

<?php

/*
 * ============================================================================
 *
 * #name: 			select.php
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
 * Description: The select module that selects * from users
 *
 * ============================================================================
 */

/*
 * #---------------------------------------------------------------------------#
 * # This script is used by the the server or system adminitrastor to select the
 * # record from the database table to check for malicious attacks performed.
 * # This basically displays log of all logins that were attempted in the system
 * # Prints user details - username, password, host name, IP address, web browser
 * # , OS, request parameter and login type for every user using HTML table tag
 * #---------------------------------------------------------------------------#
 */
$select = "select * FROM logins";

$query = mysql_query ( $select );

$record = 0;
if ($query) {
	echo "<table> <tr> <th> ID </th> <th> Username </th> <th> Password </th> <th> Host </th> <th> IP </th> <th> Browser </th> <th> OS </th> <th> Request </th> <th> Login </th> </tr>";
	while ( $row = mysql_fetch_assoc ( $query ) ) {
		echo "<tr>";
		echo "<td>" . $row ["id"] . "</td>";
		echo "<td>" . $row ["uname"] . "</td>";
		echo "<td>" . $row ["pwd"] . "</td>";
		echo "<td>" . $row ["host"] . "</td>";
		echo "<td>" . $row ["ip"] . "</td>";
		echo "<td>" . $row ["browser"] . "</td>";
		echo "<td>" . $row ["os"] . "</td>";
		echo "<td>" . $row ["request"] . "</td>";
		echo "<td>" . $row ["login"] . "</td>";
		echo "</tr>";
	}
	echo "</table>";
} else {
	echo "Error: " . $select . "<br>";
}

?>