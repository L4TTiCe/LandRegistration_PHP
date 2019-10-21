<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link href="https://fonts.googleapis.com/css?family=Noto+Serif&display=swap" rel="stylesheet">
	<!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
	<script src="js/script.js" type="text/javascript" async></script>
	<title>Land Registration Portal</title>
</head>
<body>
	<div class="wrapper">
		<header>
			<img id="seal" src="res/seal_center.png">
			<div class="center-vertical logo-word">
				Ministry<br>
				of Land Registations
			</div>		
		</header>
		<nav>
			<ul>
				<li><a href="index.html">Home</a></li>
				<li><a href="#">How it Works ?</a></li>
				<li><a href="register.php">Register</a></li>
				<li><a href="search.php">Search</a></li>
				<li><a href="#">About</a></li>
			</ul>
		</nav>
		<div class ="container">      
            <br><br>
            <?php
                if (isset($_POST['save'])):
                    $con = mysqli_connect("localhost:3306", "root", "password") or die(mysqli_error());

                    $flag = TRUE;

                    $aadhar = $_POST["LandHolder_aadhar"];
                    $db = mysqli_select_db($con,"landreg");
                    $q = "SELECT * FROM land_table WHERE aadhaar=$aadhar";
                    
                    $result = mysqli_query($con, $q); ?>

                    <table class="table table-striped">
                    <thead class="thead-dark">
                    <tr>
                         <th scope="col">Aadhaar #</th>
                         <th scope="col">State</th>
                         <th scope="col">District</th>
                         <th scope="col">Taluk</th>
                         <th scope="col">Village</th>
                         <th scope="col">Survey #</th>
                         <th scope="col">Subdivision #</th>
                         <th scope="col">Update</th>
                         <th scope="col">Delete</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    while ($r1 =mysqli_fetch_row($result)):
                        $flag = FALSE;
                        echo "<tr>";
                        echo "    <th scope='row'>$r1[1]</th>";
                        echo "    <td>$r1[2]</td>";
                        echo "    <td>$r1[3]</td>";
                        echo "    <td>$r1[4]</td>";
                        echo "    <td>$r1[5]</td>";
                        echo "    <td>$r1[6]</td>";
                        echo "    <td>$r1[7]</td>";
                        echo "    <td>";
                        echo "<form method='post' action='update.php'>";
                        echo "    <input type='hidden' name='tran_id' value='$r1[0]'>";
                        echo "    <input class='btn' type='submit' name='Update'>";
                        echo "</form>";
                        echo "    </td>";
                        echo "    <td><button class='btn'>Delete</button></td>";
                        echo "</tr>";
                    endwhile; ?>

                        </tbody>
                    </table>

                    <form method='post' action='<?php $_PHP_SELF ?>'>
                        <div class="form-group">
                            <label>Aadhaar Number</label>
                            <input class="form-control form-control-lg" type="text" name="LandHolder_aadhar" placeholder="############"><br>
                            <small id="emailHelp" class="form-text text-muted">We'll never share your Aadhaar details with anyone else.</small>
                        </div>
                        <input class="btn btn-primary" type='submit' name='save'><br><br>
                    </form>
                    <?php 
                    mysqli_close($con);

                    if ($flag):
                        ?>
                        <form method='post' action='<?php $_PHP_SELF ?>'>
                        <div class="form-group">
                            <label>Aadhaar Number</label>
                            <input class="form-control form-control-lg" type="text" name="LandHolder_aadhar" placeholder="############"><br>
                            <small id="emailHelp" class="form-text text-muted">We'll never share your Aadhaar details with anyone else.</small>
                        </div>
                        <input class="btn btn-primary" type='submit' name='save'><br><br>
                        <p>No Such Aadhaar Number in DB</p>
                        </form>
                        <?php
                    endif;
                else:
                    ?>
                    <form method='post' action='<?php $_PHP_SELF ?>'>
                    <div class="form-group">
                        <label>Aadhaar Number</label>
                        <input class="form-control form-control-lg" type="text" name="LandHolder_aadhar" placeholder="############"><br>
                        <small id="emailHelp" class="form-text text-muted">We'll never share your Aadhaar details with anyone else.</small>
                    </div>
                    <input class="btn btn-primary" type='submit' name='save'><br><br>
                    </form>
                    <?php
                endif;    
                ?>
                <br>
		</div>
	</div>
	<footer>
		<div class="footer-columns">
			
		</div>
		<div class="center createtag">
			Copyright © 2019 - Land Registration Portal. All Rights Reserved 
        </div>
    </footer>
</body>
</html>
