    <!-- Begin page content -->
    <div class="container">
      <div class="page-header">
        <h1>Add Songs</h1>
      </div>
      <p>Donec sed odio dui. Etiam porta sem malesuada magna mollis euismod. Nullam id dolor id nibh ultricies vehicula ut id elit. Morbi leo risus, porta ac consectetur ac, vestibulum at eros. Praesent commodo cursus magna.</p>
	  	<br></br>
<?php 
require APP . 'view/_templates/alerts.php';
$errors = array();

$form = $this->form();

// do the form validation
if(isset($validator)) {
	if($validator->run('btnAddSong', 'addSong') === true)
		$errors = $validator->getErrors();
}

$form->create(array(
		'method' => 'post',
		'id' => 'formAddSong',
		'role' => 'form'
));

$form->open();
?>
			<div class="form-group has-feedback <?php echo array_key_exists('artist', $errors) ? 'has-error' : '' ?>">
				<div class="form-group">
<?php
$form->formLabel(array(
		'for' => 'artist',
		'text' => 'Artist'
));

$form->formTextbox(array(
		'id' => 'artist',
		'name' => 'artist',
		'placeholder' => 'Artist',
		'classes' => 'form-control input-controls',
		'value' => $this->getFormData('artist')
)); 

if(array_key_exists('artist', $errors))
	$validator->renderFeedbackBlockBootstrapV3($errors['artist'], 'error');
?>
				</div>
			</div>
			<div class="form-group has-feedback <?php echo array_key_exists('track', $errors) ? 'has-error' : '' ?>">
				<div class="form-group">
<?php
$form->formLabel(array(
		'for' => 'track',
		'text' => 'Track'
));

$form->formTextbox(array(
		'id' => 'track',
		'name' => 'track',
		'placeholder' => 'Track',
		'classes' => 'form-control input-controls',
		'value' => $this->getFormData('track')
)); 

if(array_key_exists('track', $errors))
	$validator->renderFeedbackBlockBootstrapV3($errors['track'], 'error');
?>
				</div>
			</div>
			<div class="form-group has-feedback <?php echo array_key_exists('link', $errors) ? 'has-error' : '' ?>">
				<div class="form-group">
<?php
$form->formLabel(array(
		'for' => 'link',
		'text' => 'Link'
));

$form->formTextbox(array(
		'id' => 'link',
		'name' => 'link',
		'placeholder' => 'Link',
		'classes' => 'form-control input-controls',
		'value' => $this->getFormData('link')
)); 

if(array_key_exists('link', $errors))
	$validator->renderFeedbackBlockBootstrapV3($errors['link'], 'error');
?>
				</div>
			</div>
			<div class="form-group text-center">
<?php
$form->formButton(array(
		'id' => 'btnAddSong',
		'name' => 'btnAddSong',
		'value' => 'addSong',
		'classes' => 'btn btn-primary btn-lg text-center',
		'text' => 'Add song'
));
?>
			</div>
<?php
$form->close();
?>
		<br></br>
    </div>
