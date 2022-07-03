<?php 
require ('database.php'); 
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
    <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
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
                        <input type="text" placeholder="The name of the list..." name="todoName"
                            pattern="[a-zA-Z0-9\s]+">
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
            <i class="fa-fa-clock" aria-hidden="true"></i>
        </button>
            <button class="w3-btn" onclick="sortTodo(<?php echo $value['id']; ?>, 'status')">
            <i class="fa-fa-calendar-check-o" aria-hidden="true"></i>
        </button>
            </header>
            <div class="w3-container" id="todoContainer<?php echo $value['id'];?>">
            <?php foreach($tasks as $values):?>
            <div class="task" id="taskId<?php echo $values["id"]; ?>" data-todoID="<?php echo $values['id'];?>" data-taskName="<?php echo $values['name'];?>" data-taskTime="<?php echo $values['time'];?>" data-taskStatus="<?php echo $values['status']?>">
                <h3><?php echo $values["name"];?></h3>
                <p><?php echo $values["description"];?></p>
                <span class="w3-card w3-purple">Time: <?php echo $values["time"]?></span>
                <span class="w3-tag w3-pink"><?php 
                if ($val1['status']){
                    echo "active";
                }else{
                    echo "inactive";
                }
                ?></span>
                <span class="w3-button w3-orange" onclick="modal('modalItem<?php echo $val1['id']?>', 'open')">
            Edit Task <i class="fa-solid fa-gear"></i>
        </span>
            </div>
            <hr>

            <div id="modalTask<?php echo $val1['id'] ?>" class="w3-modal">
                <div class="w3-modal-content">
                    <div class="w3-container">
                        <span onclick="modal('modalItem<?php echo $val1['id']?>', 'close')" class="w3-button w3-display-topright">&times;</span>
                        <form action="#" method="post" class="w3-container">
                            <h3>New task:</h3>
                            <input type="hidden" name="taskId" value="modalItem<?php echo $val1['id']?>">
                            <input>
                        </form>
                    </div>
                </div>
            </div>
            <?php endforeach;?>
        
        
        </div>
        </div>
    
        <?php endforeach;?>
        </div>
    </div>

</body>
</html>