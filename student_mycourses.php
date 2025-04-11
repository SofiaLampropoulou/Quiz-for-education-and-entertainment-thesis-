
<?php
include "header.php";
?>

<?php
include "menu.php";
?>
<body>

<div class="container">

 <h1>My courses</h1>
 <div class="othoni">

        
   
  
        <table class="table table-hover">
        <tr><th>Τίτλος</th><th>Περιγραφή</th></tr>
            <tbody id="smycourses">
            </tbody>
        </table>
    </div>
    </div>
</div>


        </body>
        <script>
       


       /* function showmycourses(){
           
            
        
                $.getJSON("api.php?c=allmycourses",(res)=>{
            
                $("#smycourses").html("");
                for (i=0;i<res.length;i++)
                {
                    $("#smycourses").append(`<tr><td>${res[i].name}</td><td>${res[i].description}</td>
                            <td><a href='student_quiz.php?id=${res[i].id_lesson}'><button >Quizes</button></a></td>
                            <td><button onclick='del(${res[i].id})'>Διαγραφή</button></td>`)
                }
            });
        
         
        }
     
        function del(id)
        {
            c=confirm("Θέλετε σίγουρα να διαγράψετε αυτό το μάθημα;");
            if(c)
            {
                $.get("api.php?c=dellesson&id="+id,(res)=>{
                    showmycourses();
                });
            }
        }*/

       
        function showmycourses() {
    $.getJSON("api.php?c=allmycourses", (res) => {
        $("#smycourses").html("");
        for (let i = 0; i < res.length; i++) {
            $("#smycourses").append(`
                <tr>
                    <td>${res[i].name}</td>
                    <td>${res[i].description}</td>
                    <td><a href='student_quiz14.php?id=${res[i].id_lesson}'><button >Quizes</button></a></td>
                    <td><button onclick='del(${res[i].id_lesson})'>Διαγραφή</button></td>
                </tr>
            `);
        }
    });
}

function del(id) {
    const c = confirm("Θέλετε σίγουρα να διαγράψετε αυτό το μάθημα;");
    if (c) {
        $.get("api.php?c=dellesson&id=" + id, (res) => {
            if (res === "ok") {
                showmycourses();
            } else {
                alert("Error deleting course.");
            }
        });
    }
}
showmycourses();
          </script>