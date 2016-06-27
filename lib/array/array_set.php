<?php
if (!function_exists('array_set')) {
	/**
	 *
	 */
	function array_set(array &$array, $key, $value)
	{
		if (null === $key) {
			return $array = $value;
		}

		$keys = explode('.', $key);
		while (count($keys) > 1) {
			$key = array_shift($keys);
			if (! isset($array[$key]) || ! is_array($array[$key])) {
				$array[$key] = [];
			}
			$array = &$array[$key];
		}
	}
}

?>