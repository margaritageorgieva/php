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
				
				<ul id="main-nav-ul">
					<li class="active main-nav-ul-li" > <a href=".">Начало</a></li>
					
';	
			// Проверка за логнат администратор. Сесиите се генерират при логване от файла login.php
    		if(!isset($_SESSION['person_type'])){
				// Ако потребителя не е логнат извеждаме бутон ВХОД
				print '<span style="float:right; font-size:15pt;color:white; padding-right:2rem;"><a href="login.php" class="top_menu_a">Вход</a></span>'; 				
			} else {
			// Aко е администратор ще има достъп за промяна на данни на животни. 
			// Извеждме бутони ЖИВОТНИ, НОВО ЖИВОТНО и ИЗХОД
				if($_SESSION['person_type']==1){	
					print '<li class="main-nav-ul-li"><a href="editProducts.php">Продукти</a></li>
							<li class="main-nav-ul-li"><a href="editAproduct.php">Нов продукт</a></li>';						
				}
				print' <span  style="float:right; font-size:15pt;color:white; padding-right:2rem;"><a href="logout.php" class="top_menu_a">Изход</a></span>';
			}
			'		
			</ul>
		</nav>
';
			$result = $mysqli->query("SELECT * FROM food_types");
			while($row = $result->fetch_assoc()){
				print'<li class="main-nav-ul-li"><a href="productS.php?kid='.$row['food_type_id'].'" 
					>'.htmlspecialchars(stripslashes($row['type'])).'</a></li>';
			}


	//do tuk prikluchva header-a
	
?>