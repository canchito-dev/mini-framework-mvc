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
namespace Application\Libs\Methods;

class PasswordMethods {
	private function __construct() {}
	
	private function __clone() {}
	
	/**
	 * @author Corey Ballou
	 * http://blackbe.lt/php-secure-sessions/
	 * 
	 * Generates a secure, pseudo-random password with a safe fallback.
	 **/
	public static function pseudoRand($length) {
		if (function_exists('openssl_random_pseudo_bytes')) {
			$is_strong = false;
			$rand = openssl_random_pseudo_bytes($length, $is_strong);
			if ($is_strong === true) return $rand;
		}
		$rand = '';
		$sha = '';
		for ($i = 0; $i < $length; $i++) {
			$sha = hash('sha256', $sha . mt_rand());
			$chr = mt_rand(0, 62);
			$rand .= chr(hexdec($sha[$chr] . $sha[$chr + 1]));
		}
		return $rand;
	}
	
	/**
	 * Creates a very secure password hash using a strong one-way hashing algorithm.
	 * The following algorithms are currently supported:
	 * 		PASSWORD_DEFAULT	-	Use the bcrypt algorithm (default as of PHP 5.5.0). Note that this constant is designed to 
	 * 								change over time as new and stronger algorithms are added to PHP. For that reason, the length 
	 * 								of the result from using this identifier can change over time. Therefore, it is recommended to 
	 * 								store the result in a database column that can expand beyond 60 characters (255 characters 
	 * 								would be a good choice).
	 * 		PASSWORD_BCRYPT		- 	Use the CRYPT_BLOWFISH algorithm to create the hash. This will produce a standard crypt() 
	 * 								compatible hash using the "$2y$" identifier. The result will always be a 60 character string, 
	 * 								or FALSE on failure.
	 * 
	 * @param string $string - The string to hash
	 * @param string $algo	 - The algorithm to use
	 * @returns: Returns the hashed password, or FALSE on failure.
	 * 
	 * Note: The used algorithm, cost and salt are returned as part of the hash. Therefore, all information that's needed to verify 
	 * 		 the hash is included in it. This allows the password_verify() function to verify the hash without needing separate 
	 * 		 storage for the salt or algorithm information.
	 **/
	public static function createHash($string, $algo = PASSWORD_BCRYPT) {
		return password_hash($string, $algo);
	}
	
	/**
	 * Verifies that a password matches a hash
	 * @param string $string		- The string to verify
	 * @param string $hashedString 	- The hashed string
	 * @returns TRUE if the password and hash match, or FALSE otherwise.
	 **/
	public static function validatePassword($string, $hashedString) {
		return password_verify($string, $hashedString);
	}
}