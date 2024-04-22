
<?php
include "header.php";
?>

<?php
include "menu.php";
?>
<body>

<div class="container">

 <h1>Quiz</h1>
 <div class="othoni">

        
   
  
        <table class="table table-hover">
        <tr><th>Τίτλος</th><th>Συνολικός χρόνος</th><th>Ημερομηνία δημιουργίας</th></tr>
            <tbody id="squiz">
            </tbody>
        </table>
    </div>
    </div>
</div>


        </body>
        <script>
       


        function showquizes(){
            $.getJSON("api.php?c=allquiz",(res)=>{
                $("#squiz").html("");
        for (i=0;i<res.length;i++)
        {
            $("#squiz").append(`<tr><td>${res[i].title}</td><td>${res[i].total_time}</td><td>${res[i].date_of_creation}</td>
            <td><a href='game_squiz.php?id=${res[i].id}'><button >Άνοιγμα</button></a>`)
        }
            });
        }
     
           


        showquizes();
          </script>