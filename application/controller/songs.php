<?php
namespace Application\Controller;

use Application\Core\Controller;

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
class Songs extends Controller {
	
	public function __construct() {

		/**
		 * This is the code which allows access to the page or not
		 * If the user was correctly logged in, we allow access to
		 * this controller
		 **/
		if(!$this->isLoggedIn()) {
			header('location: ' . URL . 'home/index');
			exit();
		}
	}
	
    /**
     * PAGE: index
     * This method handles what happens when you move to http://yourproject/songs/index
     **/
    public function add() {
    	// if we have POST data to create a new song entry
    	if (isset($_POST["btnAddSong"])) {
    		$validator = $this->formValidations();
    	
    		// set all the form rules
    		$validator->setRule('artist', 'Artist', 'required', array(
    				'required' => 'Please specify an artist name'
    		));
    		$validator->setRule('track', 'Track', 'required', array(
    				'required' => 'Please specify a track name'
    		));
    		$validator->setRule('link', 'Link', 'required', array(
    				'required' => 'Please specify a song link'
    		));
    		 
    		// do addSong() in model/model.php
    		if($validator->run('btnAddSong', 'addSong') === false) {
    			$this->loadModel('Songs');
    			$this->model->addSong($_POST["artist"], $_POST["track"],  $_POST["link"]);
    			$type = 'success';
    			$hide = false;
    			$message = 'Song successfully added';
    			$this->clearFormData();	
    		}
    	}

       	// load views. within the views we can echo out $songs and $amount_of_songs easily
        require APP . 'view/_templates/header.php';
        require APP . 'view/_templates/nav.header.php';
        require APP . 'view/songs/add.php';
        require APP . 'view/_templates/footer.php';
    }
    
    /**
     * PAGE: listofsongs
     * This method handles what happens when you move to http://yourproject/songs/listofsongs
     **/
    public function listOfSongs($page = 1) {
    	$this->loadModel('Songs');
    	$result = $this->model->listSongs(NUMBER_OF_ITEMS_PER_PAGE - 1, $page);    	
    	$songs = $result['rows'];    	 
    	$pagination = $this->pagination($page, $result['total'], NUMBER_OF_ITEMS_PER_PAGE, URL . 'songs/listofsongs');
    
    	// load views. within the views we can echo out $songs
    	require APP . 'view/_templates/header.php';
    	require APP . 'view/_templates/nav.header.php';
    	require APP . 'view/songs/listofsongs.php';
    	require APP . 'view/_templates/footer.php';
    }

    /**
     * ACTION: deleteSong
     * This method handles what happens when you move to http://yourproject/songs/deletesong
     * IMPORTANT: This is not a normal page, it's an ACTION. This is where the "delete a song" button on songs/listofsongs
     * directs the user after the click. This method handles all the data from the GET request (in the URL!) and then
     * redirects the user back to songs/listofsongs via the last line: header(...)
     * This is an example of how to handle a GET request.
     * @param int $songId Id of the to-delete song
     **/
    public function deleteSong($songId) {
        // if we have an id of a song that should be deleted
        if (isset($songId)) {
            // do deleteSong() in model/model.php
        	$this->loadModel('Songs');
            $this->model->deleteSong($songId);
        }

        // where to go after song has been deleted
        header('location: ' . URL . 'songs/listofsongs');
		exit();
    }

     /**
     * ACTION: editSong
     * This method handles what happens when you move to http://yourproject/songs/editsong
     * @param int $songId Id of the to-edit song
     **/
    public function editSong($songId) {    	
        // if we have an id of a song that should be edited
        if (isset($songId)) {
            // do getSong() in model/model.php
        	$this->loadModel('Songs');
            $song = $this->model->getSong($songId)[0];
            // in a real application we would also check if this db entry exists and therefore show the result or
            // redirect the user to an error page or similar

            // load views. within the views we can echo out $song easily
            require APP . 'view/_templates/header.php';
       		require APP . 'view/_templates/nav.header.php';
            require APP . 'view/songs/edit.php';
            require APP . 'view/_templates/footer.php';
        } else {
            // redirect user to songs index page (as we don't have a song_id)
            header('location: ' . URL . 'songs/listofsongs');
			exit();
        }
    }
    
    /**
     * ACTION: updateSong
     * This method handles what happens when you move to http://yourproject/songs/updatesong
     * IMPORTANT: This is not a normal page, it's an ACTION. This is where the "update a song" form on songs/edit
     * directs the user after the form submit. This method handles all the POST data from the form and then redirects
     * the user back to songs/listofsongs via the last line: header(...)
     * This is an example of how to handle a POST request.
     **/
    public function updateSong() {
    	if (isset($_POST["btnUpdateSong"])) {
			$validator = $this->formValidations();
			 
			// set all the form rules
			$validator->setRule('artist', 'Artist', 'required', array(
					'required' => 'Please specify an artist name'
			));
			$validator->setRule('track', 'Track', 'required', array(
					'required' => 'Please specify a track name'
			));
			$validator->setRule('link', 'Link', 'required', array(
					'required' => 'Please specify a song link'
			));
			 
			if($validator->run('btnUpdateSong', 'updateSong') === false) {				
				// if we have an id of a song that should be edited
				if(isset($_POST['id'])) {
					// do updateSong() from model/model.php
					$this->loadModel('Songs');
					$this->model->updateSong($_POST["artist"], $_POST["track"],  $_POST["link"], $_POST['id']);
					
				}
				header('location: ' . URL . 'songs/listofsongs');
				exit();
			}
			//in case there was a validation error, we just get the row information again from the database
			$this->editSong($_POST['id']);
		}
    }
}
