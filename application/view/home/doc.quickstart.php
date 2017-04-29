<?php
namespace Application\Libs\Methods;

use Application\Libs\Methods;
?>
					<section class="body-section" id="structure"><!-- structure -->
	  					<h3><strong>Quick Start</strong></h3>
	  					<div class="page-header-doc"><!-- page-header-doc -->
					      	<h4>The structure in general</h4>
					    </div><!-- page-header-doc -->
					    
					    <p class="text-justify">
					    	After you’ve downloaded and extracted the application, these are the files and folders you should see:
					    </p>
					    
				    	<ul class="fa-ul list-docs">
						  	<li><i class="fa-li fa fa-folder"></i><code>_instal</code>: has the SQL files for creating the database demo data</li>
						  	<li>
						  		<i class="fa-li fa fa-folder-open"></i>
						  		<code>application</code>: contains the application you' re creating. Basically, it holds your models, views, controllers, and other code 
						  		(like helpers and class extensions). In other words, this is the folder where you do your magic
						  		<ul class="fa-ul list-docs">
						  			<li><i class="fa-li fa fa-folder"></i><code>config</code>: holds the configuration file that <strong>MINI-FRAMEWORK-MVS</strong> uses</li>
						  			<li><i class="fa-li fa fa-folder"></i><code>controller</code>: in this folder you will place your class files developed for your application</li>
						  			<li><i class="fa-li fa fa-folder"></i><code>core</code>: place your base class files of your application</li>
						  			<li><i class="fa-li fa fa-folder"></i><code>libs</code>: place your own developed libraries useful for your application</li>
						  			<li><i class="fa-li fa fa-folder"></i><code>model</code>: data base fetching logic in</li>
						  			<li><i class="fa-li fa fa-folder"></i><code>view</code>: most of your work will be in this folder, you will place your html template files</li>
						  		</ul>
						  	</li>
						  	<li><i class="fa-li fa fa-folder"></i><code>public</code>: public document root of your application. It contains all the files you want to be publically reachable</li>
						  	<li><i class="fa-li fa fa-folder"></i><code>vendor</code>: application dependencies are installed</li>
						  	<li><i class="fa-li fa fa-file-text"></i>.htaccess</li>
						  	<li><i class="fa-li fa fa-file-text"></i>composer.json</li>
						  	<li><i class="fa-li fa fa-file-text"></i>README.md</li>
						</ul>
					    <br></br>
					    <p class="text-justify">
					    	Whenever there is an URL request, the application will automatically translate the URL-path to the appropiate controllers and their methods inside. Take a look
					    	at the following examples:
					    </p>
					    
				    	<ul class="fa-ul list-docs">
				    		<li>
				    			<i class="fa-li fa fa-check-square"></i>
						  		<code>http://localhost/mini-master/home/index</code> will call the <code>index()</code> method in <code>application/controllers/Home.php</code>.
						  	</li>
						  	<li>
						  		<i class="fa-li fa fa-check-square"></i>
						  		<code>http://localhost/mini-master/home/documentation</code> will execute <code>documentation()</code> method in <code>application/controllers/Home.php</code>.
						  	</li>
						</ul>
					    <br></br>
					    <p class="text-justify">
					    	The following links are only visible for logged in users.
					    </p>
						
						<ul class="fa-ul list-docs">
				    		<li>
				    			<i class="fa-li fa fa-check-square"></i>
						  		<code>http://localhost/mini-master/songs/add</code> will call <code>add()</code> method in <code>application/controllers/Songs.php</code>.
						  	</li>
						  	<li>
								<i class="fa-li fa fa-check-square"></i>
								<code>http://localhost/mini-master/songs/listofsongs</code> will do what the <code>listOfSongs()</code> method in <code>application/controllers/Songs.php</code> says.								
							</li>
							<li>
								<i class="fa-li fa fa-check-square"></i>
								<code>http://localhost/mini-master/songs/editsong/28</code> will execute the <code>editSong()</code> method in <code>application/controllers/Songs.php</code> 
								and will pass '28' as a parameter to it.				
							</li>
						</ul>

					</section><!-- structure -->
			
					<section class="body-section" id="showingView"><!-- showingView -->
	  					<div class="page-header-doc"><!-- page-header-doc -->
					      	<h4>Showing a view</h4>
					    </div><!-- page-header-doc -->
					    <p class="text-justify">
					    	Let's look at the <code>documentation()</code> method in <code>application/controllers/Home.php</code>: This simply shows the 
					    	header, navbar, footer and the documentation.php page (in views/home/). If you need to do something like preparing data, you 
					    	can add the needed code before loading the views.
					    </p>
						<pre>
