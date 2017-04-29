<?php
namespace Application\Libs\Methods;

use Application\Libs\Methods;
?>
					
					<section class="body-section" id="formsAndValidationsLib"><!-- formsAndValidationsLib -->
	  					<div class="page-header-doc"><!-- page-header-doc -->
					      	<h4>Form and Validations</h4>
					    </div><!-- page-header-doc -->
					    <p class="text-justify"></p>
					    
					    <p class="text-justify">
					    	<ul class="fa-ul list-docs">
						  		<li><i class="fa-li fa fa-check-square"></i>
					    			<a href="#formLib">Form Library</a>
					    		</li>
					    		<li>
									<ul class="fa-ul list-docs">
								  		<li><i class="fa-li fa fa-check-square"></i>
							    			<a href="#formLibFunctions">Form Available Functions</a>
							    		</li>
								  		<li><i class="fa-li fa fa-check-square"></i>
							    			<a href="#formLibInputSharedProperties">Input Shared Attributes</a>
							    		</li>
								  		<li><i class="fa-li fa fa-check-square"></i>
							    			<a href="#formLibInputFunctions">Input Available Functions</a>
							    		</li>
					    			</ul>
					    		</li>
					    		<li><i class="fa-li fa fa-check-square"></i>
					    			<a href="#validationLib">Validation Library</a>
					    		</li>
					    	</ul>
					    </p>
					    
					    <section class="body-main" id="formLib"><!-- formLib -->
		  					<div class="page-header-doc"><!-- page-header-doc -->
						      	<h5>Form Library</h5>
						    </div><!-- page-header-doc -->
						    <p class="text-justify">
						    	Programatically create forms with a base URL built from your config preferences. It will optionally let you add form attributes hidden 
						    	input fields, and will always add the accept-charset attribute based on the charset value in your config file, if not specified.
						    </p>
						    <p class="text-justify">
						    	The main benefit of using this tag rather than hard coding your own HTML is that it permits your site to be more portable in the event 
						    	your URLs ever change.
						    </p>
						    
						    <section class="body-main" id="formLibFunctions"><!-- formLibFunctions -->
			  					<div class="page-header-doc"><!-- page-header-doc -->
							      	<h5>Form Available Functions</h5>
							    </div><!-- page-header-doc -->
							    
							    <!-- START $this->form()->create() -->
							    <p class="text-justify">
							    	<strong class="text-info">$this->form()->create()</strong>
							    </p>
							    <p class="text-justify">
							    	Creates an opening form tag with all the attributes passed from the <var>$this->form-create()</var> method.
							    	<dl class="dl-horizontal list-docs">
										<dt class="dl-docs-dt"><span class="text-primary">param</span> <var>$attributes</var> <small>(array)</small>:</dt>
										<dd class="text-justify">An associative array of attributes used to configure the form. The key is the property, and 
										the value is the value to assign.</dd>
									</dl>
							    </p>
							    <p class="text-justify">
							    	Accepted properties are:
									<ul class="fa-ul list-docs">
					  					<li><i class="fa-li fa fa-check-square" aria-hidden="true"></i>
					  						<var>charset</var>: Charset used in the submitted form (default: the page charset)
					  					</li>
					  					<li><i class="fa-li fa fa-check-square" aria-hidden="true"></i>
					  						<var>action</var>: An address (url) where to submit the form (default: the submitting page)
					  					</li>
					  					<li><i class="fa-li fa fa-check-square" aria-hidden="true"></i>
					  						<var>autocomplete</var>: If the browser should autocomplete the form (default: on)
					  					</li>
					  					<li><i class="fa-li fa fa-check-square" aria-hidden="true"></i>
					  						<var>enctype</var>: The encoding of the submitted data (default: is url-encoded)
					  					</li>
					  					<li><i class="fa-li fa fa-check-square" aria-hidden="true"></i>
					  						<var>method</var>: The HTTP method used when submitting the form (default: GET)
					  					</li>
					  					<li><i class="fa-li fa fa-check-square" aria-hidden="true"></i>
					  						<var>name</var>: A name used to identify the form (for DOM usage: document.forms.name)
					  					</li>
					  					<li><i class="fa-li fa fa-check-square" aria-hidden="true"></i>
					  						<var>novalidate</var>: Tells the browser should not validate the form
					  					</li>
					  					<li><i class="fa-li fa fa-check-square" aria-hidden="true"></i>
					  						<var>target</var>: The target of the address in the action attribute (default: _self)
					  					</li>
					  					<li><i class="fa-li fa fa-check-square" aria-hidden="true"></i>
					  						<var>classes</var>: A string with the CSS classes to use
					  					</li>
					  					<li><i class="fa-li fa fa-check-square" aria-hidden="true"></i>
					  						<var>role</var>: The role of the form. Useful for material design frameworks
					  					</li>
									</ul>
								</p>
								<p class="text-justify">
							    	For example:
							    </p>
							    
							    <pre>
<?php
echo Methods\CodeHighlighterMethods::highlightText(
		"<?php\n" .
		"	\$this->form()\n" .
		"			->create(array(\n" .
		"				'method' => 'post',\n" .
		"				'name' => 'formContactUs',\n" .
		"				'id' => 'formContactUs',\n" .
		"				'role' => 'form',\n" .
		"				'classes' => 'form-horizontal',\n" .
		"				'novalidate' => false\n" .
		"			));\n" .
		"?>");
?>
								</pre>
								<hr class="hr-blue-lighten-5"><br>
							    <!-- END $this->form()->create() -->
							    
							    <!-- START $this->form()->open() -->
							    <p class="text-justify">
							    	<strong class="text-info">$this->form()->open()</strong>
							    </p>
							    <p class="text-justify">
							    	Creates an opening form tag with all the attributes passed from the <var>$this->form-create()</var> method.
							    </p>
							    <p class="text-justify">
							    	For example:
							    </p>
							    <pre>
<?php
echo Methods\CodeHighlighterMethods::highlightText(
		"<?php\n" .
		"	\$this->form()->open();\n" .
		"	// Produces: 	<form method=\"post\" name=\"formContactUs\" id=\"formContactUs\" role=\"form\" novalidate=\"\">\n" .
		"	// based on the parameters from the call of \$this->form-create() method\n" .
		"?>");
?>
								</pre>
								<hr class="hr-blue-lighten-5"><br>
							    <!-- END $this->form()->open() -->
							    
							    <!-- START $this->form()->close() -->
							    <p class="text-justify">
							    	<strong class="text-info">$this->form()->close()</strong>
							    </p>
							    <p class="text-justify">
							    	Produces a closing form tag. The only advantage to using this function is it permits you to pass data to it 
							    	which will be added below the tag.
							    	<dl class="dl-horizontal list-docs">
										<dt class="dl-docs-dt"><span class="text-primary">param</span> <var>$extra</var> <small>(string)</small>:</dt>
										<dd class="text-justify">Anything to append after the closing tag, as is</dd>
									</dl>
							    </p>
							    <p class="text-justify">
							    	For example:
							    </p>
							    <pre>
