<?php
    session_start();
    if(!isset($_SESSION['uname']))
        {
            echo "<Script>alert('session_expired')</script>";
            echo "<Script>open('login.php','_parent')</script>";
            die();
        }
    require "Connection.php";
   function datediff($date){
        $diff = date_diff(date_create(date('Y-m-d')),date_create($date));
        $val=$diff->format("%R%a");
        $val=intval($val);
        return $val;
   }
   function rent($rent,$date){
        $x=-1;
        if(datediff($date)<=0)
            return $x;
        else{
            $total=ceil(datediff($date)/30*$rent);
            return $total;
        } 
   }
   if(isset($_GET['data'] ) && isset($_GET['rent']) && isset($_GET['id'])){
        $date = $_GET['data'];
        $uname=$_SESSION['uname'];
        $rent =$_GET['rent'];
        $id=$_GET['id'];
        $pp=rent($rent,$date);
        echo $pp;
        $sql="update temp set upto='$date',totalprice=$pp where id='$id'";
        $result=mysqli_query($con,$sql);
        if(!$result)
        {
            echo " <script> window.alert('Something went wrong')</script> ";
            die();
        }
    }
?>