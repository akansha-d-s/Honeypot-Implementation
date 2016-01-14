<?php error_reporting(E_ERROR); ?>

<?php
/*
 * ============================================================================
 *
 * #name: 			index.php
 *
 * #package: 		Client
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
 * Description: 	Invoke the client application (signup.html)
 *
 * ============================================================================
 */
?>

<html>
<head>
<title>IDPS</title>
</head>
<body>

<?php
// Server starts from the select.php page to view the logs or reports
header ( "Location: signup.html" );
?>

</body>
</html>