<?php
echo Methods\CodeHighlighterMethods::highlightText(
		"<?php\n" .
		"	\$this->form()->close();\n" .
		"	// Produces: </form>\n" .
		"?>");
?>
								</pre>
								<hr class="hr-blue-lighten-5"><br>
							    <!-- END $this->form()->close() -->
							    
							    <!-- START $this->getFormData() -->
							    <p class="text-justify">
							    	<strong class="text-info">$this->getFormData()</strong>
							    </p>
							    <p class="text-justify">
							    	This is a global function that lets you retrieve a value that was submitted when sending a form.
							    	<dl class="dl-horizontal list-docs">
										<dt class="dl-docs-dt"><span class="text-primary">param</span> <var>$field</var> <small>(string)</small>:</dt>
										<dd class="text-justify">The name of the submitted data to get.</dd>
										<dt class="dl-docs-dt"><span class="text-primary">return</span>:</dt>
										<dd class="text-justify">The value of the field or null.</dd>
									</dl>
							    </p>
								<hr class="hr-blue-lighten-5"><br>
							    <!-- END $this->getFormData() -->
							    
							    <!-- START $this->clearFormData() -->
							    <p class="text-justify">
							    	<strong class="text-info">$this->clearFormData()</strong>
							    </p>
							    <p class="text-justify">
							    	This is a global function that lets you unset or clear the $_POST and/or $_GET global variables.
							    </p>
							    <!-- END $this->clearFormData() -->
							</section><!-- formLibFunctions -->


							<section class="body-main" id="formLibInputSharedProperties"><!-- formLibInputSharedProperties -->
			  					<div class="page-header-doc"><!-- page-header-doc -->
							      	<h5>Input Shared Attributes</h5>
							    </div><!-- page-header-doc -->
							    
							    <p class="text-justify">
							    	When creating an input element for a form, it is required to pass an associative array with the attributes used to configure it, 
							    	and where the key is the property, and the value is the value to assign. The library does not filter any key of the array, but when
							    	rendering the input element, it will only render those valid for the specific input element.
							    </p>
							    <p class="text-justify">
							    	Neverthless, there are some attributes that are specific to a type of input element. Those attributes will be explained in its respective
							    	section.
							    </p>
							    <p class="text-justify">
							    	The shared attributes are:
									<ul class="fa-ul list-docs">
					  					<li><i class="fa-li fa fa-check-square" aria-hidden="true"></i>
					  						<var>classes</var> <small>(string)</small>: A string with the CSS classes to use
					  					</li>
					  					<li><i class="fa-li fa fa-check-square" aria-hidden="true"></i>
					  						<var>style</var> <small>(string)</small>: The stye use for styling the input field
					  					</li>
					  					<li><i class="fa-li fa fa-check-square" aria-hidden="true"></i>
					  						<var>placeholder</var> <small>(string)</small>: A hint that describes the expected value of an input field
					  					</li>
					  					<li><i class="fa-li fa fa-check-square" aria-hidden="true"></i>
					  						<var>id</var> <small>(string)</small>: The identification of the input field
					  					</li>
					  					<li><i class="fa-li fa fa-check-square" aria-hidden="true"></i>
					  						<var>name</var> <small>(string)</small>: The name of the input field
					  					</li>
					  					<li><i class="fa-li fa fa-check-square" aria-hidden="true"></i>
					  						<var>value</var> <small>(string/integer/float/etc)</small>: The default value for an input field
					  					</li>
					  					<li><i class="fa-li fa fa-check-square" aria-hidden="true"></i>
					  						<var>disabled</var> <small>(boolean)</small>: The input field is disabled. A disabled element is un-usable and un-clickable. Disabled elements 
					  						will not be submitted. Default is false (not disabled)
					  					</li>
					  					<li><i class="fa-li fa fa-check-square" aria-hidden="true"></i>
					  						<var>readonly</var> <small>(boolean)</small>: The input field is read only (cannot be changed). Default is false (not readonly)
					  					</li>
					  					<li><i class="fa-li fa fa-check-square" aria-hidden="true"></i>
					  						<var>multiple</var> <small>(boolean)</small>: Boolean attribute. When present, it specifies that the user is allowed to enter more than one value.
					  						Default is false (not multiple)
					  					</li>
					  					<li><i class="fa-li fa fa-check-square" aria-hidden="true"></i>
					  						<var>required</var> <small>(boolean)</small>: Boolean attribute. When present, it specifies that an input field must be filled out before submitting 
					  						the form. Default is false (not required)
					  					</li>
					  					<li><i class="fa-li fa fa-check-square" aria-hidden="true"></i>
					  						<var>min</var> <small>(integer/float)</small>: The minimum value for an input field
					  					</li>
					  					<li><i class="fa-li fa fa-check-square" aria-hidden="true"></i>
					  						<var>max</var> <small>(integer/float)</small>: The maximum value for an input field
					  					</li>
					  					<li><i class="fa-li fa fa-check-square" aria-hidden="true"></i>
					  						<var>maxlength</var> <small>(integer)</small>: The maximum number of character for an input field. With a maxlength attribute, the input control will not accept more 
					  						than the allowed number of characters
					  					</li>
					  					<li><i class="fa-li fa fa-check-square" aria-hidden="true"></i>
					  						<var>size</var> <small>(integer)</small>: The width (in characters) of an input field
					  					</li>
					  					<li><i class="fa-li fa fa-check-square" aria-hidden="true"></i>
					  						<var>pattern</var> <small>(string)</small>: A regular expression that the input element's value is checked against
					  					</li>
					  					<li><i class="fa-li fa fa-check-square" aria-hidden="true"></i>
					  						<var>step</var>: Legal number intervals for an input field
					  					</li>
					  					<li><i class="fa-li fa fa-check-square" aria-hidden="true"></i>
					  						<var>title</var> <small>(string)</small>: Extra information about an element 
					  					</li>
					  					<li><i class="fa-li fa fa-check-square" aria-hidden="true"></i>
					  						<var>data</var> <small>(string)</small>: The data-* attributes is used to store custom data private to the page or application. 
					  					</li>
									</ul>
								</p>
							</section><!-- formLibInputSharedProperties -->
							
							
							<section class="body-main" id="formLibInputFunctions"><!-- formLibInputFunctions -->
			  					<div class="page-header-doc"><!-- page-header-doc -->
							      	<h5>Input Available Functions</h5>
							    </div><!-- page-header-doc -->
							    
							    <!-- START $this->form()->formButton() -->
							    <p class="text-justify">
							    	<strong class="text-info">$this->form()->formButton()</strong>
							    </p>
							    <p class="text-justify">
							    	Lets you generate a standard submit button.
							    	<dl class="dl-horizontal list-docs">
										<dt class="dl-docs-dt"><span class="text-primary">param</span> <var>$attributes</var> <small>(array)</small>:</dt>
										<dd class="text-justify">An associative array of attributes used to configure the input element. The key is the property, and 
										the value is the value to assign.</dd>
									</dl>
							    </p>
								<p class="text-justify">
							    	For example:
							    </p>
							    <pre>
