<?php
$insert = false;
$msg = "";

// Set connection variables
$server = "localhost";
$username = "root";
$password = "";
$dbname = "dbms_project";

// Create a database connection
$con = mysqli_connect($server, $username, $password, $dbname);

// Check for connection success
if(!$con){
    die("Connection to this database failed due to" . mysqli_connect_error());
}

session_start();
if(isset($_POST['submit'])){
    
   /* function test_input($data){
        $data = trim($data);
        $data = stripcslashes($data);
        $data = mysqli_real_escape_string($con, $data);
        return $data;
    } */

    //$owner_name = $_POST['owner_name'];
    $owner_name = $_SESSION['full_name'];
    $owner_email = $_SESSION['email_id'];

    $place_name = $_POST['place_name'];
    $place_name = trim($place_name);
    $place_name = stripcslashes($place_name);
    $place_name = htmlspecialchars($place_name);

    $location = $_POST['location'];
    $location = trim($location);
    $location = stripcslashes($location);
    $location = htmlspecialchars($location);

    $description = $_POST['description'];
    $description = trim($description);
    $description = stripcslashes($description);
    $description = htmlspecialchars($description);
    
    $image = $_FILES["image"]["name"];
    $tempname = $_FILES["image"]["tmp_name"];    
    $folder = "uploadedImages/".$image;

    //$sql = "INSERT INTO posts(owner_name, owner_email, category, place_name, location, description) VALUES('abc', 'abc', 'SightSeeing', 'abc', 'abc', 'abc');";
    $sql = "INSERT INTO posts(owner_name, owner_email, category, place_name, location, description, image) VALUES('$owner_name', '$owner_email', 'SightSeeing', '$place_name', '$location', '$description', '$image');";

    // Execute query
    //$result = mysqli_query($con, $sql);
    if($con->query($sql) == true){
        // Flag for successful insertion
        $insert = true;
        header("location: sight-seeing.php");
     } else {
        echo "ERROR: $sql <br> $con->error";
     }
          
    // Now let's move the uploaded image into the folder: image
    if (move_uploaded_file($tempname, $folder))  {
        $msg = "Image uploaded successfully";
    }else{
        $msg = "Failed to upload image";
    }

    $result = mysqli_query($db, "SELECT * FROM image");
    // Close the database connection
    mysqli_close($con);    
}
?>

<?php
  if(!isset($_SESSION['full_name'])){
    header("location: login.php");
  }
?>


<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="add.css">
    <title>Add a Place to Visit</title>
</head>

<body background="./Images/Visit.jpg">
    <div class="card">
        <div>
            <h2>Add a Place to Visit</h2>
        </div>
        <hr>
        <div class="form"></div>
        <form action="addSightSeeing.php" method="post" class="addPlace" enctype="multipart/form-data">
            <!--<div class="field">
                <p>Your Name: 
                    <input type="text" placeholder="Add Your Name" name="owner_name" required>
                </p>
            </div>  -->
            <div class="field">
                <p>Place Name: 
                    <input type="text" placeholder="Add Place Name" name="place_name" required>
                </p>

            </div>
            <div class="field">
                <p>Location: 
                    <input type="text" placeholder="Add Location" name="location" required>
                </p>
            </div>
            <div class="field">
                <p>Description: 
                    <textarea placeholder="Add Description" name="description" rows="3" cols="40" required></textarea>
                </p>
            </div>
            <div class="field">
                <p>Image: 
                    <input type="file" name="image" id="image" required>
                </p>
            </div>
            <div class="btn">
                <input type="submit" value="Add Place" name="submit">
            </div>
        </form>
    </div>
</body>

</html>