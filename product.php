<?php 
// stranica za jivotno - pokazva informaciqta za produkt s primary key $id
require 'includes/init.inc';

$id = (int)$_REQUEST['id'];// zashtita - preobrazuva do cqlo chislo
if($id) { // ako $id e zadaden
// zaqvka za izvejdane na info za produkt
	$query = "SELECT * ,food_types.type FROM products JOIN food_types ON products.food_type_id=food_types.food_type_id 
				WHERE product_id=".$id;
    $result = $mysqli->query($query);
	$row_product = $result->fetch_assoc();
// config na promenlivata $page_title
	$page_title = 'Steak House - '.htmlspecialchars(stripcslashes($row_product['name']));
}

require 'includes/header.inc'; 

// izvejdame infoto za produkta
print'	
<table class="product-info-table">
	
	<tr>
		<td>
		
            <h1>'.htmlspecialchars(stripslashes($row_product['name'])).'</h1>';
            if($row_product["food_type_id"]){
                print'<div class="single-prod">Вид: '.htmlspecialchars(stripslashes($row_product["type"])).'</div>';
            }
			if($row_product["weight"]){
           		print'<div class="single-prod">Грамаж: '.htmlspecialchars(stripslashes($row_product["weight"])).'гр.</div>';
           	}
        	if($row_product["price"]){
           		print'<div class="single-prod">Цена: '.$row_product["price"].' лв.</div>';
        	}
        	if($row_product["info"]){
           		print'<div class="single-prod">Описание: '.htmlspecialchars(stripslashes($row_product["info"])).'</div>';
        	}     
        '	 
		</td>
	
	
	</tr>
		<td>';
			   $object_title = htmlspecialchars(stripslashes($row_product['name'].($row_product['food_type_id']?', '.$row_product['food_type_id']:'')));
			   $pic = $row_product['picture'];
			   $pic_exists = file_exists($pic); // dali sushtestvuva snimka
			print'<a href=".'.$pic.'" class="single-prod" target="_blank"><img id="img-big" src=".'.$pic.'" alt="'.$object_title.'" title="'.$object_title.'"></a>			
		</td>

	</tr>
	
</table>';
require 'includes/footer.inc'; 
 ?>