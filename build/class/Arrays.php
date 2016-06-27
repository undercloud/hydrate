<?php 
namespace Hydrate 

class Arrays
{
	public static function forget(array &$array, $keys)
	{
		$original = &$array;
		
		$keys = arrayify($keys);
		if (!$keys) {
			return;
		}

		foreach ($keys as $key) {
			if (isset($array, $key)) {
				unset($array[$key]);

				continue;
			}

			$parts = explode('.', $key);
			
			$array = &$original;
			while (count($parts) > 1) {
				$part = array_shift($parts);
				if (isset($array[$part]) && is_array($array[$part])) {
					$array = &$array[$part];
				} else {
					continue 2;
				}
			}

			unset($array[array_shift($parts)]);
		}
	}

	/**
	 * Returns the rest of the elements in an array. 
	 * Pass an index to return the values of the array 
	 * from that index onward.
	 *
	 * @param array   $array target array
	 * @param integer $num   offset
	 * @return array
	 */
	public static function rest(array $array, $num = 1)
	{
		$num = (int)$num;

		return array_slice($array, $num);
	}

	/**
	 * Check element exists using dot notation
	 *
	 * @param array $array target array
	 * @param mixed $key   path
	 * @return boolean
	 */
	public static function has(array $array, $key)
	{
		if(!$array or null === $key) {
			return $default;
		}

		if (isset($array[$key])) {
			return $array[$key];
		}

		foreach (explode('.', $key) as $segment) {
			if (is_array($array) and array_key_exists($key, $array)) {
				$array = $array[$segment];
			} else {
				return false;
			}
		}

		return true;
	}

	/**
	 * Prepend element with key and value to the beginning of an array,
	 * and returns the new number of elements
	 *
	 * @param array &$array target array
	 * @param mixed $key    new key
	 * @param mixed $value  new value
	 * @return int
	 */
	public static function unshiftAssoc(array &$array, $key, $val)
	{
		$array = array_reverse($array, true);
		$array[$key] = $val;
		$array = array_reverse($array, true);

		return count($array);
	}

	/**
	 * Return array with specified keys
	 *
	 * @param array $array     target array 
	 * @param array $keys      keys
	 * @param boolean $reverse if equal true return array without specified keys
	 * @return array
	 */
	public static function bound(array $array, array $keys, $reverse = false)
	{
		$reverse = (bool)$reverse;

		$bound = [];
		foreach ($array as $key => $value) {
			if ($reverse != in_array($key, $keys)) {
				$bound[$key] = $value;
			}
		}

		return $bound;
	}

	public static function normalize(array $array)
	{
		if (!array_is_assoc($array)) {
			return array_values($array);
		}

		return $array;
	}

	/**
	 * Generate sequence with callback function
	 *
	 * @param integer  $count elements
	 * @param callable $call  callback function($prev_value, $iteration)
	 * @return array
	 */
	public static function range($count, callable $call)
	{
		$count = (int) $count;

		$prev = null;
		$range = [];

		for ($iteration = 0; $iteration < $count; $iteration++) {
			$prev = call_user_func_array($call, [$prev, $iteration]);
			$range[] = $prev;
		}

		return $range;
	}

	public static function cast(array $array, $cast)
	{
		if (!($cast instanceof Closure)) {
			$cast = arrayify($cast);
		}
		
		$native = [
			'null', 'bool', 'string', 
			'integer', 'float', 'numeric', 
			'array', 'object', 'resource', 
			'callable', 'scalar'
		];
		
		$filter = [];
		foreach ($array as $key => $value) {
			$is = false;

			if ($cast instanceof Closure) {
				$is = call_user_func_array($cast, [$value, $key]);
			} else {
				foreach ($cast as $c) {
					if (in_array($c, $native)) {
						if (call_user_func('is_' . $c, $value)) {
							$is = true;
						}
					} else {
						if ($value instanceof $c) {
							$is = true;
						}
					}
				}
			}
			
			if ($is) {
				$filter[$key] = $value;
			}
		}
		
		return $filter;
	}

