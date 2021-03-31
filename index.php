<?php 
	setlocale(LC_ALL, 'ru_RU.UTF8');
	$url = urldecode($_SERVER['REQUEST_URI']);
	$url = (substr($url, -1) == '/'? $url : $url.'/');
	/*
	ini_set('display_errors',1);
	error_reporting(E_ALL);*/

	//FUNCTIONS
	function save_db($value, $filename){
		$str_value = serialize($value);
		$f = fopen($filename, 'w');
		fwrite($f, $str_value);
		fclose($f);
	}
	function open_db($filename){
		$file = file_get_contents($filename);
		$value = unserialize($file);
		return $value;
	}
	function url_path($str){
		$return = substr($str, 6);
		$return = (substr($return, -5) == '.html' ? (substr($return, -10) == 'index.html'? substr($return, 0, -11) : substr($return, 0, -5)) : $return);
		return $return.'/';
	}
	function scan_callback($fname){
		$server = $_SERVER['REQUEST_SCHEME'].'://'.$_SERVER['HTTP_HOST'];
		$file = (substr($fname, -5) == '.html' ? true : false);
		$path = substr($fname, 1);
		$path = ($file == false ? $path.'/index.html' : $path);
		$full_path = __DIR__.$path; // Для include
		$full_url = $server.url_path($path); // Для sitemap.xml
		$sitemap = open_db('sitemap.php');

		if($sitemap[url_path($path)] != $full_path and pathinfo($full_path)['extension'] != 'description'){
			$sitemap[url_path($path)] = $full_path;
			save_db($sitemap, 'sitemap.php');
		}
	}
	function scan_recursive($directory, $callback=null){
	    if ($d=opendir($directory)) {
	        while($fname=readdir($d)) {
	            if ($fname=='.' || $fname=='..') {
	                continue;
	            }
	            else {
	                // Передать путь файла в callback-функцию
	                if ($callback!=null && is_callable($callback)) {
	                    $callback($directory.DIRECTORY_SEPARATOR.$fname);
	                }
	            }
	            if (is_dir($directory.DIRECTORY_SEPARATOR.$fname)) {
	                scan_recursive($directory.DIRECTORY_SEPARATOR.$fname, $callback);
	            }
	        }
	        closedir($d);
	    }
	}
	function print_sitemap(){
		header('content-type: text/xml; charset="utf-8');
		$server = $_SERVER['REQUEST_SCHEME'].'://'.$_SERVER['HTTP_HOST'];
		$sitemap = open_db('sitemap.php');
		$sitemap = array_unique($sitemap);
		foreach ($sitemap as $key => $value) {
			if(!file_exists($value)){
				unset($sitemap[$key]);
			}
		}
		save_db($sitemap, 'sitemap.php');
		echo '<?xml version="1.0" encoding="UTF-8"?>';
		echo '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';
		scan_recursive('./pages', 'scan_callback');
		unset($sitemap);
		$sitemap = open_db('sitemap.php');
		foreach ($sitemap as $key => $value) {
			if (pathinfo(substr($value, 0, -11))['extension'] == 'description'){
				unset($sitemap[$key]);
				continue;
			} else {
				echo '<url><loc>'.$server.$key.'</loc></url>';
			}
			
		}
		save_db($sitemap, 'sitemap.php');
		echo '</urlset>';
	}
	function sitemap($url){
		if (file_exists('sitemap.php')){
			$sitemap = open_db('sitemap.php');
			return $sitemap[$url];
		} else {
			$sitemap = [];
			save_db($sitemap, 'sitemap.php');
			header('Location: /sitemap.xml');
		}
	}
 	function get_article_title($file_path){
 		include 'config.php';
		if (pathinfo($file_path)['filename'] == 'index') {
			$title = explode('/', $file_path);
			$title = $title[count($title)-2];
			$title = ($title == 'pages'? 'Главная' : $title);
		} else {
			$title = substr(array_pop(explode('/', $file_path)), 0, -5);
		}
		return ($config['article_title_enable'] == true? '<h1>'.$title.'</h1>' : '');

 	}
 	function get_page($file_path){
		if(file_exists($file_path)){
			echo get_article_title($file_path);
			include $file_path;
		} else {
			include '404.php';
		}
 	}
 	function get_description($file_path){
 		$path = substr($file_path, 0, -strlen(pathinfo($file_path)['basename']));
 		$file = substr($file_path, 0, -4).'description';
 		if(file_exists($file)){
 			$description = file_get_contents($file);
 			$tag = '<meta name="description" content="'.$description.'">';
 			return $tag;
 		}
 	}
 	function get_title($file_path){
 		include 'config.php';
		if (pathinfo($file_path)['filename'] == 'index') {
			$title = explode('/', $file_path);
			$title = $title[count($title)-2];
			$title = ($title == 'pages'? 'Главная' : $title);
		} elseif (!file_exists($file_path)){
			$title = 'Страница не найдена';
		} else {
			$title = substr(array_pop(explode('/', $file_path)), 0, -5);
		}
		return ($config['sitename_enable'] == true? $title.' | '.$config['sitename'] : $title);
 	}
    function get_menu($url){
        if($_SERVER['REQUEST_URI'] != '/'){
            echo '<a href="../" id="back">Назад</a>';
        }
    	$path = pathinfo($url);
    	$menu = scandir($path['dirname']);
    	$url_end = explode('/', urldecode($_SERVER['REQUEST_URI']));
    	$end = explode('/', $url);
    	$end = $end[count($end)-1];
    	if ($end != 'index.html'){
    		unset($url_end[count($url_end)-2]);
    	}
    	$url_start = '';
    	foreach ($url_end as $value) {
    		if(substr($url_start, -1) != '/'){
    			$url_start .= '/'.$value;
    		} else {
    			$url_start .= $value;

    		}
    	}
        foreach( $menu as $value ){
            if ($value != '.' and $value != '..' and $value != 'index.html' and pathinfo($value)['extension'] != 'description'){
            	if(is_dir($path['dirname'].'/'.$value) == 1){
            		echo '<a href="'.$url_start.$value.'/" id="dir">'.$value.'</a>';
            	} else {
            		$value = substr($value, 0, -5);
            		echo '<a href="'.$url_start.$value.'/" id="file">'.$value.'</a>';
            	}
            }
        }

    }
    function get_navigator($path){
    	$url = explode('/', urldecode($_SERVER['REQUEST_URI']));
    	echo '<a href="/" id="home">Главная</a>';
    	$path = '/';
    	foreach ($url as $key => $value) {
    		if($value != ''){
    			$path .= $value.'/';
    			echo ' / <a href="'.$path.'">'.$value.'</a>';
    		}
    	}
    }
	//PROCESSING
		if(substr($url, 0, -1) == "/sitemap.xml"){
			print_sitemap();
		} else {
			include 'config.php';
			$copyright = $config['copyright'];
			$page = sitemap($url);
			include 'template.php';
		}

?>