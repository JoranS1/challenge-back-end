<?php 
include_once 'database.php'; 
$todo = allTodo();
$task = allTask();
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <title>Todo list</title>
	<link rel="stylesheet" href="style/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script>
            function modal(elementID, openedClosed){
                var elementName = document.getElementById(elementID);
                if(openedClosed === "open"){
                    elementName.style.display = "block";
                } else{
                    elementName.style.display = "none";  
                }
            }

            function sortTodo(todo, filter){
                var todoItems = document.querySelectorAll("[data-todoID='"+ todo + "']")
                var sortTodo = [];
                for(let val of todoItems){
                    var currentIdName = val.id;
                    var currentTodoName = val.name;
                    if(filter === "description"){
                        var filterCheck = val.dataset.description;
                    }else if(filter === "time"){
                        var filterCheck = val.dataset.time;
                    }else if(filter === "status"){
                        var filterCheck = val.dataset.status;
                    } else{
                        filterCheck = currentTodoName;
                    }

                    sortTodo.push([currentIdName, filterCheck]);
                }
                    sortTodo.sort(function(a, b){
                        return a[1] - b[1];
                    });

                    for(let i = 0; i < sortTodo.length; i++){
                        console.log(sortTodo[i][0]);
                        document.getElementById(sortTodo[i][0]).style.order = i;
                    }
                
            }
        </script>
</head>

