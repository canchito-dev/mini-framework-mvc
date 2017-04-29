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
use Application\Libs\Form\Validations;

class Validations extends Core\Base {
	
	private $fieldData;
	private $formErrors;

	public function __construct()  {
		$this->fieldData = array();
		$this->formErrors = array();
	}

	public function __destruct() {}
	
	/**
	 * Returns all the error found in the submitted form
	 * @return 	An associative array with all the fields that were submitted with an incorrect value.
	 * 			The key is the field and the value is an array containing the errors.
	 */
	public function getErrors() {
		return $this->formErrors;
	}
	
	/**
	 * Prints the help text of each input. Only use it if you are using Bootstrap v3
	 * @param mixed $message	- the messages that will be shown
	 * @param string $type		- the type of message. possible values are success, warning or error  
	 **/
	public function renderFeedbackBlockBootstrapV3($message = null, $type = 'success') {
		if(is_null($message))
			throw new Core\Exception('Missing message argument');
		
		switch(strtolower($type)) {
			case 'error':
				$type = 'glyphicon-remove';
				break;
			case 'warning':
				$type = 'glyphicon-warning-sign';
				break;
			case 'success':
			default:
				$type = 'glyphicon-ok';
				break;
		}
		
		if (is_array($message)) {
			foreach ($message as $msg) {
				echo '<span class="help-block">' . $msg . '</span>';
			}
		} elseif (is_string($message))
			echo '<span class="help-block">' . $message . '</span>';
		
		echo '<span class="glyphicon form-control-feedback ' . $type . '" aria-hidden="true"></span>';
		echo '<span id="inputErrorStatus" class="sr-only">(error)</span>';
	}
	
	/**
	 * Prints the help text of each input. Only use it if you are using Bootstrap v4
	 * @param mixed $message	- the messages that will be shown
	 * @param string $type		- the type of message. possible values are success, warning or error  
	 **/
	public function renderFeedbackBlockBootstrapV4($message = null, $type = 'success') {
		if (is_array($message)) {
			foreach ($message as $msg) {
				echo '<small class="form-control-feedback">' . $msg . '</small>';
			}
		} elseif (is_string($message))
			echo '<small class="form-control-feedback">' . $message . '</small>';
	}
	
	/**
	 * This function sets the conditions that a specific form field must fulfil in order to
	 * be valid
	 * @param	string	$field		- the name of the form field to validate
	 * @param	string	$label		- the label to used for displaying the error message in
	 * 								  reference to $field
	 * @param	mixed	$rules		- the conditions that determine if $field is valid or not
	 * 								  it can be a string delimeted by | or an array
	 * @param	array	$errors		- an associative array with the message that must be shown
	 * 								  if the condition is not met
	 **/
	public function setRule($field = '', $label = '', $rules = array(), $errors = array()) {
		$formData = $this->getFormDataArray();
		
		/**
		 * No reason to set rules if we have no POST data
		 **/
		if($formData == null || !isset($formData[$field]))
			return $this;
		
		/**
		 * No fields or no rules? Nothing to do...
		 **/
		if (!is_string($field) || $field === '' || empty($rules))
			return $this;
		
		if(is_string($rules)) {
			$rules = preg_split('/\|(?![^\[]*\])/', $rules); 
		}
		
		/**
		 * If the field label wasn't passed we use the field name
		 **/
		$label = ($label === '') ? $field : $label;
		
		$this->fieldData[$field] = array(
				'field'		=> $field,
				'label'		=> $label,
				'rules'		=> $rules,
				'errors'	=> array_change_key_case($errors, CASE_LOWER),
				'postdata'	=> $formData[$field]
		);
	}
	
	/**
	 * Verifies that the subtmit button and its value are submitted
	 * @param string $button	- the name of the button that will submit the form
	 * @param string $value		- the value that is sent by the submit button
	 * @return boolean			- true if needs to validate, false if not
	 **/
	private function doRun($button = null, $value = null) {
		if(is_null($button) || !is_string($button))
			throw new Core\Exception('Submit button name is missing. Please specify the submit button name related to the form to validate.');
		elseif(is_null($value) || !is_string($value))
			throw new Core\Exception('Submit button value is missing. Please specify the submit button value related to the form to validate.');
		else {
			$formData = $this->getFormDataArray();
				
			/**
			 * No reason to validate if we have no POST data
			 **/
			if($formData == null || !isset($formData[$button]))
				return false;
			
			if($formData[$button] === $value)
				return true;
		}
		return false;
	}
	
