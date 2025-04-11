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
     <tbody id="squiz"></tbody>
   </table>
 </div>
</div>

</body>
<script>
function showstudentquizes() {
    let studentId = <?php echo $_GET['student_id']; ?>; // Pass the logged-in student's ID
    
    id = <?php echo $_GET['id']; ?>;  // lesson ID
    
    $.getJSON("api.php?c=allstudentquiz&id=" + id, (res) => {
        $("#squiz").html(""); // Clear the table body before appending new content
        
        for (let i = 0; i < res.length; i++) {
            let buttonHtml = '';
            let doneMessage = '';
            let quizId = res[i].id;
            
            // Use the student ID to track if this specific student has completed the quiz
            let localStorageKey = "quiz_" + quizId + "_student_" + studentId + "_completed";
            
            // Check if the quiz is already marked as completed for this student in local storage
            if (localStorage.getItem(localStorageKey) === "1") {
                doneMessage = "<span>Έγινε</span>";  // Show 'Done' if quiz is completed
            } else {
                buttonHtml = `<button class='open-quiz' data-quiz-id='${quizId}'>Άνοιγμα</button>`; // Show 'Άνοιγμα' button
            }
            
            // Append the quiz to the table
            $("#squiz").append(`
                <tr>
                    <td>${res[i].title}</td>
                    <td>${res[i].total_time}</td>
                    <td>${res[i].date_of_creation}</td>
                    <td>
                        ${doneMessage}
                        ${buttonHtml}
                    </td>
                </tr>
            `);
        }
    });
}

// Event listener for clicking on the 'Άνοιγμα' button
$(document).on("click", ".open-quiz", function(event) {
    let quizId = $(this).data('quiz-id');  // Get quiz ID from button data
    let studentId = <?php echo $_GET['student_id']; ?>; // Pass the logged-in student's ID
    
    // Create the localStorage key for the student and quiz
    let localStorageKey = "quiz_" + quizId + "_student_" + studentId + "_completed";
    
    // Mark the quiz as completed for this student in localStorage
    localStorage.setItem(localStorageKey, "1");
    
    // Replace the 'Άνοιγμα' button with 'Done' message
    $(this).replaceWith("<span>Done</span>");
    
    // Optionally: Redirect to the quiz game page
    window.location.href = `game_squiz5.php?id=${quizId}`;
});

// Load all student quizzes when the page is loaded
showstudentquizes();
</script>
