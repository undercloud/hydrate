<?php
if (false == function_exists('array_key_last')) {
    /**
     * Returns the last key of an array
     *
     * @param array $array target array
     *
     * @return mixed
     */
    function array_key_last(array &$array)
    {
        $last = array_slice($array, -1);

        return key($last);
    }
}
