<!DOCTYPE html>
<?php
	session_start();
	if(!isset($_SESSION['query'])){
		$_SESSION['query'] = "select * from people";
	}
?>
<html>
<head>
	<title>crud</title>
	<script type = "text/javascript" src = "https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
	<script type = "text/javascript">
		
		function btnHandler(btn){
			document.getElementById("_btnType").value = btn.name;
			document.getElementById("_dataId").value = btn.id;
			if(btn.name == "delete"){
				$("#tableForm").submit();
			}

		}

		function selectReturn(id){

			document.getElementById("typeSearch").value = id.value;

		}

		function search(){
			
		}

		$(function(){
			var $td = $(".edit"); 
			$td.on({ 
				
					"dblclick" : function(){
					$td.not(this).prop("contenteditable", false);
	      			$(this).prop("contenteditable", true);

				}
			});

		});
		$(document).ready(function(){
			$(".delete").click(function(e){
				e.preventDefault();
				if(confirm("Are you sure to delete item?") == true){
					btnHandler(this);
				}
			});
		});
		
	
	</script>

	<style>
		ul {
		    list-style-type: none;
		    margin: 0;
		    padding: 0;
		    overflow: hidden;
		    background-color: #333;
		}

		li {
		    float: left;
		}

		li a {
		    display: block;
		    color: white;
		    text-align: center;
		    padding: 14px 16px;
		    text-decoration: none;
		}

		li a:hover {
		    background-color: #111;
		}
		table {
		    border-collapse: collapse;
		    width: 100%;

		}

		th, td {
		    text-align: left;
		    padding: 8px;
		}

		tr:nth-child(even){background-color: #f2f2f2}

		th {
		    background-color: #4CAF50;
		    color: white;
		}

		form, table{
			margin-top : 60px;
		}

		.button {
		    background-color: #4CAF50; /* Green */
		    border: none;
		    color: white;
		    padding: 10px 25px;
		    text-align: center;
		    text-decoration: none;
		    display: inline-block;
		    font-size: 16px;
		    margin: 4px 2px;
		    cursor: pointer;
		}

		.btnDelete {background-color: #f44336;} /* Red */ 

		td[contenteditable=true] { outline: 2px solid #0af; }	
		td, th { padding:5px; border: 1px solid #ddd; }

	</style>
		
		
</head>
<body>
	<form action = "/crud">
		<select name = "searchBy" id = "searchBy" onchange = "selectReturn(this)">
				<option value = name selected>Name</option>
				<option value = age>Age</option>
				<option value = address>Address</option>
			</select>
			<input type = "text" maxlenght = 20 id = "q" name = "q">

			<button class = "button" onclick = "search()">Search</button>
	</form>
	<form  id = "tableForm" method = "POST" action = "/alterUrl">

			<?php
				if(isset($_GET['searchBy'])){
					if(isset($_GET['q'])){
						$query = 'select * from people where ' . $_GET['searchBy'] . '="' .$_GET['q'].'"';
					}
				}else{
					$query = "select * from people";
				}
				$people = DB::select($query);
				echo '<center><table>';
				echo '<th>Name</th>';
				echo '<th>Age</th>';
				echo '<th>Address</th>';
				echo '<th>Actions</th>';
				foreach($people as $pips){
					echo '<tr id = '.$pips->id.'>';
					echo '<td class = "edit" id = "name">'.$pips->name.'</td>';
					echo '<td class = "edit" id = "age">'.$pips->age.'</td>';	
					echo '<td class = "edit" id = "address">'.$pips->address.'</td>';
					echo '<td><button class="button update" name = "update" id = "'.$pips->id.'" onclick = "btnHandler(this)">Update</button>
								<button class="button btnDelete delete" name = "delete" id = "'.$pips->id.'">Delete</button></td>';

					echo '</tr>';

				}

				echo '</table></center>';
				echo '<input type = "hidden" name = "typeSearch" id = "typeSearch">';
			?>
		
		<input type = "hidden" name = "typeSearch" id = "typeSearch">;
		<input type="hidden" name = "_dataId" id = "_dataId">
		<input type="hidden" name = "_btnType" id = "_btnType">
		<input type="hidden" name="_token" value="{{ csrf_token() }}">
	</form>
	<form align="center" name = "create" method = "POST" action = "/create/people">
			<label for="addName">Name: </label><input type="text" name = "addName" id = "addName">
			<label for="addName">Age: </label><input type="text" name = "addAge" id = "addName">
			<label for="addName">Address: </label><input type="text" name = "addAddress" id = "addName">

			<input type="submit" class = "button" name = "create" value = "Create">
			<input type="hidden" name="_token" value="{{ csrf_token() }}">
	</form>

</body>
</html>