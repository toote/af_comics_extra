<?php
class Af_Comics_MONTT extends Af_ComicFilter {
	function supported() {
		return array("Alberto Montt en Dosis Diarias");
	}
	
	function process(&$article) {
		if (strpos($article["feed"]["site_url"], "dosisdiarias.com/feeds") !== FALSE OR
		    strpos($article["feed"]["site_url"], "blogger.com/feeds/36869724/posts") !== FALSE OR
		    strpos($article["feed"]["site_url"], "feeds.feedburner.com/montt") !== FALSE) {
			$article["content"] = preg_replace('#/s400/#', '/s1600/', $article["description"]);
			return true;
		}
		
		return false;
	}
}
?>
