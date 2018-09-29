<?php
if (!function_exists('array_last')) {
    /**
     * Returns the last element of an array
     *
     * @param array $array target array
     *
     * @return mixed
     */
    function array_last(array &$array)
    {
        $last = array_slice($array, -1);

        return reset($last);
    }
}
