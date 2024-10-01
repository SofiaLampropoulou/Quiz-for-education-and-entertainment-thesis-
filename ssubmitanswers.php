<?php
include "header.php";
?>

<?php
include "menu.php";
?>
<body>

<div class="container">

    <h1 id="title5"></h1>
    <div class="othoni">
    Ώρα έναρξης:<span id=starttime></span><br>
    Ώρα λήξης:<span id=endtime></span><br>
    Score: <span id=score></span><br>
    <h2>Απαντήσεις</h2>
    <table class="table table-hover">
        <tr><th>Ερώτηση</th><th>Απαντήση</th><th>Αποτέλεσμα</th><th>Σωστή Απάντηση</th></tr>
            <tbody id="smakequiz">
            </tbody>
        </table>
        
            
            </div>
            
    </div>
</div>


        </body>
        <script>
             var id=<?php echo $_GET['id']; ?>;
         
            function showanswers(){
                
               
                $.getJSON("api.php?c=ssubmit&id="+id,(res)=>{
                    $("#starttime").html(res.start_time);
                    $("#endtime").html(res.end_time);
                    $("#score").html(res.score);
                    

                    $("#smakequiz").html("");
                    for (i=0;i<res.qa.length;i++) 
                    {

                        $("#smakequiz").append(`<tr><td>${res.qa[i].vocalization}</td>
                        <td>${res.qa[i].text_of_answer}</td>
                        <td>${res.qa[i].true_false==1?"Correct":"Error"}</td>
                        <td>${res.qa[i].feedback}</td></tr>`);
                        
                    }
                });
            
            }
        
        $.getJSON("api.php?c=onesubmission&id="+id,(res)=>{
            $("#title5").html(res.title);

});
showanswers();
</script>
