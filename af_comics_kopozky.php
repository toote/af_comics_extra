<?php
class Af_Comics_Kopozky extends Af_ComicFilter {
	function supported() {
		return array("Kopozky");
	}
	
	function process(&$article) {
		if (strpos($article["link"], "/kopozky.net/") !== FALSE) {
			$doc = new DOMDocument();
			@$doc->loadHTML(fetch_file_contents($article["link"]));
			
			$basenode = false;
			
			if ($doc) {
				$xpath = new DOMXPath($doc);
				$basenode = $xpath->query('(//div[@id="article-image"]//img)')->item(0);
				
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
