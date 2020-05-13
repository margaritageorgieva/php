<?php 
// stranica za redaktirane ili suzdavane na jivotno
require 'includes/init.inc';
 $errorMessage = NULL;
 $infoMessage = NULL;
  // ako redaktirame jivotno s $_REQUEST['id'] e primary key na jivotno, 
  // opisan v skrito (hidden) pole na tazi stranica
  // ili v get parametar na vruzka, koqto idva ot editProductS.php
 $operation_type = 'Нов продукт';
 //parametar za product - moje da ne e zadadeno v $_REQUEST
  if($_REQUEST){ 
  	$id = (int)$_REQUEST['id'];
  } else { 
  	$id = NULL; 
  } 
  
  if($_POST){ // trqbva da se INSERT ili UPDATE
 $operation_type = 'Редактиране на продукт';
	// $mysqli->escape_string - escape-va niz - vmesto addslashes()
	// trim() - maha praznite intervali v kraq na niza
	$id = $mysqli->escape_string(trim($_POST['id']));
	$name = $mysqli->escape_string(trim($_POST['name']));
	$food_type_id = $mysqli->escape_string($_POST['food_type_id']); 
	$weight = $mysqli->escape_string((int)trim($_POST['weight']));
	$price = $mysqli->escape_string((int)trim($_POST['price']));
	$info = $mysqli->escape_string(trim($_POST['info']));
	$picture = $mysqli->escape_string(trim($_POST['picture']));

    if(!$_POST['name'] || !$_POST['picture']){
    	$errorMessage = 'Не сте задали задължителните полета.';
	} else {	
		$picture=$picture.'.png';
  		if($id){ // sustavq se UPDATE zaqvka
  			$query = "UPDATE food SET "
					." name= ".($name?"'".$name."'":"NULL").", "
					." food_type_id= ".($food_type_id?"'".$food_type_id."'":"NULL").", "
					." weight= ".($weight?"'".$weight."'":"NULL").", "
					." price= ".($price?"'".$price."'":"NULL").", "
					." picture= ".($picture?"'".$picture."'":"NULL").", "
					." info= ".($info?"'".$info."'":"NULL")
					." WHERE product_id=".$id." AND product_id>4";
  		} else { // sustavq se INSERT zaqvka
			$query = "INSERT INTO food(name, food_type_id, weight, price, picture, info) VALUES ("
					.($name?"'".$name."'":"NULL").", "
					.($food_type_id?"'".$food_type_id."'":"NULL").", "
					.($weight?"'".$weight."'":"NULL").", "
					.($price?"'".$price."'":"NULL").", "
					.($picture?"'".$picture."'":"NULL").", "
					.($info?"'".$info."'":"NULL")
					.")";	
		}
		//izpulnqva se zaqvkata
		$mysqli->query($query);
		// bi bilo dobre da ima proverka za greshki s $mysqli->error i(li) $mysqli->errno,
		// ako se e izpulnil INSERT shte poluchim AUTO_INCREMENT stoinostta chrez $mysqli->insert_id  
		$id = $id?$id:$mysqli->insert_id;
		$infoMessage = 'Данните са записани!';
	}
  } else { 
	// ako ne e podadena promenliva ot HTML formata - ne pravi nishto
  } 
  	if($id) { // prochita se product za redaktirane ako ima $id
	  $query = "SELECT * FROM food WHERE product_id=".$id;
	  $result = $mysqli->query($query);
	  if($row = $result->fetch_assoc()){
	  	$operation_type = 'Редактиране на продукт';
	  	$name = $row['name'];
		$food_type_id = $row['food_type_id'];
		$weight = $row['weight'];
		$price = $row['price'];
		$info = $row['info'];
		$picture = $row['picture'];
	  }
	}
// konfigurirame $page_title
  $page_title = $operation_type.' - Steak House';

require 'includes/header.inc';

