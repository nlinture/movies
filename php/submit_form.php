<?php

// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Database connection
$con = mysqli_connect("localhost", "root", "", "submit_form");

// Check connection
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

// Retrieve and sanitize form data
$txtFirstName = mysqli_real_escape_string($con, $_POST['first_name']);
$txtLastName = mysqli_real_escape_string($con, $_POST['last_name']);
$txtEmail = mysqli_real_escape_string($con, $_POST['email']);
$txtPhone = mysqli_real_escape_string($con, $_POST['Phone']);
$txtMessage = mysqli_real_escape_string($con, $_POST['message']);

echo "<h3>Form Data Received:</h3>";
echo "First Name: $txtFirstName<br>";
echo "Last Name: $txtLastName<br>";
echo "Email: $txtEmail<br>";
echo "Phone: $txtPhone<br>";
echo "Message: $txtMessage<br>";

// SQL query to insert data
$sql = "INSERT INTO `contact_form_submissions` (`First Name`, `Last Name`, `E-mail`, `Phone`, `Message`) 
        VALUES ('$txtFirstName', '$txtLastName', '$txtEmail', '$txtPhone', '$txtMessage')";

// Execute the query and check for success
if (mysqli_query($con, $sql)) {
    echo "Contact Records Inserted";
} else {
    echo "Error: " . mysqli_error($con);
}

// Send an email notification after inserting data into the database
$to = "nikola.lintur@gmail.com";  // Replace with your desired recipient email
$subject = "New Contact Form Submission";
$body = "First Name: $txtFirstName\n";
$body .= "Last Name: $txtLastName\n";
$body .= "Email: $txtEmail\n";
$body .= "Phone: $txtPhone\n";
$body .= "Message:\n$txtMessage\n";
/*
// Send the email and check for success
if (mail($to, $subject, $body)) {
    echo "<h1>Thank you! Your message has been sent.</h1>";
} else {
    echo "<h1>Sorry, there was an error sending your message.</h1>";
}
*/
// Close the database connection
mysqli_close($con);