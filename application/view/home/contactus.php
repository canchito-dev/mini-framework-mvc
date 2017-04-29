    <!-- Begin page content -->
    <div class="container">
	  <div class="page-header">
	    <h1>Contact us</h1>
	  </div>
	  <p>Whether you’re looking for answers, would like to solve a problem, or just want to let us know how we did, you’ll find many ways to contact us right here.</p>
	  <br></br>
<?php require APP . 'view/_templates/alerts.php'; ?>
      <div class="row">
		<div class="col-xs-12 col-md-6">
<?php
$errors = array();
$form = $this->form();

// do the form validation
if(isset($validator)) {
	if($validator->run('btnContactUs', 'contactUs') === true)
		$errors = $validator->getErrors();
}

$form->create(array(
		'method' => 'post',
		'name' => 'formContactUs',
		'id' => 'formContactUs',
		'role' => 'form',
		'novalidate' => false
));

$form->open();
?>
								<div class="form-group has-feedback <?php echo array_key_exists('subject', $errors) ? 'has-error' : '' ?>">
<?php
$form->formLabel(array(
		'for' => 'subject',
		'text' => 'Subject'
));

$form->formTextbox(array(
		'id' => 'subject',
		'name' => 'subject',
		'placeholder' => 'Subject',
		'classes' => 'form-control input-controls',
		'value' => $this->getFormData('subject')
)); 

if(array_key_exists('subject', $errors))
	$validator->renderFeedbackBlockBootstrapV3($errors['subject'], 'error');
?>
								</div>
								<div class="form-group has-feedback <?php echo array_key_exists('name', $errors) ? 'has-error' : '' ?>">
<?php
$form->formLabel(array(
		'for' => 'name',
		'text' => 'Name'
));

$form->formTextbox(array(
		'id' => 'name',
		'name' => 'name',
		'placeholder' => 'Name',
		'classes' => 'form-control input-controls',
		'value' => $this->getFormData('name')
)); 

if(array_key_exists('name', $errors))
	$validator->renderFeedbackBlockBootstrapV3($errors['name'], 'error');
?>
								</div>
								<div class="form-group has-feedback <?php echo array_key_exists('email', $errors) ? 'has-error' : '' ?>">
<?php
$form->formLabel(array(
		'for' => 'email',
		'text' => 'E-mail'
));

$form->formMail(array(
		'id' => 'email',
		'name' => 'email',
		'placeholder' => 'E-mail',
		'classes' => 'form-control input-controls',
		'value' => $this->getFormData('email')
)); 

if(array_key_exists('email', $errors))
	$validator->renderFeedbackBlockBootstrapV3($errors['email'], 'error');
?>
								</div>
								<div class="form-group has-feedback <?php echo array_key_exists('message', $errors) ? 'has-error' : '' ?>">
<?php
$form->formLabel(array(
		'for' => 'message',
		'text' => 'Message'
));

$form->formTextarea(array(
		'id' => 'message',
		'name' => 'message',
		'placeholder' => 'Message',
		'classes' => 'form-control input-controls',
		'rows' => '5',
		'value' => $this->getFormData('message')
));

if(array_key_exists('message', $errors))
	$validator->renderFeedbackBlockBootstrapV3($errors['message'], 'error');
?>
								</div>
								 <div class="form-group text-center">
<?php
$form->formButton(array(
		'id' => 'btnContactUs',
		'name' => 'btnContactUs',
		'classes' => 'btn btn-primary btn-lg text-center',
		'value' => 'contactUs',
		'text' => 'Send'
));
?>
								 </div>
<?php    	
$form->close();
?>
	  	</div> <!-- close col-xs-12 col-md-6 -->
	  		
	  	<div class="col-xs-12 col-md-6">
	  		<address>
	  		  <span class="text-default"><i class="fa fa-map-pin fa-fw"></i>&nbsp;<strong>MINI-FRAMEWORK MVC, Inc.</strong></span><br>
			  1355 Market Street, Suite 900<br>
			  San Francisco, CA 94103<br>
			</address>
			
			<address>
			  <span class="text-default"><i class="fa fa-phone fa-fw"></i>&nbsp;<strong>Phone</strong></span><br>
			  (123) 456-7890<br>
			</address>
			
			<address>
			  <span class="text-default"><i class="fa fa-envelope fa-fw"></i>&nbsp;<strong>Email</strong></span><br>
			  <a href="mailto:#">mini.framework.mvc@gmail.com</a>
			</address>
			
			<address>
			  <span class="text-default"><i class="fa fa-facebook-square fa-fw"></i>&nbsp;<strong>Facebook</strong></span><br>
			  <a href="#">http://www.facebook.com/mini.framework.mvc</a>
			</address>
			
			<address>
			  <span class="text-default"><i class="fa fa-twitter-square fa-fw"></i>&nbsp;<strong>Twitter</strong></span><br>
			  <a href="#">http://www.twitter.com/mini.framework.mvc</a>
			</address>
	  	</div> <!-- close col-xs-12 col-md-6 -->
	  </div> <!-- close row -->
	  <br>
    </div>