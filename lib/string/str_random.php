<?php
if (false == function_exists('str_random')) {
	function str_random($len, array $alph = [])
	{
		$len = (int) $len;

		if (!$alph) {
			$alph = array_merge(
				range('A', 'Z'),
				range('a', 'z'),
				range('0', '9')
			);
		}

        shuffle($alph);

        return implode(array_rand(array_flip($alph), $len));
	}
}
