<?php

	if (false == function_exists('str_idrop')) {
		function str_idrop($subject, $search, &$count = 0) {
			return str_ireplace($search, '', $subject, $count);
		}
	}

?>