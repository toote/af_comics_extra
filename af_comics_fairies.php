<?php
class Af_Comics_Fairies extends Af_ComicFilter {
	function supported() {
		return array("Blooming Fairies");
	}
	
	function process(&$article) {
		if (strpos($article["link"], "bloomingfaeries.com/comic/public/") !== FALSE) {
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
