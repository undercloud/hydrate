<?php
if (!function_exists('array_unshift_assoc')) {
    /**
     * Prepend element with key and value to the beginning of an array,
     * and returns the new number of elements
     *
     * @param array &$array target array
     * @param mixed $key    new key
     * @param mixed $value  new value
     *
     * @return int
     */
    function array_unshift_assoc(array &$array, $key, $value)
    {
        $array = array_reverse($array, true);
        $array[$key] = $value;
        $array = array_reverse($array, true);

        return count($array);
    }
}
