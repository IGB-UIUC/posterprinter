<?php
//////////////////////////////////////////
//
//	db.class.inc.php
//
//	Class to create easy to use
//	interface with the database
//
//	By David Slater
//	June 2009
//
//////////////////////////////////////////


class db {

	////////////////Private Variables//////////

	private $link; //mysql database link
	private $host;	//hostname for the database
	private $database; //database name
	private $username; //username to connect to the database
	private $password; //password of the username

	////////////////Public Functions///////////

	public function __construct($host,$database,$username,$password) {
		$this->open($host,$database,$username,$password);


	}
	public function __destruct() {
		$this->close();

	}

	//open()
	//$host - hostname
	//$port - mysql port
	//$database - name of the database
	//$username - username to connect to the database with
	//$password - password of the username
	//$port - mysql port, defaults to 3306
	//opens a connect to the database
	public function open($host,$database,$username,$password,$port = 3306) {
		//Connects to database.
		try {
			$this->link = new PDO("mysql:host=$host;dbname=$database",$username,$password,
					array(PDO::ATTR_PERSISTENT => true));
			$this->host = $host;
			$this->database = $database;
			$this->username = $username;
			$this->password = $password;
		}
		catch(PDOException $e) {
			echo $e->getMessage();
		}

	}

	//close()
	//closes database connection
	public function close() {
		$this->link = null;
	}

	//insert_query()
	//$sql - sql string to run on the database
	//returns the id number of the new record, 0 if it fails
	public function insert_query($sql) {

		$result = $this->link->exec($sql);
		if ($result === false) {
		}
		return $this->link->lastInsertId();

	}

	//build_insert()
	//$table - string - database table to insert data into
	//$data - associative array with index being the column and value the data.
	//returns the id number of the new record, 0 if it fails
	public function build_insert($table,$data) {
		try {
			$sql = "INSERT INTO " . $table;
			$values_sql = "VALUES(";
			$columns_sql = "(";
			$count = count($data);
			$i = 1;
			foreach ($data as $key=>$value) {
				if ($i == $count) {
					$columns_sql .= $key;
					$values_sql .= ":" . $key . " ";
				}
				else {
					$columns_sql .= $key . ","; 
					$values_sql .= " :" . $key . ", ";
				}
	
				$i++;
			}

			$values_sql .= ")";
			$columns_sql .= ")";
			$sql = $sql . $columns_sql . " " . $values_sql;
			$statement = $this->link->prepare($sql);
			foreach ($data as $key=>$value) {
				$statement->bindValue(":" . $key,$value);
			}
			$result = $statement->execute();
			return $this->link->lastInsertId();
		}
		catch(PDOException $e) {
                        echo "<br>Error: " . $e->getMessage();
			var_dump($e);
                }

	}

	//non_select_query()
	//$sql - sql string to run on the database
	//For update and delete queries
	//returns true on success, false otherwise
	public function non_select_query($sql) {
		$result = $this->link->exec($sql);
		return $result;
	}

	//query()
	//$sql - sql string to run on the database
	//Used for SELECT queries
	//returns an associative array of the select query results.
	public function query($sql) {
		$result = $this->link->query($sql);
		return $result->fetchAll(PDO::FETCH_ASSOC);
	}

	//getLink
	//returns the mysql resource link
	public function get_link() {
		return $this->link;
	}

	//ping
	//pings the mysql server to see if connection is alive
	//returns true if alive, false otherwise
	public function ping() {
		if ($this->link->getAttribute(PDO::ATTR_CONNECTION_STATUS)) {
			return true;
		}
		return false;

	}

	public function transaction($sql) {
		$this->link->beginTransaction();
		$result = $this->link->exec($sql);
		$this->link->commit();
		return $result;

	}

	public function update($table,$data,$where_key,$where_value) {
		try {
	
			$sql = "UPDATE `" . $table . "` SET ";
			
			$count = count($data);
			$i = 1;
	                foreach ($data as $key=>$value) {
				if ($i == $count) {
					$sql .= $key . "= :" . $key . " ";;
                        	}
	                        else {
					$sql .= $key . "= :" . $key . ", ";
                	        }

                        	$i++;
	                }
			$sql .= "WHERE " . $where_key . "='" . $where_value . "' LIMIT 1";
			$statement = $this->link->prepare($sql);
			foreach ($data as $key=>$value) {
				$statement->bindValue(":" . $key,$value);
			}
			$result = $statement->execute();
			return $result;
		}
		catch(PDOException $e) {
			echo "<br>Error: " . $e->getMessage();
		}


	}
}
?>
