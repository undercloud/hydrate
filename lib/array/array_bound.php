<?php
if (!function_exists('array_bound')) {
	/**
	 * Return array with specified keys
	 *
	 * @param array   $array   target array 
	 * @param array   $keys    keys
	 * @param boolean $reverse if equal true return array without specified keys
	 * @return array
	 */
	function array_bound(array $array, array $keys, $reverse = false)
	{
		$reverse = (bool)$reverse;

		$bound = [];
		foreach ($array as $key => $value) {
			if ($reverse != in_array($key, $keys)) {
				$bound[$key] = $value;
			}
		}

		return $bound;
	}
}
?>