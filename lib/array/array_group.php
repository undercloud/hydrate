<?php
if (!function_exists('array_group')) {
	/**
	 * Group array values by specified key
	 *
	 * @param array $array target array
	 * @param mixed $key   key for group
	 * @return array
	 */
	function array_group(array $array, $key)
	{
		$group = [];
		foreach ($array as $value) {
			unset($key);

			if (is_array($value)) {
				if (isset($value[$key])) {
					$key = $value[$key];
				}
			} else if (is_object($value)) {
				if (isset($value->{$key})) {
					$key = $value->{$key};
				}
			}
			
			if (isset($key)) {
				if (false == isset($group[$key])) {
					$group[$key] = [];
				}
			
				$group[$key][] = $value;
			}
		}

		return $group;
	}
}
?>