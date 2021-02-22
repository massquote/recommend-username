<?php

/**
 * @Author: junnotarte
 * @Date:   2021-02-22 11:41:38
 * @Last Modified by:   junnotarte
 * @Last Modified time: 2021-02-22 17:57:23
 *
 * This file contains utility functions and
 * the function needed to recommend a username
 */


/**
 * This function will recommned the available 
 * name according to keyword base on the array
 * @param  string $keyword  [description]
 * @param  array  $nameList [description]
 * @return string           [description]
 */
function recommend_username(string $keyword, array $nameList) {

	// check if we only need the base name
	if (empty($nameList))
		return $keyword; 

	// lets get teh sequence numbers only
	$sequenceNumbers = str_replace($keyword, '', $nameList);

	// lets make sure we remove the duplicate
	$sequenceNumbers = array_unique($sequenceNumbers);
	sort($sequenceNumbers);

	// lets get the last item 
	$lastItem = end($sequenceNumbers);

	// add 1 to base name if no digit
	if (empty($lastItem) || intval($lastItem) < 1 ) 
		return $keyword . 1;

	// check if last digit is equal to count then just increment it
	if (count($sequenceNumbers) -1 == intval($lastItem))
		return $keyword . (intval($lastItem) + 1);

	// it pass here means there is a missing sequence in the list
	// lets check if base i present if not use the base instead
	if (!in_array($keyword, $nameList))
		return $keyword;

	// lets get the sequence now
	foreach ($sequenceNumbers as $index => $val) {
		if ($index != intval($val)) {
			return $keyword . $index;
			break;
		}
	}

}



/**
 * this will remove keywords with number suffix
 * but numbers in between strings are not removed
 * @param  string $keyword [description]
 * @return [type]          [description]
 */
function ignoreSuffixNumbers(string $keyword) {
	// lets check the keyword if has number suffix
	$arrKeyword =str_split(strrev($keyword));
	$number = '';
	foreach ($arrKeyword as $chr) {
		if (!is_numeric($chr))
			break;

		$number .= $chr;
	}

	// lets remove the number in keyword
	if (!empty($number)) {
		$number = strrev($number);
		$keyword = str_replace($number, '', $keyword);
	}
	return $keyword;
}

/**
 * This will wait for user input before
 * it continue to run the script
 * @return [type] [description]
 */
function wait_for_userinput() {
    $handle = fopen ('php://stdin','r');
    do 
    { 
    	$line = fgets($handle);
    } while ($line == '');
    
    fclose($handle);
    return $line;
}

/**
 * This will check if a valid email address
 * @param  string  $email [description]
 * @return boolean        [description]
 */
function is_email_address(string $email) {
	// lets clean the entry
	$email = filter_var($email, FILTER_SANITIZE_EMAIL);
	return filter_var($email, FILTER_VALIDATE_EMAIL);
}