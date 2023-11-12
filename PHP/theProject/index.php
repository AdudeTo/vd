<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>


<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);



//$firstname = $_POST["firstname"];
//$lastname = $_POST["lastname"];
//$filename = $_POST["filename"];


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $tmpFile = $_FILES['pic']['tmp_name'];
    $newFile = '/new_location/to/file/'.$_FILES['pic']['name'];
    $result = move_uploaded_file($tmpFile, $newFile);
    echo $_FILES['pic']['name'];
    if ($result) {
         echo ' was uploaded<br />';
    } else {
         echo ' failed to upload<br />';
    }
}
?>
<form action="" enctype="multipart/form-data" method="POST">
<input type="file" name="pic" />
<input type="submit" value="Upload" />
</form>
    
</body>
</html>