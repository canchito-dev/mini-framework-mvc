# MINI-FRAMEWORK-MVC

MINI-FRAMEWORK-MVC is an extremely simple and easy to understand PHP framework based on project [MINI3](https://github.com/panique/mini3).
MINI-FRAMEWORK-MVC is NOT a professional framework. As a result, it does not come with all the features and functionalities that real 
frameworks have. It is limited to a very reduce number of helper libraries.

This project can be suitable to anybody who just wants to show some pages, make some database calls, implement sessions, validate forms, 
and do some AJAX calls here and there, without the need of reading a lot of documentation of those more advance, complex and professional 
frameworks. MINI-FRAMEWORK-MVC is easy to install, runs nearly everywhere and doesn't make things more complicated than necessary.

For a deeper introduction into MINI-FRAMEWORK-MVC base project [MINI3](https://github.com/panique/mini3), have a look into this blog post:
[MINI, an extremely simple barebone PHP application](http://www.dev-metal.com/mini-extremely-simple-barebone-php-application/).

I really hope this small "framework" can be useful as [MINI3](https://github.com/panique/mini3) has been to me. If you would like to have a 
look into our other projects, please visit us at [Canchito-Dev](http://www.canchito-dev.com).

## Features

- Extremely simple, easy to understand
- Simple but clean structure
- Makes "beautiful" clean URLs
- Integrated with [Boostrap v3 and v4.0.0-alpha.6](http://getbootstrap.com/)
- Easy to use database library, which uses PDO for any database requests, comes with an additional PDO debug tool to emulate your SQL statements
- Easy to use form library for creating and validating form
- Easy to use e-mail library for sending mails
- Easy to use session library for hadling sessions
- Easy to use library for generation pagination
- Easy to use file upload library
- Easy to use image manipulation library
- Demo CRUD actions: Create, Read, Update and Delete database entries easily using the build-in database library
- Demo form actions: Create and validate form using the build-in form library
- Demo session actions: handle sessions using the build-in form library
- Demo mail action: send an e-mail using the build-in e-mail library based on [PHPMailer](https://github.com/PHPMailer/PHPMailer)
- Tries to follow PSR 1/2 coding guidelines
- Commented code
- Uses only native PHP code, so people don't have to learn a framework

## Requirements

You need a standard Web server with at least:

- PHP 5.3.0+
- MySQL
- mod_rewrite activated
- basic knowledge of Composer

For your development environment, I usually use [WAMPServer](http://www.wampserver.com/en/), which is a Windows web development 
environment, and stands for Windows, Apache, MySQL and PHP.

Now, Composer is a very simple and easy to use dependency manager for PHP. It allows you to declare the libraries your project  depends on 
and it will manage (install/update) them for you. You can download the Windows installer from their official [site](https://getcomposer.org/download/). 

## Installation

Just follow these steps:

1. Edit the database credentials in `application/config/config.php`
2. Execute the .sql statements in the `_install/`- folder (with PHPMyAdmin for example).
3. Make sure you have mod_rewrite activated on your server / in your environment.
4. Install composer and run `composer install` in the project's folder to download the dependencies and create the autoloading 
   stuff from Composer automatically. For those who are not familiar with Composer, just remember back in the days, when you were 
   using a PHP files with all the includes you needed. Well, Composer creates classes that automatically do this.

MINI-FRAMEWORK-MVC runs without any further configuration. You can also put it inside a sub-folder, it will work without any 
further configuration.

If you want to test the mail library, you have to modify the configuration under `application/config/config.php`.
At the moment, if you have a Gmail account, you should only need to modify the parameters `SMTP_USERNAME` and `SMTP_PWD`
with your own Gmail account and password. If you get errors, you might have to configure your Gmail accout by following 
this easy step:
Head over to Account Security Settings (https://www.google.com/settings/security/lesssecureapps) and enable "Access for less 
secure apps", this allows you to use Google's SMTP for clients other than the official ones.

## Security

In order to limit the access to only the /public folder, we use mod_rewrite. These will keep other folder such as the /application
folder save from unwanted visitors. To do so, we have created the `.htaccess` file. This file alters how Apache web server treats
a directory and its contents. To achive this, we have to follow a specific syntax.

## Goodies

Inherited from [MINI3](https://github.com/panique/mini3), MINI-FRAMEWORK-MVC comes with a little customized 
[PDO debugger tool](https://github.com/panique/pdo-debug) (find the code in application/libs/helper.php), trying to 
emulate your PDO-SQL statements. It's extremely easy to use:

```php
$sql = "SELECT id, artist, track, link FROM song WHERE id = :song_id LIMIT 1";
$query = $this->db->prepare($sql);
$parameters = array(':song_id' => $song_id);

echo Helper::debugPDO($sql, $parameters);

$query->execute($parameters);
```

## License - The MIT License (MIT)

Copyright (c) 2016, canchito-dev

Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated documentation files 
(the “Software”), to deal in the Software without restriction, including without limitation the rights to use, copy, modify, merge, 
publish, distribute, sublicense, and/or sell copies of the Software, and to permit persons to whom the Software is furnished to do 
so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED “AS IS”, WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF 
MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE 
FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION 
WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.

## Quick-Start

#### The structure in general

After you’ve downloaded and extracted the application, these are the files and folders you should see:

- `_instal`: has the SQL files for creating the database demo data
- `application`: contains the application you' re creating. Basically, it holds your models, views, controllers, and other code 
  (like helpers and class extensions). In other words, this is the folder where you do your magic
	- `config`: holds the configuration file that <strong>MINI-FRAMEWORK-MVS</strong> uses
	- `controller`: in this folder you will place your class files developed for your application
	- `core`: place your base class files of your application
	- `libs`: place your own developed libraries useful for your application
	- `model`: data base fetching logic in
	- `view`: most of your work will be in this folder, you will place your html template files
- `public`: public document root of your application. It contains all the files you want to be publically reachable
- `vendor`: application dependencies are installed
- .htaccess
- composer.json
- README.md

Whenever there is an URL request, the application will automatically translate the URL-path to the appropiate controllers and their 
methods inside. Take a look at the following examples:
`http://localhost/mini-master/home/index` will call the *index()* method in application/controllers/Home.php.

`http://localhost/mini-master/home/news` will execute the *news()* method in application/controllers/Home.php.

The following links are only visible for logged in users.
`http://localhost/mini-master/songs/add` will call the *add()* method in application/controllers/Songs.php.

`http://localhost/mini-master/songs/listofsongs` will do what the *listOfSongs()* method in application/controllers/Songs.php says.

`http://localhost/mini-master/songs/editsong/28` will execute the *editSong()* method in application/controllers/Songs.php and will 
pass `28` as a parameter to it.

#### Showing a view

Let's look at the *documentation()* method in application/controllers/Home.php: This simply shows the header, navbar, footer 
and the documentation.php page (in views/home/). If you need to do something like preparing data, you can add the needed code
before loading the views.

```php
public function documentation() {
	// load views
	require APP . 'view/_templates/header.php';
	require APP . 'view/_templates/nav.header.php';
	require APP . 'view/home/documentation.php';
	require APP . 'view/_templates/footer.php';
}
```  

#### Working with data

Let's look into the *listOfSongs()* method in the application/controllers/Songs.php: Similar to documentation, but here we also 
request data. Again, everything is extremely reduced and simple: $this->model->getAllSongs() simply calls the *getAllSongs()* 
method in application/model/model.php.

```php
public function listOfSongs() {
	$this->loadModel('Songs');
	$songs = $this->model->getAllSongs();
	// load views. within the views we can echo out $songs
	require APP . 'view/_templates/header.php';
	require APP . 'view/_templates/nav.header.php';
	require APP . 'view/songs/listofsongs.php';
	require APP . 'view/_templates/footer.php';
}
```

The data-handling method for retreiving the list of songs from the database are in application/model/Songs.php. Have a 
look how *getAllSongs()* in Songs.php looks like.

```php
public function getAllSongs() {
	// get a database instance
	$db = Database\Database::getInstance();
	//connect to database
	$db = $db->connect();
	$all = $db->query()
    	->from('songs', array(
    			'id',
    			'artist',
    			'track',
    			'link'
    	))
    	->order('id', 'desc')
		->all();
	//disconnect from database
	$db->disconnect();
	return $all;
}
```

The result, here $songs, can then easily be used directly inside the view files (in this case application/views/songs/listofsongs.php, 
in a simplified example):

```php
<table class="table table-striped table-bordered table-hover table-condensed">
    <thead>
        <tr>
            <th class="text-center">Id</th>
            <th class="text-center">Artist</th>
            <th class="text-center">Track</th>
            <th class="text-center">Link</th>
            <th class="text-center"></th>
        </tr>
    </thead>
    <tbody>
    	<?php foreach ($songs as $song) { ?>
        <tr>
            <td><?php if (isset($song['id'])) echo htmlspecialchars($song['id'], ENT_QUOTES, CHARSET); ?></td>
            <td><?php if (isset($song['artist'])) echo htmlspecialchars($song['artist'], ENT_QUOTES, CHARSET); ?></td>
            <td><?php if (isset($song['track'])) echo htmlspecialchars($song['track'], ENT_QUOTES, CHARSET); ?></td>
            <td>
                <?php if (isset($song['link'])) { ?>
                    <a href="<?php echo htmlspecialchars($song['link'], ENT_QUOTES, CHARSET); ?>"><?php echo htmlspecialchars($song['link'], ENT_QUOTES, CHARSET); ?></a>
                <?php } ?>
            </td>
            <td>
            	<div class="btn-toolbar" role="toolbar">
				  <div class="btn-group btn-group-xs" role="group">
				  	<a class="btn btn-default" href="<?php echo URL . 'songs/deletesong/' . htmlspecialchars($song['id'], ENT_QUOTES, CHARSET); ?>" role="button" title="Delete">
				  		<span class="glyphicon glyphicon glyphicon-remove" aria-hidden="true"></span>
				  	</a>
				  	<a class="btn btn-default" href="<?php echo URL . 'songs/editsong/' . htmlspecialchars($song['id'], ENT_QUOTES, CHARSET); ?>" role="button" title="Edit">
				  		<span class="glyphicon glyphicon glyphicon-pencil" aria-hidden="true"></span>
				  	</a>
				  </div>
				</div>
            </td>
        </tr>
    	<?php } ?>
    </tbody>
</table>
```

#### Sending mail

For the emailing library, I have extended [PHPMailer] (https://github.com/PHPMailer/PHPMailer/). This was done for 
simplicity. I just created the basic functions needed, added extra validations and called  [PHPMailer] (https://github.com/PHPMailer/PHPMailer/) 
functions afterwards. 

Sending an e-mail is quite easy and straight forward. Let's look into the *contactUs()* method in application/controllers/Home.php. 
Simply specify a sender, add recipients, type a subject, and a body, and finally call the *sendMail()* menthod.

```php
$mailer = $this->emailer();
$mailer->from(SMTP_USERNAME, 'MINI-FRAMEWORK-MVC');
$mailer->addRecipient(SMTP_USERNAME, 'MINI-FRAMEWORK-MVC');
$mailer->subject('This is a test');
$mailer->replyTo('no-reply@miniframework.com', 'MINI-FRAMEWORK-MVC no-reply');
$mailer->htmlBody(file_get_contents(APP . '\view\_templates\_mail\contents.html'), APP . '\view\_templates\_mail');
$mailer->sendMail();
```

#### Creating forms

Create forms with a base URL built from your config preferences. The main benefit of using this helper library rather 
than hard coding your own HTML, is that it permits your site to be more portable in the event your URLs ever change, 
and also, you will for sure know that all your forms are created in the same way.

Let's stay in the contactus.php page (in views/home/). As you can see, there are a few basic step needed to create a form:
1) Get an instance of the form helper
2) Call the *create()* method to set the form properties
3) Open the form by callling the *open()* method
4) Start adding elements to your form. You can add several different elements such as labels, textboxes, drop-downs, etc.
5) Close the form by calling the *close()* method

```php
<?php
//get an instance of the form helper
$form = $this->form();

//call the create()-method to set the form properties
$form->create(array(
		'method' => 'post',
		'name' => 'formContactUs',
		'id' => 'formContactUs',
		'role' => 'form',
		'novalidate' => false
));

//open the form for adding input controls
$form->open();

//start adding elements to your form. You can add several different elements such as labels, textboxes, drop-downs, etc.
//..
    
close the form	
$form->close();
?>
```

#### Validating forms

We are still sticking to the contactUs.php page (in views/home/). Have a loook into the contactUs()-method in the 
home-controller (application/controllers/Home.php). The advantage of the form validation helper library is that you
can define a set of rules and apply them to different elements in different pages.

To use them, follow these simple steps:
1) Get an instance of the form validation helper library
2) Always check that the form was submitted before validating the form elements' values
3) Set all the rules for each form element
4) Call the run()-method to validate each form element data

```php
// check that the form was submitted before validating the form elements' values
if (isset($_POST["btnContactUs"])) {
	$validator = $this->formValidations();
	// set all the form rules
	$validator->setRule('subject', 'Subject', 'required|minLength[5]|maxLength[45]', array(
			'required' => 'Please specify a subject',
			'minLength' => 'Subject must be at least 5 characters',
			'maxLength' => 'Subject cannot be longer then 45 characters'
	));
	$validator->setRule('name', 'Name', 'required|minLength[5]|maxLength[45]', array(
			'required' => 'Please specify your name',
			'minLength' => 'Name must be at least 5 characters',
			'maxLength' => 'Name cannot be longer then 45 characters'
	));
	$validator->setRule('email', 'E-mail', 'required|email|maxLength[45]', array(
			'required' => 'Please specify your e-mail address',
			'email' => 'Correo electrónico no válido',
			'maxLength' => 'E-mail cannot be longer then 45 characters'
	));
	$validator->setRule('message', 'Message', 'required|minLength[5]|maxLength[255]', array(
			'required' => 'Please specify your doubt, message or question',
			'minLength' => 'Message must be at least 5 characters',
			'maxLength' => 'Message cannot be longer then 255 characters'
	));
	// do the validation
	if($validator->run('btnContactUs', 'contactUs') === false) {
		//do some confirmation
		$this->clearFormData();	
	}
}
```

## History

MINI-FRAMEWORK-MVC started as an idea and a challenge. I am not exactly a professional PHP programmer, but I had the basic knowledge. 
However, I wanted to improve and learn in dept how a MVC framework was build. So, I bought the book "Pro PHP MVC" by Chris Pitt, 
and read it during my free time. In this book, I got the chance to get to know current most popular professional MVC frameworks. And at 
the same time, the book explains how to build from scratch classes that are useful for a MVC Framework.

To complement the book, I also took the Udemy course [Learn PHP Model View Controller Pattern (PHP MVC)](https://www.udemy.com/learn-php-model-view-controller-pattern-php-mvc/learn/v4/overview).
It was in this course where I understood how to join the different classes need in a framework and got to know [MINI3](https://github.com/panique/mini3).

After reading the book and finishing the course, I though myself it would be a good idea to combine some of the lessons learnt from both 
and implement them in [MINI3](https://github.com/panique/mini3). But I did not want to build everything from scratch. And that is why, some 
of the libraries are just implementations of already existing ones, whereas some are adaptations of snippets of code, and some others are 
fully developed by me.

## Dear haters, trolls and everything-sucks-people...

This project started as a way of helping me understand and learn about MVC design pattern. But it grew up to include some other libraries
that have been helpful to me. It might not fully follow MVC principles or not perfectly coded, but it was developed with all the good
intensions at heart. I also like what our good friend from [MINI3](https://github.com/panique/mini3) said. So I will just quote him:

"... MINI is just a simple helper-tool I've created for my daily work, simply because it was much easier to setup and to
handle than real frameworks. For daily agency work, quick prototyping and frontend-driven projects it's totally okay,
does the job and there's absolutely no reason to discuss why it's "shit compared to Laravel", why it does not follow 
several MVC principles or why there's no personal unpaid support or no russian translation or similar weird stuff. 
The trolling against Open-Source-projects (and their authors) has really reached insane dimensions.

I've written this unpaid, voluntarily, in my free-time and uploaded it on GitHub to share.
It's totally free, for private and commercial use. If you don't like it, don't use it.
If you see issues, then please write a ticket (and if you are really cool: I'm very thankful for any commits!).
But don't bash, don't complain, don't hate. Only bad people do so...."