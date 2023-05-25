<?php
    session_start();
    unset($_SESSION['aname']);
    header("Location:login.php");
?>