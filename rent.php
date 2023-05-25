<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/rent.css"/>
    <script src="js/datediff.js"></script>
    <script src="js/inspect.js"></script>
    <title>elibary</title>
   
</head>
<body oncontextmenu="return false">
    <?php
        require "Connection.php";
        if(!isset($_SESSION['uname']))
        {
            echo " <script> window.alert('session expired')</script> ";
            header("location:login.php");
            die();
        }
        $isbn=$_REQUEST['q'];
        $username=$_SESSION['uname'];
        $id=$username.substr($isbn,3,7);
        $sql="select BookName,rent from book where isbnNo='$isbn'";
        $pid=$isbn.floor(microtime(true));
        $result=mysqli_query($con,$sql);
        if(mysqli_num_rows($result)>0){
            $row=mysqli_fetch_assoc($result);
            $rent=$row['rent'];
            $name=$row['BookName'];
        }
        $sql="replace into temp(id,pid,isbnno,username) values('$id','$pid','$isbn','$username')";
        $result=mysqli_query($con,$sql);
        if(!$result)
        {
            echo "<script> window.alert('Something went wrong')</script>";
            header("location:login.php");
            die();
        }
    ?>
    <div class="container">
        <table>
            <tr>
                <th>ISBNNo</th>
                <td id="isbnno"> <?php echo $isbn?> </td>
            </tr>
            <tr>
                <th>book</th>
                <td> <?php echo $name?> </td>
            </tr>
            <tr>
                <th>Rent Price(per month)</th>
                <td> <?php echo "Rs. ".$rent?> </td>
            </tr>
            <tr>
                <th>upto date</th>
                <td> <input type="date"  name="date1" onchange=datediff(this.value,<?php echo $rent?>,"<?php echo $id?>")> </td>  
            </tr>
            <tr>
                <th>total</th>
                <td id="tot"></td>
            </tr>
            <tr>
                <td colspan=2 id="payment">
                    <form target="_top" action="https://uat.esewa.com.np/epay/main" method="POST">
                        <input value="0" name="tAmt" type="hidden">
                        <input value="0" name="amt" type="hidden">
                        <input value="0" name="txAmt" type="hidden">
                        <input value="0" name="psc" type="hidden">
                        <input value="0" name="pdc" type="hidden">
                        <input value="EPAYTEST" name="scd" type="hidden">
                        <input value="<?php echo $pid?>" name="pid" type="hidden">
                        <input value="http://localhost/elib/sucess.php" type="hidden" name="su">
                        <input value="http://localhost/elib/failure.php?q=<?php echo $id?>" type="hidden" name="fu">
                        <input value="pay with Esewa" type="submit" disabled/>
                    </form>
                </td>
            </tr>
        </table>
    </div>
</body>
</html>