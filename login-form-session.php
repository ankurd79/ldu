<?php
session_start();

if(isset($_GET['logout'])){
	$str = $_GET['logout'];
	if($str==1){
			unset($_SESSION['loggedin']);
			session_destroy();
			header("Location: login-form-session.php");
	}
}
include_once 'db.php';

//echo $a;
?>

<html lang="en">
<head>
  <title>LDU Login ::</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <script>
    function onlyNumberKey(evt) {
          
        // Only ASCII character in that range allowed
        var ASCIICode = (evt.which) ? evt.which : evt.keyCode
        if (ASCIICode > 31 && (ASCIICode < 48 || ASCIICode > 57))
            return false;
        return true;
    }
</script>
</head>
<body>


<?php
	
	
	#submitting the form
	if(isset($_POST['submit']))
	{
	   
			$username = mysqli_real_escape_string($conn1, $_POST['username']);
			$password = mysqli_real_escape_string($conn1, $_POST['password']);
		

			$sql = "SELECT password_hash FROM 6470exerciseusers where username='".$username."'";
			$result = mysqli_query($conn1, $sql);
			while($r=mysqli_fetch_row($result))
			{
				$hashedpass=$r[0];
			}	

		
		if (password_verify($password, $hashedpass)) {
    	//echo 'Password is valid!';
    	
    	$_SESSION["loggedin"] = "1";

    	//echo $_SESSION["loggedin"];
    	
    	$retval=1;
		} else {
    	echo '<div class="alert alert-danger">
  <strong>Alert!</strong> Unable to login.
</div>
';
    	//echo $retval=2;
    	
		}
	   
	}

?>


<?php 
if(isset($_SESSION["loggedin"])){
	echo "<div class='alert alert-success'>
  <strong>Success!</strong> Succseful logged in | <a href='login-form-session.php?logout=1'>Logout</a>
</div>";

?>
<?php } else {?>

<div class="container">
  <h2>LDU Login Form (with Session)</h2>
  <form action="<?php filter_var($_SERVER["PHP_SELF"],FILTER_SANITIZE_STRING) ?>" method='post'>
    <div class="form-group">
      <label for="email">Username:</label>
      <input type="text" class="form-control" id="username" placeholder="Username" name="username" required>
    </div>

    <div class="form-group">
      <label for="email">Password:</label>
      <input type="password" class="form-control" id="password" placeholder="Password" name="password" required maxlength="20">
    </div>

    
    
    <button type="submit" name="submit" class="btn btn-default">Submit</button>
  </form>
</div>


<?php } ?>	



</body>
</html>