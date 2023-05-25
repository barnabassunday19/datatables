<?php
    session_start();
    unset($_SESSION["ID"]);
    unset($_SESSION["name"]);
    header("Location:login.php");
?>