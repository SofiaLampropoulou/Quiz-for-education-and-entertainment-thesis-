<?php
include "header.php";
?>
<?php
include "menu.php";
?>

<body>

<div class="container">

    <h1 id="title5"></h1>
    <div class="othoni">
    Ώρα έναρξης: <span id=starttime></span><br>
    Ώρα λήξης: <span id=endtime></span><br>
   
    <span style="font-weight: bold;">Score:</span> <span id="score"></span>/10<br>

    <h2>Απαντήσεις</h2>
    <table class="table table-hover">
        <tr><th>Ερώτηση</th><th>Απαντήση</th><th>Αποτέλεσμα</th><th>Σωστή Απάντηση</th></tr>
            <tbody id="smakequiz">
            </tbody>
        </table>
        
            
            </div>
            
    </div>
</div>


        </body>

       

        <script>
            
             var id=<?php echo $_GET['id']; ?>;
        //  Score: <span id=score></span>/10<br>
            function showanswers(){
               //  <span style="font-weight: bold;">Score:</span> <span style="font-weight: bold;" id="score"></span><br>
            
                $.getJSON("api.php?c=ssubmit&id="+id,(res)=>{
                    $("#starttime").html(res.start_time);
                    $("#endtime").html(res.end_time);
                    $("#score").html(res.score);
                
                

                    $("#smakequiz").html("");
                  /*  res.forEach((quiz) => {
                        quiz.qa.forEach((qaItem) => {
                            $("#smakequiz").append(`<tr>
                        <td>${index + 1}. ${qaItem.vocalization}</td>
                        <td>${qaItem.text_of_answer}</td>
                        <td>${qaItem.true_false == 1 ? "Correct" : "Error"}</td>
                        <td>${qaItem.feedback}</td>
                    </tr>`);*/
                    
                    for (i=0;i<res.qa.length;i++) 
                    {

                        $("#smakequiz").append(`<tr><td>${res.qa[i].vocalization}</td>
                        <td>${res.qa[i].text_of_answer}</td>
                        <td>${res.qa[i].true_false==1?"Correct":"Error"}</td>
                        <td>${res.qa[i].feedback}</td></tr>`);
                    }
                   // });
                   /* $("#smakequiz").append(`<tr>
                        <td>${qaItem.vocalization}</td>
                        <td>${qaItem.text_of_answer}</td>
                        <td>${qaItem.true_false == 1 ? "Correct" : "Error"}</td>
                        <td>${qaItem.feedback}</td>
                    </tr>`);*/
                
            });
            markQuizAsCompleted();  // Mark quiz as completed after submitting
        
            }
        
            function markQuizAsCompleted() {
        const studentId = <?php echo $_SESSION['usrid']; ?>;  // Get logged-in student ID
        $.get("api.php?c=set_completed&id=" + id + "&completed=1&student_id=" + studentId, function(res) {
            const result = JSON.parse(res);
            if (result.status === "success") {
              
                console.log("Quiz marked as completed.");
           //    if (status.completed=1){
              //  refreshQuizzes();
                showstudentquizes();  
            //   }// Refresh the quizzes list to reflect the new completion status
            } else {
                alert("Failed to mark quiz as completed.");
            }
            
        });
    }
  /*  function refreshQuizzes() {
    const lessonId = <?php echo $_GET['id']; ?>;  // Get lesson ID
    $.getJSON("api.php?c=allstudentquiz&id=" + lessonId, (res) => {
        console.log(res);  // Log the response to check if 'completed' field is 1
        if (res.status === "error") {
            console.error("Error fetching quizzes:", res.message);
            return;
        }
        $("#squiz").html("");  // Clear the quizzes table

        res.forEach(quiz => {
            const completed = Number(quiz.completed);  // Ensure it's a number

            let buttonHTML = "";
            if (completed === 0) {
                // If quiz is not completed, show the "Open" button
                buttonHTML = `<a href='game_squiz6.php?id=${quiz.id}'><button>Άνοιγμα</button></a>`;
            } else if (completed === 1) {
                // If quiz is completed, show the "Done" button
                buttonHTML = "<button disabled>Έγινε</button>";
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
}*/


        
        $.getJSON("api.php?c=onesubmission&id="+id,(res)=>{
            $("#title5").html(res.title);

});
showanswers();

</script>
