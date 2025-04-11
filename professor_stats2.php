<?php
include "header.php";
?>

<?php
include "menu.php";
?>

<div class="container">

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<h1>Στατιστικά</h1>

<div class=container>

  <form id=form1>
  <div class="form-group">
  <label>Τίτλος quiz:</label>
  <button id="button">Προβολή</button>
<select type="text" class="form-control" id="allquizes" name=allquizes> </select>
<script>
                                             $.getJSON("api.php?c=allquiz",(res)=>{
                                               
                                                for(i=0;i<res.length;i++)
                                                {
                                                    $("#allquizes").append(`<option value='${ res[i].id }'>${ res[i].title }</option>`);
                                                }
                                            })
                                    </script>
                                    </div>

</form>
<div style='background-color:white' >
  <canvas id="myChart" style="width: 400px; height: 80px;"></canvas>
</div>

<form id=form2>
  <div class="form-group">
  <label>Τίτλος άσκησης:</label>
  <button id="button">Προβολή</button>
<select type="text" class="form-control" id="allexercises" name=allexercises> </select>
<script>
                                             $.getJSON("api.php?c=allexercise",(res)=>{
                                               
                                                for(i=0;i<res.length;i++)
                                                {
                                                    $("#allexercises").append(`<option value='${ res[i].id }'>${ res[i].vocalization }</option>`);
                                                }
                                            })
                                    </script>
                                    </div>

</form>
<div style='background-color:white' >
  <canvas id="myChart1" style="width: 400px; height: 80px;"></canvas>
</div>


</div>

<script>
  let quizChart, exerciseChart; // Variables to store chart instances

  // Function to fetch and render quiz statistics
  async function fetchQuizStats() {
    const quizId = $("#allquizes").val();
    try {
      const response = await $.getJSON(`api.php?c=stats&id_test=${quizId}`);
      const countStudents = response.map(entry => entry.student_count);

      // Destroy existing chart if it exists
      if (quizChart) {
        quizChart.destroy();
      }

      // Create a new chart
      quizChart = new Chart(ctx, {
        type: 'bar',
        data: {
          labels: ['Ποσοστό επιτυχίας για το quiz: 0', '1', '2', '3', '4', '5', '6', '7', '8', '9', '10'],
          datasets: [{ label: '#', data: countStudents, borderWidth: 1 }]
        },
        options: { scales: { y: { beginAtZero: true } } }
      });
    } catch (error) {
      console.error("Error fetching quiz stats:", error);
    }
  }

  // Function to fetch and render exercise statistics
  async function fetchExerciseStats() {
    const exerciseId = $("#allexercises").val();
    try {
      const response = await $.getJSON(`api.php?c=exerstats&id_exercise=${exerciseId}`);
      const countStudents1 = response.map(entry => entry.exercise_count);

      // Destroy existing chart if it exists
      if (exerciseChart) {
        exerciseChart.destroy();
      }

      // Create a new chart
      exerciseChart = new Chart(ctx1, {
        type: 'bar',
        data: {
          labels: ['Ποσοστό επιτυχίας για την exercise: 0', '1', '2', '3', '4', '5', '6', '7', '8', '9', '10'],
          datasets: [{ label: '#', data: countStudents1, borderWidth: 1 }]
        },
        options: { scales: { y: { beginAtZero: true } } }
      });
    } catch (error) {
      console.error("Error fetching exercise stats:", error);
    }
  }

  // Attach event listeners to forms
  $("#form1").submit((event) => {
    event.preventDefault(); // Prevent form submission
    fetchQuizStats();
  });

  $("#form2").submit((event) => {
    event.preventDefault(); // Prevent form submission
    fetchExerciseStats();
  });
</script>
</div>