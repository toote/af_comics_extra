<?php
class Af_Comics_LFG extends Af_ComicFilter {
	function supported() {
		return array("Looking For Group");
	}
	
	function process(&$article) {
		if (strpos($article["link"], "lfg.co/page/") !== FALSE OR
		    strpos($article["link"], "lfg.co/npc/") !== FALSE OR
		    strpos($article["link"], "lfg.co/tda/") !== FALSE) {
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
