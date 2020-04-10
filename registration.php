<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="reg.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
	<title>Registration</title>
</head>
<body>

	<?php

		function test_input($data) {
		  $data = trim($data);
		  $data = stripslashes($data);
		  $data = htmlspecialchars($data);
		  return $data;
		}

		$name = $email = $pass = $phone = $city = "";
		$nameErr= $passErr= $emailErr="";
		if ($_SERVER["REQUEST_METHOD"]=="POST") {
			# code...
			if(empty($_POST['username'])){
				$nameErr = "name is required";
				$boolean = false;
			}
			elseif (!preg_match("/^[a-zA-Z ]*$/",$_POST['username'])) {
				# code...
				$nameErr = "Only alphabets and whitespaces are allowed";
				$boolean = false;
			}
			else{
				$name = test_input($_POST['username']);
				$boolean = true;
			}



			if (empty($_POST['email'])) {
				# code...
				$emailErr = "Email is required";
				$boolean = false;
			}
			elseif (!filter_var($_POST['email'],FILTER_VALIDATE_EMAIL)) {
				# code...
				$emailErr = "Invalid Email";
				$boolean = false;
			}
			else
			{
				$email = test_input($_POST["email"]);
				if ($boolean == false) {
					# code...
					$boolean = false;
				}
				else
				{
					$boolean = true;
				}
				
			}




			if (empty($_POST['password'])) {
				# code...
				$passErr = "Password is required";
				$boolean = false;
			}
			elseif (strlen($_POST['password'])<8) {
				# code...
				$passErr = "Enter a strong password".$_POST["password"];

				$boolean = false;
			}
			else
			{
				$pass = test_input($_POST["password"]);
				if ($boolean == false) {
					# code...
					$boolean = false;
				}
				else
				{
					$boolean = true;
				}
			}

			if (isset($_POST['submit']) && $boolean) {
				# code...
				$city = test_input($_POST["city"]);
				$phone = test_input($_POST["phone"]);
				$host = "localhost";
				$user = "root";
				$password = "";
				$database = "r";
				$conn = mysqli_connect($host,$user,$password,$database);
				if (!$conn) {
					# code...
					die("Connection failed: " . mysqli_connect_error());
				}

				$sql = "INSERT INTO register (username, email, password, phone, city) VALUES ('$name', '$email', '$pass','$phone','$city')";
				if (mysqli_query($conn,$sql)) {
					# code...
					header("Location: register.php?name=". $_POST['username']."");
				}
				else
				{
					echo "Error: " . $sql . "<br>" . mysqli_error($conn);
				}
				
			}
		}
	?>



	<div class="container-fluid bg">
		<div class="row">
			<div class="col-md-4 col-sm-4 col-xs-12">
				
			</div>
			<div class="col-md-4 col-sm-4 col-xs-12">
				<form class="form-container" method="post" action="">
					<h2>Register</h2>
					<p><span class="error">* required field</span></p>
				  <div class="form-group">
				    <label for="exampleInputUsername">Username</label><span class="error">* <?php echo $nameErr;?></span>
				    <input type="text" class="form-control" id="exampleInputUsername" name="username" placeholder="Eg: John">
				  </div>
				  <div class="form-group">
				    <label for="exampleInputEmail1">Email address</label>&nbsp;<span class="error"><?php echo $emailErr;?></span>
				    <input type="email" class="form-control" id="exampleInputEmail1" name="email" placeholder="abc@mail.com">
				  </div>
				  <div class="form-group">
				    <label for="exampleInputPassword1">Password</label><span class="error">* <?php echo $passErr;?></span>
				    <input type="password" class="form-control" id="exampleInputPassword1" name="password" placeholder="Password">
				  </div>
				  <div class="form-group">
				    <label for="exampleInputPhone">Phone</label>
				    <input type="tel" class="form-control" id="exampleInputPhone" name="phone" placeholder="9876543210" pattern="[7-9]{1}[0-9]{2}[0-9]{3}[0-9]{4}">
				  </div>
				  <div class="form-group">
				    <label for="exampleInputCity">City</label>
				    <input type="text" class="form-control" id="exampleInputCity" name="city" placeholder="Eg:New Delhi">
				  </div>
				  <button type="submit" name="submit" class="btn btn-success btn-block">Submit</button>
				</form>
			</div>
			<div class="col-md-4 col-sm-4 col-xs-12">
				
			</div>
		</div>
	</div>
	
</body>
</html>