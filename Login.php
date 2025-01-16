<?php

//session method is useful to pass information through diffent pages, we gonne pass some info from here to be used in page feed
session_start();
    
// Database configuration
$servername = "localhost";
$dbname = "social";
$dbusername = "root";
$dbpassword = "";

// Connect to the database
$conn = mysqli_connect($servername, $dbusername, $dbpassword, $dbname);

// Check connection
if (!$conn) {
    die("Database connection failed: " . mysqli_connect_error());
}

// Check if form data is set
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $pass_word = $_POST['password']; // Plain-text password submitted by user

    // Fetch user data from the database
    $query = "SELECT  pass_word FROM users WHERE email = ?";
    $stmt = mysqli_prepare($conn, $query);

    if (!$stmt) {
        die("Query preparation failed: " . mysqli_error($conn));
    }

    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if ($result && mysqli_num_rows($result) > 0) {
        $users = mysqli_fetch_assoc($result);
        $stored_hash = $users['pass_word']; // Retrieve the hashed password

        // Verify password (hashed in database)
        if (password_verify($pass_word, $stored_hash)) {

            $_SESSION['user_email'] = $email; // Store user email in session
            $_SESSION['user_id'] = $users['id'];
            // Redirect to dashboard
            header("Location: replaceFeedContent.php");
            header("Location: feed.php");
            exit();
        } 
        else {
            echo "Invalid password.";
        }
    } 
    else {
        echo "User not found.";
    }

    // Close statement
    mysqli_stmt_close($stmt);
}

// Close connection
mysqli_close($conn);
?>
