<?php	
if (!function_exists('object_has')) {
	function object_has($object, $property) {
		return (
			property_exists($object, $property) or
			method_exists($object, $property)
		);
	}
}
?>