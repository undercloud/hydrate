<?php
if (!function_exists('array_initial')) {
	/**
	 * Returns everything but the last entry of the array. 
	 * Especially useful on the arguments object. 
	 * Pass num to exclude the last num elements from the result.
	 *
	 * @param array   $array target array
	 * @param integer $num   offset
	 * @return array
	 */
	function array_initial(array $array, $num = 1)
	{
		$num = (int)$num;

		if (0 == $num) {
			return $array;
		}
	
		return array_slice($array, 0, (-1 * $num));
	}
}
?>