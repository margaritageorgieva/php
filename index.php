<?php 
// nachalna stranica
require 'includes/init.inc'; 

$page_title = 'Home'; // zaglavie na stranicata, polzva se v header.inc 
$kid=1;

require 'includes/header.inc'; 
//osnovna info v stranicata
// zaqvka za izvejdane na poslednite 3 vuvedeni produkta, svurzvame gi s JOIN
   $query = "SELECT * ,food_types.type FROM products JOIN food_types ON products.food_type_id=food_types.food_type_id"; //tova da go opravq i v drugite stranici
  $result = $mysqli->query($query);
  $num_results = 0;
  //var_dump($mysqli->error); // dava opisanie kude greshim
  
  if($result != NULL){
	$num_results = $result->num_rows;
  }
// ako ima vurnat result
  if($num_results>0){
	print'<table id="table-products"><tr>';
    $j=0;
    while($row = $result->fetch_assoc()){
	print'<td>';
		    $object_title = htmlspecialchars(stripslashes($row['name'].($row['type']?', '.$row['type']:'')));
			$small_pic = $row['picture'];
			$small_pic_exists = file_exists($small_pic); // dali ima snimka
    print'
        <a href="product.php?id='.$row['product_id'].'">
        	<img id="img-small" class="img-product" src=".'.$small_pic.'" alt="'.$object_title.'" title="'.$object_title.'">
        </a>              
        <h2 class="product-name">'.htmlspecialchars(stripslashes($row['name'])).'</h2>';
            if($row["type"]){
			 print'<div class="product-type">Вид: '.htmlspecialchars(stripslashes($row["type"])).'</div>';
            }
            if($row["price"]){
           	 print'<div class="product-price">'.$row["price"].' лв.</div>';
            }
			print'<a href="product.php?id='.$row["product_id"].'" class="more-info">Повече информация</a>
    </td>';
	  $i=0;
	  if($j==2)
	  {
	    if(($i+1)<$num_results)
	      print '</tr><tr>';
		$j = 0;
	  }
	  else
	    $j++;  
	}
	print'</tr></table>';
 	
  }
require 'includes/footer.inc'; 
?>