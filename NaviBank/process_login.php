<?php
    session_start();

    // Consider using environment variables or a configuration file for credentials
    $servername = "localhost";
    $hostusername = "root";
    $hostpassword = ""; // Replace with actual password or use environment variables
    $dbname = "web_uvbank_db";
    $port = 3306;

    $conn = new mysqli($servername, $hostusername, $hostpassword, $dbname, $port);

    // Check connection
    if ($conn->connect_error) {
        die("Error connecting to database: " . $conn->connect_error . "\n");
    }

    // Get form information with potential sanitization (optional)
    $email = isset($_POST['userEmail']) ? trim($_POST['userEmail']) : '';
    $pass = isset($_POST['userPassword']) ? trim($_POST['userPassword']) : '';

    // Hash and salt password before comparison (recommended)
    $hashed_pass = password_hash($pass, PASSWORD_DEFAULT);  // Implement password hashing

    // Check if user exists with prepared statement
    $query = "SELECT * FROM users WHERE userEmail = ?";
    $smt = $conn->prepare($query);
    $smt->bind_param("s", $email);
    if (!$smt->execute()) {
        echo "Error executing query: " . $conn->error . "\n"; // Handle query execution errors
        exit();
    }

    $rs = $smt->get_result();

    // Send initial "processing" status
    http_response_code(202);  // Accepted

    if ($rs->num_rows > 0) {
        // Successful login
        $row = $rs->fetch_assoc();  // Fetch user data if needed

        // Validate password with hashed version
        if (password_verify($pass, $hashed_pass)) {  // Replace userPass with actual password field
            $_SESSION['userEmail'] = $email;
            header('Location: pages/admin/dashboard.php');  // Use absolute path
            exit();
        } else {
            echo '<div class="alert alert-danger" role="alert">Invalid email or password.</div>';
        }
    } else {
        echo '<div class="alert alert-danger" role="alert">Invalid email or password.</div>';
    }

    $smt->close();
    $conn->close();
?>