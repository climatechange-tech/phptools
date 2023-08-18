<?php

//----------------//
// Import modules //
//----------------//

// Import module that finds PHP tools' path //
//------------------------------------------//

// Server array containing some key paths (localhost) //
$server_arr = $_SERVER;

// Home path //
$home_path = $server_arr["HOME"];

// Define the tool finder file path //
$phptools_finder_file =  "get_phptools_path.php";
$phptools_finder_path = $home_path . "/" . $phptools_finder_file;

// Perform the importation //
include($phptools_finder_path);

// Import custom modules //
//-----------------------//

// Enumerate the custom modules and their paths //
$custom_mod_path = $fixed_path . "/" . "files_and_directories";

// Enumerate the files associated with these custom modules and their paths //
$custom_mod_file = $custom_mod_path . "/" . "file_and_directory_paths.php";

// Perform the importations //
include($custom_mod_file);

//------------------//
// Define functions //
//------------------//

// Operations involving files //
//----------------------------//

/*

def move_files(source_files, destination_directories):
    
    source_files = [posixpath_converter(sf, glob_bool=False)
                    for sf in source_files]
    
    if isinstance(source_files, list)\
    and isinstance(destination_directories, list):
        
        for sf, dd in zip(source_files, destination_directories):
            file_name_nopath = sf.name
            shutil.move(sf, f"{dd}/{file_name_nopath}")
            
    elif isinstance(source_files, list)\
    and not isinstance(destination_directories, list):
        
        for sf in source_files:
            file_name_nopath = sf.name
            shutil.move(sf, f"{destination_directories}/{file_name_nopath}")
    
    elif not isinstance(source_files, list)\
    and isinstance(destination_directories, list):
        
        for dd in destination_directories:
            file_name_nopath = source_files.name
            shutil.move(source_files, f"{dd}/{file_name_nopath}")
            
    elif not isinstance(source_files, list)\
    and not isinstance(destination_directories, list):
        
        file_name_nopath = source_files.name
        shutil.move(source_files, f"{destination_directories}/{file_name_nopath}")
        
        
def copy_files(source_files, destination_directories):
    
    source_files = [posixpath_converter(sf, glob_bool=False)
                    for sf in source_files]
    
    if isinstance(source_files, list)\
    and isinstance(destination_directories, list):
        
        for sf, dd in zip(source_files, destination_directories):
            file_name_nopath = sf.name
            shutil.copy(sf, f"{dd}/{file_name_nopath}")
            
    elif isinstance(source_files, list)\
    and not isinstance(destination_directories, list):
        
        for sf in source_files:
            file_name_nopath = sf.name
            shutil.copy(sf, f"{destination_directories}/{file_name_nopath}")
    
    elif not isinstance(source_files, list)\
    and isinstance(destination_directories, list):
        
        for dd in destination_directories:
            file_name_nopath = source_files.name
            shutil.copy(source_files, f"{dd}/{file_name_nopath}")
            
    elif not isinstance(source_files, list)\
    and not isinstance(destination_directories, list):
        
        file_name_nopath = source_files.name
        shutil.copy(source_files, f"{destination_directories}/{file_name_nopath}")
    
*/

// Operations involving directories //
//----------------------------------//

