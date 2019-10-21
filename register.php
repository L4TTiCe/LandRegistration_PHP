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
			<br>   
			<form method="post" action="<?php $_PHP_SELF ?>">
				<div class="form-group">
					<label>Aadhaar Number</label>
					<input class="form-control form-control-lg" type="text" name="LandHolder_aadhar" placeholder="############"><br>
					<small id="emailHelp" class="form-text text-muted">We'll never share your Aadhaar details with anyone else.</small>
				</div>
				<div class="form-group">
					<label>State</label>
					<input class="form-control" type="text" placeholder="State" name="Land_state">
				</div>
				<div class="form-group">
					<label>District</label>
					<input class="form-control" type="text" placeholder="District" name="Land_district">
				</div>
				<div class="form-group">
					<label>Taluk</label>
					<input class="form-control" type="text" placeholder="Taluk" name="Land_taluk">
				</div>
				<div class="form-group">
					<label>Village</label>
					<input class="form-control" type="text" placeholder="Village" name="Land_village">
				</div>
				<div class="form-group">
					<label>Survey Number</label>
					<input class="form-control" type="text" placeholder="Survey #" name="Land_survey_number">
				</div>
				<div class="form-group">
					<label>Subdivision Number</label>
					<input class="form-control" type="text" placeholder="Subdivsion #" name="Land_subdivision_number">
				</div>
				<input class="btn btn-primary" type="submit" name='save'>
				<br><br>
			</form>
			<?php
				if (isset($_POST['save'])):
					$con = mysqli_connect("localhost:3306", "root", "password") or die(mysqli_error());

					$file = fopen("currentReg.txt", "w") or die("Unable to open file");
					$txt = "";
				
					$aadhar = $_POST["LandHolder_aadhar"];
					$state = $_POST["Land_state"];
					$district = $_POST["Land_district"];
					$taluk = $_POST["Land_taluk"];
					$village = $_POST["Land_village"];
					$survey = $_POST["Land_survey_number"];
					$subdivision = $_POST["Land_subdivision_number"];

					$txt .= "$aadhar<br>$state<br>$district<br>$taluk<br>$village<br>$survey<br>$subdivision";
					fwrite($file, $txt);
					fclose($file);
					
					$db = mysqli_select_db($con,"landreg");
					
					if(validate($aadhar, $survey, $subdivision)){
						$q = "INSERT INTO land_table (tran_id, aadhaar, state_land, district, taluk, village, survey, subdivision) values (UUID(), '$aadhar', '$state', '$district', '$taluk', '$village', '$survey', '$subdivision')";
						if ( mysqli_query($con, $q))
							echo "record inserted";
						else
							echo "error ".mysqli_error($con);
					}
					else{
						echo "Check Inputs [Aadhaar(12 Number Only), Survey # and SubDivision # (Numbers only)]";
					}
					mysqli_close($con);
				endif;

				//echo "FILE";
				//echo readfile("currentReg.txt");
			?>
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
<?php
	function validateAadhaar($data){
		if (!preg_match("/\d{12}/",$data))
			return FALSE;
		return TRUE;	
	}

	function validateNumber($data){
		if (!preg_match("/\d/",$data))
			return FALSE;
		return TRUE;	
	}

	function validate($aadhaar, $num1, $num2){
		$flag = TRUE;
		$flag = validateAadhaar($aadhaar) && validateNumber($num1) && validateNumber($num2);
		return $flag;
	}
?>
