<?php
print'
<!DOCTYPE html>
<html>
<html  lang="bg-BG">
<head>
	<meta charset="utf-8">
	<meta http-equiv="Content-Type" content="text/html; charset=windows-1251"/>
	<link rel="stylesheet" type="text/css" href="Style.css">
	<title>'.$page_title.'</title>
<script src="https://kit.fontawesome.com/acc09d4eff.js" crossorigin="anonymous"></script>

	
</head>
<body>
<header>
		<div class="lenta">
			<img src="images/logo.png" alt="logo">

		</div>

			<nav>
				
				<ul>
					<li class="active" > <a href="#">Начало</a></li>
					<li> <a href="#">Стекове</a></li>
					<li> <a href="#">Бургери</a></li>
					<li> <a href="#">Салати</a></li>
					<li> <a href="#">Напитки</a></li>
					<li> <a href="#">Предястия</a></li>
					<li> <a href="#">Десерти</a></li>
				</ul>
			</nav>
';	
			// Проверка за логнат администратор. Сесиите се генерират при логване от файла login.php
    		if(!isset($_SESSION['person_type'])){
				// Ако потребителя не е логнат извеждаме бутон ВХОД
				print '<span style="padding-left:800px;"><a href="login.php" class="top_menu_a">Вход</a></span>'; 				
			} else {
			// Aко е администратор ще има достъп за промяна на данни на животни. 
			// Извеждме бутони ЖИВОТНИ, НОВО ЖИВОТНО и ИЗХОД
				if($_SESSION['person_type']==1){	
					print '<a href="animals_edit.php" class="top_menu_a">Животни</a>
						   <a href="animal_edit.php" class="top_menu_a">Ново животно</a>';						
				}
				print' <span style="padding-left:570px;"><a href="logout.php" class="top_menu_a">Изход</a></span>';
			}		
			

?>