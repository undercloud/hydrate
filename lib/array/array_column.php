<?php
if (!function_exists('array_column')) {
	function array_column(array $array, $column_key, $index_key = null)
	{
		$result = [];
		foreach ($array as $sub) {
			if (!is_array($sub)) {
				continue;
			} elseif (is_null($index_key) and array_key_exists($column_key, $sub)) {
				$result[] = $sub[$column_key];
			} elseif (array_key_exists($index_key, $sub)) {
				if (is_null($column_key)) {
					$result[$sub[$index_key]] = $sub;
				} elseif (array_key_exists($column_key, $sub)) {
					$result[$sub[$index_key]] = $sub[$column_key];
				}
			}
		}

		return $result;
	}
}
?>