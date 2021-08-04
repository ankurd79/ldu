<?php
	function countWords($str){
		$strArr=explode(" ",$str);
		$finalarr=array_count_values($strArr);

		$return_data = '';	
		foreach($finalarr as $k=>$v){
			$return_data.='<tr><td>'.ucfirst($k).'</td><td>'.$v.'</td>';	
			
		}

		return $return_data;
	}		

?>


<html lang="en">
<head>
  <title>Word Count Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container">
  <h2>WordCOunt Form</h2>
  <form action="<?php filter_var($_SERVER["PHP_SELF"],FILTER_SANITIZE_STRING) ?>" method='get'>
    <div class="form-group">
      <label for="email">Specify the string:</label>
      <input type="text" class="form-control" id="string" placeholder="Enter string" name="string">
    </div>
    
    <button type="submit" class="btn btn-default">Submit</button>
  </form>
</div>

<?php

	if(isset($_GET['string']))
	{
	   $str = $_GET['string'];
	   if($str<>''){
	   		echo '<table class="table"><thead><tr><th>Words</th><th>Occurence</th></tr></thead><tbody>';
	   		echo countWords($str);
	   		echo '</tbody></table>';
	   }
	}

?>

</body>
</html>