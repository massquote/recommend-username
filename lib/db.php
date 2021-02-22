<?php

/**
 * @Author: junnotarte
 * @Date:   2021-02-22 11:41:52
 * @Last Modified by:   junnotarte
 * @Last Modified time: 2021-02-22 19:15:05
 *
 * Class that serve as the database connection
 * or where the collection of data is taken
 *
 * Its recommeneded that the list is taken
 * from a database instead of text file because
 * there maybe php limitation in reading the entire
 * content of a large text file
 */

namespace NameSuggester;

class DB {

	private $nameList = [];
	private $filePath = '';

	/**
	 * initiate connection or get 
	 * the data
	 * @return [type] [description]
	 */
	function __construct(string $filepath) {
		// check if file exists
		if (!file_exists($filepath)) {
			exit('File does not exists.');
		}

		$this->filePath = realpath($filepath);
	}

	/**
	 * Function that will get the list of names
	 * according to keyword and sort it. 
	 * We assume that records is separated by new line
	 * Simulating SQL like statement
	 * @param  string       $keyword         [description]
	 * @param  bool|boolean $isCaseSensitive [description]
	 * @return [type]                        [description]
	 */
	public function getListFilterLike(string $keyword, bool $isCaseSensitive = false) : array {
		// lets read the file
		$content = file_get_contents($this->filePath);

		if (!$isCaseSensitive) {
			$content = strtolower($content);
			$keyword = strtolower($keyword);
		}

		// lets get base record only
		preg_match('/\b'  .$keyword . '\b/', $content, $singleMatch);
		// all matching records
		preg_match_all('/' . $keyword . '([\d]+)/', $content, $allMatch);

		$base = empty($singleMatch[0]) ? [] : [$singleMatch[0]];
		$records = empty($allMatch[0]) ? [] : $allMatch[0];

		$filteredNames = array_merge($base, $records);

	    return $filteredNames;
	}

}