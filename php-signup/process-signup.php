<?php

if (empty($_POST["name"])) {
    die("Name is required");
}

if ( ! filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
    die("Valid email is required");
}

if (strlen($_POST["password"]) < 8) {
    die("Password must be at least 8 characters");
}

if ( ! preg_match("/[a-z]/i", $_POST["password"])) {
    die("Password must contain at least one letter");
}

if ( ! preg_match("/[0-9]/", $_POST["password"])) {
    die("Password must contain at least one number");
}

if ($_POST["password"] !== $_POST["password_confirmation"]) {
    die("Passwords must match");
}

$password_hash = password_hash($_POST["password"], PASSWORD_DEFAULT);
$fileName ="";
    if(!empty($_FILES["photo"]["name"])){
        $fileName = basename($_FILES["photo"]["name"]);
        $targetFilePath = "asserts/".$fileName;
        // $fileType = pathinfo($targetFilePath , PATHINFO_EXTENSION);
        // $allowTypes = array('jpg','png','jpeg','gif');
        move_uploaded_file($_FILES["photo"]["tmp_name"], $targetFilePath);
    }

require __DIR__ . "/database.php";
$sql = "INSERT INTO user (`name`, `email`, `password_hash` , `description` , `photo` ,`instagram` , `linkedin` , `contact` , `facebook` ,`whatsapp`)
        VALUES (
            '".$_POST["name"]."',
                  '".$_POST['email']."',
                  '".$password_hash."',
                  '".$_POST["description"]."',
                  '".$fileName."',
                  '".$_POST["instagram"]."',
                  '".$_POST["linkedin"]."',
                  '".$_POST["contact"]."',
                  '".$_POST["facebook"]."',
                  '".$_POST["whatsapp"]."'
                  )";

        // var_dump($sql);
if (mysqli_query($mysqli, $sql)) {

    header("Location: signup-success.html");
    exit;
    
} else {
    
    if ($mysqli->errno === 1062) {
        die("email already taken");
    } else {
        die($mysqli->error . " " . $mysqli->errno);
    }
}








