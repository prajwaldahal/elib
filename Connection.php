<?php
    try{
        $con = mysqli_connect("localhost","root","","elibrary","3307");
    }catch(exception $e){
        echo $e;
    }
?>