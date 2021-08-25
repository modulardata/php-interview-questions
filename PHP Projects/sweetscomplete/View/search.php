<?php 
// results of products search
require './Model/Products.php';
$productTable = new Products();

// do search
if (isset($_GET['keyword']) && $_GET['keyword'] != 'keywords') {
	// safely quote the value for inclusion in an SQL statement
	$search = $productTable->pdoQuoteValue($_GET['keyword']);
	$products = $productTable->getProductsByTitleOrDescription($search);
} elseif (isset($_GET['title']) && $_GET['title']) {
	// convert to data type int for safety purposes
	$id = (int) $_GET['title'];
	$result = $productTable->getDetailsById($id);
	// redirect to details page
	header('Location: ?page=detail&id=' . $result['product_id']);
	exit;
} else {
	$products = array();
}
// figure out how many products
$howMany = count($products);

// get current offset
if (isset($_GET['offset'])) {
	$offset = (int) $_GET['offset'];
} else {
	$offset = 0;
}
// figure out if previous or next
if (isset($_GET['more'])) {
	if ($_GET['more'] == 'next') {
		$offset += $productTable->productsPerPage;
	} else {
		$offset -= $productTable->productsPerPage;
	}
} else {
	$offset = 0;
}
// adjust offset if < 0 or > $howMany
if ($offset < 0) {
	$offset = $howMany - $productTable->productsPerPage;
} elseif ($offset > $howMany) {
	$offset = 0;
}

$titles = $productTable->getProductTitles(); 
?>
<div class="content">

<div id="leftnav">
	<div class="search">

		<?php echo $view->searchForm($titles); ?>
		
		<h3>About Us</h3><br/>
		<p class="width180">Lorem ipsum dolor sit amet consectetuer. Lorem ipsum dolor sit amet consectetuer, Lorem ipsum dolor sit amet consectetuer
	  Lorem ipsum dolor sit amet consectetuer. Lorem ipsum dolor sit amet consectetuer. Lorem ipsum dolor sit amet consectetuer.  <a href="?page=about">Read More >> </a></p>
	</div>
</div><!-- leftnav -->


<div id="rightnav">

	<div class="product-list">
		<h2>Our Products</h2>
		<a class="pages" href="?page=products&more=previous&offset=<?php echo $offset; ?>">&lt;prev</a>
		&nbsp;|&nbsp;
		<a class="pages" href="?page=products&more=next&offset=<?php echo $offset; ?>">next&gt;</a>
		<ul>
			<?php foreach ($products as $row) { 	?>
			<?php	$link = '?page=detail&id=' . $row['product_id']; ?>
				<li>
					<div class="image">
						<a href="<?php echo $link; ?>">
						<img src="images/<?php echo $row['link']; ?>.JPG" alt="<?php echo $row['title']; ?>" width="190" height="130"/>
						</a>
					</div>
					<div class="detail">
						<p class="name"><a href="<?php echo $link; ?>"><?php echo $row['title']; ?></a></p>
						<p class="view"><a href="<?php echo $link; ?>">purchase</a> | <a href="<?php echo $link; ?>">view details >></a></p>
					</div>
				</li>
			<?php } // foreach ($products as $row)	?>
		</ul>
	</div><!-- product-list -->
	
</div><!-- rightnav -->

<br class="clear-all"/>
</div><!-- content -->
