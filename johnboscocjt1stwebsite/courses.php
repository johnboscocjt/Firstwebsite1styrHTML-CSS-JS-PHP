<?php
// Initialize variables to hold form field values
$course_name = "";
$course_code = "";
$course_description = "";
$offering_department = "";
$semester = "";
$academic_year = "";
$course_instructor = "";
$results = "";

$message = ""; // Initialize message variable




// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add_course'])){

// Create connection
$conn = mysqli_connect("localhost", "root", "", "database");

// Check connection
if ($conn ===false ) {
    die("Error: Could not connect " . mysqli_connect_error());
}

    //To add a course
    $course_name = $_POST['course_name'];
    $course_code = $_POST['course_code'];
    $course_description = $_POST['course_description'];
    $offering_department = $_POST['offering_department'];
    $semester = $_POST['semester'];
    $academic_year = $_POST['academic_year'];
    $course_instructor = $_POST['course_instructor'];
    $results = $_POST['results'];
   

    // SQL query to insert new course
    $sql = "INSERT INTO `database`.`courses` (`course_name`, `course_code`, `course_description`, `offering_department`, `semester`, `academic_year`, `course_instructor`, `results`)
            VALUES ('$course_name', '$course_code', '$course_description', '$offering_department', '$semester', '$academic_year', '$course_instructor', '$results')";

 if (mysqli_query($conn, $sql)) {

       // Set success message
        $message = "Course added successfully.";

        // Clear form field variables
        $course_name = "";
        $course_code = "";
        $course_description = "";
        $offering_department = "";
        $semester = "";
        $academic_year = "";
        $course_instructor = "";
        $results = "";

        // Redirect to prevent form resubmission on page refresh
        header('Location: courses.php');
        exit; // Make sure that no other output is sent
    } else {
        // Set error message
        $message = "Error: " . mysqli_error($conn);
    }

   mysqli_close($conn);

}

// Fetch courses
$conn = mysqli_connect("localhost", "root", "", "database");

// Check connection
if ($conn === false ) {
    die("Error: Could not connect " . mysqli_connect_error());
}

$sql_fetch_courses = "SELECT * FROM courses";
$result = $conn->query($sql_fetch_courses);

mysqli_close($conn);
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Courses</title>
    <link rel="stylesheet" href="style.css">
    <script src="https://kit.fontawesome.com/320d82d9a8.js" crossorigin="anonymous"></script>
    <script src="script2.js" defer></script>
      
    
</head>
<body>

<div id="header">
    <!-- Your header content -->
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
                
                <!-- Other menu items -->
                <li><a href="index.html">Logout</a></li>

                <!--cross icon-->
                <i class="fa-solid fa-xmark" onclick="closemenu()"></i>
            </ul>
            <!--menu icon-->
            <i class="fa-solid fa-bars" onclick="openmenu()"></i>
        </nav>

        <!-- add new div tag-->
        <div class="header-text">
                <p>Logged In!,  you are now in the Courses page,</p>
                <h1>You can add course<span> Or view courses available.</span><br></h1>
        </div>
    </div>
</div>

<main>
    <section id="portifolio">
        <h1>Courses</h1>

        <!-- Display success or error message -->
        <?php if (!empty($message)): ?>
            <div class="message"><?php echo $message; ?></div>
        <?php endif; ?>


        <!-- Form to add a new course -->
        <form action="courses.php" method="post" enctype="multipart/form-data">
            <label for="course_name">Course Name:</label>
            <input placeholder="course name cannot exceed 30 characters" id="course_name" name="course_name" required><br>

            <label for="course_code">Course Code:</label>
            <input type="text" id="course_code" name="course_code" required><br>

            <label for="course_description">Course Description:</label>
            <input placeholder="course description cannot exceed 50 characters" type="text" id="course_description" name="course_description" required><br>

            <label for="offering_department">Offering Department:</label>
            <input type="text" id="offering_department" name="offering_department" required><br>

            <label for="semester">Semester:</label>
            <select id="semester" name="semester" required>
                <option value="1" <?php if ($semester == "1") echo "selected"; ?>>1</option>
                <option value="2" <?php if ($semester == "2") echo "selected"; ?>>2</option>
            </select><br>

            <label for="academic_year">Academic Year:</label>
            <input type="text" id="academic_year" name="academic_year" required><br>

            <label for="course_instructor">Course Instructor:</label>
            <input placeholder="course instructor cannot exceed 30 characters" type="text" id="course_instructor" name="course_instructor" required><br>

            <label for="results">Results:</label>
            <select id="results" name="results" required>
                <option value="A" <?php if ($results == "A") echo "selected"; ?>>A</option>
                <option value="B" <?php if ($results == "B") echo "selected"; ?>>B</option>
                <option value="C" <?php if ($results == "C") echo "selected"; ?>>C</option>
                <option value="D" <?php if ($results == "D") echo "selected"; ?>>D</option>
                <option value="F" <?php if ($results == "F") echo "selected"; ?>>F</option>
            </select><br>

            <input type="submit" name="add_course" value="Add Course">
        </form>

        <!-- Displaying course list -->
        <h2>Course List</h2>
        <table id="courseTable">
            <tr>
                <th>Course Name</th>
                <th>Course Code</th>
                <th>Description</th>
                <th>Department</th>
                <th>Semester</th>
                <th>Year</th>
                <th>Instructor</th>
                <th>Grade</th>
            </tr>
            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo htmlspecialchars($row['course_name']); ?></td>
                    <td><?php echo htmlspecialchars($row['course_code']); ?></td>
                    <td><?php echo htmlspecialchars($row['course_description']); ?></td>
                    <td><?php echo htmlspecialchars($row['offering_department']); ?></td>
                    <td><?php echo htmlspecialchars($row['semester']); ?></td>
                    <td><?php echo htmlspecialchars($row['academic_year']); ?></td>
                    <td><?php echo htmlspecialchars($row['course_instructor']); ?></td>
                    <td><?php echo htmlspecialchars($row['results']); ?></td>
                </tr>
            <?php endwhile; ?>
        </table>
    </section>
</main>

<footer>
    <p>JohnboscoCharles.com</p>
</footer>
<!--copyright section begin-->
    <div class="copyright">
        <p>Copyright &copy; made by <i class="fa-solid fa-heart"></i> Johnbosco 2024</p>
    </div>    
<!--copyright section begin-->

<!-- Your JavaScript scripts -->
<script>
    function openmenu() {
        document.getElementById("sidemenu").style.right = "0";
    }

    function closemenu() {
        document.getElementById("sidemenu").style.right = "-200px";
    }
</script>


<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Get form element
        var form = document.querySelector("form[action='courses.php']");
        var courseNameInput = form.querySelector("#course_name");
        var courseInstructorInput = form.querySelector("#course_instructor");
        var courseDescriptionInput = form.querySelector("#course_description");

        // Add event listener for form submission
        form.addEventListener("submit", function(event) {
            // Check course name length
            if (courseNameInput.value.length > 30) {
                alert("Course name cannot exceed 30 characters");
                event.preventDefault(); // Prevent form submission
                return;
            }

            // Check instructor's name length
            if (courseInstructorInput.value.length > 30) {
                alert("Instructor's name cannot exceed 30 characters");
                event.preventDefault(); // Prevent form submission
                return;
            }

            // Check course description length
            if (courseDescriptionInput.value.length > 50) {
                alert("Course description cannot exceed 50 characters");
                event.preventDefault(); // Prevent form submission
                return;
            }
        });
    });
</script>




</body>
</html>

