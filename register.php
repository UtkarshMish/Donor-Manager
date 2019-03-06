<?php
session_start();
if(isset($_SESSION['id'])){
  header("location:dashboard.php");
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
      <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
      <title>Register | Alone</title>
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
    <?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      $first_name=$_POST['first_name'];
      $last_name=$_POST['last_name'];
      $email=$_POST['email'];
      $password_user=$_POST['password'];
      $phone=$_POST['phone'];
      $address=$_POST['address']; 
        $city=$_POST['city'];
        $state=$_POST['state'];
        $country=$_POST['country'];
        $occupation=$_POST['occupation'];
      $gender=$_POST['gender'];
      require_once("db-connection.php");
    
      $sql = "INSERT INTO donors(first_name, last_name, email, password, phone, address, city, state, country, occupation, gender)
       VALUES 
       ('$first_name','$last_name','$email','$password_user',' $phone','$address',' $city','$state',' $country','$occupation','$gender')";
    
      if (mysqli_query($conn,$sql)) {
        
        header("location:../login.php?success=1");
       
        
      } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
      }
    }
    ?>
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
              <li><a href="logout.php">Logout</a></li>
                <?php }else{ ?>
                  <li><a href="login.php">Login</a></li>
                   <li><a href="register.php" class="active">Register</a></li>
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
         <div class="card-content white-text">
          <span class="card-title"> <h4 class="center pink-text">Register</h4></span>
        </div>
        <div class="card-action">
         <form action="<?php echo $_SERVER["PHP_SELF"];?>" method="POST">
           <div class="row">
           <div class="input-field col s8 l6">
             <input type="text" name="first_name" class="validate" required>
             <label for="first_name">First Name</label>
           </div>
           <div class="input-field col s8 l6">
             <input type="text" name="last_name" class="validate" >
             <label for="last_name">Last Name</label>
           </div>
          </div>
          <div class="row">
           <div class="input-field col s8">
             <input type="email" name="email" class="validate" required>
             <label for="email" data-error="wrong" data-success="right">Email</label>
           </div>
          </div>
          <div class="row">
              <div class="input-field col s8">
                <input name="phone" type="number" class="validate" >
                <label for="phone">Phone</label>
              </div>
              </div>
           <div class="row">
              <div class="input-field col s8">
                <input name="password" type="password" class="validate" required>
                <label for="password">Password</label>
              </div>
           </div>
            <div class="row">
           <div class="input-field col s8">
             <textarea name="address" class="materialize-textarea" required></textarea>
             <label for="address">Address</label>
           </div>
          </div>
          <div class="row">
              <div class="input-field col s8 l6">
                <input type="text" name="city" class="validate" required>
                <label for="city">City</label>
              </div>
              <div class="input-field col s8 l6">
                <input type="text" name="state" class="validate" required>
                <label for="state">State</label>
              </div>
             </div>
             <div class="row">
                <div class="input-field col s8 l6">
                  <input type="text" name="country" class="validate" required>
                  <label for="country">Country</label>
                </div>
                <div class="input-field col s8 l6">
                  <input type="text" name="occupation" class="validate" required>
                  <label for="occupation">Occupation</label>
                </div>
               </div>
               <div class="row">
               <div class="col s6 ">
               <p><label ><input name="gender" type="radio"  value="m" required /><span>Male</span></label></p>
               </div>
               <div class="col s6">
               <p><label ><input name="gender" type="radio" value="f" /><span>Female</span></label></p>
               </div>
               </div>
               <div class="row center card-action">
                 <button class="btn waves-effect waves-light pink" type="submit" name="action">Register</button>
               </div>
               </div>
               </div>
         </form>
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