<?php
echo Methods\CodeHighlighterMethods::highlightText(
		"<?php\n" .
		"	\$this->form()\n" .
		"			->formButton(array(\n" .
		"				'id' => 'btnRegister',\n" .
		"				'name' => 'btnRegister',\n" .
		"				'value' => 'register',\n" .
		"				'classes' => 'btn btn-primary btn-lg text-center',\n" .
		"				'text' => 'Register'\n" .
		"			));\n" .
		"	// Produces: <button id=\"btnRegister\" name=\"btnRegister\" value=\"register\" class=\"btn btn-primary btn-lg text-center\" type=\"submit\">Register</button>\n" .
		"?>");
?>
								</pre>
								<hr class="hr-blue-lighten-5"><br>
							    <!-- END $this->form()->formButton() -->
							    
							    <!-- START $this->form()->formCheckbox() -->
							    <p class="text-justify">
							    	<strong class="text-info">$this->form()->formCheckbox()</strong>
							    </p>
							    <p class="text-justify">
							    	Lets you generate a checkbox input fields. These are the two specific variables that need to included in the variable <var>$attibutes</var>
							    	and that are needed for creating an input element:
							    	<ul class="fa-ul list-docs">
					  					<li><i class="fa-li fa fa-check-square" aria-hidden="true"></i>
					  						<var>text</var> <small>(string)</small>: The text associated to the checkbox
					  					</li>
					  					<li><i class="fa-li fa fa-check-square" aria-hidden="true"></i>
					  						<var>checked</var> <small>(boolean)</small>: Whether the checkbox should be checked or not. Default is false (not checked)
					  					</li>
					  				</ul>
							    	<dl class="dl-horizontal list-docs">
										<dt class="dl-docs-dt"><span class="text-primary">param</span> <var>$attributes</var> <small>(array)</small>:</dt>
										<dd class="text-justify">An associative array of attributes used to configure the input element. The key is the property, and 
										the value is the value to assign.</dd>
									</dl>
							    </p>
								<p class="text-justify">
							    	For example:
							    </p>
							    <pre>
<?php
echo Methods\CodeHighlighterMethods::highlightText(
		"<?php\n" .
		"	\$this->form()\n" .
		"			->formCheckbox(array(\n" .
		"				'id' => 'gender',\n" .
		"				'name' => 'gender',\n" .
		"				'value' => 'female',\n" .
		"				'text' => 'Female'\n" .
		"			));\n" .
		"	// Produces: <input id=\"gender\" name=\"gender\" value=\"female\" type=\"checkbox\">Female\n" .
		"?>");
?>
								</pre>
								<hr class="hr-blue-lighten-5"><br>
							    <!-- END $this->form()->formCheckbox() -->
							    
							    <!-- START $this->form()->formDatePicker() -->
							    <p class="text-justify">
							    	<strong class="text-info">$this->form()->formDatePicker()</strong>
							    </p>
							    <p class="text-justify">
							    	Lets you generate a datepicker input fields. However, since not all the Web navigators have native support for date input element, 
							    	we have implemented <a href="https://github.com/eternicode/bootstrap-datepicker">Datepicker for Bootstrap</a> by Stefan Petre. 
							    	For simplification, these eight specific variables were created and should be included in the variable <var>$attibutes</var> when 
							    	creatig a date picker input element:
							    	<ul class="fa-ul list-docs">
					  					<li><i class="fa-li fa fa-check-square" aria-hidden="true"></i>
					  						<var>format</var> <small>(string)</small>: The date format, combination of d, dd, D, DD, m, mm, M, MM, yy, yyyy
					  					</li>
					  					<li><i class="fa-li fa fa-check-square" aria-hidden="true"></i>
					  						<var>autoClose</var> <small>(boolean)</small>: Whether or not to close the datepicker immediately when a date is selected
					  					</li>
					  					<li><i class="fa-li fa fa-check-square" aria-hidden="true"></i>
					  						<var>clearBtn</var> <small>(boolean)</small>: If true, displays a “Clear” button at the bottom of the datepicker to clear the 
					  						input value. If “autoclose” is also set to true, this button will also close the datepicker
					  					</li>
					  					<li><i class="fa-li fa fa-check-square" aria-hidden="true"></i>
					  						<var>language</var> <small>(string)</small>: The IETF code of the language to use for month and day names
					  					</li>
					  					<li><i class="fa-li fa fa-check-square" aria-hidden="true"></i>
					  						<var>todayHighlight</var> <small>(boolean)</small>: If true, highlights the current date
					  					</li>
					  					<li><i class="fa-li fa fa-check-square" aria-hidden="true"></i>
					  						<var>orientation</var> <small>(string)</small>: A space-separated string consisting of one or two of “left” or “right”, “top” 
					  						or “bottom”, and “auto” (may be omitted)
					  					</li>
					  					<li><i class="fa-li fa fa-check-square" aria-hidden="true"></i>
					  						<var>forceParse</var> <small>(boolean)</small>: Whether or not to force parsing of the input value when the picker is closed
					  					</li>
					  					<li><i class="fa-li fa fa-check-square" aria-hidden="true"></i>
					  						<var>assumeNearbyYear</var> <small>(boolean/integer)</small>: If true, manually-entered dates with two-digit years. To configure 
					  						the number of years in advance that the picker will still use the current century, use an Integer instead of the Boolean true.
					  					</li>
					  				</ul>
							    </p>
						    	<blockquote>
							    	<p class="text-justify">
								    	<strong>NOTE:</strong> If you would like a deeper description of the widget options, please visit the officla site by clicking on 
								    	this link <a href="https://github.com/eternicode/bootstrap-datepicker">Datepicker for Bootstrap</a> by Stefan Petre.
							    	</p>
						    	</blockquote>
							    <p class="text-justify">
							    	If you prefer, you can directly use the <var>data</var> property and send it using the <var>$attributes</var> array. It does the same 
							    	thing as the specific defined properties, but also it gives you the possiblity to use the rest of the options allowed by this widget.
							    </p>
							    <p class="text-justify">
							    	<dl class="dl-horizontal list-docs">
										<dt class="dl-docs-dt"><span class="text-primary">param</span> <var>$attributes</var> <small>(array)</small>:</dt>
										<dd class="text-justify">An associative array of attributes used to configure the input element. The key is the property, and 
										the value is the value to assign.</dd>
									</dl>
							    </p>
								<p class="text-justify">
							    	For example:
							    </p>
							    <pre>
