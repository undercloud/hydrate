<?php
if (!function_exists('array_group')) {
    /**
     * Group array values by specified key
     *
     * @param array $array  target array
     * @param mixed $key    key for group
     * @param mixed $subkey additional bound
     *
     * @return array
     */
    function array_group(array $array, $key, $subkey = null)
    {
        $groupped = [];
        foreach ($array as $value) {
            if (!isset($value[$key])) {
                continue;
            }

            $index = $value[$key];
            if (null !== $subkey) {
                $value = (isset($value[$subkey]) ? $value['subkey'] : null);
            }

            $groupped[$index][] = $value;
        }

        return $groupped;
    }
}
