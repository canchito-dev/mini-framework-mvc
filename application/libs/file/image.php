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

class Image extends FileBase {

	private $quality;
	private $compressionLevel;
	private $maxWidth;
	private $maxHeight;
	private $thumbnailFolder;
	private $thumbMaxWidth;
	private $thumbMaxHeight;
	private $properties;

	public function __construct($config = array()) {
		if(empty($config)) {
			$this->quality = IMG_QUALITY;
			$this->compressionLevel = IMG_COMPRESSION_LEVEL;
			$this->maxWidth = IMG_MAX_WIDTH;
			$this->maxHeight = IMG_MAX_HEIGHT;
			$this->thumbnailFolder = IMG_THUMBNAIL_FOLDER;
			$this->thumbMaxWidth = IMG_THUMB_MAX_WIDTH;
			$this->thumbMaxHeight = IMG_THUMB_MAX_HEIGHT;
		}

		parent::__construct();
	}

	public function __destruct() {}

	public function getQuality() {
		return $this->quality;
	}
	public function setQuality($quality) {
		$this->quality = $quality;
	}

	public function getCompressionLevel() {
		return $this->compressionLevel;
	}
	public function setCompressionLevel($compressionLevel) {
		$this->compressionLevel = $compressionLevel;
	}

	public function getMaxWidth() {
		return $this->maxWidth;
	}
	public function setMaxWidth($maxWidth) {
		$this->maxWidth = $maxWidth;
	}

	public function getMaxHeight() {
		return $this->maxHeight;
	}
	public function setMaxHeight($maxHeight) {
		$this->maxHeight = $maxHeight;
	}

	public function getThumbnailFolder() {
		return $this->thumbnailFolder;
	}
	public function setThumbnailFolder($thumbnailFolder) {
		$this->thumbnailFolder = $thumbnailFolder;
	}

	public function getThumbMaxWidth() {
		return $this->thumbMaxWidth;
	}
	public function setThumbMaxWidth($thumbMaxWidth) {
		$this->thumbMaxWidth = $thumbMaxWidth;
	}

	public function getThumbMaxHeight() {
		return $this->thumbMaxHeight;
	}
	public function setThumbMaxHeight($thumbMaxHeight) {
		$this->thumbMaxHeight = $thumbMaxHeight;
	}

	public function getProperties() {
		return $this->properties;
	}
	public function setProperties($path) {
		$this->properties = $this->setImageProperties($path);
	}

	/**
	 * Resizes an image file to the values specified by IMG_MAX_-WIDTH and -HEIGHT
	 * @param string $filename	- The filename including the path
	 * @throws Core\Exception
	 * @return true on success, otherwise false
	 **/
	public function resize($filename = null) {
		if(is_null($filename) || empty($filename) || $filename == '')
			throw new Core\Exception('Invalid argument: file not specified');

			$this->setProperties($filename);
			$width = $this->properties['imgWidth'];
			$height = $this->properties['imgHeight'];

			// Calculate ratio of desired maximum sizes and original sizes.
			$widthRatio = $this->maxWidth / $width;
			$heightRatio = $this->maxHeight / $height;

			// Ratio used for calculating new image dimensions.
			$ratio = min($widthRatio, $heightRatio);

			$width = $width * $ratio;
			$height = $height * $ratio;

			$dimensions = array(
					'orgWidth' => $this->properties['imgWidth'],
					'orgHeight' => $this->properties['imgHeight'],
					'newWidth' => $width,
					'newHeight' => $height
			);

			$this->doResize($filename, $this->properties['imgType'], $dimensions);

			$this->setProperties($filename);
	}

	/**
	 * Creates an image thumbnail of size specified by IMG_THUMB_MAX_-WIDTH and -HEIGHT
	 * @param string $filename	- The filename including the path
	 * @throws Core\Exception
	 * @return true on success, otherwise false
	 **/
	public function thumbnail($filename = null) {
		if(is_null($filename) || empty($filename) || $filename == '')
			throw new Core\Exception('Invalid argument: file not specified');

			$this->setProperties($filename);
			$width = $this->properties['imgWidth'];
			$height = $this->properties['imgHeight'];

			// Calculate ratio of desired maximum sizes and original sizes.
			$widthRatio = $this->thumbMaxWidth / $width;
			$heightRatio = $this->thumbMaxHeight / $height;

			// Ratio used for calculating new image dimensions.
			$ratio = min($widthRatio, $heightRatio);

			$width = $width * $ratio;
			$height = $height * $ratio;

			$dimensions = array(
					'orgWidth' => $this->properties['imgWidth'],
					'orgHeight' => $this->properties['imgHeight'],
					'newWidth' => $width,
					'newHeight' => $height
			);

			$this->doResize($filename, $this->properties['imgType'], $dimensions);

			$this->setProperties($filename);
	}

