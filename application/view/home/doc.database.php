<?php
namespace Application\Libs\Methods;

use Application\Libs\Methods;
?>
					<section class="body-section" id="databaseLib"><!-- databaseLib -->
	  					<h3><strong>Libraries</strong></h3>
	  					<div class="page-header-doc"><!-- page-header-doc -->
					      	<h4>Database</h4>
					    </div><!-- page-header-doc -->
				    	<blockquote>
					    	<p class="text-justify">
						    	<strong>NOTE:</strong> The following library and its helper classes are based on the example code from the book <strong>Pro PHP MVC</strong> by 
						    	<strong>Chris Pitt</strong>. However, they were modified and adapted to meet some of the requirements not fulfilled by the code examples. For 
						    	instance, is used PHP's PDO class to handle the database connection and executing the SQL queries.
					    	</p>
				    	</blockquote>
					    <p class="text-justify">
					    	The database library is formed of two classes. The first class is the database factory, which is in charged of loading the needed database driver.
					    	There is no need to manually specify which type of database you are using, as it is taken from the configuration. Now, the second class is the query
					    	builder class, and it is responsible for building the vendor-specific database code. For the moment, these two classes support only MySQL database.
					    </p>
					    
					    <p class="text-justify">
					    	<ul class="fa-ul list-docs">
						  		<li><i class="fa-li fa fa-check-square"></i>
					    			<a href="#dbConfig">Database Access</a>
					    		</li>
					    		<li><i class="fa-li fa fa-check-square"></i>
					    			<a href="#selectingData">Selecting Data</a>
					    		</li>
					    		<li><i class="fa-li fa fa-check-square"></i>
					    			<a href="#lookingforSpecificData">Looking For Specific Data</a>
					    		</li>
					    		<li><i class="fa-li fa fa-check-square"></i>
					    			<a href="#insertingData">Inserting Date</a>
					    		</li>
					    		<li><i class="fa-li fa fa-check-square"></i>
					    			<a href="#updatingData">Updating Data</a>
					    		</li>
					    		<li><i class="fa-li fa fa-check-square"></i>
					    			<a href="#deletingData">Deleting Data</a>
					    		</li>
					    		<li><i class="fa-li fa fa-check-square"></i>
					    			<a href="#executingSQL">Executing SQL Statements</a>
					    		</li>
					    	</ul>
					    </p>
					    
					    <section class="body-main" id="dbConfig"><!-- dbConfig -->
		  					<div class="page-header-doc"><!-- page-header-doc -->
						      	<h5>Database Access</h5>
						    </div><!-- page-header-doc -->
						    <p class="text-justify">
						    	The database configuration is done in the <code>application/config/config.php</code> file. Simply, modify the following
						    	parameter to suit your needs:
						    	<ul class="fa-ul list-docs">
							  		<li><i class="fa-li fa fa-check-square"></i><code>DB_TYPE</code>: The type of database to connect to. Currently only MySQL is fully supported</li>
						    		<li><i class="fa-li fa fa-check-square"></i><code>DB_HOST</code>: The IP of the server where the database is located</li>
						    		<li><i class="fa-li fa fa-check-square"></i><code>DB_NAME</code>: The name of the database</li>
						    		<li><i class="fa-li fa fa-check-square"></i><code>DB_USER</code>: The username used for connecting to the database</li>
						    		<li><i class="fa-li fa fa-check-square"></i><code>DB_PASS</code>: The password used for connecting to the database</li>
						    		<li><i class="fa-li fa fa-check-square"></i><code>DB_CHARSET</code>: The character set to used in the database</li>
						    	</ul>
						    </p>
						    <p class="text-justify">
						    	Once the database configuration is done, you can start using the library as follow:
						    </p>
							<pre>
<?php
	echo Methods\CodeHighlighterMethods::highlightText(
		"<?php\n" .
		"	// get a database instance\n" .
    	"	\$db = new Database\Database();\n" .
    	"	//connect to database\n" .
    	"	\$db = \$db->connect();\n" .
		"	//get an instance of the query builder helper class for\n" .
    	"	\$builder = \$db->query();\n" .
		"	//build your query and do something\n" .
		"	//...\n" .
    	"	//disconnect from database\n" .
    	"	\$db->disconnect();\n" .
		"?>");
