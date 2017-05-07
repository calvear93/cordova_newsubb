<?php
define('NEWS_DIR', 'data/');
define('DEFAULT_IMAGE', 'default.png');
define('HEADER_MIME_TYPE', 'text/plain');
//define('SERVER_URL', "http://" . "$_SERVER[HTTP_HOST]" . ":" . "$_SERVER[SERVER_PORT]" . "/newsubb/");
define('SERVER_URL', "http://" . "$_SERVER[HTTP_HOST]" . "/crialvea/newsubb/");

if($_SERVER['REQUEST_METHOD'] == 'GET') {
	$from = isset($_GET['from']) ? $_GET['from'] : '';
	$quantity = isset($_GET['quantity']) ? (int) $_GET['quantity'] : '';
	$tags_req = isset($_GET['tags']) ? explode(",", $_GET['tags']) : '';

	$news = array();
	$news_dirs = scandir(NEWS_DIR, 1);

	for ($i = $from; $i < count($news_dirs); $i++) {
	    if ($quantity == 0)
	    	break;

	    if ((mime_content_type(NEWS_DIR . $news_dirs[$i]) != "directory"))
	    	continue;
	    if ($news_dirs[$i] == ".." || $news_dirs[$i] == ".")
	    	continue;
	    $files = scandir(NEWS_DIR . $news_dirs[$i], 1);

	    for ($j = 0; $j < count($files); $j++) {

	    	if (mime_content_type(NEWS_DIR . $news_dirs[$i] . '/' . $files[$j]) == HEADER_MIME_TYPE) {
	    		$file = fopen(NEWS_DIR . $news_dirs[$i] . '/' . $files[$j], "r");

	    		$tags = array_map('trim', explode(",", trim(explode(":", preg_replace("/[\n\r]/", "", fgets($file)))[1])));

	    		if ($tags_req && !verify_tags($tags_req, $tags))
	    			break;

	    		$id = $news_dirs[$i];
	    		$title = explode(":", preg_replace("/[\n\r]/", "", fgets($file)))[1];
	    		$date = explode(":", preg_replace("/[\n\r]/", "", fgets($file)))[1];
	    		$description = explode(":", preg_replace("/[\n\r]/", "", fgets($file)))[1];
	    		$thumbnail = urlencode(trim(SERVER_URL . NEWS_DIR . $id . '/' . trim(explode(":", preg_replace("/[\n\r]/", "", fgets($file)))[1])));

	    		//$url = urlencode(explode(":", preg_replace("/[\n\r]/", "", fgets($file)))[1]);
	    		$url = preg_replace("/[\n\r]/", "", fgets($file));
	    		$url = urlencode(trim(substr($url, strpos($url, ":") + 1)));

	    		$news[] = array(
	    		        'id' => $id,
						'tags' => $tags,
						'title' => trim($title),
						'date' => trim($date),
						'description' => trim($description),
						'thumbnail' => $thumbnail,
						'url' => $url
					);
	    		$quantity--;

				fclose($file);
	    	}
	    }
	}

	header('content-type: application/json; charset=utf-8');
	header("access-control-allow-origin: *");

	echo json_encode(array('mode' => $tags_req ? 'filter' : 'all', 'list' => $news));
}

function verify_tags($tags_request, $tags) {
	foreach ($tags_request as $tag_r)
		if (in_array($tag_r, $tags))
			return true;
}
