<?php 
// stranica za spisuk s jivotni - izkarvame jivotni ot vid $kid ili - vsichki
require 'includes/init.inc'; 
$link_text = '';
$kid =  (int)$_REQUEST['kid']; // zashtita - preobr kum cqlo chislo
if($kid) { // ako e zadaden parametur
	$query = "SELECT * FROM food_types WHERE food_type_id=".$kid; 
	$result = $mysqli->query($query);
	$row = $result->fetch_assoc();
	$link_text = htmlspecialchars(stripcslashes($row['type']));
}
// Конфигуриране на променливите $navigation и $page_title
//$navigation = ' / <a href="'.$_SERVER['PHP_SELF'].($kid?'?kid='.$kid:'').'">'.$link_text.'</a>';
$page_title = $link_text.' - Steak house';

require 'includes/header.inc';

print'<h1>'.$link_text.'</h1>';
// zaqvka za izvlichane na info za jivotnite ot opredelen vid
  $query = "SELECT food.*, food_types.type FROM food "
  		." JOIN food_types ON food.food_type_id=food_types.food_type_id "
  		.($kid?" WHERE food.food_type_id=".$kid:"")." ORDER BY product_id ASC";
  $result = $mysqli->query($query);
  $num_results = $result->num_rows;
  if($num_results>0){
	print'<table class="table-view"><tr>';
    $j=0;
    while($row = $result->fetch_assoc()){
	print'<td>';
		 $object_title = htmlspecialchars(stripslashes($row['name'].($row['weight']?', '.$row['weight']:'')));
		 $small_pic = $food_pictires_dir.$food_pictires_small_prefix.$row['picture'];
		 $small_pic_exists = file_exists($small_pic); // dali sushtestvuva snimka
        print'<a href="product.php?id='.$row['product_id'].'">
        	<img class="img-product" src="'.$small_pic.'" alt="'.$object_title.'" title="'.$object_title.'">
        </a>              
        <h2 class="product-name">'.htmlspecialchars(stripslashes($row['name'])).'</h2>';
        if($row["weight"]){
           	print'<div class="product-weight">Грамаж: '.htmlspecialchars(stripslashes($row["weight"])).'гр.</div>';
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