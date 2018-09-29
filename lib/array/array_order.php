<?php
if (!function_exists('array_order')) {
    /**
     *
     *
     */
    function array_order(array $array, $order)
    {
        $args = [];
        foreach ($order as $field => $direct) {
            $args[] = array_column($array, $field);
            $args[] = constant('SORT_' . strtoupper($direct));
            $args[] = SORT_NATURAL;
        }

        $args[] = &$array;
        call_user_func_array('array_multisort', $args);

        return array_pop($args);
    }
}
