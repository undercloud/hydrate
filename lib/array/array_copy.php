<?php
if (!function_exists('array_copy')) {
	/**
	 * Deep copy of array
	 *
	 * @param array $array target array
	 * @return array
	 */
	function array_copy(array $array)
	{
		$result = [];
		foreach ($array as $key => $val) {
			if (is_array($val)) {
				$result[$key] = array_copy($val);
			} elseif (is_object($val)) {
				$result[$key] = clone $val;
			} else {
				$result[$key] = $val;
			}
		}
		
		return $result;
	}
}
?>