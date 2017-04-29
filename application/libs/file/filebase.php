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
* @link			https://github.com/canchito-dev/mini-framework-mvc
**/
namespace Application\Libs\File;

use Application\Core;

define('UPLOAD_ERR_MAX_FILE_SIZE', 9);
define('UPLOAD_ERR_MOVE', 10);
define('UPLOAD_ERR_DESTINATION', 11);
define('IMG_ERR_DIMENSIONS', 12);
define('IMG_ERR_CREATE', 13);
define('IMG_ERR_COPY_RESAMPLED', 14);
define('IMG_ERR_ALPHA_BLENDING', 15);
define('IMG_ERR_SAVE_ALPHA', 16);
define('IMG_COLOR_ALLOCATED_ALPHA', 17);
define('IMG_ERR_FILLED_RECTANGLE', 18);
define('IMG_ERR_NOT_SAVE', 19);
define('IMG_ERR_NOT_DESTROY', 20);


class FileBase {

	/**
	 * @var array $errors
	 * An array containing all the errors found during the file processing
	 **/
	protected $errors;

	public function __construct() {
		$this->errors = array();
	}

	public function __destruct() {}

	public function getErrors() {
		return $this->errors;
	}

	/**
	 * Sets the error message based on the code passed as argument
	 * @param string $code - the code specifying the error
	 **/
	protected function setError($code) {
		switch($code) {
			case UPLOAD_ERR_INI_SIZE:
				$this->errors[] = "The uploaded file exceeds the upload_max_filesize directive in php.ini";
				break;
			case UPLOAD_ERR_FORM_SIZE:
				$this->errors[] = "The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form";
				break;
			case UPLOAD_ERR_PARTIAL:
				$this->errors[] = "The uploaded file was only partially uploaded";
				break;
			case UPLOAD_ERR_NO_FILE:
				$this->errors[] = "No file was uploaded";
				break;
			case UPLOAD_ERR_NO_TMP_DIR:
				$this->errors[] = "Missing a temporary folder";
				break;
			case UPLOAD_ERR_CANT_WRITE:
				$this->errors[] = "Failed to write file to disk";
				break;
			case UPLOAD_ERR_EXTENSION:
				$this->errors[] = "File upload stopped by extension";
				break;
			case UPLOAD_ERR_MAX_FILE_SIZE:
				$this->errors[] = "The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the configuration";
				break;
			case UPLOAD_ERR_MOVE:
				$this->errors[] = "File could not be moved to its final repository";
				break;
			case UPLOAD_ERR_DESTINATION:
				$this->errors[] = "The uploaded file could not be move to the UPLOAD_PATH directive that was specified in the configuration";
				break;
			case IMG_ERR_DIMENSIONS:
				$this->errors[] = "The uploaded file exceeds the MAX_ and MIN_ dimension directive for the width and height that was specified in the configuration";
				break;
			case IMG_ERR_CREATE:
				$this->errors[] = "Could not create image from file or URL";
				break;
			case IMG_ERR_COPY_RESAMPLED:
				$this->errors[] = "Could not copy and resize part of an image with resampling";
				break;
			case IMG_ERR_ALPHA_BLENDING:
				$this->errors[] = "Could not create alpha blending image";
				break;
			case IMG_ERR_SAVE_ALPHA:
				$this->errors[] = "Could not save alpha image";
				break;
			case IMG_COLOR_ALLOCATED_ALPHA:
				$this->errors[] = "Could not create color allocated alpha image";
				break;
			case IMG_ERR_FILLED_RECTANGLE:
				$this->errors[] = "Could not create a filled rectangle image";
				break;
			case IMG_ERR_NOT_SAVE:
				$this->errors[] = "Could not save image";
				break;
			case IMG_ERR_NOT_DESTROY:
				$this->errors[] = "Could not destroy image from resource";
				break;
			default:
				$this->errors[] = "Unknown file error";
				break;
		}
	}

	/**
	 * Gets the properties of the recently uploaded file
	 * @param array $file	- an array of type $_FILES containing the uploaded file
	 * @throws Core\Exception if the parameter $file was not specified
	 * @return an array with the file properties
	 **/
	protected function getFileProperties($file = array()) {
		if(empty($file))
			throw new Core\Exception('Invalid argument: file not specified');

			$properties = array();

			//The original name of the file on the client machine
			$properties['name'] = $file['name'];
			//The temporary filename of the file in which the uploaded file was stored on the server.
			$properties['tempName'] = $file['tmp_name'];
			//The size, in bytes, of the uploaded file
			$properties['size'] = $file['size'];
			/**
			 * The mime type of the file, if the browser provided this information. An example would be "image/gif".
			 * This mime type is however not checked on the PHP side and therefore don't take its value for granted
			 **/
			$properties['type'] = $file['type'];
			$properties['basename'] = pathinfo($file['name'], PATHINFO_BASENAME);
			$properties['filename'] = pathinfo($file['name'], PATHINFO_FILENAME);
			$properties['extension'] = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
			$properties['error'] = isset($file['error']) ? $file['error'] : 4;

			if($this->isImage($properties['type'])) {
				$imgProperties = $this->setImageProperties($properties['tempName']);
				foreach($imgProperties as $key => $value)
					$properties[$key] = $value;
			}
			return $properties;
	}


	/**
	 * Verifies if the passed type is a valid image or not
	 * @param string $fileType	- the type of file to analyze and verify if it is an image or not
	 * @return return true if the specify type is an image, otherwise false
	 **/
	protected function isImage($fileType = '') {
		if(empty($fileType))
			return false;

			$pngMimes  = array('image/x-png');
			$jpegMimes = array('image/jpg', 'image/jpe', 'image/jpeg', 'image/pjpeg');

			if (in_array($fileType, $pngMimes)) {
				$fileType = 'image/png';
			} elseif (in_array($fileType, $jpegMimes)) {
				$fileType = 'image/jpeg';
			}

			$imgMimes = array('image/gif',	'image/jpeg', 'image/png');
			return in_array($fileType, $imgMimes, true);
	}


	/**
	 * Retreives the image properties
	 * @param string $path	- the path where the image is
	 * @throws Core\Exception
	 * @return an array containing the image properties
	 */
	protected function setImageProperties($path = '') {
		if(empty($path))
			throw new Core\Exception('Invalid argument: path not specified');

			$properties = array();

			if(function_exists('getimagesize')) {
				if(false !== ($D = @getimagesize($path))) {
					$types = array(1 => 'gif', 2 => 'jpeg', 3 => 'png');
					$properties['imgWidth'] = $D[0];
					$properties['imgHeight'] = $D[1];
					$properties['imgType'] = isset($types[$D[2]]) ? $types[$D[2]] : 'unknown';
					$properties['imgSizeStr'] = $D[3]; // string containing height and width
						
					// Cannot get exif data if image is not jpeg
					if($properties['imgType'] == 'jpeg') {
						$properties['exif'] = exif_read_data($path);


						if(!empty($properties['exif']['Orientation'])) {
							switch($properties['exif']['Orientation']) {
								case 8:
								case 3:
								case 6:
									$tmp = $properties['imgWidth'];
									$properties['imgWidth'] = $properties['imgHeight'];
									$properties['imgHeight'] = $tmp;
									$properties['imgSizeStr'] = 'width="' . $properties['imgWidth'] . '" height="' . $properties['imgHeight'] . '"';
									break;
							}
						}
					} else
						$properties['exif'] = false;
				}
			}
			return $properties;
	}
}