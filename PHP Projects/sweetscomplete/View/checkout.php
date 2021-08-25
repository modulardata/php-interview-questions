<?php
// get product details
require './Model/Products.php';
$productTable = new Products();

// retrieve id
if (isset($_GET['id'])) {
	// force to int
	$id = (int) $_GET['id'];
} else {
	$id = 1;
}

// back to shopping
if (isset($_POST['back'])) {
	header('Location: ?page=products');
	exit;

// process removals
} elseif (isset($_POST['change'])) {
	if (isset($_POST['remove'])) {
		foreach ($_POST['remove'] as $key => $id) {
			$value = (int) $id;
			$productTable->delProductFromCart($id);
		}
	} 
	if (isset($_POST['update'])) {
		foreach ($_POST['update'] as $key => $id) {
			if (isset($_POST['qty'][$key])) {
				$id = (int) $id;
				$qty = $_POST['qty'][$key];
				$productTable->updateProductInCart($id, $qty);
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
			<?php $total = 0;					?>
			<?php foreach ($cart as $item) { 	?>
			<?php	$total += (int) $item['quantity'] * (float) $item['price'];	?>
			<?php	$link = '?page=detail&id=' . $item['product_id']; ?>
			<tr>
				<td><?php echo $item['sku']; ?></td>
				<td><a href="<?php echo $link; ?>">
					<img src="images/<?php echo $item['link']; ?>.scale_20.JPG" alt="<?php echo $item['title']; ?>" width="60" height="60" />
					</a>
				</td>
				<td><?php echo $item['title']; ?></td>
				<td>Qty: <br /><input type="text" value="<?php echo $item['quantity']; ?>" name="qty[]" class="s0" size="2" /></td>
				<td align="right"><?php printf('%8.2f', $item['price']); ?></td>
				<td align="right"><?php printf('%8.2f', $item['quantity'] * $item['price']); ?></td>
				<td><table>
					<tr>
						<td>Remove</td>
						<td><input type="checkbox" name="remove[]" value="<?php echo $item['product_id']; ?>" title="Remove" /></td>
					</tr>
					<tr>
						<td>Update</td>
						<td><input type="checkbox" name="update[]" value="<?php echo $item['product_id']; ?>" title="Update" /></td>
					</tr>
					</table>
				</td>
			</tr>
			<?php }		?>
			<tr>
				<th colspan="5">Total:</th>
				<th colspan="2"><?php printf('%8.2f', $total); ?></th>
			</tr>
		</table>
		
		<br/>
		
		<p align="center">
			<form action="?page=checkout" method="post">
			<input type="submit" name="back" value="Back to Shopping" class="button"/>
			</form>
			<form action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post">
			<input type="hidden" name="cmd" value="_s-xclick">
			<input type="hidden" name="hosted_button_id" value="7HAZFUET4PMVU">
			<input type="image" src="https://www.sandbox.paypal.com/en_US/i/btn/btn_buynowCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
			<img alt="" border="0" src="https://www.sandbox.paypal.com/en_US/i/scr/pixel.gif" width="1" height="1">
			<input type="hidden" name="amount" value="<?php echo $total; ?>" />
			<input type="hidden" name="shipping" value="<?php echo $total * .1; ?>" />
			<input type="hidden" name="tax" value="<?php echo $total * .1; ?>" />
			<input type="hidden" name="return" value="?page=thanks" />
			<input type="hidden" name="cancel_return" value="?page=home" />
			<input type="hidden" name="image_url" value="http://sweetscomplete.com/images/logo.png" />
			</form>
		<p>
		<p>&nbsp;</p>
		<p>&nbsp;</p>
		</form>
	</div>

</div><!-- content -->
