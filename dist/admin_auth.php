<?php

session_start();
if(!isset($_SESSION["Authenticated"]) || ($_SESSION["Authenticated"] !=1)){

    header("location: index.html");
    exit();
}
?>