<?php
// PHP and MySQL Project
// products table data class

class Products
{
	public $companyName = 'Sweets Complete';
	public $page 		= 'Home';
	public $debug		= TRUE;
	public $productsPerPage = 9;
	public $howManyProducts = 0;
	
	protected $db_pdo;
	
	/*
	 * Returns database row for $productsPerPage number of products
	 * @param int $offset
	 * @return array(array $row[] = array('title' => title, 'description' => description, etc.))
	 */
	public function getProducts($offset = 0)
	{
		$pdo = $this->getPdo();
		$sql = 'SELECT * FROM `products` ORDER BY `title` LIMIT ' . $this->productsPerPage . ' OFFSET ' . $offset;
		$stmt = $pdo->prepare($sql);
		$stmt->execute();
		$content = array();
		while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
			$content[] = $row;
		}
		return $content;
	}
	/*
	 * Returns database rows for all products
	 * @return array(array $row[] = array('title' => title, 'description' => description, etc.))
	 */
	public function getAllProducts()
	{
		$pdo = $this->getPdo();
		$sql = 'SELECT * FROM `products`';
		$stmt = $pdo->prepare($sql);
		$stmt->execute();
		$content = array();
		while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
			$content[] = $row;
		}
		return $content;
	}
	/*
	 * Returns an associative array with product_id as key and title as value for all products
	 * @return array['product_id'] = title
	 */
	public function getProductTitles()
	{
		$pdo = $this->getPdo();
		$sql = 'SELECT `product_id`, `title` FROM `products`';
		$stmt = $pdo->prepare($sql);
		$stmt->execute();
		$content = array();
		while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
			$content[$row['product_id']] = $row['title'];
		}
		asort($content, SORT_STRING);
		return $content;
	}
	/*
	 * Returns database row for 1 product
	 * @param int $id = product ID
	 * @return array $row[] = array('title' => title, 'description' => description, etc.)
	 */
	public function getDetailsById($id)
	{
		$pdo = $this->getPdo();
		$sql = 'SELECT * FROM `products` WHERE `product_id` = ?';
		$stmt = $pdo->prepare($sql);
		$stmt->execute(array($id));
		$result = $stmt->fetch(PDO::FETCH_ASSOC);
		return $result;
	}
	public function getHowManyProducts()
	{
		if (!$this->howManyProducts) {
			$pdo = $this->getPdo();
			$sql = 'SELECT COUNT(*) FROM `products`';
			$stmt = $pdo->prepare($sql);
			$stmt->execute();
			// fetches as a numeric array
			$result = $stmt->fetch(PDO::FETCH_NUM);
			$this->howManyProducts = $result[0];
		}	
		return $this->howManyProducts;
	}
	/*
	 * Returns array of arrays where each sub-array = 1 database row of products
	 * Returns only those products which are on special
	 * @param int $limit = how many specials to show
	 * @return array $row[] = array('title' => title, 'description' => description, etc.)
	 */
	public function getProductsOnSpecial($limit = 0)
	{
		$pdo = $this->getPdo();
		$sql = 'SELECT * FROM `products` WHERE `special` = 1 ORDER BY `title`';
		if ($limit) {
			$sql .= ' LIMIT ' . $limit;
		}
		$stmt = $pdo->prepare($sql);
		$stmt->execute();
		$content = array();
		while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
			$content[] = $row;
		}
		return $content;
	}
	/*
	 * Returns array of arrays where each sub-array = 1 database row of products
	 * Searches title and description fields
	 * @param string $search
	 * @return array $row[] = array('title' => title, 'description' => description, etc.)
	 */
	public function getProductsByTitleOrDescription($search)
	{
		// strip out any unwanted characters to help prevent SQL injection
		$search = strip_tags($search);
		$search = str_ireplace(array("'",'-','"',';'), '', $search);
		$search = "'%" . $search . "%'";
		$pdo = $this->getPdo();
		$sql = 'SELECT * FROM `products` WHERE '
			  . '`title` LIKE ' . $search . ' OR '
			  . '`description` LIKE ' . $search . ' ORDER BY `title`';
		$stmt = $pdo->prepare($sql);
		$stmt->execute();
		$content = array();
		while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
			$content[] = $row;
		}
		return $content;
	}
	/*
	 * Returns all products in shopping cart from $_SESSION
	 * @return array $row[] = array('title' => title, 'description' => description, etc.)
	 */
	public function getShoppingCart()
	{
		$content = (isset($_SESSION['cart'])) ? $_SESSION['cart'] : array();
		return $content;
	}
	/*
	 * Adds purchase to basket
	 * @param int $id = product ID
	 * @param int $quantity
	 * @param float $price (NOTE: sale_price in the `purchases` table = $quantity * $price
	 * @return boolean $success
	 */
	public function addProductToCart($id, $quantity, $price)
	{
		$item = $this->getDetailsById($id);
		$item['quantity'] 		= $quantity;
		$item['price']			= $price;
		$_SESSION['cart'][$id] 	= $item;
		return TRUE;
	}
	/*
	 * Removes purchase from basket
	 * @param int $productID
	 * @return boolean $success
	 */
	public function delProductFromCart($productID)
	{
		$removed = FALSE;
		if (isset($_SESSION['cart'])) {
			foreach ($_SESSION['cart'] as $key => $row) {
				if ($key == $productID) {
					unset($_SESSION['cart'][$key]);
					$removed = TRUE;
					break;
				}
			}
		}
		return $removed;
	}
	/*
	 * Updates purchase from basket
	 * @param int $productID
	 * @param int $qty
	 * @return boolean $success
	 */
	public function updateProductInCart($productID, $qty)
	{
		$updated = FALSE;
		if (isset($_SESSION['cart'])) {
			foreach ($_SESSION['cart'] as $key => $row) {
				if ($key == $productID) {
					$_SESSION['cart'][$key]['quantity'] = $qty;
					$updated = TRUE;
					break;
				}
			}
		}
		return $updated;
	}
	/*
	 * Returns a safely quoted value
	 * @param string $value
	 * @return string $quotedValue
	 */
	public function pdoQuoteValue($value)
	{
		$pdo = $this->getPdo();
		return $pdo->quote($value);
	}
	/*
	 * Returns a PDO connection
	 * If connection already made, returns that instance
	 * @return PDO $pdo
	 */
	public function getPdo()
	{
		if (!$this->db_pdo) {
			if ($this->debug) {
				$this->db_pdo = new PDO(DB_DSN, DB_USER, DB_PWD, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));
			} else {
				$this->db_pdo = new PDO(DB_DSN, DB_USER, DB_PWD);
			}
		}
		return $this->db_pdo;
	}		
		
}
