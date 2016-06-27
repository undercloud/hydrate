<?php
if (!function_exists('array_from_object')) {
	/**
	 *
	 */
	function array_from_object($data)
	{
		if (is_array($data) || is_object($data)) {
			$result = array();
			foreach ($data as $key => $value) {
				$result[$key] = array_from_object($value);
			}
			
			return $result;
		}
		return $data;
	}
}
?>