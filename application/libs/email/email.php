<?php
namespace Application\Libs\Email;

use Application\Core;
use PHPMailer;

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
 * 
 * Extends and uses class PHPMailer (https://github.com/PHPMailer/PHPMailer/) for sending mails.
 * 
 * You can use Gmail SMTP server to send mail, but you have to configure the Gmail accout that you will be using.
 * Head over to Account Security Settings (https://www.google.com/settings/security/lesssecureapps) and enable 
 * "Access for less secure apps", this allows you to use the google SMTP for clients other than the official ones.
 *
 **/
class Email extends PHPMailer {
		
	public function __construct() {
		parent::__construct(DEBUG);
		/**
		 * Create a new PHPMailer instance
		 * Passing true to the constructor enables the use of exceptions for error handling
		 */
		self::initialize();
	}
	
	public function __destruct() {}
	
	private function initialize() {
		//Tell PHPMailer to use SMTP
		if(IS_SMTP)
			$this->isSMTP();
		
		//Enable SMTP debugging
		// 0 = off (for production use)
		// 1 = client messages
		// 2 = client and server messages
		$this->SMTPDebug = SMTP_DEBUG;
		
		//Ask for HTML-friendly debug output
		$this->Debugoutput = DEBUG_OUTPUT;
		
		//Set the character set
		$this->CharSet = MAIL_CHARSET;
		
		//Set the hostname of the mail server
		$this->Host = MAIL_SERVER;
		
		//Set the SMTP port number - 587 for authenticated TLS, a.k.a. RFC4409 SMTP submission
		$this->Port = SMTP_PORT; // 465 or 587
		
		//Set the encryption system to use - ssl (deprecated) or tls
		$this->SMTPSecure = SMTP_SECURE; // ssl or tls
		
		//Whether to use SMTP authentication
		$this->SMTPAuth = SMTP_AUTH;
		
		//Username to use for SMTP authentication - use full email address for gmail
		$this->Username = SMTP_USERNAME;
		
		//Password to use for SMTP authentication
		$this->Password = SMTP_PWD;
	}
	
	/**
	 * Check that a string looks like an email address. It uses PHP built-in FILTER_VALIDATE_EMAIL
	 * to validate the email address
	 * @param string $address	- the email address to check
	 * @return true if $address has a valid address, false otherwise
	 **/
	private function addressValidator($address = null) {
		// if null is sent, return false as error. No need to validate
		if(is_null($address))
			return false;
		
		return $this->validateAddress($address, 'php');
	}
	
	/**
	 * Sets the email address of the sender
	 * @param string $address	- required parameter for specifying the email address of the sender
	 * @param string $name		- optional parameter for specifying the display name of the sender
	 * @return an instance of the class for chaining
	 **/
	public function from($address = null, $name = '') {		
		if(!$this->addressValidator($address))
			throw new Core\Exception('Invalid argument: from address is not a valid one');
		
		//Set who the message is to be sent from
		return $this->setFrom($address, $name);
	}
	
	/**
	 * Set an alternative reply-to address 
	 * @param string $address	- required parameter for specifying an alternative reply-to address
	 * @param string $name		- optional parameter for specifying an alternative display name
	 * @return boolean true on success, false if address already used or invalid in some way
	 **/
	public function replyTo($address = null, $name = '') {
		if(!$this->addressValidator($address))
			throw new Core\Exception('Invalid argument: from address is not a valid one');

		// Set an alternative reply-to address
		return $this->addReplyTo($address, $name);
	}
	
	/**
	 * Set who the message is to be sent to
	 * @param string $address	- required parameter for specifying the email address of the receiver
	 * @param string $name		- optional parameter for specifying the display name of the receiver
	 * @return boolean true on success, false if address already used or invalid in some way
	 **/
	public function addRecipient ($address = null, $name = '') {
		if(!$this->addressValidator($address))
			throw new Core\Exception('Invalid argument: from address is not a valid one');

		return $this->addAddress($address, $name);
	}
	
	/**
	 * Add a "CC" address.
	 * @note: This function works with the SMTP mailer on win32, not with the "mail" mailer.
	 * @param string $address	- required parameter for specifying the email address
	 * @param string $name		- optional parameter for specifying the display name
	 * @return boolean true on success, false if address already used or invalid in some way
	 **/
	public function addCCAddress($address = null, $name = '') {
		if(!$this->addressValidator($address))
			throw new Core\Exception('Invalid argument: address is not a valid one');
	
		//Set who the message is to be sent from
		return $this->addCC($address, $name);
	}
	
	/**
	 * Add a "BCC" address
	 * @param string $address	- required parameter for specifying the email address
	 * @param string $name		- optional parameter for specifying the display name
	 * @return boolean true on success, false if address already used or invalid in some way
	 **/
	public function addBCCAddess($address = null, $name = '') {
		if(is_null($address))
			throw new Core\Exception('Missing argument: address was not specified');
	
		if(!$this->validateAddress($address))
			throw new Core\Exception('Invalid argument: address is not a valid one');
	
		//Set who the message is to be sent from
		return $this->addBCC($address, $name);
	}
	
	/**
	 * Creates a message and sends it.
	 * @returns boolean false on error
	 **/
	public function sendMail() {
		if(!$this->send())
			throw new phpmailerException('Email could not be sent: ' . $this->ErrorInfo);
	}
}