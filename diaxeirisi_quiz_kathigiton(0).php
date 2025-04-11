<?php
include "header.php";
?>

<?php
include "menu.php";
?>
<body>

<div class="container">
    <h1>Διαχείρηση quiz</h1>
    <div class="row cc1">
        <div class="col-md-6" >
       

            <h1>Κατηγορίες/Μαθήματα</h1>
            <button class="btn btn-primary col-md-10" data-togle="modal" data-target="catModal" >Νέα κατηγορία/Νέο μάθημα</button>
            <table class="table table-hover">
                <tbody id="categories">
                </tbody>
               </table>
                
        </div>
        <div class="col-md-6">
        
        <h1>Τα quiz μου</h1>
        <button class="btn btn-primary col-md-12">Δημιουργία quiz</button>
            <table class="table table-hover">
                <tbody id="quiz">
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
        <h4 class="modal-title">Νέα κατηγορία/Νέο μάθημα</h4>
    </div>
    <div class="modal-body">
        
        <form id="formc" >
           <div class="form-group">
            <label for="cat">Κατηγορία/Μάθημα</label>
            <input type="text" class="form-control" id="cat" name="cat">
              </div>
             
              <button type="submit" class="btn btn-success">Υποβολή</button> 
            
          </form>
          <script>
        $("#formc").submit(()=>{
          $.post("api.php?c=newcategory",$("#formc").serialize(),(res)=>{
            $("#catModal").modal("hide");
            showcategories();
          })
        })


        function showcategories(){
            $.getJSON("api.php?c=allcategories",(res)=>{
                $("#categories").html("");
        for (i=0;i<res.length;i++)
        {
            $("#categories").append(`<tr><td>${res[i].name}</td><td><button onclick='delcat(${res[i].id})'>Del</button></td>`)
        }
            })
        }
        function showcategories()
            {
                $.get()
            }

        showcategories();
          </script>


        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button> 
        </div>
 </div>
 </div>
 </div>

 


    </body>
          