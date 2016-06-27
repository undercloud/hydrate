<?php
class ArraysTest extends Asserton
{
	public function __construct()
	{
		$this->resolveDepends('/array');
	}

	public function testArrayAll()
	{
		$array = [3,6,9,5,2,8];
		$call = function($i) { return $i > 0; };
		$is = array_all($array, $call);

		$this->equal(true, $is);
	}

	public function testArrayAny()
	{
		$array = [7,9,4,3,5,4];
		$call = function($i) { return $i == 9; };
		$is = array_any($array, $call);

		$this->equal(true, $is);
	}

	public function testArrayBound()
	{
		$array = [
			'x' => 'X',
			'y' => 'Y',
			'z' => 'Z'
		];

		$arrayTrueBound = [
			'x' => 'X',
			'y' => 'Y'
		];

		$arrayFalseBound = [
			'z' => 'Z'
		];

		$this->equal($arrayTrueBound,  array_bound($array, ['x','y']));
		$this->equal($arrayFalseBound, array_bound($array, ['x','y'], true));
	}

	public function testArrayCartesian()
	{
		$names      = ['John', 'Paul', 'George'];
		$surnames   = ['Red', 'Green', 'Blue'];
		$ages       = [24, 28];


		var_dump(array_cartesian($names,$surnames,$ages));
	}

	public function testArrayCast()
	{
		$obj = new stdClass;
		$array = [0,'a','b',2,8,null,false,$obj];

		$this->equal([0,2,8], array_values(array_cast($array, 'integer')));
		$this->equal([0,'a','b',2,8], array_values(array_cast($array, ['integer','string'])));
		$this->equal([$obj],array_values(array_cast($array,'stdClass')));
		$this->equal([0,null,false],array_values(array_cast($array,function($e){
			return !$e;
		})));
	}

	public function testArrayDrop()
	{
		$array = [0,'a','b',2,8,null,false];

		$this->equal(['a','b',2,8], array_values(array_drop($array)));
	}

	public function testArrayDropkey()
	{
		$array = [
			'foo' => 'Foo',
			'bar' => 'Bar',
			'baz' => 'Baz'
		];

		$unset = [
			'baz' => 'Baz'
		];

		$this->equal($unset, array_drop_key($array, ['foo', 'bar']));

		$unset = [
			'foo' => 'Foo',
			'baz' => 'Baz'
		];

		$this->equal($unset, array_drop_key($array, 'bar'));
	}

	public function testArrayEach()
	{
		$array = [
			'foo' => 'Foo',
			'bar' => 'Bar'
		];

		array_each($array, function($value,$key)use($array){
			$this->equal($value,$array[$key]);
		});
	}

	public function testArrayFirst()
	{
		$array = [
			'foo' => 'Foo',
			'bar' => 'Bar',
			'baz' => 'Baz'
		];

		$this->equal('Foo', array_first($array));
	}

	public function testArrayFirstKey()
	{
		$array = [
			'foo' => 'Foo',
			'bar' => 'Bar',
			'baz' => 'Baz'
		];

		$this->equal('foo', array_first_key($array));
	}

	public function testArrayFlat()
	{
		$array = [
			[1,2,3],
			[4,5,6],
			[7,8,9]
		];

		$this->equal(range(1, 9), array_flat($array));
	}

	public function testArrayForget()
	{

	}

	public function testArrayFromObject()
	{
		$object = new stdClass;
		$object->foo = 'Bar';

		$array = [
			'foo' => 'Bar'
		];

		$this->equal($array, array_from_object($object));
	}

	public function testArrayGet()
	{

	}

	public function testArrayGroup()
	{

	}

	public function testArrayHas()
	{

	}

	public function testArrayIndex()
	{

	}

	public function testArrayToObject()
	{
		$array = [
			'foo' => 'Bar'
		];

		$object = new stdClass;
		$object->foo = 'Bar';

		//$this->equal($object, array_to_object($array));
	}

	public function testArrayLast()
	{
		$array = [
			'foo' => 'Foo',
			'bar' => 'Bar',
			'baz' => 'Baz'
		];

		$this->equal('Baz', array_last($array));
	}

	public function testArrayLastKey()
	{
		$array = [
			'foo' => 'Foo',
			'bar' => 'Bar',
			'baz' => 'Baz'
		];

		$this->equal('baz', array_last_key($array));
	}

	public function testArrayUnshiftAssoc()
	{
		$array = [
			'bar' => 'Bar'
		];

		$this->equal(2, array_unshift_assoc($array,'foo','Foo'));
		$this->equal('foo',array_first_key($array));
		$this->equal('Foo',array_first($array));
	}

	public function testArrayPartition()
	{
		$array = [9,0,4,5,7,3,1,2,8,6];

		$ok = [0,4,2,8,6];
		$fail = [9,5,7,3,1];

		list($lok,$lfail) = array_partition($array, function($value, $key){
			return (($value % 2) == 0);
		});

		$this->equal($ok,array_values($lok));
		$this->equal($fail,array_values($lfail));
	}

	public function testArrayRest()
	{
		$array = [4,7,8,0,2];

		$this->equal([7,8,0,2],array_rest($array));
		$this->equal([0,2],array_rest($array,3));
	}

	public function testArrayInitial()
	{
		$array = [4,7,8,0,2];

		$this->equal([4,7,8,0],array_initial($array));
		$this->equal([4,7],array_initial($array,3));
	}

	public function testArrayRotate()
	{
		$array = [5,7,8,6,4];

		$this->equal([7,8,6,4,5],array_rotate($array));
		$this->equal([8,6,4,5,7],array_rotate($array,2));
		$this->equal([6,4,5,7,8],array_rotate($array,-2));
	}

	public function testArrayIsAssoc()
	{

	}

	public function testArrayIsMulti()
	{

	}

	public function testArrayMapAssoc()
	{

	}

	public function testArrayOnly()
	{

	}

	public function testArrayRange()
	{

	}

	public function testArrayRenameKey()
	{

	}

	public function testArraySet()
	{

	}
}
?>