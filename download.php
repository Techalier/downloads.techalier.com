<?php
$servername = "localhost";
$username = "phpedits";
$password = "WinactPoint@2021";
$dbname = "platform_support_db";

$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
date_default_timezone_set('Asia/Kolkata');
$application_date=date("Y-m-d h:m:s");
$user_name=$_POST['name'];
$user_email=$_POST['email'];
$user_number=$_POST['tel'];
$platform=$_POST['platform'];
$user_system=$_POST['user_system'];
$ticket_no=rand(111111,999999);

$sql = "INSERT INTO downloads_list (ticket_no, user_name, user_email, user_number, platform, user_system)
VALUES ('$ticket_no', '$user_name', '$user_email', '$user_number', '$platform', '$user_system')";

if ($conn->query($sql) === TRUE) {
if ($user_system=='Windows'){
header("Location:/win/certitude/download.php");
}
if ($user_system=='Non-Windows'){
header("Location:/unix/certitude/download.php");
}

} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}
$conn->close();

exit();

?>