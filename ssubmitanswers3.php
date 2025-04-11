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
    Ώρα έναρξης:<span id=starttime></span><br>
    Ώρα λήξης:<span id=endtime></span><br>
    Score: <span id=score></span><br>
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
    var id = <?php echo $_GET['id']; ?>;

    function showanswers() {
        $.getJSON("api.php?c=ssubmit&id=" + id, (res) => {
            $("#smakequiz").html("");

            res.forEach((quiz, quizIndex) => {
                // Display each quiz's start time, end time, and score (if needed)
                $("#starttime").html(quiz.start_time);
                $("#endtime").html(quiz.end_time);
                $("#score").html(quiz.score);

                quiz.qa.forEach((qaItem, index) => {
                    $("#smakequiz").append(`<tr>
                        <td>${index + 1}. ${qaItem.vocalization}</td>
                        <td>${qaItem.text_of_answer}</td>
                        <td>${qaItem.true_false == 1 ? "Correct" : "Error"}</td>
                        <td>${qaItem.feedback}</td>
                    </tr>`);
                });
            });
        });
    }

    $.getJSON("api.php?c=onesubmission&id=" + id, (res) => {
        $("#title5").html(res.title);
    });

    showanswers();
</script>