// proverka za korekto $id i zabrana za redaktirane na purvite 4 zapisa	
if($id>=1 && $id<=4){
	print'<div style="color:red; margin-top:20px;">(Само в online-версията, за първите 4 животни e забраненa операциията UPDATE.)</div>';
} 
    
    if($errorMessage){
		print'<div class="errorBlock">'.$errorMessage.'</div>';
	} 
	if($infoMessage){
		print'<div class="infoBlock">'.$infoMessage.'</div>';
	} 	
	// stoinostite na poletata ot formata sa vzeti ot BD ili ot posledno zadadenite pri poluchena greshka pri zapis 
	if($_POST || $_REQUEST){  
	print'<form method="post" name="f" action="'.$_SERVER['PHP_SELF'].'" class="form">
		<input type="hidden" name="id" value="'.$id.'">
		<input type="hidden" name="picture" value="'.$picture.'">
	    <div class="form-title">'.$operation_type.'</div>'; 
	       $small_pic = $food_pictures_dir.$food_pictures_small_prefix.$picture;
		   $small_pic_exists = file_exists($small_pic); // dali ima snimka
		   print $small_pic_exists?'<div class="form-row" style="text-align:center"><img src="'.$small_pic.'" title="" alt=""></div>':'';
	print'<div class="form-row">
	        <label for="name">* Име</label>
	        <input type="text" maxlength="64" name="name" id="name" value="'.htmlspecialchars(stripslashes($name)).'">
	    </div>
	    <div class="form-row">
	        <label for="food_type_id">* Вид</label>
	        <select name="food_type_id" id="food_type_id">';
//pokazvane na spisuk i <option> elementi
		          $query = 'SELECT * FROM food_types ORDER BY type';
		          $result = $mysqli->query($query);
		          while($row = $result->fetch_assoc()){	
					$sel=''; 
					if($row['food_type_id']==$food_type_id){$sel=' selected';}
		             print'<option value="'.$row['food_type_id'].'"'.$sel.'>'.htmlspecialchars(stripslashes($row["type"])).'</option>';
		          }
	      	print'</select>
	    </div>
	    <div class="form-row">
	        <label for="weight">Грамаж</label>
	        <input type="text" maxlength="32" name="weight" id="weight" value="'.htmlspecialchars(stripslashes($weight)).'">
	    </div>
	    <div class="form-row">
	        <label for="price">Цена</label>
	        <input type="text" maxlength="4" name="price" id="price" value="'.htmlspecialchars(stripslashes($price)).'"> лв.
	    </div>';
		$picture=str_replace('.png','',$picture);
		print'<div class="form-row">
	        <label for="picture">* Снимка</label>
	        <input type="text" maxlength="64" name="picture" id="picture" value="'.htmlspecialchars(stripslashes($picture)).'"> .png
	    </div>		
	    <div class="form-row">	    
	    	<label for="info">Описание</label>   
	    </div>
	    <div class="form-row">
	        <textarea name="info" id="info">'.htmlspecialchars(stripslashes($info)).'</textarea>
	    </div>
	    <div class="form-row">
	        <input type="submit" name="submit" value="Запис" >
	    </div>    
	</form>';
	} else {
	// prazna forma 
	print'<form method="post" name="new" action="'.$_SERVER['PHP_SELF'].'" class="form">
		<input type="hidden" name="id" value="">
	    <div class="form-title">'.$operation_type.'</div>
	    <div class="form-row">
	        <label for="name">* Име</label>
	        <input type="text" maxlength="64" name="name" id="name" value="">
	    </div>
	    <div class="form-row">
	        <label for="food_type_id">* Вид</label>
	        <select name="food_type_id" id="food_type_id">';
	// pokazvane na spisuk i <option> elementi
		          $query = 'SELECT * FROM food_types ORDER BY food_type_id';
		          $result = $mysqli->query($query);
		          while($row = $result->fetch_assoc()){
		            print'<option value="'.$row['food_type_id'].'">'.htmlspecialchars(stripslashes($row["type"])).'</option>';
		          }
	      	print'</select>
	    </div>
	    <div class="form-row">
	        <label for="weight">Грамаж</label>
	        <input type="text" maxlength="32" name="weight" id="weight" value="">
	    </div>
	    <div class="form-row">
	        <label for="price">Цена</label>
	        <input type="text" maxlength="4" name="price" id="price" value=""> лв.
	    </div>
		<div class="form-row">
	        <label for="picture">* Снимка</label>
	        <input type="text" maxlength="64" name="picture" id="picture" value=""> .png
	    </div>
	    <div class="form-row">	    
	    	<label for="info">Описание</label>   
	    </div>
	    <div class="form-row">
	        <textarea name="info" id="info"></textarea>
	    </div>
	    <div class="form-row">
	        <input type="submit" name="submit" value="Запис">
	    </div>    
		</form>';
	}
print'</div>';
require 'includes/footer.inc'; 
?>