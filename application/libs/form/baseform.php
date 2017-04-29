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

class BaseForm extends Core\Base {
	
	const GET_HTML = 'gethtml';
	
	private $_attributes;
	
	protected $dataAttr;
	
	protected function create($attributes = array())  {
		if(!empty($attributes))
			$this->setAttributes($attributes);
	}
	
	protected function setAttributes($attributes = null) {
		$this->_attributes = $attributes;
	}
	protected function getAttributes() {
		return $this->_attributes;
	}
	
	protected function setData($dataAttr = null) {
		$this->dataAttr = $dataAttr;
	}
	protected function getData() {
		return $this->dataAttr;
	}
	protected function getHtmlData() {
		$data = '';
		
		if(is_null($this->dataAttr))
			return '';
		
		if(is_array($this->dataAttr)) {
			foreach ($this->dataAttr as $key => $value) {
				$data .= $key . '="' . $value . '" ';
			}
		}
		
		if(is_string($this->dataAttr))
			return $this->dataAttr;
	}
	
	/**
	 * Sets all the attributes values of the form or its elements
	 **/
	protected function configure() {
		$attributes = $this->getAttributes();
		if(!empty($attributes)) {
			/**
			 * The method reference lookup array is created so that "set" methods can be called case-insensitively. 
			 **/
			$methods = $this->getClassMethods(get_class($this));
			$properties = $this->getClassProperties(get_class($this));

			foreach($attributes as $attribute => $value) {
				$attribute = strtolower($attribute);
				/** 
				 * Properties beginning with "_" cannot be set directly.
				 **/
				if($attribute[0] != "_") {
					/**
					 * If the appropriate class has a "set" method for the property provided, then it is called instead or setting the property directly.
					 **/
					if(isset($methods["set" . $attribute]))
						$this->{$methods["set" . $attribute]}($value);
					elseif(isset($properties[$attribute]))
						$this->$properties[$attribute] = $value;
				}
			}
		}
	}
	
	/**
	 * This method is used by the Form class and all Element classes to return a string of html attributes.
	 * There is an ignore parameter that allows special attributes from being included.
	 **/
	protected function renderAttributes() {
		$methods = $this->getClassMethods(get_class($this));
		$attributes = array_keys($this->getAttributes());
		foreach($attributes as $attribute) {
			$attribute = strtolower($attribute);
			/**
			 * Properties beginning with "_" cannot be getted.
			 **/
			if($attribute[0] != "_") {
				if(isset($methods[self::GET_HTML . $attribute])) {
					if($this->{$methods[self::GET_HTML . $attribute]}() != null) 
						echo $this->{$methods[self::GET_HTML . $attribute]}() . ' ';
				}
			}
		}
	}
	
	/**
	 * Many of the included elements make use of the <input> tag for display.  These include the Hidden, Textbox,
	 * Password, Date, Color, Button, Email, and File element classes.  The project's other element classes will
	 * override this method with their own implementation.
	 **/
	protected function render() {
		// render the input control
		echo '<input ';
		$this->renderAttributes();
		echo '>';
	}
}