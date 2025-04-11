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
  <button id="button">Show</button>
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
  <button id="button">Show</button>
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
$("#form1").submit((event)=>{
  //$("#form1").text("check");
  event.preventDefault();
  $.getJSON("api.php?c=stats",(res)=>{
    //console.log(res);

  var countStudents = Array();
  res.forEach(function (entry){
    var numStudent = entry.student_count;
    countStudents.push(numStudent);
  });
   // console.log(countStudents);
  new Chart(ctx, {
    type: 'bar',
    data: {
      labels: ['Ποσοστό επιτυχίας για το quiz:0','1','2','3','4','5','6','7','8','9','10'],
      datasets: [{
        label: '#',
        data: countStudents,
        borderWidth: 1
      }]
    },
    options: {
      scales: {
        y: {
          beginAtZero: true
        }
      }
    }
  });
}
).fail((jqxhr, textStatus, error) => {
    console.error("Request Failed: " + textStatus + ", " + error);
  });
})


  //const ctx = document.getElementById('myChart1');

$("#form2").submit((event)=>{
  //$("#form1").text("check");
  event.preventDefault();
  $.getJSON("api.php?c=exerstats",(res)=>{
    //console.log(res);

  var countStudents1 = Array();
  res.forEach(function (entry){
    var numStudent1 = entry.student_count;
    countStudents1.push(numStudent1);
  });
   // console.log(countStudents);
  new Chart(ctx1, {
    type: 'bar',
    data: {
      labels: ['Ποσοστό επιτυχίας για την exercise:0','1','2','3','4','5','6','7','8','9','10'],
      datasets: [{
        label: '#',
        data: countStudents1,
        borderWidth: 1
      }]
    },
    options: {
      scales: {
        y: {
          beginAtZero: true
        }
      }
    }
  });
}
).fail((jqxhr, textStatus, error) => {
    console.error("Request Failed: " + textStatus + ", " + error);
  });
})
</script>

</div>


