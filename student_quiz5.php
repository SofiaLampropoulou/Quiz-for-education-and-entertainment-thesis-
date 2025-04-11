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
            
            if (res[i].completed == 1) {
                // Student has completed the quiz, show "Done" message
                doneMessage = "<span>Done</span>";
            } else {
                // Student has not completed the quiz, show "Άνοιγμα" button
                buttonHtml = `<a href='game_squiz5.php?id=${res[i].id}'><button class='open-quiz'>Άνοιγμα</button></a>`;
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

showstudentquizes();
</script>