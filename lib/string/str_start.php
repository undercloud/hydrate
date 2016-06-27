<?php

	if (false == function_exists('str_start')) {
		function str_start($str, $start) {
			return (substr_compare($str, $start, 0, strlen($start), false) === 0);
		}
	}


?>