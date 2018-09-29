<?php
if (false == function_exists('array_last_key')) {
    /**
     * Returns the last key of an array
     *
     * @param array $array target array
     *
     * @return mixed
     */
    function array_last_key(array &$array)
    {
        $last = array_slice($array, -1);

        return key($last);
    }
}
