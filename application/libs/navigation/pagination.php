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

namespace Application\Libs\Navigation;

class Pagination {
	
	private $currentPage;
	private $totalNumberOfItems;
	private $numberOfItemsPerPage;
	private $totalNumberOfPages;
	private $url;
	
	public function __construct($currentPage = 0, $totalNumberOfItems = 0, $numberOfItemsPerPage = NUMBER_OF_ITEMS_PER_PAGE, $url = URL) {
		$this->currentPage = $currentPage;		
		$this->totalNumberOfItems = $totalNumberOfItems;
		$this->numberOfItemsPerPage = $numberOfItemsPerPage;
		
		$this->setTotalNumberOfPages();
		$this->checkCurrentPage();
		
		$this->url = $url;
	}
	
	public function __destruct() {}
	
	private function setTotalNumberOfPages() {
		$this->totalNumberOfPages = ceil($this->totalNumberOfItems/$this->numberOfItemsPerPage);
	}
	
	private function checkCurrentPage() {
		// Check that the page number is set.
		if(!isset($this->currentPage))
			$this->currentPage = 0;
		
		// If the page number is less than 1, make it 1.
		if($this->currentPage < 1) {
			$this->currentPage = 1;
			// Check that the page is below the last page
		} else if($this->currentPage > $this->totalNumberOfPages)
			$this->currentPage = $this->totalNumberOfPages;
	}
	
	public function renderBootstrapV3() {
		if($this->totalNumberOfPages <= 1)
			echo '';
			else {
				$pagination = '<nav>' .
						'<ul class="pagination pagination-sm">' .
						'<li>' .
						'<a href="' . $this->url . '/1' . '" aria-label="Previous">' .
						'<span aria-hidden="true">&laquo;</span>' .
						'<span class="sr-only">Previous</span>' .
						'</a></li>';
					
				foreach(range(1, $this->totalNumberOfPages) as $page){
					// Check if we're on the current page in the loop
					if($page == $this->currentPage)
						$pagination .= '<li class="active"><a href="' . $this->url . '/' . $page . '">' . $page . ' <span class="sr-only">(current)</span></a></li>';
						else if($page == 1 || $page == $this->totalNumberOfPages || ($page >= $this->currentPage - 1 && $page <= $this->currentPage + 1))
							$pagination .= '<li><a href="' . $this->url . '/' . $page . '">' . $page . '</a></li>';
				}
					
				$pagination .= '<li>' .
						'<a href="' . $this->url . '/' . $this->totalNumberOfPages . '" aria-label="Next">' .
						'<span aria-hidden="true">&raquo;</span>' .
						'<span class="sr-only">Next</span>' .
						'</a></li></ul></nav>';
					
				echo $pagination;
			}
	}
	
	public function renderBootstrapV4() {
		if($this->totalNumberOfPages <= 1)
			echo '';
		else {
			$pagination = '<nav>' .
			'<ul class="pagination pagination-sm">' .
			'<li class="page-item">' .
			'<a class="page-link" href="' . $this->url . '/1' . '" aria-label="Previous">' .
			'<span aria-hidden="true">&laquo;</span>' .
			'<span class="sr-only">Previous</span>' .
			'</a></li>';
			
			foreach(range(1, $this->totalNumberOfPages) as $page){
				// Check if we're on the current page in the loop
				if($page == $this->currentPage)
					$pagination .= '<li class="page-item active"><a class="page-link" href="' . $this->url . '/' . $page . '">' . $page . ' <span class="sr-only">(current)</span></a></li>';
				else if($page == 1 || $page == $this->totalNumberOfPages || ($page >= $this->currentPage - 1 && $page <= $this->currentPage + 1))
					$pagination .= '<li class="page-item"><a class="page-link" href="' . $this->url . '/' . $page . '">' . $page . '</a></li>';
			}		
			
			$pagination .= '<li class="page-item">' .
			'<a class="page-link" href="' . $this->url . '/' . $this->totalNumberOfPages . '" aria-label="Next">' .
			'<span aria-hidden="true">&raquo;</span>' .
			'<span class="sr-only">Next</span>' .
			'</a></li></ul></nav>';
			
			echo $pagination;
		}
	}
}