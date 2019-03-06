<?php
session_start();
if(!isset($_SESSION['id'])){
  header("location:../login.php");
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
      <link rel="stylesheet" href="../css/style.css">
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
    
    require_once("../db-connection.php");
    $id=$_SESSION['id'];
    $sql = "SELECT sum(donation_amt) as donation_total FROM donations where 1";

    $sql2 = "SELECT count(event_id) as total_event FROM `events` WHERE 1";
    $sql3 = "SELECT count(org_id) as org_total FROM `organization` WHERE 1";
    $sql4 = "SELECT count(donor_id) as donor_total FROM `donors` WHERE 1";
    $result = mysqli_query($conn,$sql);
    $result2= mysqli_query($conn,$sql2);
    $result3= mysqli_query($conn,$sql3);
    $result4= mysqli_query($conn,$sql4);
    $donation = mysqli_fetch_assoc($result);
    $event = mysqli_fetch_assoc($result2);
    $org= mysqli_fetch_assoc($result3);
    $donor = mysqli_fetch_assoc($result4);
    $donation_amt=0;
    $event_total=0;
    $org_total=0;
    $donor_total = 0;
    $donation_amt = $donation['donation_total'];
    $event_total = $event['total_event'];
    $org_total= $org['org_total'];
    $donor_total = $donor['donor_total'];
    if($donation['donation_total']){}
      else{$donation_amt=0;}
      if($event['total_event']){}
        else{$org_total=0;}
        if($org['org_total']){}
          else{$org_total=0;}
          if($donor['donor_total']){}
            else{$donor_total=0;}
    
 
  ?>
  <body>
    <header>
      <nav class="black">
        <div class="nav-wrapper">
          <div class="container">
            <a href="../index.php" class="brand-logo pink-text">Alone</a>
            <a href="#" data-activates="mobile-menu" class="button-collapse"><i class="material-icons">menu</i></a>
            <ul class="right hide-on-med-and-down">
              <li><a href="../index.php">Home</a></li>
              <li><a href="../events.php">Events</a></li>
              <?php if( isset($_SESSION['username']) && !empty($_SESSION['username']) )
                {
              ?>
              <li><a href="#" class="active">Dashboard</a></li>
              <li><a href="../logout.php">Logout</a></li>
                <?php }else{ ?>
                  <li><a href="../login.php">Login</a></li>
                   <li><a href="../register.php">Register</a></li>
                <?php } ?>
              <li><a href="../contact.php">Contact us</a></li>

            </ul>
          </div>
        </div>
      </nav>
      <div class="sidenav">
            
            <a href="<?php if($id=='1'){echo "#";}
            else echo "/dashboard.php"; ?>" >Dashboard</a>
            <a href="/edit_user.php">Edit Profile</a>
            <a href="<?php if($_SESSION['id']=='1'){echo "/all_donation.php";}
            else echo "/donation_history.php"; ?>">Past Donation</a>
            <a href="/event_list.php">Manage Events</a>
            <a href="/user_list.php">Manage Users</a>
            <a href="/org_list.php">Manage Organization</a>
            <a href="/list_contacted.php">User Contacted</a>

      </div>
    </header>
      <main>
      <section >
          <div class="container">
              <div class="row">
          <div class="col s3">
                  <div class="card">
                    <div class="card-content cyan white-text">
                      <p class="card-stats-title center">
                        <i class="material-icons">person_outline</i> Total Donors</p>
                      <h4 class="card-stats-number center"><?php echo $donor_total; ?></h4>
                    </div>
                    <div class="card-action cyan darken-1 center">
                     <a href="/user_list.php" class="waves-effect waves-light btn cyan darken-1">View All</a>
                    </div>
                  </div>
                </div>
                <div class="col s3">
                  <div class="card">
                    <div class="card-content purple white-text">
                      <p class="card-stats-title center">
                        <i class="material-icons">person_outline</i> Total Organizations</p>
                      <h4 class="card-stats-number center"><?php echo $org_total; ?></h4>
                    </div>
                    <div class="card-action purple darken-1 center">
                     <a href="/org_list.php" class="waves-effect waves-light btn purple darken-1">View All</a>
                    </div>
                  </div>
                </div>
                <div class="col s3">
                  <div class="card">
                    <div class="card-content red white-text">
                      <p class="card-stats-title center">
                        <i class="material-icons">person_outline</i> Total Events</p>
                      <h4 class="card-stats-number center"><?php echo $event_total; ?></h4>
                    </div>
                    <div class="card-action red darken-1 center">
                     <a href="/event_list.php" class="waves-effect waves-light btn red darken-1">View All</a>
                    </div>
                  </div>
                </div>
                <div class="col s3">
                  <div class="card">
                    <div class="card-content blue white-text">
                      <p class="card-stats-title center">
                        <i class="material-icons">person_outline</i> Total donations</p>
                      <h4 class="card-stats-number center"><?php echo $donation_amt; ?> ₹</h4>
                    </div>
                    <div class="card-action blue darken-1 center">
                     <a href="<?php if($_SESSION['id']=='1'){echo "/all_donation.php";}
            else echo "/donation_history.php"; ?>" class="waves-effect waves-light btn blue darken-1">View All</a>
                    </div>
                  </div>
                </div>
                </div>
          </div>
      </section>
    </main>
    <?php require('../footer.php'); ?>
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