<?php
    require "Connection.php";
    if(isset($_REQUEST['q'])){ 
        $id=$_REQUEST['q'];
        $query="delete from temp where id='$id'";
        mysqli_query($con,$query);
        header("Location:userui.php");
    }     
?>