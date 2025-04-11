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
    id = <?php echo $_GET['id']; ?>;
    
    $.getJSON("api.php?c=allstudentquiz&id=" + id, (res) => {
        $("#squiz").html(""); // Clear the table body before appending new content
        
        for (let i = 0; i < res.length; i++) {
            let buttonHtml = '';
            let doneMessage = '';
            let quizId = res[i].id;
            
            // Check if the quiz is already marked as completed in local storage
            if (localStorage.getItem("quiz_" + quizId + "_completed") === "1") {
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
    
    // Simulate quiz taking, and mark it as completed
    localStorage.setItem("quiz_" + quizId + "_completed", "1");
    
    // Replace the 'Άνοιγμα' button with 'Done' message
    $(this).replaceWith("<span>Done</span>");
    
    // Optionally: Redirect to the quiz game page
    window.location.href = `game_squiz5.php?id=${quizId}`;
});

showstudentquizes();  // Call the function to load quizzes when the page is loaded
</script>