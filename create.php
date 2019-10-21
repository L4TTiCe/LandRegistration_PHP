<html>
<body>
	<h1><b>CREATING DATABASE EXAMPLE USING PHP</b></h1>
</body>	
</html>
<?php
 $con = mysqli_connect("localhost:3307", "root", "") or die(mysqli_error());
 if (mysqli_query($con,"CREATE DATABASE sample"))
	{echo "Database created";}
 else
	{echo "unable to create database: " . mysqli_error($con);}
mysqli_close($con);
?>




