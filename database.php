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
function clean($data)
{
    $data = preg_replace('@[^A-Za-z0-9\w\ ]@', '', $data);
    $data = htmlspecialchars($data);
    $data = stripslashes($data);
    $data = trim($data);
    
    return $data;
}
function allTodo(){
	$conn = connAll();
	$query = "SELECT * FROM todo ORDER BY id";
	$conn = connAll();
	$result = $conn->prepare($query);
	$result->execute();
	$rows = $result->fetchAll();
	$data = clean($result);
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
function addTodo($name){
	$conn = connAll();
	$query = $conn->prepare("INSERT INTO todo (id, Name) VALUES (:Name)");
	$query -> execute(array(
		':Name' => $name));
}
function addTask($description,$time,$status,$listId){
	$conn = connAll();
	$query = $conn->prepare("INSERT INTO task (id, description, time, status,listId) VALUES (:description, :time, :status,:listId)");
	$query -> execute(array(
	':description' => $description,
	':time' => $time,
	':status' => $status,
	':listId' => $listId
));
}
function updateTask($id,$description,$time,$status,$listId){
	$conn = connAll();
	$query = $conn->prepare("UPDATE task SET description=:description, time=:time, status=:status, listId=:listId WHERE id=:id");
	$query->bindParam(':description',$description);
	$query->bindParam(':time',$time);
	$query->bindParam(':status',$status);
	$query->bindParam(':id',$id);
	$query->bindParam(':listId',$listId);
}
function deleteTask($id){
	$conn = connAll();
	$query = $conn->prepare("DELETE FROM task WHERE id = ?");
	$query->execute([$id]);
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
function updateTodo($id, $name){
	$conn = connAll();
	$query = $conn->prepare("UPDATE todo SET name=:name WHERE id=:id");
	$query->bindParam(':id', $id, ':name', $name);
}
function deleteTodo($id){
	$conn = connAll();
	$query = $conn->prepare("DELETE FROM todo WHERE id = ?");
	$query->execute([$id]);
}
function filterStatus(){
	$conn = connAll();
	$query = $conn->prepare("SELECT * FROM task ORDER BY status");
	$query->execute();
	$result = $query->fetchAll();
	return $result;
}

function filterTime(){
	$conn = connAll();
	$query = $conn->prepare("SELECT * FROM task ORDER BY time DESC");
	$query->execute();
	$result = $query->fetchAll();
	return $result;
}

//clean functions
/*$taskId = clean($_POST['taskId']);
$todoListId = clean($_POST['todoListId']);
$taskTime = clean($_POST['taskTime']);
$taskStatus = clean($_POST['taskStatus']);
$taskDescription = clean($_POST['taskDescription']);
$todoName = clean($_POST['todoName']);*/


//post if statements
if (isset($_POST['makeTodoList'])){
	addTodo($todoName);
}
if(isset($_POST['makeTask'])){
	addTask($taskDescription, $taskTime, $taskStatus, $todoListId);
}
if(isset($_POST['updateTask'])){
	updateTask($taskId, $taskDescription, $taskTime, $taskStatus, $todoListId);
}
if(isset($_POST['deleteTask'])){
	deleteTask($taskId);
}