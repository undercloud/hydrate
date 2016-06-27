<?php
if (!function_exists('array_range')) {
	/**
	 * Generate sequence with callback function
	 *
	 * @param integer  $count elements
	 * @param callable $call  callback function($prev_value, $iteration)
	 * @return array
	 */
	function array_range($count, callable $call)
	{
		$count = (int) $count;

		$prev = null;
		$range = [];

		for ($iteration = 0; $iteration < $count; $iteration++) {
			$prev = call_user_func_array($call, [$prev, $iteration]);
			$range[] = $prev;
		}

		return $range;
	}
}
?>