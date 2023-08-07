<?php

	echo date("M-d-Y", mktime(0, 0, 0, 12, 32, 1997));
	echo("<br>");
	
	echo date("M-d-Y", mktime(0, 0, 0, 13, 1, 1997));
	echo("<br>");
	
	echo date("M-d-Y", mktime(0, 0, 0, 1, 1, 1998));
	echo("<br>");
	
	echo date("M-d-Y", mktime(0, 0, 0, 1, 1, 98));
	echo("<p>");
	
	printf("<b>Current date and time is</b>: %s",date("F jS - g:i:s a"));
	
?>
