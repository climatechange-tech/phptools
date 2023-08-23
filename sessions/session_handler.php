<?php

function start_session() {
	session_start();
}

function destroy_session() {
	$_SESSION = array();
	session_destroy();
}

function user_logout() {

	// Load variables belonging to the session array //
	start_session();
	
	// Reset session array //
	$_SESSION = array(); 
	
	// Destroy session //
	session_destroy();   
	
}
	
?>
