<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
<form method = "POST" action = "/create/people">
			Name : <input type = "text" id = "name" name = "name" maxlenght = "50" size = "50"><br><br>
			Age : <input type = "text" id = "age" name = "age" maxlenght = "50" size = "50"><br><br>
			Address : <input type = "text" id = "address" name = "address" maxlenght = "50" size = "50"><br><br>
			<input type = "submit" id = createButton value = "CREATE">

			<input type="hidden" name="_token" value="{{ csrf_token() }}">
		</form>
</body>
</html>