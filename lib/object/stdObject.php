<?php
	class stdObject
	{
		public function __construct(array $arguments = array()) 
		{
			if ($arguments) {
				foreach ($arguments as $property => $argument) {
					$this->{$property} = $argument;
				}
			} 
		}

		public function has($key)
		{
			return (property_exists($this, $key) or method_exists($this, $key));
		}

		public function __call($method, $arguments)
		{
			if (isset($this->{$method}) and is_callable($this->{$method})) {
				array_unshift($arguments, $this);

				return call_user_func_array(
					$this->{$method},
					$arguments
				);
			} else {
				throw new \Exception(
					sprintf("Fatal error: Call to undefined method %s::%s", get_class($this), $method)
				);
			}
		}
	}
?>