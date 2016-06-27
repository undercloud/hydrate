<?php
if (!function_exists('array_first')) {
	/**
	 * Returns the first element of an array
	 *
	 * @param array $array target array
	 * @return mixed
	 */
	function array_first(array $array)
	{
		foreach ($array as $item) return $item;
	}
}
?>