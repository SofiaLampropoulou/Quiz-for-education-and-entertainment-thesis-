
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

 <button class="btn btn-primary" data-toggle="modal" data-target="#onModal">Απ/Ενεργοποίηση</button>
      
   
  
        <table class="table table-hover">
        <tr><th>Τίτλος</th><th>Συνολικός χρόνος</th><th>Ημερομηνία δημιουργίας</th><th>Βάση</th><th>Απ/Ενεργοποίηση</th></tr>
         
        <tbody id="quiz">
            </tbody>
        </table>
    </div>
    </div>
</div>
<!-- Modal -->
<div id="onModal" class="modal fade" role="dialog">
    <div class="modal-dialog">

<!-- Modal content-->
<div class="modal-content">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h2 class="modal-title">Απ/Ενεργοποίηση</h2>
    </div>
    <div class="modal-body">
        
        <form id="formon" >
        <div class="form-group">
        <label for="quiz">Τίτλος quiz:</label>
                            <select type="text" class="form-control" id="allquiz" name=allquiz>
                            </select>
        <script>
                                             $.getJSON("api.php?c=allquiz",(res)=>{
                                               
                                                for(j=0;j<res.length;j++)
                                                {
                                                    $("#allquiz").append(`<option value='${ res[j].id }'> ${ res[j].title }</option>`);
                                                }
                                            })
                                    </script>
           
           <br><select  class="form-control" id="on_off" name="on_off" required>
        <option value=0>Απενεργοποίηση</option>
        <option value=1>Ενεργοποίηση</option>
</select></br>
            
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

        </body>
        <script>
       

$("#formon").submit(()=>{
    event.preventDefault();
  $.post("api.php?c=onoff&id="+id,$("#formon").serialize(),(res)=>{
    $("#onModal").modal("hide");
    showquizes();
  })
})


        function showquizes(){
            $.getJSON("api.php?c=allquiz",(res)=>{
                $("#quiz").html("");
        for (i=0;i<res.length;i++)
        {
            $("#quiz").append(`<tr><td>${res[i].title}</td>
            <td>${res[i].total_time}</td>
            <td>${res[i].date_of_creation}</td>
            <td>${res[i].vash}</td>
            <td>${ res[i].on_off==1?"Ενεργοποίηση":"Απενεργοποίηση" }</td>
            <td><button onclick='del(${res[i].id})'>Διαγραφή</button></td>`)
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