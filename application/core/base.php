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
namespace Application\Core;

class Base {
	
	/**
	 * Gets the class's methods
	 * @param object $class	- the class which the methods will be retreived
	 * @return an associative array with all the class's methods. the keys are all lower case
	 **/
	protected function getClassMethods($class = null) {
		if(is_null($class))
			throw new Exception('Cannot get class methods. No class was specified.');
		
		$available = get_class_methods($class);
		$methodsReference = array();
		foreach($available as $method)
			$methodsReference[strtolower($method)] = $method;
		
		return $methodsReference;
	}
	
	/**
	 * Gets the class's properties
	 * @param object $class	- the class which the properties will be retreived
	 * @return an associative array with all the class's properties. the keys are all lower case
	 **/
	protected function getClassProperties($class = null) {
		if(is_null($class))
			throw new Exception('Cannot get class properties. No class was specified.');
		
		/**
		 * The property_reference lookup array is created so that properties can be set case-insensitively.
		 **/
		$available = array_keys(get_class_vars($class));
		$propertyReference = array();
		foreach($available as $property)
			$propertyReference[strtolower($property)] = $property;
		return $propertyReference;
	}
 	
 	/**
 	 * Gets the form data depending on the request method
 	 * @return an associative array with the submitted form data or null
 	 **/
 	protected function getFormDataArray() {
 		if ($_SERVER['REQUEST_METHOD'] === 'POST')
 			return $_POST;
 		elseif ($_SERVER['REQUEST_METHOD'] === 'GET')
 			return $_GET;
 		else
 			return null;
 	}
 	
 	/**
 	 * Gets the value of the submitted field
 	 * @param string $field	- the name of the submitted data
 	 * @return the value of the field or null
 	 **/
 	protected function getFormData($field = null) {
 		if(is_null($field)) 
 			throw new Exception\Argument("Invalid argument: field cannot be null");
 		
 		$dataArray = $this->getFormDataArray();
 		
 		if(is_null($dataArray))
 			return null;
 		
 		if(isset($dataArray[$field]))
 			return $dataArray[$field];
 		
 		return null;
 	}
 	
 	/**
 	 * Unsets the form data
 	 **/
 	protected function clearFormData() {
 		if ($_SERVER['REQUEST_METHOD'] === 'POST') {
 			unset($_POST);
 			$_POST = array();
 		} elseif ($_SERVER['REQUEST_METHOD'] === 'GET') {
 			unset($_GET);
 			$_GET = array();
 		}
 	}
}