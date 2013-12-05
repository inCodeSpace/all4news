<?php
require_once('php/libClientUrl.php');
//для обработки POST-данных
if( ( $_SERVER['REQUEST_METHOD'] == 'POST' ) && ( $_GET['change'] == PSW_DATA ) ) {
	postSwitch();
}
//для изменения title
if( isset( $_GET['change'] ) ) {
	$title = "SkySender";
} else {
	$title = "Ссылки и Картинки";
}
//Обработка Очистки кнопкой контента
if( isset( $_GET['clear'] ) && ( $_GET['clear'] == 'All' ) ) {
	clearData(URL_DATA);
	clearData(IMG_DATA);
	header( 'Location: ' . basename($_SERVER['PHP_SELF']) );
}
?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title><?= $title; ?></title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link rel="shortcut icon" href="img/favicon.ico">
</head>
<body>
 <!-- 1)Head -->
	<div id="logo">
		<div id="lineLogo">
			<a href="<?= basename($_SERVER['PHP_SELF']); ?>" id="lineLogoHref">
				News and URLs
			</a>
		</div>
		<a href="<?= basename($_SERVER['PHP_SELF']); ?>" id="logoImg"></a>		
	</div>
 <!-- 2)Content -->
	<div id="conteiner">		
 	 <!-- 2.1)URLs -->
			<?php
			if( isset( $_GET['change'] ) && ( $_GET['change'] == PSW_DATA ) ) {
				//Случай если вызывается ф-онал для работы с данными
				prnChangeInputs();
			} else {
				getUrlData();
				getImgData();
				clearButtClient(); //Вывод кнопки очиски контента
			}
			?>
		</div>
</body>
</html>