<?php
echo Methods\CodeHighlighterMethods::highlightText(
		"<?php\n" .
		"	\$this->form()\n" .
		"			->formDatePicker(array(\n" .
		"				'id' => 'birthday',\n" .
		"				'name' => 'birthday',\n" .
		"				'placeholder' => 'Birthday',\n" .
		"				'classes' => 'form-control input-controls',\n" .
		"				'format' => 'dd/mm/yyyy',\n" .
		"				'clearBtn' => 'true',\n" .
		"				'language' => 'en',\n" .
		"				'todayHighlight' => 'true',\n" .
		"				'orientation' => 'left bottom',\n" .
		"				'forceParse' => 'true',\n" .
		"				'assumeNearbyYear' => '20',\n" .
		"				'value' => ''\n" .
		"			));\n" .
		"	// Produces:	<input id=\"birthday\" name=\"birthday\" placeholder=\"Birthday\" class=\"form-control input-controls\" \n" . 
		"	//					data-date-format=\"dd/mm/yyyy\" data-date-clear-btn=\"true\" data-date-language=\"en\" \n" .
		"	//					data-date-today-highlight=\"true\" data-date-orientation=\"left bottom\" data-date-force-parse=\"true\" \n" . 
		"	//					data-date-assume-nearby-year=\"20\" value=\"\" type=\"text\" data-provide=\"datepicker\">\n" .
		"?>");
?>
								</pre>
								<hr class="hr-blue-lighten-5"><br>
							    <!-- END $this->form()->formDatePicker() -->
							    
							    <!-- START $this->form()->formDropDown() -->
							    <p class="text-justify">
							    	<strong class="text-info">$this->form()->formDropDown()</strong>
							    </p>
							    <p class="text-justify">
							    	Lets you generate a dropdown select input field. These are the two specific variables that need to included in the variable <var>$attibutes</var>
							    	and that are needed for creating an input element:
							    	<ul class="fa-ul list-docs">
					  					<li><i class="fa-li fa fa-check-square" aria-hidden="true"></i>
					  						<var>options</var> <small>(array)</small>: An associative array of options, were the key is the value of the option and the value is the 
					  						text of the option
					  					</li>
					  					<li><i class="fa-li fa fa-check-square" aria-hidden="true"></i>
					  						<var>selected</var> <small>(string)</small>: The value you wish to be selected. Field to mark with the selected attributex
					  					</li>
					  				</ul>
							    	<dl class="dl-horizontal list-docs">
										<dt class="dl-docs-dt"><span class="text-primary">param</span> <var>$attributes</var> <small>(array)</small>:</dt>
										<dd class="text-justify">An associative array of attributes used to configure the input element. The key is the property, and 
										the value is the value to assign.</dd>
									</dl>
							    </p>
								<p class="text-justify">
							    	For example:
							    </p>
							    <pre>
<?php
echo Methods\CodeHighlighterMethods::highlightText(
		"<?php\n" .
		"	\$this->form()\n" .
		"			->formDropDown(array(\n" .
		"				'id' => 'agree',\n" .
		"				'name' => 'agree',\n" .
		"				'classes' => 'form-control input-controls',\n" .
		"				'options' => array(\n" .
		"					'yes' => 'Yes',\n" .
		"					'no' => 'No'\n" .
		"				),\n" .
		"				'selected' => 'no'\n" .
		"			));\n" .
		"	// Produces:	<select id=\"agree\" name=\"agree\" class=\"form-control input-controls\">\n" .
		"	//					<option value=\"yes\">Yes</option>\n" .
		"	//					<option value=\"no\" selected=\"selected\">No</option>\n" .
		"	//				</select>\n" .
		"?>");
?>
								</pre>
								<hr class="hr-blue-lighten-5"><br>
							    <!-- END $this->form()->formDropDown() -->
							    
							    <!-- START $this->form()->formHidden() -->
							    <p class="text-justify">
							    	<strong class="text-info">$this->form()->formHidden()</strong>
							    </p>
							    <p class="text-justify">
							    	Lets you generate hidden input fields.
							    	<dl class="dl-horizontal list-docs">
										<dt class="dl-docs-dt"><span class="text-primary">param</span> <var>$attributes</var> <small>(array)</small>:</dt>
										<dd class="text-justify">An associative array of attributes used to configure the input element. The key is the property, and 
										the value is the value to assign.</dd>
									</dl>
							    </p>
								<p class="text-justify">
							    	For example:
							    </p>
							    <pre>
<?php
echo Methods\CodeHighlighterMethods::highlightText(
		"<?php\n" .
		"	\$this->form()\n" .
		"			->formHidden(array(\n" .
		"				'id' => 'hiddenField',\n" .
		"				'name' => 'hiddenField',\n" .
		"				'value' => 'invisible'\n" .
		"			));\n" .
		"	// Produces: <input id=\"hiddenField\" name=\"hiddenField\" value=\"invisible\" type=\"hidden\">\n" .
		"?>");
?>
								</pre>
								<hr class="hr-blue-lighten-5"><br>
							    <!-- END $this->form()->formHidden() -->
							    
							    <!-- START $this->form()->formLabel() -->
							    <p class="text-justify">
							    	<strong class="text-info">$this->form()->formLabel()</strong>
							    </p>
							    <p class="text-justify">
							    	Lets you generate a standard label. There is only a single specific variables that need to included in the variable <var>$attibutes</var>
							    	and that is needed for creating an input element:
							    	<ul class="fa-ul list-docs">
					  					<li><i class="fa-li fa fa-check-square" aria-hidden="true"></i>
					  						<var>for</var> <small>(string)</small>: Specifies which form element a label is bound to
					  					</li>
					  				</ul>
							    	<dl class="dl-horizontal list-docs">
										<dt class="dl-docs-dt"><span class="text-primary">param</span> <var>$attributes</var> <small>(array)</small>:</dt>
										<dd class="text-justify">An associative array of attributes used to configure the input element. The key is the property, and 
										the value is the value to assign.</dd>
									</dl>
							    </p>
								<p class="text-justify">
							    	For example:
							    </p>
							    <pre>
