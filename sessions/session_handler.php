<?php

	//----------------//
	// Import modules //
	//----------------//

	// Import module that finds the PHP tool path //
	//--------------------------------------------//
	
	// Home path //
	$home_path = "/home/jonander";

	// Define the path of the file that searches for the mentioned tools //
	$phptools_finder_file =  "get_phptools_path.php";
	$phptools_finder_path = $home_path . "/" . $phptools_finder_file;

	// Perform the importation //
	include($phptools_finder_path);

	// Import custom modules //
	//-----------------------//

	// Enumerate the modules //
	$custom_mod1_path = $fixed_path . "/" . "web_navigation";

	// Enumerate the files associated to these modules //
	$custom_mod1_file1 = $custom_mod1_path . "/" . "page_navigator.php";

	// Perform the importations //
	include($custom_mod1_file1);
	
	//-----------------------//
	// Define custom modules //
	//-----------------------//

	function start_session() {
		session_start();
	}
	
	function destroy_session() {
		$_SESSION = array();
		session_destroy();
	}

	function user_logout($start_page) {

		// Load variables belonging to the session array //
		start_session();
		
		// Reset session array //
		$_SESSION = array(); 
		
		// Destroy session //
		session_destroy();   
		
		// Redirect to the input page and exit //
		redirect_to_page($start_page);
		exit;
	}
	
	

?>
