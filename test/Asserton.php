<?php
class Asserton
{
	public static function init()
	{
		return new self();
	}

	public function resolveDepends($folder)
	{
		$iterator = new FilesystemIterator(__DIR__ . '/../lib/' . $folder);
		foreach ($iterator as $key => $value) {
			require_once $key;
		}
	}

	public function visit($name)
	{
		$refclass = new ReflectionClass($name);

		$instance = $refclass->newInstance();
		foreach($refclass->getMethods() as $method){
			if($method->isPublic()){
				$name = $method->getName();
				if(0 === strpos($name, 'test')){
					call_user_method($name, $instance);
				}
			}
		}

		return $this;
	}

	public function raise()
	{
		$trace = debug_backtrace();

		$call = $trace[1]; 
		$case = $trace[2];

		$param_dumper = function($item){
			return var_export($item, true);
		};

		$case = ($case['class'] . '::' . $case['function']);
		$call = $call['function'] . '(' . implode(',', array_map($param_dumper, $call['args'])) . ')';

		die('Assertion fail: ' . $case . ': ' . $call);
	}

	public function equal($left, $right)
	{
		if (!($left === $right)) {
			$this->raise();
		}
	}

	public function notEqual($left, $right)
	{
		if ($left === $right) {
			
		}
	}
}

?>