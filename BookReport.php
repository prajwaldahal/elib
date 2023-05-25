<html>
    <head>
        <title>E-library</title>
        <link rel="stylesheet" href="css/TableStyle.css">
        <script  src="js/search.js" ></script>
        <script src="js/inspect.js"></script>
    </head>
    <body>
        <div class="container">
            <p>Book Report</p> 
            <form>
                <input type="text" onkeyUp="showSearch(1,0)" name="USearch" placeholder="Search by Isbn"/>
            </form>
            <table >
                <tr>
                    <th></th>
                    <th>ISBN no</th>
                    <th>Book Name</th>
                    <th>Author</th>
                    <th>Publisher</th>
                    <th>Rent(per month)</th>
                </tr>
                 <?php
                        session_start();
                     try{
                         require "Connection.php";
                        if(!isset($_SESSION['aname']))
                        {
                            echo "<Script>alert('session_expired')</script>";
                            echo "<Script>open('login.php','_parent')</script>";
                            die();
                        }
                         if(isset($_REQUEST['q']))
                         {
                             $isbn=$_REQUEST['q'];
                             $querycheck="select isbnno from rentedbook where isbnno='$isbn'";
                             $result=mysqli_query($con,$querycheck);

                             if(mysqli_num_rows($result)==0){

                                $queryfile="select coverpic from book where isbnno='$isbnno'";
                                $result=mysqli_query($con,$queryfile);
                                $row=mysqli_fetch_assoc($result);

                                $img=$row['coverpic'];

                                $queryDeleteAuthor="delete from author where isbnNo='$isbn'";
                                mysqli_query($con,$queryDeleteAuthor);

                                $sql="delete from book where isbnno='$isbn'";
                                mysqli_query($con,$sql);

                                unlink('coverpic/'.$img);

                                echo "<Script>alert('deleted')</Script>";
                             }
                             else{
                                echo "<Script>alert('Book is in rent')</Script>";
                             }
                         }
                        $sql="select coverpic,BookName,publisher,isbnNo,Rent from book";
                        $result=mysqli_query($con,$sql);
                        if(mysqli_num_rows($result)<0)
                            die();
                        while(true)
                        {

                            $row=mysqli_fetch_assoc($result);
                            if(is_null($row))
                                break;
                            $IsbnNo=$row['isbnNo'];
                            $sql="select name from author where IsbnNo='$IsbnNo'";
                            $resultAuthor=mysqli_query($con,$sql);
                            $img=$row['coverpic'];

                            echo "<tr>";
                                echo "<td> <img src='coverpic/$img' alt='wert' width='200'/> </td>";
                                echo "<td>".$IsbnNo."</td>";
                                echo "<td>".$row['BookName']."</td>";
                                    echo "<td>";
                                       while(true)
                                       {
                                            $rowAuthor=mysqli_fetch_assoc($resultAuthor);
                                            if(is_null($rowAuthor))
                                                break;
                                            echo $rowAuthor['name']."<br/>";
                                       }
                                    echo   "</td>";
                                echo "<td>".$row['publisher']."</td>";
                                echo "<td>".$row['Rent']."</td>";
                                echo "<td><a href='BookReport.php?q=$IsbnNo'>Remove</a></td>";
                            echo"</tr>";
                            
                        }
                    }catch(Exception $e){
                            echo $e;
                            echo "<Script>alert('Error')</script>";
                    }
                ?> 
            </table>
        </div>
    </body>
</html>