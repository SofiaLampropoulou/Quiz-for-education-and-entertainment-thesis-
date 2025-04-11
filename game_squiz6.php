<?php
include "header.php";
include "menu.php";
?>

<body>
<div class="container">
    <h1 id="title4"></h1>
    <div class="othoni">
        <div id="timeshow"></div>  
        <form id="frm100">      
            <div id="sgamequiz"></div>

            <!-- Next Button -->
            <td><button id="next-btn" onclick="showNext()" type="button">Επόμενο</button></td>

            <td><button onclick="calcscore()" type="button">Υποβολή</button></a></td>
        </form>
    </div>  
</div>

</body>


<script>

    var id = <?php echo $_GET['id']; ?>;  // Test ID from URL
    var currentPage = 0; // Start from the first page
    var totalPages = 0; // Total number of pages, updated dynamically
    var selectedAnswers = {}; // Store answers for each page

    // Function to display the exercise for a specific page number
    function showex(pageNr = 0) {
        $.getJSON("api.php?c=studentquiz&id=" + id + "&page-nr=" + (pageNr + 1), function(res) {
            $("#sgamequiz").html(""); // Clear previous content
            totalPages = res.pages;   // Get the total number of pages

            // Get the exercise for the current page
            var exercise = res.exercise[0];
            if (exercise) {
                // Display the exercise question
                $("#sgamequiz").append(`<h3>${ pageNr + 1 }. ${ exercise.vocalization }</h3>`);

                // Display possible answers and pre-select any previously selected answer
                let html1 = `<div style='margin-left:40px'>`;
                for (let j = 0; j < exercise.a.length; j++) {
                    const answerId = exercise.a[j].id;
                    const checked = selectedAnswers[exercise.id] === answerId ? "checked" : "";
                    html1 += `<p><input type="radio" name="aa${ exercise.id }" value="${ answerId }" ${checked} onclick="saveAnswer(${exercise.id}, ${answerId})"> ${ exercise.a[j].text_of_answer }</p>`;
                }
                html1 += "</div>";
                $("#sgamequiz").append(html1);
            }

            // Update the visibility of the Next button
            if (pageNr >= totalPages - 1) {
                $("#next-btn").hide(); // Hide if it's the last page
            } else {
                $("#next-btn").show(); // Show otherwise
            }
        });
    }

    // (NEA)Function to save selected answer for the current exercise
    function saveAnswer(exerciseId, answerId) {
        selectedAnswers[exerciseId] = answerId; // Save selected answer
    }

    // Function to load the next exercise
    function showNext() {
        if (currentPage < totalPages - 1) {
            currentPage++;  // Increment the page counter
            showex(currentPage); // Load the next exercise
        }
    }

    // Initial call to load the first exercise
    showex(0);

    // Fetch the test details (like title and total time)
    $.getJSON("api.php?c=onetest&id=" + id, function(res) {
        $("#title4").html(res[0].title);  // Display the test title
        starttimequiz(res[0].total_time); // Start the quiz timer
    });

    var xronometro;
    var timeq;
    var starttime = new Date();

    // Function to start the quiz timer
    function starttimequiz(t) {
        timeq = t * 60;
        xronometro = setInterval(function() {
            timeq -= 1;
            $("#timeshow").html(timeq + " sec");
            if (timeq == 0) {
                submitAnswers(); // Auto-submit on timer end
            }
        }, 1000);
    }

    // (NEA)Populate form with answers and submit
    function submitAnswers() {
        endtime = new Date();

        // Clear existing answer inputs in the form
        $("#frm100").find("input[type=hidden]").remove();

        // Add all selected answers to the form
        for (const [exerciseId, answerId] of Object.entries(selectedAnswers)) {
            $("#frm100").append(`<input type="hidden" name="aa${exerciseId}" value="${answerId}">`);
        }

        $.post("api.php?c=sendres&id=" + id + "&starttime=" + starttime.toString() + "&endtime=" + endtime.toString(), $("#frm100").serialize(), function(res) {
            if (res == 1){
          
                window.location.href = "ssubmitanswers.php?id=" + id; 
               //  markQuizAsCompleted();  // Mark quiz as completed after submitting
            }
        });
    }

   /* function markQuizAsCompleted() {
        const studentId = <?php echo $_SESSION['usrid']; ?>;  // Get logged-in student ID
        $.get("api.php?c=set_completed&id=" + id + "&completed=1&student_id=" + studentId, function(res) {
            const result = JSON.parse(res);
            if (result.status === "success") {
                console.log("Quiz marked as completed.");
            } else {
                alert("Failed to mark quiz as completed.");
            }
        });
    }*/


    // Function to submit the quiz manually
    function calcscore() {
        submitAnswers(); // Call the submit function
    }

</script>
