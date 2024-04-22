
<?php
include "header.php";
?>

<?php
include "menu.php";
?>
<body>

<div class="container">

<h1 id="title4"></h1>
 <div class="othoni">

        
   
  
        <table class="table table-hover">
        <tr><th><div >Εκφώνηση</th><th> feedback</th><th>Βαθμός</th><th>Επίπεδο δυσκολίας</th></tr>
            <tbody id="sgamequiz">
            </tbody>
        </table>
    </div>
    </div>
</div>


        </body>
        <script>
       var id=<?php echo $_GET['id']; ?>;
       function showex(){
            $.getJSON("api.php?c=studentquiz&id="+id,(res)=>{
                    $("#sgamequiz").html("");
              
                    for (i=0;i<res.length;i++) 
                    {

                        $("#sgamequiz").append(`<tr><td>${ res[i]["q"].vocalization }</td>
                                    <td>${ res[i]["q"].feedback }</td><td>${ res[i]["q"].points}</td><td>${ res[i]["q"].levelofdifficulty}</td></tr>`);
                                   

                                                        for (j=0;j<res.length[i];j++) 
                                        {
                                            $("#sgamequiz").append(`<tr><td>${ res[j]["a"].text_of_answer}</td>
                                                        <td>${ res[j]["a"].true_false }</td></tr>`);

                                                    }
                                
                                }


                   
            });
           
        }
        showex();
     




       /* function showanswers(){
            $.getJSON("api.php?c=allanswers",(res)=>{
                $("#sgamequiz").html("");
        for (i=0;i<res.length;i++)
        {
            $("#sgamequiz").append(`<tr><td>${res[i].text_of_answer}</td><td>${res[i].true_false}</td>`)
        }
            });
        }
     
        showanswers();*/


        $.getJSON("api.php?c=onetest&id="+id,(res)=>{
            $("#title4").html(res[0].title);
        });


</script>