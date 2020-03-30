<?php
 $myType = $_POST['myType'];
$myFirstName = $_POST['fname'];
 $myLastName = $_POST['lname'];
 $myPhone = $_POST['phone'];
$email = $_POST['myEmail'];
$firstVisit = $_POST['YN'];

if (!empty($myType) || !empty($myFirstName) || !empty($gender) || !empty($myLastName) || !empty($myPhone) || !empty($email) || !empty($firstVisit)) {
 	$host = "localhost";
    $dbUsername = "root";
    $dbPassword = "";
    $dbname = "assignment5";

    //create connection
    $conn = new mysqli($host, $dbUsername, $dbPassword, $dbname);
    if (mysqli_connect_error()) {
     die('Connect Error('. mysqli_connect_errno().')'. mysqli_connect_error());
    } else {
     $SELECT = "SELECT myEmail From thetable Where myEmail = ? Limit 1";
     $INSERT = "INSERT Into thetable (fname,lname,myEmail,phone,myType,YN) values(?, ?, ?, ?, ?, ?,?)";
     //Prepare statement
     $stmt = $conn->prepare($SELECT);
     $stmt->bind_param("s", $email);
     $stmt->execute();
     $stmt->bind_result($email);
     $stmt->store_result();
     $rnum = $stmt->num_rows;
     if ($rnum==0) {
      $stmt->close();
      $stmt = $conn->prepare($INSERT);
      $stmt->bind_param($myFirstName,$myLastName,$email,$Myphone,$myType,$YN);
      $stmt->execute();
      echo "New record inserted sucessfully";
     } else {
      echo "Someone already register using this email";
     }
     $stmt->close();
     $conn->close();
    }
} else {
 echo "All field are required";
 die();
}
?>