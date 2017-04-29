<?php
namespace Application\Libs\Methods;

use Application\Libs\Methods;
?>
					
					<section class="body-section" id="sessionLib"><!-- sessionLib -->
	  					<div class="page-header-doc"><!-- page-header-doc -->
					      	<h4>Session</h4>
					    </div><!-- page-header-doc -->
					    <p class="text-justify">
					    	This library is useful for maintaining the user's current "state" and keep track of its activity while visiting your Web site. 
					    	Because sessions run globally with each page load, a good place for using them would be in the controller.
					    </p>
					    <p class="text-justify">
					    	Before start using the session library, configure the variable <var>MAX_INACTIVE_SESSION</var> in the <code>application/config/config.php</code> file. Simply, modify the following
					    	parameter to suit your needs:
					    	<ul class="fa-ul list-docs">
						  		<li><i class="fa-li fa fa-check-square"></i><code>MAX_INACTIVE_SESSION</code>: The maximum number of seconds a session can be inactive</li>
					    	</ul>
					    </p>
					    <p class="text-justify">
					    	In the following code snippet, we use the session library to validate that there are some session variables already set and that 
					    	the session has not been unactive for more then the number of seconds specified in the configuration variable <var>MAX_INACTIVE_SESSION</var>. 
					    </p>
					    <pre>
<?php
echo Methods\CodeHighlighterMethods::highlightText(
		"<?php\n" .
		"	//get an instance of the session library\n" .
		"	\$session = \$this->session();\n\n" .
		"	//varify that the session variables SID and email exists\n" .
		"	if(\$session->hasVariable('SID') && \$session->hasVariable('email')) {\n" .
		"		//varify that the session has not been inactive for more than MAX_INACTIVE_SESSION seconds\n" .
		"		if(\$session->isSessionActive()) {\n".
		"			//do something for the valid session\n" .
		"		}\n" .
		"	}\n\n" .
		"	//do something for the invalid session\n" .
		"?>");
?>
						</pre>
					    <p class="text-justify">
					    	The above example can be use for restricting access to a controller if a user is not logged in for instance. 
					    </p>
						    
					    <!-- START $this->session()->isSessionDisable() -->
					    <p class="text-justify">
					    	<strong class="text-info">$this->session()->isSessionDisable()</strong>
					    </p>
					    <p class="text-justify">
					    	Checks if the session is disabled or not. Returns true if the session is disable, false otherwise.
					    	<dl class="dl-horizontal list-docs">
								<dt class="dl-docs-dt"><span class="text-primary">return</span>:</dt>
								<dd class="text-justify">true if the session is disable, false otherwise</dd>
							</dl>
					    </p>
						<p class="text-justify">
					    	For example:
					    </p>
					    <pre>
<?php
echo Methods\CodeHighlighterMethods::highlightText(
		"<?php\n" .
		"	\$this->session()->isSessionDisable();\n" .
		"?>");
?>
						</pre>
						<hr class="hr-blue-lighten-5"><br>
					    <!-- END $this->session()->isSessionDisable() -->
						    
					    <!-- START $this->session()->isSessionActive() -->
					    <p class="text-justify">
					    	<strong class="text-info">$this->session()->isSessionActive()</strong>
					    </p>
					    <p class="text-justify">
					    	Checks if the session is active. A session is considered active if:
					    	<ol class="list-docs">
					    		<li>sessions are enabled, but none exists; or</li>
					    		<li>sessions are enabled, and one exists; and</li>
					    		<li>the difference between the session's creation timestamp and the current timestamp is less 
					    		than the value specified by the constant MAX_INACTIVE_SESSION</li>
					    	</ol>
					    	<dl class="dl-horizontal list-docs">
								<dt class="dl-docs-dt"><span class="text-primary">return</span>:</dt>
								<dd class="text-justify">true if the sessions are enabled, false otherwise</dd>
							</dl>
					    </p>
						<p class="text-justify">
					    	For example:
					    </p>
					    <pre>
<?php
echo Methods\CodeHighlighterMethods::highlightText(
		"<?php\n" .
		"	\$this->session()->isSessionActive();\n" .
		"?>");
