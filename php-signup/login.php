<?php

$is_invalid = false;

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    
    $mysqli = require __DIR__ . "/database.php";
    
    $sql = sprintf("SELECT * FROM user
                    WHERE email = '%s'",
                   $mysqli->real_escape_string($_POST["email"]));
    
    $result = $mysqli->query($sql);
    
    $user = $result->fetch_assoc();
    
    if ($user) {
        
        if (password_verify($_POST["password"], $user["password_hash"])) {
            
            session_start();
            
            session_regenerate_id();
            
            $_SESSION["user_id"] = $user["id"];
            
            header("Location: index.php");
            exit;
        }
    }
    
    $is_invalid = true;
}

?>
<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css">
</head>
<body>
    <style>
        #form-section {
            max-width: 1360px;
            margin: 0 auto;
        }
        #form-section .form-control-container button{
            border: 1px solid #c5c5c5 !important;
            height: 45px;
            padding: 0px;
            min-width: 100px;
            background-color: gray;
            color: #fff;
        }
        #form-section .form-control-container .form-control-main
        {
            display: flex;
            margin: 10px 0px;
        }
        #form-section .form-control-container .form-control-main input{
            background-color: #c5c5c5;
            color: #000;
            border: 1px solid #c5c5c5;
            border-radius: 5px;
            padding: 5px 10px;
        }
        #form-section .form-control-container .form-control-main input:focus-visible{
            border: 1px solid #c5c5c5;
            outline: none;
        }
        #form-section .form-control-container .form-control-main label {
            font-size: 20px;
            font-weight: 600;
            min-width: 120px;
            display: block;
        }
    </style>
    
    <?php if ($is_invalid): ?>
        <em>Invalid login</em>
    <?php endif; ?>
    
    <div id="form-section" class="form-section">
        <div style="display: flex; justify-content: space-between;"><h1> Login </h1> <h3><a href="signup.html" style="color: #fff; background-color: #5c5c5c; padding: 10px 20px;">sign up</a></h3></div>
        <form method="post">
            <div class="form-control-container">
                <div class="form-control-main">
                    <label for="email">Email:</label>
                    <input type="email" name="email" id="email"
                        value="<?= htmlspecialchars($_POST["email"] ?? "") ?>">
                </div>
                <div class="form-control-main">
                    <label for="password">Password:</label>
                    <input type="password" name="password" id="password">
                </div>
                <button>Log in</button>
            </div> 
        </form>
    </div>
</body>
</html>








