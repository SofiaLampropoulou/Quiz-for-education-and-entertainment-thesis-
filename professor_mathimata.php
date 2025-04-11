<?php
include "header.php";
?>

<?php
include "menu.php";
?>
<body>

<div class="container">
    <h1>Διαχείρηση μαθημάτων</h1>
    <div class="othoni">
 

          
            <button class="btn btn-primary" data-toggle="modal" data-target="#catModal" >Νέα κατηγορία/Νέο μάθημα</button>
            <table class="table table-hover">
            <tr><th>Όνομα</th><th>Περιγραφή</th></tr>
                <tbody id="categories">
                </tbody>
            </table>
                
        </div>
       
        
    </div>
</div>




    <!-- Modal -->
<div id="catModal" class="modal fade" role="dialog">
    <div class="modal-dialog">

<!-- Modal content-->
<div class="modal-content">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Νέο μάθημα</h4>
    </div>
    <div class="modal-body">
        
        <form id="formc" >
           <div class="form-group">
            <br><label for="cat">Μάθημα</label></br>

           <br> <input type="text" class="form-control" id="cat" name="cat" placeholder="Όνομα μαθήματος" required></br>
            
           <br> <input type="text" class="form-control" id="description" name="description" placeholder= "Περιγραφή μαθήματος" required></br>

           

              </div>
             
              <button type="submit" class="btn btn-success">Αποθήκευση</button> 
              <button type="reset" class="btn btn-danger">Καθαρισμός</button>
            
          </form>
        

    </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button> 
        </div>
 </div>
 </div>
</div>

 





    </body>
          


    <script>

       
        $("#formc").submit(()=>{
            event.preventDefault();
          $.post("api.php?c=newcategory",$("#formc").serialize(),(res)=>{
            $("#catModal").modal("hide");
             // Reset the form
            $('#formc')[0].reset();
            showcategories();
             
          })
         
        })


        function showcategories(){
            $.getJSON("api.php?c=mycategories",(res)=>{
                $("#categories").html("");
                    for (i=0;i<res.length;i++)
                    {
                        $("#categories").append(`<tr><td>${res[i].name}</td><td>${res[i].description}</td>
                        <td><a href='myquiz.php?id=${res[i].id}'><button >Quizes</button></a>
                       
                        <button onclick='del(${res[i].id})'>Διαγραφή</button></td>`)
                    }
                        });
                
        }
      
        function del(id)
        {
            c=confirm("Θέλετε σίγουρα να διαγράψετε αυτό το μάθημα;");
            if(c)
            {
                $.get("api.php?c=delmathima&id="+id,(res)=>{
                    showcategories();
                });
            }
        }
        showcategories();
          </script>



