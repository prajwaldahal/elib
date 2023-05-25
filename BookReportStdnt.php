<html>
    <head>
        <title>E-library</title>
        <link rel="stylesheet" href="css/TableStyle.css"/>
        <script  src="js/search.js" ></script>
        <script src="js/inspect.js"></script>
    </head>
    <body>
        <div class="container">
            <p>Book Report</p>
            <form>
                <input type="text" onkeyUp="showSearch(1,0)" name="IsbnSearch" placeholder="Search by IsbnNo"/>
            </form>
            <table>
                <tr>
                    <th></th>
                    <th>ISBN</th>
                    <th>Book Name</th>
                    <th>Issued </br> Date</th>
                    <th>Remaining </br> Day</th>
                    <th></th>
                </tr>
                <?php
                    session_start();
                    require "Connection.php";    
                    if(!isset($_SESSION['uname']))
                    {
                        echo "<Script>alert('session_expired')</script>";
                        echo "<Script>open('login.php','_parent')</script>";
                        die();
                    }
                    
                    $username=$_SESSION['uname'];
                     try{
                        $sql="select book.Isbnno,coverpic,rentedDate,BookName,datediff(upto,curdate()) as remainday from book inner join rentedbook on                                              book.isbnNo=rentedbook.Isbnno where rentedbook.userName='$username'";
                        $result=mysqli_query($con,$sql);
                        if(mysqli_num_rows($result)<0)
                        {
                            echo "<Script>alert('You have not rented book')</Script>";
                            die();
                        }
                        while( $row=mysqli_fetch_assoc($result)){
                            $isbnNo=$row['Isbnno'];
                            $img=$row['coverpic'];
                            echo "<tr>";
                                echo "<td> <img src='coverpic/$img' width='200'/> </td>";
                                echo "<td>".$row['Isbnno']."</td>";
                                echo "<td>".$row['BookName']."</td>";
                                echo "<td>".$row['rentedDate']."</td>";
                                echo "<td>".$row['remainday']."Days</td>";
                                echo "<td>
                                <form target='_top' action='pdffile.php' method='post'>
                                <input type='hidden' name='id' value=$isbnNo>
                                <input type='submit' value='Read Book'>
                                </form> 
                                </td>";
                            echo"</tr>";
                        }
                     }catch(Exception $e)
                     {
                        echo "<Script>alert('Error')</script>";
                     }
                ?> 
            </table>
        </div>
    </body>
</html>
