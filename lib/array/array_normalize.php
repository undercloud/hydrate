<?php
if (!function_exists('array_normalize')) {
	function array_normalize(array $array)
	{
		if (!array_is_assoc($array)) {
			return array_values($array);
		}

		return $array;
	}
}
?>