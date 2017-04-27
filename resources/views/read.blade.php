<!DOCTYPE html>
<html>
<head>
	<title>Read</title>
	<script type = "text/javascript">
		function selectReturn(id){

			document.getElementById("typeSearch").value = id.value;

		}
	</script>

</head>
<body>
	<form action= "/alterUrlRead" method = "POST">
		<select name = "searchBy" id = "searchBy" onchange = "selectReturn(this)">
			<option value = name selected>Name</option>
			<option value = age>Age</option>
			<option value = address>Address</option>
		</select>

		<input type = "submit" name = "submit" value = "Search By">

		<?php

			$people = DB::select('select * from people');
			echo '<hr>';
			foreach($people as $pips){
				echo '<h2>'.$pips->name.'</h2>';
				echo '<h4>Age : '.$pips->age.'</h4>';
				echo '<h4>Address: '.$pips->address.'</h4>';
				echo '<hr>';
			}
			echo '<input type = "hidden" name = "typeSearch" id = "typeSearch">';
		?>
		<input type="hidden" name="_token" value="{{ csrf_token() }}">
	</form>
</body>
</html>