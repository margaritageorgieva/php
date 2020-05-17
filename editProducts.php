<?php 
// stranica s vsichki produkti s vuzmojnost za redakciq i iztrivane
// proverka za potvurjdavane i iztrivane
 $confirm=NULL;
 if ($_POST) 
	{
	  if ($_POST['conf']=='YES') 
	  { 
		$navigation = ' / <a href="editProducts.php">Продукти</a>'; 
		$confirm='y';
	  }
	} 	
if ($_GET) 
	{ 
		$id=$_GET['id']; 
	} else {
		$id=NULL; 
	}
require 'includes/init.inc'; 
// konfig na $page_title
	$page_title = 'Продукти - Steak House';
require 'includes/header.inc'; 
print'<h1 id="h1-edit">Продукти</h1>'; 

$row_product = $result->fetch_assoc();
// iztrivane na product, zadeistva se ot ikonata za iztrivane v spisuka
	if ($confirm=='y') {
	 // SLED potvurjdenie triem produkta
	 $mysqli->query("DELETE FROM products WHERE product_id=".(int)$_POST['id']); 
	 $aff_rows = $mysqli->affected_rows; // kolko reda sa zasegnati ot SQL komandata
		if($aff_rows){
			// suobshtenie za broq na iztritite produkti
			print'<div class="infoBlock">Изтрити записи: '.$aff_rows.'</div>';
		}else{
			print'<div class="errorBlock">Няма изтрити записи</div>';
			$confirm=NULL;
		}
	}	

// izvejdane na suobshtenie za potvurjdenie na iztrivaneto
 if ($id!=NULL) { 
		print'<div class="errorBlock">
			<table><tr>
			 <td><b style=" color: red; margin-right: 1rem;">Наистина ли искате да изтриете продукта?</b></td> 
			 <form method="post" name="conf" action="'.$_SERVER['PHP_SELF'].'" class="form">
			 <input type="hidden" name="id" value="'.$id.'">
			 <td><input type="submit" class="YesCancel" name="conf" value="YES"></td>
			 <td><input type="submit" class="YesCancel" name="conf" value="CANCEL"></td>	
			 </form>
			 </tr></table>
			</div>';
	} 
// pokazvane na spisuka s produkti
// zaqvka kum BD za prochitane na info ot tablicata products
$result = $mysqli->query("SELECT * FROM products");
// ako ima vurnat result se izvejda info
if($result->num_rows>0){
// tablicata s vsichki jivotni
	print'<table class="table-list">
		<tr>
			<th>Редактиране</th><!-- колона за редактиране -->
			<th>Снимка</th>
			<th>Пореден номер и име</th>
			<th>Изтриване</th><!-- колона за изтриване -->
		</tr>'; 
	while($row = $result->fetch_assoc()){
		$pic = $row['picture'];
		$pic_exists = file_exists($pic);
		$name = htmlspecialchars(stripcslashes($row['name']));		
		print'<tr>
			<td><a href="editAproduct.php?id='.$row['product_id'].'"><img src="images/icons/edit.gif" alt="Редактиране" title="Редактиране">Редактиране</a></td>
			<td>';
			print'<img src=".'.$pic.'" title="'.$name.'" style="width:200px; height:150px;" alt="'.$name.'">';
		print'</td> 
			<td>'.$row['product_id'].'. '.$name.'</td>
			<td><a href="'.$_SERVER['PHP_SELF'].'?id='.$row['product_id'].'"><img src="images/icons/delete.gif" alt="Изтриване" title="Изтриване">Изтриване</a></td>	
		</tr>'; 
	}
	print'</table>';
}
require 'includes/footer.inc'; 
 ?>