<?php
	echo Methods\CodeHighlighterMethods::highlightText(
		"<?php\n" .
		"	public function documentation() {\n" .
		"		// load views\n" .
		"		require APP . 'view/_templates/header.php';\n" .
		"		require APP . 'view/_templates/nav.header.php';\n" .
		"		require APP . 'view/home/documentation.php';\n" .
		"		require APP . 'view/_templates/footer.php';\n" .
		"	}\n" . 
		"?>");
?>
						</pre>
					</section><!-- showingView -->
					
					<section class="body-section" id="workingWithData"><!-- "workingWithData" -->
	  					<div class="page-header-doc"><!-- page-header-doc -->
					      	<h4>Working with data</h4>
					    </div><!-- page-header-doc -->
					    <p class="text-justify">
					    	Let's look into the <code>listOfSongs()</code> method in the <code>application/controllers/Songs.php</code>: Similar to documentation, 
					    	but here we also request data. Again, everything is extremely reduced and simple: <code>$this->model->getAllSongs()</code> simply calls 
					    	the <code>getAllSongs()</code> method in <code>application/model/model.php</code>.
					    </p>
					    <pre>
<?php
	echo Methods\CodeHighlighterMethods::highlightText(
		"<?php\n" .
		"	public function listOfSongs() {\n" .
		"		\$this->loadModel('Songs');\n" .
		"		\$songs = \$this->model->getAllSongs();\n" .
		"		// load views. within the views we can echo out \$songs\n" .
		"		require APP . 'view/_templates/header.php';\n" .
		"		require APP . 'view/_templates/nav.header.php';\n" .
		"		require APP . 'view/songs/listofsongs.php';\n" .
		"		require APP . 'view/_templates/footer.php';\n" .
		"	}\n" . 
		"?>");
?>
					    </pre>
					    <br></br>
					    <p class="text-justify">
					    	The data-handling method for retreiving the list of songs from the database are in <code>application/model/Songs.php</code>. Have a 
							look how <code>getAllSongs()</code> in <code>Songs.php</code> looks like.
					    </p>
					    <pre>
<?php 
	echo Methods\CodeHighlighterMethods::highlightText("<?php\n" .
		"	public function getAllSongs() {\n" .
		"		// get a database instance\n" .
		"		\$db = new Database\Database();\n" .
		"		//connect to database\n" .
		"		\$db = \$db->connect();\n" .
		"		\$all = \$db->query()\n" .
		"		->from('songs', array(\n" .
		"				'id',\n" .
		"				'artist',\n" .
		"				'track',\n" .
		"				'link'\n" .
		"		))\n" .
		"		->order('id', 'desc')\n" .
		"		->all();\n" .
		"		//disconnect from database\n" .
		"		\$db->disconnect();\n" .
		"		return \$all;\n" .
		"	}\n" . 
		"?>");
?>
					    </pre>
					    <br></br>
					    <p class="text-justify">
					    	The result, here <var>$songs</var>, can then easily be used directly inside the view files (in this case <code>application/views/songs/listofsongs.php</code>, 
							in a simplified example):
						</p>
					    <pre>
					    	<code>
