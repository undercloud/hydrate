<?php
if (!function_exists('array_only')) {
    /**
     * Retrieve array vaues by given keys
     *
     * @param array $array target array
     * @param array $keys  list of target keys
     *
     * @return array
     */
    function array_only(array $array, array $keys)
    {
        $list = [];
        foreach ($keys as $key => $value) {
            $list[] = isset($array[$key]) ? $array[$key] : null;
        }

        return $list;
    }
}
