<?php
include "header.php";
?>

<?php
include "menu.php";
?>
<body>

<div class="container">

 <h1>Quiz</h1>
 <div class="othoni">

        
   
  
        <table class="table table-hover">
        <tr><th>Τίτλος</th><th>Συνολικός χρόνος σε λεπτά</th><th>Ημερομηνία δημιουργίας</th></tr>
            <tbody id="squiz">
            </tbody>
        </table>
    </div>
    </div>
</div>


        </body>
        <script>
       

function showstudentquizes() {
  
    const studentId = <?php echo $_SESSION['usrid']; ?>;

    $.getJSON("api.php?c=allstudentquiz", (res) => {
        $("#squiz").html("");  // Clear any existing quizzes

        res.forEach(quiz => {
            // Determine button text based on completion status
            const buttonText = quiz.completed ? "Done" : "Open";  // If completed, show "Done"
            const buttonClass = quiz.completed ? "btn-success" : "btn-secondary";  // Style the button

            // Append the quiz to the table
            $("#squiz").append(`
                <tr>
                    <td>${quiz.title}</td>
                    <td>${quiz.total_time}</td>
                    <td>${quiz.date_of_creation}</td>
                    <td>
                        <button onclick="handleButtonClick(${quiz.id}, ${quiz.completed}, ${studentId})"
                            class="btn ${buttonClass}" id="completed-btn-${quiz.id}">
                            ${buttonText}
                        </button>
                    </td>
                </tr>
            `);
        });
    });
}

// Function to handle button click
function handleButtonClick(quizId, currentCompleted, studentId) {
    if (currentCompleted === 0) {
        // If the quiz is not completed, redirect to the quiz page
        window.location.href = "game_squiz5.php?quiz_id=" + quizId;
    } else {
        // If the quiz is already completed, show a "Done" message
        alert("You have already completed this quiz.");
    }
}

// Function to set the completion status of a quiz (for backend)
function setcompleted(quizId, currentCompleted, studentId) {
    const newCompleted = currentCompleted ? 0 : 1; // Toggle the completion status

    $.get("api.php?c=set_completed&id=" + quizId + "&completed=" + newCompleted + "&student_id=" + studentId, (res) => {
        const result = JSON.parse(res);
        if (result.status === "success") {
            // Update the button text and style based on completion
            const button = $("#completed-btn-" + quizId);
            if (newCompleted === 1) {
                button.text("Done").removeClass("btn-secondary").addClass("btn-success");
            } else {
                button.text("Open").removeClass("btn-success").addClass("btn-secondary");
            }
        } else {
            alert("Failed to update quiz completion. Please try again.");
        }
    });
}

// Load the quizzes for the logged-in student
showstudentquizes();
</script>