?>
							</pre>
						</section><!-- dbConfig -->
					    
						<section class="body-main" id="selectingData"><!-- selectingData -->
		  					<div class="page-header-doc"><!-- page-header-doc -->
						      	<h5>Selecting Data</h5>
						    </div><!-- page-header-doc -->
						    <p class="text-justify">
						    	The following functions allow you to build SQL <strong>SELECT</strong> statements.
						    </p>
						    
						    <!-- START $db->query()->from() -->
						    <p class="text-justify">
						    	<strong class="text-info">$db->query()->from()</strong>
						    </p>
						    <p class="text-justify">
						    	Used for specifying the table from which the data should be written to, or read from, and the fields to read from or write to.
						    	<dl class="dl-horizontal list-docs">
									<dt class="dl-docs-dt"><span class="text-primary">param</span> <var>$from</var> <small>(string)</small>:</dt>
									<dd class="text-justify">Table from which the data should be written to, or read from.</dd>
									<dt class="dl-docs-dt"><span class="text-primary">param</span> <var>$fields</var> <small>(array)</small>:</dt>
									<dd class="text-justify">An array containing the fields that would be queried. If the fields is an associative array, the key 
									is the column name and the value is the alias. Default value is "*".</dd>
									<dt class="dl-docs-dt"><span class="text-primary">return</span>:</dt>
									<dd class="text-justify">A reference to the class instance, so that they can be chained.</dd>
								</dl>
						    </p>
						    <p class="text-justify">
						    	For example:
						    </p>
							<pre>
<?php
	echo Methods\CodeHighlighterMethods::highlightText(
		"<?php\n" .
    	"	\$db->query()\n" .
		"		->from('songs')\n" .
		"	// Produces: SELECT songs.* FROM songs\n" . 
		"?>");
?>
							</pre>
							<pre>
<?php
	echo Methods\CodeHighlighterMethods::highlightText(
		"<?php\n" .
    	"	\$db->query()\n" .
		"		->from('songs', array(\n" .
		"			'id',\n" .
		"			'artist',\n" .
		"			'track',\n" .
		"			'link'\n" .
		"	))\n" .
		"	// Produces: SELECT songs.id, songs.artist, songs.track, songs.link FROM songs\n" . 
		"?>");
?>
							</pre>
							<pre>
<?php
	echo Methods\CodeHighlighterMethods::highlightText(
		"<?php\n" .
    	"	\$db->query()\n" .
		"		->from('songs', array(\n" .
		"			'id' => 'ID',\n" .
		"			'artist' => 'ARTIST',\n" .
		"			'track' => 'TRACK',\n" .
		"			'link' => 'LINK'\n" .
		"	))\n" .
		"	// Produces: SELECT songs.id AS ID, songs.artist AS ARTIST, songs.track AS TRACK, songs.link AS LINK FROM songs\n" . 
		"?>");
?>
							</pre>
							<hr class="hr-blue-lighten-5"><br>
							<!-- END $db->query()->from() -->
							
							<!-- START $db->query()->get() -->
						    <p class="text-justify">
						    	<strong class="text-info">$db->query()->get()</strong>
						    </p>
						    <p class="text-justify">
						    	Executes the SQL query and returns data from the database.
						    	<dl class="dl-horizontal list-docs">
									<dt class="dl-docs-dt"><span class="text-primary">param</span> <var>$distinct</var> <small>(boolean)</small>:</dt>
									<dd class="text-justify">If set to true, the select query will use the distinct statement. If set to false, it will 
									create a normal select query. Default is false</dd>
									<dt class="dl-docs-dt"><span class="text-primary">return</span>:</dt>
									<dd class="text-justify">An array with the rows found.</dd>
								</dl>
						    </p>
						    <p class="text-justify">
						    	For example:
						    </p>
						    <pre>
<?php
	echo Methods\CodeHighlighterMethods::highlightText(
		"<?php\n" .
    	"	\$songs = \$db->query()\n" .
		"					->from('songs')\n" .
		"					->get()\n" . 
		"	// Produces: SELECT * FROM songs\n" .
		"?>");
?>
							</pre>
							 <p class="text-justify">
						    	If the variable <var>$distinct</var> is set to <em>true</em>, the 'DISTINCT' keyword will be added to the query.
						    </p>
						    <pre>
