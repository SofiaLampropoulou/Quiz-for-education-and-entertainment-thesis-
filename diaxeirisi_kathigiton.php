<?php
include "header.php";
?>

<?php
include "menu.php";
?>
<body>




<div class="container">
    <h1>Καθηγητές</h1>
    <div class="othoni">
        <button class="btn btn-primary" data-toggle="modal" data-target="#kathModal">Προσθήκη καθηγητή</button>
        <table class= "table table-hover">
            <tr><th>Email</th><th>Firstname</th><th>Lastname</th></tr>

<tbody id="professors">

</tbody>
</table>
    </div>
</div>
    <!-- Modal -->
<div id="kathModal" class="modal fade" role="dialog">
    <div class="modal-dialog">

<!-- Modal content-->
<div class="modal-content">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Εγγραφή νέου καθηγητή</h4>
    </div>
    <div class="modal-body">
        <h1>Νέος καθηγητής:</h1>
        <form id="formk" >
            <div class="input-group">
              <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
              <input id="email2" type="email" class="form-control" name="email" placeholder="Email" required>
            </div><br>
            <div class="input-group">
              <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
              <input id="password2" type="password" class="form-control" name="password" placeholder="Κωδικός" required>
            </div><br>
            <div class="input-group">
              <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
              <input id="firstname2" type="text" class="form-control" name="firstname" placeholder="Όνομα" required>
            </div><br>
            <div class="input-group">
              <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
              <input id="lastname2" type="text" class="form-control" name="lastname" placeholder="Επώνυμο" required>
            </div><br>
            
              <div id="msgs"></div>
              <button type="submit" class="btn btn-success">Υποβολή</button> <button type="reset" class="btn btn-danger">Καθαρισμός</button>
            
          </form>
        
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button> 
        </div>
 </div>
 </div>
 </div>
       <script>
       $("#formk").submit(()=>{
            event.preventDefault();
            
            $.post("api.php?c=newprofessor",$("#formk").serialize(),(res)=>{
                if(res=="ok"){
                    $("#msgs").html(`<div class="alert alert-success">
                                    Η εγγραφή σας είναι επιτυχής.
                                    </div>`);
                                    showprofessors();
                }
                else
                {
                    $("#msgs").html(`<div class="alert alert-danger">
                                   Η εγγραφή σας είναι ανεπιτυχής.
                                    </div>`);
                }
            })

        })
        function showprofessors(){
        $.getJSON("api.php?c=allprofessors",(res)=>{
            $("#professors").html("");
        for (i=0;i<res.length;i++)
        {
            $("#professors").append(`<tr><td>${res[i].email}</td>
            <td>${res[i].password}</td>
            <td>${res[i].firstname}</td>
            <td>${res[i].lastname}</td>
           
            <td><button onclick='del(${res[i].id})'>Delete</button></td>`);
        }
        })
    }
    showprofessors();
    function del(id){
        c=confirm("Θες σίγουρα να διαγράψεις τον καθηγητή;");
        if(c){

        
        $.get("api.php?c=delprofessor&id="+id,(res)=>{
            showprofessors();
        });
    }
    }
    
    showprofessors();
        </script> 
  </body>