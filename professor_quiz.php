
<?php
include "header.php";
?>

<?php
include "menu.php";
?>
<body>

<div class="container">

 <h1>Τα quiz μου</h1>
 <div class="othoni">

        
   
  
        <table class="table table-hover">
        <tr><th>Τίτλος</th><th>Συνολικός χρόνος</th><th>Ημερομηνία δημιουργίας</th></tr>
            <tbody id="quiz">
            </tbody>
        </table>
    </div>
    </div>
</div>


        </body>
        <script>
       


        function showquizes(){
            $.getJSON("api.php?c=allquiz",(res)=>{
                $("#quiz").html("");
        for (i=0;i<res.length;i++)
        {
            $("#quiz").append(`<tr><td>${res[i].title}</td><td>${res[i].total_time}</td><td>${res[i].date_of_creation}</td><td><button onclick='del(${res[i].id})'>Διαγραφή</button></td>`)
        }
            });
        }
     
            function del(id)
        {
            c=confirm("Θέλετε σίγουρα να διαγράψετε αυτό το quiz;");
            if(c)
            {
                $.get("api.php?c=delquiz&id="+id,(res)=>{
                    showquizes();   
                });
            }
        }


        showquizes();
          </script>