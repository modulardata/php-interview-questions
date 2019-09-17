<?php
// get product details
require './Model/Products.php';
$productTable = new Products();
$products = $productTable->getProductsOnSpecial(3);
$titles = $productTable->getProductTitles(); 
?>
<div class="content">
	
	<div class="search left">
		<?php echo $view->searchForm($titles); ?>
	</div>
	
	<div class="intro left">
	  <h3>About Us</h3><br/>
	  <p>Lorem ipsum dolor sit amet consectetuer. Lorem ipsum dolor sit amet consectetuer, Lorem ipsum dolor sit amet consectetuer
	  Lorem ipsum dolor sit amet consectetuer. Lorem ipsum dolor sit amet consectetuer. Lorem ipsum dolor sit amet consectetuer.
	  <a href="?page=about">Read More</a>
	  </p>
	</div>
	<br class="clear"/>
	<br/>
		
	<div class="product-list">
		<h2>Some Specials</h2>
		
		<ul class="specials">
			<?php foreach ($products as $row) { 	?>
			<?php	$link = '?page=detail&id=' . $row['product_id']; ?>
				<li>
					<div class="image">
						<a href="<?php echo $link; ?>">
						<img src="images/<?php echo $row['link']; ?>.scale_20.JPG" alt="<?php echo $row['title']; ?>" width="190" height="130"/>
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
	
	<br class="clear-all"/>
</div><!-- content -->
