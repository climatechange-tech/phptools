<?php
	function case_modifier($string, $case_option, $splitchar=NULL) {
		$case_modifier_options = ["lower", "upper", "capitalize", "capitalize_all"];
		
		foreach ($case_modifier_options as $cmo) {
			if ($cmo == $case_option) {
				$cmo_check[] = $cmo;
			}
		}
		
		$cmo_check_len = count($cmo_check);
		
		if ($cmo_check_len < 1) {
			print("<p style='color:red'>Wrong case option. Options are:</p>");
			echo("<pre>"); print_r($case_modifier_options); echo("</pre>");	
		}
		
		else {
			if ($case_option == array_key_last($case_modifier_options) && (!$splitchar)) {
				print("<p style='color:red'>You must specify a character 
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
		$split_options = ["trim", "explode", "capitalize", "capitalize_all"];
		
		foreach ($split_options as $so) {
			if ($so == $method) {
				$so_check[] = $so;
			}
		}
		
		$so_check_len = count($so_check);
		
		if ($so_check_len < 1) {
			print("<p style='color:red'>Wrong string splitting option. Options are:</p>");
			echo("<pre>"); print_r($split_options); echo("</pre>");
		}
		
		else {
			if (!$splitchar) {
				print("<p style='color:red'>You must specify a character for string splitting.</p>");
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
?>
