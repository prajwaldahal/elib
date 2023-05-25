<html>
    <head>
        <title>E-library</title>
       <link rel="stylesheet" href="css/AddBook.css"/>
       <script src="js/BookValid.js"></script>
       <script src="js/inspect.js"></script>
    </head>
    <body oncontextmenu="return false">
        <?php
            session_start();
            require "Connection.php";
            if(!isset($_SESSION['aname']))
            {
                echo "<Script>alert('session_expired')</script>";
                header("Location:login.php");
                die();
            }
            if(isset($_POST['add']))
            {   
                $extimg=array("jpg","jpeg","png");
                $name=trim($_POST['Bookname']);
                $publisher=trim($_POST['publisher']);
                $isbnno=$_POST['isbnno'];
                $author=$_POST['Author'];
                $rent=$_POST['rent'];
                $url=$_POST['link'];

                if(!isset($_FILES['cover'])){
                    header("Location:AddBook.php?msgc= cover pic not uploaded");
                    die();  
                }

                $filec=pathinfo($_FILES['cover']['name']);
                $extc=$filec['extension'];
                $fnamec=floor(microtime(true)).'.'.$extc;

                if(in_array(strtolower($extc),$extimg)){
                    move_uploaded_file($_FILES['cover']['tmp_name'],'coverpic/'.$fnamec);
                }
                else{
                    header("Location:AddBook.php?msgc=file format not supported $extc");
                    die();
                }
                
                $sql="insert into book values('$fnamec','$url','$name','$publisher','$isbnno',$rent)";
                mysqli_query($con,$sql);

                try{
                    $sql="insert into author values('','$isbnno','$author')";
                    mysqli_query($con,$sql);
                }catch(Exception $e){
                    echo $e;
                    if(mysqli_errno($con)==1062)
                    {
                        echo "<script>alert('isbnno already exist')</script>";
                    }
                    else{
                        echo $e;
                        echo "<script>alert('insertion error')</script>";
                    }
                }   
             }
        ?>
        <div class="bookcontainer">
            <h1>Add New Book</h1>
            <form method="post"  onsubmit="removeText(); return validate();" enctype="Multipart/form-data">
                <input type="text" placeholder="Book Name" name="Bookname"/>
                <input type="text" placeholder="Publisher" name="publisher"/>
                <input type="text" placeholder="Author" name="Author"/>
                <input type="text" placeholder="ISBN NO" name="isbnno"/>
                <input type="text" name="link"  placeholder="file link"/>
                <span>
                    <label for="cover">Upload cover pic</label>
                    <input type="file" name="cover" id="file" />
                    <?php
                        if(isset($_REQUEST['msgc'])){
                            $txt=$_REQUEST['msgc'];
                            echo "<p>$txt</p>";
                        }
                    ?>
                </span>
                <input type="number" name="rent"  placeholder="rent price"/>
                <input type="submit" value="Add" name="add"/>
             </form>
        </div>
    </body>
</html>