<!DOCTYPE html>
    <html>
        <head>
            <title>E-library</title>
            <link rel="stylesheet" href="css/Register.css"/>
            <script src="js/RegisterValid.js"></script>
            <script src="js/inspect.js"></script>
        </head>
        <body>
            <?php
                require "Connection.php";
                if(isset($_POST['Register']))
                {
                    $fname=$_POST['FirstName'];
                    $lname=$_POST['LastName'];
                    $name=$fname." ".$lname;
                    $address=$_POST['Address'];
                    $uname =$_POST['Username'];
                    $pwd =$_POST['Password'];
                    $sql="insert into user values('$uname','$name','$address','$pwd')";
                    try{
                        mysqli_query($con,$sql);
                        header("Location:login.php");
                    }catch(Exception $e){
                        if(mysqli_errno($con)==1062)
                        {
                            echo "<script>alert('Username already exist')</script>";
                        }
                        else{
                            echo "<script>alert('insertion error')</script>";
                        }
                    }
                }
            ?>
            <div id="container">
            <h1>REGISTER HERE</h1>
            <form onsubmit="removeText(); return validate();" method="post" action="register.php" novalidate>
                <input type="text" placeholder="FirstName" name="FirstName" id="fname"/>
                <input type="text" placeholder="LastName" name="LastName" id="lname"/>
                <input type="text" placeholder="Address" name="Address" id="adr"/>
                <input type="text" placeholder="Username" name="Username" id="uname"/>
                <input type="password" placeholder="Password" name="Password" id="pwd"/>
                <input  type="submit" value="Register" name="Register"/>
            </form>
        </body>
    </html>