<?php
if (!function_exists('array_get')) {
	/**
	 * Return element from array using dot notation
	 *
	 * @param array $array   target array
	 * @param mixed $key     path
	 * @param mixed $default if element not exists return default value
	 * @return mixed
	 */
	function array_get(array $array, $key, $default = null)
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
				return $default;
			}
		}

		return $array;
	}
}
?>