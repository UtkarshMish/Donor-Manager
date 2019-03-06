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
      <title>Login | Alone</title>
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
              <li><a href="/login.php" class="active">Log in</a></li>
              <li><a href="/register.php">Register</a></li>
              <li><a href="/contact.php">Contact us</a></li>
            </ul>
          </div>
        </div>
      </nav>
    </header>
      <main>
      <section>
        <div class="container">
          <h4 class="login blue-text darken-1 center">Log In</h4>
          <form action="auth/auth.php?user=1" method="post">
            <div class="row">
              <div class="col s3"></div>
            <div class="input-field col s6 center">
              <input type="email" name="email" class="validate">
              <label for="email" data-error="wrong" data-success="right">Email</label>
            </div>
            <div class="col s3"></div>

          </div>
          <div class="row">
              <div class="col s3"></div>
            <div class="input-field col s6">
              <input name="password" type="password" class="validate">
              <label for="password">Password</label>
            </div>
            <div class="col s3"></div>
          </div>
          <div class="row center">
          <button class="btn waves-effect waves-light blue darken-4" type="submit" name="action">Sign in</button>
          </div>
          </form>
          <?php
          if ($_GET) {
          $auth=0;
         
          if(isset($_GET['auth'])){
            $auth=$_GET['auth'];
          if($auth==1)
          {
            ?>
            <div class="row">
            <h5 class="red-text center">Wrong Credentials. Please try again!!!</h5>
            </div>
            <?php
          }
        }
      }
          ?>
          <?php
          if ($_GET) {
            if(isset($_GET['success'])){
          $success=0;
          $success=$_GET['success'];
          if($success==1)
          {
            ?>
            <div class="row">
            <h5 class="green-text center">Successfully Registered.Please Log in</h5>
            </div>
            <?php
          }
        }
      }
          ?>
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