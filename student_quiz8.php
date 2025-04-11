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
    let id = <?php echo $_GET['id']; ?>; // Lesson ID

    // Fetch quizzes from the backend
    $.getJSON("api.php?c=allstudentquiz&id=" + id, (res) => {
        $("#squiz").html("");  // Clear the table body before appending new content

        for (let i = 0; i < res.length; i++) {
            let buttonHtml = '';
            let doneMessage = '';
            
            // Check if the student has completed the quiz
            if (res[i].completed == 1) {
                doneMessage = "<span>Έγινε</span>";  // Show 'Done' if the quiz is completed
            } else {
                buttonHtml = `<a href='game_squiz5.php?id=${res[i].id}'><button class='open-quiz' data-quiz-id='${res[i].id}'>Άνοιγμα</button></a>`; // Show 'Άνοιγμα' button
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

showstudentquizes();  // Call the function to load quizzes when the page is loaded
</script>
