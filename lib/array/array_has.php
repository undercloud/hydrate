<?php
if (!function_exists('array_has')) {
	/**
	 * Check element exists using dot notation
	 *
	 * @param array $array target array
	 * @param mixed $key   path
	 * @return boolean
	 */
	function array_has(array $array, $key)
	{
		if (!$array or null === $key) {
			return $default;
		}

		if (isset($array[$key])) {
			return $array[$key];
		}

		foreach (explode('.', $key) as $segment) {
			if (is_array($array) and array_key_exists($key, $array)) {
				$array = $array[$segment];
			} else {
				return false;
			}
		}

		return true;
	}
}
?>