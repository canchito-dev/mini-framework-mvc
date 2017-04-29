<?php $isLoggedIn = $this->session()->getVariable('IS_LOGGED_IN'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="MINI-FRAMEWORK-MVC is an extremely simple and easy to understand PHP framework. MINI-FRAMEWORK-MVC is NOT a professional framework. As a result, it does not come with all the features and functionalities that real frameworks have. It is limited to a very reduce number of helper libraries.">
    <meta name="keywords" content="open-source projects, HTML, CSS, Bootstrap, jQuery, JavaScript, Java, PHP, framework">
    <meta name="author" content="José Carlos Mendoza Prego www.linkedin.com/in/jcmendozaprego - www.canchito-dev.com">
    <meta name="robots" content="all"/>
    <link rel="canonical" href="" />
    <link rel="icon" href="../../favicon.ico">
    
    <title><?php echo SITE_TITLE; ?></title>

    <!-- JS -->
    <!-- please note: The JavaScript files are loaded in the footer to speed up page construction -->
    <!-- See more here: http://stackoverflow.com/q/2105327/1114320 -->
    
    <!-- ================================================== Bootstrap: Latest compiled and minified CSS ================================================== -->
	<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <!-- ================================================== font-awesome: Latest compiled and minified CSS ================================================== -->
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- ================================================== bootstrap-datepicker ================================================== -->
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/css/bootstrap-datepicker.css">
	<!-- ================================================== Material Design Bootstrap v3.4.1  ================================================== -->
	<link rel="stylesheet" type="text/css" href="<?php echo URL; ?>css/mdb-v3.4.1/mdb.css">

    <!-- CSS -->
    <link rel="stylesheet" type="text/css" href="<?php echo URL; ?>css/style.css" >
    <script>
	  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
	  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
	  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
	  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');
	
	  ga('create', 'UA-89110199-1', 'auto');
	  ga('send', 'pageview');
	</script>
</head>
<body>