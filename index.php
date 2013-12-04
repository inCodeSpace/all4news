<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Новости и ссылки</title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link rel="shortcut icon" href="img/favicon.ico">
</head>
<body>
 <!-- 1)Head -->
	<div id="logo">
		<div id="lineLogo">News and URLs</div>
		<center id="logoImg"></center>
	</div>
 <!-- 2)Content -->
	<div id="conteiner">		
 	 <!-- 2.1)URLs -->
			<?php

			define("URL_DATA", "data/urlData.txt"); //файл с URL
			//define("IMG_DATA", "data/imgData.txt"); //файл с Img
			// > Получение данных из файла URL
			function getUrlData() {
				if( !file_exists(URL_DATA) ) {
echo "No data!";
				}
echo "oK1";
				$urlArr = array();
				$urlFile = file(URL_DATA);
				foreach($urlFile as $arr) {
					list($url, $title) = explode("|", $arr);
					$arrData = array();
						$arrData['url'] = $url;
						$arrData['title'] = $title;
					$urlArr[] = $arrData;
				}
print_r($urlArr);
				if( count($urlArr) != 0 )	{
					prnUrl($urlArr); //если массив не пустой тогда печаем контент
				}	
			}

			// > Распечатка данных из файла
			function prnUrl($urlArr) {
				echo '
					<ul id="urlBox">
				';
				foreach ($urlArr as $arr) {
					echo '
						<li>
							<a href=" ' . $arr['url'] . ' " target="_blank"> ' . $arr['title'] . '</a>
						</li>
					';
				}
				echo '
					<br></ul>
				';
			}

			// - - - Обработка для IMG - - - //
			// - - - - - - - - - - - - - - - //

			// > Получение данных из файла URL
			function getImgData() {
$imgFile = "data/imgData.txt";
				if( !file_exists($imgFile) ) {
					// return false;
echo "No imgData";
				}
echo "oK2";				
				$imgArr = array();
// $imgFile = file(IMG_DATA);
				$imgFile = file($imgFile);
				foreach($imgFile as $arr) {
					list($url) = explode("|", $arr);
					$arrData = array();
						$arrData['url'] = $url;
					$imgArr[] = $arrData;
				}
				if( count($imgArr) != 0 )	{
					prnImg($imgArr); //если массив не пустой тогда печаем контент
				}	
			}

			// > Распечатка данных из файла
			function prnImg($imgArr) {
				echo '
					<div id="imgText">Картинки:</div>
					<a id="panel_title" href="javascript:changePanel()">Развернуть</a>
					<div id="panel">
				';
				foreach ($imgArr as $arr) {
					echo '
						<img src=" ' . $arr['url'] . ' "><br>
					';
				}
				echo '
					</div>
					<script src="js/scripts.js"></script>
				';
			}

			getUrlData();
			getImgData();		
			?>
</body>
</html>