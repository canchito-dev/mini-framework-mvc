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
use Application\Libs\Methods;
use \PDO;

/**
 * @author Chris Pitt
 * @author José Carlos Mendoza Prego
 * 
 * This class is based from code examples from the book Pro PHP MVC by Chris Pitt
 * However, it was modified and adapted to include several additonal functions and validations.
 * This class is specific for MySQL database
 * 
 * TODO: It would be a good idea to include SQL functions for
 * (1) The HAVING clause to used it with aggregate functions.
 * (2) UCASE() function converts the value of a field to uppercase
 * (3) LCASE() function converts the value of a field to lowercase
 * (4) MID() function is used to extract characters from a text field
 * (5) LEN() function returns the length of the value in a text field
 * (6) ROUND() function is used to round a numeric field to the number of decimals specified
 */
class QueryBuilderForMySQL {
	/**
	 * @var Database $connector
	 * Has the database connection
	 */
	public $connector;
	
	/**
	 * @var string $from
	 * Table from which the data should be read from, or written to
	 */
	public $from;
	/**
	 * @var array $fields
	 * The table fields that you wish to query.
	 * Associative array containing the fields that would be queried, the key is the table, and the value are the fields.
	 * If the fields is an associative array, the key is the column name and the value is the alias. Default value is "*"
	 */
	public $fields = array();
	/**
	 * @var integer $limit
	 * The maximum number of rows to return 
	 */
	public $limit;
	/**
	 * @var integer $offset
	 * The offset of the first row to return
	 */
	public $offset;
	/**
	 * @var array $groupBy
	 * Group the result-set by one or more columns
	 */
	public $groupBy = array();
	/**
	 * @var array $orderBy
	 * Used for specifying which field to order the query by, and in which direction
	 */
	public $orderBy = array();
	/**
	 * @var array $join
	 * Used to specify joins across tables
	 */
	public $join = array();
	/**
	 * @var array $where
	 * An array containing the where clause
	 */
	public $where = array();
	
	public function __construct($options = array()) {
		if (empty($options))
			throw new Exception\Argument("Invalid argument: at least the connecto must be specified");
		
		$this->connector = $options['connector'];
	}
	
	public function __destruct() {}
	
	/**
	 * Wraps the value passed to it in the applicable quotation marks, so it can be added
	 * to the applicable query in a syntactically correct form. It has the logic to deal
	 * with the different value types, such as strings, arrays, and boolean values.
	 **/
	public function quote($value) {
		if (is_string($value)) {
			return $this->connector->escape($value);
		}
	
		if (is_array($value)) {
			$buffer = array();
	
			foreach ($value as $i)
				array_push($buffer, $this->quote($i));
	
			$buffer = join(", ", $buffer);
			return "({$buffer})";
		}
	
		if (is_null($value))
			return null;
	
		if (is_bool($value))
			return (int) $value;
	
		return $this->connector->escape($value);
	}
	
	/**
	 * Used for specifying the table from which the data should be written to, or read from, and the fields to read from or write to
	 * @param string $from	- Table from which the data should be written to, or read from
	 * @param array $fields	- An array containing the fields that would be queried. If the fields is an associative array, the key is 
	 * 						  the column name and the value is the alias. Default value is "*"
	 * @return A reference to the class instance, so that they can be chained
	 **/
	public function from($from, $fields = array("*")) {
		if(empty($from))
			throw new Exception\Argument("Invalid argument: table name is missing");
	
		$this->from = $from;
	
		if($fields)
			$this->fields[$from] = $fields;
	
		return $this;
	}
	
	/**
	 * Used to specify joins across tables
	 * @param string $type		- The type of join to use. possible values are null (default), 'LEFT', 'RIGHT', 'OUTER', 
	 * 							  'INNER', 'LEFT OUTER', 'RIGHT OUTER'. if null is used, a NATURAL join will be set
	 * @param string $join		- Name of the to be joined table
	 * @param string $on		- The condition to be met for the join. eg: table1.field = table2.field
	 * @param array $fields		- An array containing the fields that would be queried from the joined table.
	 * 							  If it is an associative array, the key is the column, and the value is the alias
	 * @return a reference to the class instance, so that they can be chained
	 **/
	public function join($type = null, $join = null, $on = null, $fields = array()) {
		if (is_null($join))
			throw new Exception\Argument("Invalid argument: join table name is missing");
	
		if (is_null($on))
			throw new Exception\Argument("Invalid argument: on table name is missing");
	
		if (!empty($fields))
			$this->fields += array($join => $fields);
		
		if (is_null($type))
			$type = '';
		
		if ($type !== '') {
			$type = strtoupper(trim($type));
			if (!in_array($type, array('LEFT', 'RIGHT', 'OUTER', 'INNER', 'LEFT OUTER', 'RIGHT OUTER'), TRUE))
				$type = '';
			else
				$type .= ' ';
			
			$this->join[] = "{$type}JOIN {$join} ON {$on}";
		} else 
			$this->join[] = "JOIN {$join} ON {$on}";
	
		return $this;
	}
	
