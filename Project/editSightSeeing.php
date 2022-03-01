<?php
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

  $sql = "SELECT * FROM posts;";
  $result = $con->query($sql);

  if(isset($_POST['update'])){

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

    $image = $_FILES['image']['name'];
    $tempname = $_FILES['image']['tmp_name'];    
    $folder = "uploadedImages/".$image;

    $temp1 = $_GET['id'];

    if(isset($_FILES['image'])){
        $sql1 = "UPDATE posts SET place_name = '$place_name', location = '$location', description = '$description', image = '$image' WHERE post_id = '$temp1';";
    } else {
        $sql1 = "UPDATE posts SET place_name = '$place_name', location = '$location', description = '$description' WHERE post_id = '$temp1';";
    }

    //mysqli_query($con, $sql1);
    //$result1 = $con->query($sql1);
    if($con->query($sql1) == true){
        header("location: sight-seeing.php");
     } else {
        echo "ERROR: $sql1 <br> $con->error";
     }
    //alert("Successfully updated!");

    // Now let's move the uploaded image into the folder: image
    if (move_uploaded_file($tempname, $folder))  {
        $msg = "Image uploaded successfully";
    }else{
        $msg = "Failed to upload image";
    }
  }

  // Close the database connection
  $con->close();
?>

<?php
  session_start();
  if(!isset($_SESSION['full_name'])){
    header("location: login.php");
  }
?>


<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="edit.css">
    <title>Edit Page</title>
</head>

<body background="./Images/Travel.jpg">

    <div class="card" style="height: 95%">
        <div>
            <h4><a href="http://localhost/Project/sight-seeing.php" style="color:#fabe28; margin-left:205px;">Places to Visit</a></h4><hr style="margin-bottom:10px;">
            <h2><u>Edit Page</u></h2>
        </div>
        <hr style="margin-bottom:10px;">
        <?php   // LOOP TILL END OF DATA 
            //while($rows=$result->fetch_assoc() &&
            $temp = $_GET['id'];
            while($rows = mysqli_fetch_array($result)){
               if($rows['post_id'] == $temp){
          ?>
        <div class="form"></div>
        <form action="editSightSeeing.php?id=<?php echo $rows['post_id']?>" method="post" class="edit" enctype="multipart/form-data">
            <div class="field">
                <p>Name: 
                    <input type="text" value="<?php echo $rows['place_name'];?>" name="place_name" required>
                </p>

            </div>
            <div class="field">
                <p>Location: 
                    <input type="text" value="<?php echo $rows['location'];?>" name="location" required>
                </p>
            </div>
            <div class="field">
                <p>Description: 
                    <textarea name="description" rows="3" cols="40" required><?php echo $rows['description'];?></textarea>
                </p>
            </div>
            <div class="field">
                <p>Image: 
                    <input type="file" name="image" id="image" required>
                    <h4>Current Image: <input type="image" src="uploadedImages/<?php echo $rows['image'];?>" alt="Uploaded Image" name="currentImage" width=150 height=80></h4>
                </p>
            </div>
            <div class="btn">
                <input type="submit" value="Save Changes" name="update">
            </div>
        </form>
    </div>
    <?php
}
}
?>
</body>

</html>