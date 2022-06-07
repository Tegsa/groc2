<?php
if(isset($_POST['submit']))
{   require_once "connection.php"; 
    $passwd=$_POST['passwd'];
    $Cpasswd=$_POST['Cpasswd'];
    if($passwd != $Cpasswd)
    {
        echo 'Password and Confirm Password must match';
        die();
    }
    $fname=$_POST['fname'];
    $lname=$_POST['lname'];
    $email=$_POST['email'];
    
    $gender=$_POST['gender'];
    $city=$_POST['city'];
    $contact=$_POST['contact'];
    $sql="INSERT INTO customer (Firstname,Lastname,Email,Password,Gender,City,Contact)
          VALUES ('$fname','$lname','$email','$passwd','$gender','$city','$contact')";
    $query=$dbhandler->query($sql);
    $_SESSION['USER_REGISTER']='yes';
	$_SESSION['USER_EMAIL']=$email;
    header("Location: ./welcome.php");
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Rejestracja</title>
</head>

<body>
    <link rel="stylesheet" type="text/css" href="../css/style_register.css" />
    <div class="message">
    <p>
        <?php
        if(isset($_SESSION['MESSAGE']) && $_SESSION['MESSAGE'] != '')
          {
             print_r($_SESSION['MESSAGE']);
          }
        ?>
    </p>
    <form class="register" action="" method="POST"> 
        <center><h1>Tworzenie konta</h1></center>

        <input type="text" name="fname" placeholder="Podaj imie"/required>
        <input type="text" name="lname" placeholder="Podaj nazwisko"/required>
        <input type="email" name="email" placeholder="Podaj Email"/required>
        <input type="password" name="passwd" placeholder="Podaj hasło" maxlength="6"/required>
        <input type="password" name="Cpasswd" placeholder="Zatwierdź hasło" maxlength="6"/required>
        <p>
        <input type="radio" name="gender" value="Male" /required>
                <label for="Male">ON</label>
                <input type="radio" name="gender" value="Female">
                <label for="Female">ONA</label>
                <input type="radio" name="gender" value="Other">
                <label for="Other">Inne</label>
            </p>
        <textarea name="address" placeholder="Podaj swoj adres"></textarea> 
        <input type="text" name="city" placeholder="Podaj swoje miasto" </required>
        <input type="text" name="contact" placeholder="Podaj kontakt" maxlength="10" </required>      
        
        <button name="submit">Rejestruj!</button>
    </form>
</body>
<footer>© Copyright Michał D. Jakub F.</footer>
</html>