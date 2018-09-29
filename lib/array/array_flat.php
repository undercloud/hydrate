<?php
if (!function_exists('array_flat')) {
    /**
     * Flattens a nested array (the nesting can be to any depth) and return it
     *
     * @param array $array target array
     *
     * @return array
     */
    function array_flat($array)
    {
        $output = [];
        if (is_array($array)) {
            foreach ($array as $element) {
                $output = array_merge($output, array_flat($element));
            }
        } else {
            $output[] = $array;
        }

        return $output;
    }
}