function make_parent_directories($directory_list) {
   
    if (gettype(directory_list === "string")):
        $directory_list = array($directory_list);
        
    foreach ($directory_list as $dir) {
    	if (!file_exists($dir)) {
    		mkdir($dir)
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

        
function copy_entire_directories($source_directories,
		                         $destination_directories,
		                         $files_only=False,
		                         $recursive_in_depth=True) {
    
    if ($files_only === False) {
        
        if (gettype(directories) === "array" and gettype($destination_directories) === "array") {
        	foreach ($source_directories as $sd) {
            	foreach ($destination_directories as $dd) {
                    
                    if (file_exists($dd)) {
						remove_entire_directories($dd);
					}
					
					if (is_dir($sd)) {
						mkdir($dd);
						$files = scandir($sd);
						
						foreach ($files as $file) {
							if ($file != "." && $file != "..") {
								copy_entire_directories("$sd/$file", "$dd/$file");
							}
						}
					}
					else if (file_exists($sd)) {
						copy($sd, $dd);
					}
				}
			}
		}
                        
                    
        else if (gettype($source_directories) === "array" and gettype($destination_directories) !== "array"):

			if (file_exists($destination_directories)) {
				remove_entire_directories($destination_directories);
			}
        
            foreach ($source_directories as $sd) {                
				if (is_dir($sd)) {
					if (!file_exists($destination_directories)) {
						mkdir($destination_directories);
					}
					$files = scandir($sd);
					
					foreach ($files as $file) {
						if ($file != "." && $file != "..") {
							copy_entire_directories("$sd/$file", "$destination_directories/$file");
						}
					}
				}
				else if (file_exists($sd)) {
					copy($sd, $destination_directories);
				}
			}
                
           
        else if (gettype($source_directories) !== "array" and gettype($destination_directories) === "array") {        
        	foreach ($destination_directories as $dd) {
                
                if (file_exists($dd)) {
					remove_entire_directories($dd);
				}
				
				if (is_dir($source_directories)) {
					mkdir($dd);
					$files = scandir($source_directories);
					
					foreach ($files as $file) {
						if ($file != "." && $file != "..") {
							copy_entire_directories("$source_directories/$file", "$dd/$file");
						}
					}
				}
				else if (file_exists($source_directories)) {
					copy($source_directories, $dd);
				}
			}  
        }
                    
        else {
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
    }
            
    else {
    	
    	if (gettype($source_directories) === "array" and gettype($destination_directories) === "array") {
            foreach ($source_directories as $sd) {
				foreach ($destination_directories as $dd) {
                    echo shell_exec(sprintf($cp_command, $sd, $dd));
                }       
            }
        }
        
        else if (gettype($source_directories) === "array" and gettype($destination_directories) !== "array") {
            foreach ($source_directories as $sd) {
                echo shell_exec(sprintf($cp_command, $sd, $destination_directories));
            }
        }
                    
        else if (gettype($source_directories) !== "array" and gettype($destination_directories) !== "array") {
			foreach ($destination_directories as $dd) {
                echo shell_exec(sprintf($cp_command, $source_directories, $dd));
            }
        }
                    
        else {
            echo shell_exec(sprintf($cp_command, $source_directories, $destination_directories));
        }   
    }        
}

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


def rsync(source_paths,
          destination_paths,
          mode="arvh",
          delete_at_destination=True,
          source_allfiles_only=False):
    
    for sp, dp in zip(source_paths, destination_paths):
        
        if delete_at_destination and not source_allfiles_only:
            
            zsh_command = f"rsync -{mode} --delete '{sp}' '{dp}'"
            os.system(zsh_command)
            
        elif not delete_at_destination and not source_allfiles_only:
            zsh_command = f"rsync -{mode} '{sp}' '{dp}'"
            os.system(zsh_command)
            
        elif delete_at_destination and source_allfiles_only:
            zsh_command = f"rsync -{mode} --delete '{sp}'/* '{dp}'"
            os.system(zsh_command)
            
        elif not delete_at_destination and source_allfiles_only:
            zsh_command = f"rsync -{mode} '{sp}'/* '{dp}'"
            os.system(zsh_command)
    
/*
def move_entire_directories(directories, destination_directories):
    
    if isinstance(directories, list)\
    and isinstance(destination_directories, list):
        
        for dirc in directories:
            for dd in destination_directories:
                shutil.move(dirc, 
                            dd,
                            copy_function=shutil.copytree)
                    
    elif isinstance(directories, list)\
    and isinstance(destination_directories, list):
            
        len_exts = len(directories)
        len_dds = len(destination_directories)
        
        if len_exts != len_dds:
            raise ValueError("Extension and destination directory lists "
                             "are not of the same length.")
        else:
            for dirc, dd in zip(directories, destination_directories):
                shutil.move(dirc,
                            dd,
                            copy_function=shutil.copytree)
                
    elif isinstance(directories, list)\
    and not isinstance(destination_directories, list):
        for dirc in directories:
            shutil.move(dirc, 
                        destination_directories, 
                        copy_function=shutil.copytree)
                
    elif not isinstance(directories, list)\
    and isinstance(destination_directories, list):        
        for dd in destination_directories:
            shutil.move(directories,
                        dd, 
                        copy_function=shutil.copytree)
                
    else:
        shutil.move(directories, 
                    destination_directories, 
                    copy_function=shutil.copytree)
            
*/
      

// Operations involving both files and directories //
//-------------------------------------------------//

function rename_objects($relative_paths,
                   		$renaming_relative_paths) {

    /*
    
    Function that renames files specified by their absolute paths.
    
    In fact, os.rename can also perform the same tasks as shutil.move does,
    therefore functions 'move_files_byExts_fromCodeCallDir' and
    'move_files_byFS_fromCodeCallDir', including the fact that,
    besides moving a directory or file, it includes the option to
    rename thereof at the destination directory, i.e. altering the
    ultimate part of the absolute path.
    
    However, as a matter of distinguishing among the main usages of the modules,
    and to invoke simple operations, this function will be used
    such that each file or directory will be given another name,
    without altering the absolute path.
    
    Parameters
    ----------
    relative_paths: str or list
          String or list of strings that identify the desired files/directories,
          i.e. the absolute path.
    renaming_relative_paths : str or list
          A string of the file/directory name or a list containing
          several files/directories, i.e the renamed BUT UNALTERED absolute path.
    
    This function distinguishes two cases:
    
      1. Both file names and directories are lists.
          Then it is understood that each string file or directory
          corresponds to another single file or directory and
          it is renamed as commanded. 
          File and directory lists have to be of the same length;
          throws and error otherwise.
      2. None of them are lists.
          Then the matching files will simply be renamed.
          
    */
    
    if (gettype($relative_paths) === "array") and gettype($renaming_relative_paths) === "array") {
        
        $len_files = count($relative_paths)
        $len_rf = count($renaming_relative_paths)
        
        if ($len_files != $len_rf) {
			die("<span style='color:red'>Files and renaming file lists "
				  "are not of the same length.</span>");
		}
         	  
        else {
        	$zip_arr = array_map($relative_paths, $renaming_relative_paths);
        	
        	for ($i = 0; $i < $len_files; $i++) {
        		$rp = $zip_arr[$i][0];
        		$rrp = $zip_arr[$i][1];
                rename($rp, $rrp);
            }
        }   
    }
    
    else if (gettype($relative_paths) !== "array") and gettype($renaming_relative_paths) !== "array") {
        rename($relative_paths, $renaming_relative_paths)
    }
                
    else {
        die("<span style='color:red'>Both input arguments must either be "
         	  "strings or lists simultaneously.</span>");
	}                    
}

//------------------//
// Local parameters //
//------------------//

// Get the directory from where this code is being called //
$cwd = getcwd();
$alldoc_dirpath = dirname($fixed_path);

// Bash 'cp' command //
$cp_command = "cp -rv %s/* %s";

?>
