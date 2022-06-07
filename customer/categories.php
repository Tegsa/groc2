<?php
 session_start();
 require_once "connection.php";

 $empty='';$flag=0;

 //fetching the current page url
$protocol = ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
$CurPageURL = $protocol . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];  
//Getting the record id from the url 
 $pid=substr($CurPageURL, -1);
 if(is_numeric($pid)){
     if($pid==0){
        $user_id=$_SESSION['USER_ID'];
        $amount=$_SESSION['CART_AMOUNT'];
        $quantity=implode(',',$_SESSION['CART_QUANTITY']);
        $sql1="DELETE FROM cart_orders WHERE user_id='$user_id' AND quantity='$quantity' AND amount='$amount' AND  pay_status=0";
        $query=$dbhandler->query($sql1);    
     }else{
    $email=$_SESSION['USER_EMAIL'];
    $quantity=$_SESSION['QUANTITY'];
    $sql1="DELETE FROM orders WHERE product_id='$pid' AND quantity='$quantity' AND email='$email' AND  pay_status=0";
    $query=$dbhandler->query($sql1);
     }
 }
 
 $sql="SELECT * FROM categories WHERE status='1' ";
 $query=$dbhandler->query($sql);
 $r=$query->fetchAll(PDO::FETCH_ASSOC);
    if(!empty($r))
    {
    }
    else{
        $empty="Sorry! There are no categories available right now !!";
        $flag=1;
    }
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Kategorie</title>
</head>

<body>
    <link rel="stylesheet" type="text/css" href="../customer/style_categorie.css" />
    <div class="box-area">
        <header>
            <div class="wrapper">
                <div class="logo">
                <img src="../css/images/logo.png">
                </div>
                <ul>
                    <li><a href="welcome.php">Glowna</a></li>
                    <li class="active"><a href="">Kategorie</a></li>
                    <li><a href="cart.php">Koszyk</a></li>
                    <li><a href="my_orders.php">Zamowienie</a></li>
                    <li><a class="das" href="logout.php">Wyloguj</a></li>
                </ul>
            </div>
        </header>
        <div class="banner">
            <h1>Kategorie</h1>
        </div>
        <div class="content">
            <br/><br/>
        <div class="error">
               <p>
                  <?php 
                  if($flag==1)
                  {  echo $empty.'<br/>';
                     die();
                  }
                  ?>
               </p>
         </div>
         <?php 
         if ($flag==0){
            echo '<table border="1" style="width:60%">
              <tr>
                  <th colspan="2">Kategorie</th>
              </tr>';
    
             foreach($r as $row){
                  echo '<tr>
                        <td>'.$row['categories'].'</td>
                        <td><u><a href="products.php?id='. $row['id'].'">Zobacz produkt</a></u></td>
                        </tr>'; 
                }
            }
            echo '</table>';  ?>
       
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
    background-image:linear-gradient(rgba(0,0,0,0.5),rgba(0,0,0,0.5)),url(images/.logowanie.jpg);
}
.wrapper{
    width: 1170px;
    margin: 0 auto;
}
header{
    height: 100px;
    background: #0d0d0e;
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
.banner{
    width: 100%;
    height: 500px;
    position: fixed;
    top: 100px;

}
.banner h1{
    padding-top: 8%;
    font-size: 50px;
    text-transform: uppercase;
    color: black;
}
.content{
    width: 100%;
    height: 1000px;
    position: relative;
    top: 450px;
    letter-spacing: 2px;
    font-size: 30px;
    /* background-image:linear-gradient(rgba(0,0,0,0.5),rgba(0,0,0,0.5)),url(images/background_5.jpg);
    -webkit-background-size: cover;
    background-size: 100% auto;
    background-position: center center; */
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
    color: black;
    letter-spacing: 1px;
    font-size: 1.5em;
}
.content table a{
    
    text-decoration: none;
    color: black;
    letter-spacing: 4px;
    font-size: 30px;    
    border: 3px solid transparent;
    transition: 0.6s ease;
}

.content table a:hover{
   
    background-color: 	#DC143C;
    color: black;
}
.error p{
    color: black;
    letter-spacing: 1px;
    font-size: 1.5em;

}

    </style>
</body>

</html>