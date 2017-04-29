<?php
/**
 * This content is released under the MIT License (MIT)
 *
 * Copyright (c) 2016, MINI3 - an extremely simple naked PHP application
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
 * @author 		Panique
 * @copyright	Copyright (c) 2016, MINI3 - an extremely simple naked PHP application
 * @license		http://opensource.org/licenses/MIT	MIT License
 * @link		https://github.com/panique/mini3
 * 
 * @author 		Jose Carlos Mendoza Prego
 * @copyright	Copyright (c) 2016, canchito-dev (http://www.canchito-dev.com)
 * @license		http://opensource.org/licenses/MIT	MIT License
 * @link		https://github.com/canchito-dev/mini-framework-mvc
 **/

/**
 * Configuration for: Error reporting
 * Useful to show every little problem during development, but only show hard errors in production
 **/
define('DEBUG', true);

if (DEBUG) {
    error_reporting(E_ALL);
    ini_set("display_errors", 1);
}

/**
 * Site main title
 **/
define('SITE_TITLE', 'MINI-FRAMEWORK-MVC is an extremely simple and easy to understand PHP framework. MINI-FRAMEWORK-MVC is NOT a professional framework. As a result, it does not come with all the features and functionalities that real frameworks have. It is limited to a very reduce number of helper libraries');

/**
 * SMTP needs accurate times, and the PHP time zone MUST be set. This should be done in your php.ini, 
 * but this is how to do it if you don't have access to that 
 **/
date_default_timezone_set('Europe/Madrid');

/**
 * This sets the maximum amount of memory in bytes that a script is allowed to allocate. This helps 
 * prevent poorly written scripts for eating up all available memory on a server. Note that to have 
 * no memory limit, set this directive to -1.
 **/
ini_set('memory_limit', '512M');

/**
 * Configuration for: URL
 * Here we auto-detect your applications URL and the potential sub-folder. Works perfectly on most servers and in local
 * development environments (like WAMP, MAMP, etc.). Don't touch this unless you know what you do.
 *
 * URL_PUBLIC_FOLDER:
 * The folder that is visible to public, users will only have access to that folder so nobody can have a look into
 * "/application" or other folder inside your application or call any other .php file than index.php inside "/public".
 *
 * URL_PROTOCOL:
 * The protocol. Don't change unless you know exactly what you do.
 *
 * URL_DOMAIN:
 * The domain. Don't change unless you know exactly what you do.
 *
 * URL_SUB_FOLDER:
 * The sub-folder. Leave it like it is, even if you don't use a sub-folder (then this will be just "/").
 *
 * URL:
 * The final, auto-detected URL (build via the segments above). If you don't want to use auto-detection,
 * then replace this line with full URL (and sub-folder) and a trailing slash.
 **/

define('URL_PUBLIC_FOLDER', 'public');
define('URL_PROTOCOL', 'http://');
define('URL_DOMAIN', $_SERVER['HTTP_HOST']);
define('URL_SUB_FOLDER', str_replace(URL_PUBLIC_FOLDER, '', dirname($_SERVER['SCRIPT_NAME'])));
define('URL', URL_PROTOCOL . URL_DOMAIN . URL_SUB_FOLDER);
define('CHARSET', 'utf-8');

/**
 * Configuration for: Database
 * This is the place where you define your database credentials, database type etc.
 **/
define('DB_TYPE', 'mysql');
define('DB_HOST', '127.0.0.1');
define('DB_NAME', 'db_mini');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_CHARSET', 'utf8');

/**
 * Configuration for: Email Lib
 * This is the place where you define the mail server credentials, account, etc
 * 
 * SMTP_DEBUG variable enables SMTP debugging
 * 0 = off (for production use)
 * 1 = client messages
 * 2 = client and server messages
 **/
define('IS_SMTP', true); 								//Tell PHPMailer to use SMTP
define('MAIL_SERVER', 'smtp.gmail.com'); 				//Set the hostname of the mail server
define('SMTP_PORT', 587); 								//Set the SMTP port number - 587 for authenticated TLS, a.k.a. RFC4409 SMTP submission
define('SMTP_USERNAME', 'your.mail@gmail.com'); 		//Username to use for SMTP authentication - use full email address for gmail
define('SMTP_PWD', 'your.password');					//Password to use for SMTP authentication
define('SMTP_DEBUG', 0);								//Enable SMTP debugging
define('SMTP_SECURE', 'tls');							//Set the encryption system to use - ssl (deprecated) or tls
define('SMTP_AUTH', true);								//Whether to use SMTP authentication
define('MAIL_CHARSET', 'UTF-8');						//Set the character set
define('DEBUG_OUTPUT', 'html');							//Ask for HTML-friendly debug output. Default is html

/**
 * Configuration for: session
 **/
define('MAX_INACTIVE_SESSION', 1800);				// max duration for an inactive session

/**
 * Configuration: Upload Lib
 **/
define('UPLOAD_PATH', '../public/img/');			// The path to the directory where the upload should be placed. The directory must be writable and the path can be absolute or relative.
define('UPLOAD_ALLOWED_EXTENSIONS', serialize (array ('jpg', 'jpeg', 'png')));		// An array corresponding to the types of files you allow to be uploaded. The file extension can be used as the mime type.
define('UPLOAD_FILENAME', '');						// If set, the uploaded file will be renamed to this name. The extension provided in the file name must also be an allowed extension type. If no extension is provided, the one provided in the original file will be used.
define('UPLOAD_ENCRYPT_FILENAME', true);			// If true, the filename will be replace with an encrypted random filename
define('UPLOAD_MAX_FILESIZE', 10000000);			// The maximum size (in kilobytes) that the file can be. Set to zero for no limit. Note: Most PHP installations have their own limit, as specified in the php.ini file. Usually 2 MB (or 2048 KB) by default.

/**
 * Configuration: Image Lib
 **/
define('IMG_QUALITY', 100);						// Ranges from 0 (worst quality, smaller file) to 100 (best quality, biggest file)
define('IMG_COMPRESSION_LEVEL', 9);
define('IMG_MAX_WIDTH', 1380);					// The maximum width (in pixels) that the image can be. Set to zero for no limit.
define('IMG_MAX_HEIGHT', 920);					// The maximum height (in pixels) that the image can be. Set to zero for no limit.
define('IMG_THUMBNAIL_FOLDER', '../public/img/thumbs/');
define('IMG_THUMB_MAX_WIDTH', 314);				// The maximum width (in pixels) that the thumbnail image can be. Set to zero for no limit.
define('IMG_THUMB_MAX_HEIGHT', 209);			// The maximum height (in pixels) that the thumbnail image can be. Set to zero for no limit.

/**
 * Configuration: Pagination
 **/
define('NUMBER_OF_ITEMS_PER_PAGE', 10);				// Max number of items to list in each page