					<section class="body-section" id="requirements"><!-- requirements -->
	  					<h3><strong>The Basics</strong></h3>
	  					<div class="page-header-doc"><!-- page-header-doc -->
					      	<h4>Requirements</h4>
					    </div><!-- page-header-doc -->
					    <p class="text-justify">You need a standard Web server with at least:</p>
				    	<ul class="fa-ul list-docs">
						  <li><i class="fa-li fa fa-check-square"></i>PHP 5.3.2 or higher</li>
						  <li><i class="fa-li fa fa-check-square"></i>MySQL</li>
						  <li><i class="fa-li fa fa-check-square"></i>Make sure <em>mod_rewrite</em> is enabled and activated</li>
						  <li><i class="fa-li fa fa-check-square"></i>Basic knowledge of Composer</li>
						</ul>
					    <p class="text-justify">
							For your development environment, I usually use <a href="http://www.wampserver.com/en/">WAMPServer</a>, which is a Windows web 
							development environment, and stands for <strong>W</strong>indows, <strong>A</strong>pache, <strong>M</strong>ySQL and 
							<strong>PHP</strong>.
							<br></br>
							Now, Composer is a very simple and easy to use dependency manager for PHP. It allows you to declare the libraries your project 
							depends on and it will manage (install/update) them for you. You can download the Windows installer from their official 
							<a href="https://getcomposer.org/download/">site</a>. 
					    </p>
					</section><!-- requirements -->
					
					<section class="body-section" id="installation"><!-- installation -->
	  					<div class="page-header-doc"><!-- page-header-doc -->
					      	<h4>Installation</h4>
					    </div><!-- page-header-doc -->
					    <p class="text-justify">Just follow these steps:</p>
				    	<ol class="list-docs">
				  			<li>Edit the database credentials in <code>application/config/config.php</code></li>
				  			<li>Execute the <em>.sql</em> statements in the <code>_install/</code>- folder (with <a href="https://www.phpmyadmin.net/">PHPMyAdmin</a> for example).</li>
				  			<li>Make sure you have <em>mod_rewrite</em> activated on your server / in your environment.</li>
				  			<li>
								Install Composer and run <code>composer install</code> in the project's folder to download the dependencies and create the 
								autoloading stuff from Composer automatically. For those who are not familiar with Composer, just remember back in the days, 
								when you were using a PHP files with all the includes you needed. Well, Composer creates classes that automatically do this.
							</li>
						</ol>
						<br></br>
					    <p class="text-justify">
							<strong>MINI-FRAMEWORK-MVC</strong> runs without any further configuration. You can also put it inside a sub-folder, it will work 
							without any further configuration.
							<br></br>
							If you want to test the mail library, you have to modify the configuration under <code>application/config/config.php</code>.
							At the moment, if you have a Gmail account, you should only need to modify the parameters `SMTP_USERNAME` and `SMTP_PWD`
							with your own Gmail account and password. If you get errors, you might have to configure your Gmail accout by following 
							this easy step:
							<blockquote>
								Head over to <a href="https://www.google.com/settings/security/lesssecureapps">Account Security Settings</a> and enable "Access 
								for less secure apps", this allows you to use Google's SMTP for clients other than the official ones.
							</blockquote>
					    </p>
					</section><!-- installation -->
					
					<section class="body-section" id="security"><!-- security -->
	  					<div class="page-header-doc"><!-- page-header-doc -->
					      	<h4>Security</h4>
					    </div><!-- page-header-doc -->
					    <p class="text-justify">
					    	In order to limit the access to only the /public folder, we use <em>mod_rewrite</em>. These will keep other folder such as the 
					    	/application folder save from unwanted visitors. To do so, we have created the <code>.htaccess</code> file. This file alters how 
					    	Apache web server treats a directory and its contents. To achive this, we have to follow a specific syntax.
					    </p>
					</section><!-- security -->