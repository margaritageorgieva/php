<?php 
// stranica za spisuka sus vsichki jivotni ot vid $kid ili vsichki
require 'includes/init.inc'; 
$link_text = '';
$kid =  (int)$_REQUEST['kid']; // zashtita - preobrazuvane do cqlo chislo
if($kid) { // ako ima zadaden parametur
	var_dump($kid);
	$query = "SELECT * FROM food_types WHERE food_type_id=".$kid; 
	$result = $mysqli->query($query);
	$row = $result->fetch_assoc();
	$link_text = htmlspecialchars(stripcslashes($row['type']));

}
// konfigurirane na promenlivata $page_title
$page_title = $link_text.' - Steak House';

require 'includes/header.inc';

print'<h1>'.$link_text.'</h1>';
// zaqvka za izvlichane na produktite ot opredelen vid
  $query = "SELECT * ,food_types.type FROM products JOIN food_types ON products.food_type_id=food_types.food_type_id"
  		.($kid?" WHERE food.food_type_id=".$kid:"")." ORDER BY product_id ASC";
  $result = $mysqli->query($query);
  $num_results = 0;
  //var_dump($mysqli->error); // dava opisanie kude greshim
  
  if($result != NULL){
	$num_results = $result->num_rows;
  }  if($num_results>0){
	print'<table class="table-view"><tr>';
    $j=0;
    while($row = $result->fetch_assoc()){
	print'<td>';
		 $object_title = htmlspecialchars(stripslashes($row['name'].($row['type']?', '.$row['type']:'')));
		 $small_pic = $food_pictures_dir.$food_pictures_small_prefix.$row['picture'];
		 $small_pic_exists = file_exists($small_pic); // dali ima snimka
        print'<a href="product.php?id='.$row['product_id'].'">
        	<img class="img-product" src="'.$small_pic.'" alt="'.$object_title.'" title="'.$object_title.'">
        </a>              
        <h2 class="product-name">'.htmlspecialchars(stripslashes($row['name'])).'</h2>';
        if($row["type"]){
           	print'<div class="product-type">Вид: '.htmlspecialchars(stripslashes($row["type"])).'</div>';
        }
        if($row["price"]){
           	print'<div class="product-price">'.$row["price"].' лв.</div>';
        }
        print'<a href="product.php?id='.$row["product_id"].'" id="more-info">Повече информация</a>
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