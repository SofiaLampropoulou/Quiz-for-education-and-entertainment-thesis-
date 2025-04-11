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
  let myquizChart = null;
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
  <label>Τίτλος ερώτησης:</label>
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

<form id=form3>
  <div class="form-group">
  <label>Επιλογή quiz και κάθε ερώτησής του:</label>
  <button id="button">Προβολή</button>
<select type="text" class="form-control" id="allquizes3" name=allquizes3> </select>
<script>

                                             $.getJSON("api.php?c=allquiz",(res)=>{
                                               
                                                for(i=0;i<res.length;i++)
                                                {
                                                    $("#allquizes3").append(`<option value='${ res[i].id }'>${ res[i].title }</option>`);
                                                }
                                            })
                                    </script>
                                    </div>

</form>
<div style='background-color:white' >
  <canvas id="myChart2" style="width: 400px; height: 80px;"></canvas>
</div>

</div>
<script>

  const ctx = document.getElementById('myChart');
  const ctx1 = document.getElementById('myChart1');
  const ctx2 = document.getElementById('myChart2');
  $("#form1").submit((event) => {
  event.preventDefault();
  
  const quizId = $("#allquizes").val();
  $.getJSON(`api.php?c=stats&id_test=${quizId}`, (res) => {
    let labels = [];
    let countStudents = [];
    let totalTries = res.totalTries;
    let averageScore = res.averageScore;
    let successfulStudents = res.successfulStudents;
    let successRate = res.successRate;
    let sumstudents= res.sumstudents;

    res.data.forEach(entry =>{ 
      countStudents.push(entry.student_count );
      labels.push(entry.score);
     // totalTries += entry.student_count ; // Sum of tries
      //totalScore += entry.score ; // Weighted score
//      totalScore += (entry.score ) * (entry.student_count ); // Weighted score

    });
  //  const averageScore = totalTries > 0 ? (totalScore / totalTries).toFixed(2) : 0;

      // Destroy the old chart instance if it exists
      if (quizChart) {
        quizChart.destroy();
      }



  /*  quizChart = new Chart(ctx, {
      type: 'bar',
      data: {
        labels: ['Ποσοστό επιτυχίας για το quiz:0', '1', '2', '3', '4', '5', '6', '7', '8', '9', '10'],
       // label: `Σύνολο προσπαθειών: ${totalTries}, Μέσος όρος: ${averageScore}`,
        datasets: [{  label: `Σύνολο προσπαθειών: ${totalTries}, Μέσος όρος: ${averageScore}`,
           data: countStudents, borderWidth: 1 }]
      },
      options: { scales: { y: { beginAtZero: true } } }
    });
  }).fail((jqxhr, textStatus, error) => {
    console.error("Request Failed: " + textStatus + ", " + error);
  });
})*/
quizChart = new Chart(ctx, {
      type: 'bar',
      data: {
        labels: labels,
        datasets: [{
          label: `Συνολικά Συστατικά: Σύνολο προσπαθειών: ${totalTries}, Μέσος όρος βαθμολογιών: ${averageScore}, Αριθμός επιτυχόντων: ${successfulStudents}, Ποσοστό επιτυχίας: ${successRate}%`,
          data: countStudents,
        //  backgroundColor: 'rgba(75, 192, 192, 0.2)',
        //  borderColor: 'rgba(75, 192, 192, 1)',
          borderWidth: 1
        }]
      },
     // options: { scales: { y: { beginAtZero: true } } }
     options: { scales: { y: { beginAtZero: true,
        title: {
              display: true,
              text: 'Πλήθος'  // Label for the y-axis
            }
       },
       x: {
            title: {
              display: true,
              text: 'Βαθμολογία'  // Label for the x-axis
            }
          }
      } }
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
        const correctPercentage = res.correctPercentage;
        const falsePercentage = res.falsePercentage;
        const unansweredPercentage = res.unansweredPercentage;
        
        // Data for the horizontal axis (selections)
        const labels1 = ['Σωστή', 'Λάθος', "Αναπάντητη"];
        const data1 = [correctPercentage, falsePercentage, unansweredPercentage];

        // Destroy the old chart instance if it exists
        if (exerciseChart) {
            exerciseChart.destroy();
        }

        // Create a new chart instance with the updated data
        exerciseChart = new Chart(ctx1, {
            type: 'bar',
            data: {
                labels: labels1,
                datasets: [{
                    label: `Ποσοστό σωστών απαντήσεων:${correctPercentage}`,
                    data: data1,
                    borderWidth: 1
                }]
            },
            options: { scales: { y: { beginAtZero: true, max: 100,
        title: {
              display: true,
              text: 'Ποσοστό  (%)'  // Label for the y-axis
            }
       },
       x: {
            title: {
              display: true,
              text: 'Άσκηση'  // Label for the x-axis
            }
          }
      } }
          
        });
    }).fail((jqxhr, textStatus, error) => {
        console.error("Request Failed:", textStatus, error);
    });
});

$("#form3").submit((event) => {
  event.preventDefault();
  
  const myquizId = $("#allquizes3").val();
  $.getJSON(`api.php?c=mystats&id_test=${myquizId}`, (res) => {
    let labels2 = [];
    let scores2=[];
   // let totalscores2=[];
   // let exerscore=[];
  // if (res.data && res.data.length > 0) {
    res.data.forEach(entry =>{ 
      labels2.push(entry.vocalization);
      scores2.push(entry.exercise_score);  // Student's score for the quiz
    //  totalscores2.push(entry.totalscore);
     // exerscore.push(entry.exercise_score)
      //vocalization.push(entry.vocalization)
    });
// Calculate the total score from the response
const totalQuizScore = res.total_score;  // Get the total quiz score from the response
//const totalQuizScore = parseFloat(res.total_score);

      if (myquizChart) {
        myquizChart.destroy();
      }



myquizChart = new Chart(ctx2, {
      type: 'bar',
      data: {
        labels: labels2,
        datasets: [{
            label: `Σύνολο Βαθμολογίας: ${totalQuizScore}`,  // Display the total quiz score as the label
            data: scores2,
        //  backgroundColor: 'rgba(75, 192, 192, 0.2)',
        //  borderColor: 'rgba(75, 192, 192, 1)',
          borderWidth: 1
        }]
      },
      options: { scales: { y: { beginAtZero: true,
        title: {
              display: true,
              text: 'Βαθμολογία'  // Label for the y-axis
            }
       },
       x: {
            title: {
              display: true,
              text: 'Άσκηση'  // Label for the x-axis
            }
          }
      } }
    });
    
  }).fail((jqxhr, textStatus, error) => {
    console.error("Request Failed:", textStatus, error);
  });
});


</script>

</div>


