<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
  <head>
      <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
      <title>Home | Alone</title>
    <!-- Material Icon CDN -->
      <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!-- Materialize CSS CDN -->
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/css/materialize.min.css">
    <!-- Your custom styles -->
      <link rel="stylesheet" href="css/style.css">
    <style>
      body {
        display: flex;
        min-height: 100vh;
        flex-direction: column;
        }
      main {
        flex: 1 0 auto;
      }
    </style>
  </head>
  <body>
    <header>
      <div  class="navbar-fixed">
      <nav class="black ">
        <div class="nav-wrapper">
          <div class="container">
            <a href="/index.php" class="brand-logo pink-text">Alone</a>
            <a href="#" class="button-collapse"><i class="material-icons">menu</i></a>
            <ul class="right hide-on-med-and-down" >
              <li><a href="/index.php" class="active">Home</a></li>
              <li><a href="/events.php">Events</a></li>
              <?php if( isset($_SESSION['username']) && !empty($_SESSION['username']) )
                {
              ?>
              <li><a href="<?php if($_SESSION['id']=='1'){echo "admin/admin_dashboard.php";}
            else echo "/dashboard.php"; ?>">Dashboard</a></li>
              <li><a href="logout.php">Logout</a></li>
                <?php }else{ ?>
                  <li><a href="login.php">Login</a></li>
                   <li><a href="register.php">Register</a></li>
                <?php } ?>
                
              <li><a href="/contact.php">Contact us</a></li>
              
            </ul>
            
          </div>
        </div>
      </nav>
    </div>
    </header>
    <?php
  require_once("db-connection.php");
    
    $sql3 = "SELECT * FROM `events` WHERE start_date <= '2017-11-18'";
    $result3 = mysqli_query($conn,$sql3);
    
    ?>
  
      <main>
     
        <section>
          <div class="carousel carousel-slider">
            <ul class="slides">
              <li class="carousel-item">
                  <div class="caption motto">
                      <h3>This is our big Tagline!</h3>
                      <h5 class="light grey-text text-lighten-3">Here's our small slogan.</h5>
                    </div>
                <img src="img/carousel2.jpg" alt=""> <!-- random image --></li>
              <li class="carousel-item">
                  <div class="caption topleft">
                      <h3>Left Aligned Caption</h3>
                      <h5 class="light grey-text text-lighten-3">Here's our small slogan.</h5>
                    </div>
                <img src="img/carousel1.jpg" alt=""> <!-- random image -->

              </li>
              <li class="carousel-item">
                  <div class="caption topright">
                      <h3>Right Aligned Caption</h3>
                      <h5 class="light grey-text text-lighten-3">Here's our small slogan.</h5>
                    </div>
                <img src="img/carousel3.jpg" alt=""> <!-- random image -->

              </li>
            </ul>
          </div>
        </section>
        <?php
    
     
      $sql = "SELECT sum(donation_amt) as donation_total FROM donations";
      $result = mysqli_query($conn,$sql);
      $donation = mysqli_fetch_assoc($result);
      $donation_amt=0;
      $donation_amt = $donation['donation_total'];
      if($donation['donation_total']){}
        else{$donation_amt=0;}
      
      
   
    ?>
        <section class="card-up">
          <div class="container ">
            <div class="row card">
              <div class="col s6 ">
                    <span class="card-title "><h4 class="center blue-text">Become Volunteer</h4></span>
                    <div class="card-content">
                    <p class="center custom-pad">Would you like to contribute to the development of your own country
                     and work with others like yourself who have a desire to accelerate your 
                     nation’s development and promote peace? Apply now!
                    </p>
                    <div class="card-action ">
                    <div class="row center ">
                        <a href="register.php" class="waves-effect waves-teal btn blue">Apply Now</a>
                        </div>
                      </div>
              </div>
              </div>
              <div class="col s6 black white-text">
                  <span class="card-title"><h4 class="center pink-text">We’ve Reached So Far!</h4></span>
                  <div class="card-content">
                  <p>I am a very simple card. I am good at containing small bits of information.
                  I am convenient because I require little markup to use effectively.
                  </p>
                  
                  <h5 class="center teal-text">Total Amount Raised: <?php echo $donation_amt; ?> ₹</h5 >
                  </div>
                  <div class="card-action">
                  <div class="row center cus-pad">
                      <a href="/donation.php" class="waves-effect waves-teal btn pink">Donate Now</a>
                      </div>
            </div>
            </div>
              
            </div>
          </div>
        </section>
        <section class="cus-pad grey lighten-4">
          <div class="container">
          <h4 class="center ">Recent events</h4>
          <div class="row">
          <?php
      if ($result3->num_rows > 0) {
        while($events = $result3->fetch_assoc()) {
        ?>
              <div class="col s3">
                <div class="card">
                  <div class="card-image">
                    <img src='<?php echo $events['img_links'];?>'>
                  </div>
                  <div class="card-content">
                  <span class="card-title"><h5 class='center'><?php echo $events['event_name'];?></h5></span>
                    <p class="center"><?php echo $events['description'];?></p>
                  </div>
                </div>
              </div>
              <?php
        }
      }
      ?>
          </div>
          <div class="row center">
          <a href="/events.php" class="waves-effect waves-light btn white black-text">View All</a>
          </div>
          </div>
          </section>
        <section class="cus-pad">
          <div class="container">
            <h4 class="center">Why Choose us ?</h4>
            <div class="row">
              <div class="col s3">
                <div class="card grey lighten-3">
                  <div class="card-content black-text">
                    <span class="card-title"><h5 class="center">Simple</h5></span>
                    <p class="center">I am a very simple card. I am good at containing small bits of information.
                    I am convenient because I require little markup to use effectively.</p>
                  </div>
                </div>
              </div>
              <div class="col s3">
                <div class="card grey lighten-3">
                  <div class="card-content black-text">
                    <span class="card-title"><h5 class="center">Secure</h5></span>
                    <p class="center">I am a very simple card. I am good at containing small bits of information.
                    I am convenient because I require little markup to use effectively.</p>
                  </div>
                </div>
              </div>
              <div class="col s3">
                <div class="card grey lighten-3">
                  <div class="card-content black-text">
                    <span class="card-title"><h5 class="center">Instant</h5></span>
                    <p class="center">I am a very simple card. I am good at containing small bits of information.
                    I am convenient because I require little markup to use effectively.</p>
                  </div>
                </div>
              </div>
              <div class="col s3">
                <div class="card grey lighten-3">
                  <div class="card-content black-text">
                    <span class="card-title"><h5 class="center">Reward</h5></span>
                    <p class="center">I am a very simple card. I am good at containing small bits of information.
                    I am convenient because I require little markup to use effectively.</p>
                  </div>
                </div>
              </div>
              
            </div>
                      
          </div>
        </section>
    </main>
    <?php require('footer.php'); ?>
    <!-- jQuery CDN -->
      <script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>
    <!-- Materialize JS CDN -->
      <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/js/materialize.min.js"></script>
    <script>
     $("document").ready(function(){
        $(".button-collapse").sideNav();
      });
      $(document).ready(function(){
    $('.carousel').carousel();
  });
  $('.carousel.carousel-slider').carousel({
    fullWidth: true
  });
  $('.carousel').carousel({
    padding: 200    
});
autoplay();
function autoplay() {
    $('.carousel').carousel('next');
    setTimeout(autoplay, 5000);
}
    </script>
  </body>
</html>