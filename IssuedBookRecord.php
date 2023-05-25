<html>
    <head>
        <title>E-library</title>
        <link rel="stylesheet" href="css/TableStyle.css">
        <script  src="js/search.js" ></script>
        <script src="js/inspect.js"></script>
    </head>
    <body>
        <div class="container">
            <p>Book Rented</p>
            <form>
                <input type="text" onkeyUp="showSearch(0,0)" name="IsbnSearch" placeholder="Search by IsbnNo"/>
                <input type="text" onkeyUp="showSearch(2,1)" name="UserNameSearch" placeholder="Search by Username"/>
            </form>
            <table>
                <tr>
                    <th>ISBN</th>
                    <th>BookName</th>
                    <th>UserName</th>
                    <th>RentedDate</th>
                    <th>Upto</th>
                    <th>rent(per day)</th>
                </tr>
                    <?php
                        session_start();
                            if(!isset($_SESSION['aname']))
                            {
                                echo "<Script>alert('session_expired')</script>";
                                echo "<Script>open('login.php','_parent')</script>";
                                die();
                            }
                        require "Connection.php";
                        $query="select book.isbnno, bookname,username,rentedDate,upto,rent from book inner join rentedbook on book.isbnNo=rentedbook.Isbnno";
                        $result=mysqli_query($con,$query);
                        if(mysqli_num_rows($result)<=0)
                             die();
                        while($row=mysqli_fetch_assoc($result)){
                            echo "<tr>";
                                foreach($row as $val)
                                    echo "<td>$val</td>";
                            echo "</tr>";
                        }
                    ?>
            </table>
        </div>
    </body>
</html>