<?php
echo Methods\CodeHighlighterMethods::highlightText(
		"<?php\n" .
		"	\$this->form()\n" .
		"			->formLabel(array(\n" .
		"				'for' => 'birthday',\n" .
		"				'classes' => 'sr-only',\n" .
		"				'text' => 'Birthday'\n" .
		"			));\n" .
		"	// Produces: <label for=\"birthday\" class=\"sr-only\">Birthday:</label>\n" .
		"?>");
?>
								</pre>
								<hr class="hr-blue-lighten-5"><br>
							    <!-- END $this->form()->formLabel() -->
							    
							    <!-- START $this->form()->formMail() -->
							    <p class="text-justify">
							    	<strong class="text-info">$this->form()->formMail()</strong>
							    </p>
							    <p class="text-justify">
							    	Lets you generate an email input field
							    	<dl class="dl-horizontal list-docs">
										<dt class="dl-docs-dt"><span class="text-primary">param</span> <var>$attributes</var> <small>(array)</small>:</dt>
										<dd class="text-justify">An associative array of attributes used to configure the input element. The key is the property, and 
										the value is the value to assign.</dd>
									</dl>
							    </p>
								<p class="text-justify">
							    	For example:
							    </p>
							    <pre>
<?php
echo Methods\CodeHighlighterMethods::highlightText(
		"<?php\n" .
		"	\$this->form()\n" .
		"			->formMail(array(\n" .
		"				'id' => 'email',\n" .
		"				'name' => 'email',\n" .
		"				'placeholder' => 'E-mail',\n" .
		"				'classes' => 'form-control input-controls',\n" .
		"				'value' => ''\n" .
		"			));\n" .
		"	// Produces: <input id=\"email\" name=\"email\" placeholder=\"E-mail\" class=\"form-control input-controls\" value=\"\" type=\"email\">\n" .
		"?>");
?>
								</pre>
								<hr class="hr-blue-lighten-5"><br>
							    <!-- END $this->form()->formMail() -->
							    
							    <!-- START $this->form()->formNumber() -->
							    <p class="text-justify">
							    	<strong class="text-info">$this->form()->formNumber()</strong>
							    </p>
							    <p class="text-justify">
							    	Define a field for entering a number (You can also set restrictions on what numbers are accepted). Use the following attributes to 
							    	specify restrictions:
							    	<ul class="fa-ul list-docs">
					  					<li><i class="fa-li fa fa-check-square" aria-hidden="true"></i>
					  						<var>min</var> <small>(integer)</small>: Specifies the minimum value allowed
					  					</li>
					  					<li><i class="fa-li fa fa-check-square" aria-hidden="true"></i>
					  						<var>max</var> <small>(integer)</small>: Specifies the maximum value allowed
					  					</li>
					  					<li><i class="fa-li fa fa-check-square" aria-hidden="true"></i>
					  						<var>step</var> <small>(integer)</small>: Specifies the legal number intervals
					  					</li>
					  					<li><i class="fa-li fa fa-check-square" aria-hidden="true"></i>
					  						<var>value</var> <small>(integer)</small>: Specifies the default value
					  					</li>
					  				</ul>
							    	<dl class="dl-horizontal list-docs">
										<dt class="dl-docs-dt"><span class="text-primary">param</span> <var>$attributes</var> <small>(array)</small>:</dt>
										<dd class="text-justify">An associative array of attributes used to configure the input element. The key is the property, and 
										the value is the value to assign.</dd>
									</dl>
							    </p>
								<p class="text-justify">
							    	For example:
							    </p>
							    <pre>
<?php
echo Methods\CodeHighlighterMethods::highlightText(
		"<?php\n" .
		"	\$this->form()\n" .
		"			->formNumber(array(\n" .
		"				'id' => 'count',\n" .
		"				'name' => 'count',\n" .
		"				'classes' => 'form-control input-controls',\n" .
		"				'min' => '0',\n" .
		"				'max' => '5',\n" .
		"				'step' => '1',\n" .
		"				'value' => '0'\n" .
		"			));\n" .
		"	// Produces: <input id=\"count\" name=\"count\" class=\"form-control input-controls\" min=\"0\" max=\"5\" step=\"1\" value=\"0\" type=\"number\">\n" .
		"?>");
?>
								</pre>
								<hr class="hr-blue-lighten-5"><br>
							    <!-- END $this->form()->formNumber() -->
							    
							    <!-- START $this->form()->formPassword() -->
							    <p class="text-justify">
							    	<strong class="text-info">$this->form()->formPassword()</strong>
							    </p>
							    <p class="text-justify">
							    	Lets you generate a password input fields. The <a href="https://github.com/wenzhixin/bootstrap-show-password">show/hide password plugin</a> 
							    	by Zhixin Wen can be enabled by including the following properties in the variable <var>$attibutes</var> when creatig a password input element:
							    	<ul class="fa-ul list-docs">
					  					<li><i class="fa-li fa fa-check-square" aria-hidden="true"></i>
					  						<var>toggle</var> <small>(boolean)</small>: Activate the show/hide password plugin
					  					</li>
					  					<li><i class="fa-li fa fa-check-square" aria-hidden="true"></i>
					  						<var>message</var> <small>(string)</small>: The tooltip of show/hide icon. Default value is "Click here to show/hide password"
					  					</li>
					  					<li><i class="fa-li fa fa-check-square" aria-hidden="true"></i>
					  						<var>placement</var> <small>(string)</small>: The placement of show/hide icon, can be 'before' or 'after'. Default is 'after'
					  					</li>
					  				</ul>
							    	<dl class="dl-horizontal list-docs">
										<dt class="dl-docs-dt"><span class="text-primary">param</span> <var>$attributes</var> <small>(array)</small>:</dt>
										<dd class="text-justify">An associative array of attributes used to configure the input element. The key is the property, and 
										the value is the value to assign.</dd>
									</dl>
							    </p>
						    	<blockquote>
							    	<p class="text-justify">
								    	<strong>NOTE:</strong> If you would like a deeper description of the widget options, please visit the official site by clicking on 
								    	this link <a href="https://github.com/wenzhixin/bootstrap-show-password">show/hide password plugin</a> by Zhixin Wen.
							    	</p>
						    	</blockquote>
							    <p class="text-justify">
							    	If you prefer, you can directly use the <var>data</var> property and send it using the <var>$attributes</var> array. It does the same 
							    	thing as the specific defined properties, but also it gives you the possiblity to use the rest of the options allowed by this widget.
							    </p>
								<p class="text-justify">
							    	For example:
							    </p>
							    <pre>
