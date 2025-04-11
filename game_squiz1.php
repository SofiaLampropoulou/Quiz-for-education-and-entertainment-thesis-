
<?php
include "header.php";
?>

<?php
include "menu.php";
?>
<?php
 if(isset($_GET['page-nr'])){
    $id=$_GET['page-nr'];

 }
 else{
    $id=1;
 }
?>
<body id="<?php echo $id?>">


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
    <div class="page-info"> 
        <?php 
         if(!isset($_GET['page-nr'])){
            $page=1;
         }
         else{
            $page=$_GET['page-nr'];
        }
        ?>  
          
        Showing <?php echo $page ?> of <?php echo $pages ?> pages
    </div>
    <div class="pagination"> 
    <a href="?page-nr=1">First</a>



                  <div class=page-numbers>
                    <?php
                    for($counter=1;$counter<=$pages; $counter++){
                        ?>
                        <a href="?page-nr=<?php echo $counter?>"><?php echo $counter?></a>
                        <?php

                    }
                    ?>
       

                </div>
           

                
                    <a id="next-btn" href="javascript:void(0)" style="display:none;">Next</a>
                 
                        
           
   

</div> 
</div>


        </body>
        <script>


var pageNr = <?php echo isset($_GET['page-nr']) ? intval($_GET['page-nr']) : 1; ?>;
var id = <?php echo isset($_GET['id']) ? intval($_GET['id']) : 1; ?>;

           
            var cor=[];



            function showex(pageNr = 1){
                
               
                   // $.getJSON(`api.php?c=studentquiz&page_nr=${pageNr}&id=` + id, (res) => {
                    $.getJSON(`api.php?c=studentquiz&page_nr=${pageNr}&id=${id}`, (res) => { 
                   $("#sgamequiz").html("");
                    cor=res.exercise;
                    for (i=0;i<cor.length;i++) 
                    {

                        $("#sgamequiz").append(` <h3>${ i+1 }. ${ cor[i].vocalization }</h3>`);
                        html1=`<div style='margin-left:40px'>`;
                        for (let j=0;j<cor[i]["a"].length;j++)
                        {
                            html1+=` <p><input type=radio   name="aa${ cor[i].id }" value='${ cor[i]["a"][j].id}'> ${ cor[i]["a"][j].text_of_answer }</p>`;
                        
                        }
                        html1+="</div>";
                        $("#sgamequiz").append(html1);
                    }
                         // Update pagination dynamically
                         let total_pages = res.pages;
        $(".page-numbers").html(""); // Clear existing page numbers
        for (let counter = 1; counter <= total_pages; counter++) {
            $(".page-numbers").append(`<a href="javascript:void(0)" onclick="showex(${counter})">${counter}</a> `);
        }
        /* // Update Next and Previous buttons
         if (pageNr > 1) {
            $("#prev-btn").attr("onclick", `showex(${pageNr - 1})`).show();
        } else {
            $("#prev-btn").hide(); // Hide if on the first page
        }

        if (pageNr < res.pages) {
            $("#next-btn").attr("onclick", `showex(${pageNr + 1})`).show();
        } else {
            $("#next-btn").hide(); // Hide if on the last page
        }
*/
//$("#prev-btn").attr("onclick", `showex(${pageNr - 1})`).toggle(pageNr > 1);
$("#next-btn").attr("onclick", `showex(${pageNr + 1})`).toggle(pageNr < total_pages);
        // Update First and Last buttons
       // $("#first-btn").attr("onclick", `showex(1)`);
        //$("#last-btn").attr("onclick", `showex(${res.pages})`);
        //$("#last-btn").attr("onclick", `showex(${total_pages})`);
        // Update current page display (optional)
        $(".page-info").html(`Showing page ${pageNr} of ${total_pages}`);
    });
}
// Initial call to display the first page


        showex(1);

        

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