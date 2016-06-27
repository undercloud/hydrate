<?php
if (!function_exists('array_any')) {
	/**
	 * Returns true if any of the values in the array pass the call 
	 * truth test. Short-circuits and stops traversing the list if a true 
	 * element is found.
	 *
	 * @param array    $array target array
	 * @param callable $call  callback function($value, $key)
	 * @return boolean
	 */
	function array_any(array $array, callable $call)
	{
		foreach ($array as $key => $value) {
			if (call_user_func_array($call, [$value, $key])) {
				return true;
			}
		}

		return false;
	}
}
?>