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
namespace Application\Libs\File;

use Application\Core;

class Upload extends FileBase {

	private $uploadPath;			// The path to the directory where the upload should be placed. The directory must be writable and the path can be absolute or relative.
	private $allowedExtension;		// An array corresponding to the types of files you allow to be uploaded. The file extension can be used as the mime type.
	private $filename;				// If set, the uploaded file will be renamed to this name. The extension provided in the file name must also be an allowed extension type. If no extension is provided, the one provided in the original file will be used.
	private $encrypt;				// If true, the filename will be replace with an encrypted random filename
	private $maxFilesize;			// The maximum size (in kilobytes) that the file can be. Set to zero for no limit. Note: Most PHP installations have their own limit, as specified in the php.ini file. Usually 2 MB (or 2048 KB) by default.

	public function __construct($config = array()) {
		if(empty($config)) {
			$this->uploadPath = UPLOAD_PATH;
			$this->allowedExtension = unserialize(UPLOAD_ALLOWED_EXTENSIONS);
			$this->filename = UPLOAD_FILENAME;
			$this->encrypt = UPLOAD_ENCRYPT_FILENAME;
			$this->maxFilesize = UPLOAD_MAX_FILESIZE;
		}

		parent::__construct();
	}

	public function __destruct() {}

	public function getUploadPath() {
		return $this->uploadPath;
	}
	public function setUploadPath($uploadPath) {
		$this->uploadPath = $uploadPath;
	}

	public function getAllowedExtension() {
		return $this->allowedExtension;
	}
	public function setAllowedExtension($allowedExtension) {
		$this->allowedExtension = $allowedExtension;
	}

	public function getFilename() {
		return $this->filename;
	}
	public function setFilename($filename) {
		$this->filename = $filename;
	}

	public function getEncrypt() {
		return $this->encrypt;
	}
	public function setEncrypt($encrypt) {
		$this->encrypt = $encrypt;
	}

	public function getMaxFilesize() {
		return $this->maxFilesize;
	}
	public function setMaxFilesize($maxFilesize) {
		$this->maxFilesize = $maxFilesize;
	}

	/**
	 * Uploads the file specified by $file. If $filename is specified, the uploaded file is renamed
	 * @param array|$_FILE $file	- the file that will be uploaded
	 * @param string $filename		- if specified, the name to which the file must be renamed to
	 * @throws Core\Exception
	 * @return true if the file was successfully uploaded, otherwise false
	 **/
	public function doUpload($file = array(), $filename = '') {
		if(empty($file))
			throw new Core\Exception('Invalid argument: file not specified');

			if($file['error'] > UPLOAD_ERR_OK) {
				$this->setError($file['error']);
				return false;
			}
				
			$properties = $this->getFileProperties($file);

			if(!$this->encrypt) {
				// If a name was specified for the file, use it. Otherwise, use the same name as the uploaded file
				if(!empty($filename))
					$this->filename = $filename;
					else
						$this->filename = $properties['name'];
			} else
				$this->filename = md5(uniqid(mt_rand())). '.' . $properties['extension'];

				/**
				 * Returns TRUE if the file named by filename was uploaded via HTTP POST. This is useful to help ensure that a malicious user
				 * hasn't tried to trick the script into working on files upon which it should not be working--for instance, /etc/passwd.
				 * This sort of check is especially important if there is any chance that anything done with uploaded files could reveal their
				 * contents to the user, or even to other users on the same system.
				 **/
				if(!is_uploaded_file($file['tmp_name'])) {
					$this->setError(UPLOAD_ERR_NO_FILE);
					return false;
				}

				if(!in_array($properties['extension'], $this->allowedExtension, true)) {
					$this->setError(UPLOAD_ERR_EXTENSION);
					return false;
				}

				if($properties['size'] > $this->maxFilesize) {
					$this->setError(UPLOAD_ERR_MAX_FILE_SIZE);
					return false;
				}

				/**
				 * Move the file to the final destination
				 * To deal with different server configurations we'll attempt to use copy() first. If that fails
				 * we'll use move_uploaded_file(). One of the two should reliably work in most environments
				 **/
				if(!@copy($properties['tempName'], $this->uploadPath.$this->filename)) {
					if(!@move_uploaded_file($properties['tempName'], $this->uploadPath.$this->filename)) {
						$this->setError(UPLOAD_ERR_DESTINATION);
						return false;
					}
				}

				return true;
	}
}