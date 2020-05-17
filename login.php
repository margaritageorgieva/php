<?php
//stranica za vpisvane v admin
require 'includes/init.inc';
$errorMessage = NULL;

//dve promenlivi - za navigaciqta i zaglavieto na stranicata
$page_title = 'Вход - Steak House';
$nsvigation = ' / <a href="' . $_SERVER['PHP_SELF'] . '">Вход</a>';

if ($_POST) {
    $_POST['username'] = $mysqli->escape_string(trim($_POST['username']));
    $_POST['pass'] = $mysqli->escape_string(trim($_POST['pass']));
    $query = "SELECT * FROM people WHERE username='" . $_POST['username'] . "' AND pass='" . $_POST['pass'] . "'";
    $result = $mysqli->query($query);
    if ($row = $result->fetch_assoc()) {
        //vajnite danni se zapisvat, za da se polzvat v drugite stranici dokato trae sesiqta
        $_SESSION['person_type'] = $row['person_type'];
        header("Location: editProducts.php"); //prashtame user-a v stranicata za redaktirane na produktite
        exit;
    } else {
        $errorMessage = 'Невалидни потребителско име и/ли парола!';
    }
}

require 'includes/header.inc';

if($errorMessage!=NULL){
    print'<div class="errorBlock">'.$errorMessage.'</div>';
}

print'<form method="post" name="f" action="'.$_SERVER['PHP_SELF'].'" class="form">
<div class="form-title">Вход</div>
<div class="form-row">
    <label for="usernameid">Потребителско име</label> <br>
    <input type="text" maxlength="16" name="username" id="usernameid" value="">
</div>
<div class="form-row">
    <label for="passid">Парола</label> <br>
    <input type="password" maxlength="16" name="pass" id="passid" value="">
</div>
<div class="form-row" >
    <input type="submit" class="btn-submit" name="submit" value="Вход" id = "button">
</div>    
</form>
</div>';
require 'includes/footer.inc'; 
?> 