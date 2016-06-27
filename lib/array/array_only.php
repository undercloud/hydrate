<?php	
if (!function_exists('array_only')) {
	/**
	 * Retrieve array vaues by given keys
	 *
	 * @param array $array   target array
	 * @param mixed $keys... list of target keys
	 * @return array
	 */
	function array_only()
	{
		$keys = func_get_args();

		if (!$keys) return [];

		$array = array_shift($keys);

		if (!is_array($array)) {
			trigger_error(
				sprintf(
					'%s expects parameter 1 to be array, %s given',
					__FUNCTION__,
					gettype($array)
				),
				E_USER_WARNING
			);
		}

		$list = [];
		foreach ($keys as $key => $value) {
			$list[] = isset($array[$key]) ? $array[$key] : null;
		}

		return $list;
	}
}
?>