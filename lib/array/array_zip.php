<?php
if (!function_exists('array_zip')) {
	/**
	 * Merges together the values of each of the arrays
	 * with the values at the corresponding position.
	 * Useful when you have separate data sources that are
	 * coordinated through matching array indexes.
	 *
	 * @param array $arrays... target arrays
     *
	 * @return array
	*/
	function array_zip()
	{
		$args = func_get_args();
		$limit = min(array_map('count', $args));

		$args = array_map(
			function ($item) use ($limit) {
				return array_slice($item, 0, $limit);
			},
			$args
		);

		array_unshift($args, null);

		return call_user_func_array('array_map', $args);
	}
}
