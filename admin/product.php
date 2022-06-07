<?php
require_once 'url_restriction.php';
require_once 'connection.inc.php';

if(isset($_GET['type']) && $_GET['type']!=''){
	$type=($_GET['type']);
	if($type=='status'){
		$operation=($_GET['operation']);
		$id=($_GET['id']);
		if($operation=='active'){
			$status='1';
		}else{
			$status='0';
		}
		$update_status_sql="update product set status='$status' where id='$id'";
		mysqli_query($con,$update_status_sql);
	}
	
	if($type=='delete'){
		$id=$_GET['id'];
		$delete_sql="delete from product where id='$id'";
		mysqli_query($con,$delete_sql);
	}
}

$sql="select product.*,categories.categories from product,categories where product.categories_id=categories.id order by product.id asc";
$res=mysqli_query($con,$sql);
?>

<html>

<head>
<title>Produkt</title>
    <style>
        table{
            float: center;
            margin-left:auto;
			margin-right:auto;
            margin-top: 8%;
            font-family: Verdana;
            font-size: 1.3em;
            font-weight: 700;
            letter-spacing: 2px;
            color: #303e5c;
        }
        h1{
        font-family: Verdana;
        font-size: 1.5em;
        font-weight: 700;
        letter-spacing: 2px;
        color: #303e5c;
        margin-top: 5%;
        }
        h2 a{
        font-family: Verdana;
        font-size: 1.2em;
        font-weight: 700;
        letter-spacing: 2px;
        color: #303e5c;
        margin-top: 8%;
        }
        body p a{
            font-family: Verdana;
        font-size: 1.2em;
        font-weight: 700;
        letter-spacing: 2px;
        color: blue;
        margin-top: 8%;
        }


    </style>
</head>

<body  bgcolor = "lightblue">
	<center><h1>Produkty </h1></center>
	
	<table border = "5" bordercolor="white" width="50%" height="50%">
		<thead>
			<tr>
				<th>ID</th>
				<th>Kategorie</th>
				<th>Nazwa</th>
				<th>MRP</th>
				<th>Cena</th>
				<th>Ilość</th>
				<th>Podgląd</th>
			
				<th></th>
			</tr>
		</thead>
		<tbody>
			<?php 
					
				while($row=mysqli_fetch_assoc($res)){?>
			<tr>
				<td>
					<?php echo $row['id']?>
				</td>
				<td>
					<?php echo $row['categories']?>
				</td>
				<td>
					<?php echo $row['name']?>
				</td>
				<td>
					<?php echo $row['mrp']?>
				</td>
				<td>
					<?php echo $row['price']?>
				</td>
				<td>
					<?php echo $row['qty']?>
				</td>
				
				<td><img src="../css/images/product/<?php echo $row['image'] ;?>" width='50' height='60'/></td>
				
				<td>	
					<?php
							if($row['status']==1)
							{
								echo "<a href='?type=status&operation=deactive&id=".$row['id']."'>Dezaktywuj</a>&nbsp;";
							}
							else
							{
								echo "<a href='?type=status&operation=active&id=".$row['id']."'>Aktywuj</a>&nbsp;";
							}
							echo "<a href='manage_products.php?id=".$row['id']."'>Edytuj</a>&nbsp;";
								
							echo "<a href='?type=delete&id=".$row['id']."'>Usuń</a>";
								
					?>
				</td>
			</tr>
			<?php } ?>
		</tbody>
	</table>
	<center><h2><a href="manage_products.php">Dodaj produkt</a> </h2></center>
	<br/><br/><br/>
	<center><p><a href="home.php">Głowna</a>
        &emsp;&emsp;&emsp;
		<a href="logout.php">Wyloguj</a> </p></center>
</body>

</html>