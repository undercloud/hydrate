<?php
if (!function_exists('array_rotate')) {
    /**
     * Rotate array and return it
     *
     * @param array $array target array
     * @param int   $num   offset
     *
     * @return array
     */
    function array_rotate(array $array, $num = 1)
    {
        $num = (int) $num;

        if ($num == 0) {
            return $array;
        } elseif ($num < 0) {
            $array = array_reverse($array);
        }

        $l = abs($num);
        for ($i = 0; $i < $l; $i++) {
            list($key, $value) = each($array);
            array_shift($array);
            $array = array_merge($array, [$key => $value]);
        }

        return ($num < 0) ? array_reverse($array) : $array;
    }
}
