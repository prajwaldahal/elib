<html>
    <head>
        <title>E-library</title>
        <link rel="stylesheet" href="css/TableStyle.css"/>
        <script  src="js/search.js" ></script>
        <script src="js/inspect.js"></script>
    </head>
    <body>
        <div class="container">
            <p>User List</p>
            <form>
                <input type="text" onkeyUp="showSearch(0,0)" name="USearch" placeholder="Search by UserName"/>
            </form>
            <table>
                <tr>
                    <th>UserName</th>
                    <th>FullName</th>
                    <th>Address</th>
                </tr>
                <?php
                    session_start();
                    require "Connection.php";
                        if(!isset($_SESSION['aname']))
                         {
                             echo "<Script>alert('session_expired')</script>";
                             echo "<Script>open('login.php','_parent')</script>";
                             die();
                         }
                     try{               
                        $sql="select UserName,name,address from user";
                        $result=mysqli_query($con,$sql);
                        if(mysqli_num_rows($result)<=0)
                            die();
                        while($row=mysqli_fetch_assoc($result)){
                            echo "<tr>";
                                foreach($row as $val)
                                    echo "<td>$val</td>";
                            echo "</tr>";
                        }
                    }catch(Exception $e){
                            echo "<Script>alert('Error')</script>";
                    }
                ?>
            </table>
        </div>
    </body>
</html>