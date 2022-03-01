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

  $sql = "SELECT * FROM wishlist;";
  $result = $con->query($sql);

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
      <link rel="stylesheet" href="wishlist.css">
      <title>Wishlist</title>
   </head>
   <body>
      <header>
         <a href="#" class="logo">Tourist's Stop<span>.</span></a>
         <ul class="navigation">
           <li><a href="http://localhost/Project/start.php">Homepage</a></li>
         </ul>
      </header>
      <section class="wishlist">
        <div class="title" style="background-image:url(Images/wishlist.jpg)">
          <h2 class="title-text"><span>W</span>ishlist</h2>
          <h3>Places which You Wish to Explore</h3>
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
          <?php
            while($rows = mysqli_fetch_array($result)){
              if($rows['saved_by']==$_SESSION["email_id"]){
                $postId = $rows['post_id'];

                $server = "localhost";
                $username = "root";
                $password = "";
                $dbname = "dbms_project";

                $con = mysqli_connect($server, $username, $password, $dbname);

                if(!$con){
                    die("Connection to this database failed due to" . mysqli_connect_error());
                }
                
                $sql1 = "SELECT * FROM posts WHERE post_id = '$postId'";
                $result1 = $con->query($sql1);
                while($rows1 = mysqli_fetch_array($result1)){
                $con->close();
          ?>

          <tr style="color:white;">
                <!--FETCHING DATA FROM EACH 
                    ROW OF EVERY COLUMN-->
            <td style="border:3px solid #fabe28; text-align:center; font-size:20px;"><?php echo $rows1['owner_name'];?></td>
            <td style="border:3px solid #fabe28; text-align:center; font-size:20px;"><img src="uploadedImages/<?php echo $rows1['image'];?>" width="300" height="200"></td>
            <td style="border:3px solid #fabe28; text-align:center; font-size:20px;"><?php echo $rows1['place_name'];?></td>
            <td style="border:3px solid #fabe28; text-align:center; font-size:20px;"><?php echo $rows1['location'];?></td>
            <td style="border:3px solid #fabe28; text-align:center; font-size:20px;"><?php echo $rows1['description'];?></td>
            <td style="border:3px solid #fabe28; text-align:center; font-size:20px;">
            
            <form action="record.php?id=<?php echo $rows1['post_id']?>" method="post"><a href="record.php?id=<?php echo $rows['post_id']?>"><input type="submit" value="View Record" name="review" class="btn" id="<?php echo $rows['post_id'];?>" style="background-color:#f77c1e; font-weight:500; font-size: 1.2rem; 
            color: #fff; display: inline-block; padding: 2px 18px; margin-top: 10px; text-transform: uppercase; letter-spacing: 2px; text-decoration: none; width: 190px;"></a></form>

            <form action="review.php?id=<?php echo $rows1['post_id']?>" method="post"><a href="review.php?id=<?php echo $rows['post_id']?>"><input type="submit" value="Review" name="review" class="btn" id="<?php echo $rows['post_id'];?>" style="background-color:#1a8f3d; font-weight:500; font-size: 1.2rem; 
            color: #fff; display: inline-block; padding: 2px 18px; margin-top: 10px; text-transform: uppercase; letter-spacing: 2px; text-decoration: none; width: 190px;"></a></form>
            
            <?php
            if($_SESSION["full_name"] == $rows1['owner_name'] && $_SESSION["email_id"] == $rows1['owner_email']) { ?>
              <form action="editFood.php?id=<?php echo $rows['post_id']?>" method="post"><a href="editFood.php?id=<?php echo $rows1['post_id']?>"><input type="submit" value="Edit" name="edit" class="btn" id="<?php echo $rows['post_id'];?>" style="background-color:#33a396; font-weight:500; font-size: 1.2rem; 
              color: #fff; display: inline-block; padding: 2px 18px; margin-top: 10px; text-transform: uppercase; letter-spacing: 2px; text-decoration: none; width: 190px;"></a></form>

              <form action="food.php?id=<?php echo $rows1['post_id']?>" method="post"><a href="food.php?id=<?php echo $rows1['post_id']?>"><input type="submit" id="<?php echo $rows['post_id'];?>" value="Delete" name="delete" class="btn" style="background-color:#f51637; font-weight:500; font-size: 1.2rem; 
              color: #fff; display: inline-block; padding: 2px 18px; margin-top: 10px; text-transform: uppercase; letter-spacing: 2px; text-decoration: none; width: 190px;"></a></form></td></tr>
          
            <?php
                }
            }
              }
            }
          ?>
        </table>
      </section>
   </body>
</html>