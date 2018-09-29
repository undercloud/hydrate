<?php
if (!function_exists('array_bound')) {
    /**
     * Return array with specified keys
     *
     * @param array   $array   target array
     * @param array   $keys    keys
     * @param boolean $reverse if equal true return array without specified keys
     *
     * @return array
     */
    function array_bound(array $array, array $keys, $reverse = false)
    {
        if (!$array) {
            return [];
        }

        $keys = array_map(function ($item) {
            if (is_numeric($item)) {
                return (string) $item;
            }

            return $item;
        }, $keys);

        $reverse = (bool) $reverse;

        $bound = [];
        foreach ($array as $key => $value) {
            if (is_numeric($key)) {
                $key = (string) $key;
            }

            if ($reverse != in_array($key, $keys)) {
                $bound[$key] = $value;
            }
        }

        return $bound;
    }
}