<?php
echo Methods\CodeHighlighterMethods::highlightText(
		"<?php\n" .
		"	\$this->form()\n" .
		"			->formPassword(array(\n" .
		"				'id' => 'password',\n" .
		"				'name' => 'password',\n" .
		"				'placeholder' => 'Password',\n" .
		"				'classes' => 'form-control input-controls',\n" .
		"				'placement' => 'after',\n" .
		"				'message' => 'Show/Hide password',\n" .
		"				'toggle' => true\n" .
		"			));\n" .
		"	// Produces: 	<input id=\"password\" name=\"password\" placeholder=\"Password\" class=\"form-control input-controls\" data-placement=\"after\"\n" . 
		"	//				data-message=\"Show/Hide password\" data-toggle=\"password\" type=\"password\">\n" .
		"?>");
?>
								</pre>
								<hr class="hr-blue-lighten-5"><br>
							    <!-- END $this->form()->formPassword() -->
							    
							    <!-- START $this->form()->formRadio() -->
							    <p class="text-justify">
							    	<strong class="text-info">$this->form()->formRadio()</strong>
							    </p>
							    <p class="text-justify">
							    	Lets you generate a radio input field. These are the two specific variables that need to included in the variable <var>$attibutes</var>
							    	and that are needed for creating an input element:
							    	<ul class="fa-ul list-docs">
					  					<li><i class="fa-li fa fa-check-square" aria-hidden="true"></i>
					  						<var>text</var> <small>(string)</small>: The text associated to the radio
					  					</li>
					  					<li><i class="fa-li fa fa-check-square" aria-hidden="true"></i>
					  						<var>checked</var> <small>(boolean)</small>: Whether the radio should be checked or not. Default is false (not checked)
					  					</li>
					  				</ul>
							    	<dl class="dl-horizontal list-docs">
										<dt class="dl-docs-dt"><span class="text-primary">param</span> <var>$attributes</var> <small>(array)</small>:</dt>
										<dd class="text-justify">An associative array of attributes used to configure the input element. The key is the property, and 
										the value is the value to assign.</dd>
									</dl>
							    </p>
								<p class="text-justify">
							    	For example:
							    </p>
							    <pre>
<?php
echo Methods\CodeHighlighterMethods::highlightText(
		"<?php\n" .
		"	\$this->form()\n" .
		"			->formRadio(array(\n" .
		"				'id' => 'gender',\n" .
		"				'name' => 'gender',\n" .
		"				'value' => 'female',\n" .
		"				'text' => 'Female'\n" .
		"			));\n" .
		"	// Produces: <input id=\"gender\" name=\"gender\" value=\"female\" type=\"radio\">Female\n" .
		"?>");
?>
								</pre>
								<hr class="hr-blue-lighten-5"><br>
							    <!-- END $this->form()->formRadio() -->
							    
							    <!-- START $this->form()->formRange() -->
							    <p class="text-justify">
							    	<strong class="text-info">$this->form()->formRange()</strong>
							    </p>
							    <p class="text-justify">
							    	Define a control for entering a number whose exact value is not important (like a slider control). Depending on browser support, 
							    	the input field can be displayed as a slider control. You can also set restrictions on what numbers are accepted Use the following 
							    	attributes to specify restrictions:
							    	<ul class="fa-ul list-docs">
					  					<li><i class="fa-li fa fa-check-square" aria-hidden="true"></i>
					  						<var>min</var> <small>(integer)</small>: Specifies the minimum value allowed
					  					</li>
					  					<li><i class="fa-li fa fa-check-square" aria-hidden="true"></i>
					  						<var>max</var> <small>(integer)</small>: Specifies the maximum value allowed
					  					</li>
					  					<li><i class="fa-li fa fa-check-square" aria-hidden="true"></i>
					  						<var>step</var> <small>(integer)</small>: Specifies the legal number intervals
					  					</li>
					  					<li><i class="fa-li fa fa-check-square" aria-hidden="true"></i>
					  						<var>value</var> <small>(integer)</small>: Specifies the default value
					  					</li>
					  				</ul>
							    	<dl class="dl-horizontal list-docs">
										<dt class="dl-docs-dt"><span class="text-primary">param</span> <var>$attributes</var> <small>(array)</small>:</dt>
										<dd class="text-justify">An associative array of attributes used to configure the input element. The key is the property, and 
										the value is the value to assign.</dd>
									</dl>
							    </p>
								<p class="text-justify">
							    	For example:
							    </p>
							    <pre>
<?php
echo Methods\CodeHighlighterMethods::highlightText(
		"<?php\n" .
		"	\$this->form()\n" .
		"			->formRange(array(\n" .
		"				'id' => 'count',\n" .
		"				'name' => 'count',\n" .
		"				'classes' => 'form-control input-controls',\n" .
		"				'min' => '0',\n" .
		"				'max' => '5',\n" .
		"				'step' => '1',\n" .
		"				'value' => '0'\n" .
		"			));\n" .
		"	// Produces: <input id=\"count\" name=\"count\" class=\"form-control input-controls\" min=\"0\" max=\"5\" step=\"1\" value=\"0\" type=\"range\">\n" .
		"?>");
?>
								</pre>
								<hr class="hr-blue-lighten-5"><br>
							    <!-- END $this->form()->formRange() -->
							    
							    <!-- START $this->form()->formTextarea() -->
							    <p class="text-justify">
							    	<strong class="text-info">$this->form()->formTextarea()</strong>
							    </p>
							    <p class="text-justify">
							    	Lets you define a multi-line text input control. Use the following attributes to specify restrictions:
							    	<ul class="fa-ul list-docs">
					  					<li><i class="fa-li fa fa-check-square" aria-hidden="true"></i>
					  						<var>cols</var> <small>(integer)</small>: Specifies the visible width of a text area
					  					</li>
					  					<li><i class="fa-li fa fa-check-square" aria-hidden="true"></i>
					  						<var>rows</var> <small>(integer)</small>: Specifies the visible number of lines in a text area
					  					</li>
					  					<li><i class="fa-li fa fa-check-square" aria-hidden="true"></i>
					  						<var>wrap</var> <small>(integer)</small>: Specifies how the text in a text area is to be wrapped 
					  						when submitted in a form. Posible values are hard or soft
					  					</li>
					  				</ul>
							    	<dl class="dl-horizontal list-docs">
										<dt class="dl-docs-dt"><span class="text-primary">param</span> <var>$attributes</var> <small>(array)</small>:</dt>
										<dd class="text-justify">An associative array of attributes used to configure the input element. The key is the property, and 
										the value is the value to assign.</dd>
									</dl>
							    </p>
								<p class="text-justify">
							    	For example:
							    </p>
							    <pre>
