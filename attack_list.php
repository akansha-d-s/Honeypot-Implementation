<?php error_reporting(E_ERROR); ?>
<?php

/*
 * ============================================================================
 *
 * #name: 			attack_list.php
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
 * Description: 	The list of all the possible attacks that can be performed
 * on the application.
 *
 * ============================================================================
 */
function check_blacklist($uname, $pwd) {
	// echo "uname is $uname";
	// echo "pwd is $pwd";
	
	/*
	 * #--------------------------------------------------------------------------#
	 *
	 * # Database of the attacks that can be performed on the system. This is not
	 * # an exhaustive list, by any means. Extensive research still needs to be done
	 * # in order to come up with a substantial amount of data that hackers used for
	 * # code injection
	 * #--------------------------------------------------------------------------#
	 */
	$attacklist = array (
			"../" => "dir-change",
			"/.." => "dir-change",
			"select" => "SQL",
			"insert" => "SQL",
			"update" => "SQL",
			"delete" => "SQL",
			"union" => "SQL",
			"trigger" => "SQL",
			"from" => "SQL",
			"where" => "SQL",
			"or" => "SQL",
			"and" => "SQL",
			"drop" => "SQL",
			"<script>" => "XSS",
			"</script>" => "XSS",
			"javascript" => "XSS",
			"'" => "injection",
			"`" => "injection",
			"?" => "injection",
			"`id`" => "injection",
			"uname" => "injection",
			"who" => "injection",
			"ifconfig" => "injection",
			"http://" => "inclusion",
			"https://" => "inclusion",
			"include" => "inclusion",
			"passthru" => "inclusion",
			"exec" => "inclusion",
			"wget" => "wget",
			"curl" => "curl",
			"echo" => "deface" 
	);
	
	/*
	 * ---------------------------------------------------------------------------#
	 * Globally checks (ignoring case) if the string entered by the user is
	 * contained in the hash attacklist. If yes, then return the type of attack
	 * required to be entered in the database table
	 * ---------------------------------------------------------------------------#
	 */
	
	$errors = array ();
	
	if (is_array ( $attacklist )) {
		foreach ( $attacklist as $attack => $attack_type ) {
			if (1 == preg_match ( "/$attack/i", $uname )) {
				array_push ( $errors, $attack_type );
			} else if (1 == preg_match_all ( "/$attack/i", $pwd )) {
				array_push ( $errors, $attack_type );
			}
		}
		
		return $errors;
	}
}
?>
