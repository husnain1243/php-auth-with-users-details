<?php

    require __DIR__ . "/database.php";
    
    $sql = "SELECT * FROM user";
            
    $result = mysqli_query($mysqli, $sql);
    
    // $user = mysqli_fetch_assoc($result);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>View Page</title>
</head>
<body>
    <style>
        #user-details{
            margin: 0 auto;
            max-width: 1200px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }
        
    </style>

        <div id="user-details" class="user-details">        
            <div style="display: flex; justify-content: space-between; align-items: center;"><h1>About Me</h1><p><a class="logout-button" href="logout.php">Log out</a></p></div>
            <?php
    // var_dump($user); die;
    while( $column = mysqli_fetch_assoc($result) ) {
?>
        <div class="users-list-container">
            <div class="users-list" style="display: flex; flex-direction: row; justify-content:space-between; gap:20px; align-items: center; margin-bottom: 30px;">
                <div style="width: 100px;height: 100px;overflow: hidden;border-radius: 50%;"><img src="asserts/<?= htmlspecialchars($column["photo"]) ?>" alt="photo" style="width: 100%; height: 100%"></div> 
                <h3><?= htmlspecialchars($column['name']) ?></h3> 
                 <h3><?= htmlspecialchars($column['email']) ?></h3> 
                 <a href="/php-signup/user-details.php?userid=<?php echo $column['id'] ?>">View Details</a>
            </div>
        </div>
<?php
    }
?>

        </div>

</body>
</html>