&lt;table class="table table-striped table-bordered table-hover table-condensed"&gt;
&nbsp;&lt;thead&gt;
&nbsp;&nbsp;&lt;tr&gt;
&nbsp;&nbsp;&nbsp;&lt;th class="text-center"&gt;Id&lt;/th&gt;
&nbsp;&nbsp;&nbsp;&lt;th class="text-center"&gt;Artist&lt;/th&gt;
&nbsp;&nbsp;&nbsp;&lt;th class="text-center"&gt;Track&lt;/th&gt;
&nbsp;&nbsp;&nbsp;&lt;th class="text-center"&gt;Link&lt;/th&gt;
&nbsp;&nbsp;&nbsp;&lt;th class="text-center"&gt;&lt;/th&gt;
&nbsp;&nbsp;&lt;/tr&gt;
&nbsp;&lt;/thead&gt;
&nbsp;&lt;tbody&gt;
&nbsp;<?php echo Methods\CodeHighlighterMethods::highlightText("<?php foreach (\$songs as \$song) { ?>") . "\n"; ?>
&nbsp;&nbsp;&lt;tr&gt;
&nbsp;&nbsp;&nbsp;&lt;td&gt;<?php echo Methods\CodeHighlighterMethods::highlightText("<?php if (isset(\$song['id'])) echo htmlspecialchars(\$song['id'], ENT_QUOTES, CHARSET); ?>"); ?>&lt;/td&gt;
&nbsp;&nbsp;&nbsp;&lt;td&gt;<?php echo Methods\CodeHighlighterMethods::highlightText("<?php if (isset(\$song['artist'])) echo htmlspecialchars(\$song['artist'], ENT_QUOTES, CHARSET); ?>"); ?>&lt;/td&gt;
&nbsp;&nbsp;&nbsp;&lt;td&gt;<?php echo Methods\CodeHighlighterMethods::highlightText("<?php if (isset(\$song['track'])) echo htmlspecialchars(\$song['track'], ENT_QUOTES, CHARSET); ?>"); ?>&lt;/td&gt;
&nbsp;&nbsp;&nbsp;&lt;td&gt;
&nbsp;&nbsp;&nbsp;<?php echo Methods\CodeHighlighterMethods::highlightText("<?php if (isset(\$song['link'])) { ?>") . "\n"; ?>
&nbsp;&nbsp;&nbsp;&nbsp;&lt;a href="<?php echo Methods\CodeHighlighterMethods::highlightText("<?php echo htmlspecialchars(\$song['link'], ENT_QUOTES, CHARSET); ?>"); ?>"&gt;<?php echo Methods\CodeHighlighterMethods::highlightText("<?php echo htmlspecialchars(\$song['link'], ENT_QUOTES, CHARSET); ?>"); ?>&lt;/a&gt;
&nbsp;&nbsp;&nbsp;<?php echo Methods\CodeHighlighterMethods::highlightText("<?php } ?>") . "\n"; ?>
&nbsp;&nbsp;&nbsp;&lt;/td&gt;
&nbsp;&nbsp;&nbsp;&lt;td&gt;
&nbsp;&nbsp;&nbsp;&nbsp;&lt;div class="btn-toolbar" role="toolbar"&gt;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&lt;div class="btn-group btn-group-xs" role="group"&gt;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&lt;a class="btn btn-default" href="<?php echo Methods\CodeHighlighterMethods::highlightText("<?php echo URL . 'songs/deletesong/' . htmlspecialchars(\$song['id'], ENT_QUOTES, CHARSET); ?>"); ?>" role="button" title="Delete"&gt;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&lt;span class="glyphicon glyphicon glyphicon-remove" aria-hidden="true"&gt;&lt;/span&gt;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&lt;/a&gt;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&lt;a class="btn btn-default" href="<?php echo Methods\CodeHighlighterMethods::highlightText("<?php echo URL . 'songs/editsong/' . htmlspecialchars(\$song['id'], ENT_QUOTES, CHARSET); ?>"); ?>" role="button" title="Edit"&gt;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&lt;span class="glyphicon glyphicon glyphicon-pencil" aria-hidden="true"&gt;&lt;/span&gt;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&lt;/a&gt;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&lt;/div&gt;
&nbsp;&nbsp;&nbsp;&nbsp;&lt;/div&gt;
&nbsp;&nbsp;&nbsp;&lt;/td&gt;
&nbsp;&nbsp;&lt;/tr&gt;
&nbsp;<?php echo Methods\CodeHighlighterMethods::highlightText("<?php } ?>") . "\n"; ?>
&nbsp;&lt;/tbody&gt;
&lt;/table&gt;
							</code>
						</pre>
					</section><!-- "workingWithData" -->
					
					<section class="body-section" id="sendingMail"><!-- sendingMail -->
	  					<div class="page-header-doc"><!-- page-header-doc -->
					      	<h4>Sending mail</h4>
					    </div><!-- page-header-doc -->
					    <p class="text-justify">
					    	For the emailing library, I have extended <a href="https://github.com/PHPMailer/PHPMailer/">PHPMailer</a>. This was done for 
							simplicity. I just created the basic functions needed, added extra validations and called <a href="https://github.com/PHPMailer/PHPMailer/">PHPMailer</a> 
							functions afterwards. 
							<br></br>
							Sending an e-mail is quite easy and straight forward. Let's look into the <code>contactUs()</code> method in <code>application/controllers/Home.php</code>. 
							Simply specify a sender, add recipients, type a subject, and a body, and finally call the <code>sendMail()</code> menthod.
					    </p>
					    <pre>
<?php
	echo Methods\CodeHighlighterMethods::highlightText(
		"<?php\n" .
		"	\$mailer = \$this->emailer();\n" .
		"	\$mailer->from(SMTP_USERNAME, 'MINI-FRAMEWORK-MVC');\n" .
		"	\$mailer->addRecipient(SMTP_USERNAME, 'MINI-FRAMEWORK-MVC');\n" .
		"	\$mailer->subject('This is a test');\n" .
		"	\$mailer->replyTo('no-reply@miniframework.com', 'MINI-FRAMEWORK-MVC no-reply');\n" .
		"	\$mailer->htmlBody(file_get_contents(APP . '\\\\view\_templates\_mail\contents.html'), APP . '\\\\view\_templates\_mail');\n" .
		"	\$mailer->sendMail();\n" . 
		"?>");
