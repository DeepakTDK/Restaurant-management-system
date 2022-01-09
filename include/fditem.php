<?php

$mysqli = new mysqli('localhost', 'root', '', 'restaurant ms') or die(mysqli_error($mysqli));

//insert 
if(isset($_POST['submit'])){
    $fname = $_POST['fname'];
    $fprice = $_POST['fprice'];

    $mysqli->query("INSERT INTO food_items (f_name, f_price) VALUES ('$fname', '$fprice')") or 
    die($mysqli->error);
}

?>