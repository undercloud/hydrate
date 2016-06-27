<?php
if (!function_exists('array_where')) {
	/**
	 *
	 *
	 */
	function array_where(array $array, $predicate, $strict = false)
	{
		$comparator = function ($what, $with, $strict = false) {
			if (is_callable($with)) {
				return call_user_func($with, $what);
			} else if (true === $strict) {
				return ($what === $with);
			} else {
				return ($what == $with);
			}
		};

		$find = [];
		foreach ($array as $key => $value) {
			if (is_array($predicate)) {
				foreach ($predicate as $pkey => $pvalue) {
					if (is_scalar($value)) {
						if (false == $comparator($value[$pkey], $pvalue, $strict)) {
							continue;
						}
					} else if (is_array($value)) {
						if (false == isset($value[$pkey])) {
							continue 2;
						}

						if (false == $comparator($value[$pkey], $pvalue, $strict)) {
							continue 2;
						}
					} else if (is_object($value)) {
						if (false == isset($value->{$pkey})) {
							continue 2;
						}

						if (false == $comparator($value->{$pkey}, $pvalue, $strict)) {
							continue 2;
						}
					}
				}

				$find[$key] = $value;
			} else {
				if (true == $comparator($value, $predicate, $strict)) {
					$find[$key] = $value;
				}
			}
		}

		return $find;
	}
}
?>