?>
					    </pre>
					</section><!-- sendingMail -->
					
					<section class="body-section" id="creatingForms"><!-- creatingForms -->
	  					<div class="page-header-doc"><!-- page-header-doc -->
					      	<h4>Creating forms</h4>
					    </div><!-- page-header-doc -->
					    <p class="text-justify">
					    	Create forms with a base URL built from your config preferences. The main benefit of using this helper library rather 
							than hard coding your own HTML, is that it permits your site to be more portable in the event your URLs ever change, 
							and also, you will for sure know that all your forms are created in the same way.
							<br></br>
							Let's stay in the contactus.php page (in views/home/). As you can see, there are a few basic step needed to create a form:
				    		<ol class="list-docs">
				  				<li>Get an instance of the form helper</li>
				  				<li>Call the <code>create()</code> method to set the form properties</li>
				  				<li>Open the form by callling the <code>open()</code> method</li>
				  				<li>Start adding elements to your form. You can add several different elements such as labels, textboxes, drop-downs, etc.</li>
				  				<li>Close the form by calling the <code>close()</code> method</li>
							</ol>
					    </p>
						<pre>
<?php
	echo Methods\CodeHighlighterMethods::highlightText(
		"<?php\n" .
		"	//get an instance of the form helper\n" .
		"	\$form = \$this->form();\n\n" .
		"	//call the create()-method to set the form properties\n" .
		"	\$form->create(array(\n" .
		"		'method' => 'post',\n" .
		"		'name' => 'formContactUs',\n" .
		"		'id' => 'formContactUs',\n" .
		"		'role' => 'form',\n" .
		"		'novalidate' => false\n" .
		"	));\n\n" .
		"	//open the form for adding input controls\n" .
		"	\$form->open();\n\n" .
		"	//start adding elements to your form. You can add several different elements such as labels, textboxes, drop-downs, etc.\n" .
		"	//...\n\n" .
		"	//close the form\n" .
		"	\$form->close();\n" .
		"?>");
?>
						</pre>
					</section><!-- creatingForms -->
					
					<section class="body-section" id="validatingForms"><!-- validatingForms -->
	  					<div class="page-header-doc"><!-- page-header-doc -->
					      	<h4>Validating forms</h4>
					    </div><!-- page-header-doc -->
					    <p class="text-justify">
					    	We are still sticking to the <code>contactUs.php</code> page (in views/home/). Have a loook into the <code>contactUs()</code> 
					    	method in the <code>application/controllers/Home.php</code>. The advantage of the form validation helper library is that you
							can define a set of rules and apply them to different elements in different pages.
							<br></br>
							To use them, follow these simple steps:
				    		<ol class="list-docs">
				  				<li>Get an instance of the form validation helper library</li>
				  				<li>Always check that the form was submitted before validating the form elements' values</li>
				  				<li>Set all the rules for each form element</li>
				  				<li>Call the <code>run()</code> method to validate each form element data</li>
							</ol>
					    </p>
						<pre>
<?php
	echo Methods\CodeHighlighterMethods::highlightText(
		"<?php\n" .
		"	// check that the form was submitted before validating the form elements' values\n" .
		"	if (isset(\$_POST['btnContactUs'])) {\n" .
		"		\$validator = \$this->formValidations();\n\n" .
		"		// set all the form rules\n" .
		"		\$validator->setRule('subject', 'Subject', 'required|minLength[5]|maxLength[45]', array(\n" .
		"			'required' => 'Please specify a subject',\n" .
		"			'minLength' => 'Subject must be at least 5 characters',\n" .
		"			'maxLength' => 'Subject cannot be longer then 45 characters'\n" .
		"		));\n" .
		"		\$validator->setRule('name', 'Name', 'required|minLength[5]|maxLength[45]', array(\n" .
		"			'required' => 'Please specify your name',\n" .
		"			'minLength' => 'Name must be at least 5 characters',\n" .
		"			'maxLength' => 'Name cannot be longer then 45 characters'\n" .
		"		));\n" .
		"		\$validator->setRule('email', 'E-mail', 'required|email|maxLength[45]', array(\n" .
		"			'required' => 'Please specify your e-mail address',\n" .
		"			'email' => 'Correo electrónico no válido',\n" .
		"			'maxLength' => 'E-mail cannot be longer then 45 characters'\n" .
		"		));\n" .
		"		\$validator->setRule('message', 'Message', 'required|minLength[5]|maxLength[255]', array(\n" .
		"			'required' => 'Please specify your doubt, message or question',\n" .
		"			'minLength' => 'Message must be at least 5 characters',\n" .
		"			'maxLength' => 'Message cannot be longer then 255 characters'\n" .
		"		));\n\n" .
		"		// do the validation\n" .
		"		if(\$validator->run('btnContactUs', 'contactUs') === false) {\n" .
		"			//do some confirmation\n" .
		"		}\n" .
		"	}\n" .
		"?>");
?>
						</pre>
					</section><!-- validatingForms -->