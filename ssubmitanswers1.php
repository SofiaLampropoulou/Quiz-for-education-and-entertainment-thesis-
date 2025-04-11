<?php
include "header.php";
include "menu.php";
?>
<body>
<div class="container">
    <h1 id="title5"></h1>
    <div class="othoni">
        <p>Ώρα έναρξης: <span id="starttime"></span></p>
        <p>Ώρα λήξης: <span id="endtime"></span></p>
        <p>Score: <span id="score"></span></p>
        <h2>Απαντήσεις</h2>
        <table class="table table-hover">
            <thead>
                <tr><th>Ερώτηση</th><th>Απάντηση</th><th>Αποτέλεσμα</th><th>Σωστή Απάντηση</th></tr>
            </thead>
            <tbody id="smakequiz">
            </tbody>
        </table>
    </div>
</div>

</body>
<script>
    var id = <?php echo $_GET['id']; ?>; // Get the test ID from the URL

    // Function to show all answers, student's answers, correctness, and correct answers
    function showanswers() {
        $.getJSON("api.php?c=ssubmit&id=" + id, function(res) {
            $("#starttime").html(res.start_time);
            $("#endtime").html(res.end_time);
            $("#score").html(res.score);

            $("#smakequiz").html(""); // Clear previous content

            // Loop through each question and display its details
            for (var i = 0; i < res.qa.length; i++) {
                var question = res.qa[i].vocalization;
                var answer = res.qa[i].text_of_answer;
                var result = res.qa[i].true_false == 1 ? "Correct" : "Error";
                var correctAnswer = res.qa[i].feedback;

                // Append the data to the table
                $("#smakequiz").append(`
                    <tr>
                        <td>${question}</td>
                        <td>${answer}</td>
                        <td>${result}</td>
                        <td>${correctAnswer}</td>
                    </tr>
                `);
            }
        });
    }

    // Fetch and display the test title and other info
    $.getJSON("api.php?c=onesubmission&id=" + id, function(res) {
        $("#title5").html(res.title); // Set the test title
    });

    // Call the function to display the answers
    showanswers();
</script>
