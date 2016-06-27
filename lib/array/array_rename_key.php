<?php	
if (!function_exists('array_rename_key')) {
	/**
	 * Rename array key
	 *
	 * @param array   $array     target array
	 * @param mixed   $old       old key
	 * @param mixed   $new       new key
	 * @param boolean $recursive flag
	 * @return array
	 */
	function array_rename_key(array $array, $old, $new, $recursive = false)
	{
		$changed = [];
		foreach ($array as $key => $value) {
			if ((string)$key == (string)$old) {
				$key = $new;
			}
			
			$changed[$key] = (
				(is_array($value) and $recursive)
				? array_rename_key($value, $old, $new, true) 
				: $value
			);
		}
		
		return $changed;
	}
}
?>
