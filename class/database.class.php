<?php 
class Database {

	private $host = DB_HOST;
	private $dbname = DB_NAME;
	private $user = DB_USER;
	private $password = DB_PASSWORD;
	
	private $dbh;
	private $error;
	private $statement;
	
	public function __construct() {
		
		// Set DSN
		$dsn = 'mysql:host=' . $this->host . ';dbname=' . $this->dbname;
		
		// Set options
		$options = array(
			PDO::ATTR_PERSISTENT => true,
			PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
		);
		
		// Create new PDO instance
		try {
			$this->dbh = new PDO($dsn, $this->user, $this->password, $options);

		}
		// Catch errors
		catch (PDOException $e) {
			$this->error =  $e->getMessage();
		}
	}
	
	public function query($query) {
		
		$this->statement = $this->dbh->prepare($query);
		
	}
	
	public function bind($param, $value, $type = null) {
		
		if (is_null($type)) {
			switch (true) {
				case is_int($value):
					$type = PDO::PARAM_INT;
				case is_bool($value):
					$type = PDO::PARAM_BOOL;
				case is_null($value):
					$type = PDO::PARAM_NULL;
					break;
				default:
					$type = PDO::PARAM_STR;
			}
		}
		$this->statement->bindValue($param, $value, $type);
	}
	
	public function execute() {
		return $this->statement->execute();
	}
	
	public function resultSet() {
		$this->execute();
		return $this->statement->fetchAll(PDO::FETCH_ASSOC);
	}
	
	public function single() {
		$this->execute();
		return $this->statement->fetch(PDO::FETCH_ASSOC);
	}
	
	public function rowCount() {
		return $this->statement->rowCount();
	}
	
	public function lastInsertId() {
		return $this->dbh->lastInsertId();
	}
	
	public function beginTransaction(){
		return $this->dbh->beginTransaction();
	}
	
	public function endTransaction(){
		return $this->dbh->commit();
	}
	
	public function cancelTransaction(){
		return $this->dbh->rollBack();
	}
	
	public function debugDumpParams(){
		return $this->statement->debugDumpParams();
	}

}

?>