<?php
if (!function_exists('array_sort_by_array')) {
    /**
     * Sort array by another array
     *
     * @param array $array  target array
     * @param array $sorter order array
     *
     * @return array
     */
    function array_sort_by_array(array $array, array $sorter)
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
