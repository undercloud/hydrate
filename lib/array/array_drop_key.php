<?php
if (!function_exists('array_drop_key')) {
	/**
	 * Remove specified keys from given array and return cleaned
	 *
	 * @param array $array target array
	 * @param mixed $key   single key name of array of key names
	 * @return array  
	 */
	function array_drop_key(array $array, $key)
	{
		if (!is_array($key)) {
			$key = [$key];
		}

		foreach ($key as $k) {
			if (array_key_exists($k, $array)) {
				unset($array[$k]);
			}
		}

		return $array;
	}
}
?>