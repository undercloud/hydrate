<?php
	class Foo
	{
		function isStaticContext()
		{
			return !(isset($this) && get_class($this) == __CLASS__);
		}
	}
?>