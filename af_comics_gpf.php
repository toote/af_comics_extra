<?php
class Af_Comics_GPF extends Af_ComicFilter {
	function supported() {
		return array("General Protection Fault");
	}
	
	function process(&$article) {
		$owner_uid = $article["owner_uid"];
		
		if (strpos($article["link"], "gpf-comics.com/archive/") !== FALSE) {
			$doc = new DOMDocument();
			@$doc->loadHTML(fetch_file_contents($article["link"]));
			
			$basenode = false;
			
			if ($doc) {
				$xpath = new DOMXPath($doc);
				$basenode = $xpath->query('(//img[contains(@src, "/comics/gpf")])')->item(0);
				
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
