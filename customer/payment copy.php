<?php
session_start();
 require_once "connection.php";
 $id=$_GET['id'];
 $sql="SELECT * FROM product WHERE id='$id' AND status='1' ";
 $query=$dbhandler->query($sql);
 $r=$query->fetch(PDO::FETCH_ASSOC);
 if(!empty($r))
    {
        $price=$r['price'];
        $amount=($_SESSION['QUANTITY'] * $price);
    }
 else{
     $amount=$_SESSION['CART_AMOUNT'];
 }
    
    
 if(isset($_POST['submit']))
    {
     $payMode=$_POST['payment_mode'];
     if($payMode =='Pay On Delivery')
     {
        if(empty($r))
        {
            header("Location: ./pay_on_delivery.php?id=-1");    
        }else{
        header("Location: ./pay_on_delivery.php?id=".$r['id']."");
        }
     }
     else
     {
        if(empty($r))
        {
            header("Location: ./card.php?id=-1");    
        }else{
        header("Location: ./card.php?id=".$r['id']."");
        }
     }
    }
 ?>


 <!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Płatności</title>
</head>

<body>
    <link rel="stylesheet" type="text/css" href="../css/style_payment.css" />
    <div class="box-area">
        <header>
            <div class="wrapper">
                <div class="logo">
                <img src="../css/images/logo.png">
                </div>
                <ul>
                    <li><a href="welcome.php">Glowna</a></li>
                    <li><a href="categories.php">Kategorie</a></li>
                    <li class="active"><a href="">Koszyk</a></li>
                    <li><a href="my_orders.php">Zamowienie</a></li>
                    <li><a href="logout.php">Wyloguj</a></li>
                </ul>
                
            </div>
        </header>
        <div class="banner">
            <h1>Płatność</h1>
        </div>
        <div class="content">
        <form action="" method="post"> 
            <h1>Koszt : <?php echo $amount; ?></h1>
            <h1>Wybierz rodzaj</h1>
            <br>
            <input style="margin-top: -40px;width: 30%;height: 35px;"type="radio" id="home" name="payment_mode" value="Pay On Delivery"/required> 
            <label for="home">Płatność przy odbiorze</label>
            <br><br/>
            <input  style="margin-top: -40px;width: 30%;height: 35px;" type="radio" id="card" name="payment_mode" value="card">
            <label for="card">Karta kredytowa</label>
            <br><br/>
            <button name="submit">Wyślij</button>
        </form>
        </div>

</div>
</body>

</html>