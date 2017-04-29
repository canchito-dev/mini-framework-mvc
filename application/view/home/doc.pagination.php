<?php
namespace Application\Libs\Methods;

use Application\Libs\Methods;
?>
					
					<section class="body-section" id="paginationLib"><!-- paginationLib -->
	  					<div class="page-header-doc"><!-- page-header-doc -->
					      	<h4>Pagination</h4>
					    </div><!-- page-header-doc -->
					    <p class="text-justify">
					    	The Pagination library creates a large block of connected links which indicate a series of related content exists across multiple pages.
					    </p>
					    <p class="text-justify">
					    	The following preferences are available in the <code>application/config/config.php</code> file. Simply, modify the following parameter to suit 
					    	your needs:
					    	<ul class="fa-ul list-docs">
						  		<li><i class="fa-li fa fa-check-square"></i><code>NUMBER_OF_ITEMS_PER_PAGE</code>: Max number of items to list in each page</li>
					    	</ul>
					    </p>
					    <p class="text-justify">
					    	<dl class="dl-horizontal list-docs">
								<dt class="dl-docs-dt"><span class="text-primary">param</span> <var>$currentPage</var> <small>(integer)</small>:</dt>
								<dd class="text-justify"> current page number. Default value is 0.</dd>
								<dt class="dl-docs-dt"><span class="text-primary">param</span> <var>$totalNumberOfItems</var> <small>(integer)</small>:</dt>
								<dd class="text-justify"> the total number of items that are in the whole list. Default value is 0.</dd>
								<dt class="dl-docs-dt"><span class="text-primary">param</span> <var>$numberOfItemsPerPage</var> <small>(integer)</small>:</dt>
								<dd class="text-justify"> the total number of items that will be displayed per page. Default value is <code>NUMBER_OF_ITEMS_PER_PAGE</code>.</dd>
								<dt class="dl-docs-dt"><span class="text-primary">param</span> <var>$url</var> <small>(string)</small>:</dt>
								<dd class="text-justify"> the root URL to which the links should point to. Default value is <code>URL</code></dd>
							</dl>
					    </p>
						<p class="text-justify">
					    	For example:
					    </p>
					    <pre>
<?php
echo Methods\CodeHighlighterMethods::highlightText(
		"<?php\n" .
		"	\$pagination = \$this->pagination(\$currentPage, \$totalNumberOfItems, \$numberOfItemsPerPage, \$url);\n\n" .
		"	// Call this method if you are using Bootstrap v3\n" . 
		"	\$this->pagination()->renderBootstrapV3();\n\n" .
		"	// Call this method if you are using Bootstrap v4\n" . 
		"	\$this->pagination()->renderBootstrapV4();\n" .
		"?>");
?>
						</pre>
					</section><!-- paginationLib -->