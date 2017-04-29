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
 * Lets you generate a flexible datepicker input field
 *
 * @param array $attributes - an array of attributes used to configure the input field
 * 		string $format				- The date format, combination of d, dd, D, DD, m, mm, M, MM, yy, yyyy.
 * 										d, dd: Numeric date, no leading zero and leading zero, respectively. Eg, 5, 05.
 *	 									D, DD: Abbreviated and full weekday names, respectively. Eg, Mon, Monday.
 * 										m, mm: Numeric month, no leading zero and leading zero, respectively. Eg, 7, 07.
 * 										M, MM: Abbreviated and full month names, respectively. Eg, Jan, January
 * 										yy, yyyy: 2- and 4-digit years, respectively. Eg, 12, 2012.
 * 		booelan $autoClose			- Whether or not to close the datepicker immediately when a date is selected.
 * 		boolean $clearBtn			- If true, displays a “Clear” button at the bottom of the datepicker to clear the input value. 
 * 								  	  If “autoclose” is also set to true, this button will also close the datepicker.
 * 		string $language			- The IETF code (eg “en” for English, “pt-BR” for Brazilian Portuguese) of the language to use 
 * 								  	  for month and day names. These will also be used as the input’s value (and subsequently sent 
 * 								  	  to the server in the case of form submissions). If a full code (eg “de-DE”) is supplied the 
 * 								  	  picker will first check for an “de-DE” language and if not found will fallback and check for 
 * 								  	  a “de” language. If an unknown language code is given, English will be used. 
 * 		booelan $todayHighlight		- If true, highlights the current date.
 * 		string $orientation			- A space-separated string consisting of one or two of “left” or “right”, “top” or “bottom”, and 
 * 								  	  “auto” (may be omitted); for example, “top left”, “bottom” (horizontal orientation will default 
 * 								  	  to “auto”), “right” (vertical orientation will default to “auto”), “auto top”. Allows for fixed 
 * 								  	  placement of the picker popup.
 * 								  	  “orientation” refers to the location of the picker popup’s “anchor”; you can also think of it as 
 * 								  	  the location of the trigger element (input, component, etc) relative to the picker.
 * 								  	  “auto” triggers “smart orientation” of the picker. Horizontal orientation will default to “left” 
 * 								  	  and left offset will be tweaked to keep the picker inside the browser viewport; vertical orientation 
 * 								  	  will simply choose “top” or “bottom”, whichever will show more of the picker in the viewport.
 * 		boolean $forceParse			- Whether or not to force parsing of the input value when the picker is closed. That is, when an invalid 
 * 									  date is left in the input field by the user, the picker will forcibly parse that value, and set the 
 * 									  input’s value to the new, valid date, conforming to the given format.
 * 		boolean/integer $assumeNearbyYear	- If true, manually-entered dates with two-digit years, such as “5/1/15”, will be parsed as “2015”, 
 * 											  not “15”. If the year is less than 10 years in advance, the picker will use the current century, 
 * 											  otherwise, it will use the previous one. To configure the number of years in advance that the picker 
 * 											  will still use the current century, use an Integer instead of the Boolean true.
 **/
class DatePicker extends BaseElement {
	
	private $format;
	private $autoClose;
	private $clearBtn;
	private $language;
	private $todayHighlight;
	private $orientation;
	private $forceParse;
	
	public function __construct() {}
	
	public function __destruct() {}
	
	public function create($attributes = array())  {
		$attributes['type'] = 'text';
		parent::create($attributes);
		$this->configure();
	}
	
	public function setType($type = null) {
		$this->type = $type;
	}
	public function getType() {
		return $this->type;
	}
	public function getHtmlType() {
		return 'type="' . $this->type . '" data-provide="datepicker"';
	}
	
	public function setFormat($format = null) {
		$this->format = $format;
	}
	public function getFormat() {
		return $this->format;
	}
	public function getHtmlFormat() {
		return 'data-date-format="' . $this->format . '"';
	}
	
	public function setAutoClose($autoClose = null) {
		$this->autoClose = $autoClose;
	}
	public function getAutoClose() {
		return $this->autoClose;
	}
	public function getHtmlAutoClose() {
		return 'data-date-auto-close="' . $this->autoClose . '"';
	}
	
	public function setClearBtn($clearBtn = null) {
		$this->clearBtn= $clearBtn;
	}
	public function getClearBtn() {
		return $this->clearBtn;
	}
	public function getHtmlClearBtn() {
		return 'data-date-clear-btn="' . $this->clearBtn . '"';
	}
	
	public function setLanguage($language = null) {
		$this->language = $language;
	}
	public function getLanguage() {
		return $this->language;
	}
	public function getHtmlLanguage() {
		return 'data-date-language="' . $this->language . '"';
	}
	
	public function setTodayHighlight($todayHighlight = null) {
		$this->todayHighlight = $todayHighlight;
	}
	public function getTodayHighlight() {
		return $this->todayHighlight;
	}
	public function getHtmlTodayHighlight() {
		return 'data-date-today-highlight="' . $this->todayHighlight . '"';
	}
	
	public function setOrientation($orientation = null) {
		$this->orientation = $orientation;
	}
	public function getOrientation() {
		return $this->orientation;
	}
	public function getHtmlOrientation() {
		return 'data-date-orientation="' . $this->orientation . '"';
	}
	
	public function setForceParse($forceParse = null) {
		$this->forceParse = $forceParse;
	}
	public function getForceParse() {
		return $this->forceParse;
	}
	public function getHtmlForceParse() {
		return 'data-date-force-parse="' . $this->forceParse . '"';
	}
	
	public function setAssumeNearbyYear($assumeNearbyYear = null) {
		$this->assumeNearbyYear = $assumeNearbyYear;
	}
	public function getAssumeNearbyYear() {
		return $this->assumeNearbyYear;
	}
	public function getHtmlAssumeNearbyYear() {
		return 'data-date-assume-nearby-year="' . $this->assumeNearbyYear . '"';
	}
}