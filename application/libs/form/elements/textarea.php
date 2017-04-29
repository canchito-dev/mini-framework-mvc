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

/**
 * Lets you define a multi-line text input control
 * @param array $attributes - an array of attributes used to configure the input field
 * 		number $cols		- Specifies the visible width of a text area
 * 		number $rows		- Specifies the visible number of lines in a text area
 * 		string wrap			- Specifies how the text in a text area is to be wrapped when submitted in a form. Posible values are hard or soft
 **/
class Textarea extends BaseElement {
	
	private $cols;
	private $rows;
	private $wrap;
	
	public function __construct() {}
	
	public function __destruct() {}
	
	public function create($attributes = array())  {
		parent::create($attributes);
		$this->configure();
	}
	
	public function setCols($cols = null) {
		$this->cols = $cols;
	}
	public function getCols() {
		return $this->cols;
	}
	public function getHtmlCols() {
		return 'cols="' . $this->cols . '"';
	}
	
	public function setRows($rows = null) {
		$this->rows = $rows;
	}
	public function getRows() {
		return $this->rows;
	}
	public function getHtmlRows() {
		return 'rows="' . $this->rows . '"';
	}
	
	public function setWrap($wrap = null) {
		$this->wrap = $wrap;
	}
	public function getWrap() {
		return $this->wrap;
	}
	public function getHtmlWrap() {
		return 'wrap="' . $this->wrap . '"';
	}
	
	public function render() {
		// render the input control
		echo '<textarea ';
		$this->renderAttributes();
		echo '>' . $this->getValue() . '</textarea>';
	}
}