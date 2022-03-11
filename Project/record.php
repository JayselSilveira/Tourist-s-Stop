<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "dbms_project";

$conn = mysqli_connect($servername, $username, $password, $dbname);   

if(!$conn){
    die("Connection to this database failed due to" . mysqli_connect_error());
}

$sql = "SELECT * FROM posts;";
$result = $conn->query($sql);

$conn->close();
?>

<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "dbms_project";

$conn = mysqli_connect($servername, $username, $password, $dbname);   

if(!$conn){
    die("Connection to this database failed due to" . mysqli_connect_error());
}

session_start();
$saved_by = $_SESSION['email_id'];
$post_id = $_GET['id'];

if(isset($_POST['wishlist'])){
    $sql1 = "INSERT INTO wishlist(saved_by, post_id) VALUES('$saved_by', '$post_id');";
    
    if($conn->query($sql1) == true){
        //header("location: food.php");
    } else {
        echo "ERROR: $sql1 <br> $conn->error";
    }
}

$conn->close();
?>

<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "dbms_project";

$conn = mysqli_connect($servername, $username, $password, $dbname);   

if(!$conn){
    die("Connection to this database failed due to" . mysqli_connect_error());
}

$sql2 = "SELECT * FROM wishlist;";
$result2 = $conn->query($sql2);

$conn->close();
?>


<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="record.css">
    <title>Record</title>
</head>

<body background="./Images/Visit7.jpg">
        
    <?php  
        $flag = 0;
        $temp2 = $_GET['id'];
        $saved = $_SESSION['email_id'];
        while($rows2 = mysqli_fetch_array($result2)){
            if($rows2['post_id'] == $temp2 && $rows2['saved_by'] == $saved){
    ?>
    <form action="record.php?id=<?php echo $rows2['post_id']?>" method="post">
        <input type="submit" name="wishlist" value="Wishlisted" style="font-size: 20px; font-weight: 600; color: #fabe28; background: #000; padding: 2px 20px;
    margin-top: 20px; margin-left: 1300px" disabled>
    </form>
    <?php
                $flag = 1;
                break;         
            }
        }
        if($flag == 0){
    ?>
    <form action="record.php?id=<?php echo $temp2?>" method="post">
        <input type="submit" name="wishlist" value="Add to Wishlist" style="font-size: 20px; font-weight: 600; color: #000; background: #fabe28; padding: 2px 20px;
    margin-top: 20px; margin-left: 1300px">
    </form>
    <?php 
        }
    ?>

    <?php  
        $temp = $_GET['id'];
        while($rows = mysqli_fetch_array($result)){
            if($rows['post_id'] == $temp){
    ?>

    <section class="item" id="item">
        <div class="content">
            <div class="card" style="height: 100%">
                <div class="title">
                    <h2 class="title-text">
                        <?php 
                            echo $rows['place_name'];
                        ?>
                    </h2>
                </div>

                <div class="imgBx">
                    <img src="uploadedImages/<?php echo $rows['image'];?>" width="700" height="330">
                </div>

                <div class="text">
                    <h3>Location: <?php echo $rows['location'];?></h3><br><hr>
                    <h3>Description: <?php echo $rows['description'];?></h3><br><hr>
                    <h3>Post By: <?php echo $rows['owner_name'];?></h3> 
                </div>
            </div>
    </section>
    <?php
       }
    }
    ?>

</body>

</html>