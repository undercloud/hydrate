<?php
if (!function_exists('array_last')) {
	/**
	 * Returns the last element of an array
	 *
	 * @param array $array target array
	 * @return mixed
	 */
	function array_last(array $array)
	{
		end($array);
		$value = current($array);
		reset($array);

		return $value;
	}
}
?>