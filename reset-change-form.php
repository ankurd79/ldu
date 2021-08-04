<?php
include_once 'db.php';

//echo $a;
?>

<html lang="en">
<head>
  <title>LDU Reset Password ::</title>
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
	

		function generateRandomString(){
		 $string = "";
		 $chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
		 $len=8;
		 for($i=0;$i<$len;$i++)
		  $string.=substr($chars,rand(0,strlen($chars)),1);
		return $string;
	 }

	 function encrypt($data){
		 //$data=md5($data);
		 $data=password_hash($data, PASSWORD_DEFAULT);
		 return $data;
	 }

	function checkuser($input,$conn1){

		$username = mysqli_real_escape_string($conn1, $input['username']);
		$phone = mysqli_real_escape_string($conn1, $input['phone']);
		

		$sql = "SELECT id FROM 6470exerciseusers where username='".$username."' and phone='".$phone."'";
		$result = mysqli_query($conn1, $sql);
		if (mysqli_num_rows($result) > 0) {
			

					$randomstring=generateRandomString();
					//echo '<br>';
					$newpasswordhash=encrypt($randomstring);

					$up="update 6470exerciseusers set password_hash='".$newpasswordhash."' where username='".$username."' and phone='".$phone."'";
					$result = mysqli_query($conn1, $up);

			$strreturn=1;
		}else{
			$randomstring='';
			$strreturn=0;
		}

		return $strreturn.'_'.$randomstring;

	}
	
	#submitting the form
	if(isset($_POST['respass']))
	{
	   $p=checkuser($_POST,$conn1);

	   $m=(explode("_",$p));
		 $p=$m['0'];
		 $newpassword=$m['1'];  	

	   if($p==1){
	   		$mesagetxt='<div class="alert alert-success"><strong>Success! Password has been reset. New Password is '.$newpassword.' </div>';
	   		$hidefrm=1;
	   }else{
	   		$mesagetxt='<div class="alert alert-danger"><strong>Alert!</strong> Unable to find user!</div>';
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
  <h2>LDU Reset Password</h2>
  <form action="<?php filter_var($_SERVER["PHP_SELF"],FILTER_SANITIZE_STRING) ?>" method='post'>
    <div class="form-group">
      <label for="email">Username:</label>
      <input type="text" class="form-control" id="username" placeholder="Username" name="username" required>
    </div>

    <div class="form-group">
      <label for="email">Phone:</label>
      <input type="text" class="form-control" id="phone" placeholder="Phone" name="phone" required maxlength="10" required maxlength="10" onkeypress="return onlyNumberKey(event)">
    </div>

    
    
    <button type="submit" name="respass" class="btn btn-default">Submit</button>
  </form>
</div>
<?php } ?>

<br><br><br><hr>

<?php # for change password...


		function changepasswrd($input,$conn1){

			$username = mysqli_real_escape_string($conn1, $input['username']);
		  $password = mysqli_real_escape_string($conn1, $input['password']);
		  $npassword = mysqli_real_escape_string($conn1, $input['npassword']);
		

		$sql = "SELECT password_hash FROM 6470exerciseusers where username='".$username."'";
		$result = mysqli_query($conn1, $sql);
		while($r=mysqli_fetch_row($result))
		{
			$hashedpass=$r[0];
		}	

		
		if (password_verify($password, $hashedpass)) {
    	//echo 'Password is valid!';

    			$newhash=encrypt($npassword);

					$upd="update 6470exerciseusers set password_hash='".$newhash."' where username='".$username."'";
					$result = mysqli_query($conn1, $upd);
    	
    	$retval=1;
		} else {
    	//echo 'Invalid password.';
    	$retval=2;
    	
		}

		return $retval;
		

	}
	
	#submitting the form
	if(isset($_POST['changepass']))
	{
	   $p=changepasswrd($_POST,$conn1);

	   
	   if($p==1){
	   		$mesagetxt='<div class="alert alert-success"><strong>Success! Password has been updated.</div>';
	   		$hidefrmc=1;
	   }else{
	   		$mesagetxt='<div class="alert alert-danger"><strong>Alert!</strong> Unable to update password!</div>';
	   }

	   echo $mesagetxt;

	   
	}


?>


<?php 
if(!isset($hidefrmc)){
	//echo $hidefrm;
	//exit;
?>
<div class="container">
  <h2>LDU Change  Password</h2>
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
      <label for="email">New Password:</label>
      <input type="password" class="form-control" id="npassword" placeholder="New Password" name="npassword" required maxlength="20">
    </div>

    
    
    <button type="submit" name="changepass" class="btn btn-default">Submit</button>
  </form>
</div>
<?php } ?>

</body>
</html>