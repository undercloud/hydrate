<?php
if (!function_exists('array_partition')) {
    /**
     * Split array into two arrays:
     * one whose elements all satisfy predicate
     * and one whose elements all do not satisfy predicate.
     *
     * @param array    $array target array
     * @param callable $call  callback function($value, $key)
     *
     * @return array
     */
    function array_partition(array $array, callable $call)
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
}