	/**
	 * Used for specifying how many rows to return at once, and on which page to begin the results
	 * @param integer $limit	- Number of rows to return at once
	 * @param integer $page		- Page number to return the rows. Default value is 1.
	 * @return a reference to the class instance, so that they can be chained
	 **/
	public function limit($limit, $page = 1) {
		if (empty($limit))
			throw new Exception\Argument("Invalid argument: limit value is missing");
	
		$this->limit = $limit;
		$this->offset = $limit * ($page - 1);
	
		return $this;
	}
	
	/**
	 * Used for specifying which field to order the query by, and in which direction
	 * @param string $order		- Field by which the query will be ordered in the form of table.field or
	 * 							  just the field
	 * @param string $direction	- Direction in which the rows will be ordered. Default value is "ASC".
	 * @return a reference to the class instance, so that they can be chained
	 **/
	public function order($order, $direction = "ASC") {
		if (is_null($order))
			 new Exception\Argument("Invalid argument: order field is missing");
	
		$direction = !empty($direction) ? strtoupper(trim($direction)) : 'ASC';
		$direction = in_array($direction, array('ASC', 'DESC'), TRUE) ? $direction : 'ASC';;
		
		$this->orderBy[] = "{$order} {$direction}";
		
		return $this;
	}
	
	/**
	 * Used for specifying the fields to group the query by
	 * @param array $fields	- An array with the fields in the form of table.field or
	 * 						  just the field
	 * @return a reference to the class instance, so that they can be chained
	 **/
	public function group($fields = array()) {
		if (!empty($fields))
			$this->groupBy = $fields;
		return $this;
	}
	
	/**
	 * Allows for variable-length arguments. It will accept a string in the format of "foo=? AND bar=? OR baz=?"
	 * and take a further three arguments to replace those "?" characters. With them, it will run PHP's "sprintf"
	 * function, and tokenize the string
	 **/
	public function where() {
		$arguments = func_get_args();
	
		if (sizeof($arguments) < 1)
			throw new Exception\Argument("Invalid argument: where clause is missing");
	
		$arguments[0] = preg_replace("#\?#", "%s", $arguments[0]);
	
		foreach (array_slice($arguments, 1, null, true) as $i => $parameter)
			$arguments[$i] = $this->quote($arguments[$i]);
	
		$this->where[] = call_user_func_array("sprintf", $arguments);
	
		return $this;
	}
	
	/**
	 * Get the first row from the result set specified by the query.
	 * @param string $column	- The column from which to get the first value in the form of table.field or
	 * 						  	  just the field
	 * @return The first value of the selected column as an associative array
	 **/
	public function select_first($column) {	
		$this->limit(1);
		$this->order($column, 'ASC');
			
		$first = $this->get();
		$first = Methods\ArrayMethods::first($first);
	
		return $first;
	}
	
	/**
	 * Get the last row from the result set specified by the query.
	 * @param string $column	- The column from which to get the last value in the form of table.field or
	 * 						  	  just the field
	 * @return The last value of the selected column as an associative array
	 **/
	public function select_last($column) {	
		$this->limit(1);
		$this->order($column, 'DESC');
	
		$last = $this->get();
		$last = Methods\ArrayMethods::last($last);
		
		return $last;
	}
	
	/**
	 * Calculates the average value of a numeric column
	 * @param string $column	- The column from the table you wish to calculate the average in the form of 
	 * 							  table.field or just the field
	 * @param string $alias		- Refering name for the result
	 * @return Double representing the average value of a numeric column
	 **/
	public function select_avg($column = null, $alias = null) {
		$row = $this->buildAggregateSelect($column, $alias, 'AVG');
		return $row[$alias];
	}
	
	/**
	 * Counts the number of rows that matches a specified criteria
	 * @param string $column	- The column from the table you wish to count the rows in the form of table.field 
	 * 							  or just the field
	 * @param string $alias		- Refering name for the result
	 * @return Integer representing the number of rows counted
	 **/
	public function select_count($column = null, $alias = null) {
		$row = $this->buildAggregateSelect($column, $alias, 'COUNT');
		return $row[$alias];
	}
	
