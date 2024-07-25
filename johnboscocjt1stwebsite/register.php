<?php

// Initialize variables to hold form field values
$firstname = '';
$middlename = '';
$surname = '';
$username = '';
$password = '';
$email = '';
$mobile = '';
$facebook = '';
$twitter = '';
$instagram = '';



$errors = array('firstname' => '','middlename' => '', 'surname' => '', 'username' => '', 'password' => '', 'email' => '', 'mobile' => '', 'facebook' => '', 'twitter' => '', 'instagram' => '');

// Function to sanitize and validate input
function test_input($data) {
    global $conn; // Use the global connection variable
    $data = mysqli_real_escape_string($conn, trim($data));
    $data = htmlspecialchars($data);
    return $data;
}


// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Database connection
$conn = mysqli_connect("localhost", "root", "", "personal_website");

// Check connection
if ($conn === false) {
    die("Error: Could not connect. " . mysqli_connect_error());
}

    
  // First Name Validation
  if (empty($_POST['firstname'])) {
    $errors['firstname'] = 'Firstname is required';
} else {
    $firstname = test_input($_POST['firstname']);
    if (!preg_match("/^[a-zA-Z\s]+$/", $firstname)) {
        $errors['firstname'] = 'Only letters and white space allowed';
    }
}

// Middle Name Validation
if (empty($_POST['middlename'])) {
    $errors['middlename'] = 'Middlename is required';
} else {
    $middlename = test_input($_POST['middlename']);
    if (!preg_match("/^[a-zA-Z\s]+$/", $middlename)) {
        $errors['middlename'] = 'Only letters and white space allowed';
    }
}

// Surname Validation
if (empty($_POST['surname'])) {
    $errors['surname'] = 'Surname is required';
} else {
    $surname = test_input($_POST['surname']);
    if (!preg_match("/^[a-zA-Z\s]+$/", $surname)) {
        $errors['surname'] = 'Only letters and white space allowed';
    }
}

// Username Validation
if (empty($_POST['username'])) {
    $errors['username'] = 'Username is required';
} else {
    $username = test_input($_POST['username']);
    if (!preg_match("/^[a-zA-Z\s]+$/", $username)) {
        $errors['username'] = 'Only letters and white space allowed';
    }
}

 // Password validation
 if (empty($_POST['password'])) {
    $errors['password'] = 'Password is required';
} else {
    $password = test_input($_POST['password']);
    // Validate password length and complexity
    if (strlen($password) < 10) {
        $errors['password'] = 'Password must be at least 10 characters long';
    } elseif (!preg_match("/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{10,}$/", $password)) {
        $errors['password'] = 'Password must include at least one uppercase letter, one lowercase letter, one number, and one special character';
    }
}


// Email Validation
if (empty($_POST['email'])) {
    $errors['email'] = 'Email is required';
} else {
    $email = test_input($_POST['email']);
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = 'Invalid email format';
    }
}

// Mobile Validation
if (empty($_POST['mobile'])) {
    $errors['mobile'] = 'Mobile is required';
} else {
    $mobile = test_input($_POST['mobile']);
    if (!preg_match("/^[0-9]+$/", $mobile)) {
        $errors['mobile'] = 'Only numbers allowed';
    }
}

// Facebook Validation
if (empty($_POST['facebook'])) {
    $errors['facebook'] = 'Facebook is required';
} else {
    $facebook = test_input($_POST['facebook']);
    if (!preg_match("/^[a-zA-Z\s]+$/", $facebook)) {
        $errors['facebook'] = 'Only letters and white space allowed';
    }
}

// Twitter Validation
if (empty($_POST['twitter'])) {
    $errors['twitter'] = 'Twitter is required';
} else {
    $twitter = test_input($_POST['twitter']);
    if (!preg_match("/^[a-zA-Z\s]+$/", $twitter)) {
        $errors['twitter'] = 'Only letters and white space allowed';
    }
}

// Instagram Validation
if (empty($_POST['instagram'])) {
    $errors['instagram'] = 'Instagram is required';
} else {
    $instagram = test_input($_POST['instagram']);
    if (!preg_match("/^[a-zA-Z\s]+$/", $instagram)) {
        $errors['instagram'] = 'Only letters and white space allowed';
    }
}
   

// If there are no errors, insert data into the database
if (!array_filter($errors)) {
    $firstname = $_POST['firstname'];
    $middlename = $_POST['middlename'];
    $surname = $_POST['surname'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];
    $mobile = $_POST['mobile'];
    $facebook = $_POST['facebook'];
    $twitter = $_POST['twitter'];
    $instagram = $_POST['instagram'];
    $cv = $_FILES['cv']['name'];

    $sql = "INSERT INTO `users` (`firstname`, `middlename`, `surname`, `username`, `password`, `email`,`mobile`, `facebook`, `twitter`, `instagram`, `cv`) VALUES ('$firstname', '$middlename', '$surname', '$username', '$password', '$email', '$mobile', '$facebook', '$twitter', '$instagram', '$cv')";

    if (mysqli_query($conn, $sql)) {
        echo "New record created successfully";
          // Reset form field variables to empty strings
          $firstname = '';
          $middlename = '';
          $surname = '';
          $username = '';
          $password = '';
          $email = '';
          $mobile = '';
          $facebook = '';
          $twitter = '';
          $instagram = '';
    } else {
        echo "Error: " . mysqli_error($conn);
    }

    mysqli_close($conn);
    }
    
}

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
    <!--added script for icons-->
    <script src="https://kit.fontawesome.com/320d82d9a8.js" crossorigin="anonymous"></script>
     <!---script2 for login before accessing courses-->
     <script src="script2.js" defer></script>
     
    <style>
