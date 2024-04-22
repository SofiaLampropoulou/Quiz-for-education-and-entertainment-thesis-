
<?php
include "header.php";
?>

<?php
include "menu.php";
?>
<body>

<div class="container">

 <h1 id="title1"></h1>
 <div class="othoni">

        
   
    <button class="btn btn-primary  " data-toggle="modal" data-target="#quizModal">Δημιουργία quiz</button>
        <table class="table table-hover ">
       <tr><th><div >Τίτλος</th><th> Συνολικός χρόνος</th><th>Ημερομηνία δημιουργίας</th></tr>
            <tbody id="quiz">
            </tbody>
        </table>
    </div>
    </div>
</div>


          <!-- Modal -->
<div id="quizModal" class="modal fade" role="dialog">
    <div class="modal-dialog">

<!-- Modal content-->
<div class="modal-content">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h2 class="modal-title">Δημιουργία quiz</h2>
    </div>
    <div class="modal-body">
        
        <form id="formq" >
        <div class="form-group">
           <br><label for="test">Δημιουργία quiz:</label></br>
           
           <br> <input type="text" class="form-control" id="test" name="test" placeholder="Τίτλος" required></br>
         
          
           <br><input type="text" class="form-control" id="total_time" name="total_time" placeholder="Συνολικός χρόνος" required></br>
            
           
           <br><input type="date" class="form-control" id="date_creation" name="date_of_creation" placeholder="Ημερομηνία δημιουργίας" required></br>
           
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

        $("#formq").submit(()=>{
            event.preventDefault();
          $.post("api.php?c=newquiz&id="+id,$("#formq").serialize(),(res)=>{
            $("#quizModal").modal("hide");
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
                        <td><a href='epquiz.php?id=${res[i].id}'><button >Επεξεργασία</button></a></td>
                        <td><button onclick='del(${res[i].id})'>Διαγραφή</button></td> `)

                    }
            })
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

       
        $.getJSON("api.php?c=onecategory&id="+id,(res)=>{
            $("#title1").html(res[0].name)
        });

  

          </script>