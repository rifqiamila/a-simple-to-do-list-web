<?php
    $errors = "";

    $db = mysqli_connect('localhost', 'root', '', 'todo');

    if (isset($_POST['submit'])) {
        $task = $_POST['task'];
        if (empty($task)) {
            $errors = "Task cannot be blank";
        }
        else {
            mysqli_query($db, "INSERT INTO tasks (task) VALUES ('$task')");
            header('location: index.php');
        }
    }

    if(isset($_GET['del_task'])) {
        $id = $_GET['del_task'];
        mysqli_query($db, "DELETE FROM tasks WHERE id = $id");
        header('location: index.php');
    }

    if (isset($_POST['edit_task'])) {
        $id = $_POST['task_id'];
        $task = $_POST['task'];
        mysqli_query($db, "UPDATE tasks SET task='$task' WHERE id=$id");
        header('location: index.php');
    }

    $tasks = mysqli_query($db, "SELECT * FROM tasks");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>To-Do List</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <div class="heading">
        <h2>To-Do List</h2>
    </div>

    <form method="POST" action="index.php" id="taskForm">
        <?php if(isset($errors)) { ?>
            <p><?php echo $errors; ?></p>
        <?php } ?>
        <input type="text" name="task" id="taskInput" class="task_input" placeholder="Add a new task...">
        <button type="submit" class="add_btn" name="submit">Add Task</button>
    </form>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Task</th>
                <th>Action</th>
            </tr>
        </thead>

        <tbody>
        <?php $i = 1; while ($row = mysqli_fetch_array($tasks)) { ?>
            <tr>
                <td><?php echo $i; ?></td>
                <td class="task"><?php echo $row['task']; ?></td>
                <td class="actions">
                    <a href="index.php?del_task=<?php echo $row['id']; ?>" class="delete">✖</a>
                    <span class="edit" data-id="<?php echo $row['id']; ?>" data-task="<?php echo $row['task']; ?>">✎</span>
                </td>
            </tr>
        <?php $i++; } ?>
        </tbody>
    </table>

    <!-- Modal for editing task -->
    <div id="editModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <form method="POST" action="index.php">
                <input type="hidden" name="task_id" id="task_id">
                <input type="text" name="task" id="edit_task_input" class="task_input">
                <button type="submit" name="edit_task" class="add_btn">Save</button>
            </form>
        </div>
    </div>

    <script src="script.js"></script>
</body>
</html>
