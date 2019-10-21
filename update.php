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
            $tran = $_POST['tran_id'];
            echo "Your ID is: ".$tran.".";
            echo "<br><br>";
        ?>
        <form method="post" action="<?php $_PHP_SELF ?>">
            <?php
                echo "    <input type='hidden' name='tran_id' value='$tran'>";
                $con = mysqli_connect("localhost:3306", "root", "password") or die(mysqli_error());

                $db = mysqli_select_db($con,"landreg");
                $q = "SELECT * FROM `land_table` WHERE `tran_ID`='$tran'";
                
                $result = mysqli_query($con, $q);
                while ($r1 =mysqli_fetch_row($result)):
                    echo "Aadhar:<br>";
                    echo "<input type='text' name='LandHolder_aadhar' value='$r1[1]'><br>";
                    echo "State:<br>";
                    echo "<input type='text' name='Land_state' value='$r1[2]'><br>";
                    echo "District:<br>";
                    echo "<input type='text' name='Land_district' value='$r1[3]'><br>";
                    echo "Taluk:<br>";
                    echo "<input type='text' name='Land_taluk' value='$r1[4]'><br>";
                    echo "Village:<br>";
                    echo "<input type='text' name='Land_village' value='$r1[5]'><br>";
                    echo "Survey Number:<br>";
                    echo "<input type='text' name='Land_survey_number' value='$r1[6]'><br>";
                    echo "Subdivision Number:<br>";
                    echo "<input type='text' name='Land_subdivision_number' value='$r1[7]'><br><br>";
                endwhile;
                    echo "<input type='submit' value='Update' name='alter'>";
                    echo "<input type='submit' value='Delete' name='delete'><br>";

                mysqli_close($con);
            ?>
        </form>
        <?php
            if (isset($_POST['alter'])):
                $con = mysqli_connect("localhost:3306", "root", "password") or die(mysqli_error());

                $aadhar = $_POST["LandHolder_aadhar"];
                $state = $_POST["Land_state"];
                $district = $_POST["Land_district"];
                $taluk = $_POST["Land_taluk"];
                $village = $_POST["Land_village"];
                $survey = $_POST["Land_survey_number"];
                $subdivision = $_POST["Land_subdivision_number"];

                $db = mysqli_select_db($con,"landreg");

                $q = "UPDATE land_table SET state_land='$state', district='$district', taluk='$taluk', village='$village', survey='$survey', subdivision='$subdivision' WHERE `tran_ID`='$tran'";

                if ( mysqli_query($con, $q))
                    echo "Record Updated";
                else
                    echo "ERROR ".mysqli_error($con);

                mysqli_close($con);
            endif;

            if (isset($_POST['delete'])):
                $con = mysqli_connect("localhost:3306", "root", "password") or die(mysqli_error());

                $aadhar = $_POST["LandHolder_aadhar"];
                $db = mysqli_select_db($con,"landreg");

                $q = "DELETE FROM land_table WHERE `tran_ID`='$tran'";

                if ( mysqli_query($con, $q))
                    echo "Record Deleted";
                else
                    echo "ERROR ".mysqli_error($con);

                mysqli_close($con);
            endif;
        ?>
        <br><br>
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
