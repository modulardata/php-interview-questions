<?php
// get product details
require './Model/Products.php';
$productTable = new Products();
// retrieve id from URL; filter by forcing to (int)
$id = (isset($_GET['id'])) ? (int) $_GET['id'] : 1;
// retrieve details from database
$details = $productTable->getDetailsById($id);
?>
<div class="content">	
	<br/>
	<div class="product-list">
		<h2>Product Details</h2>
		<br/>
		<div class="images">
			<a href="#">
				<img src="images/<?php echo $details['link']; ?>.scale_20.JPG" alt="<?php echo $details['title']; ?>" width="350" />
			</a>
		</div>
		<div class="details">
			<h3>SKU: <?php echo $details['sku']; ?></h3><br/>
			<h1 class="name"><b><?php echo $details['title']; ?></b></h1><br/>
			<p class="desc"><?php echo $details['description']; ?></p><br/>
			<p class="view"><b>Price: £<?php echo $details['price']; ?></b></p><br/>
			<form action="?page=purchase" method="GET">
			<p class="view">
				<label>Qty:</label> <input type="text" value="1" name="qty" class="s0" size="2" />
				<input type="submit" name="purchase" value="Buy this item" class="button"/>
				<input type="hidden" name="price" value="<?php echo $details['price']; ?>" />
				<input type="hidden" name="productID" value="<?php echo $id; ?>" />
				<input type="hidden" name="page" value="purchase" />
			</p>
			</form>
		</div>
	</div><!-- product-list -->
<br class="clear-all"/>
</div><!-- content -->
