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
		$char = $pat[1];

		$pass = $line[1];

		$patternCount = substr_count($pass, $char);
		$valid = "No";

		if (($patternCount >= $min && $patternCount <= $max)) {
			$valid = "Yes";

			$count++;
		}

		// echo 'Password: '.$pass.PHP_EOL;
		// echo 'Valid Pattern: '.$line[0].PHP_EOL;
		// echo 'Valid Password? '.$valid.PHP_EOL;
		// echo PHP_EOL;
		//echo 'Limit-min: '.$min.', Limit-max: '.$max,', Character: '.$char.', Password: '.$pass.', Pattern Count: '.$patternCount.PHP_EOL;
	}

	echo 'Total Valid Passwords: '.$count.PHP_EOL;
	//print_r($input);
}

$CSVdata = arrayFromCSV($file);

chkPass($CSVdata);

?>