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
            <td><button id="next-btn" onclick="showNext()" type="button">Next</button></td>

            <td><button onclick="calcscore()" type="button">Submit</button></a></td>
        </form>
    </div>  
</div>

</body>
<script>

    var id = <?php echo $_GET['id']; ?>;  // Test ID from URL
    var currentPage = 0; // Start from the first page
    var totalPages = 0; // Total number of pages, updated dynamically

    // Function to display the exercise for a specific page number
    function showex(pageNr = 0) {
        $.getJSON("api.php?c=studentquiz&id=" + id + "&page-nr=" + (pageNr + 1), function(res) {
            $("#sgamequiz").html(""); // Clear previous content
            totalPages = res.pages;   // Get the total number of pages

            // Get the exercise for the current page
           // for(z=0;z<=res.exercise.length;z++){
            var exercise = res.exercise[0];
            if (exercise) {
                // Display the exercise question
                $("#sgamequiz").append(`<h3>${ pageNr + 1 }. ${ exercise.vocalization }</h3>`);

                // Display possible answers
                let html1 = `<div style='margin-left:40px'>`;
                for (let j = 0; j < exercise.a.length; j++) {
                    html1 += `<p><input type="radio" name="aa${ exercise.id }" value="${ exercise.a[j].id }"> ${ exercise.a[j].text_of_answer }</p>`;
                }
                html1 += "</div>";
                $("#sgamequiz").append(html1);
            }
       // }
            // Update the visibility of the Next button
            if (pageNr >= totalPages - 1) {
                $("#next-btn").hide(); // Hide if it's the last page
            } else {
                $("#next-btn").show(); // Show otherwise
            }
        });
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
                endtime = Date.now();
                $.post("api.php?c=sendres&id=" + id + "&starttime=" + starttime.toString() + "&endtime=" + endtime.toString(), $("#frm100").serialize(), function(res) {
                    if (res == 1)
                        window.location.href = "ssubmitanswers.php?id=" + id;
                });
            }
        }, 1000);
    }

    // Function to submit the quiz
    function calcscore() {
        endtime = new Date();
        $.post("api.php?c=sendres&id=" + id + "&starttime=" + starttime.toString() + "&endtime=" + endtime.toString(), $("#frm100").serialize(), function(res) {
            if (res == 1)
                window.location.href = "ssubmitanswers.php?id=" + id;
        });
    }

</script>

