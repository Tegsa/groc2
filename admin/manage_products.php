<?php
require_once 'url_restriction.php';
require_once 'connection.inc.php';
$categories_id='';
$name='';
$mrp='';
$price='';
$qty='';
$image='';
$status	='';
// $_GET['id']="";

$msg='';
$image_required='required';
if(isset($_GET['id']) && $_GET['id']!=''){
	$image_required='';
	$id=($_GET['id']);
	$res=mysqli_query($con,"select * from product where id='$id'");
	$check=mysqli_num_rows($res);
	if($check>0){
		$row=mysqli_fetch_assoc($res);
		$categories_id=$row['categories_id'];
		$name=$row['name'];
		$mrp=$row['mrp'];
		$price=$row['price'];
		$qty=$row['qty'];
		$img = $row['image'];
	}else{
		header('location:product.php');
		die();
	}
}

if(isset($_POST['submit'])){
	$categories_id=($_POST['categories_id']);
	$name=($_POST['name']);
	$mrp=($_POST['mrp']);
	$price=($_POST['price']);
	$qty=($_POST['qty']);
	$_GET['id']="";
	
	
	$res=mysqli_query($con,"select * from product where name='$name'");
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
				$msg="Product already exist";
			}
		}
		else
		{
			$msg="Product already exist";
		}
	}
	
	
	if($_GET['id']==0){
		if($_FILES['image']['type']!='image/png' && $_FILES['image']['type']!='image/jpg' && $_FILES['image']['type']!='image/jpeg'){
			$msg="Please select only png,jpg and jpeg image formate";
		}
	}else{
		if($_FILES['image']['type']!=''){
				if($_FILES['image']['type']!='image/png' && $_FILES['image']['type']!='image/jpg' && $_FILES['image']['type']!='image/jpeg'){
				$msg="Please select only png,jpg and jpeg image formate";
			}
		}
	}
	
	if($msg==''){
		if(isset($_GET['id']) && $_GET['id']!=''){
			if($_FILES['image']['name']!=''){
				$image=$_FILES['image']['name'];
				move_uploaded_file($_FILES['image']['tmp_name'],'../css/images/product/'.$image);
				$update_sql="update product set categories_id='$categories_id',name='$name',mrp='$mrp',price='$price',qty='$qty',image='$image' where id='$id'";
			}else{
				$update_sql="update product set categories_id='$categories_id',name='$name',mrp='$mrp',price='$price',qty='$qty' where id='$id'";
			}
			mysqli_query($con,$update_sql);
		}else{
			$image=$_FILES['image']['name'];
			move_uploaded_file($_FILES['image']['tmp_name'],'../css/images/product/'.$image);
			mysqli_query($con,"insert into product(categories_id,name,mrp,price,qty,status,image) values('$categories_id','$name','$mrp','$price','$qty',1,'$image')");
		}
		header('location:product.php');
		die();
	}
}
?>

<html>

<head>
<title>Dodawanie produktu</title>
    <style>
        form{
            float: center;
            margin-left:25%;
			margin-right:50%;
            margin-top: 8%;
            font-family: Verdana;
            font-size: 1.5em;
            font-weight: 700;
            letter-spacing: 2px;
            color: #303e5c;
            border: 5px  solid white;
            width:50%;
            height:105%;          
        }
        form input,button,select{
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
        margin-top: 50%;
        }
		.error{
    color: rgb(235, 16, 16);
    font-size: 1em;
    letter-spacing: 1px;
    }



    </style>
</head>

<body  bgcolor = "lightblue">

	<center><h1>Dodawanie produktu</h1></center>
	<form method="post" enctype="multipart/form-data">
	<br><br>
		<center><div class="error">
		<?php echo $msg; ?></div><br><br>
		<label>kategorie</label>
		<select name="categories_id">
			<option>Wybierz kategorie</option>
			<?php
					$res=mysqli_query($con,"select id,categories from categories order by categories asc");
					while($row=mysqli_fetch_assoc($res)){
					if($row['id']==$categories_id){
						echo "<option selected value=".$row['id'].">".$row['categories']."</option>";
					}else{
							echo "<option value=".$row['id'].">".$row['categories']."</option>";
						}
											
				}
			?>
		</select>
		</div>
		<br><br>
		<label>Nazwa produktu:</label>
		<input type="text" name="name" placeholder="Podaj nazwe produktu" required value="<?php echo $name?>"><br><br>

		<label>MRP:</label>
		<input type="text" name="mrp" placeholder="Podaj mrp produktu" required value="<?php echo $mrp?>"><br><br>



		<label>Cena:</label>
		<input type="text" name="price" placeholder="Podaj cene produktu" required value="<?php echo $price?>"><br><br>

		<label>Qty:</label>
		<input type="text" name="qty" placeholder="Podaj qty" required value="<?php echo $qty?>"><br><br>



		<label>Obraz:</label>
		<input type="file" name="image" value = "<?php echo $img?>"><br><br>

		<br>

		<button type="submit" name="submit">
		<span>Wyślij</span>
		</button><br><br>
		</center>

	</form>
	<center><p><a href="product.php">Powrot</a>
        &emsp;&emsp;&emsp;
        <a href="home.php">Glowna</a>
        &emsp;&emsp;&emsp;
        <a href="logout.php">Wyloguj</a></p></center>
</body>

</html>