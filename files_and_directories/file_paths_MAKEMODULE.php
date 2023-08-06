<?php

	$file = "test.php";
	//$ext = ".php"
	//$file_name_noext = basename($name, $ext);

	$file_parts = pathinfo($file);
	$file_parent = $file_parts['dirname'];
	$file_name = $file_parts['basename'];
	$file_name_noext = $file_parts['filename'];
	$file_ext = $file_parts['extension'];

	printf("File parent = %s", $file_parent) ; echo("<br>");
	printf("File name with extension = %s", $file_name) ; echo("<br>");
	printf("File name WITHOUT extension = %s", $file_name_noext) ; echo("<br>");
	printf("File extension = %s", $file_ext) ; echo("<br>");

	echo("<p><u>File name part array</u>");
	echo("<pre>"); print_r($file_parts); echo("</pre>");

?>
