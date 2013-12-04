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
		 	//библиотека подгрузки данных URL
			require_once('php\libClientUrl.php');
			getUrlData();
			?>
	 <!-- 2.2)IMG -->
		<?php
			getImgData();		
		?>
</body>
</html>