<?php
$dbserver = "localhost"; //might be 127.0.0.1
$username = "root";
$password = "Jrosal1219";
$dbname = "login";

$conn = mysql_connect($dbserver,$username,$password,$dbname);
     if (!$conn) {
          die("Connection failed: " . mysql_error());
     }
mysql_select_db($dbname);

//$usernmIn=from front end;
//$passwdIn=from front end;

$checkQuery = $mysqli_prepare($conn,"IF NOT EXIST (SELECT username,password FROM users WHERE username=? AND password=?"));
mysqli_stmt_bind_param($checkQuery,'ss',$usernmIn,$passwdIn);

if(mysqli_stmt_execute($checkQuery)) {
  
  $salty=mcrypt_create_iv(10);
  $insQuery = $mysqli_prepare($conn, "INSERT INTO users (username,password,salt) VALUES (?,?,?)");  
  mysqli_stmt_bind_param($insQuery,'sss',$usernmIn,SHA1($password . $salt),$salt);
}
else {
  echo "Sorry, unable to register you into the system";
}

?>
