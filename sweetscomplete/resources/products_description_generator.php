<?php
// Generate products descriptions

// get lorem ipsum
$lorem = file('lorem_ipsum.txt');

// database username
$user = 'class';
// database password
$pass = 'password';
// data source = mysql driver, localhost, database = class
$dsn = 'mysql:host=localhost;dbname=class';

// use try { // code } catch (PDOException $e) { // code } to trap errors
try {
	// set up the database connection and activate error checking
	$pdo = new PDO($dsn, $user, $pass, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));

	$sql = 'SELECT count(`product_id`) FROM `products`';
	$stmt = $pdo->prepare($sql);
	$stmt->execute();
	$result = $stmt->fetch(PDO::FETCH_NUM); 
	var_dump($result);
	$max = $result[0];
	$max++;
	
	// SQL
	$sql = 'UPDATE `products` '
		 . 'SET `description`= :ipsum '
		 . 'WHERE `product_id` = :id;';
	
	// prepare
	$stmt = $pdo->prepare($sql);

	for ($id = 1; $id < $max; $id++) {
		// execute
		$result = $stmt->execute(array('id' => $id, 'ipsum' => $lorem[$id]));
		echo $id . ' : ';
	}
	// closes the database connection
	$pdo = NULL;

// traps any exceptions which might be thrown
} catch (PDOException $e) {
	echo $e->getMessage();
	echo $e->getTraceAsString();
}