<?php
	echo Methods\CodeHighlighterMethods::highlightText(
		"<?php\n" .
    	"	\$songs = \$db->query()\n" .
		"					->from('songs')\n" .
		"					->get(true)\n" . 
		"	// Produces: SELECT DISTINCT * FROM songs\n" .
		"?>");
?>
							</pre>
							 <p class="text-justify">
						    	Notice that the above code snippets are assigned to a variable named <var>$songs</var>, which can be used to show the rows found:
						    </p>
						    <pre>
<?php
	echo Methods\CodeHighlighterMethods::highlightText(
		"<?php\n" .
    	"	foreach (\$songs as \$song) {\n" .
		"		echo \$song['id']\n" .
		"		echo \$song['artist']\n" .
		"		echo \$song['track']\n" .
		"		echo \$song['link']\n" .
		"	}\n" . 
		"?>");
?>
							</pre>
							<hr class="hr-blue-lighten-5"><br>
							<!-- END $db->query()->get() -->
							
							<!-- START $db->query()->join() -->
						    <p class="text-justify">
						    	<strong class="text-info">$db->query()->join()</strong>
						    </p>
						    <p class="text-justify">
						    	Used to specify joins across tables.
						    	<dl class="dl-horizontal list-docs">
									<dt class="dl-docs-dt"><span class="text-primary">param</span> <var>$type</var> <small>(string)</small>:</dt>
									<dd class="text-justify">The type of join to use. possible values are null (default), 'LEFT', 'RIGHT', 'OUTER', 
									'INNER', 'LEFT OUTER', 'RIGHT OUTER'. if null is used, a NATURAL join will be set</dd>
									<dt class="dl-docs-dt"><span class="text-primary">param</span> <var>$join</var> <small>(string)</small>:</dt>
									<dd class="text-justify">Name of the to be joined table</dd>
									<dt class="dl-docs-dt"><span class="text-primary">param</span> <var>$on</var> <small>(string)</small>:</dt>
									<dd class="text-justify">The condition to be met for the join. eg: table1.field = table2.field</dd>
									<dt class="dl-docs-dt"><span class="text-primary">param</span> <var>$fields</var> <small>(array)</small>:</dt>
									<dd class="text-justify">An array containing the fields that would be queried from the joined table. If the fields i
									s an associative array, the key is the column name and the value is the alias. Default value is "*".</dd>
									<dt class="dl-docs-dt"><span class="text-primary">return</span>:</dt>
									<dd class="text-justify">A reference to the class instance, so that they can be chained.</dd>
								</dl>
						    </p>
						    <p class="text-justify">
						    	For example:
						    </p>
						    <pre>
<?php
echo Methods\CodeHighlighterMethods::highlightText(
		"<?php\n" .
		"	\$db->query()\n" .
		"		->from('songs', array(\n" .
		"			'id' => 'ID',\n" .
		"			'artist' => 'ARTIST',\n" .
		"			'track' => 'TRACK',\n" .
		"			'link' => 'LINK'\n" .
		"		))\n" .
		"		->join(null, 'users', 'users.user_id = songs.id', array(\n" .
		"			'names',\n" .
		"			'lastnames',\n" .
		"			'email'\n" .
		"		));\n" .
		"	// Produces: SELECT songs.id, songs.artist, songs.track, songs.link, users.names, users.lastnames, users.email FROM songs JOIN users ON users.user_id = songs.id\n" .
		"?>");
?>
							</pre>
							<hr class="hr-blue-lighten-5"><br>
						    <!-- END $db->query()->where() -->
							
							<!-- START $db->query()->limit() -->
						    <p class="text-justify">
						    	<strong class="text-info">$db->query()->limit()</strong>
						    </p>
						    <p class="text-justify">
						    	Used for specifying how many rows to return at once, and on which page to begin the results.
						    	<dl class="dl-horizontal list-docs">
									<dt class="dl-docs-dt"><span class="text-primary">param</span> <var>$imit</var> <small>(integer)</small>:</dt>
									<dd class="text-justify">Number of rows to return at once</dd>
									<dt class="dl-docs-dt"><span class="text-primary">param</span> <var>$page</var> <small>(integer)</small>:</dt>
									<dd class="text-justify">Page number to return the rows calculated as follow <var>$limit</var> * (<var>$page</var> - 1). 
									Default value is 1.</dd>
									<dt class="dl-docs-dt"><span class="text-primary">return</span>:</dt>
									<dd class="text-justify">A reference to the class instance, so that they can be chained.</dd>
								</dl>
						    </p>
						    <p class="text-justify">
						    	For example:
						    </p>
						    <pre>
