<?php
  $errors = "";
  // db
  $db = mysqli_connect('localhost', 'root', '', 'todos');

  if(isset($_POST['submit'])) {
    $task = $_POST['task'];
      if (empty($task)) {
        $errors = "Add to task";
      } else {
        
      mysqli_query($db, "INSERT INTO tasks (task) VALUES ('$task')");
      header('location: index.php');
      }

  }
//delete
  if (isset($_GET['del_task'])){
    $id = $_GET['del_task'];
    mysqli_query($db, "DELETE FROM tasks WHERE id=$id");
    header('location: index.php');
  }


  $tasks = mysqli_query($db, "SELECT * FROM tasks");

?>

<!DOCTYPE HTML>
<html lang="en">
<head>
  <title>Todo List</title>
</head>

<body class="container">
  <h1>Todo List</h1>
  <form method="post" action="index.php">
  <?php if (isset($errors)) { ?>
    <p><?php echo $errors; ?> </p>
  <?php } ?>
    <input type="text" name="task"  class="task_input">
    <button type="submit" class="task_add" name="submit">Add Task</button>
  </form>
  
  <table>
    <thead>
      <tr>
      <th>N</th>
      <th>Task</th>
      <th>Action</th>
      
      
      </tr>
    
    </thead>
  
  <tbody>

  <?php 

  while($row = mysqli_fetch_array($tasks)) { 
    
    ?>
    <tr>
      <td><?php echo $row['id']; ?></td>
        <td class="task"><?php echo $row['task']; ?></td>
        <td class="delete">
  
        <a href="index.php?del_task=<?php $row['id'];?>">Delete</a>
      </td>
     </tr>
  <?php } ?>
  
    </tbody>
  </table>
 
    
</body>
</html> 