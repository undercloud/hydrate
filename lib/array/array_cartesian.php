<?php	
if (!function_exists('array_cartesian')) {
	/**
	 * Return cartesian product for array
	 *
	 * @param array $arrays... variants
	 * @return array
	 */
	function array_cartesian()
	{			
		$args = func_get_args();
		
		if (count($args) == 0) {
			return [[]];
		}

		$a = array_shift($args);
		$c = call_user_func_array(__FUNCTION__, $args);
		$r = [];

		foreach ($a as $v) {
			foreach ($c as $p) {
				$r[] = array_merge([$v], $p);
			}
		}

		return $r;
	}
}
?>