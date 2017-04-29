    <!-- Begin page content -->
    <div class="container">
      <div class="page-header">
        <h1>Sign In</h1>
      </div>
      <p></p>
<?php require APP . 'view/_templates/alerts.php'; ?>
      <div class="row">
		<div class="col-xs-12 col-md-6">
<?php 
$errors = array();

$form = $this->form();

// do the form validation
if(isset($validator)) {
	if($validator->run('btnSignIn', 'signIn') === true)
		$errors = $validator->getErrors();
}

$form->create(array(
		'method' => 'post',
		'id' => 'formSignIn',
		'role' => 'form',
		'novalidate' => false
));

$form->open();
?>
			<div class="form-group has-feedback <?php echo array_key_exists('email', $errors) ? 'has-error' : '' ?>">
<?php
$form->formLabel(array(
		'for' => 'email',
		'text' => 'E-Mail'
));

$form->formMail(array(
		'id' => 'email',
		'name' => 'email',
		'placeholder' => 'E-Mail',
		'classes' => 'form-control input-controls',
		'value' => $this->getFormData('email')
)); 

if(array_key_exists('email', $errors))
	$validator->renderFeedbackBlockBootstrapV3($errors['email'], 'error');
?>
			</div>
			<div class="form-group has-feedback <?php echo array_key_exists('password', $errors) ? 'has-error' : '' ?>">
<?php
$form->formLabel(array(
		'for' => 'password',
		'text' => 'Password'
));

$form->formPassword(array(
		'id' => 'password',
		'name' => 'password',
		'placeholder' => 'Password',
		'classes' => 'form-control input-controls',
		'placement' => 'after',
		'message' => 'Show/hide password',
		'toggle' => true
)); 

if(array_key_exists('password', $errors))
	$validator->renderFeedbackBlockBootstrapV3($errors['password'], 'error');
?>
			</div>
			<div class="form-group text-center">
<?php
$form->formButton(array(
		'id' => 'btnSignIn',
		'name' => 'btnSignIn',
		'value' => 'signIn',
		'classes' => 'btn btn-primary btn-lg text-center',
		'text' => 'Sign In'
));
?>
			</div>
<?php
$form->close();
?>
	  		<br>
		</div>
      </div>
    </div>