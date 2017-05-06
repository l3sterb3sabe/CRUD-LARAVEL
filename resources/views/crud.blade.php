<!DOCTYPE html>

<html>
<head>
	<title>crud</title>
	<script type = "text/javascript" src = "https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
	


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

		.search {background-color: blue;}

		input[type=text], select, label{
			height : 30px;
			font-size: 16px;
		}
	</style>
		
		
</head>
<body>
	<h1><?php $search ?></h1>
	<button class = "button" onclick = "test()">Home</button> <br/><br/>
	<!--<a href = "/login"> <button class = "button">Login</button></a>-->

			<input type = "text"  maxlenght = 20 id = "q" name = "q" onkeyup = "updateTable()" placeholder = "Search...">

			<!--<button class = "button search" onclick = "search()">Search</button> -->
	
	<form action = "/crud">
		<select name = "sortBy" id = "sortBy" onchange = "selectReturn(this)">
				<option value = name selected>Name</option>
				<option value = age>Age</option>
				<option value = address>Address</option>
		</select>
		<button >Sort</button>
	</form>
	<form  id = "tableForm" method = "POST" action = "/alterUrl">

			<?php
				if(isset($_GET['searchBy'])){
					if(isset($_GET['q'])){
						$query = 'select * from people where name like "%' .$_GET['q'].'%" or age like "%' .$_GET['q'].'%" or address like "%'.$_GET['q'] . '%"';
					}
				}else{
					$query = "select * from people";
				}
				if(isset($_GET['sortBy'])){
					$query = $query . ' order by ' . $_GET['sortBy'];
				}
				$people = DB::select($query);
				echo '<center><table id = "recordTable">';
				echo '<th>Name</th>';
				echo '<th>Age</th>';
				echo '<th>Address</th>';
				echo '<th>Actions</th>';
				foreach($people as $pips){
					echo '<tr class = "ito" id = '.$pips->id.'>';
					echo '<td ondblclick = "this.contentEditable=true" onblur = "blurSave(this)" class = "edit name" id = "'.$pips->id.'">'.$pips->name.'</td>';
					echo '<td ondblclick = "this.contentEditable=true" onblur = "blurSave(this)" class = "edit age" id = "'.$pips->id.'">'.$pips->age.'</td>';	
					echo '<td ondblclick = "this.contentEditable=true" 	onblur = "blurSave(this)"class = "edit address" id = "'.$pips->id.'">'.$pips->address.'</td>';
					echo '<td><button class="button btnDelete delete" name = "delete" id = "'.$pips->id.'">Delete</button></td>';
					// echo '<td><button class="button update" name = "update" id = "'.$pips->id.'">Update</button>
					// 			<button class="button btnDelete delete" name = "delete" id = "'.$pips->id.'">Delete</button></td>';

					echo '</tr>';

				}

				echo '</table></center>';
				if(empty($people)){
					echo '<center><p>No items to be displayed</p><center>';
				}
				echo '<input type = "hidden" name = "typeSearch" id = "typeSearch">';
			
		?>
		<input type = "hidden" name = "_updateName" id = "_updateName">
		<input type="hidden" name = "_updateAge" id = "_updateAge">
		<input type="hidden" name = "_updateAddress" id = "_updateAddress">
		<input type = "hidden" name = "typeSearch" id = "typeSearch">
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

	<script type = "text/javascript">


		$(document).ready(function(){
			$(".delete").click(function(e){
				e.preventDefault();
				if(confirm("Are you sure to delete item?") == true){
					btnHandler(this);
				}
			});

			$(".update").click(function(e){
				e.preventDefault();
				$("#_btnType").val(this.name);
				$("#_dataId").val(this.id);
				var name = $('td#' + this.id + '.name').html();
				var age = $('td#' + this.id + '.age').html();
				var address = $('td#' + this.id + '.address').html();
				$("#_updateName").val(name);
				$("#_updateAge").val(age);
				$("#_updateAddress").val(address);
				$("#tableForm").submit();
			});

			
		});

		function blurSave(td){
				$("#_btnType").val("update");
				$("#_dataId").val(td.id);
				var name = $('td#' + td.id + '.name').html();
				var age = $('td#' + td.id + '.age').html();
				var address = $('td#' + td.id + '.address').html();
				$("#_updateName").val(name);
				$("#_updateAge").val(age);
				$("#_updateAddress").val(address);
				$("#tableForm").submit();
		}
		
		function btnHandler(btn){
			document.getElementById("_btnType").value = btn.name;
			document.getElementById("_dataId").value = btn.id;
			if(btn.name == "delete"){
				$("#tableForm").submit();
			}

		}

		function selectReturn(id){

			$("#typeSearch").val(id.value);
			alert($("#typeSearch").val());

		}


   			 
		function test(){
			alert("Hello");
		}

		function updateTable(){
			var input, filter, table, tr, tdName, tdAge, tdAddress, i;
			input = $("#q").val();

			filter = input.toLowerCase();
			table = document.getElementById("recordTable");
 			tr = table.getElementsByTagName("tr");

			for(i = 0;  i<tr.length; i++){
				//td = tr[i].getElementsByTagname("td")[0];
				 tdName = tr[i].getElementsByTagName("td")[0];
				 tdAge = tr[i].getElementsByTagName("td")[1];
				 tdAddress = tr[i].getElementsByTagName("td")[2];

				
				if(tdName||tdAge||tdAddress){
					if((tdName.innerHTML.toLowerCase().indexOf(filter) > -1)||tdAge.innerHTML.toLowerCase().indexOf(filter) > -1||tdAddress.innerHTML.toLowerCase().indexOf(filter) > -1){
						tr[i].style.display = "";
					}else{
						tr[i].style.display = "none";
					}
				}
			}
		}
		
	
	</script>
		
</body>
</html>