<body>
    <div class="w3-container w3-center">
        <h2 class="title">Make your own todo list!</h2>
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
                        <input type="text" placeholder="The name of the list..." class="w3-input w3-border" name="todoName"
                            pattern="[a-zA-Z0-9\s]+" required>
                       
                        <br>
                        <input type="submit" name="makeTodoList" value="Make the Todo list" class="w3-button w3-blue">
                    </form>
                    <br>
                </div>
            </div>
        </div>

        <div class="w3-card-4">

        <?php foreach ($todo as $value):?>
            <div class="w3-card-4" style="display:inline-block; position:relative; height:100%">
            <header class="w3-container w3-light-grey">
                <h3><?php echo $value['name'];?></h3>
                <button class="w3-btn" onclick="sortTodo(<?php echo $value['id']; ?>, 'description')">
            </button>
            <button class="w3-btn" onclick="sortTodo(<?php echo $value['id']; ?>, 'time')">
            <i class="fa-fa-clock"></i>
        </button>
            <button class="w3-btn" onclick="sortTodo(<?php echo $value['id']; ?>, 'status')">
            <i class="fa-fa-calendar-check-o" ></i>
        </button>
            </header>
            <div class="w3-container" id="todoContainer<?php echo $value['id'];?>">
            <?php foreach($task as $values):?>
            <div class="task" id="taskId<?php echo $values["id"]; ?>" data-todoID="<?php echo $values['id'];?>" data-taskName="<?php echo $values['name'];?>" data-taskTime="<?php echo $values['time'];?>" data-taskStatus="<?php echo $values['status']?>">
                <h3><?php echo $values["name"];?></h3>
                <p><?php echo $values["description"];?></p>
                <span class="w3-card w3-purple">Time: <?php echo $values["time"]?></span>
                <span class="w3-tag w3-pink"><?php 
                if ($values['status']){
                    echo "active";
                }else{
                    echo "inactive";
                }
                ?></span>
                <span class="w3-button w3-orange" onclick="modal('modalTask<?php echo $values['id']?>', 'open')">
            Edit Task <i class="fa-solid fa-gear"></i>
        </span>
            </div>
            <hr>

            <div id="modalTask<?php echo $values['id'] ?>" class="w3-modal">
                <div class="w3-modal-content">
                    <div class="w3-container">
                        <span onclick="modal('modalTask<?php echo $values['id']?>', 'close')" class="w3-button w3-display-topright">&times;</span>
                        <form action="#" method="post" class="w3-container">
                            <h3>New task:</h3>
                            <input type="hidden" name="taskId" value="modalItem<?php echo $values['id']?>">
                            <br>
                            <input type="text" name="taskName" placeholder="Name of the task" class="w3-input w3-border" pattern="[a-zA-Z0-9\s]+" required value="<?php echo $values['name']?>">
                            <br>
                            <input type="text" name="taskDescription" placeholder="Description of the task" class="w3-input w3-border" pattern="[a-zA-Z0-9\s]+" required value=<?php echo $values['description']?> class="w3-input w3-border">
                            <br>
                            <input type="number" name="taskTime" placeholder="Duration of the task (in minutes please)" class="w3-input w3-border" required value=<?php echo $values['time']?>>
                            <br>
                            <label for="status">Task Status</label>
                            <input type="radio" name="taskStatus" value="1" <?php if($values['status']){
                                echo 'Checked';
                            } ?>>
                            <label>Active</label><br>
                            <input type="radio" name="taskStatus" value="0" <?php if($values['status']){
                                echo 'Checked';
                            } ?>>
                            <label>Inactive</label><br>
                            <input type="submit" name="updateTask" value="Update Task" class="w3-btn w3-block">
                            <input type="submit" name="deleteTask" value="Delete Task" class="w3-btn w3-red w3-block">
                            <br>
                        </form>
                    </div>
                </div>
            </div>
            <?php endforeach;?>
        
        
        </div>
        <br>
        <div style="position: relative; bottom: 0;">
                <button class="w3-button w3-block w3-purple" onclick="modal('modalEditTodo<?php echo $value['id']?>', 'open')">Edit the Todo List</button>
                <button class="w3-button w3-block w3-green" onclick="modal('modalNewTask<?php echo $value['id']?>', 'open')">New task</button>
    </div>
    <div id="modalNewTask<?php echo $value['id']?>" class="w3-modal">
        <div class="w3-modal-content">
            <div class="w3-container">
            <span onclick="modal('modal<?php echo $value['id']?>', 'close')" cols="25" rows="10" class="w3-button w3-display-topright">&times;</span>

            <form action="#" method="post" class="w3-container">
                <h3>New task</h3>
                <input type="hidden" name="todoListId" value="<?php echo $value['id']?>">
                <br>
                <input type="text" name="taskName" placeholder="Name of the task" class="w3-input w3-border" pattern="[a-zA-Z0-9\s]+" required>
                <br>
                <input type="text" name="taskDescription" style="resize: vertical;" class="w3-input w3-border" placeholder="Description of the task" pattern="[a-zA-Z0-9\s]+" required>
                <br>
                <input type="number" name="taskTime" class="w3-input w3-border" placeholder="Duration of the task (in minutes please)" class="w3-input w3-border" required>
                <br>
                <input type="submit" name="makeTask" value="Add task" class="w3-btn w3-block">
                <br>
            </form>
            </div>

        </div>
</div>
        </div>
        <div id="modalEditTodo<?php echo $value['id']?>" class="w3-modal">
        <div class="w3-modal-content">
            <div class="w3-container">
            <span onclick="modal('modalEditTodo<?php echo $value['id']?>', 'close')" cols="25" rows="10" class="w3-button w3-display-topright">&times;</span>
            <form action="#" method="post" class="w3-container">
                <h3>Edit Todo List</h3>
                <input type="hidden" name="todoListId" value="<?php echo $value['id']?>">
                <br>
                <input type="text" name="todoName" placeholder="Name of the todo list" class="w3-input w3-border" pattern="[a-zA-Z0-9\s]+" required value="<?php echo $value['name']?>">
                <input type="submit" name="updateTodo" value="Update Todo List" class="w3-btn w3-block">
                <input type="submit" name="deleteTodo" value="Delete Todo List" class="w3-btn w3-red w3-block">
            </form>
            </div>
            </div>
            </div>
        <?php endforeach;?>
        </div>
    </div>
        
</body>
</html>