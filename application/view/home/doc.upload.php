<?php
namespace Application\Libs\Methods;

use Application\Libs\Methods;
?>
					
					<section class="body-section" id="fileUploadLib"><!-- fileUploadLib -->
	  					<div class="page-header-doc"><!-- page-header-doc -->
					      	<h4>File Upload</h4>
					    </div><!-- page-header-doc -->
					    <p class="text-justify">
					    	The File Upload library will help you with the uploading of files to your server. Similar to other libraries, you can set various preferences, 
					    	restricting the type and size of the files.
					    </p>
					    <p class="text-justify">
					    	The following preferences are available in the <code>application/config/config.php</code> file. Simply, modify the following parameter to suit 
					    	your needs:
					    	<ul class="fa-ul list-docs">
						  		<li><i class="fa-li fa fa-check-square"></i><code>UPLOAD_PATH</code>: The path to the directory where the upload should be placed. The directory must be writable and the path can be absolute or relative</li>
						  		<li><i class="fa-li fa fa-check-square"></i><code>UPLOAD_ALLOWED_EXTENSIONS</code>: An array corresponding to the types of files you allow to be uploaded. The file extension can be used as the mime type</li>
					    		<li><i class="fa-li fa fa-check-square"></i><code>UPLOAD_FILENAME</code>: If set, the uploaded file will be renamed to this name. The extension provided in the file name must also be an allowed extension type. If no extension is provided, the one provided in the original file will be used</li>
					    		<li><i class="fa-li fa fa-check-square"></i><code>UPLOAD_ENCRYPT_FILENAME</code>: If true, the filename will be replace with an encrypted random filename</li>
					    		<li><i class="fa-li fa fa-check-square"></i><code>UPLOAD_MAX_FILESIZE</code>: The maximum size (in kilobytes) that the file can be. Set to zero for no limit. Note: Most PHP installations have their own limit, as specified in the php.ini file. Usually 2 MB (or 2048 KB) by default</li>
					    	</ul>
					    </p>
					    <p class="text-justify">
					    	When getting an instance of this class from the controller, you can specify an array as an argument, which will override the configuration specified in
					    	the <code>application/config/config.php</code> file. If no argument is passed, the instance will be configured with the default values.
					    </p>
					    <pre>
<?php
echo Methods\CodeHighlighterMethods::highlightText(
		"<?php\n" .
		"	\$config = array(\n" .
		"			'uploadPath' => '../public/img/',\n" .
		"			'allowedExtension' => serialize (array ('jpg', 'jpeg', 'png')),\n" .
		"			'filename' => '',\n" .
		"			'encrypt' => 'true',\n" .
		"			'maxFilesize' => '10000000'\n" .
		"	);\n\n" .
		"	\$uploaded = \$this->upload(\$config);\n" .
		"?>");
?>
						</pre>
					    <p class="text-justify">
					    	The configuration can be changed by calling the setter of each individual property. 
					    </p>
						    
					    <!-- START $this->upload()->doUpload() -->
					    <p class="text-justify">
					    	<strong class="text-info">$this->upload()->doUpload()</strong>
					    </p>
					    <p class="text-justify">
					    	Uploads the file specified by $file. If $filename is specified, the uploaded file is renamed. Returns true if the 
					    	file was successfully uploaded, otherwise false
					    	<dl class="dl-horizontal list-docs">
								<dt class="dl-docs-dt"><span class="text-primary">param</span> <var>$file</var> <small>(array|$_FILE)</small>:</dt>
								<dd class="text-justify"> the file that will be uploaded</dd>
								<dt class="dl-docs-dt"><span class="text-primary">param</span> <var>$filename</var> <small>(string)</small>:</dt>
								<dd class="text-justify"> if specified, the name to which the file must be renamed to</dd>
								<dt class="dl-docs-dt"><span class="text-primary">return</span>:</dt>
								<dd class="text-justify">true if the file was successfully uploaded, otherwise false</dd>
							</dl>
					    </p>
						<p class="text-justify">
					    	For example:
					    </p>
					    <pre>
<?php
echo Methods\CodeHighlighterMethods::highlightText(
		"<?php\n" .
		"	\$this->upload()->doUpload();\n" .
		"?>");
?>
						</pre>
					    <!-- END $this->upload()->doUpload() -->
					</section><!-- fileUploadLib -->