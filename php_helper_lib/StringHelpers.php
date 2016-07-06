<?php
	
function getRewindPositionOfWord($str, $delim, $rewindVal, $word)
{
	if (!validateString($str))
	{
		return false;
	}
	
	if (!validateStringOfLength($delim, 1))
	{
		return false;
	}
	
	if (!doesContainSubstring($str, $word))
	{
		return false;
	}
	
	$currPos = strpos($str, $word);
	
	if ($currPos <= 1)
	{
		return false;
	}
	
	$currPos -= 2;
	
	$rewindPosition;
	
	while ($currPos != 0 && $rewindVal > 0)
	{
		$currChar = getCharAtIndex($str, $currPos);

		if($currChar == $delim)
		{
			$rewindPosition = $currPos + 1;

			$rewindVal--;
		}
		
		$currPos--;
	}
	
	if( !isset($rewindPosition))
	{
		return false;
	}
	
	return $rewindPosition;
}
function getCharAtIndex($str, $index)
{
	if(!validateString($str))
	{
		return false;
	}
	
	if( $index >= strlen($str))
	{
		return false;
	}
	
	return substr($str, $index, 1);
}
function doesContainSubstring($str, $subStr)
{
	$strPos = strpos($str, $subStr);
	
	if ($strPos === false)
	{
		return false;
	}
	else
	{
		return true;
	}
}
function validateString($str)
{
	if (!is_string($str))
	{
		return false;
	}	
	
	if (strlen($str) <= 0)
	{
		return false;
	}
	
	return true;
}
function validateStringOfLength($str, $length)
{
	if (!is_string($str))
	{
		return false;
	}	
	
	if (strlen($str) != $length)
	{
		return false;
	}
	
	return true;
}
function padStringWithChar(&$str, $char, $checkIfExists = false)
{
	$strLen = strlen($str);
	$charLen = strlen($char);
	
	if($strLen > 0 && $charLen == 1)
	{
		if(!$checkIfExists)
		{
			$str = $char . $str . $char;
			return true;	
		}
		else
		{
			//	Check first character of string
			$firstChar = getFirstChar($str );
			
			if($firstChar !== $char)
			{
				$str = $char . $str;
			}
			
			//	Check last character of string
			$lastChar = getLastChar($str );
			
			if ($lastChar !== $char)
			{
				$str = $str . $char;
			}
			
			return true;
		}
		
	}
	else
	{
		return false;
	}	
}
function getFirstChar($str )
{
	$strLen = strlen($str);
	
	if ($strLen > 0)
	{
		return substr($str, 0, 1);
	}
	else
	{
		return false;
	}
}	

function getLastChar($str )
{
	$strLen = strlen($str );
	
	if ($strLen > 0)
	{
		return substr($str, $strLen - 1, 1);
	}
	else
	{
		return false;
	}
}
	
	
?>