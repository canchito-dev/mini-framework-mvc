<?php
namespace Application\Libs\Methods;

use Application\Libs\Methods;
?>

    <section class="body-main" id="main"> <!-- section id main --> 
    	<div class="container"><!-- container id main -->

			<div class="row"><!-- start row -->
				<div class="col-md-3"><!-- start col-med-3 -->
					
					<div id="myAffix" class="hidden-xs" data-spy="affix" data-offset-top="70" data-offset-bottom="200"><!-- affix -->
					<div class="panel-group panel-group-menu"><!-- table of content -->
						<div class="panel panel-default"><!-- section welcome -->
							<div class="panel-heading">
								<h4 class="panel-title">
									<a class="bold-700" data-toggle="collapse" href="#collapse0">Welcome</a>
								</h4>
							</div>
							<div id="collapse0" class="panel-collapse collapse">
								<div class="list-group">
									<a href="#introduction" class="list-group-item">Introduction</a>
									<a href="#history" class="list-group-item">History</a>
									<a href="#download" class="list-group-item">Download</a>
									<a href="#license" class="list-group-item">License</a>
									<a href="#haters" class="list-group-item">Dear haters, trolls and everything-sucks-people...</a>
								</div>
							</div>
						</div><!-- section welcome -->
						
						<div class="panel panel-default"><!-- section basic -->
							<div class="panel-heading">
								<h4 class="panel-title">
									<a class="bold-700" data-toggle="collapse" href="#collapse1">The Basics</a>
								</h4>
							</div>
							<div id="collapse1" class="panel-collapse collapse">
								<div class="list-group">
									<a href="#requirements" class="list-group-item">Requirements</a>
									<a href="#installation" class="list-group-item">Installation</a>
									<a href="#security" class="list-group-item">Security</a>
								</div>
							</div>
						</div><!-- section basic -->
						
						<div class="panel panel-default"><!-- section -->
							<div class="panel-heading">
								<h4 class="panel-title">
									<a class="bold-700" data-toggle="collapse" href="#collapse2">Quick Start</a>
								</h4>
							</div>
							<div id="collapse2" class="panel-collapse collapse">
								<div class="list-group">
									<a href="#structure" class="list-group-item">The structure in general</a>
									<a href="#showingView" class="list-group-item">Showing a view</a>
									<a href="#workingWithData" class="list-group-item">Working with data</a>
									<a href="#sendingMail" class="list-group-item">Sending mail</a>
									<a href="#creatingForms" class="list-group-item">Creating forms</a>
									<a href="#validatingForms" class="list-group-item">Validating forms</a>
								</div>
							</div>
						</div><!-- section -->
						
						<div class="panel panel-default"><!-- section -->
							<div class="panel-heading">
								<h4 class="panel-title">
									<a class="bold-700" data-toggle="collapse" href="#collapse3">Libraries</a>
								</h4>
							</div>
							<div id="collapse3" class="panel-collapse collapse">
								<div class="list-group">
									<a href="#databaseLib" class="list-group-item">Database</a>
									<a href="#emailLib" class="list-group-item">Email</a>
									<a href="#fileUploadLib" class="list-group-item">File Upload</a>
									<a href="#formsAndValidationsLib" class="list-group-item">Form and Validations</a>
									<a href="#imageLib" class="list-group-item">Image Manipulation</a>
									<a href="#paginationLib" class="list-group-item">Pagination</a>
									<a href="#sessionLib" class="list-group-item">Session</a>
								</div>
							</div>
						</div><!-- section -->
					</div><!-- table of content -->
					</div><!-- affix -->
				
				</div><!-- end col-med-3 -->
				
  				<div class="col-xs-12 col-md-9"><!-- start col-xs-12 col-md-9 -->
<?php
require APP . 'view/home/doc.welcome.php';
require APP . 'view/home/doc.basics.php';
require APP . 'view/home/doc.quickstart.php';
require APP . 'view/home/doc.database.php';
require APP . 'view/home/doc.email.php';
require APP . 'view/home/doc.upload.php';
require APP . 'view/home/doc.form.php';
require APP . 'view/home/doc.image.php';
require APP . 'view/home/doc.pagination.php';
require APP . 'view/home/doc.session.php';
?>
				</div><!-- end col-xs-12 col-md-9 -->
			</div><!-- end row -->
			
	    </div><!-- container id main -->
    </section><!-- section id main -->