	/**
	 * Calculates the largest value of the selected column
	 * @param string $column	- The column from the table you wish to get the largest value in the form of 
	 * 							  table.field or just the field
	 * @param string $alias		- Refering name for the result
	 * @return Integer representing the largest value of the selected column
	 **/
	public function select_max($column = null, $alias = null) {
		$row = $this->buildAggregateSelect($column, $alias, 'MAX');
		return $row[$alias];
	}
	
	/**
	 * Calculates the smallest value of the selected column
	 * @param string $column	- The column from the table you wish to get the smallest value in the form of 
	 * 							  table.field or just the field
	 * @param string $alias		- Refering name for the result
	 * @return Integer representing the smallest value of the selected column
	 **/
	public function select_min($column = null, $alias = null) {
		$row = $this->buildAggregateSelect($column, $alias, 'MIN');
		return $row[$alias];
	}
	
	/**
	 * Calculates the total sum of a numeric column.
	 * @param string $column	- The column from the table you wish to get the total sum value in the form 
	 * 							  of table.field or just the field
	 * @param string $alias		- Refering name for the result
	 * @return Integer representing the total sum of a numeric column.
	 **/
	public function select_sum($column = null, $alias = null) {
		$row = $this->buildAggregateSelect($column, $alias, 'SUM');
		return $row[$alias];
	}
	
	/**
	 * TODO: documentation
	 **/
	private function buildAggregateSelect($column = null, $alias = null, $type = 'COUNT') {
		$limit = $this->limit;
		$offset = $this->offset;
		$fields = $this->fields;
		
		if (is_null($column))
			throw new Exception\Argument("Invalid argument: field name is missing");
		
		if (is_null($alias))
			throw new Exception\Argument("Invalid argument: alias name is missing");
		
		if (!is_null($type)) {
			if ($type !== '') {
				$type = strtoupper(trim($type));
				if (!in_array($type, array('MAX', 'MIN', 'AVG', 'SUM', 'COUNT'), TRUE))
					throw new Exception\Argument("Invalid argument: aggregate function not valid");
			}
		}
		
		$this->fields = array($this->from => array("{$type}($column)" => $alias));
		
		$this->limit(1);
		$row = $this->select_first($column);
		
		$this->fields = $fields;
		
		if ($fields)
			$this->fields = $fields;
		if ($limit)
			$this->limit = $limit;
		if ($offset)
			$this->offset = $offset;
		
		return $row[$alias];
	}
	
	/**
	 * Checks if a value referenced by $needle exists in an array
	 * @param sring $needle	- The searched value
	 * @return boolean
	 */
	private function hasAggregate($needle) {
		return (bool) preg_match('/(MAX|MIN|AVG|SUM|COUNT)/i', trim($needle));
	}
	
	/**
	 * Create the desired SELECT query
	 * @return SQL query
	 */
	public function select() {
		$template = "SELECT %s FROM %s %s %s %s %s %s";
		return $this->buildSelect($template);
	}

	/**
	 * Return distinct data from the database
	 * @return an array with the rows found
	 */
	public function distinct() {
		$template = "SELECT DISTINCT %s FROM %s %s %s %s %s %s";
		return $this->buildSelect($template);
	}
	
	/**
	 * Create the desired SELECT or SELECT DISTINCT query
	 * @return SQL query
	 **/
	private function buildSelect($template = null) {
		if (is_null($template))
			throw new Exception\Argument("Invalid argument: table name is missing");
		
		$fields = array();
		$where = $orderBy = $limit = $join = $groupBy =  "";
	
		foreach ($this->fields as $table => $tfields) {
			foreach ($tfields as $field => $alias) {
				if (is_string($field)) {
					if ($this->hasAggregate($field))
						$fields[] = "{$field} AS {$alias}";
					else 
						$fields[] = "{$table}.{$field} AS {$alias}";
				} else
					$fields[] = "{$table}.{$alias}";
			}
		}
	
		$fields = join(", ", $fields);
	
		if (!empty($this->join)) {
			$join = join(" ", $this->join);
		}
	
		if (!empty($this->where)) {
			$joined = join(" AND ", $this->where);
			$where = "WHERE {$joined}";
		}
		
		if (!empty($this->groupBy)) {
			$groupBy = "GROUP BY " . join(", ", $this->groupBy);
		}
	
		if (!empty($this->orderBy))
			$orderBy = "ORDER BY " . join(", ", $this->orderBy);
	
		if (!empty($this->limit)) {
			if ($this->offset)
				$limit = "LIMIT {$this->offset}, {$this->limit}";
			else
				$limit = "LIMIT {$this->limit}";
		}
	
		return sprintf($template, $fields, $this->from, $join, $where, $groupBy, $orderBy, $limit);
	}
	
