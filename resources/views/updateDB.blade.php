<!DOCTYPE html>
<html>
<head>
	<title>Update</title>
</head>
<body>
	<form action = "/updateDB/<?php echo $id?>" method = "POST">
	<?php
		$people = DB::select('select * from people where id = ?', [$id]);
		foreach($people as $pips){
			echo 'Name : <input type = "text" name = "upname" value = '.$pips->name.'><br><br>';
			echo 'Age : <input type = "text" name = "upage" value = '.$pips->age.'><br><br>';
			echo 'Address : <input type = "text" name = "upaddress" value = '.$pips->address.'>';
			echo '<input type = "submit">';
		}

	?>

	<input type="hidden" name="_token" value="{{ csrf_token() }}">
	</form>
</body>
</html>