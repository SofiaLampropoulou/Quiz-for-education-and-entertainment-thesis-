
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

            <div id=timeshow></div>  
            <form id=frm100>      
            <div id="sgamequiz">
            </div>
           
            <td><button onclick="calcscore()" type=button>Υποβολή</button></a></td>
            </form>
    </div>  
</div>


        </body>
        <script>



            var id=<?php echo $_GET['id']; ?>;
            var cor=[];
            function showex(){

                $.getJSON("api.php?c=studentquiz&id="+id,(res)=>{
                    $("#sgamequiz").html("");
                    cor=res;
                    for (i=0;i<res.length;i++) 
                    {

                        $("#sgamequiz").append(` <h3>${ i+1 }. ${ res[i]["q"].vocalization }</h3>`);
                        html1=`<div style='margin-left:40px'>`;
                        for (j=0;j<res[i]["a"].length;j++)
                        {
                            html1+=` <p><input type=radio   name="aa${ res[i]["q"].id }" value='${ res[i]["a"][j].id}'> ${ res[i]["a"][j].text_of_answer }</p>`;
                        
                        }
                        html1+="</div>";
                        $("#sgamequiz").append(html1);

                    }

                    
                });
            
            }
        showex();

        

        $.getJSON("api.php?c=onetest&id="+id,(res)=>{
            $("#title4").html(res[0].title);
            starttimequiz(res[0].total_time);
            
        });

        var xronometro;
        var timeq;
        var starttime=new Date();
      function starttimequiz(t)
      {
        timeq=t*60;
        xronometro=setInterval(function(){
            timeq-=1;
            $("#timeshow").html(timeq+"sec");
            if(timeq==0){
                endtime=Date.now();
                $.post("api.php?c=sendres&id="+id+"&starttime="+starttime.toString()+"&endtime="+endtime.toString(),$("#frm100").serialize(),(res)=>{
                    if(res==1)
                       window.location.href="ssubmitanswers.php?id="+id;
                });
               

            }
        },1000);
      }
      

      function calcscore()
      {
        endtime=new Date();
                $.post("api.php?c=sendres&id="+id+"&starttime="+starttime.toString()+"&endtime="+endtime.toString(),$("#frm100").serialize(),(res)=>{
                   if(res==1)
                   window.location.href="ssubmitanswers.php?id="+id;
                });
        
      }
        
</script>