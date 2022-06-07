<?php
 $flag=0;$flag1=0;
 session_start();
 require_once "connection.php";
  
 $email=$_SESSION['USER_EMAIL'];
 $user_id=$_SESSION['USER_ID'];
 $sql="SELECT * FROM orders WHERE email='$email' ";
 $query=$dbhandler->query($sql);
 $r=$query->fetchAll(PDO::FETCH_ASSOC);
 if(!empty($r))
  {
      foreach($r as $row)
    {
        if($row['pay_status']==0)
        {
            $sql="DELETE FROM orders WHERE pay_status=0 ";
            $query=$dbhandler->query($sql);
        }
    }
    $nRows = $dbhandler->query("SELECT COUNT(*) FROM orders WHERE email= '$email' ")->fetchColumn(); 
      if($nRows==0)
      {
          $flag=1;
      }  
  }
  else{
      $flag=1;
  }
  $sql1="SELECT * FROM cart_orders WHERE user_id='$user_id' ";
  $query=$dbhandler->query($sql1);
  $a=$query->fetchAll(PDO::FETCH_ASSOC);
  if(!empty($a)) {
      foreach($a as $r1){
      if($r1['pay_status']==0)
        {
            $sql="DELETE FROM cart_orders WHERE pay_status=0 ";
            $query=$dbhandler->query($sql);
        }
    }
    $nRows = $dbhandler->query("SELECT COUNT(*) FROM cart_orders WHERE user_id= '$user_id' ")->fetchColumn(); 
      if($nRows==0)
      {
          $flag1=1;
      }
    
  }
  else{
     $flag1=1;
  }

  if(isset($_POST['submit1']))
  { 
    if($flag==0)
    {
        $pid=$_POST['product_id']; 
        $qty=$_POST['qty'];

        $sql="SELECT * FROM product WHERE id='$pid' ";
        $query=$dbhandler->query($sql);
        $r=$query->fetch(PDO::FETCH_ASSOC);
        if(!empty($r))
        { $qty1=$qty + $r['qty']; }
        
        $sql1="UPDATE product SET  qty= ? WHERE id='$pid'";
        $dbhandler->prepare($sql1)->execute([$qty1]);
        if($r['qty']>0)
        {
            $a=1;
            $sql="UPDATE product SET  status= ? WHERE id='$pid'";
            $dbhandler->prepare($sql)->execute([$a]);
        }
        $sql="DELETE FROM orders WHERE product_id='$pid' AND quantity='$qty'";
        $query=$dbhandler->query($sql);
   
    }




    $email=$_SESSION['USER_EMAIL'];
    $sql="SELECT * FROM orders WHERE email='$email' ";
    $query=$dbhandler->query($sql);
    $r=$query->fetchAll(PDO::FETCH_ASSOC);
    if(!empty($r))
    {  foreach($r as $row)
        {
            if($row['pay_status']==0)
            {
                $sql="DELETE FROM orders WHERE pay_status=0 ";
                $query=$dbhandler->query($sql);
            }
        }
        $nRows = $dbhandler->query("SELECT COUNT(*) FROM orders WHERE email= '$email' ")->fetchColumn(); 
          if($nRows==0)
          {
              $flag=1;
          }  
     }
    else
    {
        $flag=1;
    }
    $sql1="SELECT * FROM cart_orders WHERE user_id='$user_id' ";
  $query=$dbhandler->query($sql1);
  $a=$query->fetchAll(PDO::FETCH_ASSOC);
  if(!empty($a)) {
      foreach($a as $r1){
      if($r1['pay_status']==0)
        {
            $sql="DELETE FROM cart_orders WHERE pay_status=0 ";
            $query=$dbhandler->query($sql);
        }
    }
    $nRows = $dbhandler->query("SELECT COUNT(*) FROM cart_orders WHERE user_id= '$user_id' ")->fetchColumn(); 
      if($nRows==0)
      {
          $flag1=1;
      }
    
  }
  else{
     $flag1=1;
  }

}

    if(isset($_POST['submit']))
    { 
        if($flag1==0)
        {
            $cart_pid=explode(',',$_POST['cart_pid']);
            $cart_qty=explode(',',$_POST['cart_qty']);
        
    
            for($i=0;$i<count($cart_qty);$i++)
            {
                $pid=$cart_pid[$i];
                $sql="SELECT * FROM product WHERE id='$pid' ";
                $query=$dbhandler->query($sql);
                $r=$query->fetch(PDO::FETCH_ASSOC);
                if(!empty($r))
                { $qty1=$cart_qty[$i] + $r['qty']; }

                $sql1="UPDATE product SET  qty= ? WHERE id='$pid'";
                $dbhandler->prepare($sql1)->execute([$qty1]);
                if($r['qty']>0)
                {
                    $a=1;
                    $sql="UPDATE product SET  status= ? WHERE id='$pid'";
                    $dbhandler->prepare($sql)->execute([$a]);
                }
            }
            $p=implode(',',$cart_pid);
            $q=implode(',',$cart_qty);
            $sql="DELETE FROM cart_orders WHERE p_id='$p' AND quantity='$q'";
            $query=$dbhandler->query($sql);
    
        }

        $email=$_SESSION['USER_EMAIL'];
    $sql="SELECT * FROM orders WHERE email='$email' ";
    $query=$dbhandler->query($sql);
    $r=$query->fetchAll(PDO::FETCH_ASSOC);
    if(!empty($r))
    {  foreach($r as $row)
        {
            if($row['pay_status']==0)
            {
                $sql="DELETE FROM orders WHERE pay_status=0 ";
                $query=$dbhandler->query($sql);
            }
        }
        $nRows = $dbhandler->query("SELECT COUNT(*) FROM orders WHERE email= '$email' ")->fetchColumn(); 
          if($nRows==0)
          {
              $flag=1;
          }  
     }
    else
    {
        $flag=1;
    }
    $sql1="SELECT * FROM cart_orders WHERE user_id='$user_id' ";
  $query=$dbhandler->query($sql1);
  $a=$query->fetchAll(PDO::FETCH_ASSOC);
  if(!empty($a)) 
  {
      foreach($a as $r1)
      {
        if($r1['pay_status']==0)
            {
                $sql="DELETE FROM cart_orders WHERE pay_status=0 ";
                $query=$dbhandler->query($sql);
            }
        }
    $nRows = $dbhandler->query("SELECT COUNT(*) FROM cart_orders WHERE user_id= '$user_id' ")->fetchColumn(); 
      if($nRows==0)
      {
          $flag1=1;
      }
    
  }
  else
  {
     $flag1=1;
  }
}
 
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Moje zamowienie</title>
</head>

