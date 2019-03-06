<?php session_start();
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
      <title>Donations | Alone</title>
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
    $sql = "SELECT `event_id` , `event_name` FROM `events` WHERE start_date BETWEEN '2017-11-18' AND '2018-11-18'";

    $result = mysqli_query($conn,$sql);

    ?>
    <?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
//       foreach ($_POST as $key => $value)
// {
//   echo $key.$value;
// }
// die();
      $event_id=$_POST['event_id'];
      $date = date('Y-m-d');
      $donor_id=$_SESSION['id'];
      $donation_amt=$_POST['donation_amt'];
      $sql = "INSERT INTO `donations`(`event_id`, `date`, `donor_id`, `donation_amt`)
       VALUES
        ('$event_id','$date',$donor_id,$donation_amt)";
    
      if (mysqli_query($conn,$sql)) {
        header("location:../dashboard.php");
       
        
      } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
      }
    }
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
      <section>
      <div class="container">
      <div class="card">
      <div class="card-content pink-text">
      <span class="card-title"><h4 class="center">Help Us By Donation</h4></span>
        </div>
        <div class="card-action">
        <form class="col s12" action="<?php echo $_SERVER["PHP_SELF"];?>" method="POST">
          <div class="row">
            <div class="col s3"></div>
            <div class="input-field col s6">
              <input name="donation_amt" type="number" class="validate">
              <label for="donation_amt">Donation Amount</label>
            </div>
            <div class="col s3"></div>
            </div>
            <div class="row">
                      <div class="col s3"></div>
                      <div class="col s6">
                    <select class="browser-default" input type ="number" name="event_id">
                        <option value="" disabled selected>Choose Event</option>
                        <?php
                          if ($result->num_rows > 0) {
                            while($events = $result->fetch_assoc()) {
                              $event=$events['event_id'];
                              
                            
                        ?>
                        
                        <option  value=<?php echo $event;?> ><?php echo $events['event_name'];?></option>
                        
                        <?php
                            }
                          }
                        ?>
                      </select>
                    </div>
                    <div class="col s3"></div>
                    </div>
                    <div class="row center cus-pad">
                      <button class="btn waves-effect waves-light" type="submit" name="action">Donate</button>
                    </div>
                    </form>
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
    </script>
  </body>
</html>