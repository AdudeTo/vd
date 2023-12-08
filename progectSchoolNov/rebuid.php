<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);



//$firstname = $_POST["firstname"];
//$lastname = $_POST["lastname"];
//$filename = $_POST["filename"];


if ($_SERVER['REQUEST_METHOD'] == 'POST') {


    $servername = "localhost";
    $username = "root";
    $password = "root";
    $dbname = "vd";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
       // die("Connection failed: " . $conn->connect_error);
    }
   // echo "Connected successfully";


    $tmpFile = $_FILES['pic']['tmp_name'];
    $newFile = 'uploads/' . $_FILES['pic']['name'];
    $result = move_uploaded_file($tmpFile, $newFile);
    $fileName = $_FILES['pic']['name'];
    //echo $_FILES['pic']['name'];
    if ($result) {
       // echo ' was uploaded<br />';
        $userName = $_POST['userName'];

        $sql = "INSERT INTO images (imgPath, userName) VALUES ('$newFile', '$userName')";


        if ($conn->query($sql) === TRUE) {
           // echo "New record created successfully";
        } else {
           // echo "Error: " . $sql . "<br>" . $conn->error;
        }
        $conn->close();
    } else {
        //echo ' failed to upload<br />';
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Project Images Uploader</title>
    <link rel="stylesheet" href="main.css">
</head>

<body>
    <div id="overlayContainer" class="overlay-container">
        <div class="overlay">
            <div class="formContainer">
                <div class="formHolder">
                    <form action="" enctype="multipart/form-data" method="POST">
                        <label for="userName">User Name</label><br>
                        <input type="text" id="userName" name="userName" /></br>

                        <label for="imageField">choose your picture</label><br>
                        <input type="file" id="imageField" name="pic" /></br></br>

                        <input type="submit" value="Upload" />
                    </form>
                </div>
            </div>
            <div id="overlayCloseButton" class="closeButton">X</div>
        </div>
    </div>
    </div>
    <header>
        <h1>Images Uploader</h1>
    </header>

    <nav>
        <ul>
            <!--li><a href="#home">Home</a></li>
            <li><a href="#categories">Categories</a></li>
            <li><a href="#browse">Browse</a></li>
            <li><a href="#options">Options</a></li-->
        </ul>
        <div class="uploads">
            <button id="uploadImage"> </button>
        </div>
    </nav>

    <main>
        <section>
            <h2>Recently added images</h2>

            <ul>

                <?php

                $servername = "localhost";
                $username = "root";
                $password = "root";
                $dbname = "vd";

                // Create connection
                $conn = new mysqli($servername, $username, $password, $dbname);

                // Check connection
                if ($conn->connect_error) {
                   // die("Connection failed: " . $conn->connect_error);
                }
                //echo "Connected successfully";

                $sql = "SELECT * FROM images ORDER BY id DESC";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    // output data of each row
                    while ($row = $result->fetch_assoc()) {
                        // echo "id: " . $row["id"] . " - Name: " . $row["userName"] . " " . $row["imgPath"] . "<br>";
                ?>

                        <li>
                            <article>
                                <h3><?php echo  $row["userName"] ?></h3>
                                <figure>
                                    <img id="img_id_<?php echo $row["id"]; ?>" src="<?php echo $row["imgPath"]; ?>">
                                    <!--figcaption>testtet</figcaption-->
                                </figure>
                            </article>
                        </li>





                <?php



                    }
                } else {
                  //  echo "0 results";
                }




                ?>







            </ul>
        </section>
    </main>



    <script>
        const uploadForm = document.getElementById("uploadImage");
        const overlayContainer = document.getElementById("overlayContainer");
        const overlayCloseButton = document.getElementById("overlayCloseButton");

        let overlayStatus = 0;

        function showHideOverlay() {
            overlayContainer.style.display = "block";
            overlayStatus ? overlayContainer.style.display = "block" : overlayContainer.style.display = "none";
        }

        uploadForm.onclick = function() {
            overlayStatus = 1;
            showHideOverlay();
        }

        overlayCloseButton.onclick = function() {
            overlayStatus = 0;
            showHideOverlay();
        }
    </script>
</body>

</html>