	public static function set(array &$array, $key, $value)
	{
		if (null === $key) {
			return $array = $value;
		}

		$keys = explode('.', $key);
		while (count($keys) > 1) {
			$key = array_shift($keys);
			if (! isset($array[$key]) || ! is_array($array[$key])) {
				$array[$key] = [];
			}
			$array = &$array[$key];
		}
	}
}

	/**
	 * Sort array by another array
	 *
	 * @param array $array target array
	 * @param array $order order array
	 * @return array
	 */
	public static function sortByArray(array $array, array $sorter)
	{
		$ordered = [];
		foreach ($sorter as $key) {
			if (array_key_exists($key, $array)) {
				$ordered[$key] = $array[$key];
				unset($array[$key]);
			}
		}
		
		return $ordered + $array;
	}
}

	public static function union(array $main, $id, array $part, $field = null)
	{
		if (!$part) {
			return $main;
		}

		foreach ($main as &$item){
			if (isset($item[$id])) {
				if (isset($part[$id])) {
					if(null != $field) {
						$item[$id] = (isset($part[$id][$field]) ? $part[$id][$field] : null);
					} else {
						$item[$id] = $part[$id];
					}
				}
			}
		}

		unset($item);

		return $main;
	}

	/**
	 * Returns true if any of the values in the array pass the call 
	 * truth test. Short-circuits and stops traversing the list if a true 
	 * element is found.
	 *
	 * @param array    $array target array
	 * @param callable $call  callback function($value, $key)
	 * @return boolean
	 */
	public static function any(array $array, callable $call)
	{
		foreach ($array as $key => $value) {
			if (call_user_func_array($call, [$value, $key])) {
				return true;
			}
		}

		return false;
	}

	/**
	 * Create array index by given key
	 *
	 * @param array $array target array
	 * @param mixed $key   index
	 * @return array
	 */
	public static function index(array $array, $key)
	{
		$indexed = [];
		foreach ($array as $value) {
			unset($key);
		
			if (is_array($value)) {
				if (isset($value[$key])) {
					$key = $value[$key];
				}
			} else if (is_object($value)) {
				if (isset($value->{$key})) {
					$key = $value->{$key};
				}
			}
			
			if (isset($key)) {
				$indexed[$key] = $value;
			}
		}

		return $indexed;
	}

	/**
	 * Merges together the values of each of the arrays 
	 * with the values at the corresponding position. 
	 * Useful when you have separate data sources that are 
	 * coordinated through matching array indexes.
	 *
	 * @param array $arrays... target arrays
	 * @return array
	*/
	public static function zip()
	{
		$args = func_get_args();
		$limit = min(array_map('count', $args));

		$args = array_map(
			public static function ($item) use ($limit) {
				return array_slice($item, 0, $limit);
			},
			$args
		);

		array_unshift($args, null);

		return call_user_func_array('array_map', $args);
	}

	/**
	 * Returns the first key of an array
	 *
	 * @param array $array target array
	 * @return mixed
	 */
	public static function firstKey(array $array)
	{
		foreach ($array as $key => $val) return $key;
	}

	/**
	 * Split array into two arrays: 
	 * one whose elements all satisfy predicate 
	 * and one whose elements all do not satisfy predicate.
	 *
	 * @param array    $array target array
	 * @param callable $call  callback function($value, $key)
	 * @return array
	 */
	public static function partition(array $array, callable $call)
	{
		$ok   = [];
		$fail = [];

		foreach ($array as $key => $value) {
			if (call_user_func($call, $value, $key)) {
				$ok[$key] = $value; 
			} else {
				$fail[$key] = $value; 
			}
		}
		
		return [$ok, $fail];
	}

	/**
	 * Applies the callback to the elements of the given array
	 *
	 * @param array    $assoc target array
	 * @param callable $call  callable function($key, $value)
	 * @return array
	 */
	public static function mapAssoc(array $assoc, callable $call)
	{
		return array_map($call, array_keys($assoc), array_values($assoc));
	}

	public static function column(array $array, $columnKey, $indexKey = null)
	{
		$result = [];
		foreach ($array as $sub) {
			if (!is_array($sub)) {
				continue;
			} elseif (is_null($index_key) and array_key_exists($column_key, $sub)) {
				$result[] = $sub[$column_key];
			} elseif (array_key_exists($index_key, $sub)) {
				if (is_null($column_key)) {
					$result[$sub[$index_key]] = $sub;
				} elseif (array_key_exists($column_key, $sub)) {
					$result[$sub[$index_key]] = $sub[$column_key];
				}
			}
		}

		return $result;
	}

	/**
	 * Returns the last element of an array
	 *
	 * @param array $array target array
	 * @return mixed
	 */
	public static function last(array $array)
	{
		end($array);
		$value = current($array);
		reset($array);

		return $value;
	}

	/**
	 * Check if given array is multidimensional
	 *
	 * @param array $array target array
	 * @return boolean
	 */
	public static function isMulti(array $array)
	{
		return (count($array) !== count($array, true));
	}

	/**
	 * Retrieve array vaues by given keys
	 *
	 * @param array $array   target array
	 * @param mixed $keys... list of target keys
	 * @return array
	 */
	public static function only()
	{
		$keys = func_get_args();

		if (!$keys) return [];

		$array = array_shift($keys);

		if (!is_array($array)) {
			trigger_error(
				sprintf(
					'%s expects parameter 1 to be array, %s given',
					__FUNCTION__,
					gettype($array)
				),
				E_USER_WARNING
			);
		}

		$list = [];
		foreach ($keys as $key => $value) {
			$list[] = isset($array[$key]) ? $array[$key] : null;
		}

		return $list;
	}

	/**
	 * Returns everything but the last entry of the array. 
	 * Especially useful on the arguments object. 
	 * Pass num to exclude the last num elements from the result.
	 *
	 * @param array   $array target array
	 * @param integer $num   offset
	 * @return array
	 */
	public static function initial(array $array, $num = 1) {
		$num = (int)$num;

		if (0 == $num) {
			return $array;
		}
	
		return array_slice($array, 0, (-1 * $num));
	}

	public static function where(array $array, $predicate, $strict = false)
	{
		$comparator = public static function ($what, $with, $strict = false) {
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

	/**
	 * Flattens a nested array (the nesting can be to any depth) and return it
	 *
	 * @param array $array target array
	 * @return array 
	 */
	public static function flat($array)
	{
		$output = [];
		
		if (is_array($array)) {
			foreach ($array as $element) {
				$output = array_merge($output, array_flat($element));
			}
		} else { 
			$output[] = $array; 
		}

		return $output;
	}

	/**
	 * Return element from array using dot notation
	 *
	 * @param array $array   target array
	 * @param mixed $key     path
	 * @param mixed $default if element not exists return default value
	 * @return mixed
	 */
	public static function get(array $array, $key, $default = null)
	{
		if(!$array or null === $key) {
			return $default;
		}

		if (isset($array[$key])) {
			return $array[$key];
		}

		foreach (explode('.', $key) as $segment) {
			if (is_array($array) and array_key_exists($key, $array)) {
				$array = $array[$segment];
			} else {
				return $default;
			}
		}

		return $array;
	}

	/**
	 * Returns the first element of an array
	 *
	 * @param array $array target array
	 * @return mixed
	 */
	public static function first(array $array)
	{
		foreach ($array as $item) return $item;
	}

	public static function group(array $array, $field)
	{
		$group = [];
		foreach ($array as $value) {
			unset($key);

			if (is_array($value)) {
				if (isset($value[$field])) {
					$key = $value[$field];
				}
			} else if (is_object($value)) {
				if (isset($value->{$field})) {
					$key = $value->{$field};
				}
			}
			
			if (isset($key)) {
				if (false == isset($group[$key])) {
					$group[$key] = [];
				}
			
				$group[$key][] = $value;
			}
		}

		return $group;
	}

	public static function order(array $array, $order) {
		if (false === is_array($order)) {
			$order = [$order => SORT_ASC];
		} else {
			$clean = [];
			foreach ($order as $o => $s) {
				if (is_integer($o)) {
					$clean[$s] = SORT_ASC;
				} else {
					$clean[$o] = constant('SORT_' . strtoupper($s));
				}
			}
		}

		$order = $clean;
		unset($clean);

		$args = [];

		$sort = [];
		foreach ($array as $key => $value) {
			foreach ($order as $o => $s) {
				if (is_object($value)) {
					$sort[$o][$key] = (isset($value->{$o}) ? $value->{$o} : null);
				} else if (is_array($value)) {
					$sort[$o][$key] = (isset($value[$o]) ? $value[$o] : null);
				}
			}
		}
		
		foreach ($order as $o => $s) {
			$args[] = $sort[$o];
			$args[] = $s;
		}

		$args[] = &$array;

		call_user_func_array('array_multisort', $args);

		return $array;
	}

	public static function copy(array $array)
	{
		$result = [];
		foreach ($array as $key => $val) {
			if (is_array($val)) {
				$result[$key] = array_copy($val);
			} elseif (is_object($val)) {
				$result[$key] = clone $val;
			} else {
				$result[$key] = $val;
			}
		}
		
		return $result;
	}

	/**
	 *  
	 *
	 * @param array $arrays...
	 * @return 
	 */
	public static function cartesian()
	{			
		$args = func_get_args();
		
		if (count($args) == 0) {
			return [[]];
		}

		$a = array_shift($args);
		$c = call_user_func_array(__FUNCTION__, $args);
		$r = [];

		foreach ($a as $v) {
			foreach ($c as $p) {
				$r[] = array_merge([$v], $p);
			}
		}

		return $r;
	}

	public static function dropKey(array $array, $key)
	{
		$key = arrayify($key);

		foreach ($key as $k) {
			if (array_key_exists($k, $array)) {
				unset($array[$k]);
			}
		}

		return $array;
	}

	/**
	 * Rename array key
	 *
	 * @param array   $array     target array
	 * @param mixed   $old       old key
	 * @param mixed   $new       new key
	 * @param boolean $recursive flag
	 * @return array
	 */
	public static function renameKey(array $array, $old, $new, $recursive = false)
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

	/**
	 * Check if given array is associative
	 *
	 * @param array $array target array
	 * @return boolean
	 */
	public static function isAssoc(array $array)
	{
		return count(array_filter(array_keys($array), 'is_string')) > 0;
	}

	public static function rotate(array $array, $pos = 1)
	{
		$pos = (int)$pos;

		if ($pos == 0) {
			return $array;
		} else if ($pos < 0) {
			$array = array_reverse($array);
		}

		$l = abs($pos);
		for ($i = 0; $i < $l; $i++) {
			list($key, $value) = each($array);
			array_shift($array);
			$array = array_merge($array, [$key => $value]);
		}

		return ($pos < 0) ? array_reverse($array) : $array;
	}

	/**
	 * Returns the last key of an array
	 *
	 * @param array $array target array
	 * @return mixed
	 */
	public static function lastKey(array $array)
	{
		end($array);
		$key = key($array);
		reset($array);

		return $key;
	}

	/**
	 * Iterates over array, yielding each in turn to an iteratee function
	 *
	 * @param array    $array target array
	 * @param callable $call  callback function
	 * @return void
	 */
	public static function each(array $array, callable $call)
	{
		foreach ($array as $key => $value) {
			call_user_func_array($call, [$value, $key]);
		}
	}

	/**
	 * Drop given values from array and return cleaned
	 * 
	 * @param  array $array  target array
	 * @param  mixed $needle array or single value
	 * @return array 
	 */
	public static function drop(array $array, $needle = ['', 0, '0', false, null])
	{
		return array_diff($array, arrayify($needle));
	}

	/**
	 * If given argument is not array, convert it into array
	 *
	 * @param mixed $some argument
	 * @return array
	 */
	public static function arrayify($some)
	{
		if (!is_array($some)) {
			return [$some];
		}

		return $some;
	}

	/**
	 * Convert array to object
	 *
	 * @param array $array target array
	 * @return object
	 */
	public static function toObject(array $array)
	{
		return json_decode(json_encode ($array), false);
	}

	public static function fromObject($data)
	{
		if (is_array($data) || is_object($data)) {
			$result = array();
			foreach ($data as $key => $value) {
				$result[$key] = array_from_object($value);
			}
			
			return $result;
		}
		return $data;
	}

	/**
	 * Returns true if all of the values in the array pass the call truth test.
	 * Short-circuits and stops traversing the array if a false element is found.
	 *
	 * @param array    $array target array
	 * @param callable $call  callback function($value, $key) 
	 * @return boolean
	 */
	public static function all(array $array, callable $call)
	{
		if (!$array) return false;

		foreach ($array as $key => $value) {
			if (!call_user_func_array($call, [$value, $key])) {
				return false;
			}
		}

		return true;
	}

}
?>