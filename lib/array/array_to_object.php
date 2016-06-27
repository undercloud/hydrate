<?php
if (!function_exists('array_to_object')) {
	/**
	 * Convert array to object
	 *
	 * @param array $array target array
	 * @return object
	 */
	function array_to_object(array $array)
	{
		return json_decode(json_encode ($array), false);
	}
}
?>