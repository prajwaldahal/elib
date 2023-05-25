<?php
    session_start();
     try{
         require "Connection.php";
         $username=$_POST['username'];
         $password=$_POST['password'];
         if(empty($username)||empty($password))
         {
            header("Location:login.php?msgu=username is empty&msgp=password is empty");
            exit();
         }               
        $sql="select * from admin where username='$username' and password='$password'";
        $result=mysqli_query($con,$sql);
        if(mysqli_num_rows($result)<=0)
        {
            header("Location:login.php?msg3=username or password doesnt match");
            exit();
        }
        else
        {
            $_SESSION['aname']=$username;
            header("Location:AdminUI.php");  
        }
    }catch(Exception $e){
            echo "<Script>alert('Error')</script>";
    }
?>