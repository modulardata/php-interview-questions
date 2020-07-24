<?php
// PHP and MySQL Project
// members table data class

class Members
{
	public $debug = TRUE;
	protected $db_pdo;
	public $membersPerPage = 12;
	public $howManyMembers = 0;
	
	/*
	 * Returns array of arrays where each sub-array = 1 database row of Members
	 * @param int $offset [optional]
	 * @return array $row[] = array('title' => title, 'description' => description, etc.)
	 */
	public function getAllMembers($offset = 0)
	{
		$pdo = $this->getPdo();
		$sql = 'SELECT * FROM `members` ORDER BY `name` LIMIT ' . $this->membersPerPage . ' OFFSET ' . $offset;
		$stmt = $pdo->prepare($sql);
		$stmt->execute();
		$content = array();
		while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
			$content[] = $row;
		}
		return $content;
	}
	/*
	 * Returns database row for 1 member
	 * @param int $id = member ID
	 * @return array $row[] = array('title' => title, 'description' => description, etc.)
	 */
	public function getDetailsById($id)
	{
		$pdo = $this->getPdo();
		$sql = 'SELECT * FROM `members` WHERE `product_id` = ?';
		$stmt = $pdo->prepare($sql);
		$stmt->execute(array($id));
		$result = $stmt->fetch(PDO::FETCH_ASSOC);
		return $result;
	}
	/*
	 * Returns database row for 1 member
	 * @param string $email
	 * @return array $row[] = array('title' => title, 'description' => description, etc.)
	 */
	public function loginByName($email, $password)
	{
		$pdo = $this->getPdo();
		$sql = 'SELECT * FROM `members` WHERE `email` = ? AND `password` = ?';
		$stmt = $pdo->prepare($sql);
		$stmt->execute(array($email, $password));
		$result = $stmt->fetch(PDO::FETCH_ASSOC);
		return $result;
	}
	public function getHowManyMembers()
	{
		if (!$this->howManyMembers) {
			$pdo = $this->getPdo();
			$sql = 'SELECT COUNT(*) FROM `members`';
			$stmt = $pdo->prepare($sql);
			$stmt->execute();
			// fetches as a numeric array
			$result = $stmt->fetch(PDO::FETCH_NUM);
			$this->howManyMembers = $result[0];
		}	
		return $this->howManyMembers;
	}
	/*
	 * Returns array of arrays where each sub-array = 1 database row of Members
	 * Searches name, address, city, state_province, country, email
	 * @param string $search
	 * @return array $row[] = array('title' => title, 'description' => description, etc.)
	 */
	public function getMembersByKeyword($search)
	{
		$search = strip_tags($search);
		$search = str_ireplace(array("'",'-','"',';'), '', $search);
		$search = "'%" . $search . "%'";
		$pdo = $this->getPdo();
		$sql = 'SELECT * FROM `members` WHERE '
			  . '`name` LIKE ' . $search . ' OR '
			  . '`city` LIKE ' . $search . ' OR '
			  . '`email` LIKE ' . $search . ' ORDER BY `name`';
		$stmt = $pdo->prepare($sql);
		$stmt->execute();
		$content = array();
		while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
			$content[] = $row;
		}
		return $content;
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
