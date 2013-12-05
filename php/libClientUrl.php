<?php
define("URL_DATA", "data/urlData.txt"); //файл с URL
define("IMG_DATA", "data/imgData.txt"); //файл с Img
define("PSW_DATA", "add_data_to_this_site"); //константа
$changePage = basename($_SERVER['PHP_SELF']) . '?change=true';
$pointA = 0; //переменная условие для вывода кнопки очиски (на клиенте), помечается при выводе контента
$pointB = 0;
// > Получение данных из файла URL
function getUrlData() {
	if( !file_exists(URL_DATA) ) {
		return false;
	}
	$urlArr = array();
	$urlFile = file(URL_DATA);
	foreach($urlFile as $arr) {
		list($title, $url) = explode("|", $arr);
		$arrData = array();
			$arrData['title'] = $title;		
			$arrData['url'] = $url;
		$urlArr[] = $arrData;
	}
	if( count($urlArr) != 0 )	{
		prnUrl( array_reverse($urlArr) ); //если массив не пустой тогда печаем контент
		global $pointA;
		$pointA = 1;
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
		prnImg( array_reverse($imgArr) ); //если массив не пустой тогда печаем контент
		global $pointB;
		$pointB = 1;
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
		<a id="panel_title2" href="javascript:changePanel()">Свернуть</a>
		<script src="js/scripts.js"></script>
	';
}

// - - - Обработка данных - - - //
// - - - - - - - - - - - - - - //

// > Печать управляющих элементов (добавление URL/добавление IMG/очистка URL или IMG)
function prnChangeInputs() {	
	prnAddUrl(); //Вывод формы: добавление URL	
	prnImgData(); //Вывод формы: добавление IMG
	prnClearImg(); //Вывод кнопки: очистки IMG
	prnClearUrl(); //Вывод кнопки: очистки URL
}

// > Вывод формы добавление URL
function prnAddUrl() {
	echo '
				<form class="mForm form1" name="formUrl" action="'. $changePage .'" method="post">
				<span class="mFormText" style="color: green; letter-spacing: 4px;">Добавление Url:</span><br><br>
					<label>
						<span class="mFormText">Имя Url:</span>
						<textarea type="text" name="urlName" rows="2" cols="45" size="20" class="inputData">Сайт </textarea> <br>
					</label>
					<label>
					<br>
						<span class="mFormText">Url:</span>
						<textarea type="text" name="urlData" rows="2" cols="45" size="20" class="inputData"></textarea> <br>
					</label>
					<br>
					<div class="sendDiv">
						<input class="sendInp" type="submit" value="Добавить">
					</div>
				</form>
	';
}

// > Вывод формы добавление IMG
function prnImgData() {
	echo '
				<form class="mForm  form2" name="formImg" action="'. $changePage .'" method="post">
				<span class="mFormText" style="color: green; letter-spacing: 4px;">Добавление Img:</span><br><br>
					<label>
						<span class="mFormText">Img Url:</span>
						<textarea type="text" name="urlImg" rows="2" cols="45" size="20" class="inputData"></textarea> <br>
					</label>
					<br>
					<div class="sendDiv">
						<input class="sendInp" type="submit" value="Добавить">
					</div>
				</form>
	';
}
// > Вывод кнопки очистки URL
function prnClearUrl() {
	echo '
				<form class="mForm form2 formBut formButLeft" name="formUrlClear" action="'. $changePage .'" method="post">
					<div class="sendDiv inpButt">
						<input class="sendInp" type="submit" name="urlClear" value="Очистить URLs">
					</div>
				</form>				
	';
}
// > Вывод кнопки очистки IMG
function prnClearImg() {
	echo '
				<form class="mForm form2 formBut" name="formImgClear" action="'. $changePage .'" method="post">
					<div class="sendDiv inpButt">
						<input class="sendInp" name="imgClear" type="submit" value="Очистить IMGs">
					</div>
				</form>
				<div style="clear: both;"><br></div>
	';
}

// - - - Обработка форм - - - //
// - - - - - - - - - - - - - //

// > Роутинг полученных форм
function postSwitch() {
	if( !empty( $_POST['urlName'] ) and !empty( $_POST['urlData'] ) ) { //если передается форма URL
		addUrlData($_POST['urlName'], $_POST['urlData']);
	} elseif( !empty( $_POST['urlImg'] ) ) { //если передается форма IMG
		addImgData($_POST['urlImg']);
	} elseif( isset( $_POST['urlClear'] ) ) { //если передается форма Удаления IMG
		clearData(URL_DATA);
	} elseif( isset( $_POST['imgClear'] ) ) { //если передается форма Удаления URL
		clearData(IMG_DATA);
	} else { //другой случай, например не все поля заполнены
		echo '<span class="mFormText">!одно из полей в форме пустое</span>';
	}
}

// > Добавление данных URL в файл, принятых из формы
function addUrlData($urlName, $urlData) {
	$order = $urlName.'|'.$urlData."\n";// для добавления в файл
	file_put_contents(URL_DATA, $order, FILE_APPEND); //Используем опреденную константу для назв. файла, Добавляем в конец
	header('Location: '. $changePage);
}

// > Добавление данных IMG в файл, принятых из формы
function addImgData($urlImg) {
	$order = $urlImg.'|'."\n";// для добавления в файл
	file_put_contents(IMG_DATA, $order, FILE_APPEND); //Используем опреденную константу для назв. файла, Добавляем в конец
	header('Location: '. $changePage);
}

// > Очистка Файла
function clearData($fileName) {
	$fp = fopen($fileName, "w");
	fclose($fp);
	header('Location: '. $changePage);
}

// > Вывод кнопки очистки на клиентской странице
function clearButtClient() {
	global $pointA, $pointB;
	if( ($pointA == 1) || ($pointB == 1) ) { //если есть какой нибудь контент
		echo '
			<br>
			<a href="'.basename($_SERVER['PHP_SELF']).'?clear=All" id="clearButtC">Просмотренно</a>
		';
	}
}