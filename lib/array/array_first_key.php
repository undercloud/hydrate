<?php
if (!function_exists('array_first_key')) {
    /**
     * Returns the first key of an array
     *
     * @param array $array target array
     *
     * @return mixed
     */
    function array_first_key(array $array)
    {
        foreach ($array as $key => $val) {
            return $key;
        }
    }
}
