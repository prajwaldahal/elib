<?php
    session_start();
     try{
         require "Connection.php";
         $username=$_POST['username'];
         $password=$_POST['password'];
         if(empty($username)||empty($password))
         {
            header("Location:login.php?msgsu=username is empty&msgsp=password is empty");
            exit();
         }           
        $sql="select * from user where username='$username' and password='$password'";
        $result=mysqli_query($con,$sql);
        if(mysqli_num_rows($result)!=1)
        {
            header("Location:login.php?msgs=username or password doesnt match");
            exit();
        }
        else
        {
                session_regenerate_id(true);
                $_SESSION['uname']=$username;
                print_r($_SESSION);
                header("Location:userui.php");  
        }
    }catch(Exception $e){
            echo "<Script>alert('Error')</script>";
    }
?>