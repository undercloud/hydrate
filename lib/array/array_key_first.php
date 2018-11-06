<?php
if (!function_exists('array_key_first')) {
    /**
     * Returns the first key of an array
     *
     * @param array $array target array
     *
     * @return mixed
     */
    function array_key_first(array $array)
    {
        foreach ($array as $key => $val) {
            return $key;
        }
    }
}
