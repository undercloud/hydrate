<?php
if (false == function_exists('array_is_assoc')) {
    /**
     * Check if given array is associative
     *
     * @param array $array target array
     * 
     * @return boolean
     */
    function array_is_assoc(array $array)
    {
        return count(array_filter(array_keys($array), 'is_string')) > 0;
    }
}
