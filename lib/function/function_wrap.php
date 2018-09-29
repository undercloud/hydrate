<?php
if (!function_exists('function_wrap')) {
	function function_wrap($fn, $call) {
		return function () use ($fn, $call) {
			$args = func_get_args();
			array_unshift($args, $fn);

			return call_user_func_array($call, $args);
		};
	}
}
?>