<?php
if (!function_exists('array_each')) {
	/**
	 * Iterates over array, yielding each in turn to an iteratee function
	 *
	 * @param array    $array target array
	 * @param callable $call  callback function
	 * @return void
	 */
	function array_each(array $array, callable $call)
	{
		foreach ($array as $key => $value) {
			call_user_func_array($call, [$value, $key]);
		}
	}
}
?>