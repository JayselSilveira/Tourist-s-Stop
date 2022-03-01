<?php
$insert = false;
if(isset($_POST['first_name'])){

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
    
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $experience = $_POST['experience'];

    $sql = "INSERT INTO contact_us(first_name, last_name, email, experience) VALUES('$first_name', '$last_name', '$email', '$experience');";
        
    // Execute the query
    if($con->query($sql) == true){
        // Flag for successful insertion
        $insert = true;
    }
    else{
        echo "ERROR: $sql <br> $con->error";
    }

    // Close the database connection
    $con->close();
}
?>

<?php
  session_start();
  if(!isset($_SESSION['full_name'])){
    header("location: login.php");
  }
?>

<?php
  session_start();
  if(isset($_POST['logout'])){
    session_unset();
    session_destroy();
    header("location: login.php");
  }
?>


<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="start.css">
    <title>Tourist's Stop</title>
  </head>

  <body>
    <header>
      <a href="#" class="logo">Tourist's Stop<span>.</span></a>
      <ul class="navigation">
        <li><a href="#home">Home</a></li>
        <li><a href="#about">About</a></li>
        <li><a href="#explore">Explore</a></li>
        <li><a href="#testimonials">Testimonials</a></li>
        <li><a href="#contactUs">ContactUs</a></li>
        <li><a href="wishlist.php">Wishlist</a></li>
        <li><form method="post"><a><input type="submit" id="logout" name="logout" value="Logout" style="font-size: 20px; font-weight: 600; color: #fabe28; background: #000; padding: 2px 20px;
            margin-left: 10px;"></a></form></li>
      </ul>
    </header>

    <section class="home" id="home" style="background-image: url(Images/bg3.jpg); width:1518px">
      <div class="content">

      <h2 style="text-align: center; font-size: 25px; padding-bottom: 30px; color: #000">Welcome <?php echo $_SESSION['full_name'];?>!</h2>
        <?php /*if(isset($_SESSION['active'])) {
          $temp = $_GET['id'];
          if($temp != null) { ?>
            <h2 style="text-align: center; font-size: 25px; padding-bottom: 30px; color: #000">Welcome <?php echo $_GET['full_name']?>!</h2>
          <?php 
          } 
        } */?>

        <h2>Beautiful <span>Goa</span>.</h2><br>
        <p>
            Discover New Places With Us, Adventure Awaits.
        </p><br>
        <a href="#explore" class="btn">Places to Explore</a>
      </div>
    </section>

    <section class="about" id="about">
      <div class="row">
        <div class="col">
          <h2 class="title-text">About <span>Goa</span></h2>
          <p>
            <br>
            Goa – the name is enough is to fill you with excitement & thrill and bring smile on your face. 
            With surreal evenings, exotic nightlife, inspiring mornings and charming beaches, the place 
            hypnotizes every soul and makes people fall for it.
            <br>
            <br>
            A small state on India's western coast, Goa has always benefitted as a 
            trade centre because of its easily accessible ports. With a beautiful 
            harmonization of the East and West, Goans have taken the best of both worlds. 
            A civilization of warm, happy people, Goa sees a mix of different religions 
            like Christians, Catholics, Muslims, and Hindus that live together in harmony. 
            Following their age-old traditions and customs, Goan's celebrate all major 
            festivals with fervour without bringing any religious barriers within the society.
            <br>
            <br>
            With a strong influence from the west, Goa has always had a more contemporary mindset. 
            Their rich heritage culture has not been tarnished by the rapid industrialization 
            that has become commonplace in the rest of India yet. Celebrating livelihood and 
            religious festivals with scrumptious food and delightful music, the locals are humble, 
            warm and fun-loving individuals.
            <br>
            <br>
            Goa is popularly known as the Pearl of the orient and tourist paradise. It is located in India’s 
            coastal belt on the western called the Konkan coast. It has an alarming scenic beauty. 
            The architectural work done Goan Temples, Churches and old houses has brought great laurels to Goa. 
            Some of these characteristics make Goa to be occupied by tourists. It is the most preferred option
             by the people who are planning their holidays.
          </p>
          <br>
          <h2 class="title-text">About <span>Us</span></h2>
          <p>
            <br>
            “Travel is the main thing you purchase that makes you more extravagant”. We, at 
            ‘Tourist's Stop’, swear by this and put stock in satisfying travel dreams that make you perpetually rich constantly.
            <br>
            <br>
            We have been moving excellent encounters for a considerable length of time through our cutting-edge planned 
            occasion bundles and other fundamental travel administrations. We rouse our clients to carry on with a 
            rich life, brimming with extraordinary travel encounters.
            <br>
            <br>
            We need to take you on an adventure where you personally enjoy the stunning magnificence of Goa. 
            We need you to observe sensational scenes that are a long way past your creative ability.
          </p>
        </div>
        <div class="col">
          <div class="imgBx">
            <!--<img src="./Images/Map.jpg" alt="" />-->
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d492485.5349949828!2d73.73211008185541!3d15.347038033722026!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3bbfba106336b741%3A0xeaf887ff62f34092!2sGoa!5e0!3m2!1sen!2sin!4v1641022721695!5m2!1sen!2sin" width="700" height="1100" style="border:0; margin-left:30px" allowfullscreen="" loading="lazy"></iframe>   
          </div>
        </div>
      </div>
    </section>

    <section class="explore" id="explore">
      <div class="title">
        <h2 class="title-text">Categories to <span>Explore</span></h2>
        <h3>Places Which Impress You</h3>
      </div>
      <div class="content">
        
          <div class="card">
            <a href="http://localhost/Project/food.php" class="card-links">
            <div class="imgBx">
              <img src="./Images/Food.jpg" alt="">
            </div>
            <div class="text">
              <h3>Food</h3>
             </div></a>
          </div>       
         
        <div class="card">
          <a href="http://localhost/Project/sight-seeing.php" class="card-links"></a>
        </a>
          <div class="imgBx">
            <img src="./Images/Sight-seeing.jpg" alt="">
          </div>
          <div class="text">
            <h3>Sight-seeing</h3>
           </div>
        </div>

        <div class="card">
          <a href="http://localhost/Project/adventures.php" class="card-links"></a>
        </a>
          <div class="imgBx">
            <img src="./Images/Adventures.jpg" alt="">
          </div>
          <div class="text">
            <h3>Adventures</h3>
           </div>
        </div>
      </div>
    </section>

    <section class="testimonials" id="testimonials">
      <div class="title">
        <h2 class="title-text"><span>T</span>estimonials</h2>
      </div>

      <div class="container">

      <div class="indicator">
        <span class="testiBtn active" id="btn1"></span>
        <span class="testiBtn" id="btn2" ></span>
        <span class="testiBtn" id="btn3"></span>
        <span class="testiBtn" id="btn4"></span>
      </div>

      <div class="testimonial">

        <div class="slide-row" id="slide">
          <div class="slide-col">
            <div class="user-text">
              <p>As always, Tourist's Stop has delivered a wonderful travel experience for us. Goa was 
                a great travel destination. The parts of the state we visited were beautiful, everything 
                we ate was delicious, and there were many fun things to see and do.</p>
                <h3>Heyoon Yang</h3>
              <p>Seoul, South Korea</p>
            </div>
            <div class="user-image">
              <img src="./Images/testi3.jpg">
            </div>
          </div>

          <div class="slide-col">
            <div class="user-text">
              <p>We are back from our wonderful trip and all thanks to Tourist's Stop. Planning was well done as 
                expected. The hotels and tours were very comfortable, especially with kids.</p>
              <h3>Alessandro Ferrari</h3>
              <p>Venice, Italy</p>
            </div>
            <div class="user-image">
             <img src="./Images/testi2.jpg">
            </div>
          </div>

          <div class="slide-col">
            <div class="user-text">
              <p>Thanks to the 'Tourist's Stop' website for a well organized trip. We had a wonderful time. Hard to believe it's 
                already done and past. Weather was awesome, the hotels were nice, thank you for everything!</p>
              <h3>Michelle Jones</h3>
              <p>Los Angeles, USA</p>
            </div>
            <div class="user-image">
              <img src="./Images/testi1.jpg">
            </div>
          </div>  

          <div class="slide-col">
            <div class="user-text">
              <p>Thanks to the 'Tourists's Stop' website. Amazing customer service and is greatly appreciated.</p>
                <h3>Lara Müller</h3>
              <p>Munich, Germany</p>
            </div>
            <div class="user-image">
              <img src="./Images/testi4.jpg">
            </div>
          </div>

          <div class="slide-col">
            <div class="user-text">
              <p>I would like to thank Tourist's Stop for organising wonderful tour for us in Goa. 
                Everything was very well organised. Thank you very much for everything!</p>
              <h3>George Brown</h3>
              <p>Oxford, United Kingdom</p>
            </div>
            <div class="user-image">
              <img src="./Images/testi5.jpg">
            </div>
          </div>

        </div>
      </div>

      </div>

      <script>
        var btn1= document.getElementById('btn1'); 
        var btn2= document.getElementById('btn2'); 
        var btn3= document.getElementById('btn3'); 
        var btn4= document.getElementById('btn4'); 
        var slide = document.getElementById('slide'); 

        btn1.onclick = function(){ 
          slide.style.transform = "translateX(0px)"; 
          btn1.classList.add("active"); 
          btn2.classList.remove("active"); 
          btn3.classList.remove("active"); 
          btn4.classList.remove("active"); 
        } 

        btn2.onclick = function(){ 
          slide.style.transform = "translateX(-800px)"; 
          btn1.classList.remove("active"); 
          btn2.classList.add("active"); 
          btn3.classList.remove("active"); 
          btn4.classList.remove("active") 
        } 

        btn3.onclick = function(){ 
          slide.style.transform = "translateX(-1600px)"; 
          btn1.classList.remove("active"); 
          btn2.classList.remove("active"); 
          btn3.classList.add("active"); 
          btn4.classList.remove("active") 
        } 

        btn4.onclick = function(){ 
          slide.style.transform = "translateX(-2400px)"; 
          btn1.classList.remove("active"); 
          btn2.classList.remove("active"); 
          btn3.classList.remove("active"); 
          btn4.classList.add("active") 
        } 
      </script>

    </section>

    <section class="contactUs" id="contactUs">
        <div class="title">
            <h2 class="title-text">Contact <span>Us</span></h2>
        </div>
        <div class="contactForm">
          <h3>Send Message</h3>
        <form action="start.php" method="post">
          <div class="inputBox">
            <input type="text" placeholder="First Name" name="first_name" required>
          </div>
  
          <div class="inputBox">
            <input type="text" placeholder="Last Name" name="last_name" required>
          </div>
  
          <div class="inputBox">
            <input type="text" placeholder="Email" name="email" required>
          </div>
  
          <div class="inputBox">
            <textarea type="text" placeholder="Share your experience" name="experience" required></textarea>
          </div>
  
          <div class="inputBox">
            <input type="submit" placeholder="Get in touch!" name="submit" value="SUBMIT">
          </div>
        </form>
        </div>
        
        <div class="emailUs">
          <p>Contact Us At: +91 9876543210</p>
          <p>Email Us At: touristsstop@gmail.com</p>
        </div>
    </section>

  <section class="footer">
    <div class="box-container">
      <div class="box">
          <h2 class="title-text"><span>A</span>bout Us</h2>
          <p>We are a main online travel & tourist guide in Goa giving a ‘best as far as a class can tell with the objective to be Goa's Travel Guide’.
          Through our site, <span style="color: #fabe28">www.touristsstop.com</span>, our versatile applications, and our other related stages, recreation, 
          can investigate and explore an extensive variety of administrations taking into account their movement needs.
          </p>
      </div>
      <div class="box">
          <h3>Branch Locations</h3>
          <a href="#">India</a>
          <a href="#">USA</a>
          <a href="#">Japan</a>
          <a href="#">France</a>
      </div>
      <div class="box">
          <h3>Quick Links</h3>
          <a href="#home">Home</a>
          <a href="#explore">Explore</a>
          <!--<a href="#packages">Packages</a>-->
          <a href="#testimonials">Testimonials</a>
          <a href="#contactUs">ContactUs</a>
      </div>
      <div class="box">
          <h3>Follow Us</h3>
          <a href="#">Facebook</a>
          <a href="#">Instagram</a>
          <a href="#">Twitter</a>
          <a href="#">LinkedIn</a>
      </div>
    </div>
    <h1 class="credit">@www.touristsstop.com</h1>
  </section>

  </body>
</html>
