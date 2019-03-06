<?php session_start();
?>
<!DOCTYPE html>
<html lang="en">
  <head>
      <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
      <title>Contact us | Alone</title>
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
              
              <li><a href="/contact.php" class="active">Contact us</a></li>
             
            </ul>
          </div>
        </div>
      </nav>
    </header>
      <main>
      <?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      $name=$_POST['name'];
      $email=$_POST['email'];
      $phone_no=$_POST['phone'];
      $description=$_POST['description'];
      require_once("db-connection.php");
    
      $sql = "INSERT INTO reach_us(name, email, phone_no, description)
       VALUES 
       ('$name','$email',$phone_no,'$description')";
    
      if (mysqli_query($conn,$sql)) {
        ?><h5 class="center green-text">Successfully Contacted</h5>
        <?php
        
      } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
      }
    }
    ?>
<section class="cus-pad">
  <div class="container">
    <h4 class="center orange-text">Reach us</h4>
    <div class="row">
        <div class="col s4">
    <div class="card  grey lighten-3">
      <div class="card-content black-text">
        <span class="card-title"><h5 class="center">Phone</h5></span>
        <p class="center">9265845310/0225136850</p>
      </div>
    </div>
  </div>
  <div class="col s4">
      <div class="card  grey lighten-3">
        <div class="card-content black-text">
          <span class="card-title"><h5 class="center">E-mail</h5></span>
          <p class="center">something123@gmail.com</p>
        </div>
      </div>
    </div>
    <div class="col s4">
        <div class="card  grey lighten-3">
          <div class="card-content black-text">
            <span class="card-title"><h5 class="center">Address</h5></span>
            <p class="center">Knsit Bangalore</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</section> 
    <section class="grey lighten-4 cus-pad">
      <div class="container">
        <h4 class="purple-text">Write to us</h4>
        <form action="<?php echo $_SERVER["PHP_SELF"];?>" method="POST">
          <div class="row">
          <div class="input-field col s6">
            <input type="text" name="name" class="validate" required>
            <label for="name">Name</label>
          </div>
          
          <div class="input-field col s6">
            <input type="email" name="email" class="validate">
            <label for="email" data-error="wrong" data-success="right">Email</label>
          </div>
        </div>
        <div class="row">
            <div class="input-field col s6">
                <input name="phone" type="number" class="validate" required>
                <label for="phone">Phone</label>
              </div>
        </div>
        <div class="row">
          <div class="input-field col s6">
            <textarea name="description" class="materialize-textarea" required></textarea>
            <label for="textarea1">Textarea</label>
          </div>
        </div>
        <div class="row">
          <button class="btn waves-effect waves-light purple" type="submit" name="action">Submit</button>
        </div>
        </form>
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