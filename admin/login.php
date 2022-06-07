<?php
require('connection.inc.php');
$msg='';
if(isset($_POST['submit'])){
	$username=trim($_POST['username']);
	$password=trim($_POST['password']);
	$sql="select * from admin_users where username = '$username' and password = '$password' ";
	$res = mysqli_query($con,$sql);
	$count = mysqli_num_rows($res);
	if($count  > 0){
		$_SESSION['ADMIN_LOGIN']='yes';
		$_SESSION['ADMIN_USERNAME']=$username;
		header('location:home.php');
		die();
	}else{
		$msg="Prosze podać prawidłowe dane!";	
	}
	
}
?>
<!doctype html>
<html>
   <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
   <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <link rel="stylesheet" type="text/css" href="../css/styleAdmin_login.css" />
      <title>Login</title>
   </head>
   <body>
                  <form class = "login" method="post" action = "">
                  <h1>Logowanie admin</h1>
                        
                        <input type="text" name="username"  placeholder="Username" required>
                        
                        <input type="password" name="password"  placeholder="Password" maxlength="6" required>
                     
                     <button type="submit" name="submit" >Zaloguj</button><br>
                     <div class="field_error"><?php echo $msg?></div>
					</form>
					
               
   </body>
</html>