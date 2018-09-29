<?php
if (!function_exists('array_map_assoc')) {
    /**
     * Applies the callback to the elements of the given array
     *
     * @param array    $assoc target array
     * @param callable $call  callable function($key, $value)
     *
     * @return array
     */
    function array_map_assoc(array $assoc, callable $call)
    {
        return array_map($call, array_keys($assoc), $assoc);
    }
}
