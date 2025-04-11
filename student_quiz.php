
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
        <tr><th>Τίτλος</th><th>Συνολικός χρόνος σε λεπτά</th><th>Ημερομηνία δημιουργίας</th></tr>
            <tbody id="squiz">
            </tbody>
        </table>
    </div>
    </div>
</div>


        </body>
        <script>
       


        function showstudentquizes(){
            id=<?php echo $_GET['id'];?>;
            
            $.getJSON("api.php?c=allstudentquiz&id="+id,(res)=>{
                $("#squiz").html("");
            for (i=0;i<res.length;i++)
            {
              
           
                $("#squiz").append(`<tr><td>${res[i].title}</td><td>${res[i].total_time}</td><td>${res[i].date_of_creation}</td>
                <td><a href='game_squiz5.php?id=${res[i].id}'><button >Άνοιγμα</button></a>`)
            }
            });
     
        }
     
           
        function hidedonequiz(){
            id=<?php echo $_GET['id'];?>;
            const currentCompleted = 0;
            const newcompleted = currentCompleted ? 0 : 1; // Toggle the completion status
            $.getJSON("api.php?c=notallstudentquiz&id="+id+ "&completed=" + newcompleted,(res)=>{
            $("#squiz").html("");
        for (i=0;i<res.length;i++)
        {
            $("#squiz").append(`<tr><td>${res[i].title}</td><td>${res[i].total_time}</td><td>${res[i].date_of_creation}</td></a>`)
        }
        });
        }
        
        showstudentquizes();
          </script>