<?php
echo Methods\CodeHighlighterMethods::highlightText(
		"<?php\n" .
		"	\$db->query()\n" .
		"		->from('songs', array(\n" .
		"			'id' => 'ID',\n" .
		"			'artist' => 'ARTIST',\n" .
		"			'track' => 'TRACK',\n" .
		"			'link' => 'LINK'\n" .
		"		))\n" .
		"		->limit(5, 3);\n" .
		"	// Produces: SELECT songs.id, songs.artist, songs.track, songs.link FROM songs LIMIT 10, 5\n" .
		"?>");
?>
							</pre>
							<hr class="hr-blue-lighten-5"><br>
						    <!-- END $db->query()->limit() -->
							
							<!-- START $db->query()->order() -->
						    <p class="text-justify">
						    	<strong class="text-info">$db->query()->order()</strong>
						    </p>
						    <p class="text-justify">
						    	Used for specifying which field to order the query by, and in which direction.
						    	<dl class="dl-horizontal list-docs">
									<dt class="dl-docs-dt"><span class="text-primary">param</span> <var>$order</var> <small>(string)</small>:</dt>
									<dd class="text-justify">Field by which the query will be ordered in the form of table.field or just the field</dd>
									<dt class="dl-docs-dt"><span class="text-primary">param</span> <var>$direction</var> <small>(string)</small>:</dt>
									<dd class="text-justify">Direction in which the rows will be ordered. Default value is "ASC"</dd>
									<dt class="dl-docs-dt"><span class="text-primary">return</span>:</dt>
									<dd class="text-justify">A reference to the class instance, so that they can be chained.</dd>
								</dl>
						    </p>
						    <p class="text-justify">
						    	For example:
						    </p>
						    <pre>
<?php
echo Methods\CodeHighlighterMethods::highlightText(
		"<?php\n" .
		"	\$db->query()\n" .
		"		->from('songs')\n" .
		"		->order('songs.id', 'DESC');\n" .
		"	// Produces: SELECT songs.* FROM songs ORDER BY songs.id DESC\n" .
		"?>");
?>
							</pre>
							<hr class="hr-blue-lighten-5"><br>
						    <!-- END $db->query()->order() -->
							
							<!-- START $db->query()->group() -->
						    <p class="text-justify">
						    	<strong class="text-info">$db->query()->group()</strong>
						    </p>
						    <p class="text-justify">
						    	Used for specifying the fields to group the query by.
						    	<dl class="dl-horizontal list-docs">
									<dt class="dl-docs-dt"><span class="text-primary">param</span> <var>$fields</var> <small>(string)</small>:</dt>
									<dd class="text-justify">An array with the fields in the form of table.field or just the field</dd>
									<dt class="dl-docs-dt"><span class="text-primary">return</span>:</dt>
									<dd class="text-justify">A reference to the class instance, so that they can be chained.</dd>
								</dl>
						    </p>
						    <p class="text-justify">
						    	For example:
						    </p>
						    <pre>
<?php
echo Methods\CodeHighlighterMethods::highlightText(
		"<?php\n" .
		"	\$db->query()\n" .
		"		->from('songs')\n" .
		"		->order('songs.id', 'DESC')\n" .
		"		->group(array('songs.id'));\n" .
		"	// Produces: SELECT songs.* FROM songs GROUP BY songs.id ORDER BY songs.id DESC\n" .
		"?>");
?>
							</pre>
							<hr class="hr-blue-lighten-5"><br>
						    <!-- END $db->query()->group() -->
							
							<!-- START $db->query()->select_first() -->
						    <p class="text-justify">
						    	<strong class="text-info">$db->query()->select_first()</strong>
						    </p>
						    <p class="text-justify">
						    	Get the first row from the result set specified by the query.
						    	<dl class="dl-horizontal list-docs">
									<dt class="dl-docs-dt"><span class="text-primary">param</span> <var>$column</var> <small>(string)</small>:</dt>
									<dd class="text-justify">The column from which to get the first value in the form of table.field or just the field</dd>
									<dt class="dl-docs-dt"><span class="text-primary">return</span>:</dt>
									<dd class="text-justify">A reference to the class instance, so that they can be chained.</dd>
								</dl>
						    </p>
						    <p class="text-justify">
						    	For example:
						    </p>
						    <pre>
