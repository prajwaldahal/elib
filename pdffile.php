<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="css/pdf.css">
    <title>Elibary</title>
    <script src="js/inspect.js"></script>
</head>
<body oncontextmenu="return false">
    <?php
        session_start();
        require "Connection.php";
        if(!isset($_SESSION['uname']))
        {
            echo "<Script>alert('session_expired')</script>";
            header("Location:login.php");
        }
        $id=$_POST['id'];
        $query="select file from book where isbnNo= '$id'";
        $result= mysqli_query($con,$query);
        $row=mysqli_fetch_assoc($result);
        if(mysqli_num_rows($result)<=0)
            die();
        
    ?>
    <iframe src=<?php echo $row['file'] ?> ></iframe>
</body>
</html>