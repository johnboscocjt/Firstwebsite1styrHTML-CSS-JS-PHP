<?php
session_start();


// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['log_in'])) {
    // Database connection
    $conn = mysqli_connect("localhost", "root", "", "personal_website");

    // Check connection
    if ($conn === false) {
        die("Error: Could not connect. " . mysqli_connect_error());
    }

    // Retrieve form data securely
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    // Query to check credentials
    $sql = "SELECT * FROM users WHERE username = '$username' AND password = '$password' ";
    $result = mysqli_query($conn, $sql);

    // Check if credentials match
    if (mysqli_num_rows($result) > 0) {
        // Valid credentials, start session
        $_SESSION['username'] = $username;
        $_SESSION['password'] = $password;
        mysqli_close($conn);
        header("location: courses.php");
        exit();
    } else {
        // Invalid credentials
        $error = "Incorrect credentials entered. Please check your information";
    }

    // Close connection
    mysqli_close($conn);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Login</title>
    <!-- added script for icons -->
    <script src="https://kit.fontawesome.com/320d82d9a8.js" crossorigin="anonymous"></script>
    <!-- script2 for login before accessing courses -->
    <script src="script2.js" defer></script>
</head>
<body>
<!-- header section begin -->
<div id="header">
    <div class="container">
        <nav>
            <a href="index.html"><img src="images/jblogo.jpeg" alt="logo" class="logo"></a> 
            <ul id="sidemenu">
                <li><a href="index.html">Home</a></li>
                <li><a href="headerabout.html#about">About me</a></li>
                <li><a href="register.php">Register</a></li>
                <li><a href="courselogin.php">Courses</a></li>
                <li><a href="cv.html#services">CV</a></li>
                <li><a href="cv.html#contact">Contacts</a></li>
                <!-- cross icon -->
                <i class="fa-solid fa-xmark" onclick="closemenu()"></i>
            </ul>
            <!-- menu icon -->
            <i class="fa-solid fa-bars" onclick="openmenu()"></i>
        </nav>

        <!-- add new div tag -->
        <div class="header-text">
            <p>Welcome to the login page,</p>
            <h1>Enter the <span>username and password</span> you registered with.<br></h1>
        </div>

    </div>
</div>
<!-- header section end -->

<main>
    <section id="login">
        <h1>Login</h1>
        <form id="loginForm" action="courselogin.php" method="post" enctype="multipart/form-data">
            <input type="hidden" name="action" value="login">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required><br>

            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required><br>

            <input type="submit" name="log_in" value="Login">
        </form>
        <?php if (isset($error)) : ?>
            <p><?php echo $error; ?></p>
        <?php endif; ?>

    </section>
</main>

<footer>
    <p>JohnboscoCharles.com</p>
</footer>

<!--copyright section begin-->
<div class="copyright">
    <p>Copyright &copy; made by <i class="fa-solid fa-heart"></i> Johnbosco 2024</p>
</div>    
<!--copyright section begin--

</body>
</html>
