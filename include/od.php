<?php

session_start();
error_reporting(0);

$mysqli = new mysqli('localhost', 'root', '', 'restaurant ms') or die(mysqli_error($mysqli));

$id = 0;
$update = false;
$id = '';
$invoice = '';
$date = '';
$fname = '';
$quantity = '';
$fprice = '';
$subtotal = '';

//insert 
if(isset($_POST['save'])){
    $id = $_POST['id'];
    $invoice = $_POST['invoice'];
    $date = $_POST['date'];
    $fname = $_POST['fname'];
    $quantity = $_POST['quantity'];
    $fprice = $_POST['fprice'];   
    $subtotal = $_POST['subtotal'];

    $mysqli->query("INSERT INTO orders (id, invoice, date, fname, quantity, fprice, subtotal) VALUES ('$id', '$invoice', '$date', '$fname', '$quantity', '$fprice', '$subtotal')") or 
    die($mysqli->error);

    $_SESSION['message'] = "Record saved!" ;
    $_SESSION['msg_type'] = "success" ;

    header("location: ../dist/orders.php");
}

//delete
if(isset($_GET['delete'])){
    $id = $_GET['delete'];
    $mysqli->query("DELETE from orders WHERE id = $id") or die($mysqli->error());

    $_SESSION['message'] = "Record deleted!" ;
    $_SESSION['msg_type'] = "danger" ;

    header("location: ../dist/orders.php");
}

//edit
if(isset($_GET['edit'])){
    $id = $_GET['edit'];
    $update = true;
    $result = $mysqli->query("SELECT * from orders WHERE id = $id") or die($mysqli->error());
    if(count($result) == 1){
        $row = $result->fetch_array();
        $id = $row['id'];
        $invoice = $row['invoice'];
        $date = $row['date'];
        $fname = $_row['fname'];
        $quantity = $row['quantity'];
        $fprice = $row['fprice'];   
        $subtotal = $row['subtotal'];
   
    }
}

if(isset($_POST['update'])){
    $id = $_POST['id'];
    $id = $_POST['id'];
    $invoice = $_POST['invoice'];
    $date = $_POST['date'];
    $fname = $_POST['fname'];
    $quantity = $_POST['quantity'];
    $fprice = $_POST['fprice'];   
    $subtotal = $_POST['subtotal'];
   

    $mysqli->query("UPDATE orders SET id = '$id', invoice = '$invoice', date = '$date', fname = '$fname', quantity = '$quantity', fprice = '$fprice', subtotal = '$subtotal' WHERE id = $id") or 
    die($mysqli->error);

    $_SESSION['message'] = "Record updated!";
    $_SESSION['msg_type'] = "warning";

    header("location: ../dist/orders.php");
}

?>