<body>
   
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
                    <li class="active"><a href="">Zamowienie</a></li>
                    <li><a href="logout.php">Wyloguj</a></li>
                </ul>
                
            </div>
        </header>
        <div class="banner">
            <h1>Moje zamowienie!</h1>
        </div>
        <div class="content">
        <?php
        if($flag==1 && $flag1==1){?>
         <div class="message">
          <p><br/>Brak zamowien<br/>
          <input onClick="window.location.href='../customer/categories.php'" type="submit" Value="Zamow teraz!">
          </div>
       <?php }
        
        ?>
       
       <?php if($flag==0 || $flag1==0){ ?>
        <form action="" method="post">
        <table border="1">
        <thread>
            <th>Opcje zamowienia</th>
            <th>Opcje produktu</th>
        </thread>
        <tbody>
        <?php
        if($flag==0){
        foreach($r as $row){ 
        $product=$row['product_id'];
        $category=$row['category_id'];
        $sql="SELECT product.*,categories.categories FROM product,categories WHERE product.id='$product' AND  categories.id='$category'";
        $query=$dbhandler->query($sql);
        $r1=$query->fetch(PDO::FETCH_ASSOC);
        if(!empty($r1))
        {
  
        }
        echo' <tr>
              <td>
              <b>Imie :</b>'.$row['firstname'].'<br/> 
              <b>Nawisko :</b>'.$row['lastname'].'<br/>
              <b>Addres :</b>'.$row['address'].'<br/> 
              <b>Kontakt :</b>'.$row['contact'].'<br/> 
              </td>

              <td>
              <b>Kategoria :</b>'.$r1['categories'].'<br/> 
              <b>Produkt :</b>'.$r1['name'].'<br/> 
              <b>Ilość :</b>'.$row['quantity'].'<br/> 
              <b>Cena:</b>'.$row['amount'].'<br/> 
              <b>Typ płatności :</b>'.$row['paymode'].'<br/> 
              </td>
            </tr>
            <tr>
                <td colspan="2">
                <input type="submit" name="submit1" value="Anuluj">
                </td>
                <input type="hidden" name="product_id" value="'.$product.'">
                <input type="hidden" name="qty" value="'.$row['quantity'].'">
                
            </tr>';}}
            if($flag1==0){
                foreach($a as $row1){ 
                echo' <tr>
                      <td>
                      <b>Imie :</b>'.$row1['fname'].'<br/> 
                      <b>Nazwisko:</b>'.$row1['lname'].'<br/>
                      <b>Addres :</b>'.$row1['address'].'<br/> 
                      <b>Kontakt :</b>'.$row1['contact'].'<br/> 
                      </td>';
                $c_array = explode (",", $row1['c_id']);
                $p_array = explode (",", $row1['p_id']); 
                $q_array = explode (",", $row1['quantity']);
                echo' <td>
                      <b>Kategoria :</b>'; 
                 
                for($i=0 ; $i<count($c_array) ; $i++){ 
                $category=$c_array[$i];
                $sql="SELECT categories FROM categories WHERE id='$category'";
                $query=$dbhandler->query($sql);
                $r1=$query->fetch(PDO::FETCH_ASSOC);
                if(!empty($r1))
                {
          
                }
                echo $r1['categories'].', ';
                }
                
                echo'<br/><b>Produkt :</b>';
                
                for($i=0 ; $i<count($p_array) ; $i++){ 
                    $product=$p_array[$i];
                    $sql="SELECT * FROM product WHERE id='$product'";
                    $query=$dbhandler->query($sql);
                    $r1=$query->fetch(PDO::FETCH_ASSOC);
                    if(!empty($r1))
                    {
              
                    }
                    echo $r1['name'].', ';
                }
                
                echo'<br/><b>Ilość :</b>';
                
                for($i=0 ; $i<count($q_array) ; $i++){ 

                    echo $q_array[$i].', ';
                }
                      
                echo '<br/><b>Cena :</b>'.$row1['amount'].'<br/> 
                      <b>Typ płatności :</b>'.$row1['paymode'].'<br/> 
                      </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                        <input type="submit" name="submit" value="Anuluj">
                        </td>
                        <input type="hidden" name="cart_pid" value="'.implode(',',$p_array).'">
                        
                        <input type="hidden" name="cart_qty" value="'.implode(',',$q_array).'">
                        
                    </tr>';}}
        ?>
        </tbody>
        </table>
        </form> 
        <?php } ?>   
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
    background: #000000;
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
    color: rgb(221, 210, 210);
    letter-spacing: 4px;
    font-size: 30px;
    margin: 0 10px;
    border: 3px solid transparent;
    transition: 0.6s ease;
}
ul li a:hover{
    background-color: rgb(26, 22, 22);
    color:black;

}
ul li.active a{
    background-color: rgb(240, 234, 234);
    color: #000;
}
.banner{
    width: 100%;
    height: 500px;
    position: fixed;
    top: 100px;
    background-image:linear-gradient(rgba(0,0,0,0.5),rgba(0,0,0,0.5)),url(images/my_orders2.jpg);
    -webkit-background-size: cover;
    background-size: cover;
    background-position: top center;
    background-repeat: no-repeat;
}
.banner h1{
    padding-top: 2%;
    font-size: 50px;
    text-transform: uppercase;
    color: rgb(14, 6, 6);
}
.content{
    width: 100%;
    height: 1000px;
    position: relative;
    top: 450px;
    letter-spacing: 2px;
    font-size: 30px;
    background-image:linear-gradient(rgba(0,0,0,0.5),rgba(0,0,0,0.5)),url(images/my_orders2.jpg);
    /* background-image:linear-gradient(rgba(0,0,0,0.5),rgba(0,0,0,0.5)),url(images/background_5.jpg);
    -webkit-background-size: cover;
    background-size: 100% auto;
    background-position: center center; */
}
.content table,.message {
    margin-left: auto;
    margin-right: auto;
    border: 1px solid rgb(17, 13, 13);
    background-color: lightgray;
    backdrop-filter: blur(20px);
    /* border: 2px solid #ffffff30; */
    border-radius: 10px;
    box-shadow: 0 10px;
}
.message {
    margin-left: auto;
    margin-right: auto;
    border: 1px solid rgb(7, 5, 5);
    background-image:linear-gradient(rgba(0,0,0,0.5),rgba(0,0,0,0.5)),url(images/background_5.jpg);
    backdrop-filter: blur(20px);
    /* border: 2px solid #ffffff30; */
    border-radius: 10px;
    box-shadow: 0 10px;
    width:50%;
    height:250px;
}
.content table td,th{
    color: #080606;
    letter-spacing: 1px;
    font-size: 1.5em;
}
.content table input[type="submit"],.message input[type="submit"]{
    
    text-decoration: none;
    color: black;
    letter-spacing: 2px;
    font-size: 30px;    
    border: 3px solid transparent;
    transition: 0.6s ease;
    width: 23%;
}

.content table input[type="submit"]:hover,.message input[type="submit"]:hover{
   
    background-color: 	#DC143C;
    color: rgb(10, 7, 7);
}
.error p,.content p{
    color: #0a0808;
    letter-spacing: 1px;
    font-size: 1.5em;

}
.content p a{
    color: black;
    letter-spacing: 1px;
    font-size: 1.5em;
}
            </style>
</body>

</html>