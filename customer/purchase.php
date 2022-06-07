<?php
 require_once "connection.php";

 $empty='';$flag=0;
  
 $id=$_GET['id'];
 $sql="SELECT * FROM product WHERE id='$id' AND status='1' ";
 $query=$dbhandler->query($sql);
 $r=$query->fetch(PDO::FETCH_ASSOC);
    if(!empty($r))
    {
        $price=$r['price'];
    }
    else{
        $empty="Sorry! Produkt wyprzedany";
        $flag=1;
         
    }
    if(isset($_POST['submit']))
    {
     $qty=$_POST['qty'];
     
     if($qty > $r['qty'])
     {
         if($r['qty']==0)
         {
             $error="Przepraszamy, produkt nie dostepny";
             $flag=2;
         }else{
         $error="Maksymalna ilość w zamowieniu to". $r['qty'] ."kg.Wybierz mniejsza wartosc niz : ". $r['qty']."";
         $flag=2;
         }
     }
     else{
        session_start();
        $_SESSION['QUANTITY']=$qty;
        $email=$_SESSION['USER_EMAIL'];
        $p_id=$r['id'];
        $c_id=$r['categories_id'];
        $fname=$_POST['fname'];
        $lname=$_POST['lname'];
        $addrss=$_POST['address'];
        $contact=$_POST['contact'];
        $amount=$qty*$price;
        $sql="INSERT INTO orders (email,product_id,category_id,quantity,amount,firstname,lastname,address,contact)
        VALUES ('$email','$p_id','$c_id','$qty','$amount','$fname','$lname','$addrss','$contact')";
        $query=$dbhandler->query($sql);
        header("Location: ./payment.php?id=".$r['id']."");
     }
     
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Zakup</title>
</head>

<body>
    <link rel="stylesheet" type="text/css" href="../css/style_Purchase.css" />
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
            <h1>Zaplac</h1>
        </div>
        <div class="content">
        <div class="error">
              <p>
                  <?php 
                  if($flag==1)
                  {  echo $empty;
                    $sql="SELECT * FROM product WHERE id='$id'";
                    $query=$dbhandler->query($sql);
                    $r=$query->fetchAll(PDO::FETCH_ASSOC);
                    foreach($r as $row){$category_id=$row['categories_id'];}
                    echo '<br/><a href="products.php?id='.$category_id.'">Choose Another</a>';
                     die();
                  }
                  if($flag==2)
                  {  echo $error;
                     $flag=0;
                  }
                  ?>
               </p>
         </div>
         <?php 
           if ($flag==0){
               
              
               echo '<form method="post" action="">
               <table border="1" bordercolor="white" width="100%">
               <tr>
                   <th colspan="2">Wprowadz dane do zamowienia</th>
                </tr>
               <tr>
                   <td>Nazwa poduktu:</td>
                   <td><input type="text" name="pname" value="'.$r['name'].'"></td>
               </tr>
               <tr>
                   <td>Podaj ilość(in Kg):</td>
                   <td><input type="number" step="0.1" min="0.1" name="qty" placeholder="Ilość do zakupu
                   "/required></td>
               </tr>
               <tr>
                   <td>Wprowadz imie :</td>
                   <td><input type="text" name="fname" placeholder="Podaj imie"/required></td>
               </tr>
               <tr>
                   <td>Wprowadz nazwisko :</td>
                   <td><input type="text" name="lname" placeholder="Podaj nazwisko"/required></td>
               </tr>
               <tr>
                   <td>Wprowadz adres:</td>
                   <td><textarea name="address" placeholder="Podaj adres zamowienia"/required></textarea></td>
               </tr>
               <tr>
                   <td>Podaj adres :</td>
                   <td><input type="text" name="contact" maxlength="10" placeholder="Podaj kontakt" /required></td>
               </tr>
               <tr>
                   <td colspan="2"><input type="submit" name="submit" value="Wyslij"/></td>
               </tr>
               </form>';
           }
              ?>
              
       
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
    background: black;
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
    width: 250px;
    height: 115px;

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
.banner{
    width: 100%;
    height: 500px;
    position: fixed;
    top: 100px;
    background-image:linear-gradient(rgba(0,0,0,0.5),rgba(0,0,0,0.5)),url(images/background.jpg);
    -webkit-background-size: cover;
    background-size: cover;
    background-position: center;
}
.banner h1{
    padding-top: 5%;
    font-size: 50px;
    text-transform: uppercase;
    color: black;
}
.content{
    width: 100%;
    height: 1300px;
    position: relative;
    top: 450px;
    align-content: center;
}
.content form{
    margin-left: auto;
    margin-right: auto;
    width: 750px;
    height: 800px;
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
.content table tr{
    width: 100%;
    height: 80px;
}
.content h1{
    color: black;
    font-size: 3em;
    margin-bottom: 40px;
    position: relative;
}
.content input[type='submit']{
    width: 100%;
    height: 70px;
    background-color: #ffffff;
    border-radius: 5px;
    margin: 15px 0;
    font-size: 1.7em;
    font-weight: 700;
    letter-spacing: 2px;
    color: #303e5c;
    box-shadow: 0 10px 20px #303e5c69 ;
    cursor: pointer;
}
.content input,textarea{
    width: 80%;
    height: 50px;
    border-radius: 5px;
    border: 2px solid #ffffff30;
    background-color: #ffffff30;
    color: #ffffff;
    margin: 10px 0;
    padding: 0 15px;
    font-size: 1.2em;
    letter-spacing: 1px;
    cursor: pointer;
}
.content input:focus{
    border-color: #ffffff;
    transition: 0.4s;
}

.content td,td input{
    color: #ffffff;
    letter-spacing: 1px;
    font-size: 1.8em;
}
.content th{
    color: #ffffff;
    letter-spacing: 1px;
    font-size: 2.5em;

}
.content input:focus::placeholder{
    opacity: 0;
}
.error p{
    color: #ffffff;
    letter-spacing: 1px;
    font-size: 1.2em;

}
    </style>
</body>

</html>
