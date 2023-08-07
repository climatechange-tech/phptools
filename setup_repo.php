<?php

/*
  **Note**
  --------
  Run this program if it is the first time using the repository
  or it has been re-cloned.
*/


//------------------//
// Input parameters //
//------------------//

// Server array containing some key paths (localhost) //
$server_arr = $_SERVER;

// Home path //
$home_path = $server_arr["HOME"];

// Default path (same as the current one) 
$default_path = getcwd();

// Path establisher function replica //
$custom_path_establisher_func = "function return_custom_path() {
    custom_path = '%s' <br>
    return custom_path; <br>
}
";

// Repo path retriever file attributes //
$custom_path_retriever_name = "get_phptools_path.php";
$custom_path_retriever_path = $home_path . "/" . $custom_path_retriever_name;

//------------------//
// Define functions //
//------------------//

function remove_entire_directories($directories) {

	if (gettype($directories) === "string") {
		$directories = array($directories);
	}
	
	foreach ($directories as $dir) {
		if (is_dir($dir)) {
			$files = scandir($dir);
			
			foreach ($files as $file) {
				if ($file != "." && $file != "..") {
					remove_entire_directories("$dir/$file");
				}
			}
			rmdir($dir);
		}
		else if (file_exists($dir)) {
			unlink($dir);
		}
	}
} 


function copy_entire_directories($source_directories, $destination_directories) {
	
	if (file_exists($destination_directories)) {
		remove_entire_directories($destination_directories);
	}
	
	if (is_dir($source_directories)) {
		mkdir($destination_directories);
		$files = scandir($source_directories);
		
		foreach ($files as $file) {
			if ($file != "." && $file != "..") {
				copy_entire_directories("$source_directories/$file", "$destination_directories/$file");
			}
		}
	}
	else if (file_exists($source_directories)) {
		copy($source_directories, $destination_directories);
	}
}


//----------------//
// Operation part //
//----------------//

// If the form is already sent //
//-----------------------------//

if (isset($_POST["save"])) {

	$custom_path = $_REQUEST["custom_path"];
	lcp = strlen($custom_path)

	// If the default path is left written, then set the path to the default one //
	//---------------------------------------------------------------------------//

	if ($custom_path == $default_path) {
		$custom_path = $default_path;
	}
		
	// Otherwise, move the repo to the specified path //
	//------------------------------------------------//

	else {
		
		// Define custom path with the directory as the current, default one //
		$default_dir = basename($default_path);
		$customPathWithDefaultDir = $custom_path . "/". $default_dir; 		
		
		$copy_stat = copy_entire_directories($default_path, $customPathWithDefaultDir)
		
		if ($copy_stat === True) {
			printf("Path changed from '%s' to '%s'", $default_path, $custom_path);
		}
		else 
			printf("<span style='color:red'>Could not change path from '%s' to '%s'</span>", $default_path, $custom_path);
			
		chdir("$default_path/..")
		$remove_stat = remove_entire_directories($default_path)
		
		if ($remove_stat === True) {
			printf("Successfully deleted default path '%s'", $default_path);
		}
		else {
			printf("<span style='color:red'>Could not delete default_path '%s'</span>", $default_path);
		}
	}
}
		
//------------------------------------------------------------------------------//
// In either case, write a file containing a function that returns the path set //
//------------------------------------------------------------------------------//

"""
All modules are optimized so that the file that returns the path of this repo
is stored at /home directory.
"""

$custom_path_retriever = fopen($custom_path_retriever_path,'w');
fwrite(sprintf($custom_path_establisher_func, $custom_path));
fclose($custom_path_retriever);

?>

<HTML>
	<BODY>
		<FORM ACTION="setup_repo.php" METHOD="POST">
		
			Where do you want to establish the repository? 
			<INPUT TYPE="TEXT" NAME="custom_path" VALUE="[<?php $default_path?>]">
			
			<br>
			<INPUT TYPE="SUBMIT" NAME="set" VALUE="Set">
			<INPUT TYPE="RESET" VALUE="Reset">
		</FORM>		
	</BODY>
</HTML>
