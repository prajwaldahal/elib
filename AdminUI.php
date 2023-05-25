<?php
    session_start();
    if(!isset($_SESSION['aname']))
    {
        echo "<Script>alert('session_expired')</script>";
        header("Location:login.php");
        die();
    }
?>
<html>
    <head>
        <title>E-library</title>
        <link rel="stylesheet" href="css/Ui.css">
		<script  src="js/admin.js" ></script>
        <script src="js/inspect.js"></script>
    </head>
    <body oncontextmenu="return false">
        <div id="container">
            <span>
                <button onclick=changeui(this.firstChild.nodeValue)>Book report</button>
                <button onclick=changeui(this.firstChild.nodeValue)>Add Book</button>
                <button onclick=changeui(this.firstChild.nodeValue)>Book rented</button>
                <button onclick=changeui(this.firstChild.nodeValue)>User List</button>
                <button onclick=changeui(this.firstChild.nodeValue)>Logout</button>
            </span>
			<iframe src= "BookReport.php"></iframe>
        </div>
    </body>
</html>