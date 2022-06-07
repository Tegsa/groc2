<?php
session_start();
 require_once "connection.php";
 
 $id=$_GET['id'];

 $sql="SELECT * FROM product WHERE id='$id' AND status='1' ";
 $query=$dbhandler->query($sql);
 $r=$query->fetch(PDO::FETCH_ASSOC);
 if(!empty($r))
{   
    
}
    
 if(isset($_POST['submit']))
    {
        header("Location: ./my_orders.php");
    }
 ?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>payment</title>
</head>

<body>
    <link rel="stylesheet" type="text/css" href="../css/style_paymentconfirmed.css" />
    <div class="box-area">
        <header>
            <div class="wrapper">
                <div class="logo">
                <img src="../css/images/logo.png">
                </div>
                <ul>
                    <li><a href="welcome.php">Glowna</a></li>
                    <li><a href="categories.php">Kategorie</a></li>
                    <li><a href="cart.php">Kosyk</a></li>
                    <li><a href="my_orders.php">Zamowienie</a></li>
                    <li><a href="logout.php">Wyloguj</a></li>
                </ul>
                
            </div>
        </header>
        <div class="banner">
            <h1>Dziekujemy! <br/>Twoje zamowienie zostało zlozone pomyslnie!</h1>
           
        </div>
        <div class="content">
            <br/><br/>
            <h2>Zaksiegowalismy twoje zamowienie usiadz spokojnie i czekaj!</h2>
        <form action="" method="post">
        <p>
            <input type="submit" name="submit" value="View Order Details"></p>
            <a href="welcome.php" style="
    color: #ffffff;
    letter-spacing: 1px;
    font-size: 1.8em;">Home</a>
        </form>    
        </div>

</div>
</body>

</html>