<?php session_start();
?>
<!DOCTYPE html>
<html lang="en">
  <head>
      <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
      <title>Events | Alone</title>
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
    
    $sql1 = "SELECT * FROM `events` WHERE start_date >= '2018-11-18'";
    $sql2 = "SELECT * FROM `events` WHERE start_date BETWEEN '2017-11-18' AND '2018-11-18'";
    $sql3 = "SELECT * FROM `events` WHERE start_date <= '2017-11-18'";
    $result1 = mysqli_query($conn,$sql1);
    $result2 = mysqli_query($conn,$sql2);
    $result3 = mysqli_query($conn,$sql3);
    
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
              <li><a href="/events.php" class="active">Events</a></li>
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
    </header>
      <main>
      <section class="cus-pad">
      <div class="container">
      <h4 class="center ">Upcoming events</h4>
      <div class="row">
      <?php
      if ($result1->num_rows > 0) {
        while($events = $result1->fetch_assoc()) {
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
      </div>
      </section>
      <section class="cus-pad grey lighten-4">
        <div class="container">
        <h4 class="center ">Ongoing events</h4>
        <div class="row">
        <?php
      if ($result2->num_rows > 0) {
        while($events = $result2->fetch_assoc()) {
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
                  <div class="card-action">
                  <a href="/donation.php">Donate now</a>
                </div>
                </div>
              </div>
              <?php
        }
      }
     
      ?>
        </div>
        </div>
        </section>
        <section class="cus-pad">
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
    </script>
  </body>
</html>