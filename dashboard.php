<?php
session_start();
if(!isset($_SESSION['id'])){
  header("location:login.php");
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
      <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
      <title>Dashboard | Alone</title>
    <!-- Material Icon CDN -->
      <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!-- Materialize CSS CDN -->
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/css/materialize.min.css">
    <!-- Your custom styles -->
      <link rel="stylesheet" href="css/style.css">
    <!-- Used as an example only to position the footer at the end of the page.
    You can delete these styles or move it to your custom css file -->
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

        <?php
    
      require_once("db-connection.php");
      $id=$_SESSION['id'];
      $sql = "SELECT sum(donation_amt) as donation_total FROM donations where `donor_id`=$id";
      $sql2 = "SELECT COUNT(e.event_id) AS total_event FROM `events` AS e, `donations` AS d WHERE d.donor_id = $id AND d.event_id = e.event_id AND start_date BETWEEN '2017-11-18' AND '2018-11-18'  ";
      $result = mysqli_query($conn,$sql);
      $result2= mysqli_query($conn,$sql2);
      $donation = mysqli_fetch_assoc($result);
      $event = mysqli_fetch_assoc($result2);
      $donation_amt=0;
      $event_total=0;
      $donation_amt = $donation['donation_total'];
      $event_total = $event['total_event'];
      if($donation['donation_total']){}
        else{$donation_amt=0;}
        if($event['total_event']){}
          else{$event_total=0;}
      
      
   
    ?>
  <body>
    <header>
      <nav class="black">
        <div class="nav-wrapper">
          <div class="container">
            <a href="/index.php" class="brand-logo pink-text">Alone</a>
            <a href="#" data-activates="mobile-menu" class="button-collapse"><i class="material-icons">menu</i></a>
            <ul class="right hide-on-med-and-down">
              <li><a href="/index.php">Home</a></li>
              <li><a href="/events.php">Events</a></li>
              <?php if( isset($_SESSION['username']) && !empty($_SESSION['username']) )
                {
              ?>
              <li><a href="/dashboard.php" class="active">Dashboard</a></li>
              <li><a href="logout.php">Logout</a></li>
                <?php }else{ ?>
                  <li><a href="login.php">Login</a></li>
                   <li><a href="register.php">Register</a></li>
                <?php } ?>
              
                <li><a href="contact.php">Contact us</a></li>
            </ul>
          </div>
        </div>
      </nav>
      <div class="sidenav">
            
            <a href="<?php if($id=='1'){echo "admin/admin_dashboard.php";}
            else echo "/dashboard.php"; ?>">Dashboard</a>
            <a href="/edit_user.php">Edit Profile</a>
            <a href="/donation_history.php">Past Donation</a>
      </div>
    </header>
      <main>
          <h5 class="center">Welcome <?php echo $_SESSION['name']; ?></h5>
      <section >
          <div class="container">
              <div class="row">
                <div class="col s6">
                  <div class="card">
                    <div class="card-content red white-text">
                      <p class="card-stats-title center">
                        <i class="material-icons">person_outline</i>Helped Events</p>
                      <h4 class="card-stats-number center"><?php echo $event_total; ?></h4>
                    </div>
                    <div class="card-action red darken-1 center">
                     <a href="/events.php" class="waves-effect waves-light btn red darken-1">View All Events</a>
                    </div>
                  </div>
                </div>
                <div class="col s6">
                  <div class="card">
                    <div class="card-content blue white-text">
                      <p class="card-stats-title center">
                        <i class="material-icons">person_outline</i> Total donations</p>
                      <h4 class="card-stats-number center"><?php echo $donation_amt; ?> ₹</h4>
                    </div>
                    <div class="card-action blue darken-1 center">
                     <a href="/donation_history.php" class="waves-effect waves-light btn blue darken-1">View All</a>
                    </div>
                  </div>
                </div>
                </div>
                <div class="row center">
                  <a href="/donation.php" class="waves-effect waves-light btn">Start Donating now</a>
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
  $(document).ready(function(){
    $('.tabs').tabs();
  });
    </script>
  </body>
</html>