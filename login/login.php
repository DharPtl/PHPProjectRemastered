<?php
session_start();

function testDbConnection($host, $name, $user, $pass, $port = "3306"): bool {
    try {
        $conn = new mysqli($host, $user, $pass, $name, $port);
        if ($conn->connect_errno) {
            return false;
        }
        $conn->close();
    } catch (Exception $e) {
        return false;
    }
    return true;
}

function handlePostRequest() {
    error_log("Received POST request"); // Log that we received a POST request

    if ($_SERVER["REQUEST_METHOD"] != "POST") {
        // Log the invalid request method
        error_log("Invalid request method"); 
        http_response_code(405); 
        // Method Not Allowed
        echo "Invalid request method";
        return;
    }

    if (!isset($_POST["username"])) {
        error_log("Missing username"); 
        // Log that username is missing
        http_response_code(400); 
        // Bad Request
        echo "Missing username";
        return;
    }

    if (!isset($_POST["password"])) {
        // Log that password is missing
        error_log("Missing password"); 
        http_response_code(400); 
        // Bad Request
        echo "Missing password";
        return;
    }

    $username = $_POST["username"];
    $password = $_POST["password"];
    $servername = "localhost";
    $dbname = "cp476";
    $DATABASE_PORT = "3306";
    //setupDatabase() function
    $conn = setupDatabase();
    $loggedIn = testDbConnection($servername, $dbname, $username, $password, $DATABASE_PORT);

    if ($loggedIn) {
        // print successful login
        error_log("Login successful for user: " . $username); 
        $_SESSION["username"] = $username;
        $_SESSION["password"] = $password;
        // Redirect to homepage
        header("Location: http://localhost/main.php", true, 301); 
        exit();
    } else {
        // Log failed login attempt
        error_log("Login failed for user: " . $username); 
         // Unauthorized
        http_response_code(401);
        echo "Login failed";
    }
}

//call setup database to initialize the connection
function setupDatabase()
{
    $servername = "localhost"; 
    $username = "drose"; 
    $password = "cp476dhar";
    $dbname = "cp476";
    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    return $conn;
}

handlePostRequest();
?>