<?php
echo Methods\CodeHighlighterMethods::highlightText(
		"<?php\n" .
		"	\$db->query()\n" .
		"		->from('songs')\n" .
		"		->select_first('songs.id');\n" .
		"	// Produces: SELECT songs.* FROM songs ORDER BY songs.id ASC LIMIT 1\n" .
		"?>");
?>
							</pre>
							<hr class="hr-blue-lighten-5"><br>
						    <!-- END $db->query()->select_first() -->
							
							<!-- START $db->query()->select_last() -->
						    <p class="text-justify">
						    	<strong class="text-info">$db->query()->select_last()</strong>
						    </p>
						    <p class="text-justify">
						    	Get the last row from the result set specified by the query.
						    	<dl class="dl-horizontal list-docs">
									<dt class="dl-docs-dt"><span class="text-primary">param</span> <var>$column</var> <small>(string)</small>:</dt>
									<dd class="text-justify">The column from which to get the last value in the form of table.field or just the field</dd>
									<dt class="dl-docs-dt"><span class="text-primary">return</span>:</dt>
									<dd class="text-justify">A reference to the class instance, so that they can be chained.</dd>
								</dl>
						    </p>
						    <p class="text-justify">
						    	For example:
						    </p>
						    <pre>
<?php
echo Methods\CodeHighlighterMethods::highlightText(
		"<?php\n" .
		"	\$db->query()\n" .
		"		->from('songs')\n" .
		"		->select_last('songs.id');\n" .
		"	// Produces: SELECT songs.* FROM songs ORDER BY songs.id DESC LIMIT 1\n" .
		"?>");
?>
							</pre>
							<hr class="hr-blue-lighten-5"><br>
						    <!-- END $db->query()->select_last() -->
							
							<!-- START $db->query()->select_avg() -->
						    <p class="text-justify">
						    	<strong class="text-info">$db->query()->select_avg()</strong>
						    </p>
						    <p class="text-justify">
						    	Calculates the average value of a numeric column.
						    	<dl class="dl-horizontal list-docs">
									<dt class="dl-docs-dt"><span class="text-primary">param</span> <var>$column</var> <small>(string)</small>:</dt>
									<dd class="text-justify">The column from the table you wish to calculate the average in the form of table.field 
									or just the field</dd>
									<dt class="dl-docs-dt"><span class="text-primary">param</span> <var>$alias</var> <small>(string)</small>:</dt>
									<dd class="text-justify">Refering name for the result</dd>
									<dt class="dl-docs-dt"><span class="text-primary">return</span>:</dt>
									<dd class="text-justify">A reference to the class instance, so that they can be chained.</dd>
								</dl>
						    </p>
						    <p class="text-justify">
						    	For example:
						    </p>
						    <pre>
<?php
echo Methods\CodeHighlighterMethods::highlightText(
		"<?php\n" .
		"	\$db->query()\n" .
		"		->from('songs')\n" .
		"		->select_avg('songs.id', 'AVG_ID');\n" .
		"	// Produces: SELECT AVG(songs.id) AS AVG_ID FROM songs ORDER BY songs.id ASC LIMIT 1\n" .
		"?>");
?>
							</pre>
							<hr class="hr-blue-lighten-5"><br>
						    <!-- END $db->query()->select_avg() -->
							
							<!-- START $db->query()->select_count() -->
						    <p class="text-justify">
						    	<strong class="text-info">$db->query()->select_count()</strong>
						    </p>
						    <p class="text-justify">
						    	Counts the number of rows that matches a specified criteria.
						    	<dl class="dl-horizontal list-docs">
									<dt class="dl-docs-dt"><span class="text-primary">param</span> <var>$column</var> <small>(string)</small>:</dt>
									<dd class="text-justify">The column from the table you wish to count the rows in the form of table.field 
									or just the field</dd>
									<dt class="dl-docs-dt"><span class="text-primary">param</span> <var>$alias</var> <small>(string)</small>:</dt>
									<dd class="text-justify">Refering name for the result</dd>
									<dt class="dl-docs-dt"><span class="text-primary">return</span>:</dt>
									<dd class="text-justify">A reference to the class instance, so that they can be chained.</dd>
								</dl>
						    </p>
						    <p class="text-justify">
						    	For example:
						    </p>
						    <pre>
