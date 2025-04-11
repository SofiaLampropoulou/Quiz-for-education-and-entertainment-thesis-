
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

 
      
   
  
        <table class="table table-hover">
        <tr><th>Τίτλος</th><th>Συνολικός χρόνος</th><th>Ημερομηνία δημιουργίας</th><th>Βάση</th><th>Επιλογές</th></tr>
         
        <tbody id="quiz">
            </tbody>
        </table>
    </div>
    </div>
</div>

    
        <script>
       




        function showquizes(){
            $.getJSON("api.php?c=allquiz1",(res)=>{
                $("#quiz").html("");
                res.forEach(quiz => {
                const visibilityText = quiz.visibility ? "Ενεργό" : "Ανενεργό";
                const visibilityClass = quiz.visibility ? "btn-success" : "btn-secondary";
     //   for (i=0;i<res.length;i++)
       // {
            $("#quiz").append(`<tr><td>${quiz.title}</td>
            <td>${quiz.total_time}</td>
            <td>${quiz.date_of_creation}</td>
            <td>${quiz.vash}</td>
            <td><button onclick='del(${quiz.id})'>Διαγραφή</button>
              <button onclick="toggleVisibility(${quiz.id}, ${quiz.visibility})"
                                    class="btn ${visibilityClass}" id="visibility-btn-${quiz.id}">${visibilityText}
                            </button></td></tr>`)
                        });
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

       
        
        function toggleVisibility(id, currentVisibility) {
           // $currentVisibility = $_GET['visibility'];
            const newVisibility = currentVisibility ? 0 : 1;
        $.get("api.php?c=toggle_visibility&id=" + id + "&visibility=" + newVisibility, (res) => {
            const result = JSON.parse(res);
            if (result.status === "success") {
                // Update the button text and style based on the new visibility status
               // const newVisibility = result.new_visibility;
                const button = $("#visibility-btn-" + id);
                if (newVisibility === 1) {
                    button.text("Ενεργό").removeClass("btn-secondary").addClass("btn-success");
                } else {
                    button.text("Ανενεργό").removeClass("btn-success").addClass("btn-secondary");
                }
                 // Update the `onclick` attribute with the new visibility state
            button.attr("onclick", `toggleVisibility(${id}, ${result.new_visibility})`);
            } else {
                alert("Failed to update visibility. Please try again.");
            }
        });
    }

    // Initial load of quizzes
   
        showquizes();
          </script>