<?php
session_start();
 require_once "connection.php";

 $id=$_GET['id'];
 if($id==-1)
 {
    $user_id=$_SESSION['USER_ID'];
    $amount=$_SESSION['CART_AMOUNT'];
    $quantity=implode(',',$_SESSION['CART_QUANTITY']);
    $sql="SELECT * FROM cart_orders WHERE user_id='$user_id' AND amount='$amount' AND quantity='$quantity'";
    $query=$dbhandler->query($sql);
    $r=$query->fetch(PDO::FETCH_ASSOC);
    if(!empty($r)){
        $p=1;
        $paymode="Pay On Delivery";
        $sql2="UPDATE cart_orders SET  paymode= ? WHERE user_id='$user_id' AND amount='$amount' AND quantity='$quantity' ";
        $dbhandler->prepare($sql2)->execute([$paymode]);
       
        $sql2="UPDATE cart_orders SET  pay_status= ? WHERE user_id='$user_id' AND amount='$amount' AND quantity='$quantity' ";
        $dbhandler->prepare($sql2)->execute([$p]);
 
        $p_array = explode (",", $r['p_id']); 
        $q_array = explode (",", $r['quantity']);
        for($i=0 ; $i<count($p_array) ; $i++)
        {
            $p=$p_array[$i];
            $q=$q_array[$i];
            $sql="SELECT * FROM product WHERE id='$p' AND status='1' ";
            $query=$dbhandler->query($sql);
            $a=$query->fetch(PDO::FETCH_ASSOC);
            $qty1=$a['qty']-$q;
            
            
            $sql1="UPDATE product SET  qty= ? WHERE id='$p' AND status='1' ";
            $dbhandler->prepare($sql1)->execute([$qty1]);
            if($a['qty']==0)
            {
            $s=0;
            $sql="UPDATE product SET  status= ? WHERE id='$p'";
            $dbhandler->prepare($sql)->execute([$s]);
            }
        }
        
    }

 }
 else{
 $sql="SELECT * FROM product WHERE id='$id' AND status='1' ";
 $query=$dbhandler->query($sql);
 $r=$query->fetch(PDO::FETCH_ASSOC);
 if(!empty($r))
    {
        $p=1;
        $email=$_SESSION['USER_EMAIL'];
        $quantity=$_SESSION['QUANTITY'];
        $paymode="Pay On Delivery";
        $sql2="UPDATE orders SET  paymode= ? WHERE product_id='$id' AND email='$email' AND quantity='$quantity' ";
        $dbhandler->prepare($sql2)->execute([$paymode]);
    
        $sql2="UPDATE orders SET  pay_status= ? WHERE product_id='$id' AND email='$email' AND quantity='$quantity' ";
        $dbhandler->prepare($sql2)->execute([$p]);
        
        $price=$r['price'];
        $Squantity=$r['qty']-$_SESSION['QUANTITY'];
      
        $sql1="UPDATE product SET  qty= ? WHERE id='$id' AND status='1' ";
        $dbhandler->prepare($sql1)->execute([$Squantity]);
        if($r['qty']==0)
        {
        $a=0;
        $sql="UPDATE product SET  status= ? WHERE id='$id'";
        $dbhandler->prepare($sql)->execute([$a]);
        }
    }
    
    $amount=($_SESSION['QUANTITY'] * $price);
}

 ?>

 
 <!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Platnosc</title>
</head>

<body>
    <link rel="stylesheet" type="text/css" href="../css/style_payondelivery.css" />
    <div class="box-area">
        <header>
            <div class="wrapper">
                <div class="logo">
                <img src="../css/images/logo.png">
                </div>
                <ul>
                    <li><a href="welcome.php">Glowna</a></li>
                    <li><a href="categories.php">Kategorie</a></li>
                    <li><a href="cart.php">Koszyk</a></li>
                    <li><a href="my_orders.php">Zamowienie</a></li>
                    <li><a href="logout.php">Wyloguj</a></li>
                </ul>
                
            </div>
        </header>
        <div class="banner">
            <h1>Płatność przy odbiorze </h1>
        </div>
        <div class="content">
        <form action="" method="post">
                <h1>Koszt :<?php echo $amount; ?></h1>
                <h2>Zaksiegowalismy twoje zamowienie usiadz i czekaj!</h2>
                <center><p><a href = "my_orders.php" style="color: #303e5c;">Zobacz szczegoly zamowienia</a></p></center>
                <!-- <button name="submit" onclick="window.location.href='my_orders.php'">View Order Details</button> -->
            </form>
            
        </div>

</div>
</body>

</html>