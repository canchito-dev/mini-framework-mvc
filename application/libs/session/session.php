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
namespace Application\Libs\Session;

use Application\Core;

class Session {
	
	private static $instance;
	
	private function __construct() {
		/**
		 * The session is started automatically with the constructor
		 **/
		if (session_status() === PHP_SESSION_NONE) {
			session_start();
			$_SESSION['SESSION_CREATED_TIMESTAMP'] = time();
		}
	}
	
	public function __destruct() {}
	
	public static function getInstance() {
		if(empty(self::$instance))
			self::$instance = new Session();
		return self::$instance;
	}
	
	/**
	 * Checks if the session is disabled or not
	 * @return true if the session is disable, false otherwise
	 **/
	public function isSessionDisable() {
		return session_status() === PHP_SESSION_DISABLED ? true : false;
	}
	
	/**
	 * Checks if the session is active. A session is considered active if:
	 * 1) sessions are enabled, but none exists; or
	 * 2) sessions are enabled, and one exists; and
	 * 3) the difference between the session's creation timestamp and the current
	 *    timestamp is less than the value specified by the constant MAX_INACTIVE_SESSION 
	 * @return true if the sessions are enabled, false otherwise
	 **/
	public function isSessionActive() {
		if(session_status() === PHP_SESSION_NONE || session_status() === PHP_SESSION_ACTIVE) {
			if(time() - $_SESSION['SESSION_CREATED_TIMESTAMP'] < MAX_INACTIVE_SESSION) {
				$_SESSION['SESSION_CREATED_TIMESTAMP'] = time();
				return true;
			}
		}
		return false;
	}
	
	/**
	 * Creates and sets a session variable. The function accepts a string or an associative array, where 
	 * the key is the variable name and the value is the actual value of the variable
	 * @param string|array $data	- if $data is a string, it is considered as the session variable name.
	 * @param string	   $value	- value of the session variable. Only used if $data is a string.
	 * @return an instance of the class for chaining  
	 **/
	public function setVariable($data = array(), $value = null) {
		if(!$this->isSessionActive())
			return $this;
		
		if(is_array($data)) {
			if(!empty($data) && !is_null($data)) {
				foreach ($data as $key => $value)
					$_SESSION[$key] = $value;
			}
		} else {
			if(!empty($data) && !is_null($data))
				$_SESSION[$data] = $value;
		}
		
		return $this;
	}
	
	/**
	 * Unsets a session variable but only if exists
	 * @param string|array $data	- if $data is a string, it is considered to be the session variable name
	 * @return an instance of the class for chaining  
	 **/
	public function unsetVariable($data = array()) {
		if(!$this->isSessionActive())
			return $this;
		
		if(is_array($data)) {
			if(!empty($data) && !is_null($data)) {
				foreach ($data as $key) {
					if($this->hasVariable($key))
						unset($_SESSION[$key]);
				}
			}
		} else {
			if(!empty($data) && !is_null($data)) {
				if(isset($_SESSION[$data]))
					unset($_SESSION[$data]);
			}
		}
		
		return $this;
	}
	
	/**
	 * Checks if a session variable exists.
	 * @param string $key	- the name of the variable which needs to be verified of its existance
	 * @return true if it exists, false otherwise
	 **/
	public function hasVariable($key = null) {
		if(!$this->isSessionActive())
			throw new Core\Exception('Session is not active or none existing');
		
		if(!is_null($key)) {
			if(isset($_SESSION[$key]))
				return true;
		}
		return false;
	}
	
	/**
	 * Gets the value of a session variable
	 * @param string $key	- the name of the variable which needs to be verified of its existance
	 * @return the value of the session variable if it exists, false otherwise
	 **/
	public function getVariable($key = null) {
		if(!$this->isSessionActive())
			throw new Core\Exception('Session is not active or none existing');
		
		if(!$this->hasVariable($key))
			return false;
	
		return $_SESSION[$key];
	}
	
	/**
	 * Update the current session id with a newly generated one. It will replace the current session 
	 * id with a new one, and keep the current session information.
	 * @param boolean $deleteOldSession - Whether to delete the old associated session file or not.
	 * @return true on success, false otherwise
	 **/
	public function regenerateId($deleteOldSession = true) {
		return session_regenerate_id($deleteOldSession);    // change session ID for the current session and invalidate old session ID
	}
	
	/**
	 *  Get and/or set the current session id
	 *  @return the session id for the current session or the empty string ("") if there is no current 
	 *  		session (no current session id exists).
	 **/
	public function sessionId() {
		return session_id();
	}
	
	/**
	 * Destroys current session
	 **/
	public function destroySession() {
		session_unset();
		session_destroy();
		session_write_close();
		setcookie(session_name(), '', time() - 300);
		$_SESSION = array();
	}
	
	/**
	 * Creates the user's session. It automatically generates a session variable called
	 * SID with the id of the current session. In addition, you can add other session
	 * variables by passing the $data parameter.
	 * @param array $data	- an associative array where the key is the variable name and
	 * the value is the value of the variable
	 * @returns true if the session was successfully created, false otherwise
	 **/
	public function createSession($data = array()) {
		if(!$this->isSessionActive())
			return false;
		
		$data['SID'] = $this->sessionId();
		$this->setVariable($data);
		
		return true;
	}
}