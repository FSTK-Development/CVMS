<!DOCTYPE html>
<html>
<head>
	<meta charset=UTF-8">
	<title><?=get_title($page)?></title>
	<?=get_description($page)?>
	<meta name="robots" content="index, follow">
	<meta name="revisit-after" Content="7 days">
	<meta http-equiv="Content-Language" Content="ru">
	<link rel="icon" type="image/png" href="/source/ico.png" />
	<meta name="yandex-verification" content="401b5eb9203c167e" />
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<style type="text/css">
		@import url('https://fonts.googleapis.com/css2?family=Ubuntu:wght@300&display=swap');
		* {
			font-family: 'Ubuntu', sans-serif !important;
		}
		body {
		    margin: 20px auto;
		    width: 1400px;
    		display: grid;
    		background-color: #524f46;
		}
		@media (max-width: 1440px){
			body{
				margin: 20px;
				width: calc(100% - 40px);
			}
		}
		@media (max-width: 1024px){
			aside{
				min-width: 200px;
			}
			article {
				width: calc(100% - 200px);
			}
		}
		@media (max-width: 768px){
			body {
				margin: 0px;
				width: 100%;
			}
		}
		@media (min-width: 560px){

			main {
			    display: flex;
			}
		}
		@media (max-width: 560px){
			main {
				display: grid;
			}
			aside {
				width: 100% !important;
			}
			article {
				width: calc(100% - 20px) !important;
				padding: 10px !important;
			}
		}
		article {
		    width: calc(80% - 40px);
		    padding: 0px 20px;
		    float: right;
		    overflow-wrap: break-word;
		    min-height: calc(100vh - 40px);
		    background-color: #ffffff;
    		cursor: default;
		}
		figure.image {
		    display: contents;
		}
		article img {    
			margin: 0 auto;
		    max-width: 100%;
		    display: block;
		}
		aside > a {
		    padding: 5px 5px 5px 30px;
		    display: block;
		    text-decoration: none;
		    color: #e4e4e4;
		    background-repeat: no-repeat;
		    background-position: 10px center;
		}
		article i {
		        box-shadow: inset 0px 0px 0px 1px #d5d5d5;
			    color: #505050;
			    padding: 0pt 5px 2px 5px;
			    border-radius: 4px;
			    cursor: text;
			    user-select: all;
			    font-style: initial;
			    font-size: 11pt;
			    line-height: 13pt;
		}

		article blockquote {
		    display: block;
		    margin: 0px 0px 0px 10px;
		    padding: 5px 30px 5px 20px;
		    box-shadow: inset 3px 0px 0px #cd7b00;
		    font-style: italic;
		    color: #875100;
		    font-size: 12pt;
		}
		a {
			color: #ac5f02;
		}
		a#dir {
		    background-image: url(/source/dir.svg);
		}
		a#file {
		    background-image: url(/source/file.svg);
		}
		a#back {
		    background-image: url(/source/back.svg);
		}
		aside > a[href="<?=$url?>"] {
		    box-shadow: inset 4px 0px orange;
		    display: block;
		    background-color: #838383;
		    color: black;
		}
		aside > a[href="<?=$url?>"]:hover {
		    box-shadow: inset 4px 0px orange;
		    text-decoration: underline;
		}
		footer {
		    text-align: center;
		    background-color: #2a2a2a;
		}
		nav {
		    padding: 10px;
		    color: white;
		    background-color: #333;
		}
		nav > a {
			text-decoration: none;
			color: orange;
		}
		a#home {
		    padding-left: 20px;
		    background-image: url(/source/home.svg);

		    background-repeat: no-repeat;
		}
		aside > a:hover {
		    box-shadow: inset 4px 0px grey;
		    text-decoration: underline;
		}
		aside {
		    float: left;
		    width: 20%;
		    overflow-wrap: break-word;
		    background-color: #5e5e5e;
		}
		footer > a {
		    color: lightgrey;
		    text-decoration: none;
		    font-size: smaller;
		    padding: 10px;
		    display: block;
		    color: white;
		}
		article > h2 {
		    font-size: 16pt;
		}
		article > h1 {
		    border-bottom: solid 1px lightgrey;
		    padding-bottom: 20px;
		}
		h3 {
		    color: #a27138;
		    border-bottom: solid 1px darkgrey;
		    margin-bottom: 0px;
		    margin-top: 30px;
		}
		strong, b {
		    color: #333;
		}
		p {
		    margin: 5px 0px 10px 0px;
		    text-align: justify;
		    text-indent: 15px;
		    line-height: 20px;
		}

		article > h1 {
		    margin-bottom: 15px;
		    text-align: center;
		}
		h4 {
		    border-bottom: solid 1px darkgrey;
		    padding: 0px 0px 5px 0px;
		    margin: 30px 0px 0px 0px;
		}
		button#edit {
		    background: none;
		    color: #333;
		    border-radius: 50%;
		    border: none;
		    background-color: #555;
		    width: 20px;
		    height: 20px;
		    font-weight: 600;
		    padding: 0px 0px 5px;
		    font-size: 16px;
		    outline: none;
		    float: right;
		    margin-left: 5px;
		}
		button#edit:hover {
		    background-color: #777;
		}
		button#edit:active {
		    background-color: white;
		}
	</style>
	<script src="https://cdn.ckeditor.com/ckeditor5/25.0.0/classic/ckeditor.js"></script>
	<script type="text/javascript">
		function add_page(url){
			var article = document.getElementById("content");
			article.innerHTML = '<!DOCTYPE html><html><head><meta charset="utf-8"><style type="text/css">div#btn {display: flex;width: 100%;margin: 10px 0px 0px 0px;}#btn > input{border:none;background-color: transparent;padding: 10px 20px;box-shadow: inset 0px 0px 0px 1px grey;margin-right: 5px;}#btn > input:hover{background-color: #e8e8e8;}#btn > input[type="text"] {float: left;width: calc(100% - 110px);}#btn > input[name="save"]{float: right;}form {height: calc(100% - 40px);margin: 20px 0px 10px 0px;}hr {margin-top: 20px;border: none;border-top: solid 1px lightgrey;}.item3 > input {width: calc(100% / 3 - 3px);}textarea[name="description"] {margin-top: 15px;display: inline-block;resize: none;width: calc(100% - 40px);border: none;background-color: transparent;padding: 10px 20px;box-shadow: inset 0px 0px 0px 1px grey;margin-right: 5px;height: 35pt;}</style></head><body><form method="post"><textarea id="editor" name="editor"></textarea><textarea name="description" placeholder="Короткое описание страницы (до 220 знаков)" maxlength="220"></textarea><div id="btn"><input type="text" name="category" value="<?=$url?>"placeholder="Категория"><input type="text" name="filename" placeholder="Название страницы"><input type="submit" name="default_saver" value="Сохранить" style="margin-right: 0px"></div></form></body></html>';

	        ClassicEditor
	            .create( document.querySelector( '#editor' ) )
	            .catch( error => {
	                console.error( error );
	            } );
		}
		function sitemap(){
			window.location.href = "http://фулстек.рф/sitemap.xml";
		}
	</script>
	<script data-ad-client="ca-pub-4558813879455848" async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
