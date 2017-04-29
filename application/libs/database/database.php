<?php
/**
 * This content is released under the MIT License (MIT)
 *
 * Copyright (c) 2016, canchito-dev
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 * 
 * @author 		Jose Carlos Mendoza Prego
 * @author		Chris Pitt
 * @copyright	Copyright (c) 2016, canchito-dev (http://www.canchito-dev.com)
 * @license		http://opensource.org/licenses/MIT	MIT License
 * @link		https://github.com/canchito-dev/mini-framework-mvc
 */
namespace Application\Libs\Database;

use Application\Core;
use \PDO;

/**
 * @author Chris Pitt
 * @author José Carlos Mendoza Prego
 *
 * This class is based from code examples from the book Pro PHP MVC by Chris Pitt. However, it was adapted to
 * use PDO for handling the database
 */
class Database {
	protected $isConnected;
	protected $service;
	
	/**
	 * Class Constructor - Create a new database connection if one doesn't exist
	 * Set to private so no-one can create a new instance via ' = new DB();'
	 **/
	public function __construct() {
		$this->isConnected = false;
		$this->service = null;
	}
	
	public function __destruct() {}
	
	/**
	 * Like the constructor, we make __clone private so nobody can clone the instance
	 **/
	private function __clone() {}
	
	/**
	 * Open the database connection with the credentials from application/config/config.php
	 **/
	public function connect() {
		$connection = null;
		
		/**
		 * Set the (optional) options of the PDO connection. In this case, we set the fetch mode to
		 * "objects", which means all results will be objects, like this: $result->user_name !
		 * For example, fetch mode FETCH_ASSOC would return results like this: $result["user_name] !
		 * @see http://www.php.net/manual/en/pdostatement.fetch.php
		 **/
        $options = array(
        	PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ, 
        	PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING
        );

        /**
         * Generate a database connection, using the PDO connector
         * @see http://net.tutsplus.com/tutorials/php/why-you-should-be-using-phps-pdo-for-database-access/
         * TODO: need to adapt this section to handle other databases too
         **/
        try {
        	switch (strtoupper(trim(DB_TYPE))) {
        		default:
        		case 'mysql':
        			$connection =  new PDO(DB_TYPE . ':host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=' . DB_CHARSET, DB_USER, DB_PASS, $options);
        		//TODO: Add additional cases for the different databases
        	}
        } catch(PDOException $e){
        	$this->isConnected = false;
        	throw new Core\Exception('Connection failed: ' . $e->getMessage());
        }

        $this->isConnected = true;
        $this->service =  $connection;
        return $this;
	}
	
	/**
	 * Disconnects from the database 
	 **/
	public function disconnect() {
		if ($this->isValidService()){
			$this->isConnected = false;
			$this->service = null;
		}
	
		return $this;
	}
	
	/** 
	 * Checks if connected to the database
	 **/
	public function isValidService() {
		$isEmpty = empty($this->service);
		$isNull = is_null($this->service);
	
		if ($this->isConnected && !$isEmpty && !$isNull)
			return true;
	
		return false;
	}
	
	/**
	 * Turns off autocommit mode. While autocommit mode is turned off, changes made to the database via 
	 * the PDO object instance are not committed until you end the transaction by calling PDO::commit().
	 **/
	public function beginTransaction() {
		return $this->service->beginTransaction();
	}
	
	/**
	 * Commits a transaction, returning the database connection to autocommit mode
	 **/
	public function commit() {
		return $this->service->commit();
	}
	
	/**
	 * Rolls back the current transaction
	 **/
	public function rollBack() {
		return $this->service->rollBack();
	}
	
	/**
	 * Executes the provided SQL statement
	 **/
	public function execute($sql) {
		if (!$this->isValidService())
			throw new Core\Exception\Service("Not connected to a valid service");
	
		return $this->service->query($sql);
	}
	
	/**
	 * Escapes the provided value to make it safe for queries
	 **/
	public function escape($value) {
		if (!$this->isValidService())
			throw new Core\Exception\Service("Not connected to a valid service");
		
		/**
		 * strip the extra slashes if Magic Quotes is on
		 **/
		if(get_magic_quotes_gpc())
			$value = stripslashes($value);
	
		return $this->service->quote(trim($value));
	}
	
	/**
	 * Gets the Id of the last inserted record
	 * @return the ID of the last row to be inserted
	 **/
	public function getLastInsertId() {
		if (!$this->isValidService())
			throw new Core\Exception\Service("Not connected to a valid service");
	
		return $this->service->lastInsertId();
	}
	
	/**
	 * Get the number of rows that were affected by the last SQL query that was executed
	 * @return the number of rows affected by the last SQL query executed
	 **/
	public function getAffectedRows($result = null) {
		if (!$this->isValidService())
			throw new Core\Exception\Service("Not connected to a valid service");
	
		if (is_null($result))
			throw new Core\Exception\Argument("Invalid argument: result set cannot be null");
		
		return $result->rowCount();
	}
	
	/**
	 * @return the last error of occur
	 **/
	public function getLastError() {
		if (!$this->isValidService())
			throw new Core\Exception\Service("Not connected to a valid service");
	
		return $this->service->errorInfo();
	}
	
	/**
	 * @return a corresponding query instance
	 **/ 
	public function query() {
		switch (strtoupper(trim(DB_TYPE))) {
			default:
			case 'mysql':
				return new QueryBuilderForMySQL(array(
						"connector" => $this
				));
			//TODO: Add additional cases for the different databases
		}
	}
}