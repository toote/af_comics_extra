<?php
class Af_Comics_Oglaf extends Af_ComicFilter {
	function supported() {
		return array("Oglaf");
	}

	function process(&$article) {
		if (strpos($article["link"], "oglaf.com/") !== FALSE) {
			$doc = new DOMDocument();
			@$doc->loadHTML(fetch_file_contents($article["link"]));

			$basenode = false;

			if ($doc) {
				$xpath = new DOMXPath($doc);
				$basenode = $xpath->query('(//img[@id="strip"])')->item(0);

				if ($basenode) {
					$article["content"] .= $doc->saveXML($basenode);
				}
			}

            /* TODO: add ability to get multi-page stories */
			return true;
		}

		return false;
	}
}
?>
