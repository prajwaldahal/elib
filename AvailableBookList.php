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
        <link rel="stylesheet" href="css/TableStyle.css"/>
        <script  src="js/search.js" ></script>
        <script src="js/inspect.js"></script>
    </head>
    <body>
        <div class="container">
            <p>Book List</p>
            <form>
                <input type="text" onkeyUp="showSearch(1,0)" name="IsbnSearch" placeholder="Search by IsbnNo"/>
            </form>
            <table>
                <tr>
                    <th></th>
                    <th>ISBN No</th>
                    <th>Book Name</th>
                    <th>Author</th>
                    <th>Publisher</th>
                    <th></th>
                </tr>
                <?php
                    require "Connection.php";
                    $username=$_SESSION['uname'];
                     try{
                        $sql="select coverpic,BookName,publisher,isbnNo,Rent from book where isbnno not in (select isbnno from rentedbook where userName='$username')";
                        $result=mysqli_query($con,$sql);
                        if(mysqli_num_rows($result)==0)
                             die();
                        while($row=mysqli_fetch_assoc($result))
                        {
                            $isbnno=$row['isbnNo'];
                            $img=$row['coverpic'];
                            $sql="select name from author where IsbnNo='$isbnno'";
                            $resultAuthor=mysqli_query($con,$sql);
                            echo "<tr>";
                                echo "<td> <img src='coverpic/$img' alt='wert' width='200'/> </td>";
                                echo "<td>$isbnno</td>";
                                echo "<td>".$row['BookName']."</td>";
                                echo "<td>";
                                    while($rowAuthor=mysqli_fetch_assoc($resultAuthor))
                                         echo $rowAuthor['name']."<br/>";
                                echo   "</td>";
                                echo "<td>".$row['publisher']."</td>";
                                echo "<td><a href='rent.php?q=$isbnno'>Rent Book</a></td>";
                            echo"</tr>";

                        }
                    }catch(Exception $e){
                            echo "<Script>alert('server error')</script>";
                            die();
                    }
                ?> 
            </table>
        </div>
        
</html>