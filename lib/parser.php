<?php
class HydrateDoc	
{
	public function walk($folder)
	{
		$iterator = new FilesystemIterator(__DIR__ . '/' . $folder);

		$stack = [];
		foreach ($iterator as $key => $value) {
			$name = str_replace('.php','',$value->getFilename());

			require_once $key;

			$stack[$name] = $this->parseDocBlock($name);
		}

		ksort($stack);

		return $stack;
	}

	public function parseDocBlock($name)
	{
		$fn = new ReflectionFunction($name);

		$proto = $fn->getParameters();
		$doc = $fn->getDocComment();
		
		$doc = explode(PHP_EOL, $doc);
		$doc = array_slice($doc, 1, -1);
		$doc = array_map(
			function($item){
				return substr(ltrim($item), 2);
			},
			$doc
		);
		
		$desc_end = array_search(false,$doc,true);
		$desc = implode(PHP_EOL,array_slice($doc,0, $desc_end));
		
		$params = array();
		$return = array();
		
		$doc = array_slice($doc, $desc_end + 1);
		$param_index = 0;
		foreach($doc as $item){
			$item = array_values(array_filter(explode(' ', $item)));
			
			if(!$item) continue;

			switch($item[0]){
				case '@param':
					$params[] = array(
						'name' => $item[2],
						'type' => $item[1],
						'desc' => implode(' ',array_slice($item, 3))
					);
					
					if(isset($proto[$param_index])){
						$proto_param = $proto[$param_index];
						if($proto_param->isDefaultValueAvailable()){
							$params[count($params) - 1]['def'] = var_export($proto_param->getDefaultValue(), true);
						}
					}
					
					$param_index++;
				break;
				
				case '@return':
					var_dump($item);

					$return = array(
						'type' => $item[1],
						'desc' => implode(' ', array_slice($item, 2))
					);
				break;
			}
		}
		
		$prototype = $return['type'] . ' ' . $name . '(' . 
			implode(', ', array_map(
				function($item){
					$arg = '';
					if(isset($item['type'])){
						$arg .= $item['type'] . ' ';
					}

					$arg .= $item['name'];

					if(isset($item['def'])){
						$arg .= ' = ' . $item['def'];
					}

					return $arg;
				},
				$params
			)) . ')';

		return array(
			'protos' => $prototype,
			'description' => $desc,
			'params' => $params,
			'return' => $return
		);
	}
}

$hd = new HydrateDoc();

$queue = ['array'];

foreach($queue as $q){
	$stack[$q] = @$hd->walk('array');
}

file_put_contents('/var/www/learn.php/hydrate/doc.json', json_encode($stack));
?>