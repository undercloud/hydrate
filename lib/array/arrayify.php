<?php
if (!function_exists('arrayify')) {
	/**
	 * If given argument is not array, convert it into array
	 *
	 * @param mixed $some argument
	 * @return array
	 */
	function arrayify($some)
	{
		if (!is_array($some)) {
			return [$some];
		}

		return $some;
	}
}
?>