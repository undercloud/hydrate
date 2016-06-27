<?php
if (!function_exists('preg_drop')) {
	function preg_drop($subject, $pattern, $limit = -1, &$count = 0) {
		return preg_replace($pattern, '', $subject, $limit, $count);
	}
}
?>