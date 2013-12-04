<?php
define("URL_DATA", "data/urlData.txt"); //файл с URL
define("IMG_DATA", "data/imgData.txt"); //файл с Img
// > Получение данных из файла URL
function getUrlData() {
	if( !file_exists(URL_DATA) ) {
		return false;
	}
	$urlArr = array();
	$urlFile = file(URL_DATA);
	foreach($urlFile as $arr) {
		list($url, $title) = explode("|", $arr);
		$arrData = array();
			$arrData['url'] = $url;
			$arrData['title'] = $title;
		$urlArr[] = $arrData;
	}
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
	if( !file_exists(IMG_DATA) ) {
		return false;
	}
	$imgArr = array();
	$imgFile = file(IMG_DATA);
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