?>
						</pre>
						<hr class="hr-blue-lighten-5"><br>
					    <!-- END $this->session()->isSessionActive() -->
						    
					    <!-- START $this->session()->setVariable() -->
					    <p class="text-justify">
					    	<strong class="text-info">$this->session()->setVariable()</strong>
					    </p>
					    <p class="text-justify">
					    	Creates and sets a session variable. The function accepts a string or an associative array, where the key is the 
					    	variable name and the value is the actual value of the variable.
					    	<dl class="dl-horizontal list-docs">
								<dt class="dl-docs-dt"><span class="text-primary">param</span> <var>$data</var> <small>(string|array)</small>:</dt>
								<dd class="text-justify">if <var>$data</var> is a string, it is considered as the session variable name</dd>
								<dt class="dl-docs-dt"><span class="text-primary">param</span> <var>$value</var> <small>(string)</small>:</dt>
								<dd class="text-justify">value of the session variable. Only used if <var>$data</var> is a string</dd>
								<dt class="dl-docs-dt"><span class="text-primary">return</span>:</dt>
								<dd class="text-justify">true if the sessions are enabled, false otherwise</dd>
							</dl>
					    </p>
						<p class="text-justify">
					    	Here is an example of setting a variable when the parameter is a string:
					    </p>
					    <pre>
<?php
echo Methods\CodeHighlighterMethods::highlightText(
		"<?php\n" .
		"	//sets the variable name with the value of Luis\n" .
		"	\$this->session()->setVariable('name', 'Luis');\n" .
		"?>");
?>
						</pre>
						<p class="text-justify">
					    	And here is an example of setting a variable by passing an associative array:
					    </p>
					    <pre>
<?php
echo Methods\CodeHighlighterMethods::highlightText(
		"<?php\n" .
		"	//sets the variable name with the value of Pedro and the variable lastname to Doe\n" .
		"	\$this->session()->setVariable(array(\n" .
		"		'name' => 'Pedro',\n" .
		"		'lastname' => 'Doe'));\n" .
		"?>");
?>
						</pre>
						<hr class="hr-blue-lighten-5"><br>
					    <!-- END $this->session()->setVariable() -->
						    
					    <!-- START $this->session()->unsetVariable() -->
					    <p class="text-justify">
					    	<strong class="text-info">$this->session()->unsetVariable()</strong>
					    </p>
					    <p class="text-justify">
					    	Unsets a session variable but only if exists.
					    	<dl class="dl-horizontal list-docs">
								<dt class="dl-docs-dt"><span class="text-primary">param</span> <var>$data</var> <small>(string|array)</small>:</dt>
								<dd class="text-justify">if <var>$data</var> is a string, it is considered as the session variable name</dd>
								<dt class="dl-docs-dt"><span class="text-primary">return</span>:</dt>
								<dd class="text-justify">an instance of the class for chaining</dd>
							</dl>
					    </p>
						<p class="text-justify">
					    	Here is an example of setting a variable when the parameter is a string:
					    </p>
					    <pre>
<?php
echo Methods\CodeHighlighterMethods::highlightText(
		"<?php\n" .
		"	//unsets the variable name\n" .
		"	\$this->session()->unsetVariable('name');\n" .
		"?>");
?>
						</pre>
						<p class="text-justify">
					    	And here the variables <var>name</var> and <var>lastname</var> are unset:
					    </p>
					    <pre>
<?php
echo Methods\CodeHighlighterMethods::highlightText(
		"<?php\n" .
		"	//unsets the variables name and lastname\n" .
		"	\$this->session()->unsetVariable(array(\n" .
		"		'name', 'lastname'));\n" .
		"?>");
?>
						</pre>
						<hr class="hr-blue-lighten-5"><br>
					    <!-- END $this->session()->unsetVariable() -->
						    
					    <!-- START $this->session()->hasVariable() -->
					    <p class="text-justify">
					    	<strong class="text-info">$this->session()->hasVariable()</strong>
					    </p>
					    <p class="text-justify">
					    	Checks if a session variable exists.
					    	<dl class="dl-horizontal list-docs">
								<dt class="dl-docs-dt"><span class="text-primary">param</span> <var>$key</var> <small>(string)</small>:</dt>
								<dd class="text-justify">The name of the variable which needs to be verified of its existance</dd>
								<dt class="dl-docs-dt"><span class="text-primary">return</span>:</dt>
								<dd class="text-justify">true if it exists, false otherwise</dd>
							</dl>
					    </p>
						<p class="text-justify">
					    	For example:
					    </p>
					    <pre>
<?php
echo Methods\CodeHighlighterMethods::highlightText(
		"<?php\n" .
		"	\$this->session()->hasVariable('name');\n" .
		"?>");
?>
						</pre>
						<hr class="hr-blue-lighten-5"><br>
					    <!-- END $this->session()->hasVariable() -->
						    
					    <!-- START $this->session()->getVariable() -->
					    <p class="text-justify">
					    	<strong class="text-info">$this->session()->getVariable()</strong>
					    </p>
					    <p class="text-justify">
					    	Gets the value of a session variable.
					    	<dl class="dl-horizontal list-docs">
								<dt class="dl-docs-dt"><span class="text-primary">param</span> <var>$key</var> <small>(string)</small>:</dt>
								<dd class="text-justify">The name of the variable which needs to be verified of its existance</dd>
								<dt class="dl-docs-dt"><span class="text-primary">return</span>:</dt>
								<dd class="text-justify">The value of the session variable if it exists, false otherwise</dd>
							</dl>
					    </p>
						<p class="text-justify">
					    	For example:
					    </p>
					    <pre>
