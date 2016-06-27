<?php
if (!function_exists('str_has')) {
	function str_has($str, $has, &$pos = false) {
		if (is_scalar($has)) {
			return (false !== ($pos = mb_strpos($str, $has, 0, mb_detect_encoding($str))));
		}

		return ($pos = false);
	}
}
?>