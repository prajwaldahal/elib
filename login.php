 <?php
    if(isset($_SESSION['uname'])){
        echo "you are already logged in please close it first";
        die();
    }
 ?>
<html>
	<head>
		<title>E-library</title>
		<link rel="stylesheet" href="css/login.css"/>
	<body>
		<div id="outer">
			<div id="container">
				<h1>USER LOGIN</h1>
				<img src="images/user.jpg" alt="for user only"/>
				<div>
					<form method="post" action="user.php">
                    <input type="text" placeholder="USERNAME HERE" name="username"/>
                        <?php
                            if(isset($_REQUEST['msgsu']))
                            {
                                echo"<p>".$_REQUEST['msgsu']."</p>";
                                unset($_REQUEST['msgsu']);   
                            }
                        ?>
						<input type="password" placeholder="PASSWORD HERE" name="password"/>
                        <?php
                            if(isset($_REQUEST['msgsp']))
                            {
                                echo"<p>".$_REQUEST['msgsp']."</p>";
                                unset($_REQUEST['msgsp']);  
                            }
                            if(isset($_REQUEST['msgs']))
                            {
                                echo"<p>".$_REQUEST['msgs']."</p>";
                                unset($_REQUEST['msgs']); 
                            }
                        ?>
						<input type="submit" value="Login" name="login"/>
					</form>
					<a href="register.php">Create new Account?</a>
				</div>
			</div>
			<div id="container2">
				<h1>ADMIN LOGIN</h1>
				<img src="images/admin.jpg" alt="for admin only"/>
				<div>
					<form method="post" action="admin.php">
						<input type="text" placeholder="USERNAME HERE" name="username"/>
                        <?php
                            if(isset($_REQUEST['msgu']))
                            {
                                echo"<p>".$_REQUEST['msgu']."</p>";
                                unset($_REQUEST['msgu']);   
                            }
                        ?>
						<input type="password" placeholder="PASSWORD HERE" name="password"/>
                        <?php
                            if(isset($_REQUEST['msgp']))
                            {
                                echo"<p>".$_REQUEST['msgp']."</p>";
                                unset($_REQUEST['msgv']);  
                            }
                            if(isset($_REQUEST['msg3']))
                            {
                                echo"<p>".$_REQUEST['msg3']."</p>";
                                unset($_REQUEST['msg3']); 
                            }
                        ?>
						<input type="submit" value="Login" name="login"/>
					</form>
				</div>
			</div>
		</div>
	</body>
</html>