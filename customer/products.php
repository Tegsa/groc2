<?php
 session_start();
 require_once "connection.php"; 
 $empty='';$flag=0;
 $cat_id=$_GET['id'];
 $_SESSION['CAT_ID'] = $cat_id;

 if(isset($_SESSION['USER_ID']) && !empty($_SESSION['USER_ID']))
    {
        $userid = $_SESSION['USER_ID'];
      
    }

    
    if(isset($_POST['submit']))
    {
        $_SESSION['cart_qty'] = $_POST['quantity'];
        $cart_qty = $_SESSION['cart_qty'];
        
        $product_id = $_POST['product_id'] ;
        $total_qty = $_POST['total_qty'];
        $name = $_POST['name'];
        
        if( $total_qty < $cart_qty)
        {
            $msg = "Maksymalna ilość dla " . $name  ." to " . $total_qty ."kg.
            Prosze wybrać mniejszą ilość niz : ". $total_qty." kg";
            $flag = 2;
        }
        else
        {
            $cart_query = "INSERT INTO cart(cat_id,user_id,product_id,cart_qty) VALUES ('$cat_id','$userid','$product_id' , '$cart_qty')";
            $query1=$dbhandler->query($cart_query);
        }
    }

 $sql="SELECT * FROM product WHERE categories_id='$cat_id' AND status='1' ";
 $query=$dbhandler->query($sql);
 $r=$query->fetchAll(PDO::FETCH_ASSOC);
    if(!empty($r))
    {
    }
    else{
        $empty="Nie masz jeszcze zadnych produktow!";
        $flag=1;
    }
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Produkty</title>
</head>

<body>
    <link rel="stylesheet" type="text/css" href="../css/style_products.css" />
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
        
        <div class="content">
        <div class="error">
              <p>
                  <?php 
                  if($flag==1)
                  {  echo $empty;
                     die();
                  }
                  if($flag==2)
                  {
                    echo $msg;
                    $flag=0;
                  }
                  ?>
               </p>
         </div>
         
         <?php 
         if ($flag==0){
         echo '<table border="1" style="width:75%;">
              <tr>
                  <th colspan="4">Produkty</th>
              </tr>';
              $i = 0;
             foreach($r as $row){
                  echo '<tr>
                        <td><img src="../css/images/product/'.$row['image'].'" width="200" height="200"/></td>
                        <td>Nazwa :'.$row['name'].'<br/>MRP(/Kg) :'.$row['mrp'].'<br/>Cena(/Kg) :'.$row['price'].'<br/></td>
                        <td><a href="purchase.php?id='. $row['id'].'">Kup teraz</a></td>
                        <td>
                        <form method = "POST" action="">
                        <input type = "number" min = "0.1" step = "0.1" name = "quantity" placeholder = "Podaj ilosc" /required><br/> 
                        <input type = "submit" name = "submit" value = "Dodaj do kosza">
                         
                        </td>
                       
                        <input type="hidden" name="product_id" value="'.$row['id'].'">
                        <input type="hidden" name="name" value="'.$row['name'].'">
                        <input type="hidden" name="total_qty" value="'.$row['qty'].'">
                     
                        </form>
                        </tr>';
                       
            }
             }   
             echo '</table>';  ?>
              <br/><p><center><a href="categories.php" style="
    color: #ffffff;
    letter-spacing: 1px;
    font-size: 1.5em;">Powrot</a><center></p>
        </div>

</div>

<style>
*{
    margin:0;
    padding:0;
    font-family: Gabriola;
}
body{
    text-align: center;
}
.wrapper{
    width: 1170px;
    margin: 0 auto;
}
header{
    height: 100px;
    background: #0d0c0e;
    width:100%;
    z-index: 12;
    position: fixed;
}
.logo{
    width: 30%;
    float: left;
    line-height: 100px;
}
.logo img{
    width: 180px;
    height: 98px;

}
ul{
    float: right;
    line-height: 100px;
}
ul li{
    display: inline-block;
}
ul li a{
    text-decoration: none;
    color: #fff;
    letter-spacing: 4px;
    font-size: 30px;
    margin: 0 10px;
    border: 3px solid transparent;
    transition: 0.6s ease;
}
ul li a:hover{
    background-color: #fff;
    color:black;

}
ul li.active a{
    background-color: #fff;
    color: #000;
}

.content{
    width: 100%;
    height: 6000px;
    position: relative;
    top: 100px;
    letter-spacing: 2px;
    font-size: 30px;
    background-image:linear-gradient(rgba(0,0,0,0.5),rgba(0,0,0,0.5)),url(images/background_5.jpg);
    -webkit-background-size: cover;
    background-size: 100% auto;
    background-position: center center;
}
.content table {
    margin-left: auto;
    margin-right: auto;
    border: 1px solid white;
    background-color: #ffffff30;
    backdrop-filter: blur(20px);
    /* border: 2px solid #ffffff30; */
    border-radius: 10px;
    box-shadow: 0 10px;
}
.content table td,th{
    color: #ffffff;
    letter-spacing: 1px;
    font-size: 1.5em;
}
.content table a{
    
    text-decoration: none;
    color: #fff;
    letter-spacing: 4px;
    font-size: 30px;    
    border: 3px solid transparent;
    transition: 0.6s ease;
}
.content table input[type="submit"],input[type="number"]{
    
    text-decoration: none;
    color:black;
    letter-spacing: 2px;
    font-size: 22px;    
    border: 3px solid transparent;
    transition: 0.6s ease;
}

.content table a:hover,input[type="submit"]:hover{
   
    background-color: #DC143C;
    color: #fff;
}

.error p{
    color: #ffffff;
    letter-spacing: 1px;
    font-size: 1.5em;

}


</style>
</body>

</html>