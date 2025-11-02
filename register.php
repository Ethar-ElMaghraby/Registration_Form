<?php
$servername = "localhost";
$username = "root";
$password = "Ethar2005";
$dbname = "form";
$port = 3306;

$conn = new mysqli($servername, $username, $password, $dbname, $port);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$fullname = $_POST['fullname'];
$email = $_POST['email'];
$pass_word = password_hash($_POST['password'],PASSWORD_DEFAULT);
$gender = $_POST['gender'];

$checkEmail = "SELECT * FROM users WHERE email = '$email'";
$result = $conn->query($checkEmail);

if ($result->num_rows > 0) {
    echo "Error: This email is already registered!";
} else {
 if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    die("❌ Please enter a valid email address (e.g. example@gmail.com)");
}
 $sql = "INSERT INTO users (fullname, email, pass_word, gender) 
            VALUES ('$fullname', '$email', '$pass_word', '$gender')";

    if ($conn->query($sql) === TRUE) {
        echo "Registration successful!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>
