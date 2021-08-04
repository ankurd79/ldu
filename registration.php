<?php
include_once 'db.php';

//echo $a;
?>

<html lang="en">
<head>
  <title>LDU REgistration ::</title>
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

<div class="container">
  <h2>LDU Registration Form</h2>
  <form action="<?php filter_var($_SERVER["PHP_SELF"],FILTER_SANITIZE_STRING) ?>" method='post'>
    <div class="form-group">
      <label for="email">Username:</label>
      <input type="text" class="form-control" id="username" placeholder="Username" name="username" required>
    </div>

    <div class="form-group">
      <label for="email">Password:</label>
      <input type="password" class="form-control" id="password" placeholder="Password" name="password" required maxlength="20">
    </div>

    <div class="form-group">
      <label for="email">Phone:</label>
      <input type="text" class="form-control" id="phone" placeholder="Phone" name="phone" required maxlength="10" onkeypress="return onlyNumberKey(event)" >
    </div>
    
    <button type="submit" name="submit" class="btn btn-default">Submit</button>
  </form>
</div>

<?php
	
	function encrypt($data){
		 //$data=md5($data);
		 $data=password_hash($data, PASSWORD_DEFAULT);
		 return $data;
	 }

	function insert($input,$conn1){

		$username = mysqli_real_escape_string($conn1, $input['username']);

		$sql = "SELECT id FROM 6470exerciseusers where username='".$username."'";
		$result = mysqli_query($conn1, $sql);
		if (mysqli_num_rows($result) > 0) {
			$strreturn=0;
		}else{
			
			
			$password = mysqli_real_escape_string($conn1, $input['password']);
			$hashedpassword=encrypt($password);
			$phone = mysqli_real_escape_string($conn1, $input['phone']);

			$sqlinsert='insert into 6470exerciseusers(username,password_hash,phone)values("'.$username.'","'.$hashedpassword.'","'.$phone.'")';
			$result = mysqli_query($conn1, $sqlinsert);
			mysqli_close($conn1);
			$strreturn=1;
		}

		return message($strreturn,$input);


	}

	function message($val,$input){
		if($val==1){
			$mesagetxt='<div class="alert alert-success"><strong>Success! You have succesfully registered!<br> Username : '.$input['username'].' | Phone : '.$input['phone'].' </div>';
			
		}elseif($val==0){
			$mesagetxt='<div class="alert alert-danger"><strong>Alert!</strong> Inofrmation already exists!!.</div>';
		}

		return $mesagetxt;
	}

	#submitting the form
	if(isset($_POST['submit']))
	{
	   echo insert($_POST,$conn1);
	}

?>

</body>
</html>