<?php
if (!function_exists('preg_drop')) {
    /**
     * [preg_drop description]
     * @param  [type]  $subject [description]
     * @param  [type]  $pattern [description]
     * @param  integer $limit   [description]
     * @param  integer &$count  [description]
     *
     * @return [type]           [description]
     */
	function preg_drop($subject, $pattern, $limit = -1, &$count = 0) {
		return preg_replace($pattern, '', $subject, $limit, $count);
	}
}
