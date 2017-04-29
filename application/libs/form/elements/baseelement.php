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
 */
namespace Application\Libs\Form\Elements;

use Application\Libs\Form;
/** 
 * Base class for all the input fields
 *
 * @param array $attributes - an array of attributes used to configure the input field
 *		string $type			- Specifies the type input. By default it is email
 *		string $classes			- Specifies the classes use for styling the input field
 *		string $stye			- Specifies the stye use for styling the input field
 *		string $placeholder		- Specifies a hint that describes the expected value of an input field (a sample value or a short description of the format). The hint is displayed in the 
 *								  input field before the user enters a value. The placeholder attribute works with the following input types: text, search, url, tel, email, and password.
 *		string $id				- Specifies the identification of the input field
 *		string $name			- Specifies the name of the input field
 *		string $value			- Specifies the default value for an input field
 *		boolean $disabled		- The disabled attribute specifies that the input field is disabled. A disabled element is un-usable and un-clickable. Disabled elements will not be submitted
 *		boolean $readonly		- Specifies that the input field is read only (cannot be changed)
 *		boolean $multiple		- The multiple attribute is a boolean attribute. When present, it specifies that the user is allowed to enter more than one value in the <input> element.
 *								  Works with the following input types: email, and file.
 *		boolean $required		- The required attribute is a boolean attribute. When present, it specifies that an input field must be filled out before submitting the form. The required 
 *								  attribute works with the following input types: text, search, url, tel, email, password, date pickers, number, checkbox, radio, and file.
 *		string $min				- Specifies the minimum value for an input field. Works with the following input types: number, range, date, datetime, datetime-local, month, time and week
 *		string $max				- Specifies the maximum value for an input field. Works with the following input types: number, range, date, datetime, datetime-local, month, time and week
 *		string $maxlength		- Specifies the maximum number of character for an input field. With a maxlength attribute, the input control will not accept more than the allowed number of characters.
 *		string $size			- Specifies the width (in characters) of an input field
 *		string $pattern			- Specifies a regular expression that the <input> element's value is checked against. The pattern attribute works with the following input types: text, search, 
 *								  url, tel, email, and password.
 *		string $step			- Specifies the legal number intervals for an input field. The step attribute works with the following input types: number, range, date, datetime, datetime-local, 
 *								  month, time and week.
 *		string $title			- Specifies extra information about an element. The information is most often shown as a tooltip text when the mouse moves over the element.
 *		string $data			- The data-* attributes is used to store custom data private to the page or application.
 **/
class BaseElement extends Form\BaseForm {

	protected $type;
	protected $classes;
	protected $style;
	protected $placeholder;
	protected $id;
	protected $name;
	protected $value;
	protected $disabled;
	protected $readonly;
	protected $multiple;
	protected $required;
	protected $min;
	protected $max;
	protected $maxlength;
	protected $size;
	protected $pattern;
	protected $step;
	protected $title;
	
	protected function create($attributes = array())  {
		parent::create($attributes);
	}
	
	protected function setType($type = null) {
		$this->type = $type;
	}
	protected function getType() {
		return $this->type;
	}
	protected function getHtmlType() {
		return 'type="' . $this->type . '"';
	}
	
	protected function setClasses($classes = null) {
		$this->classes = $classes;
	}
	protected function getClasses() {
		return $this->classes;
	}
	protected function getHtmlClasses() {
		return 'class="' . $this->classes . '"';
	}
	
	protected function setStyle($style = null) {
		$this->style = $style;
	}
	protected function getStyle() {
		return $this->style;
	}
	protected function getHtmlStyle() {
		return 'style="' . $this->style . '"';
	}
	
	protected function setPlaceholder($placeholder = null) {
		$this->placeholder = $placeholder;
	}
	protected function getPlaceholder() {
		return $this->placeholder;
	}
	protected function getHtmlPlaceholder() {
		return 'placeholder="' . $this->placeholder . '"';
	}	
	
	protected function setId($id = null) {
		$this->id = $id;
	}
	protected function getId() {
		return $this->id;
	}
	protected function getHtmlId() {
		return 'id="' . $this->id . '"';
	}
	
	protected function setName($name = null) {
		$this->name = $name;
	}
	protected function getName() {
		return $this->name;
	}
	protected function getHtmlName() {
		return 'name="' . $this->name . '"';
	}
	
	protected function setValue($value = null) {
		$this->value = htmlspecialchars($value);
	}
	protected function getValue() {
		return $this->value;
	}
	protected function getHtmlValue() {
		return 'value="' . $this->value . '"';
	}
	
	protected function setDisabled($disabled = null) {
		$this->disabled = $disabled;
	}
	protected function getDisabled() {
		return $this->disabled;
	}
	protected function getHtmlDisabled() {
		if ($this->disabled != null)
			return 'disabled';
		return '';
	}
	
	protected function setReadonly($readonly = null) {
		$this->readonly = $readonly;
	}
	protected function getReadonly() {
		return $this->readonly;
	}
	protected function getHtmlReadonly() {
		if ($this->readonly != null)
			return 'readonly';
		return '';
	}
	
	protected function setMultiple($multiple = null) {
		$this->multiple = $multiple;
	}
	protected function getMultiple() {
		return $this->multiple;
	}
	protected function getHtmlMultiple() {
		if ($this->multiple != null)
			return 'multiple';
		return '';
	}
	
	protected function setRequired($required = null) {
		$this->required = $required;
	}
	protected function getRequired() {
		return $this->required;
	}
	protected function getHtmlRequired() {
		if ($this->required != null)
			return 'required';
		return '';
	}
	
	public function setMin($min = null) {
		$this->min = $min;
	}
	public function getMin() {
		return $this->min;
	}
	public function getHtmlMin() {
		return 'min="' . $this->min . '"';
	}
	
	public function setMax($max = null) {
		$this->max = $max;
	}
	public function getMax() {
		return $this->max;
	}
	public function getHtmlMax() {
		return 'max="' . $this->max . '"';
	}
	
	public function setMaxLength($maxlength = null) {
		$this->maxlength = $maxlength;
	}
	public function getMaxLength() {
		return $this->maxlength;
	}
	public function getHtmlMaxLength() {
		return 'maxlength="' . $this->maxlength . '"';
	}
	
	public function setSize($size = null) {
		$this->size = $size;
	}
	public function getSize() {
		return $this->size;
	}
	public function getHtmlSize() {
		return 'size="' . $this->size . '"';
	}
	
	public function setPattern($pattern = null) {
		$this->pattern = $pattern;
	}
	public function getPattern() {
		return $this->pattern;
	}
	public function getHtmlPattern() {
		return 'pattern="' . $this->pattern . '"';
	}
	
	public function setStep($step = null) {
		$this->step = $step;
	}
	public function getStep() {
		return $this->step;
	}
	public function getHtmlStep() {
		return 'step="' . $this->step . '"';
	}
	
	public function setTitle($title = null) {
		$this->title = $title;
	}
	public function getTitle() {
		return $this->title;
	}
	public function getHtmlTitle() {
		return 'title="' . $this->title . '"';
	}
}