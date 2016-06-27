<?php
if (!function_exists('array_union')) {
	/**
	 * Union two arrays by given keys
	 *
	 * @param array $main
	 * @param mixed $id
	 */
	function array_union(array $main, $id, array $part, $field = null)
	{
		if (!$part) {
			return $main;
		}

		foreach ($main as &$item) {
			if (isset($item[$id])) {
				if (isset($part[$id])) {
					if (null != $field) {
						$item[$id] = (isset($part[$id][$field]) ? $part[$id][$field] : null);
					} else {
						$item[$id] = $part[$id];
					}
				}
			}
		}

		unset($item);

		return $main;
	}
}
?>