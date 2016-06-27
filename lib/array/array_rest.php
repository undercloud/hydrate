<?php
if (!function_exists('array_rest')) {
	/**
	 * Returns the rest of the elements in an array. 
	 * Pass an index to return the values of the array 
	 * from that index onward.
	 *
	 * @param array   $array target array
	 * @param integer $num   offset
	 * @return array
	 */
	function array_rest(array $array, $num = 1)
	{
		$num = (int)$num;

		return array_slice($array, $num);
	}
}
?>