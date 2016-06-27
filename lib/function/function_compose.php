<?php	
if (!function_exists('function_compose')) {
	function function_compose()
	{
		$fns = array_reverse(func_get_args());

		$args = [];
		foreach ($fns as $fn) {
			$args = array(call_user_func_array($fn, $args));	
		}

		return $args;
	}
}
?>