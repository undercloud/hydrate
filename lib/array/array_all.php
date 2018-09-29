<?php
if (!function_exists('array_all')) {
    /**
     * Returns true if all of the values in the array pass the call truth test,
     * otherwise it returns an array with fail elements
     *
     * @param array    $array target array
     * @param callable $call  callback function($value, $key)
     *
     * @return boolean|array
     */
    function array_all(array $array, callable $call)
    {
        if (!$array) {
            return false;
        }

        $fail = [];
        foreach ($array as $key => $value) {
            if (!call_user_func($call, $value, $key)) {
                $fail[$key] = $value;
            }
        }

        return $fail ? : true;
    }
}
