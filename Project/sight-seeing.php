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

  $temp = $_GET['id'];

  if(isset($_POST['delete'])){
    $sql2 = "DELETE FROM rating WHERE post_id = '$temp';";  
    $sql3 = "DELETE FROM review WHERE post_id = '$temp';";
    $sql1 = "DELETE FROM posts WHERE post_id = '$temp';";
    //$result1 = mysqli_query($con, $sql1);
    if(($con->query($sql2) == true) && ($con->query($sql3) == true) && ($con->query($sql1) == true)) {
      header("location: sight-seeing.php");
    } else {
      echo "ERROR: $sql1 <br> $con->error";
    }
    echo 'alert("Successfully deleted!")'; 
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
      <link rel="stylesheet" href="sight-seeing.css">
      <title>Sight-seeing Category</title>
   </head>
   <body>
      <header>
         <a href="#" class="logo">Tourist's Stop<span>.</span></a>
         <ul class="navigation">
           <li><a href="http://localhost/Project/start.php">Homepage</a></li>
           <li><a href="http://localhost/Project/addSightSeeing.php">Add a Place to Visit +</a></li>
         </ul>
      </header>
      <section class="sight-seeing">
         <div class="title">
           <h2 class="title-text">The <span>SIGHT-SEEING</span> category</h2>
           <h3>Places Which Impress You</h3>
         </div>
        
        <table style="border:5px solid #fabe28; width:100%;">
          <tr style="color:white; font-size:35px">
            <th style="border:3px solid #fabe28;">Post By</th>
            <th style="border:3px solid #fabe28;">Image</th>
            <th style="border:3px solid #fabe28;">Place Name</th>
            <th style="border:3px solid #fabe28;">Location</th>
            <th style="border:3px solid #fabe28;">Description</th>
            <th style="border:3px solid #fabe28;">More</th>
          </tr>
          <!-- PHP CODE TO FETCH DATA FROM ROWS-->
          <?php   // LOOP TILL END OF DATA 
            while($rows=$result->fetch_assoc()){
              if($rows['category']=="SightSeeing"){
          ?>
          <tr style="color:white;">
                <!--FETCHING DATA FROM EACH 
                    ROW OF EVERY COLUMN-->
            <td style="border:3px solid #fabe28; text-align:center; font-size:20px;"><?php echo $rows['owner_name'];?></td>
            <td style="border:3px solid #fabe28; text-align:center; font-size:20px;"><img src="uploadedImages/<?php echo $rows['image'];?>" width="300" height="200"></td>
            <td style="border:3px solid #fabe28; text-align:center; font-size:20px;"><?php echo $rows['place_name'];?></td>
            <td style="border:3px solid #fabe28; text-align:center; font-size:20px;"><?php echo $rows['location'];?></td>
            <td style="border:3px solid #fabe28; text-align:center; font-size:20px;"><?php echo $rows['description'];?></td>
            <td style="border:3px solid #fabe28; text-align:center; font-size:20px;">
            
            <form action="record.php?id=<?php echo $rows['post_id']?>" method="post"><a href="record.php?id=<?php echo $rows['post_id']?>"><input type="submit" value="View Record" name="review" class="btn" id="<?php echo $rows['post_id'];?>" style="background-color:#f77c1e; font-weight:500; font-size: 1.2rem; 
            color: #fff; display: inline-block; padding: 2px 18px; margin-top: 10px; text-transform: uppercase; letter-spacing: 2px; text-decoration: none; width: 190px;"></a></form>

            <form action="review.php?id=<?php echo $rows['post_id']?>" method="post"><a href="review.php?id=<?php echo $rows['post_id']?>"><input type="submit" value="Review" name="review" class="btn" id="<?php echo $rows['post_id'];?>" style="background-color:#1a8f3d; font-weight:500; font-size: 1.2rem; 
            color: #fff; display: inline-block; padding: 2px 18px; margin-top: 10px; text-transform: uppercase; letter-spacing: 2px; text-decoration: none; width: 190px;"></a></form>
            
            <?php
            if($_SESSION["full_name"] == $rows['owner_name'] && $_SESSION["email_id"] == $rows['owner_email']) { ?>
              <form action="editSightSeeing.php?id=<?php echo $rows['post_id']?>" method="post"><a href="editSightSeeing.php?id=<?php echo $rows['post_id']?>"><input type="submit" value="Edit" name="edit" class="btn" id="<?php echo $rows['post_id'];?>" style="background-color:#33a396; font-weight:500; font-size: 1.2rem; 
              color: #fff; display: inline-block; padding: 2px 18px; margin-top: 10px; text-transform: uppercase; letter-spacing: 2px; text-decoration: none; width: 190px;"></a></form>

              <form action="sight-seeing.php?id=<?php echo $rows['post_id']?>" method="post"><a href="sight-seeing.php?id=<?php echo $rows['post_id']?>"><input type="submit" id="<?php echo $rows['post_id'];?>" value="Delete" name="delete" class="btn" style="background-color:#f51637; font-weight:500; font-size: 1.2rem; 
              color: #fff; display: inline-block; padding: 2px 18px; margin-top: 10px; text-transform: uppercase; letter-spacing: 2px; text-decoration: none; width: 190px;"></a></form></td></tr>
          
            <?php
                }
              }
            }
          ?>
        </table>

        <!--
        <div class="content">
          <div class="card">
            <a href="food.php" class="card-links">
            <div class="imgBx">
              <img src="./Images/Pizza.jpg" alt="">
            </div>
            <div class="text">
              <h3>Pizza</h3>
            </div></a>
          </div>
        </div>-->
      </section>
   </body>
</html>