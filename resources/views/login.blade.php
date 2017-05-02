<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
</head>
<body>
	<h1>Login</h1>
	<p>
		{{ $errors->first('name') }}
    	{{ $errors->first('age') }}
	</p>
	<form action = "/loginNow" method  = "POST">
		<label for = "name">Name : </label>
		<input type = "text" name = "name" id = "name" maxlength = "40">
		<br><br><br>
		<label for = "name">Age : </label>
		<input type = "text" name = "age" id = "age" maxlength = "40">
		<br><br>
		<input type = "submit">
			<input type="hidden" name = "_token" value = "{{csrf_token()}}">
	</form>
</body>
</html>