<?php
echo Methods\CodeHighlighterMethods::highlightText(
		"<?php\n" .
		"	\$db->query()\n" .
		"		->from('songs')\n" .
		"		->select_count('songs.id', 'COUNT_ID');\n" .
		"	// Produces: SELECT COUNT(songs.id) AS COUNT_ID FROM songs ORDER BY songs.id ASC LIMIT 1\n" .
		"?>");
?>
							</pre>
							<hr class="hr-blue-lighten-5"><br>
						    <!-- END $db->query()->select_count() -->
							
							<!-- START $db->query()->select_max() -->
						    <p class="text-justify">
						    	<strong class="text-info">$db->query()->select_max()</strong>
						    </p>
						    <p class="text-justify">
						    	Calculates the largest value of the selected column.
						    	<dl class="dl-horizontal list-docs">
									<dt class="dl-docs-dt"><span class="text-primary">param</span> <var>$column</var> <small>(string)</small>:</dt>
									<dd class="text-justify">The column from the table you wish to get the largest value in the form of table.field 
									or just the field</dd>
									<dt class="dl-docs-dt"><span class="text-primary">param</span> <var>$alias</var> <small>(string)</small>:</dt>
									<dd class="text-justify">Refering name for the result</dd>
									<dt class="dl-docs-dt"><span class="text-primary">return</span>:</dt>
									<dd class="text-justify">A reference to the class instance, so that they can be chained.</dd>
								</dl>
						    </p>
						    <p class="text-justify">
						    	For example:
						    </p>
						    <pre>
<?php
echo Methods\CodeHighlighterMethods::highlightText(
		"<?php\n" .
		"	\$db->query()\n" .
		"		->from('songs')\n" .
		"		->select_max('songs.id', 'MAX_ID');\n" .
		"	// Produces: SELECT MAX(songs.id) AS MAX_ID FROM songs ORDER BY songs.id ASC LIMIT 1\n" .
		"?>");
?>
							</pre>
							<hr class="hr-blue-lighten-5"><br>
						    <!-- END $db->query()->select_max() -->
							
							<!-- START $db->query()->select_min() -->
						    <p class="text-justify">
						    	<strong class="text-info">$db->query()->select_min()</strong>
						    </p>
						    <p class="text-justify">
						    	Calculates the smallest value of the selected column.
						    	<dl class="dl-horizontal list-docs">
									<dt class="dl-docs-dt"><span class="text-primary">param</span> <var>$column</var> <small>(string)</small>:</dt>
									<dd class="text-justify">The column from the table you wish to get the smallest value in the form of table.field 
									or just the field</dd>
									<dt class="dl-docs-dt"><span class="text-primary">param</span> <var>$alias</var> <small>(string)</small>:</dt>
									<dd class="text-justify">Refering name for the result</dd>
									<dt class="dl-docs-dt"><span class="text-primary">return</span>:</dt>
									<dd class="text-justify">A reference to the class instance, so that they can be chained.</dd>
								</dl>
						    </p>
						    <p class="text-justify">
						    	For example:
						    </p>
						    <pre>
<?php
echo Methods\CodeHighlighterMethods::highlightText(
		"<?php\n" .
		"	\$db->query()\n" .
		"		->from('songs')\n" .
		"		->select_min('songs.id', 'MIN_ID');\n" .
		"	// Produces: SELECT MIN(songs.id) AS MIN_ID FROM songs ORDER BY songs.id ASC LIMIT 1\n" .
		"?>");
