<?php
if (!function_exists('array_cast')) {
	/**
	 * Filter array values by type
	 *
	 * @param array $array target array
	 * @param mixed $cast  single type name, array of type names of callback function($value)
	 * @return array
	 */
	function array_cast(array $array, $cast)
	{
		if (!($cast instanceof Closure)) {
			if (!is_array($cast)) {
				$cast = [$cast];
			}
		}
		
		$native = [
			'null', 'bool', 'string', 
			'integer', 'float', 'numeric', 
			'array', 'object', 'resource', 
			'callable', 'scalar'
		];
		
		$filter = [];
		foreach ($array as $key => $value) {
			$is = false;

			if ($cast instanceof Closure) {
				$is = call_user_func_array($cast, [$value, $key]);
			} else {
				foreach ($cast as $c) {
					if (in_array($c, $native)) {
						if (call_user_func('is_' . $c, $value)) {
							$is = true;
						}
					} else {
						if ($value instanceof $c) {
							$is = true;
						}
					}
				}
			}
			
			if ($is) {
				$filter[$key] = $value;
			}
		}
		
		return $filter;
	}
}
?>