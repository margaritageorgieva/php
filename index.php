<?php
//home page
require 'includes/init.inc';

$page_title = "Home";
$kid = 1;
require 'includes/header.inc';

// zaqvka za izvejdane na poslednite 3 vuvedeni produkta. Suedinqvame gi s JOIN
$query = "SELECT food.*, food_types.type FROM food 
JOIN food_types ON food.food_type_id=food_types.food_type_id "
    . ($kid ? " WHERE food.food_type_id=" . $kid : "") . " ORDER BY product_id DESC LIMIT 3";
$result = $mysqli->query($query);
$num_results = $result->num_rows;

//ako ima vurnat rezultat
if ($num_results > 0) {
    print '<table class="table-view"><tr>';
    $j = 0;
    while ($row = $result->fetch_assoc()) {
        print '<td>';
        $object_title = htmlspecialchars(stripslashes($row['name'] . ($row['type'] ? ', ' . $row['type'] : '')));
        $small_pic = $food_pictires_dir . $food_pictires_small_prefix . $row['picture'];
        $small_pic_exists = file_exists($small_pic); // dali ima snimka

        print '
            <a href="product.php?id=' . $row['product_id'] . '">
                <img class="img-product" src="' . $small_pic . '" alt="' . $object_title . '" title="' . $object_title . '">
            </a>              
            <h2 class="product-name">' . htmlspecialchars(stripslashes($row['name'])) . '</h2>';
        if ($row["type"]) {
            print '<div class="food-type">Порода: ' . htmlspecialchars(stripslashes($row["type"])) . '</div>';
        }
        if ($row["price"]) {
            print '<div class="animal-price">' . $row["price"] . ' лв.</div>';
        }
        print '<a href="product.php?id=' . $row["product_id"] . '" class="more-info">Повече информация</a>
        </td>';

        $i = 0;
        if ($j == 2) {
            if (($i + 1) < $num_results)
                print '</tr><tr>';
            $j = 0;
        } else
            $j++;
    }
    print '</tr></table>';
}


require 'includes/footer.inc';
