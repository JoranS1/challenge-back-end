<?php 
function connAll(){ 
	try{
	$conn = new PDO('mysql:host=localhost;dbname=todolist','root', 'mysql');
	return $conn;
}
	catch(PDOException $e){
	print "Error!: " . $e->getMessage() . "<br/>";
	die();
	}
} 

function allTodo(){
	$conn = connAll();
	$query = "SELECT * FROM todo ORDER BY id";
	$conn = connAll();
	$result = $conn->prepare($query);
	$result->execute();
	$rows = $result->fetchAll();
	return $rows;
}

function allTask(){
	$conn = connAll();
	$query = "SELECT * FROM task ORDER BY id";
	$conn = connAll();
	$result = $conn->prepare($query);
	$result->execute();
	$rows = $result->fetchAll();
	return $rows;
}
function addTodo($id,$name){
	$conn = connAll();
	$query = $conn->prepare("INSERT INTO todo (id, Name) VALUES (:id, :Name)");
	$query -> execute(array(
		':id' => $id, 
		':Name' => $name));
}
function addTask($id,$description,$time,$status){
	$conn = connAll();
	$query = $conn->prepare("INSERT INTO task (id, description, time, status) VALUES (:id, :description, :time, :status)");
	$query -> execute(array(
	':id' => $id,
	':description' => $description,
	':time' => time('h:i:s', strtotime($time)),
	':status' => $status
));
}
function updateTask($id,$description,$time,$status){
	$conn = connAll();
	$query = $conn->prepare("UPDATE task SET description=:description, time=:time, status=:status WHERE id=:id");
	$query->bindParam(':description',$description);
	$query->bindParam(':time',$time);
	$query->bindParam(':status',$status);
	$query->bindParam(':id',$id);
}
function deleteTask($id){
	$conn = connAll();
	$query = $conn->prepare("DELETE FROM task WHERE id = :id");
	$query->execute(array(":id" -> $id));
}
function getTodo($id){
	$conn = connAll();
	$query = $conn->prepare("SELECT * FROM todo WHERE id=:id");
	$query->bindParam(":id", $id);
	$query->execute();
	$singleTodo = $query->fetch();
	return $singleTodo;
}
function getTask($id){
	$conn = connAll();
	$query = $conn->prepare("SELECT * FROM task WHERE id=:id");
	$query->bindParam(":id", $id);
	$query->execute();
	$singleTask = $query->fetch();
	return $singleTask;
}
?>