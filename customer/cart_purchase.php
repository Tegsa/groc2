<?php
 require_once "connection.php";
  
 $flag=0;
 if(isset($_POST['submit']))
    {
        session_start();
        $id=$_SESSION['USER_ID'];
        $sql="SELECT * FROM cart WHERE user_id='$id' ";
        $query=$dbhandler->query($sql);
        $r=$query->fetchAll(PDO::FETCH_ASSOC);
        if(!empty($r))
        {
            $i=0;
            foreach($r as $row)
            {
               $c_array[$i]=$row['cat_id'];
               $p_array[$i]=$row['product_id'];
               $q_array[$i]=$row['cart_qty'];
               $i++;
            }
        }
        $c=implode(",",$c_array);
        $p=implode(",",$p_array);
        $q=implode(",",$q_array);
       
        $fname=$_POST['fname'];
        $lname=$_POST['lname'];
        $addrss=$_POST['address'];
        $contact=$_POST['contact'];
        $amount=$_SESSION['CART_AMOUNT'];
        $sql="INSERT INTO cart_orders (user_id,c_id,p_id,quantity,amount,fname,lname,address,contact)
        VALUES ('$id','$c','$p','$q','$amount','$fname','$lname','$addrss','$contact')";
        $query=$dbhandler->query($sql);
        $_SESSION['CART_QUANTITY']=$q_array;
        header("Location: ./payment.php?id=-1");

    }
 
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>cart_purchase</title>
</head>

<body>
    <link rel="stylesheet" type="text/css" href="../css/style_cartpurchase.css" />
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
            <h1>Zloz zamowienie</h1>
        </div>
        <div class="content">
         <?php 
           if ($flag==0){
               
               echo '<form method="post" action="">
               <table border="1" bordercolor="white" width="100%">
               <tr>
                   <th colspan="2">Wprowadź szczegóły, aby przejść do płatności
                   </th>
                </tr>
               <tr>
                   <td>Podaj imie :</td>
                   <td><input type="text" name="fname" placeholder="Wpisz imie"/required></td>
               </tr>
               <tr>
                   <td>Podaj nazwisko :</td>
                   <td><input type="text" name="lname" placeholder="Wpisz nazwisko"/required></td>
               </tr>
               <tr>
                   <td>Podaj adres :</td>
                   <td><textarea name="address" placeholder="Wpisz adres"/required></textarea></td>
               </tr>
               <tr>
                   <td>Podaj kontakt :</td>
                   <td><input type="text" name="contact" maxlength="10" placeholder="Podaj kontakt"/required></td>
               </tr>
               <tr>
                   <td colspan="2"><input type="submit" name="submit" value="Wyślij"/></td>
               </tr>
               </form>';
           }
              ?>
              
       
        </div>

<style>
    header{
    height: 100px;
    background: #0c0b0c;
    width:100%;
    z-index: 12;
    position: fixed;
    }
    </style>
</body>

</html>
