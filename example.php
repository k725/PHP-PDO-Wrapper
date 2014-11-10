<?php
	require_once('PdoWrapper.class.php');

	$hostname = 'localhost';
	$username = 'root';
	$password = 'test';
	$charset  = 'utf8';
	$database = 'testdb';

	$pdo = new PDOWrapper($hostname, $database, $charset, $username, $password);

	$sql  = 'SELECT * FROM `TestTable` WHERE foo = ? AND bar = ?';
	$sql2 = 'UPDATE `TestTable` SET foo = ? WHERE bar = ?';

	// Result is multidimensional array. (Associative array)
	$result = $pdo->getData($sql, array(
		'foo' => PDO::PARAM_STR, // foo
		12345 => PDO::PARAM_INT  // bar
	));

	// Result is array. (Associative array)
	$result2 = $pdo->getTopData($sql, array(
		'foo' => PDO::PARAM_STR, // foo
		12345 => PDO::PARAM_INT  // bar
	));

	$pdo->runSql($sql2, array(
		'foo' => PDO::PARAM_STR, // foo
		12345 => PDO::PARAM_INT  // bar
	));

	$this->classDataBase->closeStmt();

	var_dump($result, $result2);