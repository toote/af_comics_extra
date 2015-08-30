<?php
class Af_Comics_Evil extends Af_ComicFilter {
	function supported() {
		return array("Evil INC.");
	}
	
	function process(&$article) {
		if (strpos($article["link"], "evil-inc.com/comic/") !== FALSE) {
			$doc = new DOMDocument();
			@$doc->loadHTML(fetch_file_contents($article["link"]));
			
			$basenode = false;
			
			if ($doc) {
				$xpath = new DOMXPath($doc);
				$basenode = $xpath->query('(//div[@id="comic"]//img)')->item(0);
				
				if ($basenode) {
					$article["content"] = $doc->saveXML($basenode);
				}
			}
			return true;
		}
		
		return false;
	}
}
?>
