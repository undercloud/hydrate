<?php
if (!function_exists('array_index')) {
    /**
     * Create array index by given key
     *
     * @param array $array  target array
     * @param mixed $key    index
     * @param mixed $subkey additional bound
     *
     * @return array
     */
    function array_index(array &$array, $key, $subkey = null)
    {
        $indexed = [];
        foreach ($array as $value) {
            if (!isset($value[$key])) {
                continue;
            }

            $index = $value[$key];
            if (null !== $subkey) {
                $value = (isset($value[$subkey]) ? $value['subkey'] : null);
            }

            $indexed[$index] = $value;
        }

        return $indexed;
    }
}
