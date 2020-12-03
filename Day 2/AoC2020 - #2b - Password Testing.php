<?php
// Advent of Code 2020 - Puzzle 1a: Expense Report - 2 Numbers
// Keith Solomon
// Dec. 3,2020

$file = "AoC2020 - Passwords Input.txt";

function arrayFromCSV($file, $hasFieldNames = false, $delimiter = ',') {
	$result = array();
	$size = filesize($file) + 1;
	$file = fopen($file, 'r');

	#TO DO: There must be a better way of finding out the size of the longest row... until then
	if ($hasFieldNames) $keys = fgetcsv($file, $size, $delimiter);

	while ($row = fgetcsv($file, $size, $delimiter)) {
		$n = count($row);
		$res = array();

		for ($i = 0; $i < $n; $i++) {
			$idx = ($hasFieldNames) ? $keys[$i] : $i;
			$res[$idx] = $row[$i];
		}

		$result[] = $res;
	}

	fclose($file);

	return $result;
}

function chkPass($input) {
	$count = 0;

	foreach ($input as $line) {
		$pat = explode(' ',$line[0]);
		$limit = explode('-',$pat[0]);
		$min = $limit[0];
		$max = $limit[1];

		if ($min == 1) {
			$min = 0;
		} else {
			$min = $min-1;
		}

		$max = $max - 1;

		$char = $pat[1];

		$pass = $line[1];

		//echo 'Position 1: '.$min,', Position 2: '.$max.', Character: '.$char.', Password: '.$pass.PHP_EOL;

		$str1 = substr($pass,$min,1);
		$str2 = substr($pass,$max,1);

		if ($str1 == $str2) {
			continue;
		} else {
			if (($str1 == $char) || ($str2 == $char)) {
				$count++;
			}
		}
	}

	echo 'Total Valid Passwords: '.$count.PHP_EOL;
}

$CSVdata = arrayFromCSV($file);

chkPass($CSVdata);

?>