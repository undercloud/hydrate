<?php
if (!function_exists('array_is_multi')) {
    /**
     * Check if given array is multidimensional
     *
     * @param array $array target array
     *
     * @return boolean
     */
    function array_is_multi(array $array)
    {
        return (count($array) !== count($array, true));
    }
}
