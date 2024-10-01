
<?php
include "header.php";
?>

<?php
include "menu.php";
?>
<body>

<div class="container">

 <h1>Courses</h1>
 <div class="othoni">

        
   
  
        <table class="table table-hover">
        <tr><th>Τίτλος</th><th>Περιγραφή</th></tr>
            <tbody id="scourse">
            </tbody>
        </table>
    </div>
    </div>
</div>


        </body>
        <script>
            
       function insertmakequiz(id)
      {
              
                $.post("api.php?c=insertmakequiz&id="+id,(res2)=>{
                    if(res2=="ok"){
                    
                                    
                   window.location.href="student_mycourses.php?id="+id;
                    }
                    else
                {
                    $("#msgs").html(`<div class="alert alert-danger">
                                   Η εγγραφή σας είναι ανεπιτυχής.
                                    </div>`);
                }
                });

            
      }

        function showcourses(){
            $.getJSON("api.php?c=allcourses",(res)=>{
                $("#scourse").html("");
        for (i=0;i<res.length;i++)
        {
            $("#scourse").append(`<tr><td>${res[i].name}</td><td>${res[i].description}</td>
                    <td><button onclick= "insertmakequiz(${res[i].id})" >Εγγραφή</button></td>`)
        }
            });
        }
     
           

        
        showcourses();
          </script>