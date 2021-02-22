<?php

/**
 * @Author: junnotarte
 * @Date:   2021-02-22 11:34:35
 * @Last Modified by:   junnotarte
 * @Last Modified time: 2021-02-22 19:12:59
*/

error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once 'lib/db.php';
require_once 'lib/util.php';

	use NameSuggester\DB;
	$db = new DB('res/usernames.txt');

	echo "\n" .'Please enter Email address: ';

	// lets wait for user to hit enter
	$email = wait_for_userinput();

	// we just record the time
	$startTime =  microtime(true);

	if (!is_email_address($email))  {
		echo sprintf("\n" . 'Invalid email address %s' . 
			'Please run the script again.'  . "\n\n", $email);
		exit;
	}

	// lets remove the domain
	$emailCut = explode('@', $email);

	$keyword = ignoreSuffixNumbers($emailCut[0]);
	$nameList = $db->getListFilterLike($keyword);

	// lete get the recomended user name
	$username = recommend_username($keyword, $nameList);

	// record the end time
	$endTime =  microtime(true);
	$time = $endTime - $startTime;

	echo "\n" .'=============================================='. "\n";
	echo sprintf('Recommended username: %s', $username);
	echo "\n" .'=============================================='. "\n\n";

	echo sprintf('processed in %s seconds'  . "\n\n", $time);

