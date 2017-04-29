<?php
namespace Application\Libs\Methods;

use Application\Libs\Methods;
?>
					
					<section class="body-section" id="imageLib"><!-- imageLib -->
	  					<div class="page-header-doc"><!-- page-header-doc -->
					      	<h4>Image Manipulation</h4>
					    </div><!-- page-header-doc -->
					    <p class="text-justify">
					    	The Image Manipulation librarylets you perform the following actions: image resize and thumbnail creation.
					    </p>
					    <p class="text-justify">
					    	The following preferences are available in the <code>application/config/config.php</code> file. Simply, modify the following parameter to suit 
					    	your needs:
					    	<ul class="fa-ul list-docs">
						  		<li><i class="fa-li fa fa-check-square"></i><code>IMG_QUALITY</code>: Ranges from 0 (worst quality, smaller file) to 100 (best quality, biggest file)</li>
						  		<li><i class="fa-li fa fa-check-square"></i><code>IMG_COMPRESSION_LEVEL</code>: </li>
					    		<li><i class="fa-li fa fa-check-square"></i><code>IMG_MAX_WIDTH</code>: The maximum width (in pixels) that the image can be. Set to zero for no limit</li>
					    		<li><i class="fa-li fa fa-check-square"></i><code>IMG_MAX_HEIGHT</code>: The maximum height (in pixels) that the image can be. Set to zero for no limit</li>
					    		<li><i class="fa-li fa fa-check-square"></i><code>IMG_THUMBNAIL_FOLDER</code>: </li>
					    		<li><i class="fa-li fa fa-check-square"></i><code>IMG_THUMB_MAX_WIDTH</code>: The maximum width (in pixels) that the thumbnail image can be. Set to zero for no limit</li>
					    		<li><i class="fa-li fa fa-check-square"></i><code>IMG_THUMB_MAX_HEIGHT</code>: The maximum height (in pixels) that the thumbnail image can be. Set to zero for no limit</li>
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
		"			'quality' => 100,\n" .
		"			'compressionLevel' => 9,\n" .
		"			'maxWidth' => 1380,\n" .
		"			'maxHeight' => 920,\n" .
		"			'thumbnailFolder' => '../public/img/thumbs/',\n" .
		"			'thumbMaxWidth' => 314,\n" .
		"			'thumbMaxHeight' => 209\n" .
		"	);\n\n" .
		"	\$image = \$this->image(\$config);\n" .
		"?>");
?>
						</pre>
					    <p class="text-justify">
					    	The configuration can be changed by calling the setter of each individual property. 
					    </p>
						    
					    <!-- START $this->image()->resize() -->
					    <p class="text-justify">
					    	<strong class="text-info">$this->image()->resize()</strong>
					    </p>
					    <p class="text-justify">
					    	Resizes an image file to the values specified by IMG_MAX_-WIDTH and -HEIGHT
					    	<dl class="dl-horizontal list-docs">
								<dt class="dl-docs-dt"><span class="text-primary">param</span> <var>$filename</var> <small>(string)</small>:</dt>
								<dd class="text-justify"> The name of the image including the path</dd>
								<dt class="dl-docs-dt"><span class="text-primary">return</span>:</dt>
								<dd class="text-justify">true on success, otherwise false</dd>
							</dl>
					    </p>
						<p class="text-justify">
					    	For example:
					    </p>
					    <pre>
<?php
echo Methods\CodeHighlighterMethods::highlightText(
		"<?php\n" .
		"	\$this->image()->resize('../img/new_image.png');\n" .
		"?>");
?>
						</pre>
						<hr class="hr-blue-lighten-5"><br>
					    <!-- END $this->image()->resize() -->
					    
					    <!-- START $this->image()->thumbnail() -->
					    <p class="text-justify">
					    	<strong class="text-info">$this->image()->thumbnail()</strong>
					    </p>
					    <p class="text-justify">
					    	Creates an image thumbnail of size specified by IMG_THUMB_MAX_-WIDTH and -HEIGHT
					    	<dl class="dl-horizontal list-docs">
								<dt class="dl-docs-dt"><span class="text-primary">param</span> <var>$filename</var> <small>(string)</small>:</dt>
								<dd class="text-justify"> The name of the image including the path</dd>
								<dt class="dl-docs-dt"><span class="text-primary">return</span>:</dt>
								<dd class="text-justify">true on success, otherwise false</dd>
							</dl>
					    </p>
						<p class="text-justify">
					    	For example:
					    </p>
					    <pre>
<?php
echo Methods\CodeHighlighterMethods::highlightText(
		"<?php\n" .
		"	\$this->image()->thumbnail('../img/new_image.png');\n" .
		"?>");
?>
						</pre>
					    <!-- END $this->image()->thumbnail() -->
					</section><!-- imageLib -->