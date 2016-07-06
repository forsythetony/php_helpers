<?php
	include("./php_helper_lib/StringHelpers.php");
	
	
/*
	$testStr = "-HelloThere";
	
	echo "\nUpadded : " . $testStr . "\n";
	
	padStringWithChar($testStr, "-", false);
	
	echo "\nPadded : " . $testStr . "\n";
*/

	$testStr = "hello there people now why";
	
	$whyPos = strpos($testStr, "why");
	
	echo "\nWhyPos: " . $whyPos . " \n";
	
	$pos = getRewindPositionOfWord($testStr, " ", 1, "why");
	
	echo "\nRewindPos: " . $pos . " \n";
	

		
?>