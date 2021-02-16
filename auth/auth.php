<?php 
session_start();
require_once("../db-connection.php");
$userlevel=$_GET['user'];
// username and password sent from form 
$myusername=$_POST['email']; 
$mypassword=$_POST['password']; 

// To protect MySQL injection (more detail about MySQL injection)
$myusername = stripslashes($myusername);
$mypassword = stripslashes($mypassword);

$sql="SELECT * FROM donors WHERE email='$myusername' AND password='$mypassword'";
$result=mysqli_query($conn,$sql);

// Mysql_num_row is counting table row
$count=mysqli_num_rows($result);
$row=mysqli_fetch_assoc($result);
$id=$row['donor_id'];

// If result matched $myusername and $mypassword, table row must be 1 row
if($count==1){

// Register $myusername, $mypassword and redirect to file "login_success.php"
	$_SESSION['username']= $myusername;
	$_SESSION['name']= $row['first_name'];
	$_SESSION['id']=$id;
	if($id=='1')
	header("location:../admin/admin_dashboard.php");
		    
	else
	header("location:../dashboard.php?id={$row['donor_id']}");  
}
else {
header('Location: ../login.php?auth=1');
}
?>