?>
							</pre>
							<hr class="hr-blue-lighten-5"><br>
						    <!-- END $db->query()->select_min() -->
							
							<!-- START $db->query()->select_sum() -->
						    <p class="text-justify">
						    	<strong class="text-info">$db->query()->select_sum()</strong>
						    </p>
						    <p class="text-justify">
						    	Calculates the total sum of a numeric column.
						    	<dl class="dl-horizontal list-docs">
									<dt class="dl-docs-dt"><span class="text-primary">param</span> <var>$column</var> <small>(string)</small>:</dt>
									<dd class="text-justify">The column from the table you wish to get the total sum value in the form of table.field 
									or just the field</dd>
									<dt class="dl-docs-dt"><span class="text-primary">param</span> <var>$alias</var> <small>(string)</small>:</dt>
									<dd class="text-justify">Refering name for the result</dd>
									<dt class="dl-docs-dt"><span class="text-primary">return</span>:</dt>
									<dd class="text-justify">A reference to the class instance, so that they can be chained.</dd>
								</dl>
						    </p>
						    <p class="text-justify">
						    	For example:
						    </p>
						    <pre>
<?php
echo Methods\CodeHighlighterMethods::highlightText(
		"<?php\n" .
		"	\$db->query()\n" .
		"		->from('songs')\n" .
		"		->select_sum('songs.id', 'MIN_ID');\n" .
		"	// Produces: SELECT MIN(songs.id) AS MIN_ID FROM songs ORDER BY songs.id ASC LIMIT 1\n" .
		"?>");
?>
							</pre>
							<br>
						    <!-- END $db->query()->select_sum() -->
						</section><!-- selectingData -->
						
						<section class="body-main" id="lookingforSpecificData"><!-- lookingforSpecificData -->
		  					<div class="page-header-doc"><!-- page-header-doc -->
						      	<h5>Looking For Specific Data</h5>
						    </div><!-- page-header-doc -->
							<!-- START $db->query()->where() -->
						    <p class="text-justify">
						    	<strong class="text-info">$db->query()->where()</strong>
						    </p>
						    <p class="text-justify">
						    	Allows for variable-length arguments. It will accept a string in the format of "foo=? AND bar=? OR baz=?"
								and take a further three arguments to replace those "?" characters. With them, it will run PHP's "sprintf"
								function, and tokenize the string
						    	<dl class="dl-horizontal list-docs">
									<dt class="dl-docs-dt"><span class="text-primary">return</span>:</dt>
									<dd class="text-justify">A reference to the class instance, so that they can be chained.</dd>
								</dl>
						    </p>
						    <p class="text-justify">
						    	For example:
						    </p>
						    <pre>
<?php
	echo Methods\CodeHighlighterMethods::highlightText(
		"<?php\n" .
    	"	\$songs = \$db->query()\n" .
		"					->from('songs')\n" .
		"					->where('id = ?', 30)\n" .
		"					->get()\n" . 
		"	//Produces: SELECT id, artist, track, link FROM songs WHERE id = '30'\n" .
		"?>");
?>
							</pre>
							<br>
						    <!-- END $db->query()->where() -->
						</section><!-- lookingforSpecificData -->
						
						<section class="body-main" id="insertingData"><!-- insertingData -->
		  					<div class="page-header-doc"><!-- page-header-doc -->
						      	<h5>Inserting Data</h5>
						    </div><!-- page-header-doc -->
							<!-- START $db->query()->insert() -->
						    <p class="text-justify">
						    	<strong class="text-info">$db->query()->insert()</strong>
						    </p>
						    <p class="text-justify">
						    	Use for inserting data into database. Generates an insert string based on the supplied data, and executes the query.
						    	<dl class="dl-horizontal list-docs">
									<dt class="dl-docs-dt"><span class="text-primary">param</span> <var>$data</var> <small>(array)</small>:</dt>
									<dd class="text-justify">An associative array where the key es the database column name, and the value is the 
									value to insert</dd>
									<dt class="dl-docs-dt"><span class="text-primary">return</span>:</dt>
									<dd class="text-justify">Last inserted Id in case an insert was requested</dd>
								</dl>
						    </p>
						    <p class="text-justify">
						    	For example:
						    </p>
						    <pre>
<?php
echo Methods\CodeHighlighterMethods::highlightText(
		"<?php\n" .
		"	\$db->query()\n" .
		"		->from('songs')\n" .
		"		->insert(array(\n" .
		"			'artist' => \$artist,\n" .
		"			'track' => \$track,\n" .
		"			'link' => \$link\n" .
    	"		));\n" .
		"	// Produces: INSERT INTO `songs` (`artist`, `track`, `link`) VALUES ('The artist', 'The track', 'The link')\n" .
		"?>");
