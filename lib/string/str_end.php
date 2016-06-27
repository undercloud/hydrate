<?php
if (!function_exists('str_end')) {
	function str_end($str, $end) {
		return (substr_compare($str, $end, abs(strlen($str) - strlen($end)), strlen($end), false) === 0);
	}
}
?>