<?php
include "header.php";
?>

<?php
include "menu.php";
?>
<body>

<div class="container">

 <h1 id="title3"></h1>
 <div class="othoni">
 <h1>Γράψτε τις απαντήσεις σας.</h1>

   
    <button class="btn btn-primary" data-toggle="modal" data-target="#answerModal">Προσθήκη απάντησης</button>
      
    <table class="table table-hover ">
       <tr><th><div >Απάντηση</th><th> Σωστή/Λάθος</th></tr>
            <tbody id="answer">
            </tbody>
        </table>
    </div>
 
    </div>
</div>

<!-- Modal -->
<div id="answerModal" class="modal fade" role="dialog">
    <div class="modal-dialog">

<!-- Modal content-->
<div class="modal-content">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h2 class="modal-title">Προσθήκη απάντησης</h2>
    </div>
    <div class="modal-body">
        
        <form id="formans" >
        <div class="form-group">
           <br><label for="answer">Δημιουργία quiz:</label></br>
           
           <br> <input type="text" class="form-control" id="text_of_answer" name="text_of_answer" placeholder="Απάντηση" required></br>
         
          
           <br><select  class="form-control" id="true_false" name="true_false" required>
        <option value=0>Λάθος</option>
        <option value=1>Σωστή</option>
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
 <script>

var id=<?php echo $_GET['id']; ?>;

        $("#formans").submit(()=>{
            event.preventDefault();
          $.post("api.php?c=newanswer&id="+id,$("#formans").serialize(),(res)=>{
            $("#answerModal").modal("hide");
            $('#formans')[0].reset();
            showanswers();
          })
        })

        function showanswers(){
            $.getJSON("api.php?c=allanswers&id="+id,(res)=>{
                $("#answer").html("");
                    for (i=0;i<res.length;i++)
                    {

                        
                        $("#answer").append(`<tr><td>${res[i].text_of_answer}</td>
                        <td>${ res[i].true_false==1?"Σωστή":"Λάθος" }</td>
                        <td><button onclick='del(${res[i].id})'>Διαγραφή</button></td> `)

                    }
                   
            })
            
        }

        function del(id)
        {
            c=confirm("Θέλετε σίγουρα να διαγράψετε αυτή την άσκηση;");
            if(c)
            {
                $.get("api.php?c=delanswer&id="+id,(res)=>{
                    showanswers();   
                });
            }
        }

        showanswers(); 

        $.getJSON("api.php?c=oneexercise&id="+id,(res)=>{
            $("#title3").html(res[0].name)
        });
       //<td><a href='epquiz.php?'><button >Πίσω</button></a></td>  
</script>

