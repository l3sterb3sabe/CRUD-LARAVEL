<!DOCTYPE html>
<html>
<head>
	<title>Update</title>
	<script type = "text/javascript" src = "https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
	<script type = "text/javascript">
		$("#btnSubmit").click(function(e){
			e.preventDefault();
			if(confirm("Save changes?") == true){
				$("#updateForm").submit();
			}
			else{
				window.location.href = "/crud";
			}
		});
	</script>
</head>
<body>
	<form id = "updateForm" action = "/updateDB/<?php echo $id?>" method = "POST">
	<?php
		$people = DB::select('select * from people where id = ?', [$id]);
		foreach($people as $pips){
			echo 'Name : <input type = "text" name = "upname" value = '.$pips->name.'><br><br>';
			echo 'Age : <input type = "text" name = "upage" value = '.$pips->age.'><br><br>';
			echo 'Address : <input type = "text" name = "upaddress" value = '.$pips->address.'>';
			echo '<input type = "submit" id = "btnSubmit">';
		}

	?>

	<input type="hidden" name="_token" value="{{ csrf_token() }}">
	</form>
</body>
</html>