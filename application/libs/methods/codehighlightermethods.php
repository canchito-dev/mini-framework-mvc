<?php
/**
 * Please visit http://php.net/manual/es/function.highlight-string.php#118550
 **/
namespace Application\Libs\Methods;

class CodeHighlighterMethods {

	public function __construct() {}
	
	public function __destruct() {}

	private function __clone() {}
	
	public static function highlightText($text, $fileExt="") {
	    if ($fileExt == "php") {
	        ini_set("highlight.comment", "#008000");
	        ini_set("highlight.default", "#000000");
	        ini_set("highlight.html", "#808080");
	        ini_set("highlight.keyword", "#0000BB; font-weight: bold");
	        ini_set("highlight.string", "#DD0000");
	    } else if ($fileExt == "html") {
	        ini_set("highlight.comment", "green");
	        ini_set("highlight.default", "#CC0000");
	        ini_set("highlight.html", "#000000");
	        ini_set("highlight.keyword", "black; font-weight: bold");
	        ini_set("highlight.string", "#0000FF");
	    }
	
	    $text = trim($text);
	    $text = highlight_string($text, true);  // highlight_string() requires opening PHP tag or otherwise it will not colorize the text
	    $text = trim($text);
	    $text = preg_replace("|^\\<code\\>\\<span style\\=\"color\\: #[a-fA-F0-9]{0,6}\"\\>|", "", $text, 1);  // remove prefix
	    $text = preg_replace("|\\</code\\>\$|", "", $text, 1);  // remove suffix 1
	    $text = trim($text);  // remove line breaks
	    $text = preg_replace("|\\</span\\>\$|", "", $text, 1);  // remove suffix 2
	    $text = trim($text);  // remove line breaks
	    $text = preg_replace("|^(\\<span style\\=\"color\\: #[a-fA-F0-9]{0,6}\"\\>)(\\</span\\>)|", "\$1\$3\$4", $text);  // remove custom added "<?php "
	
	    return $text;
	}
}