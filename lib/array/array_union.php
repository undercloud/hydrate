<?php
if (!function_exists('array_union')) {
    /**
     * Union two arrays by given keys
     *
     * @param array $main
     * @param mixed $id
     */
    function array_union(array $what, array $with, $to, $by)
    {
        if (!$with) {
            return $what;
        }

        if (!function_exists('array_values')) {
            require_once(__DIR__ . '/array_values.php');
        }

        $with = array_index($with, $by);

        return array_map(function ($item) use ($with, $to) {
            $key = $item[$to];
            if (isset($with[$key])) {
                $item = array_merge((array) $item, $with[$key]);
            }

            return $item;
        }, $what);
    }
}
