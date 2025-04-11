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

    var id = <?php echo $_GET['id']; ?>; // The ID of the test
    var cor = []; // Store exercises
    var currentPage = 0; // Start from the first exercise
    var totalPages = 0; // Total number of exercises, updated dynamically

    // Function to show a specific exercise based on the page number
    function showex(pageNr = 0){
        $.getJSON("api.php?c=studentquiz&id=" + id + "&page-nr=" + (pageNr + 1), (res) => {
            $("#sgamequiz").html(""); // Clear previous content
            cor = res.exercise;
            totalPages = res.pages; // Set total pages to the number of exercises

            // Show only the exercise for the current page
            if (cor.length && cor[pageNr]) {
                $("#sgamequiz").append(` <h3>${ pageNr + 1 }. ${ cor[pageNr]["q"].vocalization }</h3>`);
                let html1 = `<div style='margin-left:40px'>`;
                for (let j = 0; j < cor[pageNr].a.length; j++) {
                    html1 += ` <p><input type="radio" name="aa${ cor[pageNr].id }" value='${ cor[pageNr].a[j].id }'> ${ cor[pageNr].a[j].text_of_answer }</p>`;
                }
                html1 += "</div>";
                $("#sgamequiz").append(html1);
            }

            // Show/Hide Next button depending on the current page
            if (pageNr >= totalPages - 1) {
                $("#next-btn").hide(); // Hide Next button on the last page
            } else {
                $("#next-btn").show(); // Show Next button otherwise
            }
        });
    }
showex(0);
    // Function to load the next exercise
    function showNext() {
        if (currentPage < totalPages - 1) {
            currentPage++;
            showex(currentPage); // Load the next exercise
        }
    }

    // Initial call to load the first exercise
    

    // Fetch the test details like title and time
    $.getJSON("api.php?c=onetest&id=" + id, (res) => {
        $("#title4").html(res[0].title);
        starttimequiz(res[0].total_time);
    });

    var xronometro;
    var timeq;
    var starttime = new Date();

    function starttimequiz(t) {
        timeq = t * 60;
        xronometro = setInterval(function() {
            timeq -= 1;
            $("#timeshow").html(timeq + " sec");
            if (timeq == 0) {
                endtime = Date.now();
                $.post("api.php?c=sendres&id=" + id + "&starttime=" + starttime.toString() + "&endtime=" + endtime.toString(), $("#frm100").serialize(), (res) => {
                    if (res == 1)
                        window.location.href = "ssubmitanswers.php?id=" + id;
                });
            }
        }, 1000);
    }

    function calcscore() {
        endtime = new Date();
        $.post("api.php?c=sendres&id=" + id + "&starttime=" + starttime.toString() + "&endtime=" + endtime.toString(), $("#frm100").serialize(), (res) => {
            if (res == 1)
                window.location.href = "ssubmitanswers.php?id=" + id;
        });
    }

</script>
