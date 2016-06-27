<?php
if (!function_exists('array_index')) {
	/**
	 * Create array index by given key
	 *
	 * @param array $array target array
	 * @param mixed $key   index
	 * @return array
	 */
	function array_index(array $array, $key)
	{
		$indexed = [];
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
				$indexed[$key] = $value;
			}
		}

		return $indexed;
	}
}
?>