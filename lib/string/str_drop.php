<?	
if (!function_exists('str_drop')) {
	function str_drop($subject, $search, &$count = 0) {
		return str_replace($search, '', $subject, $count);
	}
}
?>