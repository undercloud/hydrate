#!/usr/bin/php
<?php
	$lib = __DIR__ . '/lib';
	$bld = __DIR__ . '/build';

	function normalize($src, $soft = false)
	{
		$from = 2;
		$to = -2;

		if ($soft) {
			$from = 1;
			$to  =-1;
		}

		$src = explode(PHP_EOL, $src);
		$src = array_slice($src, $from, $to);
		$src = implode(PHP_EOL, $src);

		return $src;
	}

	function buildfolder($path)
	{
		$basename = basename($path);
		$fs = new FilesystemIterator($path);

		$raw = $norm = $class = '';
		foreach ($fs as $p => $f) {
			$cont = file_get_contents($p);

			$raw  .= normalize($cont, true) . PHP_EOL . PHP_EOL;
			$norm .= normalize($cont) . PHP_EOL . PHP_EOL;
			$class .= preg_replace_callback(
				'~function (.*)~',
				function($e) {
					$e[1] = preg_replace('~^array_~' ,'', $e[1]);

					$cleanfn = preg_replace_callback(
						'~_([a-z])~',
						function($f) {
							return strtoupper($f[1]);
						},
						$e[1]
					);
					return 'public static function ' . $cleanfn;
				},
				normalize($cont)
			) . PHP_EOL . PHP_EOL;

		}

		global $bld;

		file_put_contents(
			$bld . '/default/' . $basename . '.php',
			'<?php ' . PHP_EOL . $raw . '?>'
		);

		file_put_contents(
			$bld . '/hydrate/' . $basename . '.php',
			'<?php ' . PHP_EOL . 
				'namespace hydrate ' . PHP_EOL . 
				'{' . PHP_EOL . 
					$norm . 
				'}' . PHP_EOL . 
			'?>');

		file_put_contents(
			$bld . '/class/' . ucfirst($basename) . 's' . '.php',
			'<?php ' . PHP_EOL . 
				'namespace Hydrate ' . PHP_EOL . PHP_EOL . 
				'class ' . ucfirst($basename) . 's' . PHP_EOL . 
				'{' . PHP_EOL . 
					$class . 
				'}' . PHP_EOL . 
			'?>'
		);
	}

	buildfolder($lib . '/array');

?>