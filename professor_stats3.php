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
   // Declare variables to store chart instances
   let quizChart = null;
  let exerciseChart = null;
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

  const ctx = document.getElementById('myChart');
  const ctx1 = document.getElementById('myChart1');
  $("#form1").submit((event) => {
  event.preventDefault();
  
  const quizId = $("#allquizes").val();
  $.getJSON(`api.php?c=stats&id_test=${quizId}`, (res) => {
    let labels = [];
    let countStudents = [];
    let totalTries = 0;
    let totalScore = 0;


    res.forEach(entry =>{ 
        labels.push(entry.score);
        countStudents.push(entry.student_count || 0 );
      totalTries += entry.student_count || 0; // Sum of tries
      totalScore += (entry.score || 0) * (entry.student_count || 0); // Weighted score
    });
    const averageScore = totalTries > 0 ? (totalScore / totalTries).toFixed(2) : 0;

      // Destroy the old chart instance if it exists
      if (quizChart) {
        quizChart.destroy();
      }

      quizChart = new Chart(ctx, {
      type: 'bar',
      data: {
        labels: labels,
        datasets: [{
          label: `Σύνολο προσπαθειών: ${totalTries}, Μέσος όρος: ${averageScore}`,
          data: countStudents,
          borderWidth: 1
        }]
      },
      options: { scales: { y: { beginAtZero: true } } }
    });
  }).fail((jqxhr, textStatus, error) => {
    console.error("Request Failed:", textStatus, error);
  });
});



  //const ctx = document.getElementById('myChart1');

  $("#form2").submit((event) => {
  event.preventDefault();
  
  const exerciseId = $("#allexercises").val();
  $.getJSON(`api.php?c=exerstats&id_exercise=${exerciseId}`, (res) => {
    var countStudents1 = [];
    var totalTries = 0;
      var totalScore = 0;
    res.forEach(entry => {countStudents1.push(entry.exercise_count);
      totalTries += entry.exercise_count; // Sum of tries
      totalScore += entry.score * entry.exercise_count; // Weighted score
    });
    const averageScore = totalTries > 0 ? (totalScore / totalTries).toFixed(2) : 0;

      // Destroy the old chart instance if it exists
      if (exerciseChart) {
        exerciseChart.destroy();
      }
            // Create a new chart instance

      exerciseChart =  new Chart(ctx1, {
      type: 'bar',
      data: {
        labels: ['Ποσοστό επιτυχίας για την exercise:0', '1', '2', '3', '4', '5', '6', '7', '8', '9', '10'],
        datasets: [{ label: `Σύνολο προσπαθειών: ${totalTries}, Μέσος όρος: ${averageScore}`,
           data: countStudents1, borderWidth: 1 }]
      },
      options: { scales: { y: { beginAtZero: true } } }
    });
  }).fail((jqxhr, textStatus, error) => {
    console.error("Request Failed: " + textStatus + ", " + error);
  });
})

</script>

</div>


