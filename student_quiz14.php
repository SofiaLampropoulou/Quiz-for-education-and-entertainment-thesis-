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
            <tr><th>Τίτλος</th><th>Συνολικός χρόνος σε λεπτά</th><th>Ημερομηνία δημιουργίας</th><th>Δράση</th></tr>
            <tbody id="squiz"></tbody>
        </table>
    </div>
</div>
</body>
<script>
function showstudentquizes() {
    const lessonId = <?php echo $_GET['id']; ?>;  // Get lesson ID
    const studentId = <?php echo $_SESSION['usrid']; ?>;  // Logged-in student ID

    $.getJSON("api.php?c=allstudentquiz&id=" + lessonId, (res) => {
        $("#squiz").html("");  // Clear the quizzes table

        res.forEach(quiz => {
            // Log to check what we receive for completed
           // console.log("Quiz ID: " + quiz.id + " Completed: " + quiz.completed);
           // let buttonHTML = "";
            // Determine if the quiz is completed by the current student
           //const completed = quiz.completed;
           const completed = Number(quiz.completed);  // Ensure it's a number
            
            let buttonHTML = "";
            if (completed === 0) {
                // If quiz is not completed, show the "Open" button
                buttonHTML = `<a href='game_squiz6.php?id=${quiz.id}'><button>Άνοιγμα</button></a>`;
               // completed === 1;
            } 
            else if (completed === 1) {
                // If quiz is completed, don't show the button
                buttonHTML = "<button disabled>Έγινε</button>";
                //buttonHTML = `<a href='game_squiz6.php?id=${quiz.id}'><button disabled>Έγινε</button></a>`;
            }

            // Append quiz row to the table
            $("#squiz").append(`
                <tr>
                    <td>${quiz.title}</td>
                    <td>${quiz.total_time}</td>
                    <td>${quiz.date_of_creation}</td>
                    <td>${buttonHTML}</td>
                </tr>
            `);
        });
    });
}

// Call the function to display quizzes
showstudentquizes();
</script>
