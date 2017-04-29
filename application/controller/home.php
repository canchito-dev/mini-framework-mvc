<?php
namespace Application\Controller;

use Application\Core\Controller;
use Application\Libs\Session;
use Application\Libs\Methods;

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
class Home extends Controller {
	
    /**
     * PAGE: index
     * This method handles what happens when you move to http://yourproject/home/index (which is the default page btw)
     **/
    public function index() {
        // load views
        require APP . 'view/_templates/header.php';
        require APP . 'view/_templates/nav.header.php';
        require APP . 'view/home/index.php';
        require APP . 'view/_templates/footer.php';
    }
    
    /**
     * PAGE: contact us
     * This method handles what happens when you move to http://yourproject/home/contactus
     **/
    public function contactUs() {    	
    	// if we have POST data
    	if (isset($_POST["btnContactUs"])) {
			$validator = $this->formValidations();
			
			// set all the form rules
			$validator->setRule('subject', 'Subject', 'required|minLength[5]|maxLength[45]|differs[name]', array(
					'required' => 'Please specify a subject',
					'minLength' => 'Subject must be at least 5 characters',
					'maxLength' => 'Subject cannot be longer then 45 characters',
					'differs' => 'values are egual'
			));
			$validator->setRule('name', 'Name', 'required|minLength[5]|maxLength[45]', array(
					'required' => 'Please specify your name',
					'minLength' => 'Name must be at least 5 characters',
					'maxLength' => 'Name cannot be longer then 45 characters'
			));
			$validator->setRule('email', 'E-mail', 'required|email|maxLength[45]', array(
					'required' => 'Please specify your e-mail address',
					'email' => 'Correo electrónico no válido',
					'maxLength' => 'E-mail cannot be longer then 45 characters'
			));
			$validator->setRule('message', 'Message', 'required|minLength[5]|maxLength[255]', array(
					'required' => 'Please specify your doubt, message or question',
					'minLength' => 'Message must be at least 5 characters',
					'maxLength' => 'Message cannot be longer then 255 characters'
			));
    		
    		if($validator->run('btnContactUs', 'contactUs') === false) {
    			//simulates sending a confirmation mail for demo purposes
    			$mailer = $this->emailer();
    			$mailer->from(SMTP_USERNAME, 'MINI-FRAMEWORK');
    			$mailer->addRecipient(SMTP_USERNAME, 'MINI-FRAMEWORK');
    			$mailer->subject('This is a test');
    			$mailer->replyTo('no-reply@miniframework.com', 'MINI-FRAMEWORK no-reply');
    			$mailer->htmlBody(file_get_contents(APP . '\view\_templates\_mail\contents.html'), APP . '\view\_templates\_mail');
    			$mailer->sendMail();
    			
    			
    			$type = 'success';
    			$hide = false;
    			$message = 'Thank you for contacting us. We will get back to you as soon as possible!';
    			$this->clearFormData();	
    		}
    	}
    	
    	// load views
    	require APP . 'view/_templates/header.php';
    	require APP . 'view/_templates/nav.header.php';
    	require APP . 'view/home/contactus.php';
    	require APP . 'view/_templates/footer.php';
    }
    
    /**
     * PAGE: the team
     * This method handles what happens when you move to http://yourproject/home/theteam
     **/
    public function theTeam() {
    	// load views
    	require APP . 'view/_templates/header.php';
    	require APP . 'view/_templates/nav.header.php';
    	require APP . 'view/home/theteam.php';
    	require APP . 'view/_templates/footer.php';
    }
    
    /**
     * PAGE: privacy policy
     * This method handles what happens when you move to http://yourproject/home/privacypolicy
     **/
    public function privacyPolicy() {
    	// load views
    	require APP . 'view/_templates/header.php';
    	require APP . 'view/_templates/nav.header.php';
    	require APP . 'view/home/privacypolicy.php';
    	require APP . 'view/_templates/footer.php';
    }
    
    /**
     * PAGE: terms of use
     * This method handles what happens when you move to http://yourproject/home/termsofuse
     **/
    public function termsOfUse() {
    	// load views
    	require APP . 'view/_templates/header.php';
    	require APP . 'view/_templates/nav.header.php';
    	require APP . 'view/home/termsofuse.php';
    	require APP . 'view/_templates/footer.php';
    }
    
    /**
     * PAGE: who we are
     * This method handles what happens when you move to http://yourproject/home/whoweare
     **/
    public function whoWeAre() {
    	// load views
    	require APP . 'view/_templates/header.php';
    	require APP . 'view/_templates/nav.header.php';
    	require APP . 'view/home/whoweare.php';
    	require APP . 'view/_templates/footer.php';
    }
    
    /**
     * PAGE: documentation
     * This method handles what happens when you move to http://yourproject/home/documentation
     **/
    public function documentation() {
    	// load views
    	require APP . 'view/_templates/header.php';
    	require APP . 'view/_templates/nav.header.php';
    	require APP . 'view/home/documentation.php';
    	require APP . 'view/_templates/footer.php';
    }
    
