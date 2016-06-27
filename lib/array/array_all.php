<?php
if (!function_exists('array_all')) {
	/**
	 * Returns true if all of the values in the array pass the call truth test.
	 * Short-circuits and stops traversing the array if a false element is found.
	 *
	 * @param array    $array target array
	 * @param callable $call  callback function($value, $key)
	 * @return boolean
	 */
	function array_all(array $array, callable $call)
	{
		if (!$array) return false;

		foreach ($array as $key => $value) {
			if (!call_user_func_array($call, [$value, $key])) {
				return false;
			}
		}

		return true;
	}
}
?>