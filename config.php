<?php error_reporting(E_ERROR); ?>
<?php

/*
 * ============================================================================
 *
 * #name: 			config.php
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
 * Description: 	The configuration module to connect to the database Honeypot
 *
 * ============================================================================
 */

/*
 * The constants required for establishing connection
 */
$database = "Honeypot";
$hostname = "localhost";
$username = "root";
$password = "";

/*
 * Connect to the database using mysql_connect. Use the constants from above
 */
$dbc = mysql_connect ( $hostname, $username, $password );
if (! $dbc)
	die ( 'Could not connect: ' . mysql_error () );

else
	$db = mysql_select_db ( $database, $dbc );

?>