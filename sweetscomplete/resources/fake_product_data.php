<?php
include '../Model/Products.php';
$products = new Products();
$all = $products->getAllProducts();
$pdo = $products->getPdo();
$photos = array('326_2841738', '430_3150132', '430_3151480', '700_3473780', '700_3473780', '95_2542284', '167_2835774', '185_2577502');
$max = count($photos) - 1;
foreach ($all as $row) {
	echo $row['title'];
	if (stripos($row['link'], 'photospin')) {
		$sql = 'UPDATE `products` SET `link` = ? WHERE `product_id` = ?';
		$stmt = $pdo->prepare($sql);
		$newLink = $photos[rand(0,$max)];
		$stmt->execute(array($newLink, $row['product_id']));
		echo ':', $newLink;
	}
	echo PHP_EOL;
}
