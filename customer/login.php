<?php

require_once "connection.php"; 
$error='';
session_start();
if(isset($_POST['submit']))
{   
    $email=$_POST['email'];
    $passwd=$_POST['passwd'];
    $sql="SELECT * FROM customer WHERE Email='$email' AND Password='$passwd' ";
    $query=$dbhandler->query($sql);
    if($r=$query->fetch(PDO::FETCH_ASSOC))
    {
        $_SESSION['USER_LOGIN']='yes';
		$_SESSION['USER_EMAIL']=$email;
        $_SESSION['USER_ID']=$r['Id'];
        header("Location: ./welcome.php");
        die();
    }
    else{
        $error="Username/Password Invalid !!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>login</title>
</head>

<body>
    <link rel="stylesheet" type="text/css" href="../css/style_login.css" />
    <div class="message">
    <p>
        <?php
        // if(isset($_SESSION['MESSAGE']) && $_SESSION['MESSAGE'] != '')
        //   {
        //       echo $_SESSION['MESSAGE'];
        //       session_destroy();
        //   }
        ?>
    </p>
    </div>
    <form class="login" action="" method="POST"> 
        <h1>Zaloguj się do naszego sklepu!</h1>
        <div class="error">
              <p><?php echo $error ;?></p>
         </div>
         <div class="logowanie">
        <input type="email" name="email" placeholder="Podaj Email" /required> <br>
        <input type="password" name="passwd" placeholder="Podaj hasło" maxlength="6"/required>
        </div>
        <button name="submit" class="btn btn-dark">Zaloguj</button>
        <div class="register">
            <p>Jesteś nowy? <a href="register.php">Zaloz konto!</a> </p>
            <p> LUB </p>
            <p><a href="http://localhost/groc/admin/login.php">Zaloguj sie jako ADMIN</a> </p>
        </div>
    </form>
</body>
<footer>© Copyright Michał D. Jakub F.</footer>
</html>