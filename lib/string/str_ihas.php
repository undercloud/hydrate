<?php

	if (false == function_exists('str_ihas')) {
		function str_ihas($str, $has, &$pos = false) {
			if (is_scalar($has)) {
				return (false !== ($pos = mb_stripos($str, $has, 0, mb_detect_encoding($str))));
			}

			return ($pos = false);
		}
	}
?>