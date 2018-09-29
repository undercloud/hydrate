<?php
if (!function_exists('array_rename_key')) {
    /**
     * Rename array key
     *
     * @param array $array target array
     * @param array $pairs keys map
     *
     * @return array
     */
    function array_rename_key(array $array, array $pairs)
    {
        foreach ($pairs as $old => $new) {
            $array[$new] = $array[$old];
            unset($array[$old]);
        }

        return $array;
    }
}
