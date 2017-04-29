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
 * The <select> element is used to create a drop-down list. The <option> tags inside 
 * the <select> element define the available options in the list.
 * @param array $attributes - an array of attributes used to configure the input field
 **/
class DropDown extends BaseElement {
	
	protected $options;	// an associative array of options, were the key is the value of the option and
						// the value is the text of the option
	protected $selected;	// the value you wish to be selected. Field to mark with the selected attribute
		
	public function __construct() {}
	
	public function __destruct() {}
	
	protected function create($attributes = array())  {
		parent::create($attributes);
		$this->configure();
	}
	
	protected function setSelected($selected = null) {
		$this->selected = $selected;
	}
	protected function getSelected() {
		if (is_null($this->selected))
				return '';
		return $this->selected;
	}
	
	protected function setOptions($options = null) {
		if(is_array($options))
			$this->options = $options;
		else 
			$this->options = null;
	}
	protected function getOptions() {
		return $this->options;
	}
	protected function renderOptions() {
		$str = '';
		if ($this->options != null) {
			$selected = $this->getSelected();
			foreach ($this->options as $value => $text) {
				if($value == $selected || in_array($value, $selected))
					$str .= '<option value="' . $value . '" selected="selected">' . $text . '</option>';
				else 
					$str .= '<option value="' . $value . '">' . $text . '</option>';
			}
		}
		echo $str;
	}
	
	public function render() {
		// render the input control
		echo '<select ';
		$this->renderAttributes();
		echo '>';
		echo $this->renderOptions();
		echo '</select>';
	}
}