	/**
	 * Executes the form validation, but only if the submit button name and value equals to the parameters
	 * @param string $button	- the name of the button that will submit the form
	 * @param string $value		- the value that is sent by the submit button
	 * @return true if it has, false if it does not 
	 **/
	public function run($button = null, $value = null) {
		$hasErrors = false;		// indicates if the form has errors or not. true if it has, false if it does not
		
		if(!$this->doRun($button, $value))
			return $this;
		
		/**
		 * Nothing to validate if no rules were set
		 **/
		if(empty($this->fieldData) || !isset($this->fieldData))
			return false;
		
		/**
		 * The method reference lookup array is created so that validation methods can be called case-insensitively. 
		 **/
		$methods = $this->getClassMethods(get_class($this));
		
		foreach ($this->fieldData as $field => $data) {
			$foundErrors = array();
			
			/**
			 * lets check if it is required first. if it is required and no value was set than, there is no need to continue validating 
			 **/
			if(in_array('required', $data['rules'])) {
				if(isset($methods['required'])) {
					$validation = $this->{$methods['required']}();
					if(!$validation->isValid($data['postdata'])) {
						/**
						 * if the value is empty but required, we just set the error and move on
						 * to the next field 
						 **/
						$this->formErrors[$field] = array($data['errors']['required']);
						$hasErrors = true;
						continue;
					}
				}
			}
			
			/**
			 * now we validate the next rules
			 **/
			
			foreach ($data['rules'] as $rule) {
				// skip the required validation since we already validated it
				if($rule === 'required')
					continue;
				
				/**
				 * Strip the parameter (if exists) from the rule. Since matches is provided, then it is filled with the results of search. 
				 * $match[0] will contain the text that matched the full pattern, $match[1] will have the text that matched the first 
				 * captured parenthesized subpattern, and so on.
				 **/
				if(preg_match('/(.*?)\[(.*)\]/', $rule, $match)) {
					$rule = strtolower($match[1]);
					$param = $match[2];
				} else {
					$rule = strtolower($rule);
					if (isset($param)) unset($param);
				}
					
				if(isset($methods[$rule])) {
					if(isset($param)) {
						switch ($rule) {
							case 'differs':
							case 'matches':
								/**
								 * just for the matches and differ validations, we need to compare the field value with another field value
								 * which is specified as the validation parameter
								 **/
								$validation = $this->{$methods[$rule]}($this->fieldData[$param]['postdata']);
								break;
							default:
								$validation = $this->{$methods[$rule]}($param);
								break;
						}
					} else
						$validation = $this->{$methods[$rule]}();
					if(!$validation->isValid($data['postdata']))
						$this->formErrors[$field] = $data['errors'][$rule];
				}
			}
			if(!empty($this->formErrors)) {
				$hasErrors = true;
			} 
		}
		
		return $hasErrors;
	}
	
	public static function alphaNumeric() {
		return new Validations\AlphaNumeric();
	}
	
	public static function date() {
		return new Validations\Date();
	}
	
	public static function differs($toCompareWith) {
		return new Validations\Differs($toCompareWith);
	}
	
	public static function email() {
		return new Validations\Email();
	}
	
	public static function greaterOrEqualThan($limit) {
		return new Validations\GreaterOrEqualThan($limit);
	}
	
	public static function greaterThan($limit) {
		return new Validations\GreaterThan($limit);
	}
	
	public static function inList($list) {
		return new Validations\InList($list);
	}
	
	public static function ip() {
		return new Validations\Ip();
	}
	
	public static function lessOrEqualThan($limit) {
		return new Validations\LessOrEqualThan($limit);
	}
	
	public static function lessThan($limit) {
		return new Validations\LessThan($limit);
	}
	
	public static function matches($toCompareWith) {
		return new Validations\Matches($toCompareWith);
	}
		
	public static function maxlength($limit) {
		return new Validations\MaxLength($limit);
	}
	
	public static function minlength($limit) {
		return new Validations\MinLength($limit);
	}
	
	public static function numeric() {
		return new Validations\Numeric();
	}
	
	public static function required() {
		return new Validations\Required();
	}
	
	public static function url() {
		return new Validations\Url();	
	}
}