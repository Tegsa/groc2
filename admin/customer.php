<?php
require_once 'url_restriction.php';
require_once 'connection.inc.php';
$sql="SELECT * FROM customer ";
$res=mysqli_query($con,$sql);
?>
<!DOCTYPE html>
<head>
<title>Uzytkownicy</title>
    <style>
        table{
            float: center;
            margin-left:auto;
			margin-right:auto;
            margin-top: 8%;
            font-family: Verdana;
            font-size: 0.89em;
            font-weight: 700;
            letter-spacing: 2px;
            color: #303e5c;
        }
		 th,td{
			 height:40px;
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


    </style>

</head>
<body  bgcolor = "lightblue">

<center><h1>Uzytkownicy</h1></center>
<table border = "5" bordercolor="white">
		<thead>
			<tr>
				<th>ID</th>
				<th>Imie</th>
				<th>Nazwisko</th>
				<th>Email</th>
				<th>Haslo</th>
				<th>Plec</th>
				<th>Addres</th>
				<th>Miasto</th>
                <th>Kontakt</th>
			</tr>
		</thead>
		<tbody>
			<?php 
					
				while($row=mysqli_fetch_assoc($res)){?>
			<tr>
				<td>
					<?php echo $row['Id']?>
				</td>
				<td>
					<?php echo $row['FirstName']?>
				</td>
				<td>
					<?php echo $row['LastName']?>
				</td>
				<td>
					<?php echo $row['Email']?>
				</td>
				<td>
					<?php echo md5($row['Password'])?>
				</td>
				<td>
					<?php echo $row['Gender']?>
				</td>
				<td>
					<?php echo $row['Address']?>
				</td>
				<td>
					<?php echo $row['City']?>
				</td>
				<td>
					<?php echo $row['Contact']?>
				</td>	
			</tr>
			<?php } ?>
		</tbody>
	</table>
	<center><p><a href="home.php">Głowna</a>
        &emsp;&emsp;&emsp;
		<a href="logout.php">Wyloguj</a> </p></center>

</body>
</html>