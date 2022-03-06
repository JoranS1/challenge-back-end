<?php 
require ('database.php') ?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css"> 
	<title>Todo list</title>
</head>
<body>
	<div class="w3-container w3-center">
		<h2>Make your own todo list!</h2>
		<button class="w3-button w3-blue" onclick="modal('modalNewTodo', 'open')">Create a new todo list</button>
	</div>
	<hr>
	<div class="w3-container">
		<!-- MODAL CREATOR -->
		<div id="modalNewTodo" class="w3-modal">
		<div class="w3-modal-content">
		<div class="w3-container">
		<span onclick="modal('modalNewTodo','close')" class="w3-button w3-display-topmiddle">&times;</span>

		<form action="#" method="post" class="w3-container">
			<h3>Create a todo-list</h3>
			<input type="text" placeholder="The name of the list..." name="todoName" pattern="[a-zA-Z0-9\s]+">
			<br>
			<input type="submit" name="makeTodoList" value="Make the Todo list" class="w3-button w3-blue">
		</form>
		<br>
	</div>
	</div>
	</div>

	<div class="w3-card-4">
		
	</div>
	</div>
</body>
</html>