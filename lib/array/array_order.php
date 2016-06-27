<?php
if (!function_exists('array_order')) {
	/**
	 * 
	 *
	 */
	function array_order(array $array, $order)
	{
		if (false === is_array($order)) {
			$order = [$order => SORT_ASC];
		} else {
			$clean = [];
			foreach ($order as $o => $s) {
				if (is_integer($o)) {
					$clean[$s] = SORT_ASC;
				} else {
					$clean[$o] = constant('SORT_' . strtoupper($s));
				}
			}
		}

		$order = $clean;
		unset($clean);

		$args = [];

		$sort = [];
		foreach ($array as $key => $value) {
			foreach ($order as $o => $s) {
				if (is_object($value)) {
					$sort[$o][$key] = (isset($value->{$o}) ? $value->{$o} : null);
				} else if (is_array($value)) {
					$sort[$o][$key] = (isset($value[$o]) ? $value[$o] : null);
				}
			}
		}
		
		foreach ($order as $o => $s) {
			$args[] = $sort[$o];
			$args[] = $s;
		}

		$args[] = &$array;

		call_user_func_array('array_multisort', $args);

		return $array;
	}
}
?>