<?php
echo Methods\CodeHighlighterMethods::highlightText(
		"<?php\n" .
		"	\$this->form()\n" .
		"			->formTextarea(array(\n" .
		"				'id' => 'message',\n" .
		"				'name' => 'message',\n" .
		"				'placeholder' => 'Message',\n" .
		"				'classes' => 'form-control input-controls',\n" .
		"				'rows' => '5',\n" .
		"				'value' => 'This is the value'\n" .
		"			));\n" .
		"	// Produces: <textarea id=\"message\" name=\"message\" placeholder=\"Message\" class=\"form-control input-controls\" rows=\"5\" value=\"This is the value\">This is the value</textarea>\n" .
		"?>");
?>
								</pre>
								<hr class="hr-blue-lighten-5"><br>
							    <!-- END $this->form()->formTextarea() -->
							    
							    <!-- START $this->form()->formTextbox() -->
							    <p class="text-justify">
							    	<strong class="text-info">$this->form()->formTextbox()</strong>
							    </p>
							    <p class="text-justify">
							    	Lets you generate a standard text input field.
							    	<dl class="dl-horizontal list-docs">
										<dt class="dl-docs-dt"><span class="text-primary">param</span> <var>$attributes</var> <small>(array)</small>:</dt>
										<dd class="text-justify">An associative array of attributes used to configure the input element. The key is the property, and 
										the value is the value to assign.</dd>
									</dl>
							    </p>
								<p class="text-justify">
							    	For example:
							    </p>
							    <pre>
<?php
echo Methods\CodeHighlighterMethods::highlightText(
		"<?php\n" .
		"	\$this->form()\n" .
		"			->formTextbox(array(\n" .
		"				'id' => 'subject',\n" .
		"				'name' => 'subject',\n" .
		"				'placeholder' => 'Subject',\n" .
		"				'classes' => 'form-control input-controls',\n" .
		"				'value' => ''\n" .
		"			));\n" .
		"	// Produces: <input id=\"subject\" name=\"subject\" placeholder=\"Subject\" class=\"form-control input-controls\" value=\"\" type=\"text\">\n" .
		"?>");
?>
								</pre>
								<hr class="hr-blue-lighten-5"><br>
							    <!-- END $this->form()->formTextbox() -->
							    
							    <!-- START $this->form()->formUpload() -->
							    <p class="text-justify">
							    	<strong class="text-info">$this->form()->formUpload()</strong>
							    </p>
							    <p class="text-justify">
							    	Lets you generate a standard browser input field. Defines a file-select field and a "Browse..." button (for file uploads). Use 
							    	the following attributes to specify restrictions:
							    	<ul class="fa-ul list-docs">
					  					<li><i class="fa-li fa fa-check-square" aria-hidden="true"></i>
					  						<var>accept</var> <small>(string)</small>: Specifies the types of files that the server accepts (that can be submitted through a file upload)
					  					</li>
					  				</ul>
							    	<dl class="dl-horizontal list-docs">
										<dt class="dl-docs-dt"><span class="text-primary">param</span> <var>$attributes</var> <small>(array)</small>:</dt>
										<dd class="text-justify">An associative array of attributes used to configure the input element. The key is the property, and 
										the value is the value to assign.</dd>
									</dl>
							    </p>
								<p class="text-justify">
							    	For example:
							    </p>
							    <pre>
<?php
echo Methods\CodeHighlighterMethods::highlightText(
		"<?php\n" .
		"	\$this->form()\n" .
		"			->formUpload(array(\n" .
		"				'id' => 'uploadFile',\n" .
		"				'name' => 'uploadFile',\n" .
		"				'classes' => 'form-control input-controls',\n" .
		"				'accept' => '.sql'\n" .
		"			));\n" .
		"	// Produces: <input id=\"uploadFile\" name=\"uploadFile\" class=\"form-control input-controls\" accept=\".sql\" type=\"file\">\n" .
		"?>");
?>
								</pre>
							    <!-- END $this->form()->formUpload() -->
							</section><!-- formLibInputFunctions -->
						</section><!-- formLib -->
						
						
						<section class="body-main" id="validationLib"><!-- validationLib -->
		  					<div class="page-header-doc"><!-- page-header-doc -->
						      	<h5>Validation Library</h5>
						    </div><!-- page-header-doc -->
						    <p class="text-justify">
						    	Before we go into explaining how to create form validation rules, lets revise the step needed for submitting a valid form.
						    </p>
					    	<ol class="list-docs">
					  			<li>You go to a specific page and a form is displeyed.</li>
					  			<li>You fill in the form and submit it.</li>
					  			<li>
					  				If the submitted values are not valid, e.g. there are some empty value, you are redirected back to the same page, and
					  				the form is again displayed but now including your previously submitted data, and of course some error messages on those
					  				fields with invalid data. 
					  			</li>
					  			<li>This process is repeated until the all the validations are passed, and no incorrect data is sent.</li>
							</ol>
							<p class="text-justify">
						    	All those rule validations are run on the server side. Each form field has predefied validations rules that must be meet in order
						    	to be a valid value. Lets have a look at the different rules available.
						    </p>
						    <br>
							    
						    <!-- START $this->formValidations()->setRule() -->
						    <p class="text-justify">
						    	<strong class="text-info">$this->formValidations()->setRule()</strong>
						    </p>
						    <p class="text-justify">
						    	This function sets the conditions that a specific form field must fulfil in order to be valid.
						    	<dl class="dl-horizontal list-docs">
									<dt class="dl-docs-dt"><span class="text-primary">param</span> <var>$field</var> <small>(string)</small>:</dt>
									<dd class="text-justify">The name of the form field to validate</dd>
									<dt class="dl-docs-dt"><span class="text-primary">param</span> <var>$attributes</var> <small>(string)</small>:</dt>
									<dd class="text-justify">The label to used for displaying the error message in reference to <var>$field</var></dd>
									<dt class="dl-docs-dt"><span class="text-primary">param</span> <var>$rules</var> <small>(mixed)</small>:</dt>
									<dd class="text-justify">The conditions that determine if <var>$field</var> is valid or not. It can be a string 
									delimeted by | or an array</dd>
									<dt class="dl-docs-dt"><span class="text-primary">param</span> <var>$errors</var> <small>(array)</small>:</dt>
									<dd class="text-justify">An associative array with the message that must be shown if the condition is not met</dd>
								</dl>
						    </p>
							<p class="text-justify">
						    	For example:
						    </p>
						    <pre>
<?php
echo Methods\CodeHighlighterMethods::highlightText(
		"<?php\n" .
		"	\$this->formValidations()\n" .
		"			->setRule('subject', 'Subject', 'required|minLength[5]|maxLength[45]', array(\n" .
		"				'required' => 'Please specify a subject',\n" .
		"				'minLength' => 'Subject must be at least 5 characters',\n" .
		"				'maxLength' => 'Subject cannot be longer then 45 characters'\n" .
		"			));\n" .
		"?>");
