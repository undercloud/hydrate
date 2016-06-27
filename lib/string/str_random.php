<?php
if (false == function_exists('str_random')) {
	function str_random($len, array $alph = [])
	{
		$len = (int)$len;

		if (!$alph) {
			$alph = array_merge(
				range('A', 'Z'),
				range('a', 'z'),
				range('0', '9')
			);
		}

		$rand = '';
		$alph_len = count($alph);
		for ($i = 0; $i < $len; $i++) {
			$index = mt_rand(0, $alph_len);
			$rand .= $alph[$index];
		}

		return $rand;
	}
}
?>
