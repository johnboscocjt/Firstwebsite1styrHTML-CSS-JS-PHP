document.addEventListener("DOMContentLoaded", function()) {
    const registerForm = document.getElementById("registerForm");
    const loginForm = document.getElementById("loginForm");
    const coursesLink = document.getElementById("coursesLink");
    const loginFormContainer = document.getElementById("loginFormContainer");
    const coursesSection = document.getElementById("courses");

    // Register form validation
    if (registerForm) {
        registerForm.addEventListener("submit", function(event) {
            const password = document.getElementById("password").value;
            const passwordPattern = /^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{10,}$/;
            if (!passwordPattern.test(password)) {
                alert("Password must be at least 10 characters long and contain both alphanumeric and special characters");
                event.preventDefault();
            }
        });
    }


    // Login form submission and validation
    if (loginForm) {
        loginForm.addEventListener("submit", function(event) {
            event.preventDefault();
            const formData = new FormData(loginForm);
            fetch("login.php", {
                method: "POST",
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert("Login successful");
                    loginFormContainer.style.display = "none";
                    coursesSection.style.display = "block";
                    loadCourses();
                } else {
                    alert("Invalid username or password");
                }
            })
            .catch(error => console.error("Error:", error));
        });
    }

    // Courses link click event
    if (coursesLink) {
        coursesLink.addEventListener("click", function(event) {
            event.preventDefault();
            loginFormContainer.style.display = "block";
        });
    }

    // Load courses function
    function loadCourses() {
        fetch("courses.php?action=get_courses")
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok ' + response.statusText);
            }
            return response.json();
        })
        .then(data => {
            const courseTable = document.querySelector("#courseTable tbody");
            if (courseTable) {
                courseTable.innerHTML = "";
                data.forEach(course => {
                    const row = document.createElement("tr");
                    row.innerHTML = `
                        <td>${course.course_name}</td>
                        <td>${course.course_code}</td>
                        <td>${course.course_description}</td>
                        <td>${course.offering_department}</td>
                        <td>${course.semester}</td>
                        <td>${course.academic_year}</td>
                        <td>${course.course_instructor}</td>
                        <td>${course.results}</td>
                    `;
                    courseTable.appendChild(row);
                });
            }
        })
        .catch(error => console.error('Error:', error));
    }
};






    document.addEventListener("DOMContentLoaded", function() {
        // Get form elements
        var form = document.querySelector("form[action='courses.php']");
        var courseNameInput = form.querySelector("#course_name");
        var courseInstructorInput = form.querySelector("#course_instructor");
        var courseDescriptionInput = form.querySelector("#course_description");

        // Add event listeners for input validation
        courseNameInput.addEventListener("input", function() {
            if (courseNameInput.value.length > 30) {
                courseNameInput.setCustomValidity("Course name cannot exceed 30 characters");
            } else {
                courseNameInput.setCustomValidity("");
            }
        });

        courseInstructorInput.addEventListener("input", function() {
            if (courseInstructorInput.value.length > 30) {
                courseInstructorInput.setCustomValidity("Instructor's name cannot exceed 30 characters");
            } else {
                courseInstructorInput.setCustomValidity("");
            }
        });

        courseDescriptionInput.addEventListener("input", function() {
            if (courseDescriptionInput.value.length > 50) {
                courseDescriptionInput.setCustomValidity("Course description cannot exceed 50 characters");
            } else {
                courseDescriptionInput.setCustomValidity("");
            }
        });

        // Optional: Reset validation on form submission attempt
        form.addEventListener("submit", function() {
            courseNameInput.setCustomValidity("");
            courseInstructorInput.setCustomValidity("");
            courseDescriptionInput.setCustomValidity("");
        });
    });



    document.addEventListener("DOMContentLoaded", function() {
        var form = document.querySelector("form[action='courses.php']");
        var courseNameInput = form.querySelector("#course_name");
        var courseInstructorInput = form.querySelector("#course_instructor");
        var courseDescriptionInput = form.querySelector("#course_description");

        form.addEventListener("submit", function(event) {
            if (courseNameInput.value.length > 30) {
                alert("Course name cannot exceed 30 characters");
                event.preventDefault(); // Prevent form submission
                return;
            }

            if (courseInstructorInput.value.length > 30) {
                alert("Instructor's name cannot exceed 30 characters");
                event.preventDefault(); // Prevent form submission
                return;
            }

            if (courseDescriptionInput.value.length > 50) {
                alert("Course description cannot exceed 50 characters");
                event.preventDefault(); // Prevent form submission
                return;
            }
        });
    });




    // JavaScript for form validation can be added here
document.addEventListener("DOMContentLoaded", function() {
    const registerForm = document.querySelector("form[action='register.php']");
    registerForm.addEventListener("submit", function(event) {
        const password = document.getElementById("password").value;
        const email = document.getElementById("email").value;

        // Email validation
        const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailPattern.test(email)) {
            alert("Invalid email format");
            event.preventDefault();
        }

        // Password validation
        const passwordPattern = /^(?=.*[A-Za-z])(?=.*\d)(?=.*[^A-Za-z0-9]).{10,}$/;
        if (!passwordPattern.test(password)) {
            alert("Password must be at least 10 characters long and contain both alphanumeric and special characters.");
            event.preventDefault();
        }
    });
});





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
 


var sidemenu = document.getElementById("sidemenu");
//function to open and close menu
function openmenu(){
    sidemenu.style.right = "0";
}
function closemenu(){
    sidemenu.style.right = "-200px";
}

