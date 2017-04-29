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
 * The <label> tag defines a label for an <input> element. The <label> element does not render as anything special 
 * for the user. However, it provides a usability improvement for mouse users, because if the user clicks on the text 
 * within the <label> element, it toggles the control. The for attribute of the <label> tag should be equal to the id 
 * attribute of the related element to bind them together.
 * @param array $attributes - an array of attributes used to configure the textbox
 *		string $for			- Specifies which form element a label is bound to
 *		string $classes		- Specifies the classes use for styling the label
 *		string $text		- Specifies the text of the label
 **/
class Label extends BaseElement {
	
	private $for;
	private $text;
	
	public function __construct() {}
	
	public function __destruct() {}
	
	public function create($attributes = array())  {
		parent::create($attributes);
		$this->configure();
	}
	
	public function setFor($for = null) {
		$this->for = $for;
	}
	public function getFor() {
		return $this->for;
	}
	public function getHtmlFor() {
		return 'for="' . $this->for . '"';
	}
	
	public function setText($text = null) {
		$this->text = $text;
	}
	public function getText() {
		return $this->text;
	}
	
	public function render() {
		echo'<label ';
		$this->renderAttributes();
		echo '>' . $this->getText() . ':</label>';
	}
}