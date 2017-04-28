<?php
class Af_Comics_Ma3 extends Af_ComicFilter {
	function supported() {
		return array("Menage a 3");
	}

	function process(&$article) {
		if (strpos($article["link"], "www.menagea3.net/") !== FALSE ||
		    strpos($article["link"], "www.ma3comic.com/") !== FALSE) {
			$article["content"] = preg_replace('#/comicsthumbs/#', '/comics/', $article["content"]);
			return true;
		}

		return false;
	}
}
?>
