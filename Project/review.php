<?php
$insert = false;

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

if(isset($_POST['submit1']))  
{   
    $temp = $_GET['id'];
    $rating = $_POST['rating']; 
    $tempRate = intval($rating); 
    $sql = "INSERT INTO rating(post_id, rate) VALUES('$temp', '$tempRate');";  
            //echo "Your Data Inserted";  
            //mysql_query($sql); 
             
    // Execute the query
    if($conn->query($sql) == true){
        // Flag for successful insertion
        $insert = true;
    }  
    else{
        echo "ERROR: $sql <br> $conn->error";
    }
}

if(isset($_POST['submit2']))  
{   
    $temp = $_GET['id'];
    $review = $_POST['review'];
    $sql = "INSERT INTO review(post_id, review) VALUES('$temp', '$review');";  
            //echo "Your Data Inserted";  
            //mysql_query($sql); 
             
    // Execute the query
    if($conn->query($sql) == true){
        // Flag for successful insertion
        $insert = true;
    }  
    else{
        echo "ERROR: $sql <br> $conn->error";
    }
}

/*if(isset($_POST['delete'])){
    $sql = "DELETE FROM posts WHERE post_id = 36;";  
    $result = mysqli_query($con, $sql);
    alert("DELETED");
}*/

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
    <link rel="stylesheet" href="review.css">
    <title>Review Page</title>
</head>

<body background="./Images/Travel2.jpg">

    <!-- PHP CODE TO FETCH DATA FROM ROWS-->
    <?php   // LOOP TILL END OF DATA 
            //while($rows=$result->fetch_assoc() && 
            $temp = $_GET['id'];
            while($rows = mysqli_fetch_array($result)){
               if($rows['post_id'] == $temp){
          ?>

    <section class="item" id="rating">
        
            <div class="card" style="height: 100%">
    <?php
    //$post_id=21;
    $temp = $_GET['id'];
    //$rate_db[] = null;
    //$sum_rates[] = null;
        $sql = "SELECT * FROM rating WHERE post_id = '$temp' "; 
        $result = mysqli_query($conn, $sql);    
            while($data = mysqli_fetch_assoc($result)){
                $rate_db[] = $data;
                $sum_rates[] = $data['rate'];
            }
            if(count($rate_db)){
                $rate_times = count($rate_db);
                $sum_rates = array_sum($sum_rates);
                $rate_value = $sum_rates/$rate_times;
                $rate_bg = (($rate_value)/5)*100;
            }else{
                $rate_times = 0;
                $rate_value = 0;
                $rate_bg = 0;
            }
    ?>

    <h2 style="text-align:center; color:white">Average Rating</h2>
    <div style="margin-top:10px; text-align:center">
        <div class="result-container">
            <div class="rate-bg" style="width:<?php echo $rate_bg; ?>%"></div>
            <div class="rate-stars"></div>
        </div>
    </div>                    
    <h3 class="reviewScore" style="text-align:center"><?php echo substr($rate_value,0,3); ?></span><span class="reviewCount">(<?php echo $rate_times; ?> reviews)</h3>

    <br><br><hr><br>
    <h2 style="text-align:center; color:white">Give a Rating</h2>
    <form action="review.php?id=<?php echo $rows['post_id']?>" method="post" style="text-align:center">
        <input type="radio" id="one" name="rating" value="1" required>
        <label for="one" style="color:#000; font-weight:400; font-size:30px; background-color:#fabe28">1</label>
        <input type="radio" id="two" name="rating" value="2" required>
        <label for="two" style="color:#000; font-weight:400; font-size:30px; background-color:#fabe28">2</label>
        <input type="radio" id="three" name="rating" value="3" required>
        <label for="three" style="color:#000; font-weight:400; font-size:30px; background-color:#fabe28">3</label>
        <input type="radio" id="four" name="rating" value="4" required>
        <label for="four" style="color:#000; font-weight:400; font-size:30px; background-color:#fabe28">4</label>
        <input type="radio" id="five" name="rating" value="5" required>
        <label for="five" style="color:#000; font-weight:400; font-size:30px; background-color:#fabe28">5</label><br>
        <input type="submit" name="submit1" value="SUBMIT" id="sub1">
    </form>
    

    <br><br><hr><br>
    <h2 style="text-align:center; color:white">Leave a Review</h2>
    <form action="review.php?id=<?php echo $rows['post_id']?>" method="post" style="text-align:center">
        <textarea rows=5 cols=45 name="review" required></textarea><br>
        <input type="submit" name="submit2" value="SUBMIT" id="sub2" style="margin-bottom: 10px">
    </form>
        </div>
</section> 

<?php
    }
}

$conn->close();
?>

</body>

</html>