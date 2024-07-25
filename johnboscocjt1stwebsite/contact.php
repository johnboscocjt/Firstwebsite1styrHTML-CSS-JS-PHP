<?php

// Initialize variables to hold form field values
$name = '';
$email = '';
$message = '';



// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Database connection
$conn = mysqli_connect("localhost", "root", "", "contactjb");

// Check connection
if ($conn === false) {
    die("Error: Could not connect. " . mysqli_connect_error());
}

// insert data into the database
    $name = $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['message'];
   

    $sql = "INSERT INTO `contactme` (`name`, `email`, `message`) VALUES ('$name', '$email', '$message')";

    if (mysqli_query($conn, $sql)) {
        echo "New record created successfully";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
    header("location: index.html");
        

    mysqli_close($conn);
    }
    
  

?>



