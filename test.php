<?php
	
	include_once("./php_helper_lib/WordSearcher.php");
	include_once("./php_helper_lib/StringHelpers.php");

/*
	$testStr = "-HelloThere";
	
	echo "\nUpadded : " . $testStr . "\n";
	
	padStringWithChar($testStr, "-", false);
	
	echo "\nPadded : " . $testStr . "\n";
*/
/*
	$testStr = "when resident paged her family had already put her into bed and put an ice pack on her head. They stated that she fell by the bed and hit her head, we advised her of the risks of a head injury, and she refused to go to the hospital. Over the course of her first four neuro checks her BP increased. Alexis called Katy on-call and Katy said that the increase was not expected and that she needed to be encouraged to go to the ER, her family agreed and her daughter took her to the ER";


	$negators = array("refused to", "didn't", "won't", "no", "wont", "didnt");

	$wordSearcher = new WordSearcher();

	$fallKey = new SearchKey( "fall" );
	$fallKey->addSearchKeyPermutations( array( "fell", "fallen"));
	$fallKey->addNegatorPermutations( $negators );

	$hospitalKey = new SearchKey( "hospital" );
	$hospitalKey->addSearchKeyPermutations( array("hospital", "hosp"));
	$hospitalKey->addNegatorPermutations( $negators );

	$erKey = new SearchKey( "er" );
	$erKey->addSearchKeyPermutations( array("ER", "er", "emergency room"));
	$erKey->addNegatorPermutations( $negators );

	$searchKeys = array($fallKey, $hospitalKey, $erKey);


	$wordSearcher->addSearchKeys( $searchKeys );

	$results = $wordSearcher->getResultsFromString( $testStr );

	echo $results->getLogString();

	*/


	$testStr = "There were so many people in teh people how could people be so people";

	if(($occurrences = getAllOccurrencesOfSubstring($testStr, "people")))
	{
		echo json_encode($occurrences);
	}
?>