</head>
<body>
	<nav><? get_navigator($page); ?><button id="edit" onclick="sitemap()">s</button> <button id="edit" onclick="add_page()">+</button></nav>
	<main>
		<aside><? get_menu($page); ?></aside>
		<article id="content">
			<? get_page($page); ?>
		</article>
		<?php
			if($_POST['default_saver']){
				$base = __DIR__.'/';
				$category = ($_POST['category'] == ''?'':$_POST['category']);
				$category = (substr($category, 0, 1) == '/'? substr($category, 1): $category);
				$category = (substr($category, 0, -1) == '/'? substr($category, -1): $category);
				$category = $base.'/pages/'.$category;
				if(!file_exists($category)){
					mkdir($category, 0777, true);
				}
				$filename = ($_POST['filename'] == ''?'index':$_POST['filename']);
				$filename = (substr($filename, 0, 1) == '/'? substr($filename, 1): $filename);
				$path = $category.'/'.$filename;
				file_put_contents($path.'.html', $_POST['editor']);
				if ($_POST['description'] != ''){
					file_put_contents($path.'.description', $_POST['description']);
				}
			}

		?>
	</main>
	<footer>
		<a href="https://vk.com/fullstack_agent" target="_blank"><?=$copyright?></a>
	</footer>
	<script type="text/javascript" > (function(m,e,t,r,i,k,a){m[i]=m[i]||function(){(m[i].a=m[i].a||[]).push(arguments)}; m[i].l=1*new Date();k=e.createElement(t),a=e.getElementsByTagName(t)[0],k.async=1,k.src=r,a.parentNode.insertBefore(k,a)}) (window, document, "script", "https://cdn.jsdelivr.net/npm/yandex-metrica-watch/tag.js", "ym"); ym(73015666, "init", { clickmap:true, trackLinks:true, accurateTrackBounce:true }); </script>
	<noscript>
		<div>
			<img src="https://mc.yandex.ru/watch/73015666" style="position:absolute; left:-9999px;" alt="" />
		</div>
	</noscript>
    <script>
        ClassicEditor
            .create( document.querySelector( '#editor' ) )
            .catch( error => {
                console.error( error );
            } );
    </script>
</body>
</html>