?>
							</pre>
							<br>
						    <!-- END $db->query()->insert() -->
						</section><!-- insertingData -->
						
						<section class="body-main" id="updatingData"><!-- updatingData -->
		  					<div class="page-header-doc"><!-- page-header-doc -->
						      	<h5>Updating Data</h5>
						    </div><!-- page-header-doc -->
							<!-- START $db->query()->update() -->
						    <p class="text-justify">
						    	<strong class="text-info">$db->query()->update()</strong>
						    </p>
						    <p class="text-justify">
						    	Use for updating data. Generates an update string based on the supplied data, and executes the query.
						    	<dl class="dl-horizontal list-docs">
									<dt class="dl-docs-dt"><span class="text-primary">param</span> <var>$data</var> <small>(array)</small>:</dt>
									<dd class="text-justify">An associative array where the key es the database column name, and the value is the 
									value to update</dd>
									<dt class="dl-docs-dt"><span class="text-primary">return</span>:</dt>
									<dd class="text-justify">The number of affected rows</dd>
								</dl>
						    </p>
						    <p class="text-justify">
						    	For example:
						    </p>
						    <pre>
<?php
echo Methods\CodeHighlighterMethods::highlightText(
		"<?php\n" .
		"	\$db->query()\n" .
		"		->from('songs')\n" .
		"		->where('id = ?', \$songId)\n" .
		"		->update(array(\n" .
		"			'artist' => \$artist,\n" .
		"			'track' => \$track,\n" .
		"			'link' => \$link\n" .
    	"		));\n" .
		"	// Produces: UPDATE songs SET artist = 'The artist', track = 'The track', link = 'The link' WHERE id = '37'\n" .
		"?>");
?>
							</pre>
							<br>
						    <!-- END $db->query()->update() -->
						</section><!-- updatingData -->
						
						<section class="body-main" id="deletingData"><!-- deletingData -->
		  					<div class="page-header-doc"><!-- page-header-doc -->
						      	<h5>Deleting Data</h5>
						    </div><!-- page-header-doc -->
							<!-- START $db->query()->update() -->
						    <p class="text-justify">
						    	<strong class="text-info">$db->query()->update()</strong>
						    </p>
						    <p class="text-justify">
						    	Use for deleting database information. Generates delete string based on the supplied data, and executes the query.
						    	<dl class="dl-horizontal list-docs">
									<dt class="dl-docs-dt"><span class="text-primary">return</span>:</dt>
									<dd class="text-justify">The number of affected rows</dd>
								</dl>
						    </p>
						    <p class="text-justify">
						    	For example:
						    </p>
						    <pre>
<?php
echo Methods\CodeHighlighterMethods::highlightText(
		"<?php\n" .
		"	\$db->query()\n" .
		"		->from('songs')\n" .
		"		->where('id = ?', \$songId)\n" .
		"		->delete();\n" .
		"	// Produces: DELETE FROM songs WHERE id = '37'\n" .
		"?>");
?>
							</pre>
							<br>
						    <!-- END $db->query()->update() -->
						</section><!-- deletingData -->
						
						<section class="body-main" id="executingSQL"><!-- executingSQL -->
		  					<div class="page-header-doc"><!-- page-header-doc -->
						      	<h5>Executing SQL Statements</h5>
						    </div><!-- page-header-doc -->
							<!-- START $db->query()->execute() -->
						    <p class="text-justify">
						    	<strong class="text-info">$db->query()->execute()</strong>
						    </p>
						    <p class="text-justify">
						    	Executes the SQL query statment.
						    	<dl class="dl-horizontal list-docs">
									<dt class="dl-docs-dt"><span class="text-primary">param</span> <var>$sql</var> <small>(string)</small>:</dt>
									<dd class="text-justify">The SQL query to execute</dd>
									<dt class="dl-docs-dt"><span class="text-primary">return</span>:</dt>
									<dd class="text-justify">PDOStatement</dd>
								</dl>
						    </p>
						    <p class="text-justify">
						    	For example:
						    </p>
						    <pre>
<?php
echo Methods\CodeHighlighterMethods::highlightText(
		"<?php\n" .
		"	\$db->query()->execute(\$sql)\n" .
		"?>");
?>
							</pre>
							<br>
						    <!-- END $db->query()->execute() -->
						</section><!-- executingSQL -->
						
					</section><!-- databaseLib -->
