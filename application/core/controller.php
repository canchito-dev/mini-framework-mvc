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
namespace Application\Core;

use Application\Libs\Form;
use Application\Libs\Email;
use Application\Libs\Session;
use Application\Libs\File;
use Application\Libs\Navigation;
use Application\Model;

class Controller extends Base {

    /**
     * @var null Model
     **/
    public $model = null;

    public function __construct() {}
    
    public function __destruct() {}
    
    /**
     * Checks if the user is logged in or not, and if the session has not been inactive
     * for more then MAX_INACTIVE_SESSION
     * @returns true if the user is logged in, false otherwise
     * */
    protected function isLoggedIn() {
    	$session = $this->session();
    	if($session->hasVariable('SID') && $session->hasVariable('email')) {
    		if($session->isSessionActive())
    			return true;
    	}
    	return false;
    }

    /**
     * Loads the "model".
     **/
    public function loadModel($model = null)  {
    	if(!is_null($model)) {
	        require_once APP . 'model/' . $model . '.php';
	        $model = 'Application\\Model\\' . $model;
	        $this->model = new $model();
    	}
    }
    
    /**
     * Loads the "Twig view".
     **/
    public function view($viewName, $data) {
    	$view = new View($viewName, $data);
    	echo $view;
    }
    
    public function form() {
    	return Form\Form::getInstance();
    }
    
    public function formValidations() {
    	return new Form\Validations();
    }
    
    public function emailer() {
    	return new Email\Email();
    }
    
    public function session() {
    	return Session\Session::getInstance();
    }
    
    public function upload($config = array()) {
    	return new File\Upload($config);
    }
    
    public function image($config = array()) {
    	return new File\Image($config);
    }
    
    public function pagination($currentPage, $totalNumberOfItems, $numberOfItemsPerPage, $url) {
    	return new Navigation\Pagination($currentPage, $totalNumberOfItems, $numberOfItemsPerPage, $url);
    }
}
