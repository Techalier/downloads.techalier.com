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
  if ($platform=='Certitude'){
    $name= '/win/certitude.zip';
    download($name);
  }
}
if ($user_system=='Non-Windows'){
  if ($platform=='Certitude'){
    $name= '/unix/certitude.zip';
    download($name);
  }
}

} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}


function download($name) {
  $file = $name;

  if (file_exists($file)) {
      header('Content-Description: File Transfer');
      header('Content-Type: application/octet-stream');
      header('Content-Disposition: attachment; filename='.basename($file));
      header('Content-Transfer-Encoding: binary');
      header('Expires: 0');
      header('Cache-Control: must-revalidate');
      header('Pragma: public');
      header('Content-Length: ' . filesize($file));
      ob_clean();
      flush();
      readfile($file);
      exit;
  }
}

$conn->close();



exit();

?>