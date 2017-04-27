<!DOCTYPE html>
<html>
<head>
	<title>Update</title>
	<script type = "text/javascript">
		function radioReturn(id){
			document.getElementById("abang").value = id.value;
			document.getElementById("abang2").value = id.value;
		}
	</script>
</head>
<body>
	<form action = "/alterUrl" method = "POST">

	<?php
		
		$people = DB::select('select * from people');
		foreach($people as $pips){
			echo '<input type="radio" onclick = "radioReturn(this)" name = "people" value = '. $pips->id.'>'.$pips->name.'<br>';
		}
		
		echo '<input type = "hidden" name = "abang" id = "abang">';
		echo '<input type="submit" value = "UPDATE">';

	?>
		<input type="hidden" name="_token" value="{{ csrf_token() }}">

	</form>
	<?php
		echo '<form method = "POST" action = "/alterUrlDelete">';
		echo '<input type = "submit" name = "delete" value = "DELETE"></a>';
		echo '<input type = "hidden" name = "abang2" id = "abang2">';
		?><input type="hidden" name="_token" value="{{ csrf_token() }}"><?php
		echo '</form>';
	?>
</body>
</html>