<?php
    require_once 'url_restriction.php';
    require_once 'connection.inc.php';
    
   
    if(isset($_GET['type']) && $_GET['type']!='')
    {
        $type=($_GET['type']);
        if($type=='status')
        {
            $operation=($_GET['operation']);
            $id=($_GET['id']);
            if($operation=='active')
            {
                $status='1';
            }
            else
            {
                $status='0';
            }
            $update_status_sql="update categories set status='$status' where id='$id'";
            mysqli_query($con,$update_status_sql);
        }

        if($type=='delete')
        {
            $id=($_GET['id']);
            $delete_sql="delete from categories where id='$id'";
            mysqli_query($con,$delete_sql);
        }
    }

    $sql="select * from categories order by id asc";
    $res=mysqli_query($con,$sql);

    
?>

<html>
<head>
    <title>Kategorie</title>
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
        color: gray;
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
   
    <center><h1>Kategorie</h1><br></center>
    
    <table border = "5" bordercolor="white" width="50%" height="50%">
		<thead>
			<tr>
				<th>ID</th>
				<th>Kategorie</th>
				<th>Status</th>
			</tr>
		</thead>
        <tbody>
		<?php 
				
				while($row=mysqli_fetch_assoc($res)){?>
				<tr>
					<td><?php echo $row['id']?></td>
					<td><?php echo $row['categories']?></td>
					<td><?php
                        if($row['status']==1)
                        { 
                            echo "<a href='?type=status&operation=deactive&id=".$row['id']."'>Dezaktywuj</a>";
                        }
                        else
                        {
                            echo "<a href='?type=status&operation=active&id=".$row['id']."'>Aktywuj</a>";
                        }
                        echo " ";
                        echo "<a href='manage_categories.php?id=".$row['id']."'>Edytuj</a>";
                        echo " ";
                        echo "<a href='?type=delete&id=".$row['id']."'>Usun</a>";
                    
                    
                    ?></td>
                </tr>
                <?php } ?>
        </tbody>
        </table>
        <center><h2><a href="manage_categories.php">Dodaj kategorie</a></h2></center>
        <br/><br/><br/>
        <center><p><a href="home.php">Glowna</a>
        &emsp;&emsp;&emsp;
		<a href="logout.php">Wyloguj</a> </p></center>

</body>
</html>

