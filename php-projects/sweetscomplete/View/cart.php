<?php
// get product details
require './Model/Products.php';
$productTable = new Products();

// process checkout
if (isset($_POST['checkout']) && isset($_SESSION['cart'])) {
	header('Location: ?page=checkout');
	exit;

// back to shopping
} elseif (isset($_POST['back'])) {
	header('Location: ?page=products');
	exit;

// process updates or removals
} elseif (isset($_POST['change'])) {
	if (isset($_POST['remove'])) {
		// $key = product_id
		foreach ($_POST['remove'] as $key => $value) {
			$key = (int) $key;
			$productTable->delProductFromCart();
		}
	} 
	if (isset($_POST['update'])) {
		// $key = product_id
		foreach ($_POST['update'] as $key => $value) {
			$key = (int) $key;
			$qty = (isset($_POST['qty'][$key])) ? (int) $_POST['qty'][$key] : 0;
			if ($qty) {
				$productTable->updateProductInCart($key, $qty);
			}
		}
	}
}

// pull stuff from cart table using session_id() as key
$cart = $productTable->getShoppingCart(session_id());
?>
<div class="content">
<br/>
	<div class="product-list">
		<h2>Shopping Basket</h2>
		<br/>
		<form action="#" method="POST">
		<table>
			<tr>
				<th>Item No.</th>
				<th>Product</th>
				<th width="40%">Name</th>
				<th>Amount</th>
				<th width="10%" align="right">Price</th>
				<th width="10%" align="right">Extended</th>
				<th>&nbsp;</th>
			</tr>
			<?php echo $view->displayCart($cart); ?>
		</table>
		
		<br/>
		
		<p align="center">
			<input type="submit" name="back" value="Back to Shopping" class="button"/>
			<input type="submit" name="change" value="Update" class="button"/>
			<input type="submit" name="checkout" value="Checkout" class="button"/>
		<p>
		</form>
	</div>

</div><!-- content -->
