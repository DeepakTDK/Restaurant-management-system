<?php

session_start();
error_reporting(0);

$mysqli = new mysqli('localhost', 'root', '', 'restaurant ms') or die(mysqli_error($mysqli));

$id = 0;
$update = false;
$id = '';
$fname = '';
$fprice = '';

//insert 
if(isset($_POST['save'])){
    $id = $_POST['id'];
    $fname = $_POST['fname'];
    $fprice = $_POST['fprice'];   

    $mysqli->query("INSERT INTO food_items (id, fname, fprice) VALUES ('$id', '$fname', '$fprice')") or 
    die($mysqli->error);

    $_SESSION['message'] = "Record saved!" ;
    $_SESSION['msg_type'] = "success" ;

    header("location: ../dist/fdet.php");
}

//delete
if(isset($_GET['delete'])){
    $id = $_GET['delete'];
    $mysqli->query("DELETE from food_items WHERE id = $id") or die($mysqli->error());

    $_SESSION['message'] = "Record deleted!" ;
    $_SESSION['msg_type'] = "danger" ;

    header("location: ../dist/fdet.php");
}

//edit
if(isset($_GET['edit'])){
    $id = $_GET['edit'];
    $update = true;
    $result = $mysqli->query("SELECT * from food_items WHERE id = $id") or die($mysqli->error());
    if(count($result) == 1){
        $row = $result->fetch_array();
        $id = $row['id'];
        $fname = $row['fname'];
        $fprice = $row['fprice'];   
    }
}

if(isset($_POST['update'])){
    $id = $_POST['id'];
    $id = $_POST['id'];
    $fname = $_POST['fname'];
    $fprice = $_POST['fprice'];   

    $mysqli->query("UPDATE food_items SET id = '$id', fname = '$fname', fprice = '$fprice' WHERE id = $id") or 
    die($mysqli->error);

    $_SESSION['message'] = "Record updated!";
    $_SESSION['msg_type'] = "warning";

    header("location: ../dist/fdet.php");
}

?>