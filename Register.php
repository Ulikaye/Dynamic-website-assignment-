<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "social";

// Establish connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}



// Retrieve form data and validate, hii request method inafanya kazi only if form has been submitted
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $first_name = $conn->real_escape_string(trim($_POST['fname'])); //escape special characters for security sake
    $last_name = $conn->real_escape_string(trim($_POST['lname']));
    $email = $conn->real_escape_string(trim($_POST['email']));
    $pass_word = $conn->real_escape_string(trim($_POST['password']));
    $password_confirm = $conn->real_escape_string(trim($_POST['passwordconfirm']));

    
    //compare password entered by user
    if( $pass_word!== $password_confirm){
        echo "password do not match, try again<br>";
        echo "<a href='form-register.html'>Go back to proceed with registration</a>";
        exit();
    }

    // Check for empty fields
    if (empty($first_name) || empty($last_name) || empty($email) || empty($pass_word) || empty($password_confirm)) {
        die("All fields are required. <a href='Register.html'>Go Back</a>");
    }

    // Hash the password securely
    $hashed_password = password_hash($pass_word, PASSWORD_DEFAULT);

    // Insert data into the table (assuming 'nenosiri' column is used for the password)
    $sql = "INSERT INTO users(firstName, lastName, email, pass_word) 
            VALUES ('$first_name', '$last_name', '$email', '$hashed_password')";

    if ($conn->query($sql) === TRUE) {
         // Redirect to login
         header("Location: form-login.html");
         exit();
    } else {
        error_log("Error inserting data: " . $conn->error);
        die("An error occurred while saving your data. Please try again later.");
    }
}

echo "<a href='form-login.html'>Login</a>";

// Close connection
mysqli_close($conn);
?>