<?php
echo Methods\CodeHighlighterMethods::highlightText(
		"<?php\n" .
		"	\$this->session()->getVariable('name');\n" .
		"?>");
?>
						</pre>
						<hr class="hr-blue-lighten-5"><br>
					    <!-- END $this->session()->getVariable() -->
						    
					    <!-- START $this->session()->regenerateId() -->
					    <p class="text-justify">
					    	<strong class="text-info">$this->session()->regenerateId()</strong>
					    </p>
					    <p class="text-justify">
					    	Update the current session id with a newly generated one. It will replace the current session id with a new one, 
					    	and keep the current session information.
					    	<dl class="dl-horizontal list-docs">
								<dt class="dl-docs-dt"><span class="text-primary">param</span> <var>$deleteOldSession</var> <small>(boolean)</small>:</dt>
								<dd class="text-justify">Whether to delete the old associated session file or not. Default is true</dd>
								<dt class="dl-docs-dt"><span class="text-primary">return</span>:</dt>
								<dd class="text-justify">true on success, false otherwise</dd>
							</dl>
					    </p>
						<p class="text-justify">
					    	For example:
					    </p>
					    <pre>
<?php
echo Methods\CodeHighlighterMethods::highlightText(
		"<?php\n" .
		"	\$this->session()->regenerateId(false);\n" .
		"?>");
?>
						</pre>
						<hr class="hr-blue-lighten-5"><br>
					    <!-- END $this->session()->regenerateId() -->
						    
					    <!-- START $this->session()->sessionId() -->
					    <p class="text-justify">
					    	<strong class="text-info">$this->session()->sessionId()</strong>
					    </p>
					    <p class="text-justify">
					    	Get and/or set the current session id.
					    	<dl class="dl-horizontal list-docs">
								<dt class="dl-docs-dt"><span class="text-primary">return</span>:</dt>
								<dd class="text-justify">The session id for the current session or the empty string ("") if there is no current
								session (no current session id exists)</dd>
							</dl>
					    </p>
						<p class="text-justify">
					    	For example:
					    </p>
					    <pre>
<?php
echo Methods\CodeHighlighterMethods::highlightText(
		"<?php\n" .
		"	\$this->session()->sessionId();\n" .
		"?>");
?>
						</pre>
						<hr class="hr-blue-lighten-5"><br>
					    <!-- END $this->session()->sessionId() -->
						    
					    <!-- START $this->session()->destroySession() -->
					    <p class="text-justify">
					    	<strong class="text-info">$this->session()->destroySession()</strong>
					    </p>
					    <p class="text-justify">
					    	Destroys current session.
					    </p>
						<p class="text-justify">
					    	For example:
					    </p>
					    <pre>
<?php
echo Methods\CodeHighlighterMethods::highlightText(
		"<?php\n" .
		"	\$this->session()->destroySession();\n" .
		"?>");
?>
						</pre>
						<hr class="hr-blue-lighten-5"><br>
					    <!-- END $this->session()->destroySession() -->
						    
					    <!-- START $this->session()->createSession() -->
					    <p class="text-justify">
					    	<strong class="text-info">$this->session()->createSession()</strong>
					    </p>
					    <p class="text-justify">
					    	Creates the user's session. It automatically generates a session variable called SID with the id of 
					    	the current session. In addition, you can add other session variables by passing the <var>$data</var> parameter.
					    	<dl class="dl-horizontal list-docs">
								<dt class="dl-docs-dt"><span class="text-primary">param</span> <var>$data</var> <small>(array)</small>:</dt>
								<dd class="text-justify">An associative array where the key is the variable name and the value is the value 
								of the variable</dd>
								<dt class="dl-docs-dt"><span class="text-primary">return</span>:</dt>
								<dd class="text-justify">true if the session was successfully created, false otherwise</dd>
							</dl>
					    </p>
						<p class="text-justify">
					    	For example:
					    </p>
					    <pre>
<?php
echo Methods\CodeHighlighterMethods::highlightText(
		"<?php\n" .
		"	\$this->session()->createSession(array(\n" .
		"		'username' => 'john.doe',\n" .
		"		'email' => 'john.doe@live.es'));\n" .
		"	//Creates three session variables: (1) SID; (2) username with the provided value; and (3) email with the provided value\n" .
		"?>");
?>
						</pre>
					    <!-- END $this->session()->createSession() -->
					</section><!-- sessionLib -->