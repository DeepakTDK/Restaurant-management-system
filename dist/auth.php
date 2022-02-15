<?php

session_start();
if(isset($_POST["login"])){
    if(isset($_POST["username"])&&($_POST["username"] == "admin")&&
    isset($_POST["password"])&&($_POST["password"] == "123"))
    {
        $_SESSION["Authenticated"]=1;
    }
    else{
        $_SESSION["Authenticated"] = 0;
        header("location: index.html");
    }
    session_write_close();
    header("location: index.php");
}

if(isset($_GET["logout"])){
    session_destroy();
    header("location: index.html");
}





?>



