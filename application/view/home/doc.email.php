<?php
namespace Application\Libs\Methods;

use Application\Libs\Methods;
?>
					<section class="body-section" id="emailLib"><!-- emailLib -->
	  					<div class="page-header-doc"><!-- page-header-doc -->
					      	<h4>Email</h4>
					    </div><!-- page-header-doc -->
				    	<blockquote>
					    	<p class="text-justify">
						    	<strong>NOTE:</strong> For the emailing library, <a href="https://github.com/PHPMailer/PHPMailer/">PHPMailer</a> library was extended and implemented. 
						    	This was done for simplicity.
					    	</p>
				    	</blockquote>
				    	<blockquote>
					    	<p class="text-justify">
						    	<strong>NOTE:</strong> You can use Gmail SMTP server to send mail, but you have to configure the Gmail accout that you will be using. Head over to 
						    	<a href="https://www.google.com/settings/security/lesssecureapps">Account Security Settings</a> and enable "Access for less secure apps", this allows 
						    	you to use the google SMTP for clients other than the official ones.
					    	</p>
				    	</blockquote>
					    
					    <p class="text-justify">
					    	<ul class="fa-ul list-docs">
						  		<li><i class="fa-li fa fa-check-square"></i>
					    			<a href="#emailConfig">Email Configuration</a>
					    		</li>
					    		<li><i class="fa-li fa fa-check-square"></i>
					    			<a href="#sendingEMailBasic">Sending Mail (Basic)</a>
					    		</li>
					    	</ul>
					    </p>
					    
					    <section class="body-main" id="emailConfig"><!-- emailConfig -->
		  					<div class="page-header-doc"><!-- page-header-doc -->
						      	<h5>Email Configuration</h5>
						    </div><!-- page-header-doc -->
						    <p class="text-justify">
						    	The email configuration is done in the <code>application/config/config.php</code> file. Simply, modify the following
						    	parameter to suit your needs:
						    	<ul class="fa-ul list-docs">
							  		<li><i class="fa-li fa fa-check-square"></i><code>IS_SMTP</code>: Tells PHPMailer to use SMTP</li>
						    		<li><i class="fa-li fa fa-check-square"></i><code>MAIL_SERVER</code>: Sets the hostname of the mail server</li>
						    		<li><i class="fa-li fa fa-check-square"></i><code>SMTP_PORT</code>: Sets the SMTP port number - 587 for authenticated TLS, a.k.a. RFC4409 SMTP submission</li>
						    		<li><i class="fa-li fa fa-check-square"></i><code>SMTP_USERNAME</code>: Username to use for SMTP authentication - use full email address for gmail</li>
						    		<li><i class="fa-li fa fa-check-square"></i><code>SMTP_PWD</code>: Password to use for SMTP authentication</li>
						    		<li><i class="fa-li fa fa-check-square"></i><code>SMTP_DEBUG</code>: Enable SMTP debugging: (0) = off (for production use); (1) = client messages; 
						    		(2) = client and server messages. Default is 0</li>
						    		<li><i class="fa-li fa fa-check-square"></i><code>SMTP_SECURE</code>: Set the encryption system to use - ssl (deprecated) or tls. Default is tls</li>
						    		<li><i class="fa-li fa fa-check-square"></i><code>SMTP_AUTH</code>: Whether to use SMTP authentication. Default is true</li>
						    		<li><i class="fa-li fa fa-check-square"></i><code>MAIL_CHARSET</code>: Sets the character set</li>
						    		<li><i class="fa-li fa fa-check-square"></i><code>DEBUG_OUTPUT</code>: Ask for HTML-friendly debug output. Default is html</li>
						    	</ul>
						    </p>
						</section><!-- emailConfig -->
						
						<section class="body-main" id="sendingEMailBasic"><!-- sendingEMailBasic -->
		  					<div class="page-header-doc"><!-- page-header-doc -->
						      	<h5>Sending Mail (Basic)</h5>
						    </div><!-- page-header-doc -->
						    <p class="text-justify">
						    	For example:
						    </p>
						    <pre>
<?php
echo Methods\CodeHighlighterMethods::highlightText(
		"<?php\n" .
		"	//get an instance of the mail library\n" .
		"	\$mailer = \$this->emailer();\n" .
		"	//specify some senders\n" .
		"	\$mailer->from(mini.framework.mvc@gmail.com, 'MINI-FRAMEWORK-MVC');\n" .
		"	//specify some recipients\n" .
		"	\$mailer->addRecipient('john.doe@gmail.com', 'John Doe');\n" .
		"	//specify a mail subject\n" .
		"	\$mailer->Subject = 'This is a test';\n" .
		"	//specify the body\n" .
		"	\$mailer->msgHTML(file_get_contents(APP . '\\\\view\_templates\_mail\contents.html'), APP . '\\\\view\_templates\_mail');\n" .
		"	//send the mail\n" .
		"	\$mailer->sendMail();\n" .
		"?>");
?>
							</pre>
							<br>
						</section><!-- sendingEMailBasic -->
					</section><!-- emailLib -->