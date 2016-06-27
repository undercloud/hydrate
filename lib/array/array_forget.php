<?php
if (!function_exists('array_forget')) {
	/**
	 * Remove value from array using dot notation
	 *
	 * @param array &$array target array
	 * @param mixed $keys   single key or array of keys
	 * @return void
	 */
	function array_forget(array &$array, $keys)
	{
		$original = &$array;
		
		if (null === $keys) return;

		if (!is_array($keys)) {
			$keys = [$keys];
		}
		
		if (!$keys) return;

		foreach ($keys as $key) {
			if (isset($array, $key)) {
				unset($array[$key]);

				continue;
			}

			$parts = explode('.', $key);
			
			$array = &$original;
			while (count($parts) > 1) {
				$part = array_shift($parts);
				if (isset($array[$part]) and is_array($array[$part])) {
					$array = &$array[$part];
				} else {
					continue 2;
				}
			}

			unset($array[array_shift($parts)]);
		}
	}
}
?>