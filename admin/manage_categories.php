<?php
    require_once 'url_restriction.php';
    require_once 'connection.inc.php';
    $categories='';
    $msg ='';
    
    if(isset($_GET['id']) && $_GET['id']!=''){
        $id=($_GET['id']);
        $res=mysqli_query($con,"select * from categories where id='$id'");
        $check=mysqli_num_rows($res);
        if($check>0){
            $row=mysqli_fetch_assoc($res);
            $categories=$row['categories'];
        }else{
            header('location:categories.php');
            die();
        }
    }

        if(isset($_POST['submit']))
        {
            $categories = $_POST['categories'];

            $res=mysqli_query($con,"select * from categories where categories='$categories'");
	        $check=mysqli_num_rows($res);

            if($check>0)
            {
                if(isset($_GET['id']) && $_GET['id']!='')
                {
                    $getData=mysqli_fetch_assoc($res);
                    if($id==$getData['id']){
                    
                    }
                    else
                    {
                        $msg="Categories already exist";
                    }
                }
                else
                {
                    $msg="Categories already exist";
                }
            }

            if($msg=='')
            {
                if(isset($_GET['id']) && $_GET['id']!='')
                {
                    $update_categories = " update categories set categories='$categories' where id='$id'";
                    mysqli_query($con , $update_categories );
                }
                else
                {
                    $insert_categories = " insert into categories (categories,status) values('$categories','1')";
                    mysqli_query($con , $insert_categories );
                }
                header('location:categories.php');
                die();
            }
            
        }


        

        
    

    
?>

<html>
<head>
    <title>Dodawanie kategorii</title>
    <style>
        form{
            float: center;
            margin-left:35%;
			margin-right:50%;
            margin-top: 8%;
            font-family: Verdana;
            font-size: 1.5em;
            font-weight: 700;
            letter-spacing: 2px;
            color: #303e5c;
            border: 5px  solid white;
            width:30%;
            height:45%;          
        }
        form input{
            width:275px;
            height:30px;
        }
		form input::placeholder{
        font-size: 1.2em;
        letter-spacing: 1px;
        }
        h1{
        font-family: Verdana;
        font-size: 1.5em;
        font-weight: 700;
        letter-spacing: 2px;
        color: #303e5c;
        margin-top: 5%;
        }
        body p a{
            font-family: Verdana;
        font-size: 1.2em;
        font-weight: 700;
        letter-spacing: 2px;
        color: blue;
        margin-top: 8%;
        }
    .error{
    color: rgb(235, 16, 16);
    font-size: 1em;
    letter-spacing: 1px;
    }


    </style>
</head>
<body  bgcolor = "lightblue">
    <center><h1>Dodawanie kategorii</h1></center>
    <form action="" id="register" method="POST">
        <center><br/><label>Kategoria:</label><br><br/>
        <input type="text" name="categories" placeholder="Podaj nazwe nowej kategorii" required value="<?php echo $categories?>"><br><br>
        <input type="submit" name="submit"><br><br/>
        <div class="error"><?php echo $msg; ?></div>
    </center>
    </form>
    <br/><br/><br/>
    <center><p><a href="categories.php">Powrot</a>
        &emsp;&emsp;&emsp;
        <a href="home.php">Glowna</a>
        &emsp;&emsp;&emsp;
        <a href="logout.php">Wyloguj</a></p></center>
</body>
</html>

