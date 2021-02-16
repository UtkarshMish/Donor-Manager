<?php
session_start();
if (!isset($_SESSION['id'])) {
  header("location:login.php");
  if (($_SESSION['id'] != 1)) {
    header("location:dashboard.php");
  }
}

require_once("db-connection.php");
$id = $_SESSION['id'];
$sql = "SELECT * FROM `events` WHERE 1";
$result = mysqli_query($conn, $sql);




require_once("db-connection.php");
$id = $_SESSION['id'];
$sql2 = "SELECT * FROM `organization` WHERE 1";
$result2 = mysqli_query($conn, $sql2);



if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  if (isset($_POST['delete_item'])) {
    $aid = $_POST['delete_item'];
    $sql = "DELETE FROM `events` WHERE event_id =$aid";
    if (mysqli_query($conn, $sql)) {
      header("location: /event_list.php");
    } else {
      echo "Error: " . $sql . "<br>" . $conn->error;
    }
  } else {
    $event_name = $_POST['event_name'];
    $description = $_POST['description'];
    $strt_date = $_POST['strt_date'];
    $img_links = $_POST['img_links'];
    $org_id = $_POST['org_id'];


    $sql = "INSERT INTO `events`(`event_name`, `description`, `start_date`, `org_id`, `img_links`) 
      VALUES 
      ('$event_name','$description','$strt_date','$org_id',' $img_links')";

    if (mysqli_query($conn, $sql)) {
      header("location:/event_list.php");
    } else {
      echo "Error: " . $sql . "<br>" . $conn->error;
    }
  }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
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
            <?php if (isset($_SESSION['username']) && !empty($_SESSION['username'])) {
            ?>
              <li><a href="<?php if ($id == '1') {
                              echo "admin/admin_dashboard.php";
                            } else echo "/dashboard.php"; ?>" class="active">Dashboard</a></li>
              <li><a href="logout.php">Logout</a></li>
            <?php } else { ?>
              <li><a href="login.php">Login</a></li>
              <li><a href="register.php">Register</a></li>
            <?php } ?>
            <li><a href="/contact.php">Contact us</a></li>

          </ul>
        </div>
      </div>
    </nav>
    <div class="sidenav">

      <a href="<?php if ($id == '1') {
                  echo "admin/admin_dashboard.php";
                } else echo "/dashboard.php"; ?>">Dashboard</a>
      <a href="/edit_user.php">Edit Profile</a>
      <a href="<?php if ($_SESSION['id'] == '1') {
                  echo "/all_donation.php";
                } else echo "/donation_history.php"; ?>">Past Donation</a>
      <a href="/event_list.php">Manage Events</a>
      <a href="/user_list.php">Manage Users</a>
      <a href="/org_list.php">Manage Organization</a>
      <a href="/list_contacted.php">User Contacted</a>

    </div>
  </header>
  <main>
    <section>
      <div class="container">
        <div class="row ">
          <div class="col s12">
            <ul class="tabs">
              <li class="tab col s6"><a class="active green-text" href="#test1">Event List</a></li>
              <li class="tab col s6">
                <!-- Modal Trigger -->
                <a class="waves-effect waves-light btn modal-trigger teal darken-4 red-text" data-target="modal1">Add New Events</a>

                <!-- Modal Structure -->
                <div id="modal1" class="modal grey lighten-4">
                  <div class="modal-content">
                    <h4 class="teal-text">NEW EVENT</h4>
                    <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="POST">
                      <div class="row">
                        <div class="input-field col s8 ">
                          <input name="event_name" type="text" class="validate" required>
                          <label for="Organization Name">Event Name</label>
                        </div>
                      </div>
                      <div class="row">
                        <div class="input-field col s8 ">
                          <input name="description" type="text" class="validate" required>
                          <label for="Organization Name">Description</label>
                        </div>
                      </div>
                      <div class="row">
                        <div class="input-field col s8 ">
                          <input name="strt_date" type="date" class="validate" required>
                          <label for="Organization Name"></label>
                        </div>
                      </div>

                      <div class="row">
                        <div class="col s8">
                          <select class="browser-default" input type="number" name="org_id">
                            <option value="" disabled selected>Choose Organization</option>
                            <?php
                            if ($result2->num_rows > 0) {
                              while ($orgs = $result2->fetch_assoc()) {
                                $org = $orgs['org_id'];


                            ?>

                                <option value=<?php echo $org; ?>><?php echo $orgs['organization_name']; ?></option>

                            <?php
                              }
                            }
                            ?>
                          </select>
                        </div>
                        <div class="row">
                          <div class="input-field col s8 ">
                            <input name="img_links" type="text" class="validate" required>
                            <label for="Organization Name">Image Links</label>
                          </div>
                        </div>

                      </div>
                      <div class="modal-footer">
                        <button class="btn waves-effect waves-light red black-text" type="submit" name="action">ADD</button>
                        <a href="#!" class="modal-close waves-effect waves-green btn-flat">Cancel</a>
                      </div>
                    </form>
                  </div>
              </li>

            </ul>
          </div>
          <div id="test1" class="col s12">
            <table class="grey lighten-4">
              <thead>
                <tr>
                  <th class="black-text">Event ID</th>
                  <th class="black-text">Event Name</th>
                  <th class="black-text">Description</th>
                  <th class="black-text">Start Date</th>
                  <th class="black-text">Organization ID</th>
                  <th class="black-text">Image Links</th>
                  <th class="black-text">Delete Event</th>
                </tr>
              </thead>

              <tbody>
                <?php
                if ($result->num_rows > 0) {
                  while ($events = $result->fetch_assoc()) {

                    echo "<tr>";
                    echo "<td>" . $events['event_id'] . "</td>";
                    echo "<td>" . $events['event_name'] . "</td>";
                    echo "<td>" . $events['description'] . "</td>";
                    echo "<td>" . $events['start_date'] . "</td>";
                    echo "<td>" . $events['org_id'] . "</td>";
                    echo "<td>" . $events['img_links'] . "</td>";
                ?>
                    <td>
                      <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post">
                        <button type="submit" class="btn waves-effect waves-light pink white-text darken-1" name="delete_item" value="<?php echo $events['event_id']; ?> ">Delete</button>

                      </form>
                    </td>
                <?php
                    echo "</tr>";
                  }
                }
                echo "</table>";
                ?>
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
    $("document").ready(function() {
      $(".button-collapse").sideNav();
    });
    $(document).ready(function() {
      $('.carousel').carousel();
    });
    $('.carousel.carousel-slider').carousel({
      fullWidth: true
    });
    $(document).ready(function() {
      $('.tabs').tabs();
    });
    $(document).ready(function() {
      $('.modal').modal();
    });
    $('table').on('click', 'input[type="button"]', function(e) {
      $(this).closest('tr').remove()
    });
  </script>
</body>

</html>