<footer class="page-footer black">
    <div class="row">
      <div class="col l6 m6 s12">
        <h5 class="white-text center">About Us</h5>
        <p class="grey-text text-lighten-4 center">Lorem Ipsum is simply dummy text of the printing and typesetting industry. 
        Lorem Ipsum has been the industry's standard dummy text ever since the 1500s,</p>
      </div>
      <div class="col l3 m3 s12">
        <h6 class="white-text">Donor Links</h6>
        <ul>
          <li><a class="grey-text text-lighten-3" href="/login.php">Login</a></li>
          <li><a class="grey-text text-lighten-3" href="/register.php">Register</a></li>
          <li><a class="grey-text text-lighten-3" href="/contact.php">Contact us</a></li>
          <li><a class="grey-text text-lighten-3" href="/events.php">Events</a></li>
      
        </ul>
      </div>
      <div class="col l3 m3 s12">
        <h6 class="white-text">Admin</h6>
        <ul>
<li><a class="grey-text text-lighten-3" href="<?php if($_SESSION['id']=='1'){echo "/admin/admin_dashboard.php";}
            else echo "/dashboard.php"; ?>">Admin Login</a></li>
          <li><a class="grey-text text-lighten-3" href="/register.php">Register</a></li>
          <li><a class="grey-text text-lighten-3" href="/contact.php">Contact us</a></li>
          <li><a class="grey-text text-lighten-3" href="/events.php">Events</a></li>
        </ul>
      </div>
    </div>
  <div class="footer-copyright">
        <div class="col l6 m6 s12">&copy; 2018 Copyright <a class="white-text text-lighten-4" href="#" target="_blank">KNSIT PROJECT </a></div>
        
        <div class="col l6 m6 s12"><a class="grey-text text-lighten-4 right" href="#" target="_blank"> -Designed By Utkarsh Mishra</a></div>
  </div>
</footer>