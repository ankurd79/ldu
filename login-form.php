<?php
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
	
	function checkuser($input,$conn1){

		$username = mysqli_real_escape_string($conn1, $input['username']);
		$password = mysqli_real_escape_string($conn1, $input['password']);
		

		$sql = "SELECT password_hash FROM 6470exerciseusers where username='".$username."'";
		$result = mysqli_query($conn1, $sql);
		while($r=mysqli_fetch_row($result))
		{
			$hashedpass=$r[0];
		}	

		
		if (password_verify($password, $hashedpass)) {
    	//echo 'Password is valid!';
    	
    	$retval=1;
		} else {
    	//echo 'Invalid password.';
    	$retval=2;
    	
		}

		return $retval;

	}
	
	#submitting the form
	if(isset($_POST['submit']))
	{
	   $p=checkuser($_POST,$conn1);

	   if($p==1){
	   		$mesagetxt='<div class="alert alert-success"><strong>Success! You have succesfully logged in! </div>';
	   		echo $hidefrm=1;
	   }else{
	   		$mesagetxt='<div class="alert alert-danger"><strong>Alert!</strong> Unable to login!</div>';
	   }

	   echo $mesagetxt;

	   
	}

?>


<?php 
if(!isset($hidefrm)){
	//echo $hidefrm;
	//exit;
?>
<div class="container">
  <h2>LDU Login Form</h2>
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