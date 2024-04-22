
<?php
include "header.php";
?>

<?php
include "menu.php";
?>
<body>

<div class="container">

 <h1 id="title2"></h1>
 <div class="othoni">
 <h1>Πρόσθεσε ερωτήσεις και απαντήσεις του quiz σου</h1>
        
   
    <button class="btn btn-primary" onclick="fun()">Προσθήκη ερώτησης</button>
        <table class="table table-hover ">
       <tr><th><div >Εκφώνηση</th><th> feedback</th><th>Βαθμός</th><th>Επίπεδο δυσκολίας</th></tr>
            <tbody id="exercise">
            </tbody>
        </table>
    </div>
    </div>
</div>


          <!-- Modal -->
<div id="exerModal" class="modal fade" role="dialog">
    <div class="modal-dialog">

<!-- Modal content-->
<div class="modal-content">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h2 class="modal-title">Επεξεργασία quiz</h2>
    </div>
    <div class="modal-body">
    
               
        <form id="formexer" >
        <div class="form-group">
           <br><label for="askisi">Επεξεργασία quiz:</label></br>
           
           <br><input type="text" class="form-control" id="vocalization" name="vocalization" placeholder="Εκφώνηση" required></br>
           <br><input type="text" class="form-control" id="feedback" name="feedback" placeholder="feedback" required></br>
           <br><input type="text" class="form-control" id="points" name="points" placeholder="Βαθμός" required></br>
           <br><input type="text" class="form-control" id="levelofdifficulty" name="levelofdifficulty" placeholder="Επίπεδο δυσκολίας" required></br>
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

var id=<?php echo $_GET['id']; ?>;

        $("#formexer").submit(()=>{
            event.preventDefault();
          $.post("api.php?c=exercise&id="+id,$("#formexer").serialize(),(res)=>{
            $("#exerModal").modal("hide");
            showexercise();
          })
        })


       
       

    
        function showexercise(){

            $.getJSON("api.php?c=showex&id="+id,(res)=>{
                    $("#exercise").html("");
                    for(i=0;i<res.length;i++)
                    {
                        $("#exercise").append(`<tr><td>${ res[i].vocalization }</td>
                        <td>${ res[i].feedback }</td><td>${ res[i].points}</td><td>${ res[i].levelofdifficulty}</td>
                        <td><a href='addanswer.php?id=${res[i].id}'><button >Προσθήκη απάντησης</button></a></td>
                        <td><button onclick='del(${res[i].id})'>Διαγραφή</button></td>`)
                    }
            })

}
function del(id)
        {
            c=confirm("Θέλετε σίγουρα να διαγράψετε αυτη την άσκηση;");
            if(c)
            {
                $.get("api.php?c=delexer&id="+id,(res)=>{
                    showexercise();
                });
            }
        }

        function fun()
        {
            $("#exerModal").modal("show");
            $("#formexer")[0].reset();
              }

              $.getJSON("api.php?c=onequiz&id="+id,(res)=>{
            $("#title2").html(res[0].title)
        });

        showexercise();

          </script>