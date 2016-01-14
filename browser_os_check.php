<?php error_reporting(E_ERROR); ?>
<?php

/*
 * ============================================================================
 *
 * #name: 			browser_os_check.php
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
 * Description: 	This module checks for the browser and operating system of the
 * client attempting to log into the system. Similar to get_broswer()
 *
 * ============================================================================
 */
function detect_browser_os() {
	$u_agent = $_SERVER ['HTTP_USER_AGENT'];
	$browser = "Unknown";
	$os = "Unknown";
	
	/*
	 * Detect the OS
	 */
	if (1 == preg_match ( '/linux/i', $u_agent )) {
		$os = "Linux";
	} elseif (1 == preg_match ( '/macintosh|mac os x/i', $u_agent )) {
		$os = "Macintosh";
	} elseif (1 == preg_match ( '/windows|win32/i', $u_agent )) {
		$os = "Windows";
	}
	
	/*
	 * Detect the Web browser
	 */
	if (1 == preg_match ( '/MSIE/i', $u_agent )) {
		$browser = 'Internet Explorer';
	} elseif (1 == preg_match ( '/Firefox/i', $u_agent )) {
		$browser = 'Mozilla Firefox';
	} elseif (1 == preg_match ( '/Chrome/i', $u_agent )) {
		$browser = 'Google Chrome';
	} elseif (1 == preg_match ( '/Safari/i', $u_agent )) {
		$browser = 'Apple Safari';
	} elseif (1 == preg_match ( '/Opera/i', $u_agent )) {
		$browser = 'Opera';
	} elseif (1 == preg_match ( '/Netscape/i', $u_agent )) {
		$browser = 'Netscape';
	}
	
	/*
	 * Array of browser and OS
	 */
	$broswer_os = array (
			$browser,
			$os 
	);
	
	return $broswer_os; // return the array
}
?>