<?php
session_start();
 require_once "connection.php";
//  require_once 'url_restriction.php'; 
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
               $paymode="Credit/Debit Card";
               $sql2="UPDATE cart_orders SET  paymode= ? WHERE user_id='$user_id' AND amount='$amount' AND quantity='$quantity'";
               $dbhandler->prepare($sql2)->execute([$paymode]);
               
               $sql2="UPDATE cart_orders SET  pay_status= ? WHERE user_id='$user_id' AND amount='$amount' AND quantity='$quantity'";
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
           header("Location: ./payment_confirmed.php?id=-1");
        }
        else{
                $p=1;
                $email=$_SESSION['USER_EMAIL'];
                $paymode="Credit/Debit Card";
                $quantity=$_SESSION['QUANTITY'];
                $sql2="UPDATE orders SET  paymode= ? WHERE product_id='$id' AND email='$email' AND quantity='$quantity' ";
                $dbhandler->prepare($sql2)->execute([$paymode]);
                
                $sql2="UPDATE orders SET  pay_status= ? WHERE product_id='$id' AND email='$email' AND quantity='$quantity' ";
                $dbhandler->prepare($sql2)->execute([$p]);
                
                $Squantity=$r['qty']-$_SESSION['QUANTITY'];
                $sql1="UPDATE product SET  qty= ? WHERE id='$id' AND status='1' ";
                $dbhandler->prepare($sql1)->execute([$Squantity]);
                
                if($r['qty']==0)
                {
                    $a=0;
                    $sql="UPDATE product SET  status= ? WHERE id='$id'";
                    $dbhandler->prepare($sql)->execute([$a]);
                }
                header("Location: ./payment_confirmed.php?id=".$r['id']."");
            }
            
}
 ?>

 
 <!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Platnosc karta</title>
</head>

<body>
    <link rel="stylesheet" type="text/css" href="../css/style_card.css" />
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
            <h1>Płatność kartą</h1>
        </div>
        <div class="content">
        <form action="" method="post">
                <h1>Koszt :<?php echo $amount; ?></h1>
                <h2>Dodaj szczegoly</h2>
                <br>
                <input type="text" name="name_on_card" placeholder="Podaj imie z karty" maxlength="25" /required>
                <br><br/>
                <input type="text" name="card_number" placeholder="Podaj numer karty" maxlength="25" /required>
                <br><br/>
                <input type="text"  name="expiry"  onfocus="(this.type='date')" onblur="(this.type='text')" placeholder="Podaj date wanosci"/required>
                <br><br/>
                <input type="text" name="cvv" placeholder="Podaj kod CVV" maxlength="5" /required>
                <br>
                <button name="submit">Wyślij</button>
                <div class="cancel">
                    <p>
                     <?php if($id==-1){
                         echo'<p>
                        <a href="../customer/categories.php?id=0">Anuluj</a>&emsp;&emsp;&emsp;&emsp;
                        <a href="../customer/payment.php?id=-1">Powrót</a></p>';
                        }else{
                        echo'<p> <a href="../customer/categories.php?id='.$r['id'].'">Anuluj</a>&emsp;&emsp;&emsp;&emsp;
                        <a href="../customer/payment.php?id='.$r['id'].'">Powrót</a></p>';
                        }
                        ?>
                </div>
            </form>
            
        </div>

                    </div>

                    <style>
.content{
    width: 100%;
    height: 1000px;
    position: relative;
    top: 450px;
    align-content: center;
}
.content form{
    width: 550px;
    height: 700px;
    display:inline-block;
    justify-content: center;
    align-items: center;
    flex-direction: column;
    background-color: lightgray;
    backdrop-filter: blur(20px);
    border: 2px solid black;
    border-radius: 10px;
    box-shadow: 0 10px;
    padding: 40px;
    overflow: hidden;
}
.content h1{
    color: black;
    font-size: 3em;
    margin-bottom: 40px;
    position: relative;
}
.content h2{
    color: black;
    font-size: 2.0em;
    margin-bottom: -25px;
    position: relative;
}
.content input{
    width: 95%;
    height: 50px;
    border-radius: 5px;
    border: 2px solid black;
    background-color: #ffffff30;
    color: #ffffff;
    margin: 10px 0;
    padding: 0 15px;
    font-size: 1.5em;
    letter-spacing: 1px;
    cursor: pointer;
}
.content input:focus{
    border-color: black;
    transition: 0.4s;
}

.content input::placeholder{
    color: black;
    letter-spacing: 1px;
}
.content input:focus::placeholder{
    opacity: 0;
}

.content button{
    width: 100%;
    height: 50px;
    background-color: lightgreen;
    border-radius: 5px;
    margin: 15px 0;
    font-size: 1.7em;
    font-weight: 700;
    letter-spacing: 2px;
    color: black;
    box-shadow: 0 10px 20px black ;
    cursor: pointer;
}
    .cancel p a{
    color: black;
    font-size: 1.5em;
    letter-spacing: 1px;
}


}
                        </style>
</body>

</html>