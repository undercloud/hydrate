<?php

	if (false == function_exists('str_iend')) {
		function str_iend($str, $end) {
			return (substr_compare($str, $end, abs(strlen($str) - strlen($end)), strlen($end), true) === 0);
		}
	}


?>