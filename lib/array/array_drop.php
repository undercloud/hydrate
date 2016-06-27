<?php	
if (!function_exists('array_drop')) {
	/**
	 * Drop given values from array and return cleaned
	 * 
	 * @param  array $array  target array
	 * @param  mixed $needle array of values or single value
	 * @return array 
	 */
	function array_drop(array $array, $needle = ['', 0, '0', false, null])
	{
		if (!is_array($needle)) {
			$needle = [$needle];
		}

		return array_diff($array, $needle);
	}
}
?>