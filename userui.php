<?php
    session_start();
     if(!isset($_SESSION['uname']))
    {
        echo "<Script>alert('session_expired')</script>";
        echo "<Script>open('login.php','_parent')</script>";
        die();
    }
?>
<html>
    <head>
        <title>E-library</title>
        <link rel="stylesheet" type=text/css href="css/Ui.css"/>
        <script src="js/user.js"></script>
        <script src="js/inspect.js"></script>
    </head>
    <body oncontextmenu="return false">
        <div id="container">
            <span>
                <button onclick=changeui(this.firstChild.nodeValue)>Available Book List</button>
                <button onclick=changeui(this.firstChild.nodeValue)>Book Rented</button>
                <button onclick=changeui(this.firstChild.nodeValue)>Logout</button>
            </span>
            <iframe src="AvailableBookList.php"></iframe>
        </div>
    </body>   
</html>
<?php
    require "Connection.php";
    $uname=$_SESSION['uname'];
    $query="delete from rentedbook where isbnno in (select isbnno from rentedbook where userName='$uname' and datediff(upto,curdate())<0) and userName='$uname'";
    mysqli_query($con,$query);
?>