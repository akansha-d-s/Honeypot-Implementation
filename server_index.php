<?php error_reporting(E_ERROR); ?>
<?php include_once ('config.php'); ?>

<?php
/*
 * ============================================================================
 *
 * #name: 			index.php
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
 * Description: 	Invoke the server application (select.php)
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
header ( "Location: select.php" );
?>

</body>
</html>