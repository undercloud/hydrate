<?php
	require __DIR__ . '/Asserton.php';
	require __DIR__ . '/ArraysTest.php';

	Asserton::init()->visit('ArraysTest');

	echo 'All Ok';
?>