	/**
	 * Create the desired INSERT query
	 * @return SQL query
	 **/
	private function buildInsert($data) {
		$fields = array();
		$values = array();
		$template = "INSERT INTO `%s` (`%s`) VALUES (%s)";
	
		foreach ($data as $field => $value) {
			$fields[] = $field;
			$values[] = $this->quote($value);
		}
	
		$fields = join("`, `", $fields);
		$values = join(", ", $values);
	
		return sprintf($template, $this->from, $fields, $values);
	}
	
	/**
	 * Create the desired UPDATE query
	 * @return SQL query
	 **/
	private function buildUpdate($data) {
		$parts = array();
		$where = $limit = "";
		$template = "UPDATE %s SET %s %s %s";
	
		foreach ($data as $field => $value)
			$parts[] = "{$field} = " . $this->quote($value);
	
		$parts = join(", ", $parts);
	
		if (!empty($this->where)){
			$joined = join(", ", $this->where);
			$where = "WHERE {$joined}";
		}
	
		if (!empty($this->limit)) {
			$offset = $this->offset;
			$limit = "LIMIT {$this->limit} {$offset}";
		}
	
		return sprintf($template, $this->from, $parts, $where, $limit);
	}
	
	/**
	 * Create the desired DELETE query
	 * @return SQL query
	 **/
	private function buildDelete() {
		$where = $limit ="";
		$template = "DELETE FROM %s %s %s";
	
		if (!empty($this->where)) {
			$joined = join(", ", $this->where);
			$where = "WHERE {$joined}";
		}
	
		if (!empty($this->limit)) {
			$_offset = $this->offset;
			$limit = "LIMIT {$this->limit} {$_offset}";
		}
	
		return sprintf($template, $this->from, $where, $limit);
	}
	
	/**
	 * This method determines what kind of query you need by looking at whether you have called
	 * the where() method on this query object. If you have, it assumes it is to specify a row ID
	 * (or other row criteria), and call the update function.
	 * @param array $data	- An associative array where the key es the database column name, and 
	 * 						  the value is the value to insert/update
	 * @return Last inserted Id in case an insert was requested, or the number of affected rows 
	 * for the update case 
	 **/
	private function save($data) {
		$isInsert = sizeof($this->where) == 0;
	
		if ($isInsert)
			$sql = $this->buildInsert($data);
		else
			$sql = $this->buildUpdate($data);
	
		$result = $this->execute($sql);
	
		if ($result === false)
			throw new Core\Exception\PDOException();
	
		if ($isInsert)
			return $this->connector->getLastInsertId();
	
		return $this->connector->getAffectedRows($result);
	}
	
	/**
	 * Executes the SQL query statment
	 * @param string $sql	- The SQL query to execute
	 * @return PDOStatement
	 */
	public function execute($sql) {
		return $this->connector->execute($sql);
	}
	
	/**
	 * Use for inserting data into database. Generates an insert string based on the supplied data, 
	 * and executes the query.
	 * @param array $data	- An associative array where the key es the database column name, and 
	 * 						  the value is the value to insert
	 * @return last inserted Id in case an insert was requested
	 */
	public function insert($data = null) {
		if (is_null($data))
			throw new Exception\Argument("Invalid argument: no data to insert");
		return $this->save($data);
	}
	
	/**
	 * Use for updating data. Generates an update string based on the supplied data, and executes the query.
	 * @param array $data	- An associative array where the key es the database column name, and
	 * 						  the value is the value to update
	 * @return The number of affected rows
	 */
	public function update($data = null) {
		if (is_null($data))
			throw new Exception\Argument("Invalid argument: no data to update");
		return $this->save($data);
	}
	
	/**
	 * Use for deleting database information. Generates delete string based on the supplied data, and executes 
	 * the query.
	 * @return The number of affected rows
	 */
	public function delete() {
		$sql = $this->buildDelete();
		$result = $this->execute($sql);
	
		if ($result === false)
			throw new Core\Exception\PDOException();
	
		return $this->connector->getAffectedRows($result);
	}
	
	/**
	 * Returns data from the database
	 * @param boolean $distinct	- If set to true, the select query will use the distinct statement.
	 * 							  If set to false, it will create a normal select query. Default is false
	 * @return an array with the rows found
	 */
	public function get($distinct = false) {
		$sql = $distinct ? $this->distinct() : $this->select();
		$result = $this->execute($sql);
	
		if($result === false){
			$error = $this->connector->lastError;
			throw new Exception\Sql("There was an error with your SQL query: {$error}");
		}
	
		$rows = array();
	
		for ($i = 0; $i < $result->rowCount(); $i++)
			$rows[] = $result->fetch(PDO::FETCH_ASSOC);
	
		return $rows;
	}
}