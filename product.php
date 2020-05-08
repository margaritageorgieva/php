<?php 
// stranica za jivotno - pokazva informaciqta za produkt s primary key $id
require 'includes/init.inc';

$id = (int)$_REQUEST['id'];// zashtita - preobrazuva do cqlo chislo
if($id) { // ako $id e zadaden
// zaqvka za izvejdane na info za produkt
	$query = "SELECT food.*, food_types.type, DATE_FORMAT(registration_date,'%d.%m.%Y г.') AS date_formated "
	." FROM food JOIN food_types ON food.food_type_id=food_types.food_type_id WHERE product_id=".$id;
    $result = $mysqli->query($query);
	$row_product = $result->fetch_assoc();
// config na promenlivite $navigation i $page_title
	//$navigation = ' / <a href="productS.php'.($row_product['food_type_id']?'?kid='.$row_product['food_type_id']:'').'">'.htmlspecialchars(stripcslashes($row_product['type'])).'</a>'
	//		.' / <a href="'.$_SERVER['PHP_SELF'].($id?'?id='.$id:'').'">'.htmlspecialchars(stripcslashes($row_product['name'])).'</a>';
	$page_title = 'Steak House - '.htmlspecialchars(stripcslashes($row_product['name']));
}

require 'includes/header.inc'; 

// izvejdame infoto za produkta
print' <div style="text-align: left">	
<table class="product-info-table">
	<tr><td>&nbsp;</td></tr>
	<tr>
		<td>
            <h1>'.htmlspecialchars(stripslashes($row_product['name'])).'</h1>';
            if($row_product["type"]){
                print'<div>Вид: '.htmlspecialchars(stripslashes($row_product["type"])).'</div>';
            }
			if($row_product["weight"]){
           		print'<div>Грамаж: '.htmlspecialchars(stripslashes($row_product["weight"])).'гр.</div>';
           	}
        	if($row_product["price"]){
           		print'<div>Цена: '.$row_product["price"].' лв.</div>';
        	}
        	if($row_product["info"]){
           		print'<div>Описание: '.htmlspecialchars(stripslashes($row_product["info"])).'</div>';
        	}     
        '	
		</td>
	</tr>
	<tr><td>&nbsp;</td></tr>
	<tr>
		<td>';
			   $object_title = htmlspecialchars(stripslashes($row_product['name'].($row_product['food_type_id']?', '.$row_product['food_type_id']:'')));
			   $pic = $food_pictires_dir.$row_product['picture'];
			   $pic_exists = file_exists($pic); // dali sushtestvuva snimka
			print'<img class="img-product" src="'.$pic.'" alt="'.$object_title.'" title="'.$object_title.'">			
		</td>
	</tr>
</table>             
</div>';
require 'includes/footer.inc'; 
 ?>