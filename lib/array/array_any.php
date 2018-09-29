<?php
if (!function_exists('array_any')) {
    /**
     * Returns an array with validated elements, otherwise returns false
     *
     * @param array    $array target array
     * @param callable $call  callback function($value, $key)
     *
     * @return boolean|array
     */
    function array_any(array $array, callable $call)
    {
        $ok = [];
        foreach ($array as $key => $value) {
            if (call_user_func($call, $value, $key)) {
                $ok[$key] = $value;
            }
        }

        return $ok ? : false;
    }
}
