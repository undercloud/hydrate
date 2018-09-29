<?php
if (!function_exists('array_cartesian')) {
    /**
     * Return cartesian product for array
     *
     * @param array $arrays... variants
     *
     * @return array
     */
    function array_cartesian()
    {
        $args = func_get_args();

        $first = (array) array_shift($args);
        $call = call_user_func_array(__FUNCTION__, $args);

        $result = [];
        foreach ($first as $f) {
            foreach ($call as $c) {
                $result[] = array_merge([$f], $c);
            }
        }

        return $result;
    }
}
