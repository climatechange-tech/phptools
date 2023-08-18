<?php

function find_substring($string,
						$pattern2find,
						$advanced_search=False,
						$find_whole_words=False,
						$all_matches=False,
						$matches=NULL,
						$flags=0,
						$offset=0) {
	
	if ($advanced_search) {
	
		if (!$all_matches) {
			$result = preg_match($pattern2find, $string, $matches, $flags, $offset);
			}
		else {
			$result = preg_match_all($pattern2find, $string, $matches, $flags, $offset);
		}
	}
	
	else {
	
		if (gettype($pattern2find) !== "array") {
			$result = str_contains($string, $pattern2find);
		}
		
		else {
			$result = in_array($string, $pattern2find);
		}
	}
	
	return $result;
}


function substring_replacer($string, 
							$pattern2find,
							$pattern2replace,
							$advanced_search=False,
							$limit=-1,
							$count=NULL) {
	
	if ($advanced_search) {
		$replaced_string = preg_replace($pattern2find,
										$pattern2replace,
										$string,
										$limit,
										$count);
		return $replaced_string;
	}
	
	else {
		$replaced_string = str_replace($pattern2find,
									   $pattern2replace,
									   $string,
									   $count);
	    return $replaced_string;
	}
}

/*
    

def substring_replacer(string, string2find, string2replace, count=-1):
    
    if isinstance(string, str):
        string_replaced = string.replace(string2find, string2replace, count)
        
    elif isinstance(string, list) or isinstance(string, np.ndarray):
        if isinstance(string, list):
            string = np.array(string)
        string_replaced = np.char.replace(string, string2find, string2replace)
        
    elif isinstance(string, pd.DataFrame):
        string_replaced = pd.DataFrame.replace(string, string2find, string2replace)
        
    elif isinstance(string, pd.Series):
        string_replaced = pd.Series.replace(string, string2find, string2replace)
    
    return string_replaced
*/
	

function check_string_case_basic($string, $case="all_lower") {

	$case_options = ["all_lower", "all_upper"];
	if (!in_array($case, $case_options)) {
		print("<p style='color:red'>Wrong case identifier option. Options are:</p>");
		echo("<pre>"); print_r($case_options); echo("</pre>");
		exit;
	}
	
	if ($case === "all_lower") {
		$areAllCharsCase = ctype_lower($string);
	}
	else if ($case === "all_upper") {
		$areAllCharsCase = ctype_upper($string);
	}
	return $areAllCharsCase;

}

/*

def find_substring_index(string,
                         substring, 
                         advanced_search=False,
                         find_whole_words=False,
                         case_sensitive=False,
                         all_matches=False):
    
    // substring: str or list of str
    //       If 'str' then it can either be as is or a regex.
    //       In the latter case, there is no need to explicitly define as so,
    //       because it connects with Python's built-in 're' module.

    if isinstance(string, str):        
        if advanced_search:
            substrLowestIdx = string_VS_string_search(string, substring, 
                                                      find_whole_words,
                                                      case_sensitive,
                                                      all_matches)
        else:
            substrLowestIdx = np.char.find(string,
                                           substring,
                                           start=0,
                                           end=None)
            

    elif isinstance(string, list)\
    or isinstance(string, tuple)\
    or isinstance(string, np.ndarray):
        
        if isinstance(string, tuple):
            string = list(string)
        
        if not advanced_search:
            if isinstance(substring, str):
                substrLowestIdxNoFilt = np.char.find(string, 
                                                     substring, 
                                                     start=0,
                                                     end=None)

                substrLowestIdx = np.where(substrLowestIdxNoFilt!=-1)[0].tolist()
           
            elif isinstance(substring, list)\
            or isinstance(substring, tuple)\
            or isinstance(substring, np.ndarray):
                
                if isinstance(substring, tuple):
                    substring = list(substring)
                
                substrLowestIdx\
                = stringList_VS_stringList_search_wholeWords(string,
                                                             substring, 
                                                             start=0,
                                                             end=None)
                
        else:
            if isinstance(substring, str):
                substrLowestIdxNoFilt\
                = np.array([string_VS_string_search(s_el, substring,
                                                    find_whole_words,
                                                    case_sensitive, 
                                                    all_matches)
                            for s_el in string])
                
                substrLowestIdx = np.where(substrLowestIdxNoFilt!=-1)[0].tolist()
                
                
            elif isinstance(substring, list)\
            or isinstance(substring, tuple)\
            or isinstance(substring, np.ndarray):
                
                if isinstance(substring, tuple):
                    substring = list(substring)
                
                substrLowestIdx\
                = stringList_VS_stringList_search_wholeWords(string, 
                                                             substring,
                                                             start=0, 
                                                             end=None)
             
                substrLowestIdxNoFilt\
                = np.array([[string_VS_string_search(s_el, sb_el,
                                                     find_whole_words,
                                                     case_sensitive,
                                                     all_matches)
                             for s_el in string]
                            for sb_el in substring])
                
                substrLowestIdx = np.where(substrLowestIdxNoFilt!=-1)[-1].tolist()
                
            
    elif isinstance(string, pd.DataFrame) or isinstance(string, pd.Series):
        try:
            substrLowestIdxNoFilt = string.str.contains[substring].index
        except:
            substrLowestIdxNoFilt = string.iloc[:,0].str.contains[substring].index
        
        substrLowestIdx = substrLowestIdxNoFilt[substrLowestIdxNoFilt]
        print(substrLowestIdx)
        
    
    if isinstance(substrLowestIdx, list) and len(substrLowestIdx) == 0:
        return -1
    elif isinstance(substrLowestIdx, list) and len(substrLowestIdx) == 1:
        return substrLowestIdx[0]
    else:
        return substrLowestIdx

*/


