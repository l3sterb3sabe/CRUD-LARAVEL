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
		<input type = "text" maxlenght = 20 id = "q" name = "q">

		<input type = "submit" name = "submit" value = "Search By">

		<?php

			$people = DB::select('select * from people');
			echo '<table>';
			foreach($people as $pips){
				echo '<tr>';
				echo '<td>'.$pips->name.'</td>';
				echo '<td>'.$pips->age.'</td>';	
				echo '<td>'.$pips->address.'</td>';
				echo '</tr>';
			}

			echo '</table>';
			echo '<input type = "hidden" name = "typeSearch" id = "typeSearch">';
		?>	
		<input type="hidden" name="_token" value="{{ csrf_token() }}">
	</form>
</body>
</html>