	private function doResize($filename = null, $type = 'gif', $dimensions = array()) {
		if(is_null($filename) || empty($filename) || $filename == '')
			throw new Core\Exception('Invalid argument: file not specified');

			if(is_null($dimensions) || empty($dimensions) || !is_array($dimensions))
				throw new Core\Exception('Invalid argument: dimensions not specified');

				/**
				 * Create a new image from file or URL
				 * Returns an image resource identifier on success, FALSE on errors.
				 **/
				switch($type) {
					case 'gif': $imgIn = @imagecreatefromgif($filename); break;
					case 'jpeg': $imgIn = @imagecreatefromjpeg($filename);  break;
					case 'png': $imgIn = @imagecreatefrompng($filename); break;
					default:
						$this->setError(UPLOAD_ERR_EXTENSION);
						return false;
						break;
				}

				if(!$imgIn) {
					$this->setError(IMG_ERR_CREATE);
					return false;
				}

				if($type == 'jpeg') {
					//The following code will ensure that all uploaded photos will be oriented correctly upon upload:
					$exif = exif_read_data($filename);
					if(!empty($exif['Orientation'])) {
						switch($exif['Orientation']) {
							case 8:
								$imgIn = imagerotate($imgIn, 90, 0);
								break;
							case 3:
								$imgIn = imagerotate($imgIn, 180, 0);
								break;
							case 6:
								$imgIn = imagerotate($imgIn, -90, 0);
								break;
						}
					}
				}
					
				/**
				 * Create a new true color image
				 * Returns an image identifier representing a black image of the specified size
				 **/
				$imgOut = @imagecreatetruecolor($dimensions['newWidth'], $dimensions['newHeight']);
				if(!$imgOut) {
					$this->setError(IMG_ERR_CREATE);
					return false;
				}

				// Check if this image is PNG or GIF, then set if transparent
				if(($type == 'gif') || ($type == 'png')) {
					// Set the blending mode for an image
					if(!@imagealphablending($imgOut, false)) {
						$this->setError(IMG_ERR_ALPHA_BLENDING);
						return false;
					}
					// Set the flag to save full alpha channel information (as opposed to single-color transparency) when saving PNG images
					if(!@imagesavealpha($imgOut, true)) {
						$this->setError(IMG_ERR_SAVE_ALPHA);
						return false;
					}
					// Allocate a color for an image
					$transparent = @imagecolorallocatealpha($imgOut, 255, 255, 255, 127);
					if(!$transparent) {
						$this->setError(IMG_COLOR_ALLOCATED_ALPHA);
						return false;
					}
						
					// Creates a rectangle filled with color in the given image starting at point 1 and ending at point 2. 0, 0 is the top left corner of the image.
					if(!@imagefilledrectangle($imgOut, 0, 0, $dimensions['newWidth'], $dimensions['newHeight'], $transparent)) {
						$this->setError(IMG_ERR_FILLED_RECTANGLE);
						return false;
					}
				}

				/**
				 * Copy and resize part of an image with resampling. Copies a rectangular portion of one image to
				 * another image, smoothly interpolating pixel values so that, in particular, reducing the size of
				 * an image still retains a great deal of clarity.
				 **/
				if(!@imagecopyresampled($imgOut, $imgIn, 0, 0, 0, 0, $dimensions['newWidth'], $dimensions['newHeight'], $dimensions['orgWidth'], $dimensions['orgHeight'])) {
					$this->setError(IMG_ERR_COPY_RESAMPLED);
					return false;
				}

				/**
				 * Output image to browser or file
				 **/
				$output = false;
				switch($type) {
					case 'gif': $output = @imagegif($imgOut, $filename); break;
					case 'jpeg': $output = @imagejpeg($imgOut, $filename, IMG_QUALITY);  break; // best quality
					case 'png': $output = @imagepng($imgOut, $filename, IMG_QUALITY); break; // no compression
					default:
						$this->setError(UPLOAD_ERR_EXTENSION);
						return false;
						break;
				}

				if(!$output) {
					$this->setError(IMG_ERR_NOT_SAVE);
					return false;
				}

				// Frees any memory associated with image
				if(!@imagedestroy($imgOut) || !@imagedestroy($imgIn)) {
					$this->setError(IMG_ERR_NOT_DESTROY);
					return false;
				}

				return true;
	}
}