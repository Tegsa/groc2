<?php
require_once 'url_restriction.php';
require_once 'connection.inc.php';
$sql="SELECT * FROM cart_orders ";
$res=mysqli_query($con,$sql);
?>
<!DOCTYPE html>
<head>
<title>Zamowienia</title>
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
<body bgcolor = "lightblue">

<center><h1>Zamowienia</h1></center>
<table border = "5" bordercolor="white">
		<thead>
        <tr>
				<th colspan="3">Szczegoly Uzytkownika</th>
				<th colspan="3">Szczegoly zamowienia</th>
				<th colspan="5">Szczegoly produktu</th>
        </tr>
			<tr>
				<th>User Id</th>
				<th>Imie</th>
				<th>Email</th>
                <th>Zamowienie na imie</th>
				<th>Zamowienie na adres</th>
				<th>Kontakt</th>
				<th>Produkty</th>
				<th>Produkty</th>
				<th>Ilość</th>
				<th>Cena</th>
                <th>Rodzaj płatności</th>
			</tr>
		</thead>
		
			<?php 
					
				while($row=mysqli_fetch_assoc($res))
                {
                    $user_id = $row['user_id'];
                    
                    $sql1 = " select * from customer where Id = '$user_id'";
                    $res1 =mysqli_query($con,$sql1);

                    while($row1 = mysqli_fetch_assoc($res1))
                    {
                        $fn = $row1['FirstName'] ;
                        $ln = $row1['LastName'] ;
                        $email = $row1['Email'];
                    }

                    echo '<tr>';
                    echo '<td>' . $user_id . '</td>';
                    echo '<td>' . $fn.$ln. '</td>';
                    echo '<td>' . $email . '</td>';
                    
                    echo '<td>' . $row['fname'].$row['lname']. '</td>';
                    echo '<td>' . $row['address'] . '</td>';
                    echo '<td>' . $row['contact'] . '</td>';
                    
                    echo '<td>' . $row['c_id'] . '</td>';
                    echo '<td>' . $row['p_id'] . '</td>';
                    echo '<td>' . $row['quantity'] . '</td>';
                    echo '<td>' . $row['amount'] . '</td>';
                    echo '<td>' . $row['paymode'] . '</td>';

                    echo '</tr>';
                    
                }

                $sql2 = "select * from orders";
                $res2 =mysqli_query($con,$sql2);

                while($row2 = mysqli_fetch_assoc($res2))
                    {
                        $email = $row2['email'];
                        $sql1 = " select * from customer where Email = '$email'";
                        $res1 =mysqli_query($con,$sql1);
                        while($row1 = mysqli_fetch_assoc($res1))
                        {
                            $user_id = $row1['Id'];
                            $fn = $row1['Firstname'] ;
                            $ln = $row1['Lastname'] ;
                        }
                        echo '<tr>';
                        echo '<td>' . $user_id . '</td>';
                        echo '<td>' . $fn.$ln. '</td>';
                        echo '<td>' . $row2['email'] . '</td>';

                        echo '<td>' . $row2['firstname'].$row2['lastname']. '</td>';
                        echo '<td>' . $row2['address'] . '</td>';
                        echo '<td>' . $row2['contact'] . '</td>';

                        echo '<td>' . $row2['category_id'] . '</td>';
                        echo '<td>' . $row2['product_id'] . '</td>';
                        echo '<td>' . $row2['quantity'] . '</td>';
                        echo '<td>' . $row2['amount'] . '</td>';
                        echo '<td>' . $row2['paymode'] . '</td>';

                        echo '</tr>';
                    }
                    
                
            ?>
			
</table>
<center><p><a href="home.php">Glowna</a>
        &emsp;&emsp;&emsp;
		<a href="logout.php">Wyloguj</a> </p></center>
</body>
</html>