function case_modifier($string, $case_option, $splitchar=NULL) {

	$case_modifier_options = ["lower", "upper", "capitalize", "capitalize_all"];
	
	if (!in_array($case_option, $case_modifier_options)) {
		print("<p style='color:red'>Wrong case option. Options are:</p>");
		echo("<pre>"); print_r($case_modifier_options); echo("</pre>");	
		exit;
	}
	
	else {
		if ($case_option == array_key_last($case_modifier_options) && (!$splitchar)) {
			die("<p style='color:red'>You must specify a character 
				  for string splitting in order to capitalize every word.</p>");
		}
		
		else {
			// Most used case //
			$string_lower = strtolower($string);
			
			switch ($case_option) {
				
				case "lower":
					$string_case = $string_lower;
				case "upper":
					$string_case = strtoupper($string);
				case "capitalize":
	   				$string_case = ucfirst($string_lower);
   				case "capitalize_all":
   					$string_case = ucwords($string_lower, $splitchar);
			}
			
			return $string_case;
		}
	}	
} 

function string_splitter($splitchar, $method = "split") {
	$method_options = ["trim", "explode"];
	
	if (!in_array($method, $method_options)) {
		print("<p style='color:red'>Wrong string splitting method. Options are:</p>");
		echo("<pre>"); print_r($split_options); echo("</pre>");
		exit;
	}
	
	else {
		if (!$splitchar) {
			die("<p style='color:red'>You must specify a character for string splitting.</p>");
		}
		
		else {			
			if ($method == "trim") {
				$str_splitted = trim($string, $splitchar);
			}
			
			else if ($method == "explode") {
				$str_splitted = explode($splitchar, $string);
			}
			
			return $str_splitted;
		}
	}
}

function get_obj_specs($file) {

	$file_parts = pathinfo($file);
	
	$file_parent = $file_parts['dirname'];
	$file_name = $file_parts['basename'];
	$file_name_noext = $file_parts['filename'];
	$file_ext = $file_parts['extension'];
	
	/* PYTHON equivalent
	--------------------
	
    if obj_spec_key not in objSpecsKeys_short:
    raise ValueError(f"Wrong '{arg_names[osk_arg_pos]}' option. "
                     f"Options are {objSpecsKeys_short}.")
        
    if not isinstance(obj_path, dict):
        obj_specs_dict = obj_path_specs(obj_path, splitchar)
    
    if obj_spec_key == "parent":
        osk = objSpecsKeys[0]
        
    elif obj_spec_key == "name":
        osk = objSpecsKeys[1]
    
    elif obj_spec_key == "name_noext":
        osk = objSpecsKeys[2]
        
    elif obj_spec_key == "name_noext_parts" and splitchar is not None:
        osk = objSpecsKeys[3]
        
    elif obj_spec_key == "name_noext_parts" and splitchar is None:
        raise ValueError("You must specify a string-splitting character "
                         f"if '{arg_names[osk_arg_pos]}' == {obj_spec_key}.")
        
    elif obj_spec_key == "ext":
        osk = objSpecsKeys[4]
    
    obj_spec = obj_specs_dict[osk]
    return obj_spec
	*/

}


/*
def obj_path_specs(obj_path, splitchar=None):
    
    obj_PATH = Path(obj_path)
    
    obj_path_parent = obj_PATH.parent
    obj_path_name = obj_PATH.name
    obj_path_name_noext = obj_PATH.stem
    obj_path_ext = obj_PATH.suffix[1:]
    
    obj_specs_dict = {
        objSpecsKeys[0] : obj_path_parent,
        objSpecsKeys[1] : obj_path_name,
        objSpecsKeys[2] : obj_path_name_noext,
        objSpecsKeys[4] : obj_path_ext
        }
    
    if splitchar is not None:
        obj_path_name_noext_parts = obj_path_name_noext.split(splitchar)
        addItemDict = {objSpecsKeys[3] : obj_path_name_noext_parts}
        obj_specs_dict.update(addItemDict)
        
    return obj_specs_dict

*/

//------------------//
// Local parameters //
//------------------//

//objSpecsKeys = ["obj_path_parent",
//                "obj_path_name", 
//                "obj_path_name_noext",
//                "obj_path_name_noext_parts",
//                "obj_path_ext"];

//objSpecsKeys_short = [substring_replacer(s, "obj_path_", "")
//                      for s in objSpecsKeys];

?>
