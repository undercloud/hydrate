<?php

	if (false == function_exists('str_istart')) {
		function str_istart($str, $start) {
			return (substr_compare($str, $start, 0, strlen($start), true) === 0);
		}
	}

?>