?>
							</pre>
							<hr class="hr-blue-lighten-5"><br>
						    <!-- END $this->formValidations()->setRule() -->
						    
						    <!-- START $this->formValidations()->run() -->
						    <p class="text-justify">
						    	<strong class="text-info">$this->formValidations()->run()</strong>
						    </p>
						    <p class="text-justify">
						    	Executes the form validation, but only if the submit button name and value equals to the parameters. These parameters are needed 
						    	in case there are multiple form in the same page.
						    	<dl class="dl-horizontal list-docs">
									<dt class="dl-docs-dt"><span class="text-primary">param</span> <var>$button</var> <small>(string)</small>:</dt>
									<dd class="text-justify">The name of the button that will submit the form</dd>
									<dt class="dl-docs-dt"><span class="text-primary">param</span> <var>$value</var> <small>(string)</small>:</dt>
									<dd class="text-justify">The value that is sent by the submit button</dd>
									<dt class="dl-docs-dt"><span class="text-primary">return</span>:</dt>
									<dd class="text-justify">true if errors were found, false if it not</dd>
								</dl>
						    </p>
							<p class="text-justify">
						    	For example:
						    </p>
						    <pre>
<?php
echo Methods\CodeHighlighterMethods::highlightText(
		"<?php\n" .
		"	if(\$this->formValidations()->run('btnContactUs', 'contactUs') === false) {\n" .
		"		// do something as there were no errors found in the submitter form\n" .
		"	}\n" .
		"?>");
?>
							</pre>
							<hr class="hr-blue-lighten-5"><br>
						    <!-- END $this->formValidations()->run() -->
						    
						    <!-- START $this->formValidations()->getErrors() -->
						    <p class="text-justify">
						    	<strong class="text-info">$this->formValidations()->getErrors()</strong>
						    </p>
						    <p class="text-justify">
						    	Returns an associative array with all the fields that were submitted with an incorrect value. The key is the field and the value is an 
						    	array containing all the error related to that field.
						    </p>
							<p class="text-justify">
						    	For example:
						    </p>
						    <pre>
<?php
echo Methods\CodeHighlighterMethods::highlightText(
		"<?php\n" .
		"	\$errors = \$this->formValidations()->getErrors();\n" .
		"?>");
?>
							</pre>
							<hr class="hr-blue-lighten-5"><br>
						    <!-- END $this->formValidations()->getErrors() -->
						    
						    <!-- START supported rules -->
						    <p class="text-justify">
						    	<strong class="text-info">Supported Rules</strong>
						    </p>
						    <p class="text-justify">
						    	<table class="table table-striped table-hover">
						    		<thead>
						    			<tr>
							    			<th>Rule</th>
							    			<th>Parameter</th>
							    			<th>Description</th>
							    			<th>Example</th>
						    			</tr>
						    		</thead>
						    		<tbody>
						    			<tr>
							    			<td>alphaNumeric</td>
							    			<td>No</td>
							    			<td>Returns FALSE if the form element contains anything other than alpha-numeric characters</td>
							    			<td></td>
						    			</tr>
						    			<tr>
							    			<td>date</td>
							    			<td>No</td>
							    			<td>Returns TRUE if the date given is valid; otherwise returns FALSE</td>
							    			<td></td>
						    			</tr>
						    			<tr>
							    			<td>differs</td>
							    			<td>Yes</td>
							    			<td>Returns TRUE if the two values are different; otherwise returns FALSE</td>
							    			<td>differs[form_item]</td>
						    			</tr>
						    			<tr>
							    			<td>email</td>
							    			<td>No</td>
							    			<td>Returns TRUE if the email is a valid one; otherwise returns FALSE</td>
							    			<td></td>
						    			</tr>
						    			<tr>
							    			<td>greaterOrEqualThan</td>
							    			<td>Yes</td>
							    			<td>Returns FALSE if the form element is greater than or equal to the parameter value or not numeric</td>
							    			<td>greaterOrEqualThan[81]</td>
						    			</tr>
						    			<tr>
							    			<td>greaterThan</td>
							    			<td>Yes</td>
							    			<td>Returns FALSE if the form element is greater than the parameter value or not numeric</td>
							    			<td>greaterThan[33]</td>
						    			</tr>
						    			<tr>
							    			<td>inList</td>
							    			<td>Yes</td>
							    			<td>Returns FALSE if the form element is not within a predetermined list</td>
							    			<td>inList[euro,dolar,quetzal]</td>
						    			</tr>
						    			<tr>
							    			<td>ip</td>
							    			<td>No</td>
							    			<td>Returns FALSE if the supplied IP is not valid, otherwise TRUE</td>
							    			<td></td>
						    			</tr>
						    			<tr>
							    			<td>lessOrEqualThan</td>
							    			<td>Yes</td>
							    			<td>Returns FALSE if the form element is less than or equal to the parameter value or not numeric</td>
							    			<td>lessOrEqualThan[81]</td>
						    			</tr>
						    			<tr>
							    			<td>lessThan</td>
							    			<td>Yes</td>
							    			<td>Returns FALSE if the form element is less than the parameter value or not numeric</td>
							    			<td>lessThan[6]</td>
						    			</tr>
						    			<tr>
							    			<td>matches</td>
							    			<td>Yes</td>
							    			<td>Returns FALSE if the form element does not match the one in the parameter, otherwise TRUE</td>
							    			<td>matches[form_item]</td>
						    			</tr>
						    			<tr>
							    			<td>maxLength</td>
							    			<td>Yes</td>
							    			<td>Returns FALSE if the form element is longer than the parameter value or not numeric</td>
							    			<td>maxLength[10]</td>
						    			</tr>
						    			<tr>
							    			<td>minLength</td>
							    			<td>Yes</td>
							    			<td>Returns FALSE if the form element is shorter than the parameter value or not numeric</td>
							    			<td>minLength[5]</td>
						    			</tr>
						    			<tr>
							    			<td>numeric</td>
							    			<td>No</td>
							    			<td>Returns FALSE if the form element contains anything other than numeric characters, otherwise TRUE</td>
							    			<td></td>
						    			</tr>
						    			<tr>
							    			<td>required</td>
							    			<td>No</td>
							    			<td>Returns FALSE if the form element is empty, otherwiser TRUE</td>
							    			<td></td>
						    			</tr>
						    			<tr>
							    			<td>url</td>
							    			<td>No</td>
							    			<td>Returns FALSE if the form element does not contain a valid URL</td>
							    			<td></td>
						    			</tr>
						    		</tbody>
						    	</table>
						    </p>
						    <!-- END supported rules -->
						</section><!-- validationLib -->
					</section><!-- formsAndValidationsLib -->