.red-text {
    color: red;
    font-size: 0.8em;
}

        /*form registration*/
.jb{
   color: black;
   padding: auto;
   background-color: #fff;
   
}
    </style>

</head>
<body>
<!--header section begin-->
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
                <!--cross icon-->    
                    <i class="fa-solid fa-xmark" onclick="closemenu()"></i>
                </ul>
                <!--menu icon-->
                <i class="fa-solid fa-bars" onclick="openmenu()"></i>
            </nav>

            <!-- add new div tag-->
            <div class="header-text">
                <p>Almost there!, you are in the Register page,</p>
                <h1>Enter your details in the <span>Registration form.</span><br></h1>
            </div>

        </div>

    </div>

    <main>
        <section id="register">
            <h1>Register</h1>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" class="jb" method="post" enctype="multipart/form-data">
                <label for="firstname">First Name:</label>
                <input placeholder="firstname" id="firstname" name="firstname" value="<?php echo $firstname; ?>" required><br>
                <span  class="red-text"><?php echo $errors['firstname']; ?></span><br>

                <label for="middlename">Middle Name:</label>
                <input placeholder="middlename" type="text" id="middlename" name="middlename" value="<?php echo $middlename; ?>" required><br>
                <span  class="red-text"><?php echo $errors['middlename']; ?></span><br>

                <label for="surname">Surname:</label>
                <input placeholder="surname" type="text" id="surname" name="surname" value="<?php echo $surname ?>" required><br>
                <span class="red-text"> <?php echo $errors['surname']; ?> </span><br>

                <label for="username">Username:</label>
                <input placeholder="username" type="text" id="username" name="username" value="<?php echo $username ?>" required><br>
                <span class="red-text"> <?php echo $errors['username']; ?> </span><br>

                <label for="password">Password:</label>
                <input placeholder="password should be at least 10 characters long and should
 contain both alphanumeric characters and special characters." type="password" id="password" name="password" value="<?php echo $password ?>" required><br>
                <span class="red-text"> <?php echo $errors['password']; ?> </span><br>

                <label for="email">Email:</label>
                <input placeholder="Enter a valid email address example@gmail.com" type="email" id="email" name="email" value="<?php echo $email ?>" required><br>
                <span class="red-text"> <?php echo $errors['email']; ?> </span>

                <label for="mobile">Mobile:</label>
                <input placeholder="Enter numbers" type="text" id="mobile" name="mobile" value="<?php echo $mobile ?>" required><br>
                <span class="red-text"> <?php echo $errors['mobile']; ?> </span><br>

                <label for="facebook">Facebook:</label>
                <input placeholder="facebook username" type="text" id="facebook" name="facebook" value="<?php echo $facebook ?>" required ><br>
                <span class="red-text"> <?php echo $errors['facebook']; ?> </span><br>

                <label for="twitter">Twitter:</label>
                <input placeholder="twitter username" type="text" id="twitter" name="twitter" value="<?php echo $twitter ?>" required><br>
                <span class="red-text"> <?php echo $errors['twitter']; ?> </span><br>

                <label for="instagram">Instagram:</label>
                <input placeholder="instagram username" type="text" id="instagram" name="instagram" value="<?php echo $instagram ?>" required><br>
                <span class="red-text"> <?php echo $errors['instagram']; ?> </span><br>

                <label for="cv">CV:</label>
                <input type="file" id="cv" name="cv" required><br>

                <input type="submit" value="Register" name="reg">
            </form>
        </section>
    </main>

    <footer>
        <p>Register for free today!, No fees required</p>
    </footer>


<!--copyright section begin-->
<div class="copyright">
    <p>Copyright &copy; made by <i class="fa-solid fa-heart"></i> Johnbosco 2024</p>
</div>    
<!--copyright section begin-->
</div>
<!--contact section end-->

<!-- Add a container for the login form -->
<div id="loginContainer"></div>





<script>
//about section js code begin
var tablinks = document.getElementsByClassName('tab-links'); //for the tab-links class
var tabcontents = document.getElementsByClassName('tab-contents'); //for the tab-contents class
//define the open tab function from the html
function opentab(tabname){
    //should hide the active color on active tab and also hide contents when not clicked
    for(tablink of tablinks){
        tablink.classList.remove("active-link");
    }
    for(tabcontent of tabcontents){
        tabcontent.classList.remove("active-tab");
    }
//to display other contents when clicked other the active one
event.currentTarget.classList.add("active-link");  
//displaying the content of the the displaying active link
document.getElementById(tabname).classList.add("active-tab");//tab name from tab titles area.  
}
//about section js code end
</script> 

<script>
var sidemenu = document.getElementById("sidemenu");
//function to open and close menu
function openmenu(){
    sidemenu.style.right = "0";
}
function closemenu(){
    sidemenu.style.right = "-200px";
}

</script>
<!--script for form validation, linking the js file-->
<script src="script.js"></script>

</body>
</html>