    /**
     * PAGE: sign in
     * This method handles what happens when you move to http://yourproject/home/signin
     **/
    public function signIn() {    	
    	if (isset($_POST["btnSignIn"])) {
    		$validator = $this->formValidations();
    		
    		$validator->setRule('email', 'E-mail', 'required|email|maxLength[45]', array(
    				'required' => 'Please specify your e-mail',
    				'email' => 'E-mail not valid',
    				'maxLength' => 'E-amil cannot be longer than 45 characters'
    		));
			$validator->setRule('password', 'Password', 'required', array(
					'required' => 'Please specify a password'
			));
			
			if($validator->run('btnSignIn', 'signIn') === false) {
				$this->loadModel('Home');
				
				$user = $this->model->getUserByEmail($_POST['email']);
				if(count($user) <= 0) {
					$type = 'warning';
					$hide = false;
					$message = 'E-mail address and/or password are not valid. Please try again';
				} else {
					if(!Methods\PasswordMethods::validatePassword($_POST["password"], $user[0]['password'])) {
						$type = 'warning';
						$hide = false;
						$message = 'E-mail address and/or password are not valid. Please try again';
					} else {
						unset($user[0]['user_id']);
						unset($user[0]['password']);
						unset($user[0]['birthday']);
						unset($user[0]['gender']);
						$this->session()->createSession($user[0]);
						header('location: ' . URL . 'user/index');
						exit();
					}
				}
			}
    	}
    
    	// load views
    	require APP . 'view/_templates/header.php';
    	require APP . 'view/_templates/nav.header.php';
    	require APP . 'view/home/signin.php';
    	require APP . 'view/_templates/footer.php';
    }
    
    /**
     * PAGE: register
     * This method handles what happens when you move to http://yourproject/home/register
     **/
    public function register() {
    	// if we have POST data to create a new song entry
    	if (isset($_POST["btnRegister"])) {
	    	$validator = $this->formValidations();
	    		
	    	// set all the form rules
	    	$validator->setRule('name', 'Name(s)', 'required|minLength[5]|maxLength[45]', array(
					'required' => 'Please specify your name(s)',
					'minLength' => 'Name must be at least 5 characters',
					'maxLength' => 'Name cannot be longer than 45 characters'
			));
			$validator->setRule('lastname', 'Lastname(s)', 'required|minLength[5]|maxLength[45]', array(
					'required' => 'Please specify your lastname(s)',
					'minLength' => 'Lastname must be at least 5 characters',
					'maxLength' => 'Lastname cannot be longer than 45 characters'
			));
			$validator->setRule('email', 'E-mail', 'required|email|maxLength[45]', array(
					'required' => 'Please specify your e-mail',
					'email' => 'E-mail not valid',
					'maxLength' => 'E-amil cannot be longer than 45 characters'
			));
			$validator->setRule('password', 'Password', 'required|matches[confirmPwd]', array(
					'required' => 'Please specify a password',
					'matches' => 'Password does not match'
			));
			$validator->setRule('confirmPwd', 'Confirm password', 'required|matches[password]', array(
					'required' => 'Please specify a password',
					'matches' => 'Password does not match'
			));
			$validator->setRule('birthday', 'Birthday', 'required', array(
					'required' => 'Please specify you date of birth'
			));
	    	
	    	if($validator->run('btnRegister', 'register') === false) {
	    		$this->loadModel('Home');
	    		
	    		//verify there is no account already with the provided email address
	    		$id = $this->model->getUserByEmail($_POST['email']);
	    		if(count($id) > 0) {
	    			//account already exists
	    			$type = 'warning';
	    			$hide = false;
	    			$message = 'E-mail address already used. Please specify a different one';
	    		} else {
		    		$id = $this->model->register($_POST["name"], $_POST["lastname"],  $_POST["email"],  $_POST["password"],  $_POST["birthday"],  $_POST["gender"]);
		    		
		    		if($id > 0) {
		    			unset($_POST['password']);
		    			unset($_POST['confirmPwd']);
		    			unset($_POST['birthday']);
		    			unset($_POST['gender']);
		    			unset($_POST['btnRegister']);
		    			$this->session()->createSession($_POST);
		    			
		    			//simulates sending a registration mail for demo purposes
		    			$mailer = $this->emailer();
		    			$mailer->from(SMTP_USERNAME, 'MINI-FRAMEWORK');
		    			$mailer->addRecipient(SMTP_USERNAME, 'MINI-FRAMEWORK');
		    			$mailer->Subject = 'This is a test';
		    			$mailer->replyTo('no-reply@miniframework.com', 'MINI-FRAMEWORK no-reply');
		    			$mailer->msgHTML(file_get_contents(APP . '\view\_templates\_mail\contents.html'), APP . '\view\_templates\_mail');
		    			$mailer->sendMail();
		    			
		    			header('location: ' . URL . 'user/index');
						exit();
		    		} else {
		    			$type = 'danger';
		    			$hide = false;
		    			$message = 'We were unable to process your registration due to a system error</br>
								 	We apologize for the inconvenience this may cause</br>
								 	We will solve the problem as soon as possible';
		    			$this->clearFormData();
		    		}
	    		}
	    	}
    	}
    
    	// load views
    	require APP . 'view/_templates/header.php';
    	require APP . 'view/_templates/nav.header.php';
    	require APP . 'view/home/register.php';
    	require APP . 'view/home/modals/whybirthday.php';
    	require APP . 'view/_templates/footer.php';
    }
    
    public function signOut() {
    	$this->session()->destroySession();

    	header('location: ' . URL . 'home/index');
    	exit();
    }
}
