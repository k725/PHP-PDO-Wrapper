PHP-PDO-Wrapper
===============

This class is a simple and very minimum.


----------

Example
-------

Check the ``example.php``

Load

	require_once('PdoWrapper.class.php');

Initialize

	$pdo = new PDOWrapper($hostname, $database, $charset, $username, $password);

Run (Required results)

	$sql  = 'SELECT * FROM `TestTable` WHERE foo = :foo AND bar = :bar';

	// Result is multidimensional array. (Associative array)
	$result = $pdo->getData($sql, array(
		':foo' => array('foo', PDO::PARAM_STR), // foo
		':bar' => array(12345, PDO::PARAM_INT)  // bar
	));

	// Result is array. (Associative array)
	$result2 = $pdo->getTopData($sql, array(
		':foo' => array('foo', PDO::PARAM_STR), // foo
		':bar' => array(12345, PDO::PARAM_INT)  // bar
	));

	var_dump($result, $result2); // Result!!

Run (Not required results)

	$sql2 = 'UPDATE `TestTable` SET foo = :foo WHERE bar = :bar';
	$pdo->runSql($sql, array(
		':foo' => array('foo', PDO::PARAM_STR), // foo
		':bar' => array(12345, PDO::PARAM_INT)  // bar
	));

Finalize

``__destruct`` is automatically run.

	$pdo = null; // Bad
	unset($pdo); // Bad
	// Good


----------

LICENSE
-------

This software is licensed under the MIT/X11 License.
See LICENSE for more detail.