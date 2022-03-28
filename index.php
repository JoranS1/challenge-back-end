<?php 
require ('database.php'); 
$todo = allTodo();
$task = allTask();?>

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
        <h2 class="title">Make your own todo list! <span>New</span></h2>
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
		

        <?php 
        foreach ($todo as $value):?>
            <div class="w3-card-4" style="display:inline-block; position:relative; height:100%">
            <header class="w3-container w3-light-grey">
                <h3><?php echo $value['name'];?>
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
            <?php 
            
            foreach($task as $values):?>
            <div class="task" id="taskId<?php echo $values["id"]; ?>" data-todoID="<?php echo $value['id'];?>" data-taskName="<?php echo $values['name'];?>" data-time="<?php echo $values['time'];?>" data-status="<?php echo $values['status']?>>
                <h3><?php echo $values['name'];?></h3>
                <p><?php echo $value['description'];?></p>
            </div>
            <?php endforeach;?>
        
        
        </div>
        </div>

        <?php endforeach;?>
        </div>
    </div>
</body>

</html>