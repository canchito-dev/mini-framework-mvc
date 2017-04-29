<?php
/**
 * This content is released under the MIT License (MIT)
 *
 * Copyright (c) 2016, canchito-dev
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 * 
 * @author 		Jose Carlos Mendoza Prego
 * @copyright	Copyright (c) 2016, canchito-dev (http://www.canchito-dev.com)
 * @license		http://opensource.org/licenses/MIT	MIT License
 * @link		https://github.com/canchito-dev/mini-framework-mvc
 **/
namespace Application\Libs\Form;

use Application\Core;
use Application\Libs\Form\Elements;
 
 /**
  * Programatically create forms with a base URL built from your config preferences. It will optionally let you add 
  * form attributes and hidden input fields, and will always add the accept-charset attribute based on the charset 
  * value in your config file, if not specified.
  * 
  * The main benefit of using this tag rather than hard coding your own HTML is that it permits your site to be 
  * more portable in the event your URLs ever change.
  **/
 class Form extends BaseForm {
 	
 	private static $instance;
 	public $charset;		// Specifies the charset used in the submitted form (default: the page charset).
 	public $action;			// Specifies an address (url) where to submit the form (default: the submitting page).
 	public $autocomplete;	// Specifies if the browser should autocomplete the form (default: on).
 	public $enctype;		// Specifies the encoding of the submitted data (default: is url-encoded).
 	public $method;			// Specifies the HTTP method used when submitting the form (default: GET).
 	public $name;			// Specifies a name used to identify the form (for DOM usage: document.forms.name).
 	public $novalidate;		// Specifies that the browser should not validate the form.
 	public $target;			// Specifies the target of the address in the action attribute (default: _self).
 	public $classes;		// specifies the CSS classes to use
 	public $role;
 	public $elements;		// The imput elements forming the form

 	private function __construct() {}
 	
 	public function __destruct() {}
 	
 	public static function getInstance() {
		if(empty(self::$instance))
			self::$instance = new Form();
		return self::$instance;
	}
 	
	/**
	 * 
	 * @param array $attributes - An associative array of attributes used to configure the form. The key is the property, and 
	 * 							  the value is the value to assign
	 * 		string $charset			- Specifies the charset used in the submitted form (default: the page charset).
	 * 		string $action			- Specifies an address (url) where to submit the form (default: the submitting page).
	 * 		string $autocomplete	- Specifies if the browser should autocomplete the form (default: on).
	 * 		string $enctype			- Specifies the encoding of the submitted data (default: is url-encoded).
	 * 		string $method			- Specifies the HTTP method used when submitting the form (default: GET).
	 * 		string $name			- Specifies a name used to identify the form (for DOM usage: document.forms.name).
	 * 		string $novalidate		- Specifies that the browser should not validate the form.
	 * 		string $target			- Specifies the target of the address in the action attribute (default: _self).
	 * 		string $classes			- Specifies the CSS classes to use
	 * 		string $role			- Specifies the role of the form. Useful for material design frameworks
	 **/
 	public function create($attributes = array())  {
 		parent::create($attributes);
 		$this->configure();
 	}
 	
 	public function setCharset($charset = null) {
 		$this->charset = $charset;
 	}
 	public function getCharset() {
 		return $this->charset;
 	}
 	public function getHtmlCharset() {
 		if ($this->charset == null)
 			$this->charset = CHARSET;
 		return 'accept-charset="' . $this->charset . '"';
 	}
 	
 	public function setAction($action = null) {
 		$this->action = $action;
 	}
 	public function getAction() {
 		return $this->action;
 	}
 	public function getHtmlAction() {
 		return 'action="' . URL . $this->action . '"';
 	}
 	
 	public function setAutocomplete($autocomplete = null) {
 		$this->autocomplete = $autocomplete;
 	}
 	public function getAutocomplete() {
 		return $this->autocomplete;
 	}
 	public function getHtmlAutocomplete() {
 		return 'autocomplete="' . $this->autocomplete . '"';
 	}
 	
 	public function setEnctype($enctype = null) {
 		$this->enctype = $enctype;
 	}
 	public function getEnctype() {
 		return $this->enctype;
 	}
 	public function getHtmlEnctype() {
 		return 'enctype="' . $this->enctype . '"';
 	}
 	
 	public function setMethod($method = null) {
 		$this->method = $method;
 	}
 	public function getMethod() {
 		return $this->method;
 	}
 	public function getHtmlMethod() {
 		return 'method="' . $this->method . '"';
 	}
 	
 	public function setName($name = null) {
 		$this->name = $name;
 	}
 	public function getName() {
 		return $this->name;
 	}
 	public function getHtmlName() {
 		return 'name="' . $this->name . '"';
 	}
 	
 	public function setId($id = null) {
 		$this->id = $id;
 	}
 	public function getId() {
 		return $this->id;
 	}
 	public function getHtmlId() {
 		return 'id="' . $this->id . '"';
 	}
 	
 	public function setNovalidate($novalidate = null) {
 		$this->novalidate = $novalidate;
 	}
 	public function getNovalidate() {
 		return $this->novalidate;
 	}
 	public function getHtmlNovalidate() {
 		return 'novalidate="' . $this->novalidate . '"';
 	}
 	
 	public function setTarget($target = null) {
 		$this->target = $target;
 	}
 	public function getTarget() {
 		return $this->target;
 	}
 	public function getHtmlTarget() {
 		return 'target="' . $this->target . '"';
 	}
 	
 	public function setClasses($classes = null) {
 		$this->classes = $classes;
 	}
 	public function getClasses() {
 		return $this->classes;
 	}
 	public function getHtmlClasses() {
 		return 'class="' . $this->classes . '"';
 	}
 	
 	public function setRole($role = null) {
 		$this->role = $role;
 	}
 	public function getRole() {
 		return $this->role;
 	}
 	public function getHtmlRole() {
 		return 'role="' . $this->role . '"';
 	}
 	
 	/**
 	 * Creates an opening form tag with all the attributes passed from the constructor. The main benefit of 
 	 * using this tag rather than hard coding your own HTML is that it permits your site to be more portable 
 	 * in the event your URLs ever change.
 	 **/
 	public function open() {
 		echo '<form ';
 		$this->renderAttributes();
 		echo '>';
 	}
 	
 	/**
 	 * Produces a closing </form> tag. The only advantage to using this function is it permits you to pass data 
 	 * to it which will be added below the tag.
 	 * @param string $extra – Anything to append after the closing tag, as is
 	 **/
 	public function close($extra = null) {
 		echo '</form>';
 		if($extra != null)
 			echo $extra;
 	}
 	
 	/**
 	 * Renders the input
 	 * @param object $input		- the object to be rendered
 	 * @param array $attributes	- the attribute of the to be rendered object
 	 **/
 	private function renderInput($input, $attributes) {
 		if(!isset($input) || !isset($attributes))
 			throw new Core\Exception('No input object or its attributes specified');
 		
 		$input->create($attributes);
 		$input->render();
 	}
 	
 	/**
 	 * Lets you generate a submit button
 	 * @param array attributes - an associative array with all the attributes that the submit button will have
 	 **/
 	public function formButton($attributes = array()) {
 		$this->renderInput(new Elements\Button(), $attributes);
 	}
 	
 	/**
 	 * Lets you generate a checkbox input fields
 	 * @param array attributes - an associative array with all the attributes that the checkbox field will have
 	 **/
 	public function formCheckbox($attributes = array()) {
 		$this->renderInput(new Elements\Checkbox(), $attributes);
 	}
 	
 	/**
 	 * Lets you generate a datepicker input fields
 	 * @param array attributes - an associative array with all the attributes that the datepicker field will have
 	 **/
 	public function formDatePicker($attributes = array()) {
 		$this->renderInput(new Elements\DatePicker(), $attributes);
 	}
 	
 	/**
 	 * Lets you generate a dropdown select input field
 	 * @param array attributes - an associative array with all the attributes that the select field will have
 	 **/
 	public function formDropDown($attributes = array()) {
 		$this->renderInput(new Elements\DropDown(), $attributes);
 	}
 	
 	/**
 	 * Lets you generate hidden input fields
 	 * @param array attributes - an associative array with all the attributes that the hidden field will have
 	 **/
 	public function formHidden($attributes = array()) {
 		$this->renderInput(new Elements\Hidden(), $attributes);
 	}
 	
 	/**
 	 * Lets you generate a standard label.
 	 * @param array attributes - an associative array with all the attributes that the label will have
 	 **/
 	public function formLabel($attributes = array()) {
 		$this->renderInput(new Elements\Label(), $attributes);
 	}
 	
 	/**
 	 * Lets you generate an email input field
 	 * @param array attributes - an associative array with all the attributes that the email field will have
 	 **/
 	public function formMail($attributes = array()) {
 		$this->renderInput(new Elements\Mail(), $attributes);
 	}
 	
 	/**
 	 * Lets you generate a dropdown list that allows multiple selections
 	 * @param array attributes - an associative array with all the attributes that the select field will have
 	 **/
 	public function formMultiSelect($attributes = array()) {
 		$this->renderInput(new Elements\MultiSelect(), $attributes);
 	}

 	/**
 	 * Define a field for entering a number (You can also set restrictions on what numbers are accepted)
 	 * @param array attributes - an associative array with all the attributes that the password field will have
 	 **/
 	public function formNumber($attributes = array()) {
 		$this->renderInput(new Elements\Number(), $attributes);
 	}
 	
 	/**
 	 * Lets you generate a password input fields
 	 * @param array attributes - an associative array with all the attributes that the password field will have
 	 **/
 	public function formPassword($attributes = array()) {
 		$this->renderInput(new Elements\Password(), $attributes);
 	}
 	
 	/**
 	 * Lets you generate a radio input fields
 	 * @param array attributes - an associative array with all the attributes that the radio field will have
 	 **/
 	public function formRadio($attributes = array()) {
 		$this->renderInput(new Elements\Radio(), $attributes);
 	}
 	
 	/**
 	 * Define a control for entering a number whose exact value is not important (like a slider control).
 	 * You can also set restrictions on what numbers are accepted
 	 * @param array attributes - an associative array with all the attributes that the password field will have
 	 **/
 	public function formRange($attributes = array()) {
 		$this->renderInput(new Elements\Range(), $attributes);
 	}
 	
 	/**
 	 * Lets you generate a textarea input fields
 	 * @param array attributes - an associative array with all the attributes that the textarea field will have
 	 **/
 	public function formTextarea($attributes = array()) {
 		$this->renderInput(new Elements\Textarea(), $attributes);
 	}
 	
 	/**
 	 * Lets you generate a standard text input field.
 	 * @param array attributes - an associative array with all the attributes that the textbox will have
 	 **/
 	public function formTextbox($attributes = array()) {
 		$this->renderInput(new Elements\Textbox(), $attributes);
 	}
 	
 	/**
 	 * Lets you generate a standard browser input field. Defines a file-select field and a "Browse..." button (for file uploads)
 	 * @param array attributes - an associative array with all the attributes that the textbox will have
 	 **/
 	public function formUpload($attributes = array()) {
 		$this->renderInput(new Elements\Upload(), $attributes);
 	}
 }