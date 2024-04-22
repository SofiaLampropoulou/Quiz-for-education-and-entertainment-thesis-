<?php
include "header.php";
?>

<?php
include "menu.php";
?>
<body>


<div class="container">
    <h1>Γραμματεία</h1>
    <div class="othoni">
    <button class="btn btn-primary" data-toggle="modal" data-target="#gramModal">Προσθήκη εργαζομένου στη γραμματεία</button>
        <table class= "table table-hover">
        <tr><th>Email</th><th>Firstname</th><th>Lastname</th><th>Email</th></tr>

<tbody id="grammateia">

</tbody>
</table>
    </div>
</div>
    <!-- Modal -->
<div id="gramModal" class="modal fade" role="dialog">
    <div class="modal-dialog">

<!-- Modal content-->
<div class="modal-content">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Εγγραφή νέου εργαζομένου στη γραμματεία</h4>
    </div>
    <div class="modal-body">
        <h1>Νέος εργαζόμενος:</h1>
        <form id="formgr" >
        <div class="input-group">
              <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
              <input id="email1" type="email" class="form-control" name="email" placeholder="Email" required>
            </div><br>
            <div class="input-group">
              <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
              <input id="password1" type="password" class="form-control" name="password" placeholder="Κωδικός" required>
            </div><br>
            <div class="input-group">
              <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
              <input id="firstname1" type="text" class="form-control" name="firstname" placeholder="Όνομα" required>
            </div><br>
            <div class="input-group">
              <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
              <input id="lastname1" type="text" class="form-control" name="lastname" placeholder="Επώνυμο" required>
            </div><br>
            
            
              <div id="msgs"></div>
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
       $("#formgr").submit(()=>{
            event.preventDefault();
            
            $.post("api.php?c=newgram",$("#formgr").serialize(),(res)=>{
                if(res=="ok"){
                    $("#msgs").html(`<div class="alert alert-success">
                                    Η εγγραφή σας είναι επιτυχής.
                                    </div>`);
                                    showgram();
                }
                else
                {
                    $("#msgs").html(`<div class="alert alert-danger">
                                   Η εγγραφή σας είναι ανεπιτυχής.
                                    </div>`);
                }
            })

        })
        function showgram(){
        $.getJSON("api.php?c=allgram",(res)=>{
            $("#grammateia").html("");
        for( i=0;i<res.length;i++)
        {
            $("#grammateia").append(`<tr><td>${res[i].email}</td>
            <td>${res[i].password}</td>
            <td>${res[i].firstname}</td>
            <td>${res[i].lastname}</td>
           
            <td><button onclick='del(${res[i].id})'>Delete</button></td>`)
        }
        })
    }
    showgram();

    function del(id){
        c=confirm("Θέλετε σίγουρα να διαγράψετε αυτόν τον εργαζόμενο της γραμματείας;");
        if(c){

        
        $.get("api.php?c=delgram&id="+id,(res)=>{
            showgram();
        });
    }
    }
    showgram();
        </script> 
   