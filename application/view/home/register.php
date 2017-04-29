    <!-- Begin page content -->
    <div class="container">
      <div class="page-header">
        <h1>Register</h1>
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
	if($validator->run('btnRegister', 'register') === true)
		$errors = $validator->getErrors();
}

$form->create(array(
		'method' => 'post',
		'name' => 'formRegistration',
		'id' => 'formRegistration',
		'role' => 'form',
		'classes' => 'form-horizontal',
		'novalidate' => false
));

$form->open();
?>
								<div class="form-group has-feedback <?php echo array_key_exists('name', $errors) ? 'has-error' : '' ?>">
<?php

$form->formLabel(array(
		'for' => 'name',
		'text' => 'Name(s)'
));

$form->formTextbox(array(
		'id' => 'name',
		'name' => 'name',
		'placeholder' => 'Name(s)',
		'classes' => 'form-control input-controls',
		'value' => $this->getFormData('name')
)); 

if(array_key_exists('name', $errors))
	$validator->renderFeedbackBlockBootstrapV3($errors['name'], 'error');
?>
								</div>
								<div class="form-group has-feedback <?php echo array_key_exists('lastname', $errors) ? 'has-error' : '' ?>">
<?php
$form->formLabel(array(
		'for' => 'lastname',
		'text' => 'Lastname(s)'
));

$form->formTextbox(array(
		'id' => 'lastname',
		'name' => 'lastname',
		'placeholder' => 'Lastname(s)',
		'classes' => 'form-control input-controls',
		'value' => $this->getFormData('lastname')
)); 

if(array_key_exists('lastname', $errors))
	$validator->renderFeedbackBlockBootstrapV3($errors['lastname'], 'error');
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
		'message' => 'Show/Hide password',
		'toggle' => true
)); 

if(array_key_exists('password', $errors))
	$validator->renderFeedbackBlockBootstrapV3($errors['password'], 'error');
?>
								</div>
								<div class="form-group has-feedback <?php echo array_key_exists('confirmPwd', $errors) ? 'has-error' : '' ?>">
<?php
$form->formLabel(array(
		'for' => 'confirmPwd',
		'text' => 'Confirm password'
));

$form->formPassword(array(
		'id' => 'confirmPwd',
		'name' => 'confirmPwd',
		'placeholder' => 'Confirm password',
		'classes' => 'form-control input-controls',
		'placement' => 'after',
		'message' => 'Show/Hide password',
		'toggle' => true
)); 

if(array_key_exists('confirmPwd', $errors))
	$validator->renderFeedbackBlockBootstrapV3($errors['confirmPwd'], 'error');
?>
								</div>
								<div class="form-group has-feedback <?php echo array_key_exists('birthday', $errors) ? 'has-error' : '' ?>">
<?php
$form->formLabel(array(
		'for' => 'birthday',
		'text' => 'Birthday'
));

$form->formDatePicker(array(
		'id' => 'birthday',
		'name' => 'birthday',
		'placeholder' => 'Birthday',
		'classes' => 'form-control input-controls',
		'format' => 'dd/mm/yyyy',
		'clearBtn' => 'true',
		'language' => 'en',
		'todayHighlight' => 'true',
		'orientation' => 'left bottom',
		'forceParse' => 'true',
		'assumeNearbyYear' => '20',
		'value' => $this->getFormData('birthday')
)); 

if(array_key_exists('birthday', $errors))
	$validator->renderFeedbackBlockBootstrapV3($errors['birthday'], 'error');
?>
									<a href="" data-toggle="modal" data-target="#modalWhyBirthday">Why do I have to provide my date of birth?</a>
								</div>
								<div class="form-group text-center">
<?php
$form->formLabel(array(
		'for' => 'gender',
		'classes' => 'sr-only',
		'text' => 'Gender'
));
?>
									<label class="radio-inline">
<?php

$form->formRadio(array(
		'id' => 'gender',
		'name' => 'gender',
		'value' => 'male',
		'text' => 'Male',
		'checked' => true
)); 
?>
									</label>
									<label class="radio-inline">
<?php

$form->formRadio(array(
		'id' => 'gender',
		'name' => 'gender',
		'value' => 'female',
		'text' => 'Female'
)); 
?>
									</label>
								</div>
								<div class="form-group text-center">
 									<p class="text-left">
 										By registering, I accept the <a href="<?php echo URL; ?>home/TermsOfUse">Terms of use</a>, <a href="<?php echo URL; ?>home/TermsOfUse">data collection policies</a>, 
 										including the <a href="<?php echo URL; ?>home/TermsOfUse">use of cookies</a>.
 									</p>
								 </div>
								 <div class="form-group text-center">
<?php
$form->formButton(array(
		'id' => 'btnRegister',
		'name' => 'btnRegister',
		'value' => 'register',
		'classes' => 'btn btn